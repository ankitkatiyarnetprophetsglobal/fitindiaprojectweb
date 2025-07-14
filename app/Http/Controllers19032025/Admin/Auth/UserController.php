<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Exports\UserExport;
use Excel;
use PDF;
use App\Models\Admin;
use App\Models\Role;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
    
    public function index(Request $request){
		
		//$states = State::orderBy('name')->get();
		//$roles = Role::all();
		
		$states = State::orderBy("name")->get(); 
		$roles = Role:: orderBy("name")->get(); 	
		
		$admins_role = Auth::user()->role_id;
		$flag=0;
		
		$stateadmin = "";
		if($admins_role == '3')
		{
			
			$admins_state = Auth::user()->state;
		    $stateadmin = State::where('id',$admins_state)->first()->name;
			//$chk_stateadmin = State::where('id',$admins_state)->first()->name;			
			if(!empty($admins_state)){
				$statesid = $admins_state;
				$districts = District:: where('state_id', $statesid)->orderBy("name")->get();            
			}else{ 
				$districts = District::orderBy("name")->get();
			}

			if(!empty($admins_state) && !empty($request->district)){
				$disid = District:: where('name', 'like', $request->district)->first()->id;			
				$blocks = Block:: where('district_id', $disid)->orderBy("name")->get();
			} else{
				$blocks = Block::orderBy("name")->get();          
			} 
			
		    if($request->input('searchdata') == 'searchdata'){  //    	
			  $user = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->orderBy('users.id','desc')
				->where('usermetas.state', '=' ,$stateadmin);
				
				 
            if(!empty($request->state))
            {
				$user = $user->where('usermetas.state', 'LIKE', "%".$request->state."%");
            }
            
            if($request->district)
            {
				$user = $user->where('usermetas.district', 'LIKE', "%".$request->district."%");
			}
            
            if($request->block)
            {
				$user = $user->where('usermetas.block', 'LIKE', "%".$request->block."%");   
            }
			
            if($request->month)
            {
				$user = $user->where('users.created_at', 'LIKE', "%".$request->month."%");
			}
			
			if($request->role=='Mobile')
            {
			  $user = $user->where('users.rolelabel', null); 
			  
            } else if($request->role!='Mobile'){
				
			//   $user = $user->where('users.role', 'LIKE', "%".$request->role."%");	
				if(request()->input('role') == 'cyclothon-2024'){
				
					$user = $user->where('users.rolewise', 'LIKE', "%".$request->role."%");	

				}else{

					$user = $user->where('users.role', 'LIKE', "%".$request->role."%");	

				}
			}
			
			/* if($request->role)
            {
				$user = $user->where('users.role', 'LIKE', "%".$request->role."%");   
            } */
			
			$curcount = $user->count();			
			$user = $user->paginate(50);
			$flag=1;
			
            $count =  DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->orderBy('users.id','desc')
				->where('usermetas.state', '=' ,$stateadmin)
				->count();
			
		 } else if($request->input('search')=='search'){
			 
			$user = DB::table('users')
					->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
					->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
					->where('usermetas.state', '=' ,$stateadmin);				

            if($request->user_name){  
					$user = $user->where('users.email', 'LIKE', "%".$request->user_name."%")
								->orWhere('users.name', 'LIKE', "%".$request->user_name."%")
								->orWhere('users.phone', 'LIKE', "%".$request->user_name."%");
              
            }
			
			$curcount = $user->count();			
			$user = $user->paginate(50);
			$flag=1;
			
            $count =  DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->where('usermetas.state', '=' ,$stateadmin);
			
			$count = $user->count();
				
            } else {    
		  
			  $user = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->orderBy('users.id','desc')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->where('usermetas.state', '=' ,$stateadmin);
					
				$curcount = 0;
				$count = $user->count();
				$user = $user->paginate(50);				
				$flag=1;
            }			
		}
		
		else {
			
			if(!empty($request->state)){
              $statesid = State:: where('name', 'like', '%'.$request->state.'%')->first()->id;
              $districts = District:: where('state_id', $statesid)->orderBy("name")->get();            
			}else{ 
			  //$districts = District::all();
			  $districts = District::orderBy("name")->get();
			}

			if(!empty($request->state) && !empty($request->district)){
               $disid = District:: where('name', 'like', $request->district)->first()->id;			
               $blocks = Block:: where('district_id', $disid)->orderBy("name")->get();
			} else{
			   $blocks = Block::orderBy("name")->get();           
			} 
			
			if($request->input('searchdata')== 'searchdata'){     
     	
			  $user = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				// ->Join('usermetas','users.id', '=',	'usermetas.user_id')
				->orderBy('users.id','desc')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at']);
				
				 
            if(!empty($request->state))
            {
				$user = $user->where('usermetas.state', 'LIKE', "%".$request->state."%");
            }
            
            if($request->district)
            {
				$user = $user->where('usermetas.district', 'LIKE', "%".$request->district."%");
			}
            
            if($request->block)
            {
				$user = $user->where('usermetas.block', 'LIKE', "%".$request->block."%");   
            }
			
			//if($request->role=='Mobile')
			
			if(!empty($request->role)&& $request->role=='Mobile')			
            {
			  $user = $user->where('users.rolelabel', null); 
			  
            } else if(!empty($request->role)&& $request->role!='Mobile'){		
				
			//   $user = $user->where('users.role', 'LIKE', "%".$request->role."%");	
				if(request()->input('role') == 'cyclothon-2024'){
					
					$user = $user->where('users.rolewise', 'LIKE', "%".$request->role."%");	

				}else{

					$user = $user->where('users.role', 'LIKE', "%".$request->role."%");	

				}
			}
			
			/* if($request->role)
            {
				$user = $user->where('users.role', 'LIKE', "%".$request->role."%");   
            } */
			
            if($request->month)
            {
				$user = $user->where('users.created_at', 'LIKE', "%".$request->month."%");
			}
			
			$curcount = $user->count();						
			$user = $user->paginate(50);
			$flag=1;
			
            $count =  DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->count();
			
		  } else if($request->input('search')=='search'){ 
            
              $user = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->orderBy('users.id','desc')
				->where('users.email', 'LIKE', "%".$request->user_name."%")
                ->orWhere('users.name', 'LIKE', "%".$request->user_name."%")
				->orWhere('users.phone', 'LIKE', "%".$request->user_name."%");
				
			 
			 $user = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->orderBy('users.id','desc')
				->where('users.email', 'LIKE', "%".$request->user_name."%")
                ->orWhere('users.name', 'LIKE', "%".$request->user_name."%")
				->orWhere('users.phone', 'LIKE', "%".$request->user_name."%");
				
				$curcount = $user->count();				
				$user = $user->paginate(50);              
                $flag=1;
				
				$count =  DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->count();
			
            } else { 
        
			$user = DB::table('users')				
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->orderBy('users.id','desc')
				->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at']);
				
				$count = $user->count();
				$user = $user->paginate(50);
				$flag=0;
				$curcount = 0;
             }			
		 }
			
         return view('admin.user.index', compact('user','states','districts','blocks','count','admins_role','curcount','flag','roles','stateadmin'));
    }         


    public function show($id)
    {
       
    }
    
    public function editUser($id){    
        $state = State::orderBy("name")->get(); 
        $district = District::orderBy("name")->get(); 
        $block = Block::orderBy("name")->get(); 
        		
        //$role = User::where('id', $id)->first();
        //print_r($id);
        //exit();
       
        $result = DB::table('users')                        
				->leftJoin('usermetas','users.id', '=','usermetas.user_id')                           
				->select(['users.id as id','users.password','users.email','users.name','usermetas.user_id','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.pincode'])
				->where('users.id',$id)
				->get();                   
            // return $result;         
               return view('admin.user.edit',compact('state','result','district','block'));
    }
    
    public function update(Request $request , $id){
		
		
		if(!empty($request->password )){
			
			$request->validate([
			'password' => ['required','string','min:8','max:15','regex:/[a-z]/',
				'regex:/[A-Z]/',
				'regex:/[a-z]/',
				'regex:/[0-9]/',
				'regex:/[@$!%*#?&]/','confirmed']
			]);
		
			$users  = User::find($id);
			$users->password = Hash::make($request->password);
			$users->save();
			
		} else {
			
         $request->validate([
            'name' => 'required|string',
            'phone' => 'required|digits:10',
            'state' => 'required|string',
            'district' => 'required|string',
            'block' => 'required|string',
            'city' => 'required|string',            
        ],[
            'name.required' => 'The user name field is required.',
            'phone.required' =>'Mobile field is required.',
			'phone.digits' =>'Mobile field must have 10 digit.',
            'state.required' => 'The state field is required.',
            'district.required' => 'The district field is required.',
            'block.required' => 'The block field is required.',
            'city.required' => 'The city field is required.',
         ]	
		);
		
		
			$states = State::where('id',$request->state)->first();
			$districts = District::where('id',$request->district)->first();
			$blocks = Block::where('id',$request->block)->first();
			
			
			$users  = User::find($id);
			$users->name = $request->name;
			$users->phone = $request->phone;
			$users->save();
			
			$usermetas = Usermeta::where('user_id',$id)->first();
			$usermetas->pincode = $request->pincode;
			$usermetas->state = $states->name;
			$usermetas->district = $districts->name;
			$usermetas->block = $blocks->name;
			$usermetas->orgname = $request->organisationname;
			$usermetas->city = $request->city;
			$usermetas->save();
		}
        return back()->with('success','User updated successsfully');
        

 
    }
	
	

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id){
        //return $id;
		$user = User::findOrFail($id);
		User::where('id', $id)->delete();	 
		//$usermetas = User::where('id', $user->id)->get();		
		DB::table('usermetas')->where('user_id', $id)->delete();	  
			  
		/*$user = User::findOrFail($id);	     
		//$usermeta = Usermeta::where('user_id',$uid)->first();        
		$user->usermeta()->delete();
		//$user->user()->delete();
		//$usermeta->usermeta()->delete();*/
		
		return redirect('admin/users')->with(['status' =>'success','msg' => 'successfully deleted']);
    }


	 public function userExport()
    {

        if(request()->has('uname'))
        {
           
          return Excel::download(new UserExport,'userlist.xlsx');

        }
	    
        else if(request()->has('st'))
       {


          return Excel::download(new UserExport,'userlist.xlsx');

       }
       else if(request()->has('dst'))
       {



          return Excel::download(new UserExport,'userlist.xlsx');

       }
       else if(request()->has('blk'))
       {


          return Excel::download(new UserExport,'userlist.xlsx');

       }
       else if(request()->has('month'))
       {



          return Excel::download(new UserExport,'userlist.xlsx');

       }
	   else if(request()->has('role'))
       {



          return Excel::download(new UserExport,'userlist.xlsx');

       }
       
        else
         {

          return Excel::download(new UserExport,'userlist.xlsx');
       }

        

    }
	 public function createPDF()
	 {
      
				$result = DB::table('users')
                        ->join('usermetas','users.id', '=',
                            'usermetas.user_id')
                        ->get(['users.id','users.email','users.name','users.role','usermetas.mobile','usermetas.city','usermetas.state','usermetas.district','usermetas.block']);

      
      
      $pdf = PDF::loadView('admin.user.index', compact('result'))->setOptions(['defaultFont' => 'sans-serif']);

      
      return $pdf->download('pdf_file.pdf');
    }
	


    public function userprofileDis()
    {
        $state_id = $request->id;
        $district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
        $district = '<option value="">Select District</option>';
        if(!empty($district_list)){
            foreach ($district_list as $dist) {
               $district .= '<option value="'.$dist['id'].'">'.$dist['name'].'</option>';
            }
        }
        return $district;
    }
    public function userprofileBlk()
    {
        $block_id = $request->id;
        $block_list = Block::where('district_id', $block_id)->get();
        $block = '<option value="">Select Block</option>';
        if(!empty($block_list)){
            foreach ($block_list as $bck) {
               $block .= '<option value="'.$bck['id'].'">'.$bck['name'].'</option>';
            }
        }
        return $block;

    }
	
	
	public function resetpassForm(){
        return view('admin.resetpassword');
    }
	public function resetPassword(Request $request)
	{
		
		
		$request->validate([
		'password' => ['required','string','min:8','max:15','regex:/[a-z]/',

        'regex:/[A-Z]/',

        'regex:/[a-z]/',

        'regex:/[0-9]/',

        'regex:/[@$!%*#?&]/','confirmed',]
		]);
		 
		Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
		return back()->with('success','Password updated successsfully');
		
	}
	
}
    












