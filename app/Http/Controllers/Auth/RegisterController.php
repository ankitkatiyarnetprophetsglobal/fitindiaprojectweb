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


    public function register1(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
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

    public function register(Request $request)
    {
      
        // Create a copy of the request data for validation
        $validationData = $request->all();

        // For validation, we need to adjust password rules since it's now hashed
        $validator = $this->validator($validationData);
        
        // Add custom validation for hashed passwords
        $validator->after(function ($validator) use ($request) {
            // Check if passwords match (hashed comparison)
            if ($request->password !== $request->password_confirmation) {
                $validator->errors()->add('password', 'The passwords do not match.');
            }

            // Check password length (hashed passwords are 64 chars)
            if (strlen($request->password) !== 64) {
                $validator->errors()->add('password', 'Invalid password format.');
            }
        });

        // Validate the request
        $validator->validate();

        // Create the user with the hashed password
        event(new Registered($user = $this->create($request->all())));

        $success = "Your Registration Done Successfully, please login";
        $request->session()->put('succ', $success);
        
        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    public function showRegistrationForm(Request $request)
    {
      
        $role_name = $request->input('role');
        // dd($role_name);
        // dd('its here you');
        // //$roles = Role::where('groupof',0)->get();
        // $role_name = "national-sports-day-2025";
        // echo $encode = base64_encode($role_name);
        // exit;
        // echo '<br/>';
        // echo base64_decode($encode);
        // echo base64_decode($role_name);
        // exit;
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

        return view('auth.register', compact('roles', 'state', 'districts', 'blocks'));
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

    public function coiregistration09042025(Request $request)
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
            return view('auth.09042025coiregistration', compact('roles', 'state'));
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
