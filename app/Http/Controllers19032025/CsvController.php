<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request,Response;
use App\Models\Quiztbl;
use App\Models\Quiztblhn;
use App\Models\Quiztblmalyalam;
use App\Models\Quiztbltelugu;
use App\Models\Quiztblkannada;
use App\Models\Quiztblbangla;
use App\Models\Quiztbltamil;
use App\Models\User;
use App\Models\Quizreport;
use App\Models\SchoolWeek;
use App\Models\Freedomrun;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Quizupload;
use App\Models\State;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportQuizHn;
use App\Imports\ImportQuiz;
use App\Http\Controllers\now;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Quizwinners;
use Illuminate\Support\Facades\DB;
use PDF;
use Lang;
use File;

class CsvController extends Controller
{
	public function get_csv(){ 
        $from_date = date('Y-m-d').' 00:00:00';
        $to_date = date('Y-m-d').' 23:59:59';
            
		// $school = SchoolWeek::select('school_weeks.name','school_weeks.school_chain','school_weeks.contact','school_weeks.email','usermetas.city','usermetas.state','usermetas.district','usermetas.block','school_weeks.eventstartdate','school_weeks.eventenddate','school_weeks.created_at')->join('usermetas', 'usermetas.user_id', '=', 'school_weeks.user_id')->whereBetween('school_weeks.created_at', [$from_date, $to_date])->get();
        $school = Freedomrun::select(
            'freedomruns.name',
            'freedomruns.school_chain',
            'freedomruns.contact',
            'freedomruns.email',
            'usermetas.city',
            'usermetas.state',
            'usermetas.district',
            'usermetas.block',
            'freedomruns.eventstartdate',
            'freedomruns.eventenddate',
            'freedomruns.created_at'
            )->join('usermetas', 'usermetas.user_id', '=', 'freedomruns.user_id')
            ->where('category','=',13062)
            ->whereBetween('freedomruns.created_at', [$from_date, $to_date])
            ->get(); 
        
        $headers = array(
            'Content-Type' => 'text/csv'
        );

        // if (!File::exists(public_path()."/files")) {
        //     File::makeDirectory(public_path() . "/files");
        // }

        $filename =  public_path("event.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "Name",// Name of school
            "mobile", // contact number
            "Email", // schoo email
            "city",
            "district",
            "state",
            "block",
            "event start date",            
            "event end date",
            // "School Chain",         
            "Created at"
        ]);

        foreach ($school as $each_user) {
            fputcsv($handle, [
                $each_user->name,
                $each_user->contact,
                $each_user->email,                
                $each_user->city,
                $each_user->district,
                $each_user->state,
                $each_user->block,
                $each_user->eventstartdate,
                $each_user->eventenddate,
                // $each_user->school_chain,
                $each_user->created_at,
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
  
        
    }
	
    public function all_get_csv(){ 
        // $from_date = date('Y-m-d').' 00:00:00';
        // $to_date = date('Y-m-d').' 23:59:59';
            
		// $school = SchoolWeek::select('school_weeks.name','school_weeks.school_chain','school_weeks.contact','school_weeks.email','usermetas.city','usermetas.district','usermetas.state','usermetas.block','school_weeks.eventstartdate','school_weeks.eventenddate','school_weeks.created_at')->join('usermetas', 'usermetas.user_id', '=', 'school_weeks.user_id')->get();
        $school = Freedomrun::select(
            'freedomruns.name',
            'freedomruns.school_chain',
            'freedomruns.contact',
            'freedomruns.email',
            'usermetas.city',
            'usermetas.district',
            'usermetas.state',
            'usermetas.block',
            'freedomruns.eventstartdate',
            'freedomruns.eventenddate',
            'freedomruns.created_at')
            ->where('category','=',13062)
            ->join('usermetas', 'usermetas.user_id', '=', 'freedomruns.user_id')
            ->get(); 

        // dd($school); 
        
        $headers = array(
            'Content-Type' => 'text/csv'
        );

        // if (!File::exists(public_path()."/files")) {
        //     File::makeDirectory(public_path() . "/files");
        // }

        $filename =  public_path("event.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "School Name",// Name of school
            "mobile", // contact number
            "Email", // schoo email
            "city",
            "district",
            "state",
            "block",
            "event start date",            
            "event end date",
            // "School Chain",           
            "Created at"
        ]);

        foreach ($school as $each_user) {
            fputcsv($handle, [
                $each_user->name,
                $each_user->contact,
                $each_user->email,                
                $each_user->city,
                $each_user->district,
                $each_user->state,
                $each_user->block,
                $each_user->eventstartdate,
                $each_user->eventenddate,
                // $each_user->school_chain,
                $each_user->created_at,
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
  
        // dd($school);
    }


 public function get_excel_school_event(){ 
        // $from_date = date('Y-m-d').' 00:00:00';
        // $to_date = date('Y-m-d').' 23:59:59';
         
        // $query = "SELECT users.name,users.email,users.phone,usermetas.udise,usermetas.city,usermetas.district,usermetas.state,usermetas.block,usermetas.address,sw.excel_sheet,sw.eventstartdate,sw.eventenddate,sw.school_chain,sw.created_at FROM fitindia.school_weeks AS sw
        // join fitindia.users on users.id = sw.user_id
        // join fitindia.usermetas on usermetas.user_id = sw.user_id
        //  WHERE sw.excel_sheet IS NOT null;";
        $query = "SELECT users.name,
                        users.email,
                        users.phone,
                        usermetas.udise,
                        usermetas.city,
                        usermetas.district,
                        usermetas.state,
                        usermetas.block,
                        usermetas.address,
                        eo.excel_sheet,
                        eo.eventstartdate,
                        eo.eventenddate,
                        eo.school_chain,
                        eo.created_at FROM freedomruns AS eo
        join users on users.id = eo.user_id
        join usermetas on usermetas.user_id = eo.user_id
         WHERE eo.excel_sheet IS NOT null and eo.category = 13062;";
	   $data = DB::select(DB::raw($query));

    //    dd($data);
        $headers = array(
            'Content-Type' => 'text/csv'
        );

     
        $filename =  public_path("event.csv");
        $handle = fopen($filename, 'w');

  fputcsv($handle, [
            "School Name",// Name of school
            "Email", // contact number
            "Phone", // schoo email
            "city",
            "district",
            "state",
            "block",
            "Address",
            'UDISE',
            "Excel sheet name",
            "Excel Sheet url",
            "event start date",            
            "event end date",
            "School Chain",           
            "Created at"
        ]);

        foreach ($data as $each_user) {
            fputcsv($handle, [
                $each_user->name,
                $each_user->email,
                $each_user->phone,                
                $each_user->city,
                $each_user->district,
                $each_user->state,
                $each_user->block,
                $each_user->address,
                $each_user->udise,
                $each_user->excel_sheet,
                url('storage/app/public/excel/'.$each_user->excel_sheet),
                $each_user->eventstartdate,
                $each_user->eventenddate,
                $each_user->school_chain,
                $each_user->created_at,
            ]);

        }        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
  
        // dd($school);
    }
public function lastmonthRegistration(){ 
    // dd(23412341242134);
        // $from_date = date('Y-m-d').' 00:00:00';
        // $to_date = date('Y-m-d').' 23:59:59';
         
        // $query = 'SELECT  users.name,users.email,users.phone,usermetas.city,usermetas.district,usermetas.state,usermetas.block,usermetas.address,usermetas.age,usermetas.dob,usermetas.gender,users.created_at FROM fitindia.users join usermetas on users.id = usermetas.user_id 
        // where usermetas.gender is not null and users.created_at BETWEEN "2022-11-01 00:00:00" AND "2022-12-07 23:59:59";';
        $query = 'SELECT  
                        users.name,
                        users.email,
                        users.phone,
                        usermetas.city,
                        usermetas.district,
                        usermetas.state,
                        usermetas.block,
                        usermetas.address,
                        usermetas.age,
                        usermetas.dob,
                        usermetas.gender,
                        users.created_at FROM fitindia.users join usermetas on users.id = usermetas.user_id 
                        where users.created_at BETWEEN "2023-10-01 00:00:00" AND "2023-10-31 23:59:59";';
                        // where usermetas.gender is not null and users.created_at BETWEEN "2023-09-15 00:00:00" AND "2023-09-31 23:59:59";';
	   $data = DB::select(DB::raw($query));

        //dd(count($data));
        // dd($data);
        $headers = array(
            'Content-Type' => 'text/csv'
        );

     
        $filename =  public_path("event.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "Name",// Name of school
            "Email", // contact number
            "Phone", // schoo email
            "city",
            "district",
            "state",
            "block",
            "Address",
            'Age',
            "DOB",
            "Gender",
            "Created at"
        ]);

        foreach ($data as $each_user) {
            fputcsv($handle, [
                $each_user->name,
                $each_user->email,
                $each_user->phone,                
                $each_user->city,
                $each_user->district,
                $each_user->state,
                $each_user->block,
                $each_user->address,
                $each_user->age,
                $each_user->dob,
                $each_user->gender,
                $each_user->created_at,
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
  
        // dd($school);
    }
 public function get_excel_image(){ 
        // $from_date = date('Y-m-d').' 00:00:00';
        // $to_date = date('Y-m-d').' 23:59:59';
        //  dd(13213131);
        $query = "SELECT 
        users.name,
        users.email,users.phone,
        usermetas.udise,
        usermetas.city,
        usermetas.district,
        usermetas.state,
        usermetas.block
        ,usermetas.address,
        -- sw.excel_sheet,
        sw.eventstartdate,sw.eventenddate,sw.school_chain,sw.eventimg_meta FROM fitindia.freedomruns AS sw
        join fitindia.users on users.id = sw.user_id
        join fitindia.usermetas on usermetas.user_id = sw.user_id
        WHERE sw.eventimg_meta is not null"; 
        // -- and sw.category = 13062";
        $data = DB::select(DB::raw($query));

       dd($data);
        $headers = array(
            'Content-Type' => 'text/csv'
        );

     
        $filename =  public_path("event.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "School Name",// Name of school
            "Email", // contact number
            "Phone", // schoo email
            "city",
            "district",
            "state",
            "block",
            "Address",
            'UDISE',
            "event start date",            
            "event end date",
            "School Chain",           
            "Image Url"
        ]);

        foreach ($data as $each_user) {
            // dd($each_user);
            $arr = unserialize($each_user->eventimg_meta);
            $arr_eventimg_meta = implode(" | ",$arr);
            fputcsv($handle, [
                $each_user->name,
                $each_user->email,
                $each_user->phone,                
                $each_user->city,
                $each_user->district,
                $each_user->state,
                $each_user->block,
                $each_user->address,
                $each_user->udise,
                $each_user->eventstartdate,
                $each_user->eventenddate,
                $each_user->school_chain,
                $arr_eventimg_meta
                // $each_user->event_bg_image,
            ]);

        }        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
  
        // dd($school);
    }


    public function registrationwithdistance(){
        // dd(123456);
        $query = "SELECT 
        users.name,
        users.email,
        users.phone,
        users.rolelabel,
        usermetas.udise,        
        usermetas.city,
        usermetas.district,
        usermetas.state,
        usermetas.block,
        usermetas.address,        
        sw.eventstartdate,
        sw.eventenddate,
        sw.school_chain,
        sw.eventimg_meta,  
        sw.total_participant, 
        sw.total_kms 
        FROM fitindia.freedomruns AS sw
        join fitindia.users on users.id = sw.user_id
        join fitindia.usermetas on usermetas.user_id = sw.user_id
        WHERE sw.eventimg_meta is not null and sw.category = 13062 and total_participant > 0";
        $data = DB::select(DB::raw($query));


        $headers = array(
            'Content-Type' => 'text/csv'
        );

     
        $filename =  public_path("event.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "School Name",// Name of school
            "Email", // contact number
            "Phone", // schoo email
            "Rolel",
            "city",
            "district",
            "state",
            "block",
            // "Address",         
            "Participant",
            "Total Kms",
            "event start date",            
            "event end date"
        ]);

        foreach ($data as $each_user) {

            // dd($each_user->total_kms);
            // echo '<pre>'; print_r(unserialize($each_user->eventkm_meta));
            // echo '<pre>'; print_r($each_user->rolelabel);

            fputcsv($handle, [
                $each_user->name,
                $each_user->email,
                $each_user->phone,                
                $each_user->rolelabel,                
                $each_user->city,
                $each_user->district,
                $each_user->state,
                $each_user->block,
                // $each_user->address,
                $each_user->total_participant,
                $each_user->total_kms,
                $each_user->eventstartdate,
                $each_user->eventenddate
            ]);
        }


        return Response::download($filename, "event_registration_with_distance.csv", $headers);
    }

	
	
}
