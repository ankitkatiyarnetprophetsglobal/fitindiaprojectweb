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
use App\Models\Eventorganizations;
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

class CsveventController extends Controller
{

        // public function get_excel_image(){

            //     // $from_date = date('Y-m-d').' 00:00:00';
            //     // $to_date = date('Y-m-d').' 23:59:59';

            //     // $query = "SELECT
            //     // users.name,
            //     // users.email,users.phone,
            //     // usermetas.udise,
            //     // usermetas.city,
            //     // usermetas.district,
            //     // usermetas.state,
            //     // usermetas.block
            //     // ,usermetas.address,
            //     // eo.excel_sheet,
            //     // eo.eventstartdate,
            //     // eo.eventenddate,
            //     // eo.school_chain,
            //     // eo.event_bg_image
            //     // FROM event_organizations AS eo
            //     // join users on users.id = eo.user_id
            //     // join usermetas on usermetas.user_id = eo.user_id
            //     // WHERE eo.event_bg_image is not null";

            //     $query = "SELECT
            //     eo.user_id,
            //     eo.organiser_name,
            //     eo.name,
            //     eo.email,
            //     eo.contact,
            //     eo.school_chain,
            //     eo.eventstartdate,
            //     eo.eventenddate,
            //     eo.created_at,
            //     eo.event_bg_image,
            //     eo.participantnum
            //     FROM event_organizations AS eo";
            //     // -- join users on users.id = eo.user_id
            //     // -- join usermetas on usermetas.user_id = eo.user_id";
            //     // // WHERE eo.event_bg_image is not null";
            //     $data = DB::select(DB::raw($query));

            //    dd($data);
            //     $headers = array(
            //         'Content-Type' => 'text/csv'
            //     );

            //     $filename =  public_path("event.csv");
            //     $handle = fopen($filename, 'w');

            //     fputcsv($handle, [
            //         "School Name",// Name of school
            //         "Email", // contact number
            //         "Phone", // schoo email
            //         "city",
            //         "district",
            //         "state",
            //         "block",
            //         "Address",
            //         'UDISE',
            //         "event start date",
            //         "event end date",
            //         "School Chain",
            //         "Image Url"
            //     ]);

            //     foreach ($data as $each_user) {
            //         fputcsv($handle, [
            //             $each_user->name,
            //             $each_user->email,
            //             $each_user->phone,
            //             $each_user->city,
            //             $each_user->district,
            //             $each_user->state,
            //             $each_user->block,
            //             $each_user->address,
            //             $each_user->udise,
            //             $each_user->eventstartdate,
            //             $each_user->eventenddate,
            //             $each_user->school_chain,
            //             $each_user->event_bg_image,
            //         ]);

            //     }        fclose($handle);

            //     //download command
            //     return Response::download($filename, "download.csv", $headers);

            //     // dd($school);
        // }

    public function get_excel_image(){

        try{
            // old one school week 2022
            // $query = "SELECT
            // eo.user_id,
            // eo.organiser_name,
            // eo.name,
            // eo.email,
            // eo.contact,
            // eo.eventstartdate,
            // eo.eventenddate,
            // eo.event_bg_image,
            // eo.eventimg_meta
            // FROM school_weeks AS eo
            // -- join users on users.id = eo.user_id
            // -- join usermetas on usermetas.user_id = eo.user_id
            // WHERE eo.category = 13061 order by id desc";

            // 22-11-2023
            $query = "SELECT
            eo.user_id,
            eo.organiser_name,
            eo.name,
            eo.email,
            eo.contact,
            eo.eventstartdate,
            eo.eventenddate,
            eo.event_bg_image,
            eo.eventimg_meta,
            eo.excel_sheet
            FROM school_weeks AS eo where category = 13063 order by id desc";
                // -- WHERE eo.event_bg_image is not null";
                // join users on users.id = eo.user_id
                // join usermetas on usermetas.user_id = eo.user_id
                // WHERE eo.event_bg_image is not null";
            $data = DB::select(DB::raw($query));

            //    dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );

            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "organiser_name",
                "name",
                "email",
                "contact",
                "eventstartdate",
                "eventenddate",
                "event_bg_image",
                "eventimg_meta",
                "excel_sheet"
            ]);

            foreach ($data as $each_user) {



                $arr = unserialize($each_user->eventimg_meta);
                $arr_eventimg_meta = implode(" | ",$arr);

                fputcsv($handle, [
                    $each_user->organiser_name,
                    $each_user->name,
                    $each_user->email,
                    $each_user->contact,
                    $each_user->eventstartdate,
                    $each_user->eventenddate,
                    $each_user->event_bg_image,
                    $arr_eventimg_meta,
                    $each_user->excel_sheet,
                ]);

            }        fclose($handle);

            //download command
            return Response::download($filename, "all_report_till_date.csv", $headers);

        }catch (Exception $e) {

            return abort(404);
        }
    }

    public function get_csv(){

        try{
            $from_date = date('Y-m-d').' 00:00:00';
            $to_date = date('Y-m-d').' 23:59:59';

            $school = SchoolWeek::select(
                'school_weeks.name',
                'school_weeks.school_chain',
                'school_weeks.contact',
                'school_weeks.email',
                'usermetas.city',
                'usermetas.state',
                'usermetas.district',
                'usermetas.block',
                'school_weeks.eventstartdate',
                'school_weeks.eventenddate',
                'school_weeks.created_at'
                )->join('usermetas', 'usermetas.user_id', '=', 'school_weeks.user_id')
                ->where('category', '=', 13063)
                ->whereBetween('school_weeks.created_at', [$from_date, $to_date])
                ->get();


            $headers = array(
                'Content-Type' => 'text/csv'
            );



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
                "School Chain",
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
                    $each_user->school_chain,
                    $each_user->created_at,
                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "get_today_create_event_report.csv", $headers);

        }catch (Exception $e) {

            return abort(404);
        }
    }

    public function all_get_csv(){
        // dd("all_get_csv");
        // $from_date = date('Y-m-d').' 00:00:00';
        // $to_date = date('Y-m-d').' 23:59:59';
        try{
            $school = Eventorganizations::select(
                'event_organizations.name',
                'event_organizations.school_chain',
                'event_organizations.contact',
                'event_organizations.email',
                'usermetas.city',
                'usermetas.district',
                'usermetas.state',
                'usermetas.block',
                'event_organizations.eventstartdate',
                'event_organizations.eventenddate',
                'event_organizations.created_at')
                ->join('usermetas', 'usermetas.user_id', '=', 'event_organizations.user_id')
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
                "Name",// Name of school
                "mobile", // contact number
                "Email", // schoo email
                "city",
                "district",
                "state",
                "block",
                "event start date",
                "event end date",
                "School Chain",
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
                    $each_user->school_chain,
                    $each_user->created_at,
                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "download.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function get_excel_school_event(){
        // dd("i am here");
        // $from_date = date('Y-m-d').' 00:00:00';
        // $to_date = date('Y-m-d').' 23:59:59';
        try{

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
                            eo.created_at FROM event_organizations AS eo
            join users on users.id = eo.user_id
            join usermetas on usermetas.user_id = eo.user_id
            WHERE eo.excel_sheet IS NOT null;";
        $data = DB::select(DB::raw($query));

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
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function lastmonthRegistration(){
        // dd("lastmonthRegistration");
        // $from_date = date('Y-m-d').' 00:00:00';
        // $to_date = date('Y-m-d').' 23:59:59';
        try{
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
                            where usermetas.gender is not null and users.created_at BETWEEN "2023-08-15 00:00:00" AND "2023-08-31 23:59:59";';
            $data = DB::select(DB::raw($query));

            //dd(count($data));
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
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function event_get_csv_participant(){
        try{
            // dd("event_get_csv_participant");
            // $from_date = date('Y-m-d').' 00:00:00';
            // $to_date = date('Y-m-d').' 23:59:59';

            // $query = 'select id,name,participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            // $query = 'select id,name,IFNULL(participantnum, 0) as participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            // $query = 'select eo.user_id,u.id,eo.name,IFNULL(eo.participantnum, 0) as participantnum, u.rolelabel as role, cast(eo.created_at as date) as created_at from event_organizations as eo inner join users as u on eo.user_id = u.id where eo.created_at >= "2023-08-20 00:00:01" order by eo.id asc;';
            $query = 'select eo.user_id,u.id,eo.name,participant_names,IFNULL(eo.total_participant, 0) as total_participant, u.rolelabel as role, cast(eo.created_at as date) as created_at from school_weeks as eo inner join users as u on eo.user_id = u.id where eo.created_at between "2023-11-15 00:00:01" and "2024-01-15 23:59:59" order by eo.id asc';

            // $query = 'select * from school_weeks as eo where eo.created_at between "2023-11-15 00:00:01" and "2024-01-15 23:59:59" and eo.name = "UTTAR PRADESH RUNNING 800M" order by eo.id asc';
            // $query = 'select * from school_weeks as eo inner join users as u on eo.user_id = u.id where eo.created_at between "2023-11-15 00:00:01" and "2024-01-15 23:59:59" order by eo.id asc;';
            $data = DB::select(DB::raw($query));

            // dd($data);
            // dd(count($data));
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Name",// Name of school
                "Role", // contact number
                "Participant Number", // contact number
                "Created at"
            ]);

            foreach ($data as $each_user) {
                // dd($each_user);
                // dd(unserialize($each_user->participant_names));
                // dd(count(unserialize($each_user->participant_names)));
                if($each_user->participant_names == null){

                    $participant_names = 0;
                }else{

                    $participant_names = count(unserialize($each_user->participant_names));
                }
                // dd($participant_names);
                fputcsv($handle, [
                    $each_user->name,
                    $each_user->role,
                    $each_user->total_participant,
                    $each_user->created_at,
                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "Total Participant Orginisation Wise.csv", $headers);

            // dd($school);
        }catch (Exception $e) {
            dd($e->getMessage());
            return abort(404);

        }
    }


    public function event_get_csv_participant_count(){
        try{
            // dd("event_get_csv_participant");
            // $from_date = date('Y-m-d').' 00:00:00';
            // $to_date = date('Y-m-d').' 23:59:59';

            // $query = 'select id,name,participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            // $query = 'select id,name,IFNULL(participantnum, 0) as participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            $query = "SELECT count(1) as count  FROM users WHERE `created_at` > '2023-11-15 00:00:01';";
            // $query = "SELECT count(1) as count  FROM users WHERE `created_at` between '2022-11-15 00:00:01' and '2023-01-15 23:59:59'";

            $data = DB::select(DB::raw($query));

            // dd($data);
            // dd(count($data));
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Count",// Name of school
            ]);

            foreach ($data as $each_user) {
                // dd();
                fputcsv($handle, [
                    $each_user->count
                    // $each_user->name,
                    // $each_user->role,
                    // $each_user->participantnum,
                    // $each_user->created_at,
                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "total_count.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function event_role_wise_user_registration(){
        try{
            // dd("event_get_csv_participant");
            // $from_date = date('Y-m-d').' 00:00:00';
            // $to_date = date('Y-m-d').' 23:59:59';

            // $query = 'select id,name,participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            // $query = 'select id,name,IFNULL(participantnum, 0) as participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            $query = "SELECT case when rolelabel is null then role else rolelabel end as countname ,count(1) as countnumber FROM users WHERE `created_at` > '2023-11-15 00:00:01' group by case when rolelabel is null then role else rolelabel end;";
            // $query = "SELECT case when rolelabel is null then role else rolelabel end as countname ,count(1) as countnumber FROM users WHERE `created_at` between '2022-11-15 00:00:01' and '2023-01-15 23:59:59' group by case when rolelabel is null then role else rolelabel end;";
            $data = DB::select(DB::raw($query));

            // dd($data);
            // dd(count($data));
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Role",// Name of school
                "Count",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user->countnumber);
                fputcsv($handle, [
                    $each_user->countname,
                    $each_user->countnumber
                    // $each_user->name,
                    // $each_user->role,
                    // $each_user->participantnum,
                    // $each_user->created_at,
                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "role_wise_user_registration.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function event_date_wise_user_registration(){
        try{
            // dd("event_get_csv_participant");
            // $from_date = date('Y-m-d').' 00:00:00';
            // $to_date = date('Y-m-d').' 23:59:59';

            // $query = 'select id,name,participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            // $query = 'select id,name,IFNULL(participantnum, 0) as participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            $query = "SELECT case when rolelabel is null then role else rolelabel end as rolename, cast(created_at as date) as date,count(1) as count_number FROM users WHERE `created_at` > '2023-11-15 00:00:01' group by case when rolelabel is null then role else rolelabel end,cast(created_at as date);";
            // $query = "SELECT case when rolelabel is null then role else rolelabel end as rolename, cast(created_at as date) as date,count(1) as count_number FROM users WHERE `created_at` between '2022-11-15 00:00:01' and '2023-01-15 23:59:59' group by case when rolelabel is null then role else rolelabel end,cast(created_at as date);";
            $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Role",// Name of school
                "Date",// Name of school
                "Count",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user->countnumber);
                fputcsv($handle, [
                    $each_user->rolename,
                    $each_user->date,
                    $each_user->count_number
                    // $each_user->name,
                    // $each_user->role,
                    // $each_user->participantnum,
                    // $each_user->created_at,
                ]);

            }
            fclose($handle);
            return Response::download($filename, "date wise_user_registration.csv", $headers);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function demandreport2023(){

        $query = "SELECT u.name,um.state,eo.email,eo.contact,eo.school_chain,event_bg_image,IFNULL(eo.participantnum, 0) as participantnum,eo.total_participant,eo.excel_sheet FROM school_weeks AS eo inner join usermetas as um on eo.user_id = um.user_id inner join users as u on u.id = um.user_id where category = 13063 and um.state = 'jharkhand' and u.role = 'school' order by um.id desc;";
        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');
        // dd($data);
            fputcsv($handle, [
                "Name",// Name of school
                "Email",// Name of school
                "Phone",
                "Participant",
                "Total Participant",
                "Excel Sheet",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user->countnumber);
                fputcsv($handle, [
                    $each_user->name,
                    $each_user->email,
                    $each_user->contact,
                    $each_user->participantnum,
                    $each_user->excel_sheet
                    // $each_user->name,
                    // $each_user->role,
                    // $each_user->participantnum,
                    // $each_user->created_at,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "date wise_user_registration.csv", $headers);

    }


    public function demandreportregistration(){

        $query = "SELECT u.name,u.email,u.phone,u.rolelabel,um.state,um.district,um.block,um.city FROM users as u inner JOIN usermetas as um on um.user_id = u.id WHERE u.created_at BETWEEN '2023-11-15 00:00:01' AND '2024-08-25 23:59:59' and um.state = 'jharkhand';";
        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');
        // dd($data);
            fputcsv($handle, [
                "Name",// Name of school
                "Email",// Name of school
                "Phone",
                "Role",
                "State",
                "District",
                "Block",
                "City",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user->countnumber);
                fputcsv($handle, [
                    $each_user->name,
                    $each_user->email,
                    $each_user->phone,
                    $each_user->rolelabel,
                    $each_user->state,
                    $each_user->district,
                    $each_user->block,
                    $each_user->city,
                    // $each_user->name,
                    // $each_user->role,
                    // $each_user->participantnum,
                    // $each_user->created_at,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "Jharkhand all registration.csv", $headers);

    }

    public function get_user_list(){
        // dd("get_user_list");
        // $query = "SELECT DISTINCT(phone) as phone, id, name FROM `users`;";
        $query = "SELECT DISTINCT(email) as email, id, name FROM `users`;";
        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');
        // dd($data);
            fputcsv($handle, [
                "id",
                "Name",// Name of school
                // "phone",// Name of school
                "Email",// Name of school
            ]);

            foreach ($data as $each_user) {
                // dd($each_user);
                fputcsv($handle, [
                    $each_user->id,
                    $each_user->name,
                    // $each_user->phone,
                    $each_user->email,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "get user email.csv", $headers);

    }

    public function fit_india_cycling_drive_event_organizations(){
        // dd("fit_india_cycling_drive_event_organizations");
        // $query = "SELECT DISTINCT(phone) as phone, id, name FROM `users`;";
        $query = "SELECT u.name,u.rolewise,um.cyclothonrole,eo.eventstartdate,eo.participantnum,eo.participant_names FROM users as u inner join usermetas as um on u.id = um.user_id inner join event_organizations as eo on u.id = eo.user_id WHERE um.cyclothonrole LIKE 'club';";
        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');
        // dd($data);
            fputcsv($handle, [
                "Name",
                "Role Wise",
                "Cyclothon Role",
                "Event Start Date",
                "Participant Num",
                "participant Names",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user);
                fputcsv($handle, [
                    $each_user->name,
                    $each_user->rolewise,
                    $each_user->cyclothonrole,
                    $each_user->eventstartdate,
                    $each_user->participantnum,
                    $each_user->participant_names,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "Fit India Cycling Drive Event Organizations.csv", $headers);

    }

    function one_year_users(){

        // $query = "SELECT u.id as KheloIndiaId, u.email as UserName, u.name as Name, u.phone as MobileNo, u.email as EmailID FROM users as u WHERE `created_at` > '2024-03-15 00:00:01';";
        $query = "SELECT u.id as KheloIndiaId FROM users as u WHERE `created_at` > '2024-03-15 00:00:01';";
        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );

        // dd($data);
            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
                "user_id",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user->KheloIndiaId);
                fputcsv($handle, [
                    $each_user->KheloIndiaId,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "Fit India user list.csv", $headers);

    }

    function socEventReport13072025(){



        // $query = "SELECT sop.user_id,sop.uname, sop.event_date,
        //             sop.cycle_booking,
        //             sop.cycle_waiting,
        //             sop.cycle,
        //             sop.meal_booking,
        //             sop.meal_waiting,
        //             sop.meal
        //             FROM soc_event_participations as sop LEFT join soc_event_participation_receives as sopr on sop.user_id = sopr.user_id and sop.socemid = sopr.socemid where sop.socemid = 3;";

        $query = "SELECT users.email,users.phone,usermetas.address_line_one,usermetas.address_line_two,sop.user_id,sop.uname, sop.event_date,sop.cycle_booking,sop.cycle_waiting,sop.cycle,sop.meal_booking,sop.meal_waiting,sop.meal
                    FROM soc_event_participations as sop INNER join users on users.id = sop.user_id join usermetas on users.id = usermetas.user_id LEFT join soc_event_participation_receives as sopr on sop.user_id = sopr.user_id and sop.socemid = sopr.socemid
                    where sop.socemid = 7;";


        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
                    "User ID",
                    "Name",
                    "Email",
                    "Phone",
                    "Address Line One",
                    "Address Line Two",
                    "Cycle Booking",
                    "Cycle Waiting",
                    "Cycle",
                    "Meal Booking",
                    "Meal Waiting",
                    "Meal",
                    "Date",

            ]);

            foreach ($data as $each_user) {
            //    dd($each_user);
                fputcsv($handle, [
                        $each_user->user_id,
                        $each_user->uname,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->address_line_one,
                        $each_user->address_line_one,
                        $each_user->cycle_booking,
                        $each_user->cycle_waiting,
                        $each_user->cycle,
                        $each_user->meal_booking,
                        $each_user->meal_waiting,
                        $each_user->meal,
                        $each_user->event_date,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "soceventdata.csv", $headers);
    }


    function soc_report_both_data(){


        // $query = "SELECT sopr.user_id,sopr.uname,sopr.event_date,sopr.cycle,sopr.meal FROM soc_event_participation_receives as sopr where sopr.socemid = 3 and sopr.user_id not in (select user_id from soc_event_participations where socemid = 3);";
        $query = "SELECT users.email,users.phone,usermetas.address_line_one,usermetas.address_line_two,sopr.user_id,sopr.uname,sopr.event_date,sopr.cycle,sopr.meal FROM soc_event_participation_receives as sopr INNER join users on users.id = sopr.user_id join usermetas on users.id = usermetas.user_id where sopr.socemid = 7 and sopr.user_id in (select user_id from soc_event_participations where socemid = 7);";

        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
                    "User ID",
                    "Name",
                    "email",
                    "Phone",
                    "Address Line One",
                    "Address Line Two",
                    "Cycle Booking",
                    "Cycle Waiting",
                    "Cycle",
                    "Meal Booking",
                    "Meal Waiting",
                    "Meal",
                    "Date",

            ]);

            foreach ($data as $each_user) {

                fputcsv($handle, [
                        $each_user->user_id,
                        $each_user->uname,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->address_line_one,
                        $each_user->address_line_two,
                        "",
                        "",
                        $each_user->cycle,
                        "",
                        "",
                        $each_user->meal,
                        $each_user->event_date,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "soceventdatadata.csv", $headers);
    }

    function socEventReportdata13072025(){


        // $query = "SELECT sopr.user_id,sopr.uname,sopr.event_date,sopr.cycle,sopr.meal FROM soc_event_participation_receives as sopr where sopr.socemid = 3 and sopr.user_id not in (select user_id from soc_event_participations where socemid = 3);";
        $query = "SELECT users.email,users.phone,usermetas.address_line_one,usermetas.address_line_two,sopr.user_id,sopr.uname,sopr.event_date,sopr.cycle,sopr.meal FROM soc_event_participation_receives as sopr INNER join users on users.id = sopr.user_id join usermetas on users.id = usermetas.user_id where sopr.socemid = 7 and sopr.user_id not in (select user_id from soc_event_participations where socemid = 7);";

        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
                    "User ID",
                    "Name",
                    "email",
                    "Phone",
                    "Address Line One",
                    "Address Line Two",
                    "Cycle Booking",
                    "Cycle Waiting",
                    "Cycle",
                    "Meal Booking",
                    "Meal Waiting",
                    "Meal",
                    "Date",

            ]);

            foreach ($data as $each_user) {
            //    dd($each_user);
                fputcsv($handle, [
                        $each_user->user_id,
                        $each_user->uname,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->address_line_one,
                        $each_user->address_line_two,
                        "",
                        "",
                        $each_user->cycle,
                        "",
                        "",
                        $each_user->meal,
                        $each_user->event_date,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "soceventdatadata.csv", $headers);
    }

    function soc_report_cycle_return_data(){


        // $query = "SELECT sopr.user_id,sopr.uname,sopr.event_date,sopr.cycle,sopr.meal FROM soc_event_participation_receives as sopr where sopr.socemid = 3 and sopr.user_id not in (select user_id from soc_event_participations where socemid = 3);";
        $query = "SELECT users.email,
                            users.phone,
                            usermetas.address_line_one,
                            usermetas.address_line_two,
                            sopr.user_id,
                            sopr.uname,
                            sopr.event_date,
                            sopr.cycle,
                            sopr.meal,
                            sopr.cycle_return,
                            sopr.cycle_return_admin_user_id
                    FROM soc_event_participation_receives as sopr
                    INNER join users on users.id = sopr.user_id
                    join usermetas on users.id = usermetas.user_id
                    where sopr.socemid = 7 and sopr.user_id;";

        $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');


            fputcsv($handle, [
                    "User ID",
                    "Name",
                    "email",
                    "Phone",
                    "Address Line One",
                    "Address Line Two",
                    "Cycle Booking",
                    "Cycle Waiting",
                    "Cycle",
                    "Meal Booking",
                    "Meal Waiting",
                    "Meal",
                    "Date",

            ]);

            foreach ($data as $each_user) {

                fputcsv($handle, [
                        $each_user->user_id,
                        $each_user->uname,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->address_line_one,
                        $each_user->address_line_two,
                        "",
                        "",
                        $each_user->cycle,
                        "",
                        "",
                        $each_user->meal,
                        $each_user->event_date,
                ]);

            }

            fclose($handle);
            return Response::download($filename, "soc_report_cycle_return_data.csv", $headers);
    }

}
