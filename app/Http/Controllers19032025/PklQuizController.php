<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Quizreport;
use App\Models\Quiztbl;
use App\Models\PklQuiz;
use App\Imports\ImportQuiz;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use PDF;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class PklQuizController extends Controller
{ 
    public function landingPage(){
       
        //$data = PklQuiz::whereIn('state_id',['90','92','95','101','105','119','120'])->get();
        // dd($data);
        return view('new_quiz_school_week_2022.landing_quiz');
     }
 
  
 
     public function dashboard(Request $request){
        return view('new_quiz_school_week_2022.quiz_dashboard');
     }




     public function schoolIndex(Request $request){
        //  // echo "<center><h2>Thank you India for your overwhelming response on the road to Tokyo 2020 Quiz! The quiz is closed now. Let's enjoy the Olympic games and #Cheer4India.<h2></center>";
        //  // die;
        //  //dd('done');
        //  $iv = "fedcba9876543210"; 
        //  $key = "0a9b8c7d6e5f4g3h"; 
        //  $currentURL = url()->current();
        //  $urlarr = explode('road-to-school-week-quiz/', $currentURL);
        //  $id = $urlarr[1];
        //  $encrypted = $id;
         
        //  $id = $this->decrypt($key, $iv, $id);
        //  $states = State::orderBy('name' , 'ASC')->get();
        //  $userdata = User::with(['usermeta','schoolMeta'])->findOrFail($id);
        //  $quizques = Quiztbl::all()->random(5);
        //  //dd($userdata);
      
        $states = State::orderBy('name' , 'ASC')->get();
       
        return view('new_quiz_school_week_2022.fi-quiz',['states' => $states]);
     }
 
 
     // public function dashboard(){
     // 	//dd(Auth::guard('quiz')->user());
     // 	return view('quiz_school_week_2022.quiz_dashboard',['school' => Auth::guard('quiz')->user()]);
     // }
     public function getschoolquizques( Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
              
               
            'name' => 'required|regex:/^[a-zA-Z ]*$/|min:3|max:255',
            'dob' => 'required',
            'parent_name' => 'required|regex:/^[a-zA-Z ]*$/|min:3|max:255',
            'mobile' => 'required|digits:10',
            'school_name'=> ['required','min:3','regex:/(?:\d+[a-zA-Z]|[a-zA-Z]+\d?)[a-zA-Z\d]*/','max:1000'],
            'state'=> 'required',
            'district'=> 'required',
            'city'=> ['required','min:3','regex:/(?:\d+[a-zA-Z]|[a-zA-Z]+\d?)[a-zA-Z\d]*/','max:150'],
            'pincode'=> 'required|max:6|min:6',
            'class_name' => 'required|max:155',
            'section' => 'required|max:155',
           
           ],[
            'name.required'=>'Student Name Is Required.',
            'name.regex'=>'Please Enter a Valid Student Name.',
            'name.min'=>'Student Name has minimum 3 charecters.',
            'name.max'=>'Student Name Cannot be Greater than 255 Charecters.',
            'dob.required'=>'Student DOB is Required.',
            'parent_name.required'=>'Parents Name Is Required.',
            'parent_name.min'=>'Parent Name has minimum 3 charecters.',
            'parent_name.regex'=>'Please Enter a Valid Parent Name.',
            'parent_name.max'=>'Parents Name Cannot be Greater than 255 Charecters.',
            'mobile.required'=>'Mobile Number is Required.',
            'mobile.digits'=>'Mobile Number cannot be Greater than 10 Digits.',
            'school_name.required'=>'School Name Is Required.',
            'school_name.min'=>'School Name has minimum 3 charecters.',
            'school_name.regex'=>'Please Enter a Valid School Name.',
            'school_name.max'=>'School Name Cannot be Greater than 1000 Charecters.',
            'state.required'=>'State Is Required.',
            'district.required'=>'District Is Required.',
            'city.required'=>'City Is Required.',
            'city.min'=>'City Name has minimum 3 charecters.',
            'city.regex'=>'Please Enter a Valid City Name.',
            'city.max'=>'City Name Cannot be Greater than 255 Charecters.',
            'pincode.required'=>'Pincode Is Required.',
            'pincode.max'=>'Pincode Cannot be Greater than 6 Charecters.',
            'pincode.min'=>'Pincode Cannot be Less than 6 Charecters.',
            'class_name.required'=>'Class Name Is Required.',
            'class_name.max'=>'Class Name Cannot be Greater than 155 Charecters.',
            'section.required'=>'Student Section Name Is Required.',
            'section.max'=>'Student Section Name Cannot be Greater than 155 Charecters.',
            
            
           ]);
       
        if ($validator->fails()) {
            return response()->json(['status' => 'error','message'=>$validator->errors()->first()]);
        }





         $chkreq = PklQuiz::where('mobile', $request->mobile)->first(); 
         
         if(!isset($chkreq)){
            $quizques = Quiztbl::where('quiz_type','pkl_quiz')->get()->random(5);
            return $quizques;
       }else{
         return response()->json(['status' => 'error','message' =>"You have already taken quiz with this mobile number." ]); //redirect()->back()->with('error', 'You have been applied for the quiz');
     }		
     }
 
 
     public function schoolStore(Request $request){
         
            
       // dd($request->all());
         
         $validatedData = $request->validate([
             'state'=> 'required',
             'district'=> 'required',
            ],[
             
             'state.required'=>'State Is Required.',
             'district.required'=>'District Is Required.',
              ]);
         
         
        
         
         $quesids = array(); 
         
         if(!empty($request->quesoption)){
             $quesids = array_keys($request->quesoption);
         }
         
         $quesfilled = $request->quesoption;
 
         $results = Quiztbl::whereIn('id', $quesids)->get();
             
         $score = 0;
         foreach($results as $result){
             if($quesfilled[$result->id] == $result->ans){ 
                 $score += 1;
             }
         }
          
        
         date_default_timezone_set("Asia/Kolkata");
         $curdate = date('Y-m-d H:i:s');
         
         $curdateonly = date('Y-m-d');
         
         $chkreq = PklQuiz::where('mobile', $request->mobile)->first(); //->where('createdOnDate', $curdateonly)
         //dd($chkreq);
         $name = $request->name;
         if(!$chkreq){	
             $pkl_quiz = new PklQuiz(); 
             
             $pkl_quiz->name = $request->name;
             $pkl_quiz->dob = date('Y-m-d',strtotime($request->dob));
             $pkl_quiz->parent_name = $request->parent_name;
             $pkl_quiz->mobile = $request->mobile;
             $pkl_quiz->school_name = $request->school_name;
             $pkl_quiz->state_id = $request->state;
             $pkl_quiz->district_id = $request->district;
             $pkl_quiz->city = $request->city;
             $pkl_quiz->pincode = $request->pincode;
             $pkl_quiz->class = $request->class_name;
             $pkl_quiz->section = $request->section;
             $pkl_quiz->lang = 'en';
             $pkl_quiz->sec = $request->sec;
             $pkl_quiz->quesoption = serialize($request->quesoption);
             $pkl_quiz->score = $score;

             $res = $pkl_quiz->save();
             //dd('done');
             return view( 'new_quiz_school_week_2022.quiz-result',compact('results', 'quesfilled', 'name') );
             
         }else{
             return redirect()->back()->with('error', "You have already taken quiz with this mobile number.");
             
         }
             
             
         
     }
 
     public function schoolQuizCert($name){    
         //return $name;
         //$pdf = PDF::loadView('tokyoquizcertificate',compact('name'))->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        // return $pdf->stream("Cert.pdf");
        //return view('new_quiz_school_week_2022.school_quiz_certificate',['name' => $name ]);
         $pdf = PDF::loadView('new_quiz_school_week_2022.school_quiz_certificate',['name' => $name ])->setPaper('a4', 'landscape');
         $pdf->getDomPDF()->setHttpContext(
             stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
         );
         
         return $pdf->download("certificate.pdf");
         //return view('tokyoquizcertificate',['name' => $name ]); 
     }
 
    
     public function downloadPklQuizReport($today = 0){ 
        $from_date = date('Y-m-d').' 00:00:00';
        $to_date = date('Y-m-d').' 23:59:59';        
        // $query = "select 
        // u.name,
        // u.email,
        // u.phone,
        // u.role,
        // u.rolelabel,
        // u.created_at, 
        // u.via, 
        // u.viamedium, 
        // u.via,     
        // um.dob,     
        // um.age,     
        // um.gender,     
        // um.address,     
        // um.state,     
        // um.block,     
        // um.city,     
        // um.mobile,     
        // um.pincode,     
        // um.height,     
        // um.weight,     
        // um.board,     
        // um.medium,     
        // um.gmail,     
        // um.facebook,     
        // um.apple,
        // UVE.email as UVEemail,
        // UVP.phone as UVEphone
        // from users u 
        // inner join usermetas um on u.id=um.user_id 
        // inner join userverifications UVE on (u.email=UVE.email) 
        // inner join userverifications UVP on (u.phone=UVP.phone) 
        // where  cast(u.created_at as date)>='2022-04-01' and cast(u.created_at as date)<'2023-05-01' order by u.created_at;";
        $query = "select 
        count(*)
        from users u 
        inner join usermetas um on u.id=um.user_id         
        where  cast(u.created_at as date)>='2022-04-01' and cast(u.created_at as date)<'2023-05-01' order by u.created_at;";
        // $query = "SELECT a.verified, a.viamedium, a.via FROM users a inner join usermetas b  on a.id = b.user_id where cast(a.created_at as date) >= '2022-04-01' and cast(a.created_at as date)<='2023-04-30'";
        $prerak_result = DB::select(DB::raw($query));
        dd($prerak_result); 
        // $quizs = new PklQuiz();
        // $quizs = $quizs->with(['state','district']);
        // if($today != 0){
        //     $quizs= $quizs->whereBetween('created_at', [$from_date, $to_date]);
        // }  
		// $quizs = $quizs->get();
      
        $headers = array(
            'Content-Type' => 'text/csv'
        );


        $filename =  public_path("quiz.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "name",// Name of school
            "email", // contact number
            "phone", // schoo email
            "role",
            "rolelabel",                
            "created_at",                
            "via",     
            "dob",     
            "age",     
            "gender",     
            "address",     
            "state",     
            "block",     
            "city",     
            "mobile",     
            "pincode",     
            "height",     
            "weight",     
            "board",     
            "medium",     
            "gmail",     
            "facebook",     
            "apple",
            "viamedium",            
            "UVEemail",            
            "UVEphone",            
        ]);

        foreach ($prerak_result as $quiz) {
            fputcsv($handle, [
                $quiz->name,
                $quiz->email,
                $quiz->phone,                
                $quiz->role,                
                $quiz->rolelabel,                
                $quiz->created_at,                
                $quiz->via,     
                $quiz->dob,     
                $quiz->age,     
                $quiz->gender,     
                $quiz->address,     
                $quiz->state,     
                $quiz->block,     
                $quiz->city,     
                $quiz->mobile,     
                $quiz->pincode,     
                $quiz->height,     
                $quiz->weight,     
                $quiz->board,     
                $quiz->medium,     
                $quiz->gmail,     
                $quiz->facebook,     
                $quiz->apple,     
                $quiz->viamedium,     
                $quiz->UVEemail,     
                $quiz->UVEphone,     
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
  
        
    }

    public function uploadPklquiz(Request $request){
		
			Excel::import(new ImportQuiz(), $request->file('file'));

				
	}

    // public function searchState(Request $request){
        
    //       $state_list = User::where('name','LIKE',$request->term['term'].'%')->get();
    //       return response()->json(['status'=>true,'state_list'=>$state_list]);
    // }

public function downloadPklQuizWinner($zone = 'all'){ 
       
        $quizs = new PklQuiz();
        $quizs = $quizs->with(['state','district']);
        
        if($zone == 'central'){
            $quizs= $quizs->whereIn('state_id',[90,92,95,101,105,119,120]);
        }
        if($zone == 'east'){
            $quizs= $quizs->whereIn('state_id',[88,89,107,108,109,110,111,115,118,121]); 
        } 
        if($zone == 'north'){
            $quizs= $quizs->whereIn('state_id',[91,98,99,100,6577,112]); 
        } 
        if($zone == 'south'){
            $quizs= $quizs->whereIn('state_id',[86,87,102,103,104,113,116,117]); 
        } 
        if($zone == 'west'){
            $quizs= $quizs->whereIn('state_id',[93,96,97,106,114]); 
        }else{

        }
		$quizs =$quizs->orderBy('score','desc')->orderBy('sec','desc')->take(50)->get();
      
        $headers = array(
            'Content-Type' => 'text/csv'
        );


        $filename =  public_path("quiz.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "Participant Name",// Name of school
            "Mobile Number", // contact number
            "DOB", // schoo email
            "Parent/Guardian Name",
            "School Name",
            "Class",
            "Section",
            "State",
            "District",
            "City",
            "Pincode",
            "Score",            
            "Time in Seconds",            
            "Created at",
        ]);

        foreach ($quizs as $quiz) {
            fputcsv($handle, [
                $quiz->name,
                $quiz->mobile,
                $quiz->dob,                
                $quiz->parent_name,                
                $quiz->school_name,                
                $quiz->class,                
                $quiz->section,                
                $quiz->state->name,                
                $quiz->district->name,                
                $quiz->city,                
                $quiz->pincode,                
                $quiz->score,                
                60 - $quiz->sec*1,                
                $quiz->created_at,                
               
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, $zone."_winners.csv", $headers);
  
        
    }

}
