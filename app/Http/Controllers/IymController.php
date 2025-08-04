<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\quiz_associate;
use App\Models\Quiziymcontests;
use App\Models\quiz_master;
use App\Models\Fitnessquiz;
use App\Models\Quiztbl;
use App\Models\Quiz_iym_contest;
use Illuminate\Support\Facades\DB;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
DB::statement("SET SQL_MODE=''");
class IymController extends Controller
{
    private $OPENSSL_CIPHER_NAME = "aes-128-cbc";
    private $CIPHER_KEY_LEN = 16;
    function encrypt($key = '0a9b8c7d6e5f4g3h', $iv = 'fedcba9876543210', $data = 6)
    {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0");
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN);
        }

        $encodedEncryptedData = base64_encode(openssl_encrypt($data, $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));

        return $encodedEncryptedData;
    }

    function decrypt($key, $iv, $data)
    {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        $decryptedData = openssl_decrypt(base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }
    public function index(Request $request)
    {
        //   dd($_REQUEST['m']);
        if ($_REQUEST['m'] == 'true') {
            // dd(1);
            $encrypted = $id = $request->Fit_id;
            $mobile = $request->m;
            $userdata = User::findOrFail($id);
            return view('iym_dir.index', compact('userdata', 'encrypted'));
        } else {

            return abort(404);
        }
    }

    public function getQuestions(Request $request)
    {

        $userid = $request->Fit_id;

        if ($_REQUEST['m'] == 'true') {

            $slottime_start1    =  '00:00:00';
            $slottime_end1      =  '11:59:59';
            $slottime_start2    =  '12:00:00';
            $slottime_end2      =  '23:59:59';
            // $slot =  '';
            $curr_date = date('Y-m-d');
            date_default_timezone_set('Asia/Kolkata');
            $curr_time = date('H:i:s');
            if ($curr_time < $slottime_end1 && $curr_time > $slottime_start1) {

                $question_id = quiz_associate::whereDate('date', $curr_date)->where('status', '=', 1)->whereBetween('slot_in', [$slottime_start1, $slottime_end1])->pluck('question_id');
            } else if ($curr_time < $slottime_end2 && $curr_time > $slottime_start2) {

                $question_id = quiz_associate::whereDate('date', $curr_date)->where('status', '=', 1)->whereBetween('slot_in', [$slottime_start2, $slottime_end2])->pluck('question_id');
            } else {
                $question_id = 'no';
            }
            // dd(sizeof($question_id));
            if (sizeof($question_id) == 0) {
                Session::flash('message', 'Quiz - Coming Soon !');
                return redirect()->back();
            } else {
                $user_attempt = Quiz_iym_contest::where('question_id', $question_id[0])->where('user_id', $userid)->first();
            }


            if (isset($user_attempt)) {

                Session::flash('message', 'You have already participate in this slot!');
                return redirect()->back();
            }

            if ($question_id != 'no') {
                $userdata = '';
                $encrypted = '';
                // dd('12');    
                $question_id = $question_id[0];
                $encrypted = Quiztbl::where('id', (int)$question_id)->first();
                // dd($encrypted);
                $associate_details = quiz_associate::where('question_id', $question_id)->first();
                $slot_end = strtotime($associate_details->slot_over);
                return view('iym_dir.iym-quiz', compact('userdata', 'encrypted', 'associate_details', 'userid', 'slot_end'));
            } else {
                $question = "";
            }

            $userdata = '';
            $encrypted = '';
        } else {

            return abort(404);
        }
    }

    public function iym_quizSubmit(Request $request)
    {


        $user_data = User::where('id', $request['user_id'])->first();
        $username = $user_data->name;
        $user_attempt = Quiz_iym_contest::where('user_id', $request['user_id'])->get();

        $answer = Quiztbl::where('id', $request['question_id'])->first();

        $score = 0;
        $user_status = '';
        if ($request['user_ans'] == $answer->ans) {
            $score = 1;
            $user_status = 'Qualified';
        }
        if (count($user_attempt) == 0) {
            $quiz_answers = new Quiz_iym_contest();
            $quiz_answers->master_id = $request['master_id'];
            $quiz_answers->question_id = $request['question_id'];
            $quiz_answers->user_id = $request['user_id'];
            $quiz_answers->user_name = $username;
            $quiz_answers->date = $request['date'];
            $quiz_answers->slot_in = $request['slot_in'];
            $quiz_answers->slot_over = $request['slot_over'];
            $quiz_answers->user_ans = $request['user_ans'];
            $quiz_answers->associate_id = $request['associate_id'];
            $quiz_answers->score = $score;
            $quiz_answers->sec = $request['sec']; //value in milisecond
            $quiz_answers->status = 1;
            $quiz_answers->save();

            if ($quiz_answers) {

                return view('iym_dir.iym-thankyou', compact('user_data'));
            }
        } else {

            return abort(404);
        }
    }

    public function iym_thankYou()
    {

        return view('iym_dir.iym-thankyou');
    }

    public function downloadImyWinner($date)
    {
        if(date('Y-m-d') <= $date){
            return response()->json('Sorry Winner Not Decide For this Date');
        }
        // dd($date);
        // $user =  User::all();
        // $from_date = date('Y-m-d');
        // dd($from_date);
        // // $previousDay = date('Y-m-d H:i:s', strtotime('now - 1day'));
        // // $previousDay = date('Y-m-d', strtotime('now - 1day'));
        // $previousDay = date('Y-m-d', strtotime('now'));
        // // date('H:i:s');
        // // dd($previousDay);
        // $to_date = date('Y-m-d') . ' 23:59:59';
        $quizs_ans = new Quiziymcontests();
        

        // $quizs_ans = $quizs_ans->where('score','=','1')->where('date','=',$previousDay)->orderBy('sec', 'asc')->get();


        $sqlQuery = 'select users.name ,users.email,users.phone,users.phone,quiz_iym_contests.date,
        quiz_iym_contests.slot_in,quiz_iym_contests.slot_over,quiz_iym_contests.created_at,
        usermetas.dob,usermetas.gender,usermetas.state,usermetas.district,usermetas.city,quiz_iym_contests.user_id,sum(score) as "total_score",sum(sec) as "total_sec" 
       from quiz_iym_contests 
       INNER JOIN users on users.id = quiz_iym_contests.user_id
       INNER JOIN usermetas on usermetas.user_id = quiz_iym_contests.user_id 
       WHERE quiz_iym_contests.date = "' . $date . '" and quiz_iym_contests.score > 0 GROUP BY quiz_iym_contests.date,quiz_iym_contests.user_id
        ORDER BY total_score DESC,total_sec ASC,quiz_iym_contests.created_at ASC;';
        $quizs_ans = DB::select(DB::raw($sqlQuery));
        $headers = array(
            'Content-Type' => 'text/csv'
        );

        $filename =  public_path("quiz_answers.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "User Name",
            "Email",
            "Phone",
            "State",
            "District",
            "City",
            // "Gender",
            // "DOB",
            "Slot",
            "Score",
            "Ans in MiliSecond",
            "Result",
            "Created at",

        ]);
        $score_status  = '';
        $status = 'Qualified';
        foreach ($quizs_ans as $quiz_ans) {
            if($quiz_ans->name != '' && $quiz_ans->name != null){   
            fputcsv($handle, [
                $quiz_ans->name,
                $quiz_ans->email,
                $quiz_ans->phone,
                $quiz_ans->state,
                $quiz_ans->district,
                $quiz_ans->city,
                // $quiz_ans->gender,
                // $quiz_ans->dob,
                $quiz_ans->slot_in . ' to ' . $quiz_ans->slot_over,
                $quiz_ans->total_score,
                $quiz_ans->total_sec,
                $status,
                $quiz_ans->created_at,

            ]);
}
        }
        fclose($handle);

        return Response::download($filename, "lym_winner.csv", $headers);
    }


public function getTotalParticipant($date = 0){
if($date != 0){
$sqlQuery = 'select count(*) as total from quiz_iym_contests WHERE quiz_iym_contests.date = "' . $date . '";';
 $total = DB::select(DB::raw($sqlQuery));
  return response()->json(['total participant'=> $total[0]]);

}else{

$sqlQuery = 'select count(*) as total from quiz_iym_contests;';
 $total = DB::select(DB::raw($sqlQuery));
  return response()->json(['total participant'=> $total[0]]);

}


}

    public function downloadIytimeswisemWinner($date,Request $request){
        $segments = $request->segments();
        $time =  $segments[1];
        if(date('Y-m-d') <= $date){
            return response()->json('Sorry Winner Not Decide For this Date');
        }
        // dd($date);
        // $user =  User::all();
        // $from_date = date('Y-m-d');
        // dd($from_date);
        // // $previousDay = date('Y-m-d H:i:s', strtotime('now - 1day'));
        // // $previousDay = date('Y-m-d', strtotime('now - 1day'));
        // $previousDay = date('Y-m-d', strtotime('now'));
        // // date('H:i:s');
        // // dd($previousDay);
        // $to_date = date('Y-m-d') . ' 23:59:59';
        $quizs_ans = new Quiziymcontests();
        

        // $quizs_ans = $quizs_ans->where('score','=','1')->where('date','=',$previousDay)->orderBy('sec', 'asc')->get();


        $sqlQuery = 'select users.name ,users.email,users.phone,users.phone,quiz_iym_contests.date,
        quiz_iym_contests.slot_in,quiz_iym_contests.slot_over,quiz_iym_contests.created_at,
        usermetas.dob,usermetas.gender,usermetas.state,usermetas.district,usermetas.city,quiz_iym_contests.user_id,sum(score) as "total_score",sum(sec) as "total_sec" 
       from quiz_iym_contests 
       INNER JOIN users on users.id = quiz_iym_contests.user_id
       INNER JOIN usermetas on usermetas.user_id = quiz_iym_contests.user_id 
       WHERE quiz_iym_contests.date = "' . $date . '" and quiz_iym_contests.score > 0 and quiz_iym_contests.slot_in = "' . $time . '"  GROUP BY quiz_iym_contests.date,quiz_iym_contests.user_id
        ORDER BY total_score DESC,total_sec ASC,quiz_iym_contests.created_at ASC;';
        $quizs_ans = DB::select(DB::raw($sqlQuery));
        $headers = array(
            'Content-Type' => 'text/csv'
        );

        $filename =  public_path("quiz_answers.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "User Name",
            "Email",
            "Phone",
            "State",
            "District",
            "City",
            // "Gender",
            // "DOB",
            "Slot",
            "Score",
            "Ans in MiliSecond",
            "Result",
            "Created at",

        ]);
        $score_status  = '';
        $status = 'Qualified';
            
            foreach ($quizs_ans as $quiz_ans) {

                    if($quiz_ans->name != '' && $quiz_ans->name != null){   

                    fputcsv($handle, [
                        $quiz_ans->name,
                        $quiz_ans->email,
                        $quiz_ans->phone,
                        $quiz_ans->state,
                        $quiz_ans->district,
                        $quiz_ans->city,
                        // $quiz_ans->gender,
                        // $quiz_ans->dob,
                        $quiz_ans->slot_in . ' to ' . $quiz_ans->slot_over,
                        $quiz_ans->total_score,
                        $quiz_ans->total_sec,
                        $status,
                        $quiz_ans->created_at,

                    ]);
                }
            }
        fclose($handle);

        return Response::download($filename, "lym_time_winner.csv", $headers);
    

    }
    
    public function downloadIytimeswisetwomWinner($date,Request $request){
        // dd('asdfasdfasdf');
        $segments = $request->segments();
        $time =  $segments[1];

        if(date('Y-m-d') <= $date){
            return response()->json('Sorry Winner Not Decide For this Date');
        }
        // dd($date);
        // $user =  User::all();
        // $from_date = date('Y-m-d');
        // dd($from_date);
        // // $previousDay = date('Y-m-d H:i:s', strtotime('now - 1day'));
        // // $previousDay = date('Y-m-d', strtotime('now - 1day'));
        // $previousDay = date('Y-m-d', strtotime('now'));
        // // date('H:i:s');
        // // dd($previousDay);
        // $to_date = date('Y-m-d') . ' 23:59:59';
        $quizs_ans = new Quiziymcontests();
        

        // $quizs_ans = $quizs_ans->where('score','=','1')->where('date','=',$previousDay)->orderBy('sec', 'asc')->get();


        $sqlQuery = 'select users.name ,users.email,users.phone,users.phone,quiz_iym_contests.date,
        quiz_iym_contests.slot_in,quiz_iym_contests.slot_over,quiz_iym_contests.created_at,
        usermetas.dob,usermetas.gender,usermetas.state,usermetas.district,usermetas.city,quiz_iym_contests.user_id,sum(score) as "total_score",sum(sec) as "total_sec" 
       from quiz_iym_contests 
       INNER JOIN users on users.id = quiz_iym_contests.user_id
       INNER JOIN usermetas on usermetas.user_id = quiz_iym_contests.user_id 
       WHERE quiz_iym_contests.date = "' . $date . '" and quiz_iym_contests.score > 0 and quiz_iym_contests.slot_in = "' . $time . '"  GROUP BY quiz_iym_contests.date,quiz_iym_contests.user_id
        ORDER BY total_score DESC,total_sec ASC,quiz_iym_contests.created_at ASC;';
        $quizs_ans = DB::select(DB::raw($sqlQuery));
        $headers = array(
            'Content-Type' => 'text/csv'
        );

        $filename =  public_path("quiz_answers.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "User Name",
            "Email",
            "Phone",
            "State",
            "District",
            "City",
            // "Gender",
            // "DOB",
            "Slot",
            "Score",
            "Ans in MiliSecond",
            "Result",
            "Created at",

        ]);
        $score_status  = '';
        $status = 'Qualified';
            
            foreach ($quizs_ans as $quiz_ans) {

                    if($quiz_ans->name != '' && $quiz_ans->name != null){   

                    fputcsv($handle, [
                        $quiz_ans->name,
                        $quiz_ans->email,
                        $quiz_ans->phone,
                        $quiz_ans->state,
                        $quiz_ans->district,
                        $quiz_ans->city,
                        // $quiz_ans->gender,
                        // $quiz_ans->dob,
                        $quiz_ans->slot_in . ' to ' . $quiz_ans->slot_over,
                        $quiz_ans->total_score,
                        $quiz_ans->total_sec,
                        $status,
                        $quiz_ans->created_at,

                    ]);
                }
            }
        fclose($handle);

        return Response::download($filename, "lym_time_winner_2.csv", $headers);
    

    }
    
    
    public function downloadtotalWinner(){
        // dd('asdfasdfasdf');
        // $segments = $request->segments();
        // $time =  $segments[1];
        // if(date('Y-m-d') <= $date){
        //     return response()->json('Sorry Winner Not Decide For this Date');
        // }
        // dd($date);
        // $user =  User::all();
        // $from_date = date('Y-m-d');
        // dd($from_date);
        // // $previousDay = date('Y-m-d H:i:s', strtotime('now - 1day'));
        // // $previousDay = date('Y-m-d', strtotime('now - 1day'));
        // $previousDay = date('Y-m-d', strtotime('now'));
        // // date('H:i:s');
        // // dd($previousDay);
        // $to_date = date('Y-m-d') . ' 23:59:59';
        $quizs_ans = new Quiziymcontests();
        

        // $quizs_ans = $quizs_ans->where('score','=','1')->where('date','=',$previousDay)->orderBy('sec', 'asc')->get();


        $sqlQuery = 'select users.name ,users.email,users.phone,users.phone,quiz_iym_contests.date,
        quiz_iym_contests.slot_in,quiz_iym_contests.slot_over,quiz_iym_contests.created_at,
        usermetas.dob,usermetas.gender,usermetas.state,usermetas.district,usermetas.city,quiz_iym_contests.user_id,sum(score) as "total_score",sum(sec) as "total_sec" 
       from quiz_iym_contests 
       INNER JOIN users on users.id = quiz_iym_contests.user_id
       INNER JOIN usermetas on usermetas.user_id = quiz_iym_contests.user_id 
       GROUP BY quiz_iym_contests.date,quiz_iym_contests.user_id
        ORDER BY total_score DESC,total_sec ASC,quiz_iym_contests.created_at ASC;';
        $quizs_ans = DB::select(DB::raw($sqlQuery));
        $headers = array(
            'Content-Type' => 'text/csv'
        );

        $filename =  public_path("quiz_answers.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "User Name",
            "Email",
            "Phone",
            "State",
            "District",
            "City",
            // "Gender",
            // "DOB",
            "Slot",
            "Score",
            "Ans in MiliSecond",
            "Result",
            "Created at",

        ]);
        $score_status  = '';
        $status = 'Qualified';
            
            foreach ($quizs_ans as $quiz_ans) {

                    if($quiz_ans->name != '' && $quiz_ans->name != null){   

                    fputcsv($handle, [
                        $quiz_ans->name,
                        $quiz_ans->email,
                        $quiz_ans->phone,
                        $quiz_ans->state,
                        $quiz_ans->district,
                        $quiz_ans->city,
                        // $quiz_ans->gender,
                        // $quiz_ans->dob,
                        $quiz_ans->slot_in . ' to ' . $quiz_ans->slot_over,
                        $quiz_ans->total_score,
                        $quiz_ans->total_sec,
                        $status,
                        $quiz_ans->created_at,

                    ]);
                }
            }
        fclose($handle);

        return Response::download($filename, "total_participant.csv", $headers);
    

    }
}

