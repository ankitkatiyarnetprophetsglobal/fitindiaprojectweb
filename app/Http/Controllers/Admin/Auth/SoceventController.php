<?php
namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Language;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SocEvent;
use App\Exports\ExportUser;
use App\Models\socinfomasters;
use App\Models\Distributionpermissions;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Soceventmaster;
use App\Exports\NemoClubExport;

class SoceventController extends Controller
{

    public function index(Request $request){

        try{
            
            return view('admin.socevents.index');

        } catch(Exception $e) {

            dd($e->getMessage());
        }
    }

    public function create(){

        $language = Language::where('status','=','active')->get();
    }

    public function store(Request $request){

          $request->validate([

                        'file' => 'required|file|mimes:xlsx,xls|max:10240',  // 10MB max size

                    ],[
                        'file.mimes' => 'Please upload a valid Excel file. Only .xlsx and .xls formats are allowed.',
                        'file.max' => 'The file size exceeds the maximum limit of 10MB.',
                    ]
                );

        $rows = Excel::toCollection(new SocEvent, $request->file('file'));
        // dd($rows);
        foreach( $rows as $key => $element) {

            $allvenue = [];
            $v = 0;
            $vv = 0;
            $allrow = [];
            $i = 0;
            $allcyclerowblank = [];
            $i = 0;
            $ii = 0;
            $allrowt_shirt = [];
            $k = 0;
            $allrowt_shirt_blank = [];
            $kk = 0;
            $allrowmeal = [];
            $m = 0;
            $allrowmeal_blank = [];
            $mm = 0;
            $allevent_date = [];
            $ed = 0;
            $edb = 0;
            foreach ($element as $row) {

                if($row !== 'Cycle_Count'){


                    if ($row[0] !== 'Event Venue') {
                        $vv++;
                        if ($row[0] == '') {

                            $allvenue[$v++] =  "Venue line no:- ".$vv;
                        }
                    }
                    if ($row[1] != 'CycleCount') {
                        $ii++;
                        if ($row[1] == '') {

                            $allcyclerowblank[$ii] =  "Cycle line no:- ".$ii;
                        }
                    }
                    if ($row[2] !== 'T Shirt Count') {
                        $kk++;
                        if ($row[2] > 0){

                            $allrowt_shirt_blank[$kk] =  "T Shirt line no:- ".$kk;
                        }
                    }
                    if ($row[3] !== 'Meal Count') {
                        $mm++;
                        if ($row[3] == '') {

                            $allrowmeal_blank[$mm] =  "Meal line no:- ".$mm;
                        }
                    }
                    if ($row[6] !== 'Event Date(YYYY-MM-DD)') {
                        $edb++;
                        if ($row[6] == '') {

                            $allevent_date[$edb] =  "Event date line no:- ". $edb;
                        }
                    }
                    // Skip header row where column 1 is 'cycle'

                    if (isset($row[1]) && trim($row[1]) !== 'Cycle Count') {

                        // Check if $row[1] is not an integer
                        if (!is_int($row[1])) {

                            $allrow[$i++] = "Cycle column text error (".$row[1]. ")";
                        }
                    }
                    // if (isset($row[2]) && strtolower(trim($row[2])) !== 'T Shirt Count') {
                    if (isset($row[2]) && trim($row[2]) !== 'T Shirt Count') {

                        // Check if $row[1] is not an integer
                        if (!is_int($row[2])) {

                            // $allrowt_shirt[$k++] = $row[2];
                            $allrowt_shirt[$k++] = "T Shirt column text error (".$row[2]. ")";
                        }
                    }
                    if (isset($row[3]) && trim($row[3]) !== 'Meal Count') {

                        // Check if $row[1] is not an integer
                        if (!is_int($row[3]) || ($row[3] < 0)) {

                            // $allrowmeal[$m++] = $row[3];
                            $allrowmeal[$m++] = "Meal column text error (".$row[3]. ")";
                        }
                    }
                    if (isset($row[6]) && trim($row[6]) !== 'Event Date(YYYY-MM-DD)') {

                        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$row[6])) {
                            // $allevent_date[$ed++] = $row[6];
                            $allevent_date[$ed++] = "Event date column text error (".$row[6]. ")";
                        }
                    }
                }
            }

            if(
                count($allvenue) > 0
                || count($allcyclerowblank) > 0
                || count($allrowt_shirt_blank) > 0
                || count($allrowmeal_blank) > 0
                || count($allevent_date) > 0
                || count($allvenue) > 0
                || count($allcyclerowblank) > 0
                || count($allrowt_shirt_blank) > 0
                || count($allrowmeal_blank) > 0
                || count($allevent_date) > 0){
                $main_array = array(
                                    array('allvenue' => $allvenue),
                                    array('allcyclerowblank' => $allcyclerowblank),
                                    array('allrowt_shirt_blank' => $allrowt_shirt_blank),
                                    array('allrowmeal_blank' => $allrowmeal_blank),
                                    array('allevent_date' => $allevent_date),
                                );
                $main_array_error = array(
                                    // array('allvenue' => $allvenue),
                                    array("cycle_array" => $allrow),
                                    array('allrowt_shirt'=> $allrowt_shirt),
                                    array('allrowmeal' => $allrowmeal),
                                    array('allevent_date' => $allevent_date),
                                );
                return view('admin.socevents.index', compact('main_array','main_array_error'));

            }

            if($row[0] !== 'Event Venue'){

                    $data = Soceventmaster::
                            whereDate('event_date', $row[6])
                            ->where([
                                        ['status','=' ,1],
                                        ['venue','=' , trim($row[0])]

                                    ])
                            ->select(
                                    'id',
                                    'venue',
                                    'cycle',
                                    't_shirt',
                                    'meal',
                                )
                                ->get();

                    if(count($data) > 0){

                        foreach ($data as $datarow) {

                                    Soceventmaster::where([
                                    ['soc_event_masters.id', '=', $datarow['id']],
                                ])
                                ->update(
                                    [
                                        'soc_event_masters.status' => 0,
                                    ]
                                );
                            }
                    }

                }

            $rows = Excel::import(new SocEvent, $request->file('file')->store('files'));
            return back()->with('success','File uploaded successfully');
            // return redirect()->back();
        }
    }

   

      public function nemoclubdata(Request $request){
    
        try{
            $search = $request->user_name;
            $admins_role = Auth::user()->role_id;
            $roles = Role:: orderBy("name")->get();
            $user =    DB::table('event_organizations')
                            ->select('user_id', DB::raw('COUNT(*) as eventcount'))
                            ->whereIn('category', [13077, 13078, 13075])
                            ->where(function ($query) {
                                $query->where('eventimg_meta', '!=', 'a:0:{}')
                                    ->orWhere('event_bg_image', '!=', '');
                            })
                            ->groupBy('user_id');


           $results = DB::table('users')
                    ->leftJoin('usermetas', 'users.id', '=', 'usermetas.user_id')
                    ->leftJoinSub(
                        DB::table('event_organizations')
                            ->select('user_id', DB::raw('COUNT(*) as eventcount'))
                            ->whereIn('category', [13077, 13078, 13075])
                            ->where(function ($q) {
                                $q->where('eventimg_meta', '!=', 'a:0:{}')
                                ->orWhere('event_bg_image', '!=', '');
                            })
                            ->groupBy('user_id'),
                        'event_participation',
                        function ($join) {
                            $join->on('users.id', '=', 'event_participation.user_id');
                        }
                    )
                    ->select(
                        'users.id',
                        'users.name',
                        'users.email',
                        'users.role',
                        'users.rolelabel',
                        'users.phone',
                        'usermetas.gender',
                        'usermetas.city',
                        'usermetas.state',
                        'usermetas.district',
                        'usermetas.block',
                        'users.created_at',
                        'usermetas.kit_dispatch as kit_dispatch',
                        DB::raw('IFNULL(event_participation.eventcount, 0) as event_participation')
                    )
                    ->where(function ($query) {
                        $query->where(function ($q) {
                            $q->where('users.rolewise', 'like', '%cyclothon-2024%')
                            ->where('usermetas.cyclothonrole', '=', 'club');
                        })->orWhere('users.role', '=', 'namo-fit-india-cycling-club');
                    });
           
            if (!empty($search)) {
                $results = $results->where(function ($q) use ($search) {
                    $q->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%')
                    ->orWhere('users.phone', 'like', '%' . $search . '%');
                });
            }
            $curcount = 0;
            $count = $results->count();
            $user = $results->paginate(10);
          
            $flag=1;
            return view('admin.socevents.nemoclubdata', compact('user','count','curcount','admins_role','roles'));

        } catch(Exception $e) {

            dd($e->getMessage());
        }
    }

    public function exportNemoClubData(Request $request)
    {
        return Excel::download(new NemoClubExport($request->user_name), 'nemo_club_data.xlsx');
    }

    public function nemoclub_dispatch_status(Request $request){


        try{

            // dd($request->all());
            $user_id = $request['amb_id'];
            DB::table('usermetas')->where('user_id', $user_id)->update(['kit_dispatch' => 1]);
            $response = array('status'=>1,'msg'=>'Approved','pass'=>"fasdfasd");
            return Response::json(['success' => $response], 200);
            json_encode($response);
            // $admins_role = Auth::user()->role_id;
            // $roles = Role:: orderBy("name")->get();

            // $user = DB::table('users')
            //             ->leftJoin('usermetas', 'users.id', '=', 'usermetas.user_id')
            //             ->select(
            //                 'users.id',
            //                 'users.name',
            //                 'users.email',
            //                 'users.role',
            //                 'users.rolelabel',
            //                 'users.phone',
            //                 'usermetas.gender',
            //                 'usermetas.city',
            //                 'usermetas.state',
            //                 'usermetas.district',
            //                 'usermetas.block',
            //                 'users.created_at'
            //             )
            //             ->where(function($query) {
            //                 $query->where('users.role', 'like', '%namo-fit-india-cycling-club%')
            //                     ->orWhere('users.rolewise', 'like', '%cyclothon-2024%')
            //                     ->Where('usermetas.cyclothonrole', 'club');
            //             });

            // $curcount = 0;
            // $count = $user->count();
            // $user = $user->paginate(10);
            // $flag=1;
            // return view('admin.socevents.nemoclubdata', compact('user','count','admins_role','roles'));
            // dd($total_count_cyclothon_club);
            // dd($total_count_cyclothon_club);

            // return view('admin.socevents.index');

        } catch(Exception $e) {

            dd($e->getMessage());
        }
    }

    public function socadmin_write(Request $request){


        try{
            // $distributionpermissions = Distributionpermissions::where('status','=',1)->orderBy('id','DESC')->paginate(10);
            $distributionpermissions = Distributionpermissions::
                                        leftjoin("users","users.id","=","distribution_permissions.fid")
                                        ->select(
                                            'distribution_permissions.id as main_id',
                                            'distribution_permissions.fid',
                                            'users.name',
                                            'users.email',
                                            'users.phone'
                                            )
                                        ->where('distribution_permissions.status','=',1)->orderBy('distribution_permissions.id','DESC')->paginate();
            $distributionpermissions_count = Distributionpermissions::join("users","users.id","=","distribution_permissions.fid")
                                        ->where('distribution_permissions.status','=',1)->count();
            // dd($distributionpermissions);
            return view('admin.socevents.socadminwrite',compact('distributionpermissions','distributionpermissions_count'));


        } catch(Exception $e) {

            dd($e->getMessage());
        }
    }

    public function socadmin_create_write(Request $request){


        try{

            return view('admin.socevents.socadmincreatewrite');

        } catch(Exception $e) {

            dd($e->getMessage());
        }
    }

    public function store_soc_admin_user(Request $request){


        try{

            $user_id = $request->socadminid;
            $user_data = User::where('id', '=', $user_id)->first();

             if (isset($user_data)){
                $request->validate([
                                    'socadminid' => 'required',
                                ],[
                                    'socadminid.required' => 'Soc Admin id field is required.',
                                ]);

                $distributionpermissions_store = new Distributionpermissions;
                $distributionpermissions_store->fid = $user_id;
                $distributionpermissions_store->status = 1;
                $distributionpermissions_store->save();

                return redirect()->route('admin.socadminwrite')->with('success','Soc admin admin successfully');

             }else{
                // return redirect('/admin/socadmin-create-write')->with('success', 'Soc admin added successfully.');
                // return redirect()->route('admin.socadmin-create-write')->with('success','Soc admin admin successfully');
                return redirect()->back()->with('error', 'The Fit India user ID does not exist. Please check and re-enter it');

             }

        } catch(Exception $e) {

            dd($e->getMessage());
        }
    }


    public function destroy_soc_admin_id(Request $request,$post){
        try{

            $category = Distributionpermissions::find($post);
            $category->status = 0;
            $category->save();
            return redirect()->route('admin.socadminwrite')->with('success','Soc admin Deleted Successfully');

        } catch(Exception $e) {

            dd($e->getMessage());
        }

    }
}
