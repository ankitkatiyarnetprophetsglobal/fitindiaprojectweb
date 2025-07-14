<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\State;
use App\Exports\QuizwinnerExport;
use Excel;
use PDF;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Quizreport;

class QuizWinnerController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
    
    public function index(Request $request){

            //dd($request);		
	    			
			$partnerdata = DB::table('quizwinners')
				->leftJoin('users','users.id', '=',	'quizwinners.org_id')
				->select(['users.id as uid','users.name as uname'])
				->orderBy('users.name','asc')
				->orderBy('users.id','desc')
				->groupBy('quizwinners.org_id')
				->get();
	  
        $states = State::orderBy("name")->get();
	  
	   //DB::enableQueryLog();     
		
	   if($request->input('searchdata')=='searchdata'){			            			
			
          $user = DB::table('quizwinners')
				->leftJoin('users','users.id', '=',	'quizwinners.org_id')
				->leftJoin('quiz_report','quiz_report.id', '=',	'quizwinners.winner_id')
				->select(['users.id','users.name as partner','quiz_report.school_id','quiz_report.name','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn'])
				->orderBy('quizwinners.id','desc');
			
			if(!empty($request->quizwinners))
			{
				$user = $user->where('quizwinners.org_id', $request->quizwinners);
			}		 
			
			if(!empty($request->state))
			{
				$user = $user->where('quiz_report.state', '=', $request->state);
			}		

			
            if($request->month)
			{
			   $user = $user->where('quiz_report.createdOn', 'LIKE', "%".$request->month."%");
			}
			

			$curcount = $user->count();			
			$user = $user->paginate(50);							
			
			 $count = DB::table('quizwinners')
				->leftJoin('users','users.id', '=',	'quizwinners.org_id')
				->leftJoin('quiz_report','quiz_report.id', '=',	'quizwinners.winner_id')
				->select(['users.id','users.name as partner','quiz_report.school_id','quiz_report.name','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn'])
				->orderBy('quizwinners.id','desc')
				->count();				
			
			           			
		} else if($request->input('search')=='search'){
			 
            $user = DB::table('quizwinners')
				->leftJoin('users','users.id', '=',	'quizwinners.org_id')
				->leftJoin('quiz_report','quiz_report.id', '=',	'quizwinners.winner_id')
				->select(['users.id','users.name as partner','quiz_report.name','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn'])
				->orderBy('quizwinners.id','desc');

			if(!empty($request->user_name))
			{
				$user = $user->where('quiz_report.email', 'LIKE', "%".$request->user_name."%")
							->orWhere('quiz_report.name', 'LIKE', "%".$request->user_name."%")
							->orWhere('quiz_report.mobile', 'LIKE', "%".$request->user_name."%");
			}
		
			$curcount = $user->count();			
			$user = $user->paginate(50);
			
			$count = DB::table('quizwinners')
				->leftJoin('users','users.id', '=',	'quizwinners.org_id')
				->leftJoin('quiz_report','quiz_report.id', '=',	'quizwinners.winner_id')
				->select(['users.id','users.name as partner','quiz_report.name','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn'])
				->orderBy('quizwinners.id','desc')
				->count();					
            				
		} else { 
          				
            $user = DB::table('quizwinners')
				->leftJoin('users','users.id', '=',	'quizwinners.org_id')
				->leftJoin('quiz_report','quiz_report.id', '=',	'quizwinners.winner_id')
				->select(['users.id','users.name as partner','quiz_report.name','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn'])
				->orderBy('quizwinners.id','desc');								
				
			$curcount = 0;
			$count = $user->count();
			$user = $user->paginate(50);			
		} 
    				
       return view('admin.quizwinner.index', compact('user','states','partnerdata','count','curcount'));
    } 
    
	public function quizwinnerexport(){
	   //window.location.href='quiz_winner_export?uname=&org=&st=&month=&role=&search=search';	  
	   if(request()->has('uname'))
        {           
          return Excel::download(new QuizwinnerExport,'quizlist.xlsx');
		  
        } else if(request()->has('st')){

          return Excel::download(new QuizwinnerExport,'quizlist.xlsx');

       }  else if(request()->has('month')){
		   
          return Excel::download(new QuizwinnerExport,'quizlist.xlsx');

       } else if(request()->has('org')){
		   
          return Excel::download(new QuizwinnerExport,'quizlist.xlsx');
		  
       } else {
        
		 return Excel::download(new QuizwinnerExport,'quizlist.xlsx');
       }
    }	
}   
