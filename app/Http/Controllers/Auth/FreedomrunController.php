<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Freedomrun;
use App\Models\Freedomrunpartners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CertificationTrackings;
use App\Models\Usermeta;
use App\Models\Trackingpic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\EventCat;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PDF;
class FreedomrunController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth');
    }  */
	
    public function createFreedomrunEvent(){ 

        if (isset(auth()->user()->role)){
            $role = Auth::user()->role;
            $a_id = Auth::user()->id;
            if (Auth::check()){
                $categories = EventCat::all();
                $userdata = user::with('usermeta')->find($a_id);
                if(!empty($userdata)){
                    /*
                    if($role=='subscriber'){
                    return redirect('dashboard');
                    }else{
                        return view('freedomrun.freedom-add-organization-event', ['role' => $role , 'userdata' => $userdata,'categories'=> $categories ]);
                    }
                    */
                    return view('freedomrun.freedom-add-organization-event', ['role' => $role , 'userdata' => $userdata,'categories'=> $categories ]);
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }else{

            return redirect('/login');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $year = date("Y/m"); 
        $imgurl = array();
        if($request->hasfile('prt_image')) { 
            foreach($request->file('prt_image') as $file){ 
                $name = $file->getClientOriginalName();
                $name = $file->store($year,['disk'=> 'uploads']);
                $name = url('wp-content/uploads/'.$name);
                $imgurl[] = $name;
            }
        }

        $run = new Freedomrun();
        $run->user_id = Auth::user()->id;
        $run->category = 13062; // event category from event_cat table
        $run->name = $request->name;
		$run->email = $request->email;
        $run->contact = $request->contact;
		$run->school_chain = $request->school_chain;
        $run->eventstartdate = $request->from_date;
        $run->eventenddate = $request->to_date;
  
        $run->school_chain = $request->school_chain ? $request->school_chain : '';
        $run->eventimg_meta = serialize($imgurl); 
        $run->eventdate_meta = serialize($request->prt_date);
        $run->eventpnt_meta = serialize($request->number_of_partcipant);
        $run->eventkm_meta = serialize($request->km);

        $run->total_participant = array_sum($request->number_of_partcipant);
        $run->total_kms = array_sum($request->km);

        $run->organiser_name = $request->org_name;
        $run->role = 'organizer';
        $run->video_link = serialize($request->video_link);


        if($run->save()){
            return redirect('show-freedom-updatedetail/'.$run->id)->with('success', 'Congratulations, your event has been successfully created.');   
        }else{
            return back()->with('failed','Something Wrong')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Freedomrun  $freedomrun
     * @return \Illuminate\Http\Response
     */
    public function show(Freedomrun $freedomrun){
        if (isset(auth()->user()->role)){
            $id = Auth::user()->id;
            $events = Freedomrun::where('user_id',$id)->get();  
            // return view('freedomrun.freedum_events',compact('events'));
            return view('freedomrun.freedomrun-events',compact('events'));
        }else{
            return redirect('/login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Freedomrun  $freedomrun
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
		
		//dd($request);
		
        $year = date("Y/m"); 
        $imgurl = array();
        if($request->hasfile('prt_image')) { 
            foreach($request->file('prt_image') as $file){ 
                $name = $file->getClientOriginalName();
                $name = $file->store($year,['disk'=> 'uploads']);
                $name = url('wp-content/uploads/'.$name);
                $imgurl[] = $name;
            }
        }
        $old_img_url = unserialize($request->old_prt_image);
        $new_imgurl = array_merge($imgurl,$old_img_url);

        $total_participant = array_sum($request->number_of_partcipant);
        $total_km = array_sum($request->km);
        $school_chains = $request->school_chain ? $request->school_chain : '';
        $freedom_update = Freedomrun::where('id', '=', $request->id)->update(['organiser_name' => $request->org_name, 'contact' => $request->contact,'email' => $request->email,'school_chain'=>$school_chains, 'eventstartdate' => $request->from_date, 'eventenddate' => $request->to_date,'eventimg_meta' => serialize($new_imgurl),'eventdate_meta' => serialize($request->prt_date),'eventpnt_meta' => serialize($request->number_of_partcipant),'eventkm_meta' => serialize($request->km),'video_link' => serialize($request->video_link),'total_participant'=>$total_participant,'total_kms'=>$total_km]);


        if($freedom_update){
            return redirect('show-freedom-updatedetail/'.$request->id)->with('success', 'Your event has been successfully updated.');   
        }else{
            return back()->with('failed','Something Wrong')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Freedomrun  $freedomrun
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){
        if (isset(auth()->user()->role)){
            $role = Auth::user()->role;
            $events = DB::table('freedomruns')
                ->leftJoin('users', 'freedomruns.user_id', '=', 'users.id')
                ->select('users.name','users.email as useremail','users.phone','users.role', 'freedomruns.*')
                ->where('freedomruns.id',$id)
                ->first();
            return view('freedomrun.freedum_run_update', ['role' => $role , 'events' => $events ]);
        }else{
            return redirect('/login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Freedomrun  $freedomrun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Freedomrun $freedomrun)
    {
        //
    }
    public function addFreedomRunPartcipant($id){
        if (isset(auth()->user()->role)){
            $role = Auth::user()->role;
            $event = Freedomrun::find($id);
            return view('freedomrun.freedomrun-add-participant',compact('event','role'));
        }else{
            return redirect('/login');
        }
    }

    public function updateFreedomRunParticipant(Request $request){   
            $request->validate([
                'participant_names' => 'required',
            ]);
            $memberlist = $request->participant_names;
            $memberlist = explode(PHP_EOL, $memberlist);
            $freedom_participant_update = Freedomrun::where('id', '=', $request->id)->update(['participant_names' => serialize($memberlist)]);

            if($freedom_participant_update){
                return redirect('show-freedom-updatedetail/'.$request->id);
            }else{
                return back()->with('success','Participants updated successsfully');
            }
        
    }
    
    public function addIndividualFreedomRun(Request $request){
        // dd($request->all());
        $imageName1 = NULL; $imageName2 = NULL;
        $year = date("Y/m"); 
          $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'km' => 'required',
            'captcha' => 'required|captcha'
        ],[
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'contact.required' => 'Contact field is required',
            'from_date' => 'From Date is required',
            'to_date' => 'To Date is required',
            'km.required' => 'Kilometer field is required',
            'captcha.required' => 'Captcha field is required.',
            'captcha.captcha' => 'Please fill correct value.'
        ]);
		
        if(empty(Freedomrun::where('email',$request->email)->first())){
            if($request->file('image1')){
                $imageName1 = $request->file('image1')->store($year,['disk'=> 'uploads']);
                $imageName1 = url('wp-content/uploads/'.$imageName1);
            }
			
            $run = new Freedomrun();
            $run->user_id = 0;
			$user = User::where('email', $request->email)->first();
			if(isset($user)){
				$run->user_id =$user->id;
			}else{
				$user = new User();
				$user->name = $request->name;
				$user->phone = $request->contact;
				$user->role = 'subscriber';
				$user->role_id = 3;
				$user->rolelabel = 'INDIVIDUAL';
				$user->password = Hash::make('12345');
				$user->email = $request->email;
				$user->save();
				if(isset($user->id)){
					$run->user_id =$user->id;
				}
			}
            $run->category = 13062; //  previous 13008 event category from event_cat table
            $run->name = $request->name;
			$run->type = $request->type;
            $run->email = $request->email;
            $run->contact = $request->contact;
            if(!empty($imageName1)){
                $run->eventimage1 = $imageName1;
            }
            $run->eventstartdate = $request->from_date;
            $run->eventenddate = $request->to_date;
            $run->kmrun = $request->km;
            $run->organiser_name = $request->name;
            $run->video_link = $request->video_link;
            $run->role = 'individual';     
            if($run->save()){
                /*$pdf = PDF::loadView('freedomrun.freedomrun-cert',['organiser_name' => 'test'])->setPaper('a4', 'landscape');
                    return $pdf->stream($request->name.".pdf");*/
                 return back()->with('success','Congratulations, your event has been successfully created')->with('success_email',$request->email);    
            }else{
                return back()->with('failed','Something Wrong')->withInput();
            }
        }else{
            return back()->with('failed','This email id has already been used, please use another email ID to register again or to download your certificate please click on click here button')->withInput();
        }
        return redirect('freedom-run-4.0');
    }
    public function checkIndividualExistance(Request $request){
        if(!empty($request->certificate_email)){
            $freedom_run = Freedomrun::where('email',$request->certificate_email)->first();
            if(!empty($freedom_run)){
                $pdf = PDF::loadView('freedomrun.freedomrun-cert',['organiser_name' => $freedom_run->name ,'eventname' => $freedom_run->name, 'cat' => 'Fit India Freedom Run 2.0' ,'startdate' => $freedom_run->eventstartdate, 'enddate' => $freedom_run->eventenddate])->setPaper('a4', 'landscape');
                   $pdf->getDomPDF()->setHttpContext(
                    stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
                     );
                    return $pdf->stream($freedom_run->name.".pdf");
            }else{
                return back()->with('failed','We have no any record for this email id, Please submit your application for download certificate')->withInput();
            }
        }
        return redirect('freedom-run-2.0');
    }

    public function checkIndividualExistanceSecond($email){
        if(!empty($email)){
            $email = base64_decode($email);
            $freedom_run = Freedomrun::where('email',$email)->where('role','individual')->first();
            if(!empty($freedom_run)){
                $pdf = PDF::loadView('freedomrun.freedomrun-cert',['organiser_name' => $freedom_run->name ,'eventname' => $freedom_run->name, 'cat' => 'Fit India Freedom Run 2.0' ,'startdate' => $freedom_run->eventstartdate, 'enddate' => $freedom_run->eventenddate])->setPaper('a4', 'landscape');
                     $pdf->getDomPDF()->setHttpContext(
                    stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
                     );
                    return $pdf->stream($freedom_run->name.".pdf");
            }
            /*else{
                return back()->with('failed','We have no any record for this email id, Please submit your application for download certificate')->withInput();
            }*/
        }
        return redirect('freedom-run-2.0');
    }

    public function addFreedomRunPartners(Request $request){
        $request->validate([
            'org_name' => 'required|string',
            'event_name' => 'required|string',
            'email' => 'required|email|string|max:255',
            'contact' => 'required|numeric|digits:10',
            'from_date' => 'required',
            'to_date' =>'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = NULL;
        $year = date("Y/m"); 
        if($request->file('image')){
            $imageName = $request->file('image')->store($year,['disk'=> 'uploads']);
            $imageName = url('wp-content/uploads/'.$imageName);
        }

        $run_partner = new Freedomrunpartners();
        $run_partner->org_name = $request->org_name;
        $run_partner->event_name = $request->event_name;
        $run_partner->email_id = $request->email;
        $run_partner->contact = $request->contact;
        $run_partner->from_date = $request->from_date;
        $run_partner->to_date = $request->to_date;
        $run_partner->photo = $imageName;
        $run_partner->website_link = $request->website_link;
        if($run_partner->save()){
           return back()->with('success','Once approve your event will be listed'); 
        }else{
           return back()->with('failed','Something Wrong')->withInput(); 
        }
		
        return redirect('partner-organization');
    }
	
    public function freedomrunInfo(){
		
        $freedom_partner_detail = Freedomrunpartners::where('status','1')->get();
        // dd($freedom_partner_detail);
        return view('freedomrun.freedom-run-info',compact('freedom_partner_detail')); 
    }
	
    public function showEventUpdateDetails($id, Request $request){
        if (isset(auth()->user()->role)){
            $role = Auth::user()->role;
            $events = DB::table('freedomruns')
                ->leftJoin('users', 'freedomruns.user_id', '=', 'users.id')
                ->select('users.name','users.email as useremail','users.phone','users.role', 'freedomruns.*')
                ->where('freedomruns.id',$id)
                ->first();

            return view('freedomrun.update_event_new', ['role' => $role , 'events' => $events ]);
        }else{
            return redirect('/login');
        }  
    }
	
    public function freedomCertificateProcess($id,Request $request)
    {
        if (isset(auth()->user()->role)){
            $role = Auth::user()->role;
            //$role = Role::where('slug', $role)->first()->name;
            $users = DB::table('users')
                    ->join('freedomruns','users.id','=','freedomruns.user_id')
                    ->select(['users.role','users.name','users.email','freedomruns.id','freedomruns.participant_names','freedomruns.organiser_name', 'freedomruns.eventstartdate','freedomruns.eventenddate'])
                    ->where('freedomruns.user_id', Auth::user()->id)
                    ->where('freedomruns.id', $id)
                    ->first();
            
            return view('freedomrun.freedomrun-certificate-process',compact('role','users'));    
        }else{
            return redirect('/login');
        }  

    }
    public function downloadFreedomCertificate(Request $request){ 
        //$eventname = $request->name;
        $eventname = $request->organiser_name;
        $participant = $request->participant;
        $certificate_type = $request->cert_type;
        if($certificate_type == 'participant'){
            $pdf = PDF::loadView('freedomrun.freedom-participant-certificate',['organiser_name' => $eventname, 'participant_name'=> $participant])->setPaper('a4', 'landscape');
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
            );
            //return $pdf->stream($participant.".pdf");
            return $pdf->download($participant.".pdf");
        }else{
            $pdf = PDF::loadView('freedomrun.freedom-organizer-certificate',['name' =>  $eventname])->setPaper('a4', 'landscape');
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
            );
            //return $pdf->stream($eventname.".pdf");
            return $pdf->download($eventname.".pdf");
        }
    }
	
    public function freedomrunEvents(){
        if (isset(auth()->user()->role)){
            $role = Auth::user()->role;
            if($role){
                $freedom_events = Freedomrun::where('user_id', Auth::user()->id)->where('category', 13060)->orderBy('id', 'DESC')->get();  
                $role = Role::where('slug', $role)->first()->name;
                return view('freedomrun.freedomrun-events', ['role' => $role, 'freedom_event' =>$freedom_events, 'year'=>'22']);
            }
        }else{
            return redirect('/login');
        }
    }
	
	public function myEventsByYear($id){

        if (isset(auth()->user()->role)){
            $role = Auth::user()->role;
                if($role){
                if($id=='22'){ 
                    $catid = '13060';
                }else{
                    $catid = '13008';
                }
                    
                $freedom_events = Freedomrun::where('user_id', Auth::user()->id)->get();  
                $role = Role::where('slug', $role)->first()->name;
                return view('freedomrun.freedomrun-events', ['role' => $role, 'freedom_event' =>$freedom_events, 'year'=> $catid]);
            }
        }else{
            return redirect('/login');
        }
    }
	
	public function mobileFreedomrunEvents(){ 
        $id = @$_REQUEST['auth_id'];
        if(!empty($id)){ 
            echo $id;
            $user = DB::table('users')->where('id',$id)->first();
            $role = Role::where('slug', $user->role)->first();
            if(!empty($user)){ 
                $freedom_events = Freedomrun::where('user_id', $id)->get();  
                if(!empty($events)){ 
                    return view('freedomrun.freedomrun-events-mobile', ['role' => $role, 'freedom_event' =>$freedom_events]);
                }else{
                     return view('freedomrun.freedomrun-events-mobile', ['role' => $role, 'freedom_event' =>$freedom_events]);
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    public function freedomrunEventDestroy($id){
        $res = Freedomrun::where('id', $id )->delete();
        return back()->with('success','Event successsfully Deleted');
    
    }
	
    public function freedomrunEventsPics(){
        if (isset(auth()->user()->role)){
            $role = Auth::user()->role;
            if($role){
                $role = Role::where('slug', $role)->first()->name;
                $freedomrun_event = Freedomrun::where( 'user_id', Auth::user()->id )->get(['eventimg_meta']);
                // return view('freedomrun.freedomrun-eventpic', ['role' => $role, 'events' => $freedomrun_event, 'year'=>'3']);
                return view('freedomrun.freedomrun-eventpic', ['role' => $role, 'events' => $freedomrun_event, 'year'=>'3']);
            }else{
                redirect('home');
            }
        }else{
            return redirect('/login');
        }
    }
   /* public function addCorporate(){ 
        $role = Auth::user()->role;
        if($role){
            return view('corporate/add-corporate');
        }else{
            redirect('home');
        }
    }*/  
    
    public function mobileviewFreedomCertificate($name,$eventname,$type){
        // dd($eventname);
        $eventname = $name;
        $participant = $eventname;
        $type = $type;
        if($type == 'type'){
            // return view('freedomrun.freedom-participant-certificate',['organiser_name' => $eventname, 'participant_name'=> $participant]);

            
            $pdf = PDF::loadView('freedomrun.freedom-participant-certificate',['organiser_name' => $eventname, 'participant_name'=> $participant])->setPaper('a4', 'landscape');
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
            );
            //return $pdf->stream($participant.".pdf");
            return $pdf->download($participant.".pdf");
        }else{
            return view('freedomrun.freedom-participant-certificate',['organiser_name' => $eventname, 'participant_name'=> $participant]);
            $pdf = PDF::loadView('freedomrun.freedom-organizer-certificate',['name' =>  $eventname])->setPaper('a4', 'landscape');
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
            );
            //return $pdf->stream($eventname.".pdf");
            return $pdf->download($eventname.".pdf");
        }


    }

    public function mobiledownloadFreedomCertificate($user_id,$event_id){
        // dd("done");
        $current_timestamp = Carbon::now()->getTimestampMs();
        $data = Trackingpic::with(['eventDetails'=>function($q){
            $q= $q->whereStatus(true);
        },'userDetails:id,name'])
        ->where('status', 1)->where([['user_id', '=', $user_id],['event_id','=',$event_id]])->latest('id')->first();            
        // dd($data->image);
        $image = $data->image ?? 'https://fitindia.gov.in/wp-content/uploads/trackingpic/2023/09/OfSmbJGHoRQfwd5VwczJnQ9G3oJ0Efd43I0KztOE.jpg';
        $participant = $data->userDetails->name ?? 'No Name';
        $eventDetails = $data->eventDetails->name ?? 'No Name';
        // dd($data);
        // return view('freedomrun.freedom-participant-certificate',['organiser_name' => $eventDetails, 'participant_name'=> $participant,'map_image'=> $image]);
        
        $pdf = PDF::loadView('freedomrun.freedom-mobile-participant-certificate',
        [
            'organiser_name' => $eventDetails, 
            'participant_name'=> $participant,
            'map_image'=> $image
        ])
            ->setPaper('a4', 'landscape');
        
        $pdf->getDomPDF()->setHttpContext(
        
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        
        );            
        
        return $pdf->download($participant."-".$current_timestamp.".pdf");  
        


    }

    public function socmobiledownloadFreedomCertificate($user_id,$os_type,$event_id,$usermeta_datadistrict,$usermeta_data_state,$user_date){
        // dd("done");
        $current_timestamp = Carbon::now()->getTimestampMs();
        $cer_date = date("mY");
        $serialno = 'FI#'.$cer_date.'#';
        $data = Trackingpic::with(['eventDetails'=>function($q){
            $q= $q->whereStatus(true);
        },'userDetails:id,name'])
        ->where('status', 1)->where([['user_id', '=', $user_id],['event_id','=',$event_id]])->latest('id')->first();
        // dd($data->image);
        $image = $data->image ?? 'https://fitindia.gov.in/wp-content/uploads/trackingpic/2023/09/OfSmbJGHoRQfwd5VwczJnQ9G3oJ0Efd43I0KztOE.jpg';
        $participant = $data->userDetails->name ?? 'No Name';
        $eventDetails = $data->eventDetails->name ?? 'No Name';
        $categories = EventCat::where('id','=',$event_id)->orderBy('id', 'DESC')->first();
        // dd($user_date);
        $user_data = User::where('id','=',$user_id)->orderBy('id', 'DESC')->first();
        // dd($user_data[0]['name']);
        if(isset($user_data)){
            $participant = $user_data['name'] ?? "No name";
            $categoriename = $categories['name'] ?? "Soc";
        }
        // dd($user_data['name']);
        $certificationtracking = new CertificationTrackings();
        $certificationtracking->user_id = $user_id;
        $certificationtracking->name = $user_data['name'];
        $certificationtracking->user_type = $os_type;
        $certificationtracking->event_id = $event_id;
        $certificationtracking->event_name = $categories['name'];
        $certificationtracking->event_participant_certification_name = $participant;
        $certificationtracking->status = 1;
        $certificationtracking->save();
        $last_id = $certificationtracking->id;
        $serialno_with_id = $serialno .$last_id;
        // dd($serialno_with_id);
        CertificationTrackings::where('id', '=', $last_id)->update(['serialno_with_id' => $serialno_with_id]);

        // dd($data);
        // return view('freedomrun.freedom-participant-certificate',['organiser_name' => $eventDetails, 'participant_name'=> $participant,'map_image'=> $image]);

        $pdf = PDF::loadView('freedomrun.soc-freedom-mobile-participant-certificate',
        [
            'organiser_name' => $eventDetails,
            'participant_name'=> $participant,
            'usermeta_datadistrict'=> $usermeta_datadistrict,
            'usermeta_data_state'=> $usermeta_data_state,
            'user_date'=> $user_date,
            'serialno_with_id'=> $serialno_with_id,
            'map_image'=> $image
        ])
            ->setPaper('a4', 'landscape');

        $pdf->getDomPDF()->setHttpContext(

            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])

        );

        return $pdf->download($participant."-".$current_timestamp.".pdf");



    }
}
