<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siteoption;
use App\Models\Event;
use App\Models\EventCat;
use App\Models\Feedback;
use App\Models\State;
use App\Models\Shareyourstory;
use Illuminate\Support\Facades\DB;
use App\Models\Schoolquiz;
use PDF;
class GeneralController extends Controller
{
    public function fitindschoolweek2020(){
    	return view('fit-india-school-week');
    }
	
	static public function sitecounter(){
		$vistor = Siteoption::where('key','visitors')->first();
		$vistor->increment('value');
		return $vistor->value;
	}
	
	static public function updatedon(){
		$updatedon = Siteoption::where('key','siteupdateOn')->first();
		return $updatedon->value;
	}
	
	
	
	
	
	public function getallEvents(Request $request)
	{
		$categories = EventCat::all();
		if($request->input('search') == 'search')
		{
			
			$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->orderBy('events.eventimage1','desc')
				->select(['events.id','event_cats.name  as catname','events.eventimage1','events.eventimage2','events.name as eventname','events.eventstartdate','users.name'])
				
				->where('events.category',$request->category)
				->whereNotNull('events.eventimage1');
				$count = $events->count();
				$events = $events->paginate(40);
		}
		else{
		$events =  DB::table('events')        
				->Join('users', 'users.id', '=', 'events.user_id')
				
				->Join('event_cats', 'event_cats.id', '=', 'events.category')
				->orderBy('events.eventimage1','desc')
				->select(['events.id','event_cats.name  as catname','events.eventimage1','events.eventimage2','events.name as eventname','events.eventstartdate','users.name'])
				
				->whereNotNull('events.eventimage1');
		
		$count = $events->count();
		$events = $events->paginate(40);
		}
		return view('all-events',compact('events','categories','count'));
		}
	
	public function showEvent($id)
	{
		$events =  DB::table('events')        
				->Join('users', 'users.id', '=', 'events.user_id')
				->Join('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['event_cats.name  as catname','events.eventstartdate', 'events.eventenddate', 'events.eventimage1','events.name as eventname','users.name'])
				->where('events.id',$id)
				->first();
		return view('show-events-list',compact('events'));
	}
	
	public function showVideo(Request $request)
	{
		$categories = EventCat::all();
		if($request->input('search') == 'search')
		{
			
			$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->orderBy('events.video','desc')
				->select(['events.id','event_cats.name  as catname','events.name as eventname','events.video','users.name','usermetas.city','usermetas.state'])
				
				->where('events.category', $request->category)
				->whereNotNull('events.video')->paginate(40);
				
		}
		else{
			
		$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->orderBy('events.video','desc')
				->select(['events.id','event_cats.name  as catname','events.name as eventname','events.video','users.name','usermetas.city','usermetas.state'])
				
				->whereNotNull('events.video')
				->paginate(40);
		
		
		}
		return view('video-stream',compact('events','categories'));
		
		
	}
	public function getallPhotos(Request $request)
	{
		$categories = EventCat::all();
		if($request->input('search') == 'search')
		{
			
			$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.name as eventname','users.name','usermetas.city','usermetas.state','events.eventimage1','events.eventimage2'])
				->orderBy('events.eventimage1','desc')
				->where('events.category',$request->category)
				->whereNotNull('events.eventimage1')->paginate(40);
				
		}
		else{
		 
		$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.name as eventname','users.name','usermetas.city','usermetas.state','events.eventimage1','events.eventimage2'])
				->orderBy('events.eventimage1','desc')
				->whereNotNull('events.eventimage1')
				->paginate(40);

		
		}
		return view('photo-stream',compact('events','categories'));
		
		
	}
	
	
	
	public function feedback()
	{
		return view('feedback');
	}
	public function feedbackStore(Request $request)
	{
		$request->validate([
		'department' => 'required',
		'name' => 'required',
		'email' =>'required',
		'mobile' => 'required|digits:10',
		'feedback' => 'required',
		]);
		$feedback = new Feedback();
		$feedback->department = $request->department;
		$feedback->name = $request->name;
		$feedback->email = $request->email;
		$feedback->mobile = $request->mobile;
		$feedback->feedback = $request->feedback;
		$feedback->save();
		
		try {
				$email = 'contact.fitindia@gmail.com';
				//$email = 'partnership.fitindia@gmail.com';
				$message = "Dear Fit India Team,";
				$message.= "<br><br>";
				
				$message .= "Below are request for Fit India FEEDBACK";
				$message.= "<br><br>";
				$message.= $request->department."<br>";
				$message.=  $request->name."<br>";
				$message.=  $request->email."<br>";
				$message.=  $request->mobile."<br>";
				$message.=  $request->feedback."<br>";
				
				
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail.php");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=$message&subject='Fit India FEEDBACK Request'");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec($ch);
					curl_close ($ch);
					
					
			}
			catch (Exception $e) {
				return $e->message();
			}
			
			
		return back()->with('message','Thank you!!! for your response');
		
	}
	public function shareStory(Request $request)
	{
		$states = State::all();
		return view('your-story',compact('states'));
		
	}
	public function saveStory(Request $request)
	{
		 
		$image = '';
        $year = date("Y/m"); 
		/*
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
		*/
        $request->validate([
            //'youare' => 'required|string|min:3|max:255',
			'mobile' => 'required|digits:10',
            'designation' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255',
            'fullname' => 'required|string|min:3|max:255',
            'videourl' => 'required',
			'state' => 'required',
            'title' => 'required|string|min:3|max:255',
          //  'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'story' => 'required|string|min:3|max:255',
			'captcha' => ['required', 'captcha'],
        ]);
         
        $yourstory = new Shareyourstory;
        //$yourstory->youare = $request->youare;
		$yourstory->mobile = $request->mobile;
        $yourstory->designation = $request->designation;
        $yourstory->email = $request->email;
        $yourstory->fullname = $request->fullname;
        $yourstory->videourl = $request->videourl;
        $yourstory->title = $request->title;
       // $yourstory->image =  $image;
        $yourstory->story = $request->story;
		$yourstory->state = $request->state;
        $yourstory->save();
		
			try {
				$email = 'fitnessstories123@gmail.com';
				//$email = 'dasshaktiraj@gmail.com';
				$message = "Dear Fit India Team,";
				$message.= "<br><br>";
				
				$message .= "Below are request for Fit India SHARE YOUR STORY";
				$message.= "<br><br>";
				$message.=  "Name : ".$request->fullname."<br>";
				//$message.= $request->youare."<br>";
				$message.=  "Designation : ".$request->designation."<br>";
				$message.=  "Email id : ".$request->email."<br>";
				$message.=  "Contact No : ".$request->mobile."<br>";
				$message.= "State : ".$request->state."<br>"; 
				$message.=  "URL : ".$request->videourl."<br>";
			
				$message.= "Story title : ".$request->title."<br>";
				$message.= "Your Story : ".$request->story."<br>";
				
				
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail.php");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=$message&subject='Fit India SHARE YOUR STORY Request'");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec($ch);
					curl_close ($ch);
					
					
			}
			catch (Exception $e) {
				return $e->message();
			}
				
		
        return back()->with('message',"Your story has been successfully submitted, Fit India Team will review it, if approved, the story will be displayed on the Fit India Portal/Social Media handles.");
	}
	
	
	public function schoolQuiz(Request $request)
	{
		
		return view('school-quiz');
		
	}
	
	public function saveQuiz(Request $request)
	{
		echo '<pre>';
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
		 return back()->with('message','Student details submitted Successfully');
        
       
	}
	public function downloadSchoolBanner(){
		$banner_type = $_REQUEST['banner_type'];
		if($banner_type=='week_1'){
			$school_name = $_REQUEST['school_name'];
			$pdf = PDF::loadView('school-week-banner',['school_name' => $school_name])->setPaper('a4', 'landscape');
		}elseif($banner_type=='week_2'){
			$school_name = $_REQUEST['school_name'];
			$pdf = PDF::loadView('school-week-banner_second',['school_name' => $school_name])->setPaper('a4', 'landscape');
		}else{
			$school_name = $_REQUEST['school_name'];
			$pdf = PDF::loadView('school-week-banner_third',['school_name' => $school_name])->setPaper('a4', 'landscape');
		}
		
        return $pdf->stream($school_name.".pdf");
	}
	
}
