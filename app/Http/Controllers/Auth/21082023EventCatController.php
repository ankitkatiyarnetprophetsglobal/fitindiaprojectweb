<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\SchoolWeek;
use App\Models\Eventorganizations;
use App\Models\Freedomrunpartners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Usermeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\EventCat;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class EventCatController extends Controller
{

    public function createFreedomrunEvent(){  

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

                return view('fitIndiaevent.add-organization-event', ['role' => $role , 'userdata' => $userdata,'categories'=> $categories ]);

            }else{

                abort(404);

            }
        }else{
            abort(404);
        }
    }
    
    public function create(){
    }
    
    public function store(Request $request){
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'org_name' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'school_chain' => 'required',
                'event_bg_image' => 'nullable|file|max:2047|mimes:jpeg,jpg,png',
                'prt_image.*' => 'nullable|file|max:2047|mimes:jpeg,jpg,png',
                'from_date' => 'required',
                'to_date' => 'required',
            ],[
                'org_name.required' => 'Please Enter Organization / Institution / Group / School Name',
                'contact.required' => 'Please Enter Contact Number',
                'school_chain.required' => 'Please Select School Chain',
                'event_bg_image.max' => 'Event Background Image Must be Less Than 2 MB.',
                'event_bg_image.mimes' => 'Event Background Image Must in .jpg/.jpeg/.png',
                'prt_image.*.max' => 'Event Picture Must be Less Than 2 MB.',
                'prt_image.*.mimes' => 'Event Picture Must in .jpg/.jpeg/.png',
                'from_date.required' => 'Please Select Event Start Date',
                'to_date.required' => 'Please Select Event End Date',
            ]);
        // dd($validator->errors());
            if ($validator->fails()) {
                Session::flash('error_message', $validator->errors()->first());
                return back()->withInput();
                // $this->errorOutput['status'] = 400;
                // $this->errorOutput['message'] = $validator->errors()->first();
                // $this->output($this->errorOutput);
            }
            $year = date("Y/m"); 
            $imgurl = array();
            if($request->hasfile('event_bg_image')) { 
                
                    $name = $request->file('event_bg_image')->getClientOriginalName();
                    $name = $request->file('event_bg_image')->store($year,['disk'=> 'uploads']);
                    $name = url('wp-content/uploads/'.$name);
                    $event_background_image = $name;
            
            }
            if($request->hasfile('prt_image')) { 
                foreach($request->file('prt_image') as $file){ 
                    $name = $file->getClientOriginalName();
                    $name = $file->store($year,['disk'=> 'uploads']);
                    $name = url('wp-content/uploads/'.$name);
                    $imgurl[] = $name;
                }
            }
            // dd($request->all());
            $run = new Eventorganizations();
            $run->user_id = Auth::user()->id;
            $run->category = 13061; // event category from event_cat table
            $run->event_name_store = $request->event_name_store;
            $run->name = $request->name;
            $run->email = $request->email;
            $run->contact = $request->contact;
            $run->school_chain = $request->school_chain;
            $run->eventstartdate = $request->from_date;
            $run->eventenddate = $request->to_date;
    
        // $run->school_chain = $request->school_chain ? $request->school_chain : '';
            $run->eventimg_meta = serialize($imgurl);
            $run->event_bg_image = isset($event_background_image) ? $event_background_image : null;
            $run->eventdate_meta = serialize($request->prt_date);
            $run->eventpnt_meta = serialize($request->number_of_partcipant);
            $run->eventkm_meta = serialize($request->km);

            // $run->total_participant = array_sum($request->number_of_partcipant);
            // $run->total_kms = array_sum($request->km);

            $run->organiser_name = $request->org_name;
            $run->role = 'organizer';
            $run->video_link = serialize($request->video_link);


            if($run->save()){
                // return redirect('school-events')->with('success', 'Congratulations, your event has been successfully created.');   
                return redirect('list-events')->with('success', 'Congratulations, your event has been successfully created.');   
            }else{
                return back()->with('failed','Something Wrong')->withInput();
            }
        } catch (\Exception $ex) {

            $Message =  $ex->getMessage();
            return back()->with('failed', $Message)->withInput();            
        } 
    }

    public function freedomrunEvents(){
        
        $role = Auth::user()->role;
        if($role){
            $freedom_events = Eventorganizations::where('user_id', Auth::user()->id)->where('category', 13061)->orderBy('id', 'DESC')->get();  
            $role = Role::where('slug', $role)->first()->name;
            return view('fitIndiaevent.list-events', ['role' => $role, 'freedom_event' =>$freedom_events, 'year'=>'22']);
        }
    }

    public function update($id, Request $request){

        // dd(231231313);
        $role = Auth::user()->role;
        $events = DB::table('event_organizations')
            ->leftJoin('users', 'event_organizations.user_id', '=', 'users.id')
            ->select('users.name','users.email as useremail','users.phone','users.role', 'event_organizations.*')
            ->where('event_organizations.id',$id)
            ->first();
        return view('fitIndiaevent.event_update', ['role' => $role , 'events' => $events ]);
    }

    public function edit(Request $request){
		// dd($request->all());
        $validator = Validator::make($request->all(), [
            'org_name' => 'required',
            'event_bg_image' => 'nullable|file|max:2047|mimes:jpeg,jpg,png',
            'prt_image.*' => 'nullable|file|max:2047|mimes:jpeg,jpg,png',
            'from_date' => 'required',
            'to_date' => 'required',
        ],[
            // 'contact.required' => 'Please Enter Contact Number',
             'org_name.required' => 'Please Enter Organization / Institution / Group / School Name',
            'event_bg_image.max' => 'Event Background Image Must be Less Than 2 MB.',
            'event_bg_image.mimes' => 'Event Background Image Must in .jpg/.jpeg/.png',
            'prt_image.*.max' => 'Event Picture Must be Less Than 2 MB.',
            'prt_image.*.mimes' => 'Event Picture Must in .jpg/.jpeg/.png',
            'from_date.required' => 'Please Select Event Start Date',
            'to_date.required' => 'Please Select Event End Date',
        ]);
        
        if ($validator->fails()) {
            Session::flash('error_message', $validator->errors()->first());
            return back()->withInput();
            // $this->errorOutput['status'] = 400;
            // $this->errorOutput['message'] = $validator->errors()->first();
            // $this->output($this->errorOutput);
        }
		
        $year = date("Y/m"); 
        $imgurl = array();
        if($request->hasfile('event_bg_image')) { 
            
            $name = $request->file('event_bg_image')->getClientOriginalName();
            $name = $request->file('event_bg_image')->store($year,['disk'=> 'uploads']);
            $name = url('wp-content/uploads/'.$name);
            $event_background_image = $name;
       
       }
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

        // $total_participant = array_sum($request->number_of_partcipant);
        // $total_km = array_sum($request->km);
        $school_chains = $request->school_chain ? $request->school_chain : '';
        $freedom_update = Eventorganizations::where('id', '=', $request->id)->update(['organiser_name' => $request->org_name, 'contact' => $request->contact,'email' => $request->email,'school_chain'=>$school_chains, 'eventstartdate' => $request->from_date, 'eventenddate' => $request->to_date,'eventimg_meta' => serialize($new_imgurl),'eventdate_meta' => serialize($request->prt_date),'eventpnt_meta' => serialize($request->number_of_partcipant),'eventkm_meta' => serialize($request->km),'video_link' => serialize($request->video_link),'event_bg_image' => isset($event_background_image) ? $event_background_image : null]);


        if($freedom_update){
            // return redirect('school-updatedetail/'.$request->id)->with('success', 'Your event has been successfully updated.');   
            return redirect('event-updatedetail/'.$request->id)->with('success', 'Your event has been successfully updated.');   
        }else{
            return back()->with('failed','Something Wrong')->withInput();
        }
    }
    
    public function showEventUpdateDetails($id, Request $request){
        $role = Auth::user()->role;
        $events = DB::table('event_organizations')
            ->leftJoin('users', 'event_organizations.user_id', '=', 'users.id')
            ->select('users.name','users.email as useremail','users.phone','users.role', 'event_organizations.*')
            ->where('event_organizations.id',$id)
            ->first();

        return view('fitIndiaevent.event_update_event_new', ['role' => $role , 'events' => $events ]);
    }

    public function freedomrunEventDestroy($id){

        $res = Eventorganizations::where('id', $id )->delete();
        return back()->with('success','Event successsfully Deleted');
    
    }

    public function Uploadexcel($id){
        // dd('i am here');
        //$event = Event::find($id);
        $event = Eventorganizations::where( 'user_id', Auth::user()->id )->find($id);
            
        $role = Auth::user()->role;
        //$role  = Role::where('slug',)->first();
        $role = Role::where('slug', $role)->first()->name;
        return view('fitIndiaevent.bluck_upload_excel',compact('role','event'));
        // $role = Auth::user()->role;
        // $event = Freedomrun::find($id);
        // return view('freedomrun.freedomrun_bulkUploadExcel',compact('event','role'));

    }

    public function updateBulkUploadExcel(Request $request){ 
   
        // dd(1231313131);
        //    $request->validate([
        //        'user_id' => 'required',
        //        'ex_file_sheet' => 'required|file|mimes:xlsx, csv, xls', //|size:2048
        //    ],[
        //        'ex_file_sheet.required' => 'This Input is required.',
        //        'ex_file_sheet.file' => 'Please choose a file (.xlsx, .csv, .xls).',
        //        'ex_file_sheet.mimes' => 'Please choose a file (.xlsx, .csv, .xls).',
        //    ]);



        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            //'ex_file_sheet' => 'required|mimes:xlsx, csv, xls',
        ],[
            'ex_file_sheet.required' => 'This Input is required.',
            //'ex_file_sheet.mimes' => 'Please choose a file (.xlsx, .csv, .xls).',
        ]);

        if ($validator->fails()) {
            Session::flash('error_message', $validator->errors()->first());
            return back()->withInput();
            // $this->errorOutput['status'] = 400;
            // $this->errorOutput['message'] = $validator->errors()->first();
            // $this->output($this->errorOutput);
        }
        
        $extensions = array("xls","xlsx","csv");
        
        $result = array($request->file('ex_file_sheet')->getClientOriginalExtension());
        
        if(in_array($result[0],$extensions)){
            
        }else{
            Session::flash('error_message', 'Please choose a file (.xlsx, .csv, .xls).');
            return back()->withInput();
        }
        
        $event = Eventorganizations::find($request->id);
        
        if(isset($event->excel_sheet)){
        
            Storage::delete('public/excel/' . $event->excel_sheet);
        }

        $excel_sheet = time() . 'excel_' . $request->file('ex_file_sheet')->getClientOriginalName();
        Storage::disk('public')->put('excel/' . $excel_sheet, file_get_contents($request->file('ex_file_sheet')));
        
        $event->excel_sheet = $excel_sheet;
        $event->save();
        return back()->with('success','Data Upload successsfully');

    }

    public function freedomCertificateProcess($id,Request $request){
        // dd(1312331);
        $role = Auth::user()->role;
        //$role = Role::where('slug', $role)->first()->name;
        $users = DB::table('users')
                ->join('event_organizations','users.id','=','event_organizations.user_id')
                ->select(['users.role','users.name','users.email','event_organizations.id','event_organizations.participant_names','event_organizations.organiser_name', 'event_organizations.eventstartdate','event_organizations.eventenddate'])
                ->where('event_organizations.user_id', Auth::user()->id)
                ->where('event_organizations.id', $id)
                ->first();
       
        // return view('fitIndiaevent.school-certificate-process',compact('role','users','id'));       
        return view('fitIndiaevent.event-certificate-process',compact('role','users','id'));       

    }

    public function eventaddPartcipant($id){
        // dd(1);
        $role = Auth::user()->role;
        $event = Eventorganizations::find($id);
       
        return view('fitIndiaevent.event-add-participant',compact('event','role'));
    }

    public function updateFreedomRunParticipant(Request $request){   
        $request->validate([
            'participant_names' => 'required',
        ],[
            'participant_names.required' => 'Please Enter Participant Name.',
            //'participant_names.regex' => 'Please Enter valid Participant Name.',
        ]);
        $memberlist = $request->participant_names;
        $memberlist = explode(PHP_EOL, $memberlist);
        //dd(empty($memberlist));
        if(!empty($memberlist)){
          $count = count($memberlist);
        }else{
            $count = 0;  
        }
        $freedom_participant_update = Eventorganizations::where('id', '=', $request->id)->update(['participant_names' => serialize($memberlist),'total_participant' => $count]);

        if($freedom_participant_update){
            //  return redirect('school-updatedetail/'.$request->id);
             return redirect('event-updatedetail/'.$request->id);
        }else{
             return back()->with('success','Participants updated successsfully');
        }
    }

    public function downloadFreedomCertificate(Request $request){ 
        // dd($request->all());
         $eventname = $request->name;
         $organiser_name = $request->organiser_name;
         
         $participant = $request->participant;
         $certificate_type = $request->cert_type;
         
         if($certificate_type == 'participant'){
             //return view('freedomrun.school-participant-certificate',['organiser_name' => $eventname, 'participant_name'=> $participant]);
            //  $pdf = PDF::loadView('fitIndiaevent.school-participant-certificate',['organiser_name' => $organiser_name, 'participant_name'=> $participant])->setPaper('a4', 'landscape');
             $pdf = PDF::loadView('fitIndiaevent.event-participant-certificate',['organiser_name' => $organiser_name, 'participant_name'=> $participant])->setPaper('a4', 'landscape');
             $pdf->getDomPDF()->setHttpContext(
             stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
             );
             //return $pdf->stream($participant.".pdf");
             return $pdf->download($participant.".pdf");
         }else{
          //return view('freedomrun.school-organizer-certificate',['name' =>  $eventname]);
            //  $pdf = PDF::loadView('fitIndiaevent.school-organizer-certificate',['name' =>  $organiser_name])->setPaper('a4', 'landscape');
             $pdf = PDF::loadView('fitIndiaevent.event-organizer-certificate',['name' =>  $organiser_name])->setPaper('a4', 'landscape');
             $pdf->getDomPDF()->setHttpContext(
             stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
             );
             return $pdf->download($organiser_name.".pdf");
            // return $pdf->download(".pdf");
         }
    }








    public function show(Freedomrun $freedomrun){
        $id = Auth::user()->id;
        $events = Freedomrun::where('user_id',$id)->get();  
        return view('freedum_events',compact('events'));
    }

    public function destroy(Freedomrun $freedomrun){
        //
    }
    public function addIndividualFreedomRun(Request $request){
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
            $run->category = 13060; //  previous 13008 event category from event_cat table
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
        return redirect('freedom-run-2.0');
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
       
        return view('freedomrun.freedom-run-info',compact('freedom_partner_detail')); 
    }
	
    
	
    
    
    
	
    
	
	public function myEventsByYear($id){
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
	
    public function freedomrunEventsPics(){
        $role = Auth::user()->role;
        if($role){
            $role = Role::where('slug', $role)->first()->name;
            $freedomrun_event = Freedomrun::where( 'user_id', Auth::user()->id )->get(['eventimg_meta']);
            return view('freedomrun.freedomrun-eventpic', ['role' => $role, 'events' => $freedomrun_event, 'year'=>'3']);
        }else{
            redirect('home');
        }
    }
   
    

    
}
