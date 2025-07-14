<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;

class Event extends Model
{
    use HasFactory;  
	
    public static function getAllYouth(){		        
      $result = DB::table('events')        
            ->leftJoin('users', 'users.id', '=', 'events.user_id')
            ->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
            ->select(['events.name','usermetas.mobile','users.name as uname','users.email','events.eventstartdate','events.kmrun','events.participantnum','usermetas.state','usermetas.district','usermetas.block', DB::raw('(CASE WHEN users.rolelabel IS NOT NULL THEN "Web" WHEN users.rolelabel IS NULL THEN "Mobile" ELSE "Web" END) AS application_status'),'users.created_at'])->get();
       
       return $result; 
       //dd($result);    
    }

   public static function getAllSearch(){
       //DB::enableQueryLog(); 
      if(request()->input('search')=='search'){      
           if(request()->input('cat')=='13056'){
                $data = DB::table('events')        
                  ->leftJoin('users', 'users.id', '=', 'events.user_id')
                  ->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
                  ->select(['events.name','usermetas.mobile','users.name as uname','users.email','events.eventstartdate','events.eventimage1','events.eventimage2','events.video','events.participantnum','usermetas.state','usermetas.district','usermetas.block', DB::raw('(CASE WHEN users.rolelabel IS NOT NULL THEN "Web" WHEN users.rolelabel IS NULL THEN "Mobile" ELSE "Web" END) AS application_status'),'users.created_at']);            
            }else{
                    $data = DB::table('events')        
                      ->leftJoin('users', 'users.id', '=', 'events.user_id')
                      ->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
                      ->select(['events.name','usermetas.mobile','users.name as uname','users.email','events.eventstartdate','events.kmrun','events.participantnum','usermetas.state','usermetas.district','usermetas.block', DB::raw('(CASE WHEN users.rolelabel IS NOT NULL THEN "Web" WHEN users.rolelabel IS NULL THEN "Mobile" ELSE "Web" END) AS application_status'),'users.created_at']);       
            }
            if(!empty(request()->input('ename'))){              
               
			   $data = $data->where('events.name', 'LIKE', "%".request()->input('ename')."%")->orWhere('usermetas.mobile', 'LIKE', "%".request()->input('ename')."%");
            }           
            
            if(!empty(request()->input('st'))){
              
               $data = $data->where('usermetas.state', 'LIKE', "%".request()->input('st')."%");
            }
            
            if(!empty(request()->input('dst'))){
              
               $data = $data->where('usermetas.district', 'LIKE', "%".request()->input('dst')."%");
            }

            if(!empty(request()->input('dbk'))){
              
               $data = $data->where('usermetas.block', 'LIKE', "%".request()->input('dbk')."%");
            }
			
						
			if(!empty(request()->input('cat'))){			
                
               $data = $data->where('events.category', 'LIKE', "%".request()->input('cat')."%");
            }
            
            if(!empty(request()->input('dat'))){
                
               $data = $data->where('events.created_at', 'LIKE', "%".request()->input('dat')."%");
            }             
             
            //$result=$data->skip(0)->take(9990)->get();      
            $result=$data->get();                   
        }

        //dd($result);
        //dd(DB::getQueryLog());  
        return $result;   
    }    
}