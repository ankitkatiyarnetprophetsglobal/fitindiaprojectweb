<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Freedomrunpartners extends Model
{
    use HasFactory;
    protected $table = 'freedom_run_partners';
    protected $fillable = [
        'name',
        'org_name',
        'event_name',
        'email_id',
        'contact',
        'from_date',
        'to_date',
        'photo',
        'website_link'
    ];	
	
   public static function getAllFreedomrun(){	  
	  
	  $records = DB::table('freedom_run_partners')
		->orderBy('freedom_run_partners.org_name','desc')
		->get(['org_name','event_name','email_id','contact','from_date','to_date']);		
		
		return $records;
	}	
		
	public static function getAllSearch(){			
			
		if(request()->input('search')=='search'){ 
		
			$result = DB::table('freedom_run_partners')
					->orderBy('freedom_run_partners.org_name','desc')
					->select(['org_name','event_name','email_id','contact','from_date','to_date']);
					
		if(!empty(request()->input('ename'))){
			
		   $result = $result->where('freedom_run_partners.email_id', 'LIKE', "%".request()->input('ename')."%")
							->orWhere('freedom_run_partners.org_name', 'LIKE', "%".request()->input('ename')."%")
							->orWhere('freedom_run_partners.contact', 'LIKE', "%".request()->input('ename')."%");
		}		
		
		 $result = $result->skip(0)->take(3000)->get(); 
	  }
	
	 return $result;   
  }		
}