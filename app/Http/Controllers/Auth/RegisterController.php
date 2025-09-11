<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\District;
use App\Models\State;
use App\Models\Block;
use App\Models\Role;
use App\Models\Namouser;
use App\Models\Usermapping;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function register(Request $request)
    {

        // dd($request->all());
        // $password_encrypted = $this->cryptoJsAesDecrypt("64", $request->password);
        // $password_confirmation_encrypted = $this->cryptoJsAesDecrypt("64", $request->password_confirmation);
        // $data = $request->all();
        // $data['password'] = $password_encrypted;
        // $data['password_confirmation'] = $password_confirmation_encrypted;
        // Validate nonce & _token

        $data = $request->all();
        // dd($this->validateNonceAndCsrf($request));
        if (!$this->validateNonceAndCsrf($request)) {
            return redirect()->back()->withErrors(['password' => 'Security validation failed']);
        }
        // Decrypt / parse password payloads (supports Mode A and Mode B)
        $passwordPlain = $this->recoverClientPassword($request->input('password'), $request);
        $passwordConfirmPlain = $this->recoverClientPassword($request->input('password_confirmation'), $request);

        if (!$passwordPlain || !$passwordConfirmPlain) {
            return redirect()->back()->withErrors(['password' => 'Security validation failed']);
        }
      
         if (!hash_equals($passwordPlain, $passwordConfirmPlain)) {
            return redirect()->back()->withErrors(['password' => 'Passwords do not match']);
        }
         $data['password'] = $passwordPlain ;
        event(new Registered($user = $this->create($data)));
        // Session::flash('success', 'Please Login');
        $success = "Your Registration Done Successfully, please login";
        $request->session()->put('succ', $success);
        redirect()->route('login')->withSuccess('Success message');;
        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

     // Validate nonce & CSRF token & timestamp window
    private function validateNonceAndCsrf(Request $request): bool
    {
        // CSRF verify
       
        if ($request->session()->token() !== $request->input('_token')) {
            Log::warning('CSRF mismatch on form submit', ['ip' => $request->ip()]);
            return false;
        }

        // nonce validation
        $sessionNonce = session('form_nonce');
        $sessionTs = session('form_nonce_ts');
        
        if (!$sessionNonce || !$sessionTs) {
           
            Log::warning('Nonce missing in session');
            return false;
        }
        // dd($sessionNonce, $request->input('form_nonce'));
        if (!hash_equals($sessionNonce, $request->input('form_nonce'))) {
            //  dd(3,$sessionNonce,$sessionTs);
            Log::warning('Form nonce mismatch');
            return false;
        }

        // timestamp window: require submission within X seconds (e.g. 10 minutes)
        $now = now()->timestamp;
        if (($now - $sessionTs) > 600) { // 600s = 10 minutes
             dd(4,$sessionNonce,$sessionTs);
            Log::warning('Form nonce expired');
            return false;
        }

        return true;
    }
    private function recoverClientPassword(string $payload, Request $request)
    {
        // Try decode outer (Mode B style): payload is base64 of "combinedB64:integrity"
        $decodedOuter = base64_decode($payload, true);
        if ($decodedOuter !== false && strpos($decodedOuter, ':') !== false) {
            // Mode B path: decodedOuter = combinedB64:hash
            [$combinedB64, $receivedHash] = explode(':', $decodedOuter, 2);

            // Reconstruct keyHex same as client:
            // keyHex = SHA256(session_token + floor(time()/300) + userAgent + screen_width + screen_height)
            $sessionId = $request->session()->token();
            $timeSlot = floor(now()->timestamp / 300);
            $screenWidth = $request->input('screen_width', '');
            $screenHeight = $request->input('screen_height', '');
            $browserFingerprint = $request->userAgent() . $screenWidth . $screenHeight;
            $keyHex = hash('sha256', $sessionId . $timeSlot . $browserFingerprint);

            // verify integrity: expected = substr(SHA256(combinedB64 + keyHex), 0, 16)
            $expected = substr(hash('sha256', $combinedB64 . $keyHex), 0, 16);
            if (!hash_equals($expected, $receivedHash)) {
                Log::warning('Integrity mismatch in recoverClientPassword');
                return false;
            }

            // decode combined
            $combined = base64_decode($combinedB64, true);
            if ($combined === false) {
                return false;
            }

            $iv = substr($combined, 0, 16);
            $ciphertext = substr($combined, 16);
            if ($iv === false || $ciphertext === false) {
                return false;
            }

            $keyBinary = hex2bin($keyHex);
            if ($keyBinary === false) return false;

            $decrypted = openssl_decrypt($ciphertext, 'AES-256-CBC', $keyBinary, OPENSSL_RAW_DATA, $iv);
            if ($decrypted === false) {
                Log::warning('OpenSSL decrypt failed in recoverClientPassword');
                return false;
            }

            // At this point $decrypted should be clientHashHex|timestamp (if client appended)
            // If client used pattern "clientHash|timestamp" return clientHash
            if (strpos($decrypted, '|') !== false) {
                [$clientHash, $_ts] = explode('|', $decrypted, 2);
                return $clientHash;
            }

            // else return whole decrypted
            return $decrypted;
        }

        // Mode A fallback: payload might be base64 or plain clientHashHex
        $maybe = $payload;
        $decoded = base64_decode($payload, true);
        if ($decoded !== false && preg_match('/^[A-Fa-f0-9]{64}$/', $decoded) === 1) {
            // base64 decoded yields 64-hex chars.
            return $decoded;
        }

        // If payload itself is hex string (client might have sent hex directly)
        if (preg_match('/^[A-Fa-f0-9]{64}$/', $payload) === 1) {
            return $payload;
        }

        // Last: if payload is base64 of clientHashHex:timestamp (very possible)
        if ($decoded !== false) {
            // maybe format clientHash|timestamp encoded
            if (strpos($decoded, '|') !== false) {
                [$clientHash, $_ts] = explode('|', $decoded, 2);
                if (preg_match('/^[A-Fa-f0-9]{64}$/', $clientHash) === 1) {
                    return $clientHash;
                }
            }
        }

        return false;
    }

    public function registernww(Request $request)
    {
        // Enhanced security validation
        $this->validateSecurityHeaders($request);
        // Decrypt and validate passwords

        $decryptedData = $this->decryptPasswords($request);
        if (!$decryptedData) {
            return redirect()->back()->withErrors(['password' => 'Security validation failed']);
        }
        // Rate limiting check
        // if ($this->tooManyAttempts($request)) {
        //     return redirect()->back()->withErrors(['email' => 'Too many registration attempts']);
        // }
        // Enhanced validation
        $validator = $this->getEnhancedValidator($request, $decryptedData);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except(['password', 'password_confirmation', 'captcha']));
        }
        // Create user with enhanced security
        $data = $request->all();
        event(new Registered($user =  $this->createSecureUser($data, $decryptedData)));
        // event(new Registered($user = $this->create($data)));
        // Session::flash('success', 'Please Login');
        $success = "Your Registration Done Successfully, please login";
        $request->session()->put('succ', $success);
        redirect()->route('login')->withSuccess('Success message');;
        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    private function validateSecurityHeaders(Request $request)
    {

        // Validate security token
        $securityToken = $request->input('security_token');

        if (!$securityToken) {
            abort(403, 'Security token missing');
        }

        // Validate CSRF token
        if ($request->session()->token() !== $request->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }

        // Check for suspicious patterns
        if ($this->detectSuspiciousActivity($request)) {
            Log::warning('Suspicious registration attempt detected', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            abort(403, 'Suspicious activity detected');
        }
    }

    private function decryptPasswords(Request $request)
    {
        try {
            $encryptedPassword = $request->input('password');
            $encryptedPasswordConfirm = $request->input('password_confirmation');

            $password = $this->multiLayerDecrypt($encryptedPassword, $request);
            $passwordConfirm = $this->multiLayerDecrypt($encryptedPasswordConfirm, $request);

            if (!$password || !$passwordConfirm) {
                return false;
            }

            $passwordParts = explode('|', $password);
            $passwordConfirmParts = explode('|', $passwordConfirm);

            if (count($passwordParts) !== 2 || count($passwordConfirmParts) !== 2) {
                return false;
            }

            $timestamp = $passwordParts[1];

            // Validate timestamp (should be recent). JS uses Date.now() (ms)
            if (time() - ($timestamp / 1000) > 300) { // 5 minute window
                return false;
            }

            return [
                'password' => $passwordParts[0],
                'password_confirmation' => $passwordConfirmParts[0]
            ];
        } catch (\Exception $e) {
            Log::error('Password decryption error', ['error' => $e->getMessage()]);
            return false;
        }
    }

    private function multiLayerDecrypt($encryptedData, Request $request)
    {
        try {
            // Outer base64 produced by JS's btoa(combinedB64 + ':' + hash)
            $decodedOuter = base64_decode($encryptedData);
            if ($decodedOuter === false) {
                return false;
            }

            // split into combinedB64 and hash (only first colon)
            $parts = explode(':', $decodedOuter, 2);
            if (count($parts) !== 2) {
                // fallback: treat the decoded outer as base64 ciphertext (legacy)
                $fallback = openssl_decrypt(
                    base64_decode($encryptedData),
                    'AES-256-CBC',
                    hash('sha256', 'fallback_key_2024', true),
                    OPENSSL_RAW_DATA,
                    substr(hash('sha256', 'fallback_key_2024', true), 0, 16)
                );
                return $fallback ?: false;
            }

            $combinedB64 = $parts[0];
            $receivedHash = $parts[1];

            // Reconstruct the same keyHex as JS
            $sessionId = $request->session()->token();
            $timestamp = floor(time() / 300); // same 5-minute slot as JS
            // JS uses navigator.userAgent + screen.width + screen.height
            $screenWidth = $request->input('screen_width', '');
            $screenHeight = $request->input('screen_height', '');
            $browserFingerprint = $request->userAgent() . $screenWidth . $screenHeight;

            $keyHex = hash('sha256', $sessionId . $timestamp . $browserFingerprint); // 64 hex chars
            // Verify hash (JS used: substr(SHA256(combinedB64 + keyHex), 0, 16))
            $expectedHash = substr(hash('sha256', $combinedB64 . $keyHex), 0, 16);
            if (!hash_equals($expectedHash, $receivedHash)) {
                Log::warning('Integrity hash mismatch during decrypt', [
                    'expected' => $expectedHash,
                    'received' => $receivedHash
                ]);
                return false;
            }

            // decode combined (base64 from client)
            $combined = base64_decode($combinedB64);
            if ($combined === false) {
                return false;
            }

            // first 16 bytes = IV, rest = ciphertext
            $iv = substr($combined, 0, 16);
            $ciphertext = substr($combined, 16);

            if ($iv === false || $ciphertext === false) {
                return false;
            }

            // Convert keyHex to raw binary (32 bytes) for AES-256
            $keyBinary = hex2bin($keyHex);
            if ($keyBinary === false) {
                return false;
            }

            $decrypted = openssl_decrypt(
                $ciphertext,
                'AES-256-CBC',
                $keyBinary,
                OPENSSL_RAW_DATA,
                $iv
            );

            if ($decrypted === false) {
                Log::warning('OpenSSL decrypt failed');
                return false;
            }

            return $decrypted;
        } catch (\Exception $e) {
            Log::error('Decrypt error', ['msg' => $e->getMessage()]);
            return false;
        }
    }


    private function multiRoundHash($password, $salt)
    {
        // Multiple rounds of SHA-256 with different salts
        $hash = $password;

        for ($i = 0; $i < 10000; $i++) {
            $hash = hash('sha256', $hash . $salt . $i);
        }

        // Final SHA-512 round
        return hash('sha512', $hash . $salt);
    }

    private function tooManyAttempts(Request $request)
    {
        $key = 'register_attempts_' . $request->ip();
        $attempts = cache()->get($key, 0);

        if ($attempts >= 5) {
            return true;
        }

        cache()->put($key, $attempts + 1, 3600); // 1 hour
        return false;
    }

    private function detectSuspiciousActivity(Request $request)
    {
        // Check for automated requests
        if (
            empty($request->userAgent()) ||
            strpos($request->userAgent(), 'bot') !== false ||
            strpos($request->userAgent(), 'crawl') !== false
        ) {
            return true;
        }

        // Check request timing (too fast)
        $lastRequest = cache()->get('last_register_' . $request->ip());
        if ($lastRequest && (time() - $lastRequest) < 10) {
            return true;
        }

        cache()->put('last_register_' . $request->ip(), time(), 3600);
        return false;
    }
    private function getEnhancedValidator(Request $request, array $decryptedData)
    {
        return Validator::make(array_merge($request->all(), $decryptedData), [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'not_regex:/[<>"\']/' // Prevent XSS
            ],
            'phone' => [
                'required',
                'string',
                'size:10',
                'regex:/^[6-9][0-9]{9}$/',
                'unique:users'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:128', // Prevent DoS
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'captcha' => 'required|captcha',
        ]);
    }
    public function cryptoJsAesDecrypt($passphrase, $jsonString)
    {
        $jsondata = json_decode($jsonString, true);

        $salt = hex2bin($jsondata["s"]);
        $ct = base64_decode($jsondata["ct"]);
        $iv  = hex2bin($jsondata["iv"]);
        $concatedPassphrase = $passphrase . $salt;
        $md5 = array();
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++) {
            $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        return json_decode($data, true);
    }



    public function showRegistrationForm(Request $request)
    {
     
        $role_name = $request->input('role');
        $nonce = bin2hex(random_bytes(16)); // 32 hex chars
        $formNonce = $nonce; // 32 hex chars
         session(['form_nonce' => $nonce, 'form_nonce_ts' => now()->timestamp]);

        // session(['form_nonce' => $nonce, 'form_nonce_ts' => now()->timestamp]);
        if ($role_name == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg==') {
            // dd(123);
            $roles = Role::where('groupof', 0)
                ->where('slug', '=', 'namo-fit-india-youth-club')
                ->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador', 'ghd', 'stateadmin'])->orderBy('name', 'ASC')->get();
            // dd($roles);
            $districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

            $blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
            // dd($blocks->toArray());
            $state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

            $club_name = "Club Name";
            return view('auth.coiregistration', compact('roles', 'state', 'districts', 'blocks', 'club_name'));
        } else if ($role_name == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi' || $role_name == 'namo-fit-india-cycling-club') {

            $roles = Role::where('groupof', 0)
                ->where('slug', '=', 'namo-fit-india-cycling-club')
                ->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador', 'ghd', 'stateadmin'])->orderBy('name', 'ASC')->get();
            // dd($roles);
            $districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

            // dd($club_name_with_id);

            $blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
            // dd($blocks->toArray());
            $state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

            $participant = "Member Count";

            $club_name = "Club Name";

            $listofcenter = "Kindly contact your nearest SAI Centre to be a part of FIT India’s World Bicycle Day Celebrations.";

            return view('auth.coiregistration', compact('roles', 'state', 'districts', 'blocks', 'participant', 'listofcenter', 'club_name'));
            // return view('severdownpage');

        } else if ($role_name == 'Y3ljbG90aG9uLTIwMjQ=') {

            $roles = Role::where('groupof', 0)
                ->where('slug', '=', 'cyclothon-2024')
                ->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador', 'ghd', 'stateadmin'])->orderBy('name', 'ASC')->get();
            // dd($roles);

        } else if ($role_name == 'bmF0aW9uYWwtc3BvcnRzLWRheS0yMDI1') {

            $roles = Role::where('groupof', 1)
                ->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador', 'ghd', 'stateadmin'])->orderBy('name', 'ASC')->get();
        } else {

            $roles = Role::where('groupof', 1)
                ->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador', 'ghd', 'stateadmin'])->orderBy('name', 'ASC')->get();
        }
        $districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

        $blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
        // dd($blocks->toArray());
        $state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

        return view('auth.register', compact('roles', 'state', 'districts', 'blocks','formNonce'));
    }


    public function cyclothonshowRegistrationForm(Request $request)
    {
        try {
            // dd("cyclothonshowRegistrationForm");
            $role_name = "cyclothon-2024";
            // if($role_name == 'Y3ljbG90aG9uLTIwMjQ='){

            $roles = Role::where('groupof', 0)
                ->where('slug', '=', $role_name)
                ->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador', 'ghd', 'stateadmin'])->orderBy('name', 'ASC')->get();
            // dd($roles);

            // }
            // $districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

            // $blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
            // dd($blocks->toArray());
            $state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

            // return view('auth.cyclothonregister', compact('roles', 'state', 'districts', 'blocks'));
            return view('auth.cyclothonregister', compact('roles', 'state'));
        } catch (Exception $e) {
            return abort(404);
        }
    }

    public function coiregistration(Request $request)
    {
        try {
            // dd("cyclothonshowRegistrationForm");
            $role_name = "cyclothon-2024";
            // if($role_name == 'Y3ljbG90aG9uLTIwMjQ='){
            $club_name_with_id = DB::table('users')
                ->select(DB::raw('MIN(id) as id'), 'name') // One ID per name (smallest)
                ->whereIn('role', ['namo-fit-india-cycling-club', 'namo-fit-india-youth-club']) // Filter by roles
                ->groupBy('name') // Group by name to make each name unique
                ->orderBy('name', 'asc') // Alphabetical order
                ->whereNotIn('name', ['15', '25', '26', '31', '9114179370'])
                ->get();
            $roles = Role::where('groupof', 0)
                ->where('slug', '=', $role_name)
                ->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador', 'ghd', 'stateadmin'])->orderBy('name', 'ASC')->get();
            // dd($roles);

            // }
            // $districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

            // $blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
            // dd($blocks->toArray());
            $state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

            // return view('auth.cyclothonregister', compact('roles', 'state', 'districts', 'blocks'));
            $listofcenter = "Kindly contact your nearest SAI Centre to be a part of FIT India’s World Bicycle Day Celebrations.";
            return view('auth.coiregistration', compact('roles', 'state', 'listofcenter', 'club_name_with_id', 'role_name'));
        } catch (Exception $e) {
            return abort(404);
        }
    }




    protected function validator(array $data)
    {

        try {

            if (!empty($data)) {

                if (empty($data['role']) || empty($data['phone'])) {

                    return abort(404);
                }
                // dd($data);
                $role_name = $data['role'];
                $phone = $data['phone'];
                $records = DB::table('users')
                    ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                    ->where([
                        ['users.email', '=', $data['email']],
                        ['users.role', '=', $role_name],
                        ['users.phone', '=', $phone]
                    ])
                    ->first();

                if (empty($records)) {

                    // $role_name = base64_decode($data['role_name']);

                    if ($role_name == "cyclothon-2024") {

                        $cyclothonrole = $data['cyclothonrole'];
                        $records = DB::table('users')
                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                            ->where([
                                ['users.email', '=', $data['email']],
                                ['users.rolewise', '=', $role_name],
                                ['users.phone', '=', $phone],
                                ['usermetas.cyclothonrole', '=', $cyclothonrole]
                            ])
                            ->first();

                        if (!empty($records)) {

                            return Validator::make(
                                $data,
                                [
                                    'email' => 'required|string|email|max:255|unique:users',
                                    // 'phone' => 'required|digits:10',
                                    'phone' => 'required|digits:10|unique:users',
                                ],
                                [
                                    'email.unique' => 'Email already exist.',
                                    'phone.unique' => 'Mobile number already exist.',
                                ]
                            );
                        }

                        return Validator::make(
                            $data,
                            [
                                'cyclothonrole' => 'required|string|max:255',
                                'name' => 'required|string|max:255',
                                'role' => 'required',
                                'email' => 'required|string|email|max:255',
                                'phone' => 'required|digits:10',
                                // 'pincode' => 'required|digits:6',
                                // 'state' => 'required',
                                // 'district' => 'required',
                                // 'block' => 'required',
                                // 'city' => 'required|regex:/^[\pL\s\-]+$/u',
                                'password' => 'required|string|min:8|confirmed',
                                'password_confirmation' => 'required',
                                // 'captcha' => 'required|captcha',
                                'captcha' => 'required',
                                // 'cycle' => 'required',
                            ],
                            [
                                'cyclothonrole.required' => 'Role name is required.',
                                'name.required' => 'Your Name/School Name/Organisation Name field is required.',
                                'role.required' => 'Role field is required.',
                                'email.required' => 'Email field is required.',
                                'email.email' => 'Please enter correct email format.',
                                'email.unique' => 'Email already exist.',
                                'phone.required' => 'Mobile field is required.',
                                'phone.digits' => 'Mobile field must have 10 digit.',
                                // 'pincode.required' => 'Pin code field is required.',
                                // 'pincode.digits' => 'Pincode field must have 6 digit.',
                                'phone.unique' => 'Mobile Number already exist.',
                                // 'state.required' => 'State is required.',
                                // 'district.required' => 'District is required.',
                                // 'block.required' => 'Block field is required.',
                                // 'city.required' => 'City field is required.',
                                // 'city.regex' => 'Please enter character value only.',
                                'password.required' => 'Password is required.',
                                'password.min' => 'Please enter 8 digit value.',
                                'password.confirmed' => 'Password does not match.',
                                'password_confirmation.required' => 'Confirmation password is required.',
                                // 'cycle.required' => 'Please select cycle type.',
                                // 'captcha.required' => 'Captcha field is required.',
                                // 'captcha.captcha' => 'Please fill correct value.',
                            ]
                        );
                    } else if ($role_name == 'namo-fit-india-youth-club' || $role_name == "namo-fit-india-cycling-club") {
                        // dd(222);
                        return Validator::make(
                            $data,
                            [
                                // 'name' => 'required|string|max:255',
                                'name' => 'required|string|max:255|unique:users',
                                'role' => 'required',
                                'email' => 'required|string|email|max:255',
                                'phone' => 'required|digits:10',
                                'state' => 'required',
                                'district' => 'required',
                                'block' => 'required',
                                'city' => 'required|regex:/^[\pL\s\-]+$/u',
                                'password' => 'required|string|min:8|confirmed',
                                'password_confirmation' => 'required',
                                // 'captcha' => 'required|captcha',
                                'captcha' => 'required',
                            ],
                            [
                                'name.required' => 'Your Name/School Name/Organisation Name field is required.',
                                'name.unique' => 'Club name already exist.',
                                'role.required' => 'Role field is required.',
                                'email.required' => 'Email field is required.',
                                'email.email' => 'Please enter correct email format.',
                                'email.unique' => 'Email already exist.',
                                'phone.required' => 'Mobile field is required.',
                                'phone.digits' => 'Mobile field must have 10 digit.',
                                'phone.unique' => 'Mobile Number already exist.',
                                'state.required' => 'State is required.',
                                'district.required' => 'District is required.',
                                'block.required' => 'Block field is required.',
                                'city.required' => 'City field is required.',
                                'city.regex' => 'Please enter character value only.',
                                'password.required' => 'Password is required.',
                                'password.min' => 'Please enter 8 digit value.',
                                'password.confirmed' => 'Password does not match.',
                                'password_confirmation.required' => 'Confirmation password is required.',
                                // 'captcha.required' => 'Captcha field is required.',
                                // 'captcha.captcha' => 'Please fill correct value.',
                            ]
                        );
                    } else if (base64_decode($data['role_name']) == 'national-sports-day-2025') {

                        return Validator::make(
                            $data,
                            [
                                'name' => 'required|string|max:255',
                                'role' => 'required',
                                'email' => 'required|string|email|max:255|unique:users',
                                'phone' => 'required|digits:10|unique:users',
                                'state' => 'required',
                                'district' => 'required',
                                'block' => 'required',
                                'city' => 'required|regex:/^[\pL\s\-]+$/u',
                                'password' => 'required|string|min:8|confirmed',
                                'password_confirmation' => 'required',
                                // 'captcha' => 'required|captcha',
                                'captcha' => 'required',
                            ],
                            [
                                'name.required' => 'Your Name/School Name/Organisation Name field is required.',
                                'role.required' => 'Role field is required.',
                                'email.required' => 'Email field is required.',
                                'email.email' => 'Please enter correct email format.',
                                'email.unique' => 'Email already exist.',
                                'phone.required' => 'Mobile field is required.',
                                'phone.digits' => 'Mobile field must have 10 digit.',
                                'phone.unique' => 'Mobile Number already exist.',
                                'state.required' => 'State is required.',
                                'district.required' => 'District is required.',
                                'block.required' => 'Block field is required.',
                                'city.required' => 'City field is required.',
                                'city.regex' => 'Please enter character value only.',
                                'password.required' => 'Password is required.',
                                'password.min' => 'Please enter 8 digit value.',
                                'password.confirmed' => 'Password does not match.',
                                'password_confirmation.required' => 'Confirmation password is required.',
                                // 'captcha.required' => 'Captcha field is required.',
                                // 'captcha.captcha' => 'Please fill correct value.',
                            ]
                        );
                    } else if ($data['role'] == 'school') {
                        // echo "aaaa";die;
                        return Validator::make(
                            $data,
                            [
                                'name' => 'required|string|max:255',
                                'role' => 'required',
                                'udise' => 'required|numeric|digits:11',
                                'email' => 'required|string|email|max:255|unique:users',
                                'phone' => 'required|digits:10|unique:users',
                                'state' => 'required',
                                'district' => 'required',
                                'block' => 'required',
                                'city' => 'required|regex:/^[\pL\s\-]+$/u',
                                'password' => 'required|string|min:8|confirmed',
                                'password_confirmation' => 'required',
                                // 'captcha' => 'required|captcha',
                                'captcha' => 'required',
                            ],
                            [
                                'name.required' => 'Your Name/School Name/Organisation Name field is required.',
                                'role.required' => 'Role field is required.',
                                'udise.required' => 'Udise Number field is required.',
                                'udise.numeric' => 'Udise Number must have 11 digit.',
                                'udise.digits' => 'Udise Number must have 11 digit.',
                                'email.required' => 'Email field is required.',
                                'email.email' => 'Please enter correct email format.',
                                'email.unique' => 'Email already exist.',
                                'phone.required' => 'Mobile field is required.',
                                'phone.digits' => 'Mobile field must have 10 digit.',
                                'phone.unique' => 'Mobile Number already exist.',
                                'state.required' => 'State is required.',
                                'district.required' => 'District is required.',
                                'block.required' => 'Block field is required.',
                                'city.required' => 'City field is required.',
                                'city.regex' => 'Please enter character value only.',
                                'password.required' => 'Password is required.',
                                'password.min' => 'Please enter 8 digit value.',
                                'password.confirmed' => 'Password does not match.',
                                'password_confirmation.required' => 'Confirmation password is required.',
                                // 'captcha.required' => 'Captcha field is required.',
                                // 'captcha.captcha' => 'Please fill correct value.',
                            ]
                        );
                    } else {
                        // dd(1111111);
                        return Validator::make(
                            $data,
                            [
                                'name' => 'required|string|max:255',
                                'role' => 'required',
                                'email' => 'required|string|email|max:255|unique:users',
                                'phone' => 'required|digits:10|unique:users',
                                'state' => 'required',
                                'district' => 'required',
                                'block' => 'required',
                                'city' => 'required|regex:/^[\pL\s\-]+$/u',
                                'password' => 'required|string|min:8|confirmed',
                                'password_confirmation' => 'required',
                                // 'captcha' => 'required|captcha',
                                'captcha' => 'required',
                            ],
                            [
                                'name.required' => 'Your Name/School Name/Organisation Name field is required.',
                                'role.required' => 'Role field is required.',
                                'email.required' => 'Email field is required.',
                                'email.email' => 'Please enter correct email format.',
                                'email.unique' => 'Email already exist.',
                                'phone.required' => 'Mobile field is required.',
                                'phone.digits' => 'Mobile field must have 10 digit.',
                                'phone.unique' => 'Mobile Number already exist.',
                                'state.required' => 'State is required.',
                                'district.required' => 'District is required.',
                                'block.required' => 'Block field is required.',
                                'city.required' => 'City field is required.',
                                'city.regex' => 'Please enter character value only.',
                                'password.required' => 'Password is required.',
                                'password.min' => 'Please enter 8 digit value.',
                                'password.confirmed' => 'Password does not match.',
                                'password_confirmation.required' => 'Confirmation password is required.',
                                // 'captcha.required' => 'Captcha field is required.',
                                // 'captcha.captcha' => 'Please fill correct value.',
                            ]
                        );
                    }
                } else {
                    return Validator::make(
                        $data,
                        [
                            'email' => 'required|string|email|max:255|unique:users',
                            // 'phone' => 'required|digits:10',
                            'phone' => 'required|digits:10|unique:users',
                        ],
                        [
                            'email.unique' => 'Email already exist.',
                            'phone.unique' => 'Mobile number already exist.',
                        ]
                    );
                }
            } else {
                return abort(404);
            }
        } catch (Exception $e) {
            return abort(404);
        }

        /*if($data['role']=='school'){
            //echo "aaaa";die;
            return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'udise' =>'required|numeric|digits:11',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'digits:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'state' => ['required'],
            'district' => ['required'],
            'block' => ['required'],
            'city' => ['required'],
            'password_confirmation' => ['required'],
            'captcha' => ['required', 'captcha'],
            ],
            ['captcha.captcha' => 'Invalid Captcha']);

        } else {

          return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'digits:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'state' => ['required'],
            'district' => ['required'],
            'block' => ['required'],
            'city' => ['required'],
            'password_confirmation' => ['required'],
            'captcha' => ['required', 'captcha'],
          ],
          ['captcha.captcha' => 'Invalid Captcha']);
        } */


        /* $chkerro = false;
        $validator = Validator::make([],[]);

        if(($data['udise']=='school') && empty($data['udise'])){
            $chkerro = true;
            $validator->errors()->add("The udise field is required");
        }

        if(empty($data['email'])){
            $chkerro = true;
            $validator->errors()->add("Please input a valid Email ID");
        }

        if(empty($data['state'])){
            $chkerro = true;
            $validator->errors()->add("The state field is required");
        }

        if(empty($data['district'])){
            $chkerro = true;
            $validator->errors()->add("The district field is required");
        }
        if(empty($data['block'])){
            $chkerro = true;
            $validator->errors()->add("The block field is required");
        }
        if(empty($data['city'])){
            $chkerro = true;
            $validator->errors()->add("The city/town/village is required");
        }

        if($chkerro){
            throw new ValidationException($validator);
        } */
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    protected function createcopy(array $data)
    {
        // dd($data);
        $role_name = base64_decode($data['role_name']);
        // dd($role_name);
        if ($role_name == 'namo-fit-india-youth-club' || $role_name == "namo-fit-india-cycling-club" || $role_name == "cyclothon-2024") {

            // dd($data);
            // dd($role_name);


            $records = DB::table('users')
                ->where([
                    ['users.email', '=', $data['email']]
                ])
                ->first();
            // dd($records);
            // dd($records->id);
            $user = Namouser::create([
                'user_id' => $records->id,
                'name' => $records->name,
                'email' => $records->email,
                'phone' =>  $records->phone,
                'email_verified_at' => $records->email_verified_at,
                'role' => $records->role,
                'rolelabel' => $records->rolelabel,
                'role_id' => $records->role_id,
                'password' => $records->password,
                'verified' => $records->verified,
                'remember_token' => $records->remember_token,
                'created_at' => $records->created_at,
                'updated_at' => $records->updated_at,
                'via' => $records->via,
                'deviceid' => $records->deviceid,
                'FCMToken' => $records->FCMToken,
                'authid' => $records->authid,
                'viamedium' => $records->viamedium,
            ]);

            $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();
            $records = User::where('id', $records->id)
                ->update(
                    [
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'role' =>  $data['role'],
                        'rolelabel' => $rolearr['name'],
                        'role_id' => $rolearr['id'],
                        'password' => Hash::make($data['password']),
                        'created_at' => date("Y-m-d h:i:s")
                    ]
                );
        } else {
            $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

            if (!empty($data['state'])) {
                $state = State::find($data['state']);
            }
            if (!empty($data['district'])) {
                $district = District::find($data['district']);
            }
            if (!empty($data['block'])) {
                $block = Block::find($data['block']);
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' =>  $data['role'],
                'rolelabel' => $rolearr['name'],
                'role_id' => $rolearr['id'],
                'password' => Hash::make($data['password']),
            ]);

            if ($user->id) {
                $usermeta = new Usermeta();
                $usermeta->user_id = $user->id;
                if (!empty($state['name'])) $usermeta->state = $state['name'];
                if (!empty($district['name'])) $usermeta->district = $district['name'];
                if (!empty($block['name'])) $usermeta->block = $block['name'];
                if (!empty($data['city'])) $usermeta->city = $data['city'];
                if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];

                $usermeta->save();
            }
        }

        return $user;
    }

    protected function createSecureUser(array $data, array $decryptedData)
    {
        // Generate cryptographically secure salt
        $salt = bin2hex(random_bytes(64)); // 128-character salt
        // Multiple hashing rounds for enhanced security
        $password = $decryptedData['password'];
        $hashedPassword = $this->multiRoundHash($password, $salt);
        $role_name = $data['role'];
        if ($role_name == "cyclothon-2024") {
            $records = DB::table('users')
                ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                ->where([
                    ['users.email', '=', $data['email']]
                ])
                ->select(
                    'usermetas.id as id',
                    'name',
                    'email',
                    "phone",
                    "email_verified_at",
                    "role",
                    "rolelabel",
                    "role_id",
                    "password",
                    "verified",
                    "remember_token",
                    "users.created_at as created_at",
                    "users.updated_at as updated_at",
                    "via",
                    "deviceid",
                    "FCMToken",
                    "authid",
                    "viamedium",
                    "rolewise",
                    "user_id",
                    "dob",
                    "age",
                    "gender",
                    "address",
                    "state",
                    "district",
                    "block",
                    "city",
                    "mobile",
                    "orgname",
                    "udise",
                    "pincode",
                    "tshirtsize",
                    "height",
                    "weight",
                    "image",
                    "board",
                    "medium",
                    "gmail",
                    "facebook",
                    "apple",
                    "cycle",
                    "cyclothonrole",
                    "address_line_one",
                    "address_line_two",
                    "participant_number"
                )
                ->first();
            // dd($records);
            if (!empty($records)) {
                $user = Namouser::create([
                    'user_id' => $records->user_id,
                    'name' => $records->name,
                    'email' => $records->email,
                    'phone' =>  $records->phone,
                    'email_verified_at' => $records->email_verified_at,
                    'role' => $records->role,
                    'rolelabel' => $records->rolelabel,
                    'role_id' => $records->role_id,
                    'password' => $records->password,
                    'verified' => $records->verified,
                    'remember_token' => $records->remember_token,
                    'created_at' => $records->created_at,
                    'updated_at' => $records->updated_at,
                    'via' => $records->via,
                    'deviceid' => $records->deviceid,
                    'FCMToken' => $records->FCMToken,
                    'authid' => $records->authid,
                    'viamedium' => $records->viamedium,
                    'rolewise' => $records->rolewise,
                    'cycle' => $records->cycle,
                    'cyclothonrole' => $records->cyclothonrole,
                    'participant_number' => $records->participant_number,
                    'pincode' => $records->pincode,
                    'tshirtsize' => $records->tshirtsize,
                    'address_line_one' => $records->address_line_one,
                    'address_line_two' => $records->address_line_two,
                    'state' => $records->state,
                    'district' => $records->district,
                    'block' => $records->block,
                    'city' => $records->city
                ]);

                $Usermappings = new Usermapping();
                $Usermappings->user_id = $records->user_id;
                $Usermappings->register_for = $role_name;
                $Usermappings->status = 1;
                $Usermappings->save();
                // dd($role_name);
                // dd($records->user_id);
                $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();
                // $update = User::where('id',$records->id)
                $update = User::where('id', $records->user_id)
                    ->update(
                        [
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'role' =>  "subscriber",
                            'rolelabel' => "INDIVIDUAL",
                            'rolewise' =>  "cyclothon-2024",
                            'role_id' => $rolearr['id'],
                            'password' => Hash::make($data['password']),
                            'updated_at' => date("Y-m-d h:i:s")
                        ]
                    );

                // $records1 = DB::table('usermetas')
                // ->where([
                //  ['user_id', '=', $records->id]
                // ])
                // ->first();
                // dd($records);
                if (!$data['participant_number']) {
                    $data['participant_number'] = null;
                }
                if (!$data['user_join_club_id']) {
                    $data['user_join_club_id'] = null;
                }
                if (isset($data['tshirtsize'])) {

                    if ($data['cyclothonrole'] == "club") {
                        $tshirtsize = $data['tshirtsize'];
                    } else {
                        $tshirtsize = NULL;
                    }
                }
                $records_update = Usermeta::where('id', $records->id)
                    ->update(
                        [
                            'cycle' => $data['cycle'],
                            'cyclothonrole' => $data['cyclothonrole'],
                            'participant_number' => $data['participant_number'],
                            'pincode' => $data['pincode'],
                            'address_line_one' => NULL,
                            'address_line_two' => NULL,
                            'tshirtsize' => $tshirtsize,
                            'state' => $data['state'],
                            'district' => $data['district'],
                            'block' => $data['block'],
                            'city' => $data['city'],
                            'user_join_club_id' => $data['user_join_club_id']
                        ]
                    );
            } else {

                $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

                if (!empty($data['state'])) {
                    $state = State::find($data['state']);
                }
                if (!empty($data['district'])) {
                    $district = District::find($data['district']);
                }
                if (!empty($data['block'])) {
                    $block = Block::find($data['block']);
                }
                // dd($role_name);
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'rolewise' => "cyclothon-2024",
                    'role' =>  "subscriber",
                    'rolelabel' => "INDIVIDUAL",
                    'role_id' => $rolearr['id'],
                    'password' => Hash::make($data['password']),
                ]);

                if ($user->id) {
                    $usermeta = new Usermeta();
                    $usermeta->user_id = $user->id;
                    // if (!empty($state['name'])) $usermeta->state = $state['name'];
                    // if (!empty($district['name'])) $usermeta->district = $district['name'];
                    // if (!empty($block['name'])) $usermeta->block = $block['name'];
                    // if (!empty($data['state'])) $usermeta->state = $data['state'];
                    // if (!empty($data['district'])) $usermeta->district = $data['district'];
                    // if (!empty($data['block'])) $usermeta->block = $data['block'];
                    // if (!empty($data['city'])) $usermeta->city = $data['city'];
                    if (is_numeric($data['state'])) {
                        // echo 1;
                        if (!empty($state['name'])) $usermeta->state = $state['name'];
                        if (!empty($district['name'])) $usermeta->district = $district['name'];
                        if (!empty($block['name'])) $usermeta->block = $block['name'];
                        if (!empty($data['city'])) $usermeta->city = $data['city'];
                    } else {
                        // echo 2;
                        // dd($data['state']);
                        if (!empty($data['state'])) $usermeta->state = $data['state'];
                        if (!empty($data['district'])) $usermeta->district = $data['district'];
                        if (!empty($data['block'])) $usermeta->block = $data['block'];
                        if (!empty($data['city'])) $usermeta->city = $data['city'];
                    }
                    if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                    if (!empty($data['pincode'])) $usermeta->pincode = $data['pincode'];
                    if (isset($data['tshirtsize'])) {

                        if ($data['cyclothonrole'] == "club") {
                            $tshirtsize = $data['tshirtsize'];
                        } else {
                            $tshirtsize = NULL;
                        }
                    }
                    if (!empty($tshirtsize)) $usermeta->tshirtsize = $tshirtsize;
                    if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                    if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];
                    if (!empty($data['cycle'])) $usermeta->cycle = $data['cycle'];
                    if (!empty($data['cyclothonrole'])) $usermeta->cyclothonrole = $data['cyclothonrole'];
                    if (!empty($data['participant_number'])) $usermeta->participant_number = $data['participant_number'];
                    if (!empty($data['user_join_club_id'])) $usermeta->user_join_club_id = $data['user_join_club_id'];

                    $usermeta->save();
                }
            }
        } elseif ($role_name == 'namo-fit-india-youth-club' || $role_name == "namo-fit-india-cycling-club") {
            $records = DB::table('users')
                ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                ->where([
                    ['users.email', '=', $data['email']]
                ])
                ->first();

            if (!empty($records)) {
                $user = Namouser::create([
                    'user_id' => $records->user_id,
                    'name' => $records->name,
                    'email' => $records->email,
                    'phone' =>  $records->phone,
                    'email_verified_at' => $records->email_verified_at,
                    'role' => $records->role,
                    'rolelabel' => $records->rolelabel,
                    'role_id' => $records->role_id,
                    'password' => $records->password,
                    'verified' => $records->verified,
                    'remember_token' => $records->remember_token,
                    'created_at' => $records->created_at,
                    'updated_at' => $records->updated_at,
                    'via' => $records->via,
                    'deviceid' => $records->deviceid,
                    'FCMToken' => $records->FCMToken,
                    'authid' => $records->authid,
                    'viamedium' => $records->viamedium,
                    'rolewise' => $records->rolewise,
                    'cycle' => $records->cycle,
                    'cyclothonrole' => $records->cyclothonrole,
                    'participant_number' => $records->participant_number,
                    'pincode' => $records->pincode,
                    'tshirtsize' => $records->tshirtsize,
                    'address_line_one' => $records->address_line_one,
                    'address_line_two' => $records->address_line_two,
                    'state' => $records->state,
                    'district' => $records->district,
                    'block' => $records->block,
                    'city' => $records->city
                ]);

                $Usermappings = new Usermapping();
                $Usermappings->user_id = $records->id;
                $Usermappings->register_for = $role_name;
                $Usermappings->status = 1;
                $Usermappings->save();
                $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();
                $recordscopy = User::where('id', $records->user_id)
                    ->update(
                        [
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'role' =>  $data['role'],
                            'rolelabel' => $rolearr['name'],
                            'role_id' => $rolearr['id'],
                            'rolewise' => null,
                            'password' => Hash::make($data['password']),
                            'updated_at' => date("Y-m-d h:i:s")
                        ]
                    );
                if (isset($data['participant_number'])) {
                    $participant_number = $data['participant_number'];
                } else {
                    $participant_number = NULL;
                }
                if (isset($data['pincode'])) {
                    $pincode = $data['pincode'];
                } else {
                    $pincode = NULL;
                }

                if (isset($data['tshirtsize'])) {
                    if ($role_name == "namo-fit-india-cycling-club") {
                        $tshirtsize = $data['tshirtsize'];
                    } else {
                        $tshirtsize = NULL;
                    }
                }
                $records_update = Usermeta::where('user_id', $records->user_id)
                    ->update(
                        [
                            'cycle' => NULL,
                            'cyclothonrole' => NULL,
                            'participant_number' => $participant_number,
                            'pincode' => $pincode,
                            'tshirtsize' => $tshirtsize,
                            'address_line_one' => $data['address_line_one'] ?? NULL,
                            'address_line_two' => $data['address_line_two'] ?? NULL,
                            'state' => $data['state'],
                            'district' => $data['district'],
                            'block' => $data['block'],
                            'city' => $data['city']
                        ]
                    );
            } else {

                $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

                if (!empty($data['state'])) {
                    $state = State::find($data['state']);
                }
                if (!empty($data['district'])) {
                    $district = District::find($data['district']);
                }
                if (!empty($data['block'])) {
                    $block = Block::find($data['block']);
                }

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'role' =>  $data['role'],
                    'rolelabel' => $rolearr['name'],
                    'role_id' => $rolearr['id'],
                    'password' => Hash::make($data['password']),
                ]);

                if ($user->id) {
                    $usermeta = new Usermeta();
                    $usermeta->user_id = $user->id;
                    if (is_numeric($data['state'])) {
                        // echo 1;
                        if (!empty($state['name'])) $usermeta->state = $state['name'];
                        if (!empty($district['name'])) $usermeta->district = $district['name'];
                        if (!empty($block['name'])) $usermeta->block = $block['name'];
                        if (!empty($data['city'])) $usermeta->city = $data['city'];
                    } else {
                        // echo 2;
                        // dd($data['state']);
                        if (!empty($data['state'])) $usermeta->state = $data['state'];
                        if (!empty($data['district'])) $usermeta->district = $data['district'];
                        if (!empty($data['block'])) $usermeta->block = $data['block'];
                        if (!empty($data['city'])) $usermeta->city = $data['city'];
                    }

                    if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                    if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                    if (!empty($data['pincode'])) $usermeta->pincode = $data['pincode'];
                    if (isset($data['tshirtsize'])) {
                        if ($role_name == "namo-fit-india-cycling-club") {
                            $tshirtsize = $data['tshirtsize'];
                        } else {
                            $tshirtsize = NULL;
                        }
                    }
                    if (!empty($tshirtsize)) $usermeta->tshirtsize = $tshirtsize;
                    if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];

                    if (isset($data['participant_number'])) {
                        $participant_number = $data['participant_number'];
                    } else {
                        $participant_number = NULL;
                    }
                    if (!empty($participant_number)) $usermeta->participant_number = $participant_number;
                    if (!empty($data['address_line_one'])) $usermeta->address_line_one = $data['address_line_one'];
                    if (!empty($data['address_line_two'])) $usermeta->address_line_two = $data['address_line_two'];

                    $usermeta->save();
                }
            }
        } elseif ($data['role_name'] == 'bmF0aW9uYWwtc3BvcnRzLWRheS0yMDI1') {

            $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

            if (!empty($data['state'])) {
                $state = State::find($data['state']);
            }
            if (!empty($data['district'])) {
                $district = District::find($data['district']);
            }
            if (!empty($data['block'])) {
                $block = Block::find($data['block']);
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' =>  $data['role'],
                'rolelabel' => $rolearr['name'],
                'role_id' => $rolearr['id'],
                'rolewise' =>  base64_decode($data['role_name']),
                'password' => $hashedPassword,
            ]);

            if ($user->id) {
                $usermeta = new Usermeta();
                $usermeta->user_id = $user->id;
                if (!empty($state['name'])) $usermeta->state = $state['name'];
                if (!empty($district['name'])) $usermeta->district = $district['name'];
                if (!empty($block['name'])) $usermeta->block = $block['name'];
                if (!empty($data['city'])) $usermeta->city = $data['city'];
                if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];

                $usermeta->save();
            }
        } else {
            $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

            if (!empty($data['state'])) {
                $state = State::find($data['state']);
            }
            if (!empty($data['district'])) {
                $district = District::find($data['district']);
            }
            if (!empty($data['block'])) {
                $block = Block::find($data['block']);
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' =>  $data['role'],
                'rolelabel' => $rolearr['name'],
                'role_id' => $rolearr['id'],
                'password' => $hashedPassword,
            ]);

            if ($user->id) {
                $usermeta = new Usermeta();
                $usermeta->user_id = $user->id;
                if (!empty($state['name'])) $usermeta->state = $state['name'];
                if (!empty($district['name'])) $usermeta->district = $district['name'];
                if (!empty($block['name'])) $usermeta->block = $block['name'];
                if (!empty($data['city'])) $usermeta->city = $data['city'];
                if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];

                $usermeta->save();
            }
        }
        return $user;
    }

    protected function create(array $data)
    {

        $role_name = $data['role'];

        if ($role_name == "cyclothon-2024") {
            // dd($data);
            $records = DB::table('users')
                ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                ->where([
                    ['users.email', '=', $data['email']]
                ])
                ->select(
                    'usermetas.id as id',
                    'name',
                    'email',
                    "phone",
                    "email_verified_at",
                    "role",
                    "rolelabel",
                    "role_id",
                    "password",
                    "verified",
                    "remember_token",
                    "users.created_at as created_at",
                    "users.updated_at as updated_at",
                    "via",
                    "deviceid",
                    "FCMToken",
                    "authid",
                    "viamedium",
                    "rolewise",
                    "user_id",
                    "dob",
                    "age",
                    "gender",
                    "address",
                    "state",
                    "district",
                    "block",
                    "city",
                    "mobile",
                    "orgname",
                    "udise",
                    "pincode",
                    "tshirtsize",
                    "height",
                    "weight",
                    "image",
                    "board",
                    "medium",
                    "gmail",
                    "facebook",
                    "apple",
                    "cycle",
                    "cyclothonrole",
                    "address_line_one",
                    "address_line_two",
                    "participant_number"
                )
                ->first();
            // dd($records);
            if (!empty($records)) {
                $user = Namouser::create([
                    'user_id' => $records->user_id,
                    'name' => $records->name,
                    'email' => $records->email,
                    'phone' =>  $records->phone,
                    'email_verified_at' => $records->email_verified_at,
                    'role' => $records->role,
                    'rolelabel' => $records->rolelabel,
                    'role_id' => $records->role_id,
                    'password' => $records->password,
                    'verified' => $records->verified,
                    'remember_token' => $records->remember_token,
                    'created_at' => $records->created_at,
                    'updated_at' => $records->updated_at,
                    'via' => $records->via,
                    'deviceid' => $records->deviceid,
                    'FCMToken' => $records->FCMToken,
                    'authid' => $records->authid,
                    'viamedium' => $records->viamedium,
                    'rolewise' => $records->rolewise,
                    'cycle' => $records->cycle,
                    'cyclothonrole' => $records->cyclothonrole,
                    'participant_number' => $records->participant_number,
                    'pincode' => $records->pincode,
                    'tshirtsize' => $records->tshirtsize,
                    'address_line_one' => $records->address_line_one,
                    'address_line_two' => $records->address_line_two,
                    'state' => $records->state,
                    'district' => $records->district,
                    'block' => $records->block,
                    'city' => $records->city
                ]);

                $Usermappings = new Usermapping();
                $Usermappings->user_id = $records->user_id;
                $Usermappings->register_for = $role_name;
                $Usermappings->status = 1;
                $Usermappings->save();
                // dd($role_name);
                // dd($records->user_id);
                $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();
                // $update = User::where('id',$records->id)
                $update = User::where('id', $records->user_id)
                    ->update(
                        [
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'role' =>  "subscriber",
                            'rolelabel' => "INDIVIDUAL",
                            'rolewise' =>  "cyclothon-2024",
                            'role_id' => $rolearr['id'],
                            'password' => Hash::make($data['password']),
                            'updated_at' => date("Y-m-d h:i:s")
                        ]
                    );

                // $records1 = DB::table('usermetas')
                // ->where([
                //  ['user_id', '=', $records->id]
                // ])
                // ->first();
                // dd($records);
                if (!$data['participant_number']) {
                    $data['participant_number'] = null;
                }
                if (!$data['user_join_club_id']) {
                    $data['user_join_club_id'] = null;
                }
                if (isset($data['tshirtsize'])) {

                    if ($data['cyclothonrole'] == "club") {
                        $tshirtsize = $data['tshirtsize'];
                    } else {
                        $tshirtsize = NULL;
                    }
                }
                $records_update = Usermeta::where('id', $records->id)
                    ->update(
                        [
                            'cycle' => $data['cycle'],
                            'cyclothonrole' => $data['cyclothonrole'],
                            'participant_number' => $data['participant_number'],
                            'pincode' => $data['pincode'],
                            'address_line_one' => NULL,
                            'address_line_two' => NULL,
                            'tshirtsize' => $tshirtsize,
                            'state' => $data['state'],
                            'district' => $data['district'],
                            'block' => $data['block'],
                            'city' => $data['city'],
                            'user_join_club_id' => $data['user_join_club_id']
                        ]
                    );
            } else {

                $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

                if (!empty($data['state'])) {
                    $state = State::find($data['state']);
                }
                if (!empty($data['district'])) {
                    $district = District::find($data['district']);
                }
                if (!empty($data['block'])) {
                    $block = Block::find($data['block']);
                }
                // dd($role_name);
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'rolewise' => "cyclothon-2024",
                    'role' =>  "subscriber",
                    'rolelabel' => "INDIVIDUAL",
                    'role_id' => $rolearr['id'],
                    'password' => Hash::make($data['password']),
                ]);

                if ($user->id) {
                    $usermeta = new Usermeta();
                    $usermeta->user_id = $user->id;
                    // if (!empty($state['name'])) $usermeta->state = $state['name'];
                    // if (!empty($district['name'])) $usermeta->district = $district['name'];
                    // if (!empty($block['name'])) $usermeta->block = $block['name'];
                    // if (!empty($data['state'])) $usermeta->state = $data['state'];
                    // if (!empty($data['district'])) $usermeta->district = $data['district'];
                    // if (!empty($data['block'])) $usermeta->block = $data['block'];
                    // if (!empty($data['city'])) $usermeta->city = $data['city'];
                    if (is_numeric($data['state'])) {
                        // echo 1;
                        if (!empty($state['name'])) $usermeta->state = $state['name'];
                        if (!empty($district['name'])) $usermeta->district = $district['name'];
                        if (!empty($block['name'])) $usermeta->block = $block['name'];
                        if (!empty($data['city'])) $usermeta->city = $data['city'];
                    } else {
                        // echo 2;
                        // dd($data['state']);
                        if (!empty($data['state'])) $usermeta->state = $data['state'];
                        if (!empty($data['district'])) $usermeta->district = $data['district'];
                        if (!empty($data['block'])) $usermeta->block = $data['block'];
                        if (!empty($data['city'])) $usermeta->city = $data['city'];
                    }
                    if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                    if (!empty($data['pincode'])) $usermeta->pincode = $data['pincode'];
                    if (isset($data['tshirtsize'])) {

                        if ($data['cyclothonrole'] == "club") {
                            $tshirtsize = $data['tshirtsize'];
                        } else {
                            $tshirtsize = NULL;
                        }
                    }
                    if (!empty($tshirtsize)) $usermeta->tshirtsize = $tshirtsize;
                    if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                    if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];
                    if (!empty($data['cycle'])) $usermeta->cycle = $data['cycle'];
                    if (!empty($data['cyclothonrole'])) $usermeta->cyclothonrole = $data['cyclothonrole'];
                    if (!empty($data['participant_number'])) $usermeta->participant_number = $data['participant_number'];
                    if (!empty($data['user_join_club_id'])) $usermeta->user_join_club_id = $data['user_join_club_id'];

                    $usermeta->save();
                }
            }
        } elseif ($role_name == 'namo-fit-india-youth-club' || $role_name == "namo-fit-india-cycling-club") {

            // dd("done");

            $records = DB::table('users')
                ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                ->where([
                    ['users.email', '=', $data['email']]
                ])
                ->first();

            if (!empty($records)) {
                $user = Namouser::create([
                    'user_id' => $records->user_id,
                    'name' => $records->name,
                    'email' => $records->email,
                    'phone' =>  $records->phone,
                    'email_verified_at' => $records->email_verified_at,
                    'role' => $records->role,
                    'rolelabel' => $records->rolelabel,
                    'role_id' => $records->role_id,
                    'password' => $records->password,
                    'verified' => $records->verified,
                    'remember_token' => $records->remember_token,
                    'created_at' => $records->created_at,
                    'updated_at' => $records->updated_at,
                    'via' => $records->via,
                    'deviceid' => $records->deviceid,
                    'FCMToken' => $records->FCMToken,
                    'authid' => $records->authid,
                    'viamedium' => $records->viamedium,
                    'rolewise' => $records->rolewise,
                    'cycle' => $records->cycle,
                    'cyclothonrole' => $records->cyclothonrole,
                    'participant_number' => $records->participant_number,
                    'pincode' => $records->pincode,
                    'tshirtsize' => $records->tshirtsize,
                    'address_line_one' => $records->address_line_one,
                    'address_line_two' => $records->address_line_two,
                    'state' => $records->state,
                    'district' => $records->district,
                    'block' => $records->block,
                    'city' => $records->city
                ]);

                $Usermappings = new Usermapping();
                $Usermappings->user_id = $records->id;
                $Usermappings->register_for = $role_name;
                $Usermappings->status = 1;
                $Usermappings->save();
                // dd($data);
                $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();
                // dd($records->id);
                $recordscopy = User::where('id', $records->user_id)
                    ->update(
                        [
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'role' =>  $data['role'],
                            'rolelabel' => $rolearr['name'],
                            'role_id' => $rolearr['id'],
                            'rolewise' => null,
                            'password' => Hash::make($data['password']),
                            'updated_at' => date("Y-m-d h:i:s")
                        ]
                    );

                // $records_update = Usermeta::where('user_id',$records->user_id)
                // dd($records->user_id);
                if (isset($data['participant_number'])) {
                    $participant_number = $data['participant_number'];
                } else {
                    $participant_number = NULL;
                }
                if (isset($data['pincode'])) {
                    $pincode = $data['pincode'];
                } else {
                    $pincode = NULL;
                }

                if (isset($data['tshirtsize'])) {
                    if ($role_name == "namo-fit-india-cycling-club") {
                        $tshirtsize = $data['tshirtsize'];
                    } else {
                        $tshirtsize = NULL;
                    }
                }
                // dd($data['user_join_club_id']);
                $records_update = Usermeta::where('user_id', $records->user_id)
                    ->update(
                        [
                            'cycle' => NULL,
                            'cyclothonrole' => NULL,
                            'participant_number' => $participant_number,
                            'pincode' => $pincode,
                            'tshirtsize' => $tshirtsize,
                            'address_line_one' => $data['address_line_one'] ?? NULL,
                            'address_line_two' => $data['address_line_two'] ?? NULL,
                            'state' => $data['state'],
                            'district' => $data['district'],
                            'block' => $data['block'],
                            'city' => $data['city']
                        ]
                    );
            } else {

                $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

                if (!empty($data['state'])) {
                    $state = State::find($data['state']);
                }
                if (!empty($data['district'])) {
                    $district = District::find($data['district']);
                }
                if (!empty($data['block'])) {
                    $block = Block::find($data['block']);
                }

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'role' =>  $data['role'],
                    'rolelabel' => $rolearr['name'],
                    'role_id' => $rolearr['id'],
                    'password' => Hash::make($data['password']),
                ]);

                if ($user->id) {
                    $usermeta = new Usermeta();
                    $usermeta->user_id = $user->id;
                    if (is_numeric($data['state'])) {
                        // echo 1;
                        if (!empty($state['name'])) $usermeta->state = $state['name'];
                        if (!empty($district['name'])) $usermeta->district = $district['name'];
                        if (!empty($block['name'])) $usermeta->block = $block['name'];
                        if (!empty($data['city'])) $usermeta->city = $data['city'];
                    } else {
                        // echo 2;
                        // dd($data['state']);
                        if (!empty($data['state'])) $usermeta->state = $data['state'];
                        if (!empty($data['district'])) $usermeta->district = $data['district'];
                        if (!empty($data['block'])) $usermeta->block = $data['block'];
                        if (!empty($data['city'])) $usermeta->city = $data['city'];
                    }

                    if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                    if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                    if (!empty($data['pincode'])) $usermeta->pincode = $data['pincode'];
                    if (isset($data['tshirtsize'])) {
                        if ($role_name == "namo-fit-india-cycling-club") {
                            $tshirtsize = $data['tshirtsize'];
                        } else {
                            $tshirtsize = NULL;
                        }
                    }
                    if (!empty($tshirtsize)) $usermeta->tshirtsize = $tshirtsize;
                    if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];

                    if (isset($data['participant_number'])) {
                        $participant_number = $data['participant_number'];
                    } else {
                        $participant_number = NULL;
                    }
                    if (!empty($participant_number)) $usermeta->participant_number = $participant_number;
                    if (!empty($data['address_line_one'])) $usermeta->address_line_one = $data['address_line_one'];
                    if (!empty($data['address_line_two'])) $usermeta->address_line_two = $data['address_line_two'];

                    $usermeta->save();
                }
            }
        } elseif ($data['role_name'] == 'bmF0aW9uYWwtc3BvcnRzLWRheS0yMDI1') {

            // dd(base64_decode($data['role_name']));



            $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

            if (!empty($data['state'])) {
                $state = State::find($data['state']);
            }
            if (!empty($data['district'])) {
                $district = District::find($data['district']);
            }
            if (!empty($data['block'])) {
                $block = Block::find($data['block']);
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' =>  $data['role'],
                'rolelabel' => $rolearr['name'],
                'role_id' => $rolearr['id'],
                'rolewise' =>  base64_decode($data['role_name']),
                'password' => Hash::make($data['password']),
            ]);

            if ($user->id) {
                $usermeta = new Usermeta();
                $usermeta->user_id = $user->id;
                if (!empty($state['name'])) $usermeta->state = $state['name'];
                if (!empty($district['name'])) $usermeta->district = $district['name'];
                if (!empty($block['name'])) $usermeta->block = $block['name'];
                if (!empty($data['city'])) $usermeta->city = $data['city'];
                if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];

                $usermeta->save();
            }
        } else {
            $rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();

            if (!empty($data['state'])) {
                $state = State::find($data['state']);
            }
            if (!empty($data['district'])) {
                $district = District::find($data['district']);
            }
            if (!empty($data['block'])) {
                $block = Block::find($data['block']);
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' =>  $data['role'],
                'rolelabel' => $rolearr['name'],
                'role_id' => $rolearr['id'],
                'password' => Hash::make($data['password']),
            ]);

            if ($user->id) {
                $usermeta = new Usermeta();
                $usermeta->user_id = $user->id;
                if (!empty($state['name'])) $usermeta->state = $state['name'];
                if (!empty($district['name'])) $usermeta->district = $district['name'];
                if (!empty($block['name'])) $usermeta->block = $block['name'];
                if (!empty($data['city'])) $usermeta->city = $data['city'];
                if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
                if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
                if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];

                $usermeta->save();
            }
        }
        return $user;
    }

    public function getDistrict(Request $request)
    {
        $state_id = $request->id;
        $district_list = District::whereStatus(true)->where('state_id', $state_id)->orderby('name', 'asc')->get();
        $district = '<option value="">Select District</option>';
        if (!empty($district_list)) {
            foreach ($district_list as $dist) {
                $district .= '<option value="' . $dist['id'] . '">' . $dist['name'] . '</option>';
            }
        }

        return $district;
    }

    public function getBlock(Request $request)
    {
        $block_id = $request->id;
        $block_list = Block::whereStatus(true)->where('district_id', $block_id)->orderby('name')->get();

        $block = '<option value="">Select Block</option>';

        if (count($block_list) > 0) {
            foreach ($block_list as $bck) {
                $block .= '<option value="' . $bck['id'] . '">' . ucwords(strtolower($bck['name'])) . '</option>';
            }
        }
        //else{
        $block .= '<option value="NA">N/A</option>';
        //}

        return $block;
    }
}
