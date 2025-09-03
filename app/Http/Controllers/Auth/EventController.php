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
use App\Models\Freedomrun;
class EventController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function schoolQuiz(){
        $role = Auth::user()->role;
        if($role){

            $events = Event::where( 'user_id', Auth::user()->id )->get();
            $role = Role::where('slug', $role)->first()->name;
            return view('event.school-quiz', ['role' => $role , 'events' =>$events]);
        }
    }
    
    
    public function saveQuiz(Request $request)
    {
        
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
         
         return back()->with('message','Nomination details received');
        
       
    }

    public function createevent()
    { 
        $role = Auth::user()->role;
        $u_id = Auth::user()->id;
        $categories = EventCat::all();
        
        /*
        return view("event.upcomming_event", ['role' => $role , 'categories' => $categories]);
        if($role != 'school'){ 
            return view("event.upcomming_event", ['role' => $role , 'categories' => $categories]);
        }
      */  
        if($role)
        {
            $categories = EventCat::all();
            $role = Role::where('slug', $role)->first()->name;
            /*if($u_id=='813251'){
                return view('event.create_event', ['role' => $role , 'categories' => $categories]);
            }else{
                return view('test', ['role' => $role , 'categories'=> $categories ]);
            }*/
            return view('event.create_event', ['role' => $role , 'categories' => $categories]);
            //return view("event.upcomming_event", ['role' => $role , 'categories' => $categories]);
        }
        return view('event.create_event');
    }

    public function myevents()
    {
        $role = Auth::user()->role;
        if($role){
            $freedom_events = Freedomrun::where('user_id', Auth::user()->id)->get();  


            $events = Event::where( 'user_id', Auth::user()->id )->orderBy('id', 'DESC')->get();
            //$events = Event::where( 'user_id', Auth::user()->id )->whereDate('created_at', '<=', '2021-10-1 00:00:01')->get();
            $role = Role::where('slug', $role)->first()->name;
            return view('event.my_event', ['role' => $role , 'events' =>$events, 'freedom_event' =>$freedom_events, 'year'=>'2020']);
        }
        //return view('event.my_event');
    }
    public function myEventsByYear($evt_type)
    {
            $role = Auth::user()->role;
            if($role){
                if($evt_type=='schoolweek-2021'){ 
                    $catid = '13056';
                }if($evt_type=='freedom-rider-cycle-rally'){ 
                    $catid = '13058';
                }if($evt_type=='2022'){ 
                    $catid = '13059';
                }else{
                    $catid = '13057';
                }
                $events = Event::where( 'user_id', Auth::user()->id )->where('category',$catid)->orderBy('id', 'DESC')->get();
                $role = Role::where('slug', $role)->first()->name;
                return view('event.my_event', ['role' => $role , 'events' =>$events,'year'=>$evt_type]);
            }else{
                abort(404);
            }
    }
    
    public function eventspic()
    {
        $role = Auth::user()->role;
        if($role){
            $role = Role::where('slug', $role)->first()->name;
            //$events = Event::where( 'user_id', Auth::user()->id )->get(['eventimage1','eventimage2']);
            $events = Event::where( 'user_id', Auth::user()->id )->whereDate('created_at', '<=', '2021-10-1 00:00:01')->get(['eventimage1','eventimage2']);
            return view('event.eventpic', ['role' => $role, 'events' => $events, 'year'=>'2020']);
        }
        
    }
    public function eventsPicByYear($evt_type)
    {
        $role = Auth::user()->role;
        if($role){
            if($evt_type=='schoolweek-2021'){ 
                $catid = '13056';
            }else if($evt_type=='2022'){ 
                    $catid = '13059';
            }else{
                $catid = '13057';
            }
            $role = Role::where('slug', $role)->first()->name;
            $events = Event::where( 'user_id', Auth::user()->id )->where('category',$catid)->get(['eventimage1','eventimage2']);
            return view('event.eventpic', ['role' => $role, 'events' => $events, 'year'=>$evt_type]);
        }
        
    }
    
    public function edit($id)
    {
        $role = Auth::user()->role;
        if($role){
            $event = Event::find($id);
            
            $role = Role::where('slug', $role)->first()->name;
            $categories = EventCat::all();
            return view('event.edit_event',compact('event', 'role', 'categories'));
        }
    }
    
    public function updateevent(Request $request){
        if(Auth::user()->role=='school'){ 
            $request->validate([
                'id' => 'required',
                'user_id' => 'required',
                'eventname' => 'required|between:3,120',
                'eventstartdate' => 'required',
                'eventenddate' => 'required',
                'organiser_name' => 'required|between:3,120',
                'participantnum' => 'required|numeric|min:1|max:999999',
            //  'mobile' => 'required|digits:10',
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
            //  'mobile.digits' => 'Mobile must be 10 digits numbers'
                
            ]);
        }else{
            $request->validate([
                'id' => 'required',
                'user_id' => 'required',
                'eventstartdate' => 'required',
                'organiser_name' => 'required|between:3,120',
                'participantnum' => 'required|numeric|min:1|max:999999',
            //  'mobile' => 'required|digits:10',
                'captcha' => ['required', 'captcha'],
            ],
            [   
                'eventstartdate.required' => 'Event date is required',
                'organiser_name.required' => 'Organisation\'s Name / School Name is required',
                'organiser_name.between' => 'Organisation\'s Name / School Name must be between 3 and 120 characters',
                'participantnum.required' => 'No of Participants is required',
                'participantnum.numeric' => 'No of Participants must be a number.',
                'participantnum.min' => 'No of Participants must be at least 1',
                'participantnum.max' => 'No of Participants may not be greater than 999999',
            //  'mobile.required' => 'Contact number is required',
            //  'mobile.digits' => 'Mobile must be 10 digits numbers'
            ]);
        }
            
            
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
        if(!empty($request->eventenddate)){ $event->eventenddate = $request->eventenddate; }
        $event->name = $request->eventname;
        $event->organiser_name = $request->organiser_name;
        $event->participantnum = $request->participantnum;
        if(!empty($request->kmrun)){ $event->kmrun = $request->kmrun; }
        $event->video = $request->video_link;
        if(!empty($request->mobile)){ $event->mobile = $request->mobile; }
        if(!empty($request->participant_names)){ 
            $memberlist = $request->participant_names;
            $memberlist = explode(PHP_EOL, $memberlist);
            $event->participant_names = serialize($memberlist);
        }
         
        $event->save();
        return back()->with('success','Event updated successsfully');


    }
    
    public function eventdestroy($id){
        $res = Event::where('id', $id )->delete();
        return back()->with('success','Event successsfully Deleted');
    }
    
   public function storeevent(Request $request){

         if(Auth::user()->role=='school'){ 
             $request->validate([
                    'user_id' => 'required',
                    'category' =>'required',
                    'eventname' => 'required|between:3,120',
                    'eventimage1' =>'required|image|mimes:jpg,png,jpeg,gif|max:2048',
                   //'eventimage2' =>'required|image|mimes:jpg,png,jpg,gif,svg|max:2048',
                    'eventstartdate' => 'required',
                    //'eventenddate' => 'required',
                    'organiser_name' => 'required|between:3,120',
                    'participantnum' => 'required|numeric|min:1|max:999999',
                    //'mobile' => 'required|digits:10',
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
                    'eventimage1.max' => 'Event image must be less than 2mb',
                    'eventstartdate.required' => 'Event start date is required',
                    //'eventenddate.required' => 'Event end date is required',
                    'organiser_name.required' => 'Organisation\'s Name / School Name is required',
                    'organiser_name.between' => 'Organisation\'s Name / School Name must be between 3 and 120 characters',
                    'participantnum.required' => 'No of Participants is required',
                    'participantnum.numeric' => 'No of Participants must be a number.',
                    'participantnum.min' => 'No of Participants must be at least 1',
                    'participantnum.max' => 'No of Participants may not be greater than 999999',
                    //'mobile.required' => 'Mobile field is required',
                    //'mobile.digits' => 'Mobile must be 10 digits numbers',
                //  'undertaking.required' => 'Undertaking must be required'
                    
                ]
                
                );
        }else{ 
                $request->validate([
                    'user_id' => 'required',
                    'category' =>'required',
                    'eventname' => 'required|between:3,120',
                    'eventimage1' =>'required|image|mimes:jpg,png,jpeg,gif|max:2048',
                    'eventstartdate' => 'required',
                    'participantnum' => 'required|numeric|min:1|max:999999',
                    //'mobile' => 'required|digits:10',
                    'captcha' => ['required', 'captcha'],
                ],
                [   
                    'category.required' => 'Event Category is required',
                    'eventname.required' => 'Event Name is required',
                    'eventname.between' => 'Event Name must be between 3 and 120 characters',
                    'eventimage1.required' => 'Event image is required',
                    'eventimage1.image' => 'Event image must be of type jpg,png,gif',
                    'eventimage1.max' => 'Event image must be greater than 2mb',
                    'eventstartdate.required' => 'Event date is required',
                    'participantnum.required' => 'No of Participants is required',
                    'participantnum.numeric' => 'No of Participants must be a number.',
                    'participantnum.min' => 'No of Participants must be at least 1',
                    'participantnum.max' => 'No of Participants may not be greater than 999999',
                    //'mobile.required' => 'Mobile field is required',
                    //'mobile.digits' => 'Mobile must be 10 digits numbers'
                ]
                
                );
        }
            
            
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
        
        
        if(!empty($request->eventstartdate)){ $event->eventstartdate = $request->eventstartdate; }
        if(!empty($request->eventenddate)){ $event->eventenddate = $request->eventenddate; }
        $event->name = $request->eventname;
        if(!empty($request->organiser_name)){ $event->organiser_name = $request->organiser_name; }
        $event->participantnum = $request->participantnum;
        if(!empty($request->kmrun)){ $event->kmrun = $request->kmrun; }
        if(!empty($request->video_link)){ $event->video = $request->video_link; }
        if(!empty($request->mobile)){ $event->mobile = $request->mobile; } 
        if(!empty($request->participant_names)){ 
            $memberlist = $request->participant_names;
            $memberlist = explode(PHP_EOL, $memberlist);
            $event->participant_names = serialize($memberlist);
        }
        $result = $event->save();
        //return back()->with('success','Event added successsfully');
        //return redirect('my-events/2021')->with('success','Event created successsfully');
        if($result){
            return redirect('my-events/2022')->with('success','Event created successsfully');
            /*
            if(Auth::user()->role=='school'){ 
                return redirect('my-events/schoolweek-2021')->with('success','Event created successsfully');
            }else{
                return redirect('my-events/cyclothon-2021')->with('success','Event created successsfully');
            }
            */
            
        }else{
            return back()->with('failed','Something Wrong');
        }
    }
    
    public function eventEcert(Request $request,$id)
    {
        
        $role = Auth::user()->role;
        //$role  = Role::where('slug',)->first();
        $role = Role::where('slug', $role)->first()->name;
        
        $users = DB::table('users')
                ->join('events','users.id','=','events.user_id')
                ->select(['users.role','users.name','events.category','events.name','events.participant_names','events.organiser_name','events.eventstartdate','events.eventenddate','events.category'])
                ->where('events.user_id', Auth::user()->id)
                ->where('events.id', $id)
                ->first();
                
        
            $categories = EventCat::all();
        
            return view('event.get-e-certificate-freedomrun',compact('role','categories','users'));       

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
        

        if($category->id == 13052 OR $category->id == 13056 && $certificate_type == 'organiser')
        {
             $pdf = PDF::loadView('org-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
            
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        //return $pdf->stream($organiser_name.".pdf");
        return $pdf->download($organiser_name.".pdf");
        //orange-certificate.jpg
        }
        elseif($category->id == 13052 OR $category->id == 13056 && $certificate_type == 'participant')
        {
            
            $pdf = PDF::loadView('blue-cert', ['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate ,'participant' => $participant])->setPaper('a4', 'landscape');
             
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        //return $pdf->stream($participant.".pdf");
        return $pdf->download($participant.".pdf");
    
            /*
            
            
            $pdf = PDF::loadView('blue-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate ,'participant' => $participant])->setPaper('a4', 'landscape');
        return $pdf->stream($participant.".pdf");
        
        */
        //blue-certificate.jpg
        }
        elseif($category->id == 13054 && $certificate_type == 'organiser')
        {
        $pdf = PDF::loadView('prabhatpheri-cert-org',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
        
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        
        return $pdf->stream($organiser_name.".pdf");
        //prabhatpheri.jpg
        }
        elseif($category->id == 13054 && $certificate_type == 'participant')
        {
            $pdf = PDF::loadView('prabhatpheri-cert-pat',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate ,'participant' => $participant])->setPaper('a4', 'landscape');
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        return $pdf->stream($participant.".pdf");
        //prabhatpheri.jpg
        }
        elseif($category->id == 13053 OR $category->id == 13057 && $certificate_type == 'organiser')
        {
            $pdf = PDF::loadView('event.cyclothon-organizer-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        //return $pdf->stream($organiser_name.".pdf");
        return $pdf->download($organiser_name.".pdf");
        }
        elseif($category->id == 13053 OR $category->id == 13057 && ($certificate_type == 'participant' || $certificate_type == 'individual'))
        {
            
            if($certificate_type == 'individual')
            {
                $pdf = PDF::loadView('event.cyclothon-invididual-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname) ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
                
                $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
                //return $pdf->stream($organiser_name.".pdf");
                return $pdf->download($organiser_name.".pdf");
            }
            elseif($certificate_type == 'participant')
            {
                $pdf = PDF::loadView('event.cyclothon-invididual-cert',['organiser_name' => $participant ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate ,'participant' => $participant])->setPaper('a4', 'landscape');
                
                $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        );
        
                //return $pdf->stream($participant.".pdf");
                return $pdf->download($participant.".pdf");
        
            }
            
        }elseif($category->id == 13058)
        {
            if($request->cert_type == 'participant' && isset($request->participant)){
                $organiser_name = $request->participant;
            }
            $pdf = PDF::loadView('event.freedom-rider-cycle-rally-2022-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
        return $pdf->stream($organiser_name.".pdf");
        
        }
        elseif($category->id == 13059)
        {
            if($request->cert_type == 'participant' && isset($request->participant)){
                $organiser_name = $request->participant;
            }
            $pdf = PDF::loadView('event.national-sports-day-2022-cert',['organiser_name' => $organiser_name ,'eventname' => str_replace('-',' ',$eventname)  ,'cat' => $cat ,'startdate' => $startdate, 'enddate' => $enddate])->setPaper('a4', 'landscape');
        return $pdf->stream($organiser_name.".pdf");
        
        }


        
    }


    public function addParticipant(Request $request,$id)
    {
        $event = Event::find($id);

        $role = Auth::user()->role;
        //$role  = Role::where('slug',)->first();
        $role = Role::where('slug', $role)->first()->name;
        return view('event.add-participant',compact('role','event'));
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


        // $memberlist = explode(PHP_EOL, $memberlist);
       
            $event = Event::find($request->id);
            $event->participant_names = $memberlist ;
            $event->participantnum = $participantnum;
            $event->save();
         
         return back()->with('success','Participants updated successsfully');

    }
    public function myApplicationStatus(){
        $role = Auth::user()->role;
         $email = Auth::user()->email;
       
        if($role)
        {  

            //$categories = Category::all();
            $champion_info = Champion::where('email',$email)->where('status','1')->first();
            $ambassador_info = Ambassador::where('email',$email)->where('status','1')->first();
            $role = Role::where('slug', $role)->first()->name;
            return view('event.application_status', ['role' => $role , 'ambassador_info' => $ambassador_info, 'champion_info' => $champion_info]);

        }
        return view('event.application_status');
    }
}
