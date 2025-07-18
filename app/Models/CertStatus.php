<?php
namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CertStatus extends Model
{
    use HasFactory;
    protected $table = 'wp_star_rating_status';
    public $timestamps = false;
    protected $fillable = ['user_id', 'cat_id', 'cur_status', 'status', 'created', 'updated'];  
    
    public static function getAllCert()
    {
       //udise
       $starratingstatus = DB::table('wp_star_rating_status')->leftJoin('users',  'users.id', '=', 'wp_star_rating_status.user_id')->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')->leftJoin('cert_cats',  'cert_cats.id', '=', 'wp_star_rating_status.cat_id')->limit(40)->get(array('users.name', 'users.email', 'users.phone','usermetas.udise','usermetas.state', 'usermetas.district', 'usermetas.block', DB::raw('(CASE WHEN wp_star_rating_status.cat_id = "1621" THEN "School Flag" WHEN wp_star_rating_status.cat_id = "1622" THEN "3 Star" WHEN wp_star_rating_status.cat_id = "1623" THEN "5 Star" ELSE "NULL" END) AS category'), 'cert_cats.name as certname', 'wp_star_rating_status.status', 'wp_star_rating_status.created'));
       
       return $starratingstatus;    
    }
        
    public static function getAllSearch(){  

     if(request()->input('search')=='search'){   
                 
       $data = DB::table('wp_star_rating_status as starstat')        
             ->leftJoin('users','users.id', '=', 'starstat.user_id')
             ->leftJoin('usermetas', 'usermetas.user_id', '=', 'starstat.user_id')
             ->select(array('users.name','users.email','users.phone','usermetas.udise','usermetas.state','usermetas.district','usermetas.block', DB::raw('(CASE WHEN starstat.cat_id = "1621" THEN "School Flag" WHEN starstat.cat_id = "1622" THEN "3 Star" WHEN starstat.cat_id = "1623" THEN "5 Star" ELSE "NULL" END) AS category'),'starstat.status','starstat.created'));
       
            if(!empty(request()->input('name'))){
                
               $data = $data->where('users.name', 'LIKE', "%".request()->input('name')."%")->orWhere('users.email','LIKE',"%".request()->name."%")->orWhere('users.phone','LIKE',"%".request()->name."%");
            }
            
            if(!empty(request()->input('state'))){
                
               $data = $data->where('usermetas.state', 'LIKE', "%".request()->input('state')."%");
            }
            
            if(!empty(request()->input('dst'))){
                
               $data = $data->where('usermetas.district', 'LIKE', "%".request()->input('dst')."%");
            }

            if(!empty(request()->input('blk'))){
              
               $data = $data->where('usermetas.block', 'LIKE', "%".request()->input('blk')."%");
            }
            
            if(!empty(request()->input('cert'))){
                
                if(request()->input('cert') ==  '1622'){
                    
                    $data = $data->leftJoin('wp_star_rating_status as fvs', function($join){
                             $join->on('fvs.user_id', '=', 'usermetas.user_id')->where('fvs.cat_id',  1623);
                             
                          })
                          ->where('starstat.cat_id', 1622)
                          ->where('fvs.user_id', '=', NULL);                    
                    //dd($data); 
                }else{
                    
                    $data = $data->where('starstat.cat_id', request()->input('cert'));  
                }               
            }

            if(!empty(request()->input('month')))
            {
                 $data = $data->where('starstat.created', 'LIKE', "%".request()->input('month')."%");
            }           
           
            $result=$data->get();              
                  
        }       

        return $result;   
    }
  
}

