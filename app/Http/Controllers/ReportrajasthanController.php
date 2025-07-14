<?php

namespace App\Http\Controllers;
use App\Models\SchoolWeek;
use App\Models\Eventorganizations;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request,Response;
use App\Models\DeletedUsers;
use App\Models\User;

class ReportrajasthanController extends Controller
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
                            eo.excel_sheet
                        FROM event_organizations AS eo 
                        inner JOIN usermetas as um on um.user_id = eo.user_id
                        where category = 13065
                        and um.state = 'jharkhand';";
            
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
                "Excel Sheet"
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
            // $query = 'select eo.user_id,u.id,eo.name,IFNULL(eo.participantnum, 0) as participantnum, u.rolelabel as role, cast(eo.created_at as date) as created_at from event_organizations as eo inner join users as u on eo.user_id = u.id where eo.created_at >= "2023-08-20 00:00:01" order by eo.id asc;';
            $query = 'select 
                            eo.user_id,
                            u.id,
                            eo.name,
                            participant_names,
                            IFNULL(eo.total_participant, 0) as total_participant, 
                            u.rolelabel as role, 
                            cast(eo.created_at as date) as created_at 
                            from event_organizations as eo 
                            inner join users as u on eo.user_id = u.id                             
                            where eo.category = "'.$event_id.'"
                            AND eo.created_at between "'.$from_date.'" AND "'.$to_date.'" 
                            order by eo.id asc';
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
            
            // $query = "SELECT count(1) as count FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-09-27 00:00:01' and um.state = 'rajasthan';";
            // $query = "SELECT count(1) as count FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-09-27 00:00:01' and um.state = 'bihar';";
            $query = "SELECT count(1) as count FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-09-27 00:00:01' and um.state = 'jharkhand';";
            
            $data = DB::select(DB::raw($query));
            
            $headers = array(
                'Content-Type' => 'text/csv'
            );

        
            $filename =  public_path("event.csv");
            $handle = fopen($filename, 'w');

            fputcsv($handle, [
                "Count",          
            ]);

            foreach ($data as $each_user) {
                // dd();
                fputcsv($handle, [
                    $each_user->count                    
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
            $query = "SELECT case when rolelabel is null then role else rolelabel end as countname ,count(1) as countnumber FROM users WHERE `created_at` between '2024-08-15 00:00:01' and '2024-08-31 23:59:59' group by case when rolelabel is null then role else rolelabel end;";
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
            // dd("event_date_wise_user_registration");
            
            // $query = "SELECT case when rolelabel is null then role else rolelabel end as rolename, cast(u.created_at as date) as date,count(1) as count_number FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-09-27 00:00:01' and um.state = 'rajasthan'group by case when rolelabel is null then role else rolelabel end,cast(created_at as date);";
            $query = "SELECT case when rolelabel is null then role else rolelabel end as rolename, cast(u.created_at as date) as date,count(1) as count_number FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at > '2024-09-27 00:00:01' and um.state = 'jharkhand'group by case when rolelabel is null then role else rolelabel end,cast(created_at as date);";
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

    public function event_state_wise_user_registration(){ 
        try{   
            // dd('event_state_wise_user_registration');         
            $query = "SELECT um.state,count(1) as count_number  FROM users as u inner JOIN usermetas as um on um.user_id = u.id where u.created_at between '2024-08-15 00:00:01' and '2024-08-31 23:59:59' and um.state is not null GROUP BY um.state order by um.state;";
            $data = DB::select(DB::raw($query));      
            dd($data);
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

    public function reportfitindiaevent(Request $request){
        dd(11111111111111111111111111111);
    }

}
