<?php
namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quizreport extends Model
{
    use HasFactory;
	protected $table = 'quiz_report';
    public $timestamps = false;
    protected $fillable = ['quesoption', 'name', 'email', 'mobile', 'score', 'school_id', 'createdOn'];

    public static function getAllUser(){	  
	  $records = DB::table('quiz_report')
		->leftJoin('users','users.id', '=','quiz_report.school_id')	
		->orderBy('quiz_report.id','desc')
		->get(['quiz_report.id','quiz_report.name','users.name as partner','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn']);
		
		return $records;
	}	

   	
		
	public static function getAllSearch(){
		
		if(request()->input('search')=='search'){ 
		
			$result = DB::table('quiz_report')
					->leftJoin('users','users.id', '=','quiz_report.school_id')	
					->orderBy('quiz_report.id','desc')
					->select(['users.id','users.name as partner','quiz_report.name','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn']);
	
		if(!empty(request()->input('uname'))){
			
		   $result = $result->where('quiz_report.email', 'LIKE', "%".request()->input('uname')."%")
							->orWhere('quiz_report.name', 'LIKE', "%".request()->input('uname')."%")
							->orWhere('quiz_report.mobile', 'LIKE', "%".request()->input('uname')."%");
		}		
				
		if(!empty(request()->input('st'))){
			
		   $result = $result->where('quiz_report.state', 'LIKE', "%".request()->input('st')."%");
		}
				
		if(!empty(request()->input('month'))){
			
		   $result = $result->where('quiz_report.createdOn', 'LIKE', "%".request()->input('month')."%");
		}
		
		if(!empty(request()->input('org'))){
			
			$result = $result->where('users.id', '=', request()->input('org'));   
                 }
	   
		$result=$result->get();
	}
	
	 return $result;   
    }		
  }
