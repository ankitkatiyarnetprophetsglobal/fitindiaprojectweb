<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quizwinners extends Model
{
    use HasFactory;
	
    protected $table = 'quizwinners'; 
    public $timestamps = false;
    protected $fillable = ['winner_id', 'org_id', 'score', 'sec', 'winnerdate'];   

     public static function getAllUser(){
		
		$records = DB::table('quizwinners')
				->leftJoin('users','users.id', '=',	'quizwinners.org_id')
				->leftJoin('quiz_report','quiz_report.id', '=',	'quizwinners.winner_id')
				->select(['users.id','users.name as partner','quiz_report.school_id','quiz_report.name','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn'])
				->orderBy('quizwinners.id','desc');	
		  
			return $records;
	}	

		
		
	public static function getAllSearch(){
		
		if(request()->input('search')=='search'){ 			
			
			$result = DB::table('quizwinners')
				->leftJoin('users','users.id', '=',	'quizwinners.org_id')
				->leftJoin('quiz_report','quiz_report.id', '=',	'quizwinners.winner_id')
				->select(['users.id','users.name as partner','quiz_report.name','quiz_report.email','quiz_report.mobile','quiz_report.city','quiz_report.state','quiz_report.score','quiz_report.createdOn'])
				->orderBy('quizwinners.id','desc');
	 
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
	   
		        //$result=$result->skip(0)->take(10000)->get(); 

		        $result=$result->get(); 
	        }
	
	    return $result;   
    }	
}
