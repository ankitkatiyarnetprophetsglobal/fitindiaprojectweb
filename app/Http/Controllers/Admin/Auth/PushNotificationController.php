<?php

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\PushNotification;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Exports\UserExport;
use App\Models\Admin;
use App\Models\Role;

use Barryvdh\Debugbar\Facades\Debugbar;

class PushNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $pushnotification =PushNotification::select('id','message_file','message_title','message_description')->orderBy('id','desc')->get();
        $pushnotification_count = count($pushnotification);
		$success = '';
        $failure = '';
        return view('admin.pushnotification.index',compact('pushnotification','pushnotification_count','success','failure'));


    }

    public function store(Request $request)
    {
		// dd($request->all());
        $image = '';
        $year = date("Y/m");
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }

        $request->validate([
            'title' => 'required',
            // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required',
        ],[
			'title.required' => 'Meassage Title field is required.',

			'description.required' => 'The  Description field is required.',
			// 'image.required' =>'Image field is required.',
			// 'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
			// 'image.max' => 'Image size should not be more than 2 MB',

		]);
        $post = new PushNotification;
        $post->message_file = $image;
        $post->message_title = $request->title;

        $post->message_description = $request->description;
        $post->save();

        return redirect()->route('admin.pushnotification.index')
        ->with('success','Post has been created successfully.');
    }




    public function create()
    {

        return view('admin.pushnotification.create');
    }

    public function show(Request $request,$id)
    {
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

			  $user = $user->where('users.role', 'LIKE', "%".$request->role."%");
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

			  $user = $user->where('users.role', 'LIKE', "%".$request->role."%");
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



        $post = PushNotification::findOrFail($id);
        return view('admin.pushnotification.show', compact('post','user','states','districts','blocks','count','admins_role','curcount','flag','roles','stateadmin'));
        
    }

    public function edit($id)
    {

        $post = PushNotification::findOrFail($id);
        return view('admin.pushnotification.edit',compact('post'));
    }

    public function update(Request $request, $id)
    {
        $image = '';
        $year = date("Y/m");

         /*$request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required'
         ]);*/

		$request->validate([
            'title' => 'required',

            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required',
        ],[
			'title.required' => 'Title field is required.',


			'image.mimes' => 'Please upload jpg,png,jpeg,gif,svg',
			'image.max' => 'Please upload max  2048 file',
			'description.required' => 'The block field is required.',
		]);

        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
        $post = PushNotification::find($id);
        $push_image=PushNotification::where('id',$id)->select('message_file')->get();

        if($request->file('image')==null){
            $post->message_file =json_decode($push_image,true)[0]['message_file'];
        }else{
        $post->message_file = $image;
        }
        $post->message_title = $request->title;

        $post->message_description = $request->description;
        $post->save();

        //PostCat::whereId($id)->update($data);

        return redirect('admin/pushnotification')->with(['status' => 'success' , 'msg' => 'Push Notification Update Successfully']);
    }
    public function destroy(Request $request,$id)
    {
        $data=\App\Models\PushNotification::find($id);
      $data->delete();
       return redirect()->route('admin.pushnotification.index')
        ->with('success','Push Notification deleted successfully');
    }

}
