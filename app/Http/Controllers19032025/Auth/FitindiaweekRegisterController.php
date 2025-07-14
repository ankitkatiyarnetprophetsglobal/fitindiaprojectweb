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
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

class FitindiaweekregisterController extends Controller
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
		$success = "Your Registration Done Sucessfully, please login";
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

	public function showRegistrationForm()
	{
		// dd(131233131313231);
		//$roles = Role::where('groupof',0)->get();
		$roles = Role::where('groupof', 1)
			->whereNotIn('slug', ['champion', 'smambassador', 'sai_user', 'author', 'gmambassador', 'caadmin', 'gram_panchayat', 'lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();
		$districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();

		$blocks = Block::whereStatus(true)->orderBy('name', 'ASC')->get();
		// dd($blocks->toArray());
		$state = State::whereStatus(true)->orderBy('name', 'ASC')->get();

		return view('auth.register', compact('roles', 'state', 'districts', 'blocks'));
	}

	protected function validator(array $data)
	{
		//dd($data);//mobile phone		 
		if ($data['role'] == 'school') {
			//echo "aaaa";die;
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
					'captcha' => 'required|captcha',
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
					'captcha.required' => 'Captcha field is required.',
					'captcha.captcha' => 'Please fill correct value.',
				]
			);
		} else {

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
					'captcha' => 'required|captcha',
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
					'captcha.required' => 'Captcha field is required.',
					'captcha.captcha' => 'Please fill correct value.',
				]
			);
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

	protected function create(array $data)
	{
		//dd($data);
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
	public function imgaeshow(Request $request){
		dd(12312312313132131);
	}
}
