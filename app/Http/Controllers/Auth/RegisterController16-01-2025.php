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


	public function register(Request $request)
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

	public function showRegistrationForm(Request $request)
	{
		$role_name = $request->input('role');
		// dd($role_name);
		// dd('its here you');
		//$roles = Role::where('groupof',0)->get();
		// echo $encode = base64_encode($role_name);
		// echo '<br/>';
		// echo base64_decode($encode);
		// exit;
		if($role_name == 'bmFtby1maXQtaW5kaWEteW91dGgtY2x1Yg=='){
			// dd(123);
			$roles = Role::where('groupof', 0)
			->where('slug','=','namo-fit-india-youth-club')
			->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();
			// dd($roles);

		}else if($role_name == 'bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi'){

			$roles = Role::where('groupof', 0)
			->where('slug','=','namo-fit-india-cycling-club')
			->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();
			// dd($roles);
		
		}else if($role_name == 'Y3ljbG90aG9uLTIwMjQ='){

			$roles = Role::where('groupof', 0)
			->where('slug','=','cyclothon-2024')
			->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();
			// dd($roles);

		}else{

			$roles = Role::where('groupof', 1)
				->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();

		}
		$districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

		$blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
		// dd($blocks->toArray());
		$state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

		return view('auth.register', compact('roles', 'state', 'districts', 'blocks'));
	}


	public function cyclothonshowRegistrationForm(Request $request){
		try{
			// dd("cyclothonshowRegistrationForm");
			$role_name = "cyclothon-2024";
			// if($role_name == 'Y3ljbG90aG9uLTIwMjQ='){

				$roles = Role::where('groupof', 0)
				->where('slug','=',$role_name)
				->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();
				// dd($roles);
	
			// }
			// $districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

			// $blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
			// dd($blocks->toArray());
			$state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

			// return view('auth.cyclothonregister', compact('roles', 'state', 'districts', 'blocks'));
			return view('auth.cyclothonregister', compact('roles', 'state'));
			
		}catch (Exception $e) {
			return abort(404);
		}
	}

	protected function validator(array $data)
	{
        // dd($data['role']);
		try{
			if(!empty($data)){

                // $role_name = base64_decode($data['role_name']);
                $role_name = $data['role'];
				if($role_name == "cyclothon-2024"){

					return Validator::make(
						$data,
						[
							'cyclothonrole' => 'required|string|max:255',
							'name' => 'required|string|max:255',
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
							'cycle' => 'required',							
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
							'cycle.required' => 'Please select cycle type.',
							'captcha.required' => 'Captcha field is required.',
							// 'captcha.captcha' => 'Please fill correct value.',
						]
					);

				}else if($role_name == 'namo-fit-india-youth-club' || $role_name == "namo-fit-india-cycling-club"){
                    // dd(222);
                    return Validator::make(
						$data,
						[
							'name' => 'required|string|max:255',
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

                }else if ($data['role'] == 'school') {
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
			}else{
				return abort(404);
			}
		}catch (Exception $e) {
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
        if($role_name == 'namo-fit-india-youth-club' || $role_name == "namo-fit-india-cycling-club" || $role_name == "cyclothon-2024"){

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
            $records = User::where('id',$records->id)
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
                                    ]);
        }else{
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
        // $role_name = base64_decode($data['role_name']);
        $role_name = $data['role'];
		// dd($role_name);
		if($role_name == "cyclothon-2024"){
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
					]);
					// dd($role_name);
					// dd($records->user_id);
					$rolearr = Role::where('slug', $data['role'])->select('id', 'slug', 'name')->first();
					// $update = User::where('id',$records->id)
					$update = User::where('id',$records->user_id)
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
											]);

					// $records1 = DB::table('usermetas')
					// ->where([
					// 	['user_id', '=', $records->id]
					// ])
					// ->first();
					// dd($records);
					if (!$data['participant_number']){
						$data['participant_number'] = null;
					}
					$records_update = Usermeta::where('id',$records->id)
									->update(
											[
												'cycle' => $data['cycle'],												
												'cyclothonrole' => $data['cyclothonrole'],												
												'participant_number' => $data['participant_number']											
											]);
					
			}else{

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
					if (!empty($state['name'])) $usermeta->state = $state['name'];
					if (!empty($district['name'])) $usermeta->district = $district['name'];
					if (!empty($block['name'])) $usermeta->block = $block['name'];
					if (!empty($data['city'])) $usermeta->city = $data['city'];
					if (!empty($data['udise'])) $usermeta->udise = $data['udise'];
					if (!empty($data['phone'])) $usermeta->mobile = $data['phone'];
					if (!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];
					if (!empty($data['cycle'])) $usermeta->cycle = $data['cycle'];
					if (!empty($data['cyclothonrole'])) $usermeta->cyclothonrole = $data['cyclothonrole'];
					if (!empty($data['participant_number'])) $usermeta->participant_number = $data['participant_number'];

					$usermeta->save();
				}

			}

		}elseif($role_name == 'namo-fit-india-youth-club' || $role_name == "namo-fit-india-cycling-club" ){

            $records = DB::table('users')
                        ->where([
                            ['users.email', '=', $data['email']]
                        ])
                        ->first();
            
            if (!empty($records)) {
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
					$records = User::where('id',$records->id)
									->update(
											[
												'name' => $data['name'],
												'email' => $data['email'],
												'phone' => $data['phone'],
												'role' =>  $data['role'],
												'rolelabel' => $rolearr['name'],
												'role_id' => $rolearr['id'],
												'password' => Hash::make($data['password']),
												'updated_at' => date("Y-m-d h:i:s")
											]);
			}else{

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
        }else{
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
