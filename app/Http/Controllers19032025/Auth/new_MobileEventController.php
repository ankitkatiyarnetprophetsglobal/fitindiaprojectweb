<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response,Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventCat;
use App\Models\Ambassador;
use App\Models\Champion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Schoolquiz;
use App\Models\GramPanchayat;
use App\Models\LocalBody;
use App\Models\Freedomrun;
use App\Models\SchoolWeek;
class MobileEventController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }	
	
	public function schoolQuiz(){
		$auth_id = @$_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
	        $role = $user->role;
			if(!empty($user)){
	            $events = Event::where( 'user_id', $user->id )->get();
				$role = Role::where('slug', $role)->first()->name;
	            return view('event_mobile.school-quiz', ['role' => $role , 'events' =>$events]);
	        }else{
	        	abort(404);
	        }
    	}else{
    		abort(404);
    	}
	}	
	
	public function saveQuiz(Request $request){	
        //dd($request);die;			
		$request->validate([
           'captcha' => 'required|captcha',
		   'terms' => 'required'
        ],
		[
		 'captcha.required' => 'Captcha is required.',
		 'captcha.captcha' => 'Please inter valid captcha.'
		]);
		
		$cnt = $request->noofstud;
        
        for($i=0; $i<$cnt; $i++){
           
            $image = '';
            $year = date("Y/m"); 

            
            if(!empty($request->file('image')[$i]))
            {
                $image = $request->file('image')[$i]->store( $year,['disk'=> 'uploads']);
                $image = url('wp-content/uploads/'.$image);
            }
			
            $schoolquiz[] = [
				'user_id' => Auth::user()->id,
				'studentname' => $request->studentname[$i],
				'mobile' => $request->mobile[$i],
				'class' => $request->class[$i],
				'age' => $request->age[$i],
				'email' => $request->email[$i],
				'image' => $image,
				'gender' => $request->gender[$i][0],          
            ];           
        }		 
		 
		 Schoolquiz::insert($schoolquiz);
		 
		 return back()->with('message','Nomination of students received');
        
       
	}
	
    public function createevent()
    { 
    	$auth_id = $_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
		    $role = $user->role;
			if(!empty($user)){
	            $categories = EventCat::all();
	            $role = Role::where('slug', $role)->first()->name;
	            return view('event_mobile.create_event', ['role' => $role , 'categories' => $categories,'user'=>$user]);
	        }
	        return view('event_mobile.create_event');
    	}
    }

    public function myevents()
    {
        $auth_id = @$_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
	        $role = $user->role;
			if(!empty($user)){
	        /*	$freedom_events = Freedomrun::where('user_id', Auth::user()->id)->get();  */
	            //$events = Event::where( 'user_id', Auth::user()->id )->get();
	        	$events = Event::where( 'user_id', $user->id )->whereDate('created_at', '<=', '2021-10-1 00:00:01')->get();
				$role = Role::where('slug', $role)->first()->name;
	            return view('event_mobile.my_event', ['role' => $role , 'events' =>$events, 'year'=>'2020']);
        	}else{
        		abort(404);
        	}
    	}else{
    		abort(404);
    	}
        //return view('event.my_event');
    }
    public function myEventsByYear($year)
    {
		 $auth_id = @$_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
	        $role = $user->role;
			if(!empty($user)){
				$freedom_events = SchoolWeek::where('user_id', Auth::user()->id)->where('category', 13061)->orderBy('id', 'DESC')->get();  
				$role = Role::where('slug', $role)->first()->name;
				return view('fitIndiaSchoolWeek2022.school-events', ['role' => $role, 'freedom_event' =>$freedom_events, 'year'=>'22']);
                // $events = Event::where( 'user_id', $user->id )->where('category','13052')->whereDate('created_at', '>=', '2021-10-30 00:00:01')->get();
				// $role = Role::where('slug', $role)->first()->name;
	            // return view('event_mobile.my_event', ['role' => $role , 'events' =>$events,'year'=>'2021']);
	        }else{
	        	abort(404);
	        }
	    }else{
	    	abort(404);
	    }
    	//return view('event.my_event');
    }
	
	public function eventspic()
    {
		$auth_id = @$_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
	        $role = $user->role;
			if(!empty($user)){
				$role = Role::where('slug', $role)->first()->name;
				$events = Event::where( 'user_id', $user->id )->whereDate('created_at', '<=', '2021-10-1 00:00:01')->get(['eventimage1','eventimage2']);
				return view('event_mobile.eventpic', ['role' => $role, 'events' => $events, 'year'=>'2020']);
			}else{ echo "user empty";
				abort(404);
			}
		}else{
			abort(404);
		}
		
	}
	public function eventsPicByYear($year)
    {
		$auth_id = @$_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
	        $role = $user->role;
			if(!empty($user)){
				$role = Role::where('slug', $role)->first()->name;
				$events = Event::where( 'user_id', $user->id )->where('category','13052')->whereDate('created_at', '>=', '2021-10-30 00:00:01')->get(['eventimage1','eventimage2']);
				return view('event_mobile.eventpic', ['role' => $role, 'events' => $events, 'year'=>'2021']);
			}else{
				abort(404);
			}
		}else{
			abort(404);
		}
		
	}
	
	public function edit($id)
	{
		$auth_id = @$_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
	        $role = $user->role;
			if(!empty($user)){
				$event = Event::find($id);
				$role = Role::where('slug', $role)->first()->name;
				$categories = EventCat::all();
				return view('event_mobile.edit_event',compact('event', 'role', 'categories'));
			}else{
				abort(404);
			}
		}else{
			abort(404);
		}
	}
	
	public function updateevent(Request $request){
		
		$request->validate([
				'id' => 'required',
				'user_id' => 'required',
				'eventname' => 'required|between:3,120',
				'eventstartdate' => 'required',
				'eventenddate' => 'required',
				'organiser_name' => 'required|between:3,120',
				'participantnum' => 'required|numeric|min:1|max:999999',
				'mobile' => 'required|digits:10',
				'captcha' => ['required', 'captcha'],
            ],
			[	
				'eventname.required' => 'Event Name is required',
				'eventname.between' => 'Event Name must be between 3 and 120 characters',
				'eventenddate.required' => 'Event end date is required',
				'organiser_name.required' => 'Organisation\'s Name / School Name is required',
				'organiser_name.between' => 'Organisation\'s Name / School Name must be between 3 and 120 characters',
				'participantnum.required' => 'No of Participants is required',
				'participantnum.numeric' => 'No of Participants must be a number.',
				'participantnum.min' => 'No of Participants must be at least 1',
				'participantnum.max' => 'No of Participants may not be greater than 999999',
				'mobile.digits' => 'Mobile must be 10 digits numbers'
				
			]);
			
			
		$event = Event::find($request->id);
		
		$imageName1 = NULL;  $imageName2 = NULL;
        $year = date("Y/m"); 
		
        if($request->file('eventimage1')){
            $imageName1 = $request->file('eventimage1')->store($year,['disk'=> 'uploads']);
            $imageName1 = url('wp-content/uploads/'.$imageName1);
        }
		if($request->file('eventimage2')){
            $imageName2 = $request->file('eventimage2')->store($year,['disk'=> 'uploads']);
            $imageName2 = url('wp-content/uploads/'.$imageName2);
        }

        
	

		if(!empty($imageName1)){
			$event->eventimage1 = $imageName1;
		}
		if(!empty($imageName2)){
			$event->eventimage2 = $imageName2;
		}
		
		$event->eventstartdate = $request->eventstartdate;
        $event->eventenddate = $request->eventenddate;
        $event->name = $request->eventname;
        $event->organiser_name = $request->organiser_name;
        $event->participantnum = $request->participantnum;
        $event->kmrun = $request->kmrun;
		$event->video = $request->video_link;
		
		if(!empty($request->mobile)){
			$event->mobile = $request->mobile;
		}
		 
		$event->save();
        return back()->with('success','Event updated successsfully');


    }
	
	public function eventdestroy($id){
		$res = Event::where('id', $id )->delete();
		return back()->with('success','Event successsfully Deleted');
	}
	
    public function storeevent(Request $request){
		 $request->validate([
				'user_id' => 'required',
				'category' =>'required',
				'eventname' => 'required|between:3,120',
				'eventimage1' =>'required|image|mimes:jpg,png,jpeg,gif|max:2048',
			   //'eventimage2' =>'required|image|mimes:jpg,png,jpg,gif,svg|max:2048',
				'eventstartdate' => 'required',
				'eventenddate' => 'required',
				'organiser_name' => 'required|between:3,120',
				'participantnum' => 'required|numeric|min:1|max:999999',
				'mobile' => 'required|digits:10',
				//'undertaking' => 'required',
	        	//'kmrun' => 'required|numeric|min:1|max:9999999',
				'captcha' => ['required', 'captcha'],
            ],
			[	
				'category.required' => 'Event Category is required',
				'eventname.required' => 'Event Name is required',
				'eventname.between' => 'Event Name must be between 3 and 120 characters',
				'eventimage1.required' => 'Event image is required',
				'eventimage1.image' => 'Event image must be of type jpg,png,gif',
				'eventimage1.max' => 'Event image must be greater than 2mb',
				'eventstartdate.required' => 'Event start date is required',
				'eventenddate.required' => 'Event end date is required',
				'organiser_name.required' => 'Organisation\'s Name / School Name is required',
				'organiser_name.between' => 'Organisation\'s Name / School Name must be between 3 and 120 characters',
				'participantnum.required' => 'No of Participants is required',
				'participantnum.numeric' => 'No of Participants must be a number.',
				'participantnum.min' => 'No of Participants must be at least 1',
				'participantnum.max' => 'No of Participants may not be greater than 999999',
				'mobile.required' => 'Mobile field is required',
				'mobile.digits' => 'Mobile must be 10 digits numbers',
			//	'undertaking.required' => 'Undertaking must be required'
				
			]
			
			);
			
			
        $imageName1 = NULL; $imageName2 = NULL;
        $year = date("Y/m"); 
        if($request->file('eventimage1')){
            $imageName1 = $request->file('eventimage1')->store($year,['disk'=> 'uploads']);
            $imageName1 = url('wp-content/uploads/'.$imageName1);
        }
		if($request->file('eventimage2')){
            $imageName2 = $request->file('eventimage2')->store($year,['disk'=> 'uploads']);
            $imageName2 = url('wp-content/uploads/'.$imageName2);
        }

        

        $event = new Event();
		$event->user_id = $request->user_id;
		$event->category = $request->category;
		if(!empty($imageName1)){
			$event->eventimage1 = $imageName1;
		}
		if(!empty($imageName2)){
			$event->eventimage2 = $imageName2;
		}
		
        
        $event->eventstartdate = $request->eventstartdate;
        $event->eventenddate = $request->eventenddate;
        $event->name = $request->eventname;
        $event->organiser_name = $request->organiser_name;
        $event->participantnum = $request->participantnum;
        if(!empty($request->kmrun)){ $event->kmrun = $request->kmrun; }
		if(!empty($request->video_link)){ $event->video = $request->video_link; }
		if(!empty($request->mobile)){ $event->mobile = $request->mobile; } 
		
        $event->save();
        //return back()->with('success','Event added successsfully');
        return redirect('mobile-my-events/2021?auth_id='.$request->user_id)->with('success','Event created successsfully');

    }
	
    public function eventEcert(Request $request,$id)
    { 
        $auth_id = @$_REQUEST['auth_id'];
		$user = User::find($auth_id);
		if(!empty($user)){
		    $role = $user->role;
	        $role = Role::where('slug', $role)->first()->name;
	        $users = DB::table('users')
	                ->join('events','users.id','=','events.user_id')
	                ->select(['users.role','users.name','events.category','events.name','events.participant_names','events.organiser_name','events.eventstartdate','events.eventenddate','events.category'])
	                ->where('events.user_id', $auth_id)
					->where('events.id', $id)
	                ->first();
	        $categories = EventCat::all();
            return view('event_mobile.get-e-certificate-freedomrun',compact('role','categories','users'));       
        }else{
        	abort(404);
        }
    }


    public function dwldEcert(Request $request)
    {
    	
    	$eventname = $request->name;
    	
    	$category = $request->category;
    	$eventstartdate = $request->eventstartdate;
    	$evtstdate = strtotime($eventstartdate);
    	
    	$startdate = date("j<\s\up>S<\/\s\up> M" ,$evtstdate);
    	
    	
    	$eventenddate = $request->eventenddate;
    	$evteddate = strtotime($eventenddate);
    	$enddate = date("j<\s\up>S<\/\s\up> M" ,$evteddate); 

    	$participant = $request->participant;
    	$certificate_type = $request->cert_type;
    	$organiser_name = $request->organiser_name;

    	$category = EventCat::where('id',$category)->first();
        
    	$cat = str_replace('-',' ',$category->name);
    	

    	if($category->id == 13052 && $certificate_type == 'organiser')
		{
			 $pdf = PDF::loadView('org-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
        return $pdf->stream($organiser_name.".pdf");
		//orange-certificate.jpg
		}
		elseif($category->id == 13052 && $certificate_type == 'participant')
		{
			$pdf = PDF::loadView('blue-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate ,'participant' => $participant])->setPaper('a4', 'landscape');
        return $pdf->stream($participant.".pdf");
		//blue-certificate.jpg
		}
		elseif($category->id == 13054 && $certificate_type == 'organiser')
		{
		$pdf = PDF::loadView('prabhatpheri-cert-org',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
        return $pdf->stream($organiser_name.".pdf");
		//prabhatpheri.jpg
		}
		elseif($category->id == 13054 && $certificate_type == 'participant')
		{
			$pdf = PDF::loadView('prabhatpheri-cert-pat',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate ,'participant' => $participant])->setPaper('a4', 'landscape');
        return $pdf->stream($participant.".pdf");
		//prabhatpheri.jpg
		}
		elseif($category->id == 13053 && $certificate_type == 'organiser')
		{
			$pdf = PDF::loadView('freedomrun-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
        return $pdf->stream($organiser_name.".pdf");
		
		}
		elseif($category->id == 13053 && ($certificate_type == 'participant' || $certificate_type == 'individual'))
		{
			
			if($certificate_type == 'individual')
			{
				$pdf = PDF::loadView('freedomrun-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname) ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
        		return $pdf->stream($organiser_name.".pdf");
		
			}
			elseif($certificate_type == 'participant')
			{
				$pdf = PDF::loadView('partc-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate ,'participant' => $participant])->setPaper('a4', 'landscape');
        		return $pdf->stream($participant.".pdf");
		
			}
			
		}


        
    }


    public function addParticipant(Request $request,$id)
    {
    	$auth_id = @$_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
	        $role = $user->role;
			if(!empty($user)){
		        $event = Event::find($id);
		        $role = Role::where('slug', $role)->first()->name;
		        return view('event_mobile.add-participant',compact('role','event'));
	    	}else{
	    		abort(404);
	    	}
	    }else{
	    	abort(404);
	    }	
    }
    public function updateParticipant(Request $request)
    {
        
        $request->validate([
            'user_id' => 'required',
            'participantnum' => 'required',
            'participant_names' => 'required',
            
            ]);
        $user_id = $request->user_id;
        $participantnum = $request->participantnum;
        $memberlist = $request->participant_names;


         $memberlist = explode(PHP_EOL, $memberlist);
       
            $event = Event::find($request->id);
            $event->participant_names =serialize($memberlist);
            $event->participantnum = $participantnum;
            $event->save();
         
         return back()->with('success','Participants updated successsfully');

    }
    public function myApplicationStatus(){
	    $auth_id = @$_REQUEST['auth_id'];
		if(!empty($auth_id)){
			$user = User::find($auth_id);
		    $role = $user->role;
			if(!empty($user)){
		    	$email = Auth::user()->email;
		      	$champion_info = Champion::where('email',$email)->where('status','1')->first();
		        $ambassador_info = Ambassador::where('email',$email)->where('status','1')->first();
				$role = Role::where('slug', $role)->first()->name;
		        return view('event.application_status', ['role' => $role , 'ambassador_info' => $ambassador_info, 'champion_info' => $champion_info]);
	        }
	       	return view('event_mobile.application_status');
		}else{
		   	abort(404);
		}
	}
}
