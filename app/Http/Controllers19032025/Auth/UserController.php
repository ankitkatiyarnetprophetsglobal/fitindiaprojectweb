<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\State;
Use App\Models\District;
use App\Models\Block;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\EventCat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Schoolmeta;
use App\Models\Board;
use App\Models\Chainopt;
use App\Models\Eventactivitydropdowns;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index(){
	// 	$role = Auth::user()->role;
    //     if(!empty($role)){
    //         $role = Role::where('slug', $role)->first()->name ?? '';
    //         return view('auth.dashboard', ['role' => $role ]);
    //     }
    //     return view('auth.dashboard');
    // }
	public function index()
    {
		// freedom-run-2.0
		try{
			// dd('12313223313');
			if(isset(Auth::user()->role)){
				$role = Auth::user()->role;
				$a_id = Auth::user()->id;
				if (Auth::check()){
					// $categories = EventCat::all();
					$categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
					$userdata = user::with('usermeta')->find($a_id);
					$state = State::whereStatus(true)->orderBy('name', 'ASC')->get();
					if(!empty($userdata)){
						/*
						if($role=='subscriber'){
						return redirect('dashboard');
						}else{
							return view('freedomrun.freedom-add-organization-event', ['role' => $role , 'userdata' => $userdata,'categories'=> $categories ]);
						}
						*/
						//  return view('freedomrun.freedom-add-organization-event', ['role' => $role , 'userdata' => $userdata,'categories'=> $categories ]);
						// return view('fitIndiaSchoolWeek2022.school_2022-add-organization-event', ['state'=> $state,'role' => $role , 'userdata' => $userdata,'categories'=> $categories ]);
						$eventactivitydropdowns = Eventactivitydropdowns::where('status',1)->orderBy('id', 'DESC')->get();
						return view('event.add-organization-event', ['state'=> $state,'role' => $role , 'userdata' => $userdata,'categories'=> $categories, 'eventactivitydropdowns'=> $eventactivitydropdowns, ]);
					}else{
						abort(404);
					}
				}else{
					abort(404);
				}
			}else{

				return redirect('/login');

			}
		}catch (Exception $e) {

			return abort(404);

		}
		// old code
		// $role = Auth::user()->role;
        // if(!empty($role)){
        //     $role = Role::where('slug', $role)->first()->name ?? '';
        //     return view('auth.dashboard', ['role' => $role ]);
        // }
        // return view('auth.dashboard');

    }


    //public function editProfile($id){

     public function editProfile(Request $request){

		try{
			if(isset(Auth::user()->role)){

				$state = State::all();
				$district = District::all();
				$block = Block::all();
				$role = Auth::user()->role;

				$uid=Auth::user()->id;

				if(!empty($role)){
				$role = Role::where('slug', $role)->first()->name ?? '';
				}

				$result = DB::table('users')
					->leftJoin('usermetas','users.id', '=', 'usermetas.user_id')
					->select(['users.id','users.email','users.name','users.role','users.rolelabel','usermetas.user_id','usermetas.orgname','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.pincode'])
					->where('users.id',$uid)
					->first();

				return view('auth/edit-profile',compact('role','state','result','district','block','uid'));

			}else{

				return redirect('/login');

			}

		}catch (Exception $e) {

			return abort(404);

		}
    }

    public function update(Request $request , $id)
    {
        /*$request->validate([
            'name' => 'required|string',
            'user_id' => 'required',
            'phone' => 'required|digits:10',
            'pincode' => 'required|numeric',
            'state' => 'required|string',
            'district' => 'required|string',
            'block' => 'required|string',
            'city' => 'required|string',
			'captcha' => 'required|captcha',
        ]);*/
		/*'captcha' => ['required', 'captcha'],*/  // orgname
		try{
			if(isset(Auth::user()->role)){
				$request->validate([
					'name' => 'required|string',
					'user_id' => 'required',
					'phone' => 'required|digits:10',
					'pincode' => 'required|numeric',
					'state' => 'required|string',
					'district' => 'required|string',
					'block' => 'required|string',
					'city' => 'required|string',
					'captcha' => 'required|captcha',
				],[
					'name.required' => 'The user name field is required.',
					'user_id.required' => 'The user id field is required.',
					'phone.required' =>'Mobile field is required.',
					'phone.digits' =>'Mobile field must have 10 digit.',
					'pincode.required' => 'The pincode field is required.',
					'pincode.numeric' => 'The pincode field must have digit.',
					'state.required' => 'The state field is required.',
					'district.required' => 'The district field is required.',
					'block.required' => 'The block field is required.',
					'city.required' => 'The city field is required.',
					'captcha.required' => 'The captcha field is required.',
					'captcha.captcha' => 'Invalid captcha',
				]
				);


				$states = State::where('id',$request->state)->first();
				$districts = District::where('id',$request->district)->first();
				$blocks = Block::where('id',$request->block)->first();

				$users = User::find($id);
				$usermetas = Usermeta::where('user_id',$id)->first();

				$users->name = $request->name;
				$users->phone = $request->phone;
				$usermetas->pincode = $request->pincode;
				$usermetas->state = $states->name;
				$usermetas->district = $districts->name;
				$usermetas->block = $blocks->name;
				//$usermetas->orgname = $request->orgname;
				$usermetas->city = $request->city;
				$usermetas->user_id = $request->user_id;
				$users->save();
				$usermetas->save();
				return back()->with('success','User updated successsfully');

			}else{

				return redirect('/login');

			}
		}catch (Exception $e) {

			return abort(404);

		}
    }

	//public function schoolProfile(Request $request,$id){

     public function schoolProfile(Request $request){
		try{
			if(isset(Auth::user()->role)){
				$uid=Auth::user()->id;
				$states = State::orderby('name')->get();
				$boards = Board::orderby('boardname')->get();
				$chainopts = Chainopt::all();
				$role = Auth::user()->role;
				//$districts = District::all();
				//$blocks = Block::all();
				if(!empty($request->state)){
					$statesid = State:: where('name', 'like', '%'.$request->state.'%')->first()->id;
					$districts = District:: where('state_id', $statesid)->orderby('name')->get();
					}else{
					$districts = District::orderby('name')->get();
					}

					if(!empty($request->state) && !empty($request->district)){
					$disid = District:: where('name', 'like', $request->district)->first()->id;
					$blocks = Block:: where('district_id', $disid)->orderby('name')->get();
					} else{
					$blocks = Block::orderby('name')->get();
					}
				if(!empty($role)){
					$role = Role::where('slug', $role)->first()->name;
				}
				//$school = Schoolmeta::all();
				//DB::enableQueryLog();

				$result = DB::table('users')->leftJoin('usermetas','users.id', '=','usermetas.user_id')
								->leftJoin('schoolmetas','users.id', '=', 'schoolmetas.user_id')
								->select(['users.id','users.email','users.name','users.role','usermetas.user_id','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.pincode'
								,'usermetas.board','usermetas.orgname','usermetas.udise','usermetas.address','schoolmetas.affiliationnum','schoolmetas.chain','schoolmetas.region','schoolmetas.landmark','schoolmetas.students','schoolmetas.pname','schoolmetas.pmobile'])
								->where('users.id',$uid)
								->first();

					//dd(DB::getQueryLog());

				return view('auth.school-profile',compact('role','boards','chainopts','states','districts','blocks','result','uid'));
			}else{

				return redirect('/login');

			}

		}catch (Exception $e) {

			return abort(404);

		}

	}

	public function updateSchool(Request $request,$id)
	{

		/* $request->validate([
            'name' => 'required|string',
            'user_id' => 'required',
            'pincode' => 'required|numeric',
            'state' => 'required|string',
            'district' => 'required|string',
            'block' => 'required|string',
            'city' => 'required|string',
			'students' => 'required|numeric',
			'principalname' => 'required',
			'principalmobile' => 'required|digits:10',
			'affiliationnum' => 'required|string|min:4|max:10|regex:/[0-9]/',
			'udise' => 'required|digits:11',
			'phone' => 'required|digits:10',
			'board' => 'required|string',
			'landmark' => 'required|string',
			'address' => 'required',
			'captcha' => 'required|captcha',
        ]); */
		//students
		try{
			if(isset(Auth::user()->role)){
				$this->validate($request,[
					'name' => 'required|string',
					'user_id' => 'required',
					'pincode' => 'required|numeric',
					'state' => 'required|string',
					'district' => 'required|string',
					'block' => 'required|string',
					'city' => 'required|string',
					'students' => 'required|numeric',
					'principalname' => 'required',
					'principalmobile' => 'required|digits:10',
					'affiliationnum' => 'required|string|min:4|max:10|regex:/[0-9]/',
					'udise' => 'required|digits:11',
					'phone' => 'required|digits:10',
					'board' => 'required|string',
					'landmark' => 'required|string',
					'address' => 'required',
					'captcha' => 'required|captcha',
					],[
						'name.required' => ' The School Name field is required.',
						'user_id.required' => 'User ID field is required.',
						'pincode.required' => 'No. of Students field is required.',
						'pincode.numeric' => 'Please enter pincode numeric value only.',
						'state.required' => 'State field is required.',
						'district.required' => 'District field is required.',
						'block.required' => 'Block field is required.',
						'city.required' => 'City field is required.',
						'students.required' => 'No. of Students field is required.',
						'students.numeric' => 'Please enter No. of Students numeric value only.',
						'principalname.required' =>'Principal Name field is required.',
						'principalmobile.required' =>'Principal Mobile field is required.',
						'principalmobile.digits' =>'Please enter 10 digit Principal Mobile Number.',
						'affiliationnum.required' =>'Board Affiliation Number is required.',
						'affiliationnum.min' => 'Board Affiliation Number must be min 4 Number.',
						'affiliationnum.max' => 'Board Affiliation Number must be max 10 Number.',
						'udise.required' => 'Udise Number field is required.',
						'udise.digits' => 'Udise Number must have 11 digit.',
						'phone.required' => 'Mobile Number is required.',
						'phone.digits' => 'Please enter 10 digit  Mobile Number.',
						'board.required' => 'Board field is required.',
						'landmark.required' => 'Landmark is required.',
						'address.required' => 'Address field is required.',
						'captcha.required' => 'Captcha field is required.',
						'captcha.captcha' => 'Please fill captcha correct value.',
					]);

				$states = State::where('id',$request->state)->first();
				$districts = District::where('id',$request->district)->first();
				$blocks = Block::where('id',$request->block)->first();
				$boards = Board::where('id',$request->board)->first();
				$chains = Chainopt::where('id',$request->chain)->first();

				$users  = User::find($id);

				$usermetas = Usermeta::where('user_id',$id)->first();
				$schoolmetas = Schoolmeta::where('user_id',$id)->first();

				if(empty($schoolmetas)){
					$schoolmetas = new Schoolmeta();
					$users->name = !empty($request->name) ? $request->name : '';
					$users->phone = $request->phone;
					$users->save();

					$usermetas->pincode = $request->pincode;
					$usermetas->state = $states->name;
					$usermetas->district = $districts->name;
					$usermetas->block = $blocks->name;
					$usermetas->udise = $request->udise;
					$usermetas->city = $request->city;
					$usermetas->user_id = $request->user_id;
					$usermetas->board = !empty($boards->boardname) ? $boards->boardname : '';
					$usermetas->address = $request->address;
					$usermetas->save();//boardname

					$schoolmetas->students = $request->students;
					$schoolmetas->pname = $request->principalname;
					$schoolmetas->pmobile = $request->principalmobile;
					$schoolmetas->landmark = $request->landmark;
					$schoolmetas->region = !empty($request->region) ? $request->region : '';
					$schoolmetas->chain = !empty($request->chainname) ? $request->chainname : '';
					$schoolmetas->affiliationnum = $request->affiliationnum;
					$schoolmetas->user_id = $request->user_id;
					$schoolmetas->save();

				}else{

					$users->name = $request->name;
					$users->phone = $request->phone;
					$users->save();

					$usermetas->pincode = $request->pincode;
					$usermetas->state = $states->name;
					$usermetas->district = $districts->name;
					$usermetas->block = $blocks->name;
					$usermetas->udise = $request->udise;
					$usermetas->city = $request->city;
					$usermetas->user_id = $request->user_id;
					$usermetas->board = !empty($boards->boardname) ? $boards->boardname : '';
					$usermetas->address = $request->address;
					$usermetas->save();

					$schoolmetas->update(['students' => $request->students,'pname' => $request->principalname,
					'pmobile' => $request->principalmobile,
					'landmark' => $request->landmark,
					'region' => !empty($request->region) ? $request->region : '',//$request->region,
					'chain' => !empty($chains->chainname) ? $chains->chainname : '', //$chains->chainname,
					'affiliationnum' => $request->affiliationnum,
					'user_id' => $request->user_id,
					]);
				}

				return back()->with('success','School updated successsfully');
			}else{

				return redirect('/login');

			}
		}catch (Exception $e) {

			return abort(404);

		}

	}

    public function profileDis(Request $request)
    {
		try{
			if(isset(Auth::user()->role)){
        		$state_id = $request->id;
				$district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
				$district = '<option value="">Select District</option>';
				if(!empty($district_list)){
					foreach ($district_list as $dist) {
					$district .= '<option value="'.$dist['id'].'">'.$dist['name'].'</option>';
					}
				}
				return $district;
			}else{

				return redirect('/login');

			}
		}catch (Exception $e) {

			return abort(404);

		}
    }
    public function profileBlk(Request $request)
    {
		try{

			if(isset(Auth::user()->role)){
				$block_id = $request->id;
				$block_list = Block::where('district_id', $block_id)->get();
				$block = '<option value="">Select Block</option>';
				if(!empty($block_list)){
					foreach ($block_list as $bck) {
					$block .= '<option value="'.$bck['id'].'">'.$bck['name'].'</option>';
					}
				}
				return $block;
			}else{
				return redirect('/login');

			}

		}catch (Exception $e) {

			return abort(404);

		}

    }

}
