<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UseremailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'useremail:cron';

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
    public function handle()
    {
        //Here you can write your business logic

        // $users = DB::table('users')->select('id','email')->limit(1)->get();
        $users = DB::table('users')
                ->select('id','email','name')
                ->where('email','=','ankit.katiyar@netprophetsglobal.com')
                ->get();
        // return $users;
        if(count($users) > 0 ){
            
            // \Log::info($users);
            foreach ($users as $users_data) {

                $email = $users_data->email;
                $name = $users_data->name;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://10.246.120.18/test/mail/useremailsend.php?email=$email&name=$name",						   
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));
                
                $response = curl_exec($curl);
                //dd($response);
                curl_close($curl);
                //$new_response = json_decode($response, true);
                if($response){
                    return true;
                }else{
                    return false;
                }
            
                
                \Log::info($email);
            }
            
        }else{
            \Log::info("No User Found");
            $this->info('Test:Cron Cummand Run successfully!');
        }
        // return 0;
    }
}
