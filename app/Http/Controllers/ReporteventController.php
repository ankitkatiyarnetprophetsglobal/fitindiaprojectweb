<?php

namespace App\Http\Controllers;
use App\Models\SchoolWeek;
use App\Models\Eventorganizations;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request,Response;
use App\Models\DeletedUsers;
use App\Models\User;

class ReporteventController extends Controller
{

    public function getallevent(){
        $query = "SELECT * FROM event_cats where status = '2'";
        $data = DB::select(DB::raw($query));
        foreach ($data as $x => $y) {
            echo $y->id;
            echo "         ";
            echo $y->name;
            echo '<br>';
          }
        dd($data);
    }

    public function get_excel_image($id){

        try{
            // dd('get_excel_image');
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
            eo.excel_sheet,
            IFNULL(eo.participantnum, 0) as participantnum
            FROM event_organizations AS eo where category = $id order by id desc";

            // $query = "SELECT eo.user_id,eo.organiser_name,eo.name,eo.email,eo.contact,eo.eventstartdate,eo.eventenddate,eo.event_bg_image,eo.eventimg_meta,eo.excel_sheet,um.state FROM usermetas um left join event_organizations AS eo on um.user_id = eo.user_id where category = 13064 order by um.state;";
            // $query = "SELECT eo.user_id,eo.organiser_name,eo.name,eo.email,eo.contact,eo.eventstartdate,eo.eventenddate,eo.event_bg_image,eo.eventimg_meta,eo.excel_sheet,IFNULL(um.state, 'Not specified') as state,um.created_at FROM usermetas um left join event_organizations AS eo on um.user_id = eo.user_id where category = 13064 order by eo.name;";
            $data = DB::select(DB::raw($query));
            dd($data);

            $headers = array(
                'Content-Type' => 'text/csv'
            );

            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Organiser Name",
                "Name",
                "Email",
                "Contact",
                "Event Start Date",
                "Event End Date",
                "Event BG Image",
                "Eventimg Meta",
                "Excel Sheet",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user);
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
            return Response::download($filename, "All Report Till Date.csv", $headers);

        }catch (Exception $e) {

            return abort(404);
        }
    }

    public function get_csv($id){

        try{
            $from_date = date('Y-m-d').' 00:00:00';
            $to_date = date('Y-m-d').' 23:59:59';

            $school = Eventorganizations::select(
                'event_organizations.name',
                'event_organizations.school_chain',
                'event_organizations.contact',
                'event_organizations.email',
                'usermetas.city',
                'usermetas.state',
                'usermetas.district',
                'usermetas.block',
                'event_organizations.eventstartdate',
                'event_organizations.eventenddate',
                'event_organizations.created_at'
                )->join('usermetas', 'usermetas.user_id', '=', 'event_organizations.user_id')
                // ->where('category', '=', $id)
                ->whereBetween('usermetas.created_at', [$from_date, $to_date])
                ->get();

            // dd(DB::enableQueryLog($school));

            $headers = array(
                'Content-Type' => 'text/csv'
            );



            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Name",// Name of school
                "Mobile", // contact number
                "Email", // schoo email
                "City",
                "District",
                "State",
                "Block",
                "Event Start Date",
                "Event End Date",
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
            return Response::download($filename, "Get Today School Register Report.csv", $headers);

        }catch (Exception $e) {

            return abort(404);
        }
    }

    public function all_get_csv($event_id){

        try{
            // dd($event_id);
            $school = Eventorganizations::select(
                'event_organizations.event_name_store',
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
                ->where('category', '=', $event_id)
                ->get();

            $headers = array(
                'Content-Type' => 'text/csv'
            );

            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Name",// Name of school
                "Event Name",
                "Mobile", // contact number
                "Email", // schoo email
                "city",
                "District",
                "State",
                "Block",
                "Event start date",
                "Event end date",
                "Organization Name",
                "Created at"
            ]);

            foreach ($school as $each_user) {
                fputcsv($handle, [
                    $each_user->name,
                    $each_user->event_name_store,
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
            return Response::download($filename, "All Get CSV.csv", $headers);

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function get_excel_school_event($event_id){

        try{

            $query = 'SELECT users.name,

                            users.email,
                            users.phone,
                            usermetas.udise,
                            usermetas.city,
                            usermetas.district,
                            usermetas.state,
                            usermetas.block,
                            usermetas.address,
                            eo.event_name_store,
                            eo.excel_sheet,
                            eo.eventstartdate,
                            eo.eventenddate,
                            eo.school_chain,
                            eo.created_at FROM event_organizations AS eo
            join users on users.id = eo.user_id
            join usermetas on usermetas.user_id = eo.user_id
            WHERE eo.excel_sheet IS NOT null
            AND eo.category = "'.$event_id.'";';
        $data = DB::select(DB::raw($query));

        // dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Name",// Name of school
                "Event Name",
                "Email", // contact number
                "Phone", // schoo email
                "City",
                "District",
                "State",
                "Block",
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
                    $each_user->event_name_store,
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
            return Response::download($filename, "Get Excel School Event.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function lastdaywiseRegistration($from,$to,$event_id){

        $from_date = $from.' 00:00:00';
        $to_date = $to.' 23:59:59';
        // dd($event_id);
        try{
            $query = 'SELECT
                            event_organizations.event_name_store as event_name_store,
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
                            users.created_at
                            FROM fitindia.users
                            join usermetas on users.id = usermetas.user_id
                            join event_organizations on event_organizations.user_id = users.id
                            where event_organizations.category = "'.$event_id.'"
                            AND users.created_at BETWEEN "'.$from_date.'" AND "'.$to_date.'";';
                            // AND usermetas.gender is not null
            // dd($query);
            $data = DB::select(DB::raw($query));

            // dd(count($data));
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Event Name",
                "Name",// Name of school
                "Email", // contact number
                "Phone", // schoo email
                "City",
                "District",
                "State",
                "Block",
                // "Event User Name",
                // "Address",
                // 'Age',
                // "DOB",
                // "Gender",
                "Created at"
            ]);

            foreach ($data as $each_user) {
                fputcsv($handle, [
                    $each_user->event_name_store,
                    $each_user->name,
                    $each_user->email,
                    $each_user->phone,
                    $each_user->city,
                    $each_user->district,
                    $each_user->state,
                    $each_user->block,
                    // $each_user->name2,
                    // $each_user->address,
                    // $each_user->age,
                    // $each_user->dob,
                    // $each_user->gender,
                    $each_user->created_at,
                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "Date Wise As Per Request Registration.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function event_get_csv_participant($from,$to,$event_id){
        try{
            $from_date = $from.' 00:00:00';
            $to_date = $to.' 23:59:59';
            // dd("event_get_csv_participant");
            // $from_date = date('Y-m-d').' 00:00:00';
            // $to_date = date('Y-m-d').' 23:59:59';

            // $query = 'select id,name,participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            // $query = 'select id,name,IFNULL(participantnum, 0) as participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            $query = 'select eo.user_id,u.id,eo.name,IFNULL(eo.participantnum, 0) as participantnum, u.rolelabel as role, cast(eo.created_at as date) as created_at from event_organizations as eo inner join users as u on eo.user_id = u.id where eo.created_at >= "2023-08-20 00:00:01" order by eo.id asc;';
            // $query = 'select
            //                 eo.user_id,
            //                 u.id,
            //                 eo.name,
            //                 participant_names,
            //                 IFNULL(eo.total_participant, 0) as total_participant,
            //                 u.rolelabel as role,
            //                 cast(eo.created_at as date) as created_at
            //                 from event_organizations as eo
            //                 inner join users as u on eo.user_id = u.id
            //                 where eo.category = "'.$event_id.'"
            //                 AND eo.created_at between "'.$from_date.'" AND "'.$to_date.'"
            //                 order by eo.id asc';
            // dd($query);
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
            // dd("event_get_csv_participant_count");
            // $from_date = date('Y-m-d').' 00:00:00';
            // $to_date = date('Y-m-d').' 23:59:59';

            // $query = 'select id,name,participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            // $query = 'select id,name,IFNULL(participantnum, 0) as participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2023-08-20 00:00:01" order by id asc;';
            $query = "SELECT count(1) as count  FROM users WHERE `created_at` > '2024-08-14 00:00:01';";
            // $from_date = $from.' 00:00:00';
            // $to_date = $to.' 23:59:59';
            // $query = 'SELECT count(1) as count  FROM users
            //             join event_organizations on event_organizations.user_id = users.id
            //             where event_organizations.category = "'.$event_id.'" AND users.created_at between "'.$from_date.'" AND "'.$to_date.'"';

                        // where event_organizations.category = "'.$event_id.'" AND users.`created_at` > "2024-08-01 00:00:01";';
            // dd($query);
                        // where event_organizations.category = "'.$event_id.'" AND users.created_at between "'.$from_date.'" AND "'.$to_date.'"';
            $data = DB::select(DB::raw($query));
            // dd($data);

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
            return Response::download($filename, "Total Count Registration Event Wise.csv", $headers);

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
            // $query = 'select id,name,IFNULL(participantnum, 0) as participantnum,cast(created_at as date) as created_at from event_organizations where `created_at` >= "2024-08-15 00:00:01" order by id asc;';
            // $from_date = $from.' 00:00:00';
            // $to_date = $to.' 23:59:59';
            // $query = 'SELECT
            //                 case when rolelabel is null then role else rolelabel end as countname,
            //                 count(1) as countnumber
            //                 FROM users
            //                 join event_organizations on event_organizations.user_id = users.id
            //                 WHERE event_organizations.category = "'.$event_id.'"
            //                 AND users.created_at between "'.$from_date.'" AND "'.$to_date.'"
            //                 group by case when rolelabel is null then role else rolelabel end;';

            // $query ='SELECT
            //             case when rolelabel is null then role else rolelabel end as countname,
            //             count(1) as countnumber
            //             FROM users
            //             Where (SELECT category FROM `event_organizations` WHERE `category` = "'.$event_id.'" limit 1) and users.created_at between "'.$from_date.'" AND "'.$to_date.'"
            //             group by case when rolelabel is null then role else rolelabel end;';
            // dd($query);
            // $query = "SELECT case when rolelabel is null then role else rolelabel end as countname ,count(1) as countnumber FROM users WHERE `created_at` between '2024-08-15 00:00:01' and '2024-08-31 23:59:59' group by case when rolelabel is null then role else rolelabel end;";
            $query = "SELECT case when rolelabel is null then role else rolelabel end as countname ,count(1) as countnumber FROM users WHERE created_at > '2024-08-14 00:00:01' group by case when rolelabel is null then role else rolelabel end;";
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
            return Response::download($filename, "Role Wise User Registration.csv", $headers);

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
            // $from_date = $from.' 00:00:00';
            // $to_date = $to.' 23:59:59';
            // $query = 'SELECT
            //                     case when rolelabel is null then role else rolelabel end as rolename,
            //                     cast(created_at as date) as date,
            //                     count(1) as count_number
            //                 FROM users
            //                 WHERE (SELECT category FROM `event_organizations` WHERE event_organizations.category = "'.$event_id.'" limit 1) and users.created_at between "'.$from_date.'" AND "'.$to_date.'"
            //                 group by case when rolelabel is null then role else rolelabel end, cast(users.created_at as date);';
            // $query = 'SELECT
            //                     case when rolelabel is null then role else rolelabel end as rolename,
            //                     cast(created_at as date) as date,
            //                     count(1) as count_number
            //                 FROM users
            //                 WHERE users.created_at between "'.$from_date.'" AND "'.$to_date.'"
            //                 group by case when rolelabel is null then role else rolelabel end, cast(users.created_at as date);';
            $query = "SELECT case when rolelabel is null then role else rolelabel end as rolename, cast(created_at as date) as date,count(1) as count_number FROM users WHERE created_at > '2024-08-14 00:00:01' group by case when rolelabel is null then role else rolelabel end,cast(created_at as date);";
            $data = DB::select(DB::raw($query));
            // dd($data);
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
            return Response::download($filename, "Date Wise User Registration.csv", $headers);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function delete_user_detail(){

        // $data = DB::table('deletedusers')->select('deletedusers.user_id','users.email','users.phone','users.rolelabel')
        $data = DB::table('deletedusers')->select('*')
            ->join('users', 'users.id', '=', 'deletedusers.user_id')
            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
            ->where([
                    ['status', '=', '1']
                    ])
            ->whereDate('request_date', '<=', date('Y-m-d'))->get();

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "E Mail",
                "Phone",
                "Role Label",
                "State",
                "District",
                "Block",
                "City",
                "OS Details"
            ]);
            // dd($data);
            foreach ($data as $each_user) {
                // dd($each_user->countnumber);
                fputcsv($handle, [
                    $each_user->email,
                    $each_user->phone,
                    $each_user->rolelabel,
                    $each_user->state,
                    $each_user->district,
                    $each_user->block,
                    $each_user->city,
                    $each_user->os_details,
                ]);

            }
            dd($data);
            fclose($handle);
            return Response::download($filename, "Delete User Details.csv", $headers);

        // DB::enableQueryLog();
        // $product = DB::table('deletedusers')->select('deletedusers.user_id','users.email','users.phone','users.rolelabel')
        // ->join('users', 'users.id', '=', 'deletedusers.user_id')
        // ->where([
        //         ['status', '=', '1']
        //         ])
        // ->whereDate('request_date', '<=', date('Y-m-d'))->get();
        // $query = DB::getQueryLog();
        // print_r($query);

    }

    public function event_state_wise_user_registration(){

        try{
            // dd('event_state_wise_user_registration');
            $query = "SELECT um.state,count(1) as count_number  FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-08-14 00:00:01' and um.state is not null GROUP BY um.state order by um.state;";
            // $query = "SELECT um.state,count(1) as count_number  FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at between '2023-08-14 00:00:01' and '2023-08-31 23:59:59' and um.state is not null GROUP BY um.state order by um.state;";
            $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Stae",
                "Count",
            ]);

            foreach ($data as $each_user) {

                fputcsv($handle, [
                    $each_user->state,
                    $each_user->count_number,
                ]);

            }
            fclose($handle);

            return Response::download($filename, "State Wise User Registration.csv", $headers);

        }catch (Exception $e) {

            return abort(404);

        }
    }


    public function statesummary(Request $request){

        try{
            // dd('statesummary1');
            // $query = "SELECT u.name,um.state,um.city,um.district,um.block,um.gender,u.rolelabel  FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-08-14 00:00:01' and um.state is not null order by um.state;";
            $query = "SELECT u.name,um.state,um.city,um.district,um.block,um.gender, IFNULL(u.rolelabel, u.role) as rolelabel FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-08-14 00:00:01' and um.state is not null order by um.state;";
            $data = DB::select(DB::raw($query));
            // dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "State",
                "Name",
                "City",
                "District",
                "Block",
                "Gender",
                "Role Label",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user->countnumber);
                fputcsv($handle, [
                    $each_user->state,
                    $each_user->name,
                    $each_user->city,
                    $each_user->district,
                    $each_user->block,
                    $each_user->gender,
                    $each_user->rolelabel
                ]);

            }
            fclose($handle);
            return Response::download($filename, "State Wise Data.csv", $headers);
        }catch (Exception $e) {

            return abort(404);

        }
    }



    public function totalparticipation(Request $request){

        try{
            // dd('totalparticipation');
            // $query = "SELECT u.name,um.state,um.city,um.district,um.block,um.gender,u.rolelabel  FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-08-14 00:00:01' and um.state is not null order by um.state;";
            $query = "SELECT u.name,IFNULL(u.rolelabel, u.role) as rolelabel,um.state,um.city,um.created_at FROM users as u inner join usermetas as um on u.id = um.user_id where u.id in (select user_id from event_organizations where category = 13064)";
            $data = DB::select(DB::raw($query));
            // dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Name",
                "Role",
                "state",
                "city",
                "created_at",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user->countnumber);
                fputcsv($handle, [
                    $each_user->name,
                    $each_user->rolelabel,
                    $each_user->state,
                    $each_user->city,
                    $each_user->created_at
                ]);

            }
            fclose($handle);
            return Response::download($filename, "Total Participation.csv", $headers);
        }catch (Exception $e) {

            return abort(404);

        }
    }


    public function cyclothonRegistration(){
        // dd(321);
        try{
            // $query = 'SELECT IFNULL(users.rolewise, "cyclothon-2024") as participantnum,
            //             users.name,
            //             users.created_at,
            //             usermetas.city,
            //             usermetas.state,
            //             usermetas.district,
            //             usermetas.block,
            //             usermetas.cyclothonrole,
            //             usermetas.participant_number,
            //             -- IFNULL( usermetas.participant_number, "0") as participant_number,
            //             IFNULL( usermetas.cycle, "no") as cycle,
            //             usermetas.gender
            //         FROM users
            //         join usermetas on users.id = usermetas.user_id
            //         where (users.rolewise = "cyclothon-2024" or users.role = "cyclothon-2024")';
            // $query = 'SELECT
            //         users.name,
            //         users.email,
            //         users.phone,
            //         IFNULL(users.rolewise, "cyclothon-2024") as rolewise,
            //         IFNULL(usermetas.participant_number, "0") as participant,
            //         users.created_at,
            //         users.updated_at,
            //         usermetas.city,
            //         usermetas.state,
            //         usermetas.district,
            //         usermetas.block,
            //         usermetas.cyclothonrole,
            //         IFNULL( usermetas.cycle, "no") as cycle,
            //         usermetas.gender
            //         FROM `users` join usermetas on users.id = usermetas.user_id
            //         where (users.rolewise = "cyclothon-2024" or users.role = "cyclothon-2024")
            //         and `email` NOT LIKE "%ankit.katiyar%"';
                    //  and usermetas.participant_number > 0
            // $query = 'SELECT
            //             users.name,
            //             users.email,
            //             users.phone,
            //             IFNULL(users.rolewise, "cyclothon-2024") as rolewise,
            //             IFNULL(usermetas.participant_number, "0") as participant,
            //             users.created_at,
            //             users.updated_at,
            //             usermetas.city,
            //             usermetas.state,
            //             usermetas.district,
            //             usermetas.block,
            //             usermetas.cyclothonrole,
            //             IFNULL( usermetas.cycle, "no") as cycle,
            //             usermetas.gender
            //             FROM `users` join usermetas on users.id = usermetas.user_id
            //             where (users.rolewise = "cyclothon-2024" or users.role = "cyclothon-2024")
            //             and `email` NOT LIKE "%ankit.katiyar%"
            //             UNION ALL
            //             select
            //             u.name,
            //             u.email,
            //             u.phone,
            //             IFNULL(u.rolewise, "cyclothon-2024") as rolewise,
            //             IFNULL(um.participant_number, "0") as participant,
            //             u.created_at,
            //             u.updated_at,
            //             um.city,
            //             um.state,
            //             um.district,
            //             um.block,
            //             um.cyclothonrole,
            //             IFNULL( um.cycle, "no") as cycle,
            //             um.gender
            //             from users as u
            //             join usermetas as um on u.id = um.user_id
            //             join namo_users_updates as nuu on u.id = nuu.user_id
            //             where (u.rolewise = "cyclothon-2024" or u.role = "cyclothon-2024")
            //             and u.email NOT LIKE "%ankit.katiyar%";';
            $query = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,usermetas.cyclothonrole,IFNULL(usermetas.participant_number, '0') as participant,IFNULL( usermetas.cycle, 'no') as cycle,users.created_at,users.updated_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%';";

            $data = DB::select(DB::raw($query));

            // dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Role Lable",
                "Name",// Name of school
                "Email",
                "Mobile",
                "State",
                "District",
                "Block",
                "City",
                "Gender",
                "Cycle",
                "Register As",
                "Participant",
                "Created On"
            ]);

            foreach ($data as $each_user) {

                // dd($each_user->created_at);
                // dd($each_user->updated_at);
                if($each_user->created_at < $each_user->updated_at){

                    $date = $each_user->updated_at;

                }else{

                    $date = $each_user->created_at;

                }

                fputcsv($handle, [
                    "Sundays on cycle",
                    $each_user->name,
                    $each_user->email,
                    $each_user->phone,
                    $each_user->state,
                    $each_user->district,
                    $each_user->block,
                    $each_user->city,
                    $each_user->gender,
                    $each_user->cycle,
                    $each_user->cyclothonrole,
                    $each_user->participant,
                    $date,
                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "Cyclothon-2024.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    // public function cyclothonrenningdatawise(){
    //     try{
    //         // dd("sadfsadfasdfasdfasdf");
    //         // $query = 'SELECT u.name,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2;';

    //         $query = 'SELECT u.name,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2 order by uh.created_by ASC;';

    //         $data = DB::select(DB::raw($query));

    //         // dd($data);
    //         $headers = array(
    //             'Content-Type' => 'text/csv'
    //         );


    //         $filename =  public_path("event.csv");
    //         $handle = fopen($filename, 'w');

    //         fputcsv($handle, [
    //             "Name",
    //             "Trip Name",// Name of school
    //             "Duration (Min)",
    //             "Distance",
    //             // "Max Speed",
    //             "Average Speed",
    //             "Commemt",
    //             "Mode",
    //             "Date",
    //             "carbon Save"
    //         ]);

    //         foreach ($data as $each_user) {
    //             // dd($each_user);
    //             fputcsv($handle, [
    //                 $each_user->name,
    //                 $each_user->trip_name,
    //                 round($each_user->duration/60,2),
    //                 round($each_user->distance,2).' '.$each_user->uom,
    //                 // $each_user->max_speed,
    //                 $each_user->average_speed,
    //                 $each_user->commemt,
    //                 "Cycle",
    //                 $each_user->created_by,
    //                 $each_user->carbonSave,

    //             ]);

    //         }
    //         fclose($handle);

    //         //download command
    //         return Response::download($filename, "Cycle data.csv", $headers);

    //         // dd($school);
    //     }catch (Exception $e) {

    //         return abort(404);

    //     }
    // }

    public function cyclothonrenningdatawise(){
        try{

            // dd("sadfsadfasdfasdfasdf");
            // $query = 'SELECT u.name,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2;';
            // $query = 'SELECT u.name,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2 order by uh.created_by ASC;';
            // $query = 'SELECT u.name,u.email,u.phone,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave,um.state,um.district,um.block,um.city FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id inner join usermetas as um on u.id = um.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2 order by uh.created_by ASC;';
            // $query = 'SELECT u.name,u.email,u.phone,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave,um.state,um.district,um.block,um.city FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id inner join usermetas as um on u.id = um.user_id where uh.created_by >= "2025-08-16 00:00:01" and uh.modegroupid = 2 and u.id in (2207513,2207524,2207465,2207425,2198495,2207642,2207546,2207451,2207427,2200635,2207839,2207508,2207556,2207453,1989687,2207841,2207640,2207843,2207810,2207845,2207313,2207501,2207572,2207616,2207783,2207565,2207615,2207757,2207487,2203217,2207630,2207467,2207639,2207485,2207473,2207855,2207856,2207480,2207445,2207430,2207858,2207455,2207432,2207466,1998024,2207876,2207237,2207824,2207880,2169457,2207626,2129871,2203864,2205255,2207422,2207419,2207548,2207474,2207778,2207434,2206103) order by uh.created_by ASC;';
            $query = 'SELECT
                                u.id,
                                u.name,
                                u.email,
                                u.phone,
                                COUNT(uh.trip_name) AS total_trips,
                                SUM(uh.duration) AS duration,
                                SUM(uh.distance) AS distance,
                                MAX(uh.uom) AS uom,
                                MAX(uh.max_speed) AS max_speed,
                                AVG(uh.average_speed) AS average_speed,
                                MAX(uh.modegroupid) AS modegroupid,
                                MIN(uh.created_by) AS first_created_by,
                                SUM(uh.carbonSave) AS carbonSave,
                                MAX(um.state) AS state,
                                MAX(um.district) AS district,
                                MAX(um.block) AS block,
                                MAX(um.city) AS city
                            FROM users AS u
                            INNER JOIN userhistorytrakings AS uh
                                ON u.id = uh.user_id
                            INNER JOIN usermetas AS um
                                ON u.id = um.user_id
                            WHERE uh.created_by >= "2024-12-17 00:00:01"
                            AND uh.average_speed <= 100
                            AND uh.modegroupid = 2
                            GROUP BY
                                u.id,
                                u.name,
                                u.email,
                                u.phone
                            ORDER BY first_created_by ASC;';


            $data = DB::select(DB::raw($query));

            // dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "ID",
                "Name",
                "Email",
                "Phone",
                "Trip Name",// Name of school
                "Duration (Min)",
                "Distance",
                // "Max Speed",
                "Average Speed",
                // "Commemt",
                "Mode",
                "Date",
                "carbon Save",
                "State",
                "District",
                // "Block",
                "City"
            ]);

            foreach ($data as $each_user) {
                // dd($each_user);
                fputcsv($handle, [
                    $each_user->id,
                    $each_user->name,
                    $each_user->email,
                    $each_user->phone,
                    $each_user->total_trips,
                    round($each_user->duration/60,2),
                    round($each_user->distance,2).' '.$each_user->uom,
                    // // $each_user->max_speed,
                    $each_user->average_speed,
                    // $each_user->commemt,
                    "Cycle",
                    $each_user->first_created_by,
                    $each_user->carbonSave,
                    $each_user->state,
                    $each_user->district,
                    $each_user->city,

                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "Cycle data.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function carboncratedsoc(){
        try{

            // dd("sadfsadfasdfasdfasdf");
            // $query = 'SELECT u.name,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2;';
            // $query = 'SELECT u.name,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2 order by uh.created_by ASC;';
            // $query = 'SELECT u.name,u.email,u.phone,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave,um.state,um.district,um.block,um.city FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id inner join usermetas as um on u.id = um.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2 order by uh.created_by ASC;';
            // $query = 'SELECT u.name,u.email,u.phone,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave,um.state,um.district,um.block,um.city FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id inner join usermetas as um on u.id = um.user_id where uh.created_by >= "2025-08-16 00:00:01" and uh.modegroupid = 2 and u.id in (2207513,2207524,2207465,2207425,2198495,2207642,2207546,2207451,2207427,2200635,2207839,2207508,2207556,2207453,1989687,2207841,2207640,2207843,2207810,2207845,2207313,2207501,2207572,2207616,2207783,2207565,2207615,2207757,2207487,2203217,2207630,2207467,2207639,2207485,2207473,2207855,2207856,2207480,2207445,2207430,2207858,2207455,2207432,2207466,1998024,2207876,2207237,2207824,2207880,2169457,2207626,2129871,2203864,2205255,2207422,2207419,2207548,2207474,2207778,2207434,2206103) order by uh.created_by ASC;';
            $query = 'SELECT
                                u.id,
                                u.name,
                                u.email,
                                u.phone,
                                COUNT(uh.trip_name) AS total_trips,
                                SUM(uh.duration) AS duration,
                                SUM(uh.distance) AS distance,
                                MAX(uh.uom) AS uom,
                                MAX(uh.max_speed) AS max_speed,
                                AVG(uh.average_speed) AS average_speed,
                                MAX(uh.modegroupid) AS modegroupid,
                                MIN(uh.created_by) AS first_created_by,
                                SUM(uh.carbonSave) AS carbonSave,
                                MAX(um.state) AS state,
                                MAX(um.district) AS district,
                                MAX(um.block) AS block,
                                MAX(um.city) AS city
                            FROM users AS u
                            INNER JOIN userhistorytrakings AS uh
                                ON u.id = uh.user_id
                            INNER JOIN usermetas AS um
                                ON u.id = um.user_id
                            WHERE uh.created_by >= "2024-12-17 00:00:01"
                            AND uh.average_speed <= 100
                            AND uh.modegroupid = 2
                            GROUP BY
                                u.id,
                                u.name,
                                u.email,
                                u.phone
                            ORDER BY first_created_by ASC;';


            $data = DB::select(DB::raw($query));

            // dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "ID",
                "Name",
                "Email",
                "Phone",
                "Trip Name",// Name of school
                "Duration (Min)",
                "Distance",
                // "Max Speed",
                "Average Speed",
                // "Commemt",
                "Mode",
                "Date",
                "carbon Save",
                "State",
                "District",
                // "Block",
                "City"
            ]);

            foreach ($data as $each_user) {
                // dd($each_user);
                fputcsv($handle, [
                    $each_user->id,
                    $each_user->name,
                    $each_user->email,
                    $each_user->phone,
                    $each_user->total_trips,
                    round($each_user->duration/60,2),
                    round($each_user->distance,2).' '.$each_user->uom,
                    // // $each_user->max_speed,
                    $each_user->average_speed,
                    // $each_user->commemt,
                    "Cycle",
                    $each_user->first_created_by,
                    $each_user->carbonSave,
                    $each_user->state,
                    $each_user->district,
                    $each_user->city,

                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "Cycle data.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function hanolcyclothonrenningdatawise(){
        try{

            // dd("sadfsadfasdfasdfasdf");
            // $query = 'SELECT u.name,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2;';
            // $query = 'SELECT u.name,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2 order by uh.created_by ASC;';
            // $query = 'SELECT u.name,u.email,u.phone,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave,um.state,um.district,um.block,um.city FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id inner join usermetas as um on u.id = um.user_id where uh.created_by >= "2024-12-17 00:00:01" and uh.modegroupid = 2 order by uh.created_by ASC;';
            // $query = 'SELECT u.name,u.email,u.phone,uh.trip_name,uh.duration,uh.distance,uh.uom,uh.max_speed,uh.average_speed,uh.commemt,uh.modegroupid,uh.created_by,uh.carbonSave,um.state,um.district,um.block,um.city FROM users as u inner join userhistorytrakings as uh on u.id = uh.user_id inner join usermetas as um on u.id = um.user_id where uh.created_by >= "2025-08-16 00:00:01" and uh.modegroupid = 2 and u.id in (2207513,2207524,2207465,2207425,2198495,2207642,2207546,2207451,2207427,2200635,2207839,2207508,2207556,2207453,1989687,2207841,2207640,2207843,2207810,2207845,2207313,2207501,2207572,2207616,2207783,2207565,2207615,2207757,2207487,2203217,2207630,2207467,2207639,2207485,2207473,2207855,2207856,2207480,2207445,2207430,2207858,2207455,2207432,2207466,1998024,2207876,2207237,2207824,2207880,2169457,2207626,2129871,2203864,2205255,2207422,2207419,2207548,2207474,2207778,2207434,2206103) order by uh.created_by ASC;';
            $query = 'SELECT
                                u.id,
                                u.name,
                                u.email,
                                u.phone,
                                COUNT(uh.trip_name) AS total_trips,
                                SUM(uh.duration) AS duration,
                                SUM(uh.distance) AS distance,
                                MAX(uh.uom) AS uom,
                                MAX(uh.max_speed) AS max_speed,
                                AVG(uh.average_speed) AS average_speed,
                                MAX(uh.modegroupid) AS modegroupid,
                                MIN(uh.created_by) AS first_created_by,
                                SUM(uh.carbonSave) AS carbonSave,
                                MAX(um.state) AS state,
                                MAX(um.district) AS district,
                                MAX(um.block) AS block,
                                MAX(um.city) AS city
                            FROM users AS u
                            INNER JOIN userhistorytrakings AS uh
                                ON u.id = uh.user_id
                            INNER JOIN usermetas AS um
                                ON u.id = um.user_id
                            WHERE uh.created_by >= "2025-08-16 00:00:01"
                            AND uh.average_speed <= 100
                            AND uh.modegroupid = 2
                            AND u.id IN (2207744,2207463,2207441,2207432,2207604,2207474,2207828,2207657,2207731,2207732,2207610,2207578,2207633,2207801,2207785,2207678,2208881,2207545,2208999,2207589,2207876,2207442,2208859,2207592,2208930,2207562,2207835,2207632,2207839,2207640,2207434,2207508,2207724,2207774,2207538,2207650,2207485,2207587,2207525,2207570,2207468,2207494,2207480,2207498,2207444,2207827,2207436,2208781,2207487,2207596,2207524,2207472,2208983,2208959,2207450,2207621,2207455,2207575,2207493,2207639,2207460,2207651,2208783,2207543,2207585,2207489,2207559,2207462,2207696,2207858,2207743,2207422,2207549,2207440,2207461,2207845,2208886,2207783,2207513,2207591,2207641,2207807,2207464,2207676,2207459,2207616,2207484,2207705,2207673,2207773,2207555,2207780,2207576,2207565,2207560,2207486,2208756,2207577,2207656,2207490,2207499,2207644,2207626,2207514,2207573,2208969,2207786,2207467,2207778,2207841,2207511,2207529,2207627,2207495,2207833,2207501,2207775,2207759,2208749,2207782,2207439,2207855,2207552,2207793,2207528,2207646,2207553,2207536,2207734,2207547,2207526,2207711,2208966,2207945,2207769,2207636,2207515,2207557,2207426,2207756,2207629,2207446,2207502,2207917,2207542,2207558,2207607,2207789,2207634,2207597,2207537,2207594,2207469,2207454,2207582,2207520,2207503,2207572,2207445,2207746,2207581,2207612,2207473,2208082,2207619,2207601,2207694,2207546,2207448,2207717,2208937,2207749,2207451,2207843,2207481,2207630,2207483,2207735,2207590,2207738,2207598,2207504,2207579,2207764,2207466,2207615,2207539,2207443,2207475,2208992,2207712,2207831,2207544,2207437,2207523,2207456,2207482,2208007,2207492,2207760,2207556,2207507,2207602,2207470,2207649,2207518,2207642,2207608,2207563,2207465,2207772,2207548,2207757,2207516,2207568,2207791,2207505,2207781,2207500,2207637,2207609,2207787,2207603,2207668,2207534,2207675,2207428,2207625,2207810,2207533,2208975,2207635,2207661,2207517,2207595,2207850,2207477,2207613,2207638,2207509,2207643,2207701,2207674,2207521,2207531,2207471,2207453,2207623,2207532,2207478,2207777,2207512,2207784,2207856,2207771,2207593,2207571,2207496,2207583,2208890,2207584,2207551,2207683,2207491,2207458)
                            GROUP BY
                                u.id,
                                u.name,
                                u.email,
                                u.phone
                            ORDER BY first_created_by ASC;';


            $data = DB::select(DB::raw($query));

            // dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "ID",
                "Name",
                "Email",
                "Phone",
                "Trip Name",// Name of school
                "Duration (Min)",
                "Distance",
                // "Max Speed",
                "Average Speed",
                // "Commemt",
                "Mode",
                "Date",
                "carbon Save",
                "State",
                "District",
                // "Block",
                "City"
            ]);

            foreach ($data as $each_user) {
                // dd($each_user);
                fputcsv($handle, [
                    $each_user->id,
                    $each_user->name,
                    $each_user->email,
                    $each_user->phone,
                    $each_user->total_trips,
                    round($each_user->duration/60,2),
                    round($each_user->distance,2).' '.$each_user->uom,
                    // // $each_user->max_speed,
                    $each_user->average_speed,
                    // $each_user->commemt,
                    "Cycle",
                    $each_user->first_created_by,
                    $each_user->carbonSave,
                    $each_user->state,
                    $each_user->district,
                    $each_user->city,

                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "Cycle data.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    // public function certificationdownloadreport(){
    //     try{
    //         // dd("sadfsadfasdfasdfasdf");
    //         $query = 'SELECT name,user_type,event_name,event_participant_certification_name,created_at FROM `certification_trackings`;';

    //         $data = DB::select(DB::raw($query));

    //         // dd($data);
    //         $headers = array(
    //             'Content-Type' => 'text/csv'
    //         );


    //         $filename =  public_path("event.csv");
    //         $handle = fopen($filename, 'w');

    //         fputcsv($handle, [
    //             "Name",
    //             "User Type",// Name of school
    //             "Event Name",
    //             "Event Participant Certification Name",
    //             // "Max Speed",
    //             "Created at",
    //         ]);

    //         foreach ($data as $each_user) {

    //             fputcsv($handle, [
    //                 $each_user->name,
    //                 $each_user->user_type,
    //                 $each_user->event_name,
    //                 $each_user->event_participant_certification_name,
    //                 // $each_user->max_speed,
    //                 $each_user->created_at,
    //             ]);

    //         }
    //         fclose($handle);

    //         //download command
    //         return Response::download($filename, "Certification data.csv", $headers);

    //         // dd($school);
    //     }catch (Exception $e) {

    //         return abort(404);

    //     }
    // }
    public function certificationdownloadreport(){
        try{
            // dd("sadfsadfasdfasdfasdf");
            $query = 'SELECT users.rolelabel,certification_trackings.name,certification_trackings.user_type,certification_trackings.event_name,certification_trackings.event_participant_certification_name,certification_trackings.created_at FROM `certification_trackings` inner join users on users.id = certification_trackings.user_id;';

            $data = DB::select(DB::raw($query));

            // dd($data);
            $headers = array(
                'Content-Type' => 'text/csv'
            );


            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Name",
                "Role",
                "User Type",// Name of school
                "Event Name",
                "Event Participant Certification Name",
                // "Max Speed",
                "Created at",
            ]);

            foreach ($data as $each_user) {

                fputcsv($handle, [
                    $each_user->name,
                    $each_user->rolelabel,
                    $each_user->user_type,
                    $each_user->event_name,
                    $each_user->event_participant_certification_name,
                    // $each_user->max_speed,
                    $each_user->created_at,
                ]);

            }
            fclose($handle);

            //download command
            return Response::download($filename, "Certification data.csv", $headers);

            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }


    public function cyclothonRegistrationrolewise(){
        try{
            // dd("cyclothonRegistrationrolewise");
            // $total_count_cyclothon = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024';";
            $total_count_cyclothon = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%';";

            $data_total_count_cyclothon = DB::select(DB::raw($total_count_cyclothon));

            // dd(count($data_total_count_cyclothon));
            $data_total_count_cyclothon = count($data_total_count_cyclothon);


            // $total_count_cyclothon_individual = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024' and cyclothonrole = 'individual';";
            $total_count_cyclothon_individual = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%' and usermetas.cyclothonrole = 'individual';";

            $data_total_count_cyclothon_individual = DB::select(DB::raw($total_count_cyclothon_individual));

            // dd(count($data_total_count_cyclothon_individual));
            $data_total_count_cyclothon_individual = count($data_total_count_cyclothon_individual);

            // $total_count_cyclothon_individual_blank = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024' and cyclothonrole is null;";
            $total_count_cyclothon_individual_blank = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%' and usermetas.cyclothonrole is null;";

            $data_total_count_cyclothon_individual_blank = DB::select(DB::raw($total_count_cyclothon_individual_blank));

            // dd(count($data_total_count_cyclothon_individual));
            $data_total_count_cyclothon_individual_blank = count($data_total_count_cyclothon_individual_blank);

            $total_individual = $data_total_count_cyclothon_individual_blank + $data_total_count_cyclothon_individual;


            // $total_count_cyclothon_organization = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024' and cyclothonrole = 'organization';";
            $total_count_cyclothon_organization = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%' and usermetas.cyclothonrole = 'organization';";

            $total_count_cyclothon_organization = DB::select(DB::raw($total_count_cyclothon_organization));

            // dd(count($data_total_count_cyclothon_individual));
            $data_total_count_cyclothon_organization = count($total_count_cyclothon_organization);

            // $total_count_cyclothon_club = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024' and cyclothonrole = 'club';";
            $total_count_cyclothon_club = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%' and usermetas.cyclothonrole = 'club';";

            $total_count_cyclothon_club = DB::select(DB::raw($total_count_cyclothon_club));

            // dd(count($data_total_count_cyclothon_individual));
            $data_total_count_cyclothon_club = count($total_count_cyclothon_club);

            $total_namo_fit_india_cycling_club = "SELECT *  FROM `users` WHERE `role` LIKE 'namo-fit-india-cycling-club'";

            $total_count_namo_fit_india_cycling_club = DB::select(DB::raw($total_namo_fit_india_cycling_club));

            // dd(count($data_total_count_cyclothon_individual));
            $data_total_count_namo_fit_india_cycling_club = count($total_count_namo_fit_india_cycling_club);
            // dd($data_total_count_namo_fit_india_cycling_club);


            $clubcountNamoSOC = $data_total_count_namo_fit_india_cycling_club + $data_total_count_cyclothon_club;
            $total_count_cyclothon = $data_total_count_cyclothon + $data_total_count_namo_fit_india_cycling_club;
            // dd($total_count_cyclothon);
            // return view('cyclothon-registration-rolewise',compact('data_total_count_cyclothon','total_individual','data_total_count_cyclothon_organization','data_total_count_cyclothon_club','data_total_count_namo_fit_india_cycling_club'));
            return view('cyclothon-registration-rolewise',compact('total_count_cyclothon','total_individual','data_total_count_cyclothon_organization','clubcountNamoSOC','data_total_count_namo_fit_india_cycling_club','data_total_count_cyclothon_club'));


            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function coiregistrationdrivereport(){
        try{

            try{
                // dd("sadfsadfasdfasdfasdf");
                $query = 'SELECT * FROM `userevents`;';

                $data = DB::select(DB::raw($query));

                // dd($data);
                $headers = array(
                    'Content-Type' => 'text/csv'
                );


                $filename =  public_path("event.csv");
                $handle = fopen($filename, 'w');

                fputcsv($handle, [
                    "Role",// Name of school
                    "Name",
                    "Email",
                    "Phone",
                    "Pincode",
                    "State",
                    "District",
                    "Block",
                    "City",
                    "Created at",
                ]);

                foreach ($data as $each_user) {

                    fputcsv($handle, [
                        $each_user->role,
                        $each_user->name,
                        $each_user->email,
                        $each_user->phone,
                        $each_user->pincode,
                        $each_user->state,
                        $each_user->district,
                        $each_user->block,
                        $each_user->city,
                        // $each_user->max_speed,
                        $each_user->created_at,
                    ]);

                }
                fclose($handle);

                //download command
                return Response::download($filename, "Event Drive Report.csv", $headers);

                // dd($school);
            }catch (Exception $e) {

                return abort(404);

            }
            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function fitindiafreedomrun6report(){
        try{

            try{
                // dd("sadfsadfasdfasdfasdf");
                $query = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id WHERE rolewise = 'fit-india-freedom-run6';";

                $data = DB::select(DB::raw($query));

                // dd($data);
                $headers = array(
                    'Content-Type' => 'text/csv'
                );


                $filename =  public_path("event.csv");
                $handle = fopen($filename, 'w');

                fputcsv($handle, [
                    "Role",// Name of school
                    "Name",
                    "Email",
                    "Phone",
                    // "Pincode",
                    "State",
                    "District",
                    "Block",
                    "City",
                    "Created at",
                ]);

                foreach ($data as $each_user) {

                    fputcsv($handle, [
                        $each_user->role,
                        $each_user->name,
                        $each_user->email,
                        $each_user->phone,
                        // $each_user->pincode,
                        $each_user->state,
                        $each_user->district,
                        $each_user->block,
                        $each_user->city,
                        // $each_user->max_speed,
                        $each_user->created_at,
                    ]);

                }
                fclose($handle);

                //download command
                return Response::download($filename, "Event Drive Report.csv", $headers);

                // dd($school);
            }catch (Exception $e) {

                return abort(404);

            }
            // dd($school);
        }catch (Exception $e) {

            return abort(404);

        }
    }


    // fitindiaeventorgreport

    public function fitindiaeventorgreport(){

        try{
            // dd('get_excel_image');
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
            eo.excel_sheet,
            IFNULL(eo.participantnum, 0) as participantnum
            FROM event_organizations AS eo where category = 13084 order by id desc";

            // $query = "SELECT eo.user_id,eo.organiser_name,eo.name,eo.email,eo.contact,eo.eventstartdate,eo.eventenddate,eo.event_bg_image,eo.eventimg_meta,eo.excel_sheet,um.state FROM usermetas um left join event_organizations AS eo on um.user_id = eo.user_id where category = 13064 order by um.state;";
            // $query = "SELECT eo.user_id,eo.organiser_name,eo.name,eo.email,eo.contact,eo.eventstartdate,eo.eventenddate,eo.event_bg_image,eo.eventimg_meta,eo.excel_sheet,IFNULL(um.state, 'Not specified') as state,um.created_at FROM usermetas um left join event_organizations AS eo on um.user_id = eo.user_id where category = 13064 order by eo.name;";
            $data = DB::select(DB::raw($query));

            $headers = array(
                'Content-Type' => 'text/csv'
            );

            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Organiser Name",
                "Name",
                "Email",
                "Contact",
                "Event Start Date",
                "Event End Date",
                "Event BG Image",
                "Eventimg Meta",
                "Excel Sheet",
            ]);

            foreach ($data as $each_user) {
                // dd($each_user);
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
            return Response::download($filename, "All Report Till Date.csv", $headers);

        }catch (Exception $e) {

            return abort(404);
        }
    }

}
