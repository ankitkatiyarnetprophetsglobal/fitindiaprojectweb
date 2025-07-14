<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\User;
use App\Models\State;
use Excel;
use PDF;
use App\Models\Admin;
use App\Models\Quizreport;
use App\Exports\QuizOrgExport;
use App\Models\Quizwinners;

class QuizOrgController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
    
    public function index(Request $request){
		
		if($request->input('search')=='search'){
			
			$organisers = Quizreport::
			select("school_id as id","users.name as name", "users.email as email", "users.phone as mobile", "users.created_at as createdOn", DB::raw("count(*) as count"))
			->leftJoin ('users', 'quiz_report.school_id', '=', 'users.id')
			->where('users.email', 'LIKE', "%".$request->user_name."%")
			->orWhere('users.name', 'LIKE', "%".$request->user_name."%")
			->orWhere('users.phone', 'LIKE', "%".$request->user_name."%")
			->orderBy('users.id', 'DESC')
			->groupBy('school_id')
			->paginate(50); 
			
		}else{
			$organisers = Quizreport::select("school_id as id","users.name as name", "users.email as email", "users.phone as mobile", "users.created_at as createdOn", DB::raw("count(*) as count"))->leftJoin ('users', 'quiz_report.school_id', '=', 'users.id')->orderBy('users.id', 'DESC')->groupBy('school_id')->paginate(50);
		}
		
	  	return view('admin.quiz.organiser', compact('organisers')); 
    }
	
	
	
	public function quizorgexport(){
		
		
	    return Excel::download(new QuizOrgExport,'quizlist.xlsx');
      
    }
	
	public function deletequizorg($id){
		
		$resq = Quizreport::where('school_id', $id )->delete();
		$resw = Quizwinners::where('org_id', $id )->delete();
		//$res = User::where('id', $id )->delete();
		return back()->with('success','Event successsfully Deleted');
	}
	
}
