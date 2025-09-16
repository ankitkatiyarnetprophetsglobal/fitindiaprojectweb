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
use App\Models\State;
use App\Models\CertificationTrackings;
use App\Models\Eventactivitydropdowns;
use App\Models\District;
use Carbon\Carbon;

class EventCatController extends Controller
{

    public function createFreedomrunEvent(){

        try{
            if (isset(auth()->user()->role)){
                    $role = Auth::user()->role;
                    $a_id = Auth::user()->id;
                if (Auth::check()){
                    $categories = EventCat::where('status', '=', 2)->orderBy('id', 'DESC')->get();
                    $state = State::whereStatus(true)->orderBy('name', 'ASC')->get();
                    $userdata = user::with('usermeta')->find($a_id);
                    $Usermeta_data = Usermeta::where('user_id','=',Auth::user()->id)->orderBy('id', 'DESC')->first();
                    $usermeta_data_state = $Usermeta_data['state'];
                    $usermeta_datadistrict = $Usermeta_data['district'];
                    $districts = District::whereStatus(true)->orderBy('name', 'ASC')->get();
                    Session::put('usermeta_role_data', $Usermeta_data['cyclothonrole']);
                    $eventactivitydropdowns = Eventactivitydropdowns::where('status',1)->orderBy('id', 'DESC')->get();
                    if(!empty($userdata)){
                        return view('event.add-organization-event', [
                                    'role' => $role ,
                                    'userdata' => $userdata,
                                    'categories'=> $categories,
                                    'districts'=> $districts,
                                    'eventactivitydropdowns'=> $eventactivitydropdowns,
                                    'usermeta_datadistrict'=> $usermeta_datadistrict,
                                    'usermeta_data_state'=> $usermeta_data_state,
                                    'state'=> $state
                                ]);

                    }else{

                         return redirect('/login');

                    }
                }else{

                    return redirect('/login');

                }

            }else{
                return redirect('/login');

            }
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function create(){

    }

    public function store(Request $request){
        try {
           
            $validator = Validator::make($request->all(), [
                'category_name' => 'required',
                'org_name' => 'required',
                'contact' => 'required',
                // 'email' => 'required',
                'state' => 'required',
                'districts' => 'required',
                // 'school_chain' => 'required',
                'event_bg_image' => 'nullable|file|max:2047|mimes:jpeg,jpg,png',
                'prt_image.*' => 'nullable|file|max:2047|mimes:jpeg,jpg,png',
                'from_date' => 'required',
                'to_date' => 'required',
                'addparticipants' => 'nullable|integer|min:0',
            ],[
                'category_name.required' => 'Please Select Event Name',
                'org_name.required' => 'Please Enter Organization / Institution / Group / School Name',
                'contact.required' => 'Please Enter Contact Number',
                'state.required' => 'Please Select State',
                'districts.required' => 'Please Select Districts',
                // 'school_chain.required' => 'Please Select Chain',
                'event_bg_image.max' => 'Event Background Image Must be Less Than 2 MB.',
                'event_bg_image.mimes' => 'Event Background Image Must in .jpg/.jpeg/.png',
                'prt_image.*.max' => 'Event Picture Must be Less Than 2 MB.',
                'prt_image.*.mimes' => 'Event Picture Must in .jpg/.jpeg/.png',
                'from_date.required' => 'Please Select Event Start Date',
                'to_date.required' => 'Please Select Event End Date',
                 'addparticipants.min' => 'Please enter a value greater than or equal to 0.',
            ]);
            if ($validator->fails()) {
                Session::flash('error_message', $validator->errors()->first());
                return back()->withInput();
            }
            $year = date("Y/m");
            $imgurl = array();
            $event_name_store = $request['event_name_store'];
            $state = $request['state'];
            $districts = $request['districts'];
            if($request->hasfile('event_bg_image')) {
                $name = $request->file('event_bg_image')->getClientOriginalName();
                $image_path = $event_name_store.'/'.$state.'/'.Auth::user()->name;
                $name = $request->file('event_bg_image')->store($image_path,['disk'=> "uploads"]);
                $name = url('wp-content/uploads/'.$name);
                $event_background_image = $name;

            }
            if($request->hasfile('prt_image')) {
                foreach($request->file('prt_image') as $file){
                    $name = $file->getClientOriginalName();
                    $name = $file->store($event_name_store.'/'.$state.'/'.Auth::user()->name.'/'.'event_image',['disk'=> 'uploads']);
                    $name = url('wp-content/uploads/'.$name);
                    $imgurl[] = $name;

                }
            }
            $run = new Eventorganizations();
            $run->user_id = Auth::user()->id;
            $run->category = $request->category_name; // event category from event_cat table
            $run->event_activity = $request->event_activity; // event category from event_cat table
            $run->event_name_store = $request->event_name_store;
            $run->name = $request->name;
            $run->email = $request->email;
            $run->contact = $request->contact;
            $run->state = $state;
            $run->districts = $districts;
            $run->participantnum = $request->addparticipants;
            $run->school_chain = $request->school_chain;
            $run->eventstartdate = $request->from_date;
            $run->eventenddate = $request->to_date;
            $run->eventimg_meta = serialize($imgurl);
            $run->event_bg_image = isset($event_background_image) ? $event_background_image : null;
            $run->eventdate_meta = serialize($request->prt_date);
            $run->eventpnt_meta = serialize($request->number_of_partcipant);
            $run->eventkm_meta = serialize($request->km);
            $run->organiser_name = $request->org_name;
            $run->role = 'organizer';
            $run->video_link = serialize($request->video_link);


            if($run->save()){

                return redirect('list-events')->with('success', 'Congratulations, your event has been successfully created.');

            }else{

                return back()->with('failed','Something Wrong')->withInput();

            }
        } catch (\Exception $ex) {

            $Message =  $ex->getMessage();
            return back()->with('failed', $Message)->withInput();
        }
    }

    public function listofEvents(){

        try{
            if (isset(auth()->user()->role)){

                $role = Auth::user()->role;

                if($role){
                    if (isset(auth()->user()->rolewise)){
                        if(auth()->user()->rolewise == 'cyclothon-2024'){
                            $now = Carbon::now()->toDateString();
                            $freedom_events = Eventorganizations::
                                            where('user_id', Auth::user()->id)
                                            ->whereRaw("eventstartdate <=  date('$now')")
                                            ->whereRaw("eventenddate >=  date('$now')")
                                            ->orderBy('id', 'DESC')->first();
                            if(!empty($freedom_events)){
                                $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
                                $freedom_events = Eventorganizations::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                                $role = Role::where('slug', $role)->first()->name;

                                return view('event.list-events', [
                                            'role' => $role,
                                            'freedom_event' =>$freedom_events,
                                            'categories' =>$categories,
                                            'year'=>'22'
                                        ]);

                            }else{

                                $DayOfWeekNumber = date("w");

                                switch($DayOfWeekNumber)
                                {
                                    case 0 :
                                        $date = date_create(date("Y-m-d"));
                                        $start_date = date_add($date,date_interval_create_from_date_string("0 days"));
                                        $start_date_format =  date_format($start_date,"Y-m-d");
                                        $dateend = date_create(date("Y-m-d"));
                                        $end_date = date_add($dateend,date_interval_create_from_date_string("6 days"));
                                        $end_date_format =  date_format($end_date,"Y-m-d");
                                        break;
                                    case 1 :
                                        $date = date_create(date("Y-m-d"));
                                        $start_date = date_add($date,date_interval_create_from_date_string("-1 days"));
                                        $start_date_format =  date_format($start_date,"Y-m-d");
                                        $dateend = date_create(date("Y-m-d"));
                                        $end_date = date_add($dateend,date_interval_create_from_date_string("5 days"));
                                        $end_date_format =  date_format($end_date,"Y-m-d");
                                        break;
                                    case 2 :
                                        $date = date_create(date("Y-m-d"));
                                        $start_date = date_add($date,date_interval_create_from_date_string("-2 days"));
                                        $start_date_format =  date_format($start_date,"Y-m-d");
                                        $dateend = date_create(date("Y-m-d"));
                                        $end_date = date_add($dateend,date_interval_create_from_date_string("4 days"));
                                        $end_date_format =  date_format($end_date,"Y-m-d");
                                        break;
                                    case 3 :
                                        $date = date_create(date("Y-m-d"));
                                        $start_date = date_add($date,date_interval_create_from_date_string("-3 days"));
                                        $start_date_format =  date_format($start_date,"Y-m-d");
                                        $dateend = date_create(date("Y-m-d"));
                                        $end_date = date_add($dateend,date_interval_create_from_date_string("3 days"));
                                        $end_date_format =  date_format($end_date,"Y-m-d");
                                        break;
                                    case 4 :
                                       
                                        $date = date_create(date("Y-m-d"));
                                        $start_date = date_add($date,date_interval_create_from_date_string("-4 days"));
                                        $start_date_format =  date_format($start_date,"Y-m-d");
                                        $dateend = date_create(date("Y-m-d"));
                                        $end_date = date_add($dateend,date_interval_create_from_date_string("2 days"));
                                        $end_date_format =  date_format($end_date,"Y-m-d");
                                        break;
                                    case 5 :
                                        $date = date_create(date("Y-m-d"));
                                        $start_date = date_add($date,date_interval_create_from_date_string("-5 days"));
                                        $start_date_format =  date_format($start_date,"Y-m-d");
                                        $dateend = date_create(date("Y-m-d"));
                                        $end_date = date_add($dateend,date_interval_create_from_date_string("1 days"));
                                        $end_date_format =  date_format($end_date,"Y-m-d");
                                        break;
                                    case 6 :
                                        $date = date_create(date("Y-m-d"));
                                        $start_date = date_add($date,date_interval_create_from_date_string("-6 days"));
                                        $start_date_format =  date_format($start_date,"Y-m-d");
                                        $dateend = date_create(date("Y-m-d"));
                                        $end_date = date_add($dateend,date_interval_create_from_date_string("0 days"));
                                        $end_date_format =  date_format($end_date,"Y-m-d");
                                        break;
                                }

                                    $user_information = Usermeta::where('user_id','=',Auth::user()->id)->orderBy('id', 'DESC')->first();
                                    $categories_name = EventCat::where('status',2)->where('id','=',13078)->orderBy('id', 'DESC')->first();
                                    $imgurl = null;
                                    $prt_date = null;
                                    $number_of_partcipant = null;
                                    $video_link = null;
                                    $km = null;
                                    $run = new Eventorganizations();
                                    $run->user_id = Auth::user()->id;
                                    $run->category = $categories_name['id']; // event category from event_cat table
                                    $run->event_name_store = $categories_name['name'];
                                    $run->name = Auth::user()->name;
                                    $run->email = Auth::user()->email;
                                    $run->contact = Auth::user()->phone;
                                    $run->state = $user_information['state'];
                                    $run->participantnum = $user_information['participant_number'];
                                    $run->school_chain = null;
                                    $run->eventstartdate = $start_date_format;
                                    $run->eventenddate = $end_date_format;
                                    $run->eventimg_meta = "a:0:{}";
                                    $run->event_bg_image = isset($event_background_image) ? $event_background_image : null;
                                    $run->eventdate_meta = serialize($prt_date);
                                    $run->eventpnt_meta = serialize($number_of_partcipant);
                                    $run->eventkm_meta = serialize($km);
                                    $run->organiser_name = Auth::user()->name;
                                    $run->role = 'organizer';
                                    $run->video_link = "a:1:{i:0;N;}";
                                    $run->save();

                                    $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
                                    $freedom_events = Eventorganizations::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                                    $role = Role::where('slug', $role)->first()->name;

                                    return view('event.list-events', [
                                                                    'role' => $role,
                                                                    'freedom_event' =>$freedom_events,
                                                                    'categories' =>$categories,
                                                                    'year'=>'22'
                                                                ]);
                            }

                        }else{

                            $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
                            $freedom_events = Eventorganizations::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                            $role = Role::where('slug', $role)->first()->name;

                            return view('event.list-events', [
                                                            'role' => $role,
                                                            'freedom_event' =>$freedom_events,
                                                            'categories' =>$categories,
                                                            'year'=>'22'
                                                        ]);

                        }

                    }else{

                            if(auth()->user()->role == 'namo-fit-india-cycling-club'){

                                $now = Carbon::now()->toDateString();
                                $freedom_events = Eventorganizations::
                                                where('user_id', Auth::user()->id)
                                                ->whereRaw("eventstartdate <=  date('$now')")
                                                ->whereRaw("eventenddate >=  date('$now')")
                                                ->orderBy('id', 'DESC')->first();
                                // echo '<pre>';
                                // print_r($freedom_events);
                                if(!empty($freedom_events)){

                                    // $categories = EventCat::where('status',2)->where('id','=',13078)->orderBy('id', 'DESC')->get();
                                    $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
                                    $freedom_events = Eventorganizations::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                                    $role = Role::where('slug', $role)->first()->name;

                                    return view('event.list-events', [
                                                'role' => $role,
                                                'freedom_event' =>$freedom_events,
                                                'categories' =>$categories,
                                                'year'=>'22'
                                            ]);

                                }else{

                                    $DayOfWeekNumber = date("w");

                                    switch($DayOfWeekNumber)
                                    {
                                        case 0 :
                                            // echo("Today is Sunday.");
                                            $date = date_create(date("Y-m-d"));
                                            $start_date = date_add($date,date_interval_create_from_date_string("0 days"));
                                            $start_date_format =  date_format($start_date,"Y-m-d");
                                            // echo $start_date_format;
                                            $dateend = date_create(date("Y-m-d"));
                                            $end_date = date_add($dateend,date_interval_create_from_date_string("6 days"));
                                            $end_date_format =  date_format($end_date,"Y-m-d");
                                            // dd($end_date_format);
                                            break;
                                        case 1 :
                                            // echo("Today is Monday.");
                                            $date = date_create(date("Y-m-d"));
                                            $start_date = date_add($date,date_interval_create_from_date_string("-1 days"));
                                            $start_date_format =  date_format($start_date,"Y-m-d");
                                            // echo $start_date_format;
                                            $dateend = date_create(date("Y-m-d"));
                                            $end_date = date_add($dateend,date_interval_create_from_date_string("5 days"));
                                            $end_date_format =  date_format($end_date,"Y-m-d");
                                            // dd($end_date_format);
                                            break;
                                        case 2 :
                                            // echo("Today is Tuesday.");
                                            $date = date_create(date("Y-m-d"));
                                            $start_date = date_add($date,date_interval_create_from_date_string("-2 days"));
                                            $start_date_format =  date_format($start_date,"Y-m-d");
                                            // echo $start_date_format;
                                            $dateend = date_create(date("Y-m-d"));
                                            $end_date = date_add($dateend,date_interval_create_from_date_string("4 days"));
                                            $end_date_format =  date_format($end_date,"Y-m-d");
                                            // dd($end_date_format);
                                            break;
                                        case 3 :
                                            // echo("Today is Wednesday.");
                                            $date = date_create(date("Y-m-d"));
                                            $start_date = date_add($date,date_interval_create_from_date_string("-3 days"));
                                            $start_date_format =  date_format($start_date,"Y-m-d");
                                            // echo $start_date_format;
                                            $dateend = date_create(date("Y-m-d"));
                                            $end_date = date_add($dateend,date_interval_create_from_date_string("3 days"));
                                            $end_date_format =  date_format($end_date,"Y-m-d");
                                            // dd($end_date_format);
                                            break;
                                        case 4 :
                                           
                                            $date = date_create(date("Y-m-d"));
                                            $start_date = date_add($date,date_interval_create_from_date_string("-4 days"));
                                            $start_date_format =  date_format($start_date,"Y-m-d");
                                            // echo $start_date_format;
                                            $dateend = date_create(date("Y-m-d"));
                                            $end_date = date_add($dateend,date_interval_create_from_date_string("2 days"));
                                            $end_date_format =  date_format($end_date,"Y-m-d");
                                            // dd($end_date_format);
                                            break;
                                        case 5 :
                                            // echo("Today is Friday.");
                                            $date = date_create(date("Y-m-d"));
                                            $start_date = date_add($date,date_interval_create_from_date_string("-5 days"));
                                            $start_date_format =  date_format($start_date,"Y-m-d");
                                            // echo $start_date_format;
                                            // dd("131313");
                                            $dateend = date_create(date("Y-m-d"));
                                            $end_date = date_add($dateend,date_interval_create_from_date_string("1 days"));
                                            $end_date_format =  date_format($end_date,"Y-m-d");
                                            // dd($end_date_format);
                                            break;
                                        case 6 :
                                            // echo("Today is Saturday.");
                                            $date = date_create(date("Y-m-d"));
                                            $start_date = date_add($date,date_interval_create_from_date_string("-6 days"));
                                            $start_date_format =  date_format($start_date,"Y-m-d");
                                                // echo $start_date_format;
                                            $dateend = date_create(date("Y-m-d"));
                                            $end_date = date_add($dateend,date_interval_create_from_date_string("0 days"));
                                            $end_date_format =  date_format($end_date,"Y-m-d");
                                            // dd($end_date_format);
                                            break;
                                    }

                                        $user_information = Usermeta::where('user_id','=',Auth::user()->id)->orderBy('id', 'DESC')->first();
                                        $categories_name = EventCat::where('status',2)->where('id','=',13078)->orderBy('id', 'DESC')->first();
                                        // $categories_name = EventCat::where('status',2)->orderBy('id', 'DESC')->first();
                                        $imgurl = null;
                                        $prt_date = null;
                                        $number_of_partcipant = null;
                                        $video_link = null;
                                        $km = null;
                                        $run = new Eventorganizations();
                                        $run->user_id = Auth::user()->id;
                                        $run->category = $categories_name['id']; // event category from event_cat table
                                        $run->event_name_store = $categories_name['name'];
                                        $run->name = Auth::user()->name;
                                        $run->email = Auth::user()->email;
                                        $run->contact = Auth::user()->phone;
                                        $run->state = $user_information['state'];
                                        $run->participantnum = $user_information['participant_number'];
                                        $run->school_chain = null;
                                        $run->eventstartdate = $start_date_format;
                                        $run->eventenddate = $end_date_format;
                                        $run->eventimg_meta = "a:0:{}";
                                        $run->event_bg_image = isset($event_background_image) ? $event_background_image : null;
                                        $run->eventdate_meta = serialize($prt_date);
                                        $run->eventpnt_meta = serialize($number_of_partcipant);
                                        $run->eventkm_meta = serialize($km);
                                        $run->organiser_name = Auth::user()->name;
                                        $run->role = 'organizer';
                                        $run->video_link = "a:1:{i:0;N;}";
                                        $run->save();

                                        $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
                                        $freedom_events = Eventorganizations::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                                        $role = Role::where('slug', $role)->first()->name;

                                        return view('event.list-events', [
                                                                        'role' => $role,
                                                                        'freedom_event' =>$freedom_events,
                                                                        'categories' =>$categories,
                                                                        'year'=>'22'
                                                                    ]);
                                }

                            }else{

                                $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
                                $freedom_events = Eventorganizations::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                                $role = Role::where('slug', $role)->first()->name;

                                return view('event.list-events', [
                                                                'role' => $role,
                                                                'freedom_event' =>$freedom_events,
                                                                'categories' =>$categories,
                                                                'year'=>'22'
                                                            ]);

                            }
                        }
                }

            }else{

                return redirect('/login');

            }
        }catch (Exception $e) {

            return abort(404);

        }

    }

    public function myeventsearching($id){

        try{

            if (isset(auth()->user()->role)){

                $role = Auth::user()->role;

                if($role){

                    $freedom_events = Eventorganizations::where([
                                                                    ['category', $id],
                                                                    ['user_id', Auth::user()->id]
                                                                ]
                                                                    )->orderBy('id', 'DESC')->get();

                    $role = Role::where('slug', $role)->first()->name;

                    if(count($freedom_events)>0){



                        return response()->json(['success' => true, 'message' => 'records found', 'freedom_events' => $freedom_events]);

                    }else{

                        return response()->json(['success' => false, 'message' => 'records not found', 'freedom_events' => null]);

                    }
                }

            }else{

                return redirect('/login');

            }
        }catch (Exception $e) {

            return abort(404);

        }
    }
    public function update($id, Request $request){

        try{
        
            if (isset(auth()->user()->role)){

                $categories = EventCat::where('status',2)->get();
                $role = Auth::user()->role;
                $state = State::whereStatus(true)->orderBy('name', 'ASC')->get();
                $id = decrypt($id);
                $events = DB::table('event_organizations')
                    ->leftJoin('users', 'event_organizations.user_id', '=', 'users.id')
                    ->select('users.name','users.email as useremail','users.phone','users.role','users.rolewise','users.rolelabel', 'event_organizations.*')
                    ->where('event_organizations.id',$id)
                    ->first();
                $eventactivitydropdowns = Eventactivitydropdowns::where('status',1)->orderBy('id', 'DESC')->get();
                return view('event.event_update', [
                                                    'role' => $role ,
                                                    'events' => $events,
                                                    'categories' => $categories,
                                                    'eventactivitydropdowns' => $eventactivitydropdowns,
                                                    'state'=>$state
                                                    ]);

            }else{

                return redirect('/login');

            }
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function edit(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'org_name' => 'required',
                'event_bg_image' => 'nullable|file|max:2047|mimes:jpeg,jpg,png',
                'prt_image.*' => 'nullable|file|max:2047|mimes:jpeg,jpg,png',
                'from_date' => 'required',
                'to_date' => 'required',
                'addparticipants' => 'nullable|integer|min:0',
            ],[
                // 'contact.required' => 'Please Enter Contact Number',
                'org_name.required' => 'Please Enter Organization / Institution / Group / School Name',
                'event_bg_image.max' => 'Event Background Image Must be Less Than 2 MB.',
                'event_bg_image.mimes' => 'Event Background Image Must in .jpg/.jpeg/.png',
                'prt_image.*.max' => 'Event Picture Must be Less Than 2 MB.',
                'prt_image.*.mimes' => 'Event Picture Must in .jpg/.jpeg/.png',
                'from_date.required' => 'Please Select Event Start Date',
                'to_date.required' => 'Please Select Event End Date',
                'addparticipants.min' => 'Please enter a value greater than or equal to 0.',
            ]);

            if ($validator->fails()) {
                Session::flash('error_message', $validator->errors()->first());
                return back()->withInput();
            }

            $year = date("Y/m");
            $imgurl = array();
            $event_name_store = $request['event_name_store'];
            $state = $request['state'];
            if($request->hasfile('event_bg_image')) {
                $name = $request->file('event_bg_image')->getClientOriginalName();
                $image_path = $event_name_store.'/'.$state.'/'.Auth::user()->name;
                $name = $request->file('event_bg_image')->store($image_path,['disk'=> "uploads"]);
                $name = url('wp-content/uploads/'.$name);
                $event_background_image = $name;

            }
            if($request->hasfile('prt_image')) {
                foreach($request->file('prt_image') as $file){
                    $name = $file->getClientOriginalName();
                    $name = $file->store($event_name_store.'/'.$state.'/'.Auth::user()->name.'/'.'event_image',['disk'=> 'uploads']);
                    $name = url('wp-content/uploads/'.$name);
                    $imgurl[] = $name;
                }
            }
            $old_img_url = unserialize($request->old_prt_image);
            $new_imgurl = array_merge($imgurl,$old_img_url);
            $school_chains = $request->school_chain ? $request->school_chain : '';

            if($request->hasfile('event_bg_image')) {
                $freedom_update = Eventorganizations::where('id', '=', $request->id)->update(['organiser_name' => $request->org_name, 'event_activity' => $request->event_activity, 'participantnum' => $request->addparticipants, 'contact' => $request->contact,'email' => $request->email, 'eventstartdate' => $request->from_date, 'eventenddate' => $request->to_date,'eventimg_meta' => serialize($new_imgurl),'eventdate_meta' => serialize($request->prt_date),'eventpnt_meta' => serialize($request->number_of_partcipant),'eventkm_meta' => serialize($request->km),'video_link' => serialize($request->video_link),'event_bg_image' => isset($event_background_image) ? $event_background_image : null]);
            }else{
                $freedom_update = Eventorganizations::where('id', '=', $request->id)->update(['organiser_name' => $request->org_name, 'event_activity' => $request->event_activity, 'participantnum' => $request->addparticipants, 'contact' => $request->contact,'email' => $request->email, 'eventstartdate' => $request->from_date, 'eventenddate' => $request->to_date,'eventimg_meta' => serialize($new_imgurl),'eventdate_meta' => serialize($request->prt_date),'eventpnt_meta' => serialize($request->number_of_partcipant),'eventkm_meta' => serialize($request->km),'video_link' => serialize($request->video_link)]);
            }


            if($freedom_update){
                $id = encrypt($request->id);
                return redirect('event-updatedetail/'.$id)->with('success', 'Your event has been successfully updated.');
            }else{
                return back()->with('failed','Something Wrong')->withInput();
            }
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function showEventUpdateDetails($id, Request $request){
        try{
            if (isset(auth()->user()->role)){

                $id = decrypt($id);
                $role = Auth::user()->role;
                $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();
                $events = DB::table('event_organizations')
                    ->leftJoin('users', 'event_organizations.user_id', '=', 'users.id')
                    ->select('users.name','users.email as useremail','users.phone','users.role', 'event_organizations.*')
                    ->where('event_organizations.id',$id)
                    ->first();
                $eventactivitydropdowns = Eventactivitydropdowns::where('status',1)->orderBy('id', 'DESC')->get();
                return view('event.event_update_view', ['role' => $role , 'events' => $events,'categories'=> $categories,'eventactivitydropdowns' => $eventactivitydropdowns ]);

            }else{

                return redirect('/login');

            }
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function freedomrunEventDestroy($id){
        try{
            $res = Eventorganizations::where('id', $id )->delete();
            return back()->with('success','Event successfully Deleted');
        }catch (Exception $e) {

            return abort(404);

        }

    }

    public function Uploadexcel($id){

        try{
            $id = decrypt($id);

            $event = Eventorganizations::where( 'user_id', Auth::user()->id )->find($id);

            $categories = EventCat::where([['id',$event['category']],['status',2]])->orderBy('id', 'DESC')->first();

            if (isset(auth()->user()->role)){

                $role = Auth::user()->role;
                $role = Role::where('slug', $role)->first()->name;
                return view('event.bluck_upload_excel',compact('role','event','categories'));

            }else{

                return redirect('/login');

            }
        }catch (Exception $e) {

            return abort(404);

        }

    }

    public function updateBulkUploadExcel(Request $request){

        try{

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ],[
                'ex_file_sheet.required' => 'This Input is required.',
            ]);

            if ($validator->fails()) {
                Session::flash('error_message', $validator->errors()->first());
                return back()->withInput();
  
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
            return back()->with('success','Data Uploaded Successfully');

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function freedomCertificateProcess($id,Request $request){
        try{

            if (isset(auth()->user()->role)){

                $role = Auth::user()->role;
                $id = decrypt($id);

                $users = DB::table('users')
                        ->join('event_organizations','users.id','=','event_organizations.user_id')
                        ->select(['users.role','users.name','event_organizations.category','users.email','event_organizations.id','event_organizations.participant_names','event_organizations.organiser_name', 'event_organizations.eventstartdate','event_organizations.eventenddate'])
                        ->where('event_organizations.user_id', Auth::user()->id)
                        ->where('event_organizations.id', $id)
                        ->first();

                $categories = EventCat::where([['id',$users->category],['status',2]])->orderBy('id', 'DESC')->first();
                $categoriesid = encrypt($categories['id']);
                return view('event.event-certificate-process',compact('role','users','id','categories','categoriesid'));

            }else{

                return redirect('/login');

            }
        }catch (Exception $e) {

            return abort(404);

        }

    }

    public function eventaddPartcipant($id){
        try{
            if (isset(auth()->user()->role)){
                $id = decrypt($id);
                $role = Auth::user()->role;
                $event = Eventorganizations::find($id);
                $categories = EventCat::where([['id',$event->category],['status',2]])->orderBy('id', 'DESC')->first();
                return view('event.event-add-participant',compact('event','role','categories'));

            }else{
                return redirect('/login');
            }
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function updateFreedomRunParticipant(Request $request){
        try{
            $request->validate([
                'participant_names' => 'required',
            ],[
                'participant_names.required' => 'Please Enter Participant Name.',
            ]);
            $memberlist = $request->participant_names;
            $memberlist = explode(PHP_EOL, $memberlist);
            if(!empty($memberlist)){
            $count = count($memberlist);
            }else{
                $count = 0;
            }
            $freedom_participant_update = Eventorganizations::where('id', '=', $request->id)->update(['participant_names' => serialize($memberlist),'total_participant' => $count]);

            if($freedom_participant_update){
                return redirect('event-updatedetail/'.encrypt($request->id));
            }else{
                return back()->with('success','Participants updated successfully');
            }
        }catch (Exception $e) {

            return abort(404);

        }
    }



    public function downloadFreedomCertificate(Request $request){
        try{

            $eventname = $request->name;
            $event_id = decrypt($request->event_id);
            $organiser_name = $request->organiser_name;
            $participant = $request->participant;
            $certificate_type = $request->cert_type;
            $eventstartdate = $request->eventstartdate;
            $eventstartdate = Carbon::createFromFormat('Y-m-d', $request->eventstartdate)->format('d-m-Y');
            $eventenddate = Carbon::createFromFormat('Y-m-d', $request->eventenddate)->format('d-m-Y');
            $categoriesid = decrypt($request['categoriesid']);
            $categories = EventCat::where([['id',$categoriesid],['status',2]])->orderBy('id', 'DESC')->first();
            $categories_event_id = $categories['id'];
            $eventorganizationsdate = Eventorganizations::where([
                                                                    ['category',$categoriesid],
                                                                    ['id','=',$event_id],
                                                                    ['user_id','=',Auth::user()->id]
                                                                ])->orderBy('id', 'DESC')->first();

            $state = $eventorganizationsdate['state'];
            $districts = $eventorganizationsdate['districts'];
            $cer_date = date("mY");
            $serialno = 'FI#'.$cer_date.'#';
                if($certificate_type == 'participant'){

                    $certificationtracking = new CertificationTrackings();
                    $certificationtracking->user_id = Auth::user()->id;
                    $certificationtracking->name = $organiser_name;
                    $certificationtracking->user_type = $certificate_type;
                    $certificationtracking->event_id = $categoriesid;
                    $certificationtracking->event_name = $categories->name;
                    $certificationtracking->event_participant_certification_name = $participant;
                    $certificationtracking->status = 1;
                    $certificationtracking->save();
                    $last_id = $certificationtracking->id;
                    $serialno_with_id = $serialno .$last_id;
                    CertificationTrackings::where('id', '=', $last_id)->update(['serialno_with_id' => $serialno_with_id]);
               
                    $pdf = PDF::loadView('event.Freedom-Run-5-event-participant-certificate',[
                                            'organiser_name' => $organiser_name,
                                            'participant_name'=> $participant,
                                            'participant_certificate'=> $categories['participant_certificate'],
                                            'participant_organizer_name_css'=> $categories['participant_organizer_name_css'],
                                            'participant_certificate_name_css'=> $categories['participant_certificate_name_css'],
                                            'eventstartdate'=> $eventstartdate ?? '',
                                            'eventenddate'=> $eventenddate ?? '',
                                            'state'=> $state ?? '--',
                                            'districts'=> $districts ?? '--',
                                            'categories_event_id'=> $categories_event_id ?? '',
                                            'serialno_with_id'=> $serialno_with_id ?? '',
                        ])->setPaper('a4', 'landscape');
                    $pdf->getDomPDF()->setHttpContext(

                        stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
                    );

                    return $pdf->download($participant.".pdf");

                }else{

                        $certificationtracking = new CertificationTrackings();
                        $certificationtracking->user_id = Auth::user()->id;
                        $certificationtracking->name = $organiser_name;
                        $certificationtracking->user_type = $certificate_type;
                        $certificationtracking->event_id = $categoriesid;
                        $certificationtracking->event_name = $categories->name;
                        $certificationtracking->event_participant_certification_name = null;
                        $certificationtracking->status = 1;
                        $certificationtracking->save();
                        $last_id = $certificationtracking->id;
                        $serialno_with_id = $serialno .$last_id;
                        CertificationTrackings::where('id', '=', $last_id)->update(['serialno_with_id' => $serialno_with_id]);

                        $pdf = PDF::loadView('event.freedom-run-5-event-organizer-certificate',
                        [
                            'name' =>  $organiser_name,
                            'organizer_certificate' => $categories['organizer_certificate'],
                            'organizer_style_name' => $categories['organizer_style_name'],
                            'eventstartdate'=> $eventstartdate ?? '',
                            'eventenddate'=> $eventenddate ?? '',
                            'state'=> $state ?? '--',
                            'districts'=> $districts ?? '--',
                            'categories_event_id'=> $categories_event_id ?? '',
                            'serialno_with_id'=> $serialno_with_id ?? '',
                        ])->setPaper('a4', 'landscape');
                        $pdf->getDomPDF()->setHttpContext(
                        stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])

                    );


                    $data = [
                                'title' => 'Invoice',
                                'content' => 'This is a sample PDF content.',
                            ];

                    // Generate PDF from a Blade view
                    $pdf = PDF::loadView('event.freedom-run-5-event-organizer-certificate',
                                        [
                                            'name' =>  $organiser_name,
                                            'organizer_certificate' => $categories['organizer_certificate'],
                                            'organizer_style_name' => $categories['organizer_style_name'],
                                            'eventstartdate'=> $eventstartdate ?? '',
                                            'eventenddate'=> $eventenddate ?? '',
                                            'state'=> $state ?? '--',
                                            'districts'=> $districts ?? '--',
                                            'categories_event_id'=> $categories_event_id ?? '',
                                            'serialno_with_id'=> $serialno_with_id ?? '',
                                        ])->setPaper('a4', 'landscape');

                    // Define file name


                    $fileName = 'invoice_' . time() . '.pdf';
                    $path = storage_path('app/public/pdf/' . $fileName);

                    if (!file_exists(dirname($path))) {
                        mkdir(dirname($path), 0777, true);
                    }

                    // Save PDF to the server path
                    file_put_contents($path, $pdf->output());

                    return response()->json([
                        'message' => 'PDF saved on server',
                        'file' => $fileName,
                        'path' => $path,
                    ]);


                    return $pdf->download($organiser_name.".pdf");

                }

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function show(Freedomrun $freedomrun){
        try{
            $id = Auth::user()->id;
            $events = Freedomrun::where('user_id',$id)->get();
            return view('freedum_events',compact('events'));
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function destroy(Freedomrun $freedomrun){
        //
    }
    public function addIndividualFreedomRun(Request $request){
        try{
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
                    return back()->with('success','Congratulations, your event has been successfully created')->with('success_email',$request->email);
                }else{
                    return back()->with('failed','Something Wrong')->withInput();
                }
            }else{
                return back()->with('failed','This email id has already been used, please use another email ID to register again or to download your certificate please click on click here button')->withInput();
            }
            return redirect('freedom-run-2.0');

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function checkIndividualExistance(Request $request){
        try{
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

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function checkIndividualExistanceSecond($email){
        try{
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
               
            }
            return redirect('freedom-run-2.0');
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function addFreedomRunPartners(Request $request){
        try{
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
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function freedomrunInfo(){
        try{
            $freedom_partner_detail = Freedomrunpartners::where('status','1')->get();

            return view('freedomrun.freedom-run-info',compact('freedom_partner_detail'));
        }catch (Exception $e) {

            return abort(404);

        }
    }
    public function myEventsByYear($id){
        try{
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
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function mobileFreedomrunEvents(){
        try{

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
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function EventsPics(){

        try{

            if (isset(auth()->user()->role)){

                $role = Auth::user()->role;

                if($role){
                    $categories = EventCat::where('status',2)->get();
                    $role = Role::where('slug', $role)->first()->name;

                    $freedomrun_event = Eventorganizations::where( 'user_id', Auth::user()->id)->orderBy('id', 'DESC')->first(['eventimg_meta','category']);

                    return view('event.eventpic', [
                                                    'role' => $role,
                                                    'events' => $freedomrun_event,
                                                    'categories' => $categories,
                                                    'year'=>'3'
                                                ]);

                }else{

                    redirect('home');
                }

            }else{

                return redirect('/login');
            }

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function EventSearchImages($id){

        try{
            if (isset(auth()->user()->role)){

                $role = Auth::user()->role;

                if($role){


                    $freedomrun_event = Eventorganizations::where([['category',$id],['user_id', Auth::user()->id]])->orderBy('id', 'DESC')->get(['eventimg_meta']);
                    if(count($freedomrun_event)>0){
                        foreach($freedomrun_event as $freedomrun_key => $imagevalue){
                            $freedomrun_image = unserialize($imagevalue['eventimg_meta']);
                            foreach($freedomrun_image as $eventimg_image){
                                    $freedomrun_event_value[] = "<article class='cards-list'><div class='card-img'><img src='".$eventimg_image."' /></div></article>";

                            }
                 
                        }

                            return response()->json(['success' => true, 'message' => 'records found', 'event_value' => $freedomrun_event_value]);
                       


                    }else{

                        return response()->json(['success' => false,'message' => 'No records found']);

                    }

                }else{

                    redirect('home');
                }

            }else{

                return redirect('/login');
            }

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function eventdatesearch($id){

        try{

            if (isset(auth()->user()->role)){

                $role = Auth::user()->role;

                if($role){
                    $categories = EventCat::where([
                                                    ['id',$id],
                                                    ['status',2]
                                                ])->first();

                    if(isset($categories)){

                        $from_date = date('Y-m-d', strtotime($categories->from_date));
                        $to_date = date('Y-m-d', strtotime($categories->to_date));
                        $name = $categories->name;
                        return response()->json(['success' => true, 'message' => 'records found', 'from_date' => $from_date, 'to_date' => $to_date, 'name' => $name]);

                    }else{

                        return response()->json(['success' => false,'message' => 'No records found']);

                    }

                }else{

                    redirect('home');
                }

            }else{

                return redirect('/login');
            }

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function DownloadRegistrationCertificate(){

        try{
            $organiser_name = Auth::user()->name;

            $certificationtracking = new CertificationTrackings();
            $certificationtracking->user_id = Auth::user()->id;
            $certificationtracking->name = $organiser_name;
            $certificationtracking->user_type = "registration-certificate";
            $certificationtracking->status = 1;
            $certificationtracking->save();

            $pdf = PDF::loadView('event.download-registration-certificate',[
                        'organiser_name' => $organiser_name,
                ])->setPaper('a4');

            $pdf->getDomPDF()->setHttpContext(

                stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
            );

            return $pdf->download($organiser_name.".pdf");




        }catch (Exception $e) {

            return abort(404);

        }
    }


}
