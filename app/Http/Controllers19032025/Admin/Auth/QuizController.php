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
use App\Exports\QuizExport;
use Excel;
use PDF;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Quizreport;

class QuizController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
    
    public function index(Request $request){

     $partnerdata = DB::table('quiz_report')
				->leftJoin('users','users.id', '=',	'quiz_report.school_id')
				->select(['users.id as uid','users.name as uname'])
				->orderBy('users.name','asc')
				->orderBy('users.id','desc')
				->groupBy('quiz_report.school_id')
				->get();
				
		  /*$partnerdata = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id as uid','users.name as uname','usermetas.state'])
				->orderBy('users.id','desc')
				->limit(100)->get();*/		
	  
      $states = State::orderBy("name")->get();	
				
	  if($request->input('searchdata') == 'searchdata'){  
			            			
			 $user = DB::table('quiz_report')
				->leftJoin('users','users.id', '=',	'quiz_report.school_id')
				->select(['quiz_report.id','quiz_report.name','users.name as partner','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.school_id','quiz_report.createdOn'])
				->orderBy('quiz_report.id','desc');
				
			if(!empty($request->organisation))
			{
				$user = $user->where('quiz_report.school_id', $request->organisation);
			}		
			
			if(!empty($request->state))
			{
				$user = $user->where('quiz_report.state', 'LIKE', "%".$request->state."%");
			}		

			if($request->month)
			{
				$user = $user->where('quiz_report.createdOn', 'LIKE', "%".$request->month."%");
			}			

			$curcount = $user->count();			
			$user = $user->paginate(50);
							
			$count = DB::table('quiz_report')
				->leftJoin('users','users.id', '=',	'quiz_report.school_id')
				->select(['quiz_report.id','quiz_report.name','users.name as partner','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.school_id','quiz_report.createdOn'])
				->orderBy('quiz_report.id','desc')
				->count();
				
			           			
		} else if($request->input('search')=='search'){
			 
		  $user = DB::table('quiz_report')
				->leftJoin('users','users.id', '=',	'quiz_report.school_id')
				->select(['quiz_report.id','quiz_report.name','users.name as partner','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.school_id','quiz_report.createdOn'])
				->orderBy('quiz_report.id','desc')
				->where('quiz_report.email', 'LIKE', "%".$request->user_name."%")
				->orWhere('quiz_report.name', 'LIKE', "%".$request->user_name."%")
				->orWhere('quiz_report.mobile', 'LIKE', "%".$request->user_name."%"); 

			$curcount = $user->count();			
			$user = $user->paginate(50);

		
			$count = DB::table('quiz_report')
				->leftJoin('users','users.id', '=',	'quiz_report.school_id')
				->select(['quiz_report.id','quiz_report.name','users.name as partner','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.school_id','quiz_report.createdOn'])
				->orderBy('quiz_report.id','desc')
				->count();					
            				
		} else { 
            
           $user = DB::table('quiz_report')
				->leftJoin('users','users.id', '=',	'quiz_report.school_id')
				->select(['quiz_report.id','quiz_report.name','users.name as partner','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.school_id','quiz_report.createdOn'])
				->orderBy('quiz_report.id','desc'); 			
				
			$curcount = 0;
			$count = $user->count();
			$user = $user->paginate(50);			
		}				
					
       return view('admin.quiz.index', compact('user','states','partnerdata','count','curcount'));
    } 
    
	public function quizExport(){
	   //dd($request);      
	   //window.location.href='quiz_export?uname=&org=CT Software&st=Arunachal Pradesh&month=2021-06&role=&search=search';
	  
	   if(request()->has('uname'))
        {           
          return Excel::download(new QuizExport,'quizlist.xlsx');
		  
        } else if(request()->has('st')){

          return Excel::download(new QuizExport,'quizlist.xlsx');

       }  else if(request()->has('month')){
		   
          return Excel::download(new QuizExport,'quizlist.xlsx');

       } else if(request()->has('org')){
		   
          return Excel::download(new QuizExport,'quizlist.xlsx');
		  
       } else {
        
		 return Excel::download(new QuizExport,'quizlist.xlsx');
       }
    }	
	
	public function getquizpartner(Request $request){	

       /* $user = DB::table('quiz_report')
				->leftJoin('users','users.id', '=',	'quiz_report.school_id')
				->select(['quiz_report.id','quiz_report.name','users.name as partner','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.school_id','quiz_report.createdOn'])
				->orderBy('quiz_report.id','desc')
                ->where('quiz_report.state', 'like' ,'%'.$request->stname.'%')				
				->get();				
 */
       $user = DB::table('users')
				->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id as uid','users.name as uname','usermetas.state'])
				->orderBy('users.id','desc')
				->where('usermetas.state', 'like' ,'%'.$request->stname.'%')->limit(100)->get();		
				
			 if(!empty($user)){	
			 
			    $partner = '<option value="">Select partner</option>';
				
				foreach($user as $p){					
					//print_r($p);					
				    //$partner .= '<option  value="'.$p->partner.'">'.$p->partner.'</option>';
					
				    $partner .= '<option  value="'.$p->uname.'">'.$p->uname.'</option>';
				}
			}
			
	       return $partner; 
    }
	
	public function createPDF(){      
		$result = DB::table('users')
			->join('usermetas','users.id', '=',
				'usermetas.user_id')
			->get(['users.id','users.email','users.name','users.role','usermetas.mobile','usermetas.city','usermetas.state','usermetas.district','usermetas.block']);



		$pdf = PDF::loadView('admin.quiz.index', compact('result'))->setOptions(['defaultFont' => 'sans-serif']);

		return $pdf->download('pdf_file.pdf');
    } 
	
}
    












