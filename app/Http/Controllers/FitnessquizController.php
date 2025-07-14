<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fitnessquiz;
use App\Models\Quizresult;
use App\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FitnessquizController extends Controller
{
    public function fitnessquiz()
    {
        $fitness = Fitnessquiz::orderBy(\DB::raw('RAND()'))->limit(5)->get();
		//return view('fitness-quiz',compact('fitness'));	
		return view('fitness-quiz-msg',compact('fitness'));	
    }
	
	public function savefitnessquiz(Request $request){
		//dd($request);die();	
		/* $validatedData = $request->validate([			  
			  'email' => 'required|max:155',			  
			  ],
			  [			  
			  'email.required' => 'Please inter Email',			  
			  ]
		  ); */
		  
	   $rules = [
        'email' => 'required|max:155',	   
		'quesoption' => 'required|array',			
	   ];      

       $messages = [ 
         'email.required' => 'Please inter Email',			   
		 'quesoption.*.required' => 'Name of the event is required',					
	   ];
	   
	    //$request->validate($rules , $messages);		
		//$encrypted = $request->encrypted;quesoption 
		
		$quesids = array(); 
		
		if(!empty($request->quesoption)){
			$quesids = array_keys($request->quesoption);
		}	
		
		
		$quesfilled = $request->quesoption;
		
		$results = Fitnessquiz::whereIn('id', $quesids)->get();	
		 
		$score = 0;
		foreach($results as $result){			
			if($quesfilled[$result->id] == $result->ans){ 
				$score += 1;
			}
		}		
		
        date_default_timezone_set("Asia/Kolkata");
		$curdate = date('Y-m-d H:i:s');		
		$curdateonly = date('Y-m-d');
		
		//$chkreq = Quizresult::where('email', $request->email)->where('createdOnDate', $curdateonly)->first();
		$chkreq = Quizresult::where('email', $request->email)->first();
		$email = $request->email;

       //dd($chkreq->id);die;		
	    
        if(!empty($chkreq)){
			
			$quizrepo = Quizresult::where('id', $chkreq->id)->update([
							 'email' => $request->email,
							 'quesoption' => serialize($request->quesoption),
							 'score' => $score,
							 'created_at' => $curdate,
							 'updated_at' => $curdate,						   
					    ]);			
        } else {
			
             $quizrepo = Quizresult::create([
							'email' => $request->email,
							'quesoption' => serialize($request->quesoption),
							'score' => $score,
							'created_at' => $curdate,
							'updated_at' => $curdate,		
						]); 
        } 

        return view('fitnessresult',compact('results', 'quesfilled','email' ));		
		
		/* if(!$chkreq){	
			$quizrepo = new Quizresult(); 	
			$quizrepo->email = $request->email;			
			$quizrepo->quesoption = serialize($request->quesoption);
			$quizrepo->score = $score;			
			$quizrepo->createdOn = $curdate;
			$quizrepo->createdOnDate = $curdateonly;			
			$res = $quizrepo->save();
			return view('fitnessresult',compact('results', 'quesfilled','email' ));
		}else{
			return redirect()->back()->with('error', 'You have been applied for the quiz for today');
			
		}		 */
	}	
 }
