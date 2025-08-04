<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;
use App\Models\DeletedUsers;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Exception;
use Artisan;
use FontLib\TrueType\Collection;
use Illuminate\Http\Request;
use Session;


class DeleteuserremoveCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteuserremove:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){  

        try{
            // server mssql conection
            $DB_SQL_CONNECTION = 'sqlsrv';
            // private $DB_SQL_HOST = '10.72.163.124';
            $DB_SQL_HOST = '192.168.23.254';
            $DB_SQL_PORT = '1433';
            $DB_DATABASE_SQL_NAME = 'FitIndia_Fitness';
            $DB_SQL_PASSWORD = 'Sai@123';
            $DB_SQL_USERNAME = 'sa';
            $mssqluser_hostname = $DB_SQL_HOST;
            // dd($mssqluser_hostname);
            $mssqluser_databases = $DB_DATABASE_SQL_NAME;
            $mssqluser_password = $DB_SQL_PASSWORD;
            $mssqluser_name= $DB_SQL_USERNAME;
            $userid = 1212;
            // \Log::info('Deleted Successfully failed_jobs :- '.$DB_SQL_HOST);    
            // \Log::info('Deleted Successfully failed_jobs :- '.$DB_SQL_PORT);    
            // \Log::info('Deleted Successfully failed_jobs :- '.$DB_DATABASE_SQL_NAME);    
            // \Log::info('Deleted Successfully failed_jobs :- '.$DB_SQL_PASSWORD);    
            // \Log::info('Deleted Successfully failed_jobs :- '.$DB_SQL_USERNAME);
            
            $decryptedData = "kBKqQlMTk4NjEzMQ==5DnGO2";
            $Output = 0;
            
            $users = DB::table('deletedusers')->select('id','user_id','email','phone','request_date')
                ->where([        
                        ['status', '=', '1']
                        ])
                ->whereDate('request_date', '<=', date('Y-m-d'))->get();   
                
            $conn = new PDO("sqlsrv:Server=$mssqluser_hostname;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");
            $current_date = date("Y-m-d");
            
            
            if(count($users) > 0 ){

                foreach ($users as $users_data) {

                    $request_date = $users_data->request_date;
                    $user_id = $users_data->user_id;

                    if($current_date >= $request_date){
                        
                        // \Log::info('sql user id:- '.$user_id); 

                        $mssql_table_name = array(
                            // "UserAuthentication",
                            "TestResult"
                        );

                        foreach ($mssql_table_name as $sql_table_name) {  
                            // \Log::info('sql user id:- '.$sql_table_name);
                            // exit;
                            $stmt3 = $conn->prepare("SELECT um1.F365Id,UserName,KheloIndiaId
                                                    FROM UserMaster um1
                                                    where um1.KheloIndiaId = $user_id and KheloIndiaId is not NULL"
                                                    );
                            $stmt3->execute(); 
                            $data3 = $stmt3->fetchAll(PDO::FETCH_OBJ);
                            
                            if(count($data3) > 0) {
                                
                                foreach ($data3 as $data3_value){
                                    
                                    $F365Idst = $data3_value->F365Id; 
                                    // \Log::info('sql user id:- '.$F365Idst);
                                    // exit;
                                    $stmt4 = $conn->prepare("SELECT F365Id FROM $sql_table_name where F365Id = $F365Idst;");
                                    $stmt4->execute(); 
                                    $data4 = $stmt4->fetchAll(PDO::FETCH_OBJ);

                                    if(count($data4) > 0) {
                                        // \Log::info('sql user id:- '.$F365Idst);
                                        foreach ($data4 as $data4_value){
                                    
                                            $F365Id4 = $data4_value->F365Id;    
                                            // \Log::info('sql user id 999999:- '.$F365Id4);                             
                                            $delete_stmtall = $conn->prepare("DELETE FROM $sql_table_name WHERE F365Id = $F365Id4;");
                                            $delete_stmtall->execute();                                 
                                        }
                                    }                             
                                } 
                                // Deleted from UserAuthentication
                                foreach ($data3 as $data3_value){
                                    
                                    $KheloIndiaId = $data3_value->KheloIndiaId; 
                                    // \Log::info('sql user id:- '.$KheloIndiaId);
                                    // exit; 
                                    
                                    $stmt5 = $conn->prepare("SELECT KheloIndiaId FROM UserAuthentication where KheloIndiaId = $KheloIndiaId;");
                                    $stmt5->execute(); 
                                    $data5 = $stmt5->fetchAll(PDO::FETCH_OBJ);

                                    if(count($data5) > 0) {
                                        // \Log::info('sql user id:- '.$F365Idst);
                                        foreach ($data5 as $data5_value){
                                    
                                            $KheloIndiaId = $data5_value->KheloIndiaId;  
                                            // \Log::info('sql user id:- '.$KheloIndiaId);  
                                            // \Log::info('sql user id 999999:- '.$F365Id4);                             
                                            $delete_stmtall = $conn->prepare("DELETE FROM UserAuthentication WHERE KheloIndiaId = $KheloIndiaId;");
                                            $delete_stmtall->execute();                                 
                                        }
                                    }                             
                                } 
                            }
                            // \Log::info('sql user id:- '.$sql_table_name);
                            // exit;
                            $stmt1 = $conn->prepare("SELECT um2.F365Id,um1.KheloIndiaId,um2.ParentId
                                                        FROM UserMaster um1
                                                        inner join UserMaster um2
                                                        on um1.F365Id = um2.ParentId
                                                        where um1.KheloIndiaId = $user_id
                                                        and um2.ParentId > 0"
                                                    );
                            $stmt1->execute(); 
                            $data1 = $stmt1->fetchAll(PDO::FETCH_OBJ);

                            if(count($data1) > 0) {
                                // \Log::info('M table:- ');   
                                foreach ($data1 as $data1_value){
                                    
                                    $F365Id = $data1_value->F365Id;                                 
                                    $delete_stmt = $conn->prepare("DELETE FROM UserMaster WHERE F365Id = $F365Id;");
                                    $delete_stmt->execute();                                 
                                }                                 
                            }
                            
                            $stmt2 = $conn->prepare("SELECT um1.F365Id,um1.KheloIndiaId,um1.ParentId
                                                        FROM UserMaster um1
                                                        where um1.KheloIndiaId = $user_id
                                                        and um1.ParentId = 0"
                                                    );
                            $stmt2->execute(); 
                            $data2 = $stmt2->fetchAll(PDO::FETCH_OBJ);

                            if(count($data2) > 0) {
                                // \Log::info('One entery');
                                
                                foreach ($data2 as $data2_value){
                                    
                                    $F365Ids = $data2_value->F365Id;                                 
                                    $delete_stmt = $conn->prepare("DELETE FROM UserMaster WHERE F365Id = $F365Ids;");
                                    $delete_stmt->execute();                                 
                                }                                 
                            }
                        }                        
                    }
                }
            }
             

            $users = DB::table('deletedusers')->select('id','user_id','email','phone','request_date')
            ->where([        
                ['status', '=', '1']
                ])->whereDate('request_date', '<=', date('Y-m-d'))->get();   

                
                
            $current_date = date("Y-m-d");
            // \Log::info('Successfully failed_jobs :- '.$users[0]->id); 
              
            // exit; 
            if(count($users) > 0 ){

                foreach ($users as $users_data) {

                    $request_date = $users_data->request_date;                
                    $id = $users_data->id;                
                        
                    // \Log::info('Deleted Successfully failed_jobs :- '.$);    
                    // exit;   
                    if($current_date >= $request_date){
                        
                        // deleted event_organizations 
                        $user_id = $users_data->user_id;
                        // $user_id = 1;
                        
                        $mysql_table_name = array(
                                                    "event_organizations", 
                                                    "ambassadors", 
                                                    "app_user_rating_ratings", 
                                                    "challenge", 
                                                    "challengers_steps",
                                                    "champions",
                                                    "corporates",
                                                    "debug_users",
                                                    "device_counterlog",
                                                    "device_exceptionlog",
                                                    "events",
                                                    "external_event_activity",
                                                    "external_event_registration",
                                                    "failed_jobs",
                                                    "fitness_enthusias",
                                                    "fitness_score",
                                                    "freedomruns",
                                                    "gram_panchayat_ambassador",
                                                    "local_body_ambassador",
                                                    "posts_comments",
                                                    "posts_likes",
                                                    "preraks",
                                                    "prerak_first_levels",
                                                    "quizupload",
                                                    "reward",
                                                    "schoolmetas",
                                                    "schoolquizs",
                                                    "school_weeks",
                                                    "sessions",
                                                    "sleep",
                                                    "steps",
                                                    "trackingpics",
                                                    "userdetailsactivitiestrakings",
                                                    "userhistorytrakings",
                                                    "userinfo",
                                                    "userkeys",
                                                    "user_goals",
                                                    "waters",
                                                    "wp_ambassador",
                                                    "wp_champion",
                                                    "wp_champion_old2",
                                                    "wp_champion_old3",
                                                    "wp_comments",
                                                    "wp_events",
                                                    "wp_freedomrun",
                                                    "wp_freedomruntest",
                                                    "wp_pmkvy_freedomrun",
                                                    "wp_pmkvy_userextra",
                                                    "wp_star_rating",
                                                    "wp_star_rating_status",
                                                    "wp_usermeta",
                                                    "wp_youth_club_details",
                                                    "wp_youth_club_status",                                                
                                                    "users",                                                
                                                    "usermetas",                                                
                                                );

                        foreach ($mysql_table_name as $table_name) {

                            if($table_name == 'challenge'){

                                $own_user_id = 'from_userid';
                                
                            }else if($table_name == 'failed_jobs'){
                                
                                $own_user_id = 'uuid';
                            
                            }else if($table_name == 'users'){
                                
                                $own_user_id = 'id';
                                
                            }else if($table_name == 'wp_ambassador' || $table_name == 'wp_champion' || $table_name == 'wp_champion_old2' || $table_name == 'wp_champion_old3' || $table_name == 'wp_events' || $table_name == 'wp_freedomrun' || $table_name == 'wp_freedomruntest' || $table_name == 'wp_pmkvy_freedomrun' || $table_name == 'wp_pmkvy_userextra'){
                                
                                $own_user_id = 'userid';

                            }else{

                                $own_user_id = 'user_id'; 

                            }

                            $data = DB::table($table_name)->select($own_user_id)->where([[$own_user_id, '=', $user_id]])->get();


                            $data_count = count($data);

                            if($data_count > 0){

                                DB::table("$table_name")->where($own_user_id, '=', $user_id)->delete();
                                \Log::info("Deleted Successfully $table_name : ". $data_count); 

                            }
                        }

                        
                        $users = DB::table('users')->select('id','email','phone')->where([['id', '=', $user_id]])->limit(1)->get();                    
                        // only mobile related row deleted
                        if (isset($users[0]->phone)) {
                            
                            $data_failed_login = DB::table('failed_login_attempts')->select('id','mobile')->where([['mobile', '=', $users[0]->phone]])->get();
                            
                            if(count($data_failed_login) > 0 ){

                                DB::table("failed_login_attempts")->where('mobile', '=', $users[0]->phone)->delete();
                                \Log::info("Deleted Successfully failed_login_attempts mobile count: ". count($data_failed_login));
                                
                            }

                        }
                        // only email related row deleted
                        if (isset($users[0]->email)){

                            $data_failed_login = DB::table('failed_login_attempts')->select('id','email')->where([['email', '=', $users[0]->email]])->get();

                            if(count($data_failed_login) >0){

                                DB::table("failed_login_attempts")->where('email', '=', $users[0]->email)->delete();
                                \Log::info("Deleted Successfully failed_login_attempts email count: ". count($data_failed_login));
                                
                            }

                        }                    

                        
                    }

                    DeletedUsers::where('id', $id)->update(['status' => 0]);
                    // \Log::info('Deleted Successfully failed_jobs :- '.$request_date); 
                    
                    // exit;  
                    
                }
                // DeletedUsers::where('id', $users[0]->id)->update(['status' => 0]);
                // User::where('email', $userEmail)->update(['member_type' => $plan]);

            }else{

                \Log::info("Data Not Found :- ".$current_date);
            }

        }catch (\Exception $e) {

            // dd(123456);            
            \Log::info($e->getMessage());

        }
    }


    
}