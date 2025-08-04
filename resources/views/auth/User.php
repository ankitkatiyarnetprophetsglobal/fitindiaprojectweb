<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Usermeta;
use App\Models\Userverification;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone','role', 'rolelabel', 'role_id', 'phone', 'password','verified', 'rolewise'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
    public function usermeta(){
        return $this->hasOne(Usermeta::class);
    } 
	
	public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

	public static function getAllUser(){
	  $records = DB::table('users')
		->join('usermetas','users.id', '=', 'usermetas.user_id')
		->orderBy('users.id','desc')
		// ->get(['users.id','users.name','users.email','users.role','usermetas.mobile','usermetas.address_line_one','usermetas.address_line_two','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.gender','users.rolelabel']);
		->get(['users.id','users.name','users.email','users.role','users.phone','usermetas.address_line_one','usermetas.address_line_two','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.gender','users.rolelabel']);
		// ->get(['users.id','users.name','users.role','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.gender','users.rolelabel']);
		
		return $records;
	}		
		
	public static function getAllSearch(){
		$data = array();
		if(request()->input('search')=='search'){       
			$result = DB::table('users')
					->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
					// ->join('usermetas','users.id', '=', 'usermetas.user_id')
					->orderBy('users.id','desc')
					// ->select(['users.id','users.name','users.email','users.role','usermetas.mobile','usermetas.address_line_one','usermetas.address_line_two','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.gender','users.rolelabel','users.created_at',DB::raw('(CASE WHEN users.rolelabel IS NOT NULL THEN "Web" WHEN users.rolelabel IS NULL THEN "Mobile" ELSE "Web" END) AS application_status')]);
					// ->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.address_line_one','usermetas.address_line_two','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.gender','users.rolelabel','users.created_at',DB::raw('(CASE WHEN users.rolelabel IS NOT NULL THEN "Web" WHEN users.rolelabel IS NULL THEN "Mobile" ELSE "Web" END) AS application_status')]);
					->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.address_line_one','usermetas.address_line_two','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.gender','users.rolelabel',DB::raw('(case when users.updated_at > users.created_at then users.updated_at else users.created_at end) AS created_at'),DB::raw('(CASE WHEN users.rolelabel IS NOT NULL THEN "Web" WHEN users.rolelabel IS NULL THEN "Mobile" ELSE "Web" END) AS application_status')]);
					// ->select(['users.id','users.name','users.role','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.gender','users.rolelabel','users.created_at',DB::raw('(CASE WHEN users.rolelabel IS NOT NULL THEN "Web" WHEN users.rolelabel IS NULL THEN "Mobile" ELSE "Web" END) AS application_status')]);
	
		if(!empty(request()->input('uname'))){
			
		   $result = $result->where('users.email', 'LIKE', "%".request()->input('uname')."%")
							->orWhere('users.name', 'LIKE', "%".request()->input('uname')."%")
							->orWhere('users.phone', 'LIKE', "%".request()->input('uname')."%");
		}
		
		if(!empty(request()->input('st'))){
			
		   $result = $result->where('usermetas.state', 'LIKE', "%".request()->input('st')."%");
		}
		
		
		if(!empty(request()->input('dst'))){
			
		   $result = $result->where('usermetas.district', 'LIKE', "%".request()->input('dst')."%");
		}
		
		if(!empty(request()->input('blk'))){
			
		   $result = $result->where('usermetas.block', 'LIKE', "%".request()->input('blk')."%");
		}
		
		if(!empty(request()->input('month'))){
			
		   $result = $result->where('users.created_at', 'LIKE', "%".request()->input('month')."%");
		}
		
		/* if(!empty(request()->input('role'))){
			$result = $result->where('users.role', 'LIKE', "%".request()->input('role')."%");  
		    //$result = $result->where('freedomruns.role', 'LIKE', "%".request()->input('type')."%");
		} */		
		
		//->select(['users.id','users.name','users.email','users.role','users.rolelabel',
		//'usermetas.mobile','usermetas.city','usermetas.state','usermetas.district','usermetas.block']);		
		//$result=$result->skip(0)->take(3000)->get();
		
		if(!empty(request()->input('role'))&& request()->input('role')=='Mobile'){		
			
		    $result = $result->where('users.rolelabel', '=', null );
		   
		}
		
		
		if(!empty(request()->input('role'))&& request()->input('role')!='Mobile'){	
			
			if(request()->input('role') == 'cyclothon-2024'){

				$result = $result->where('users.rolewise', 'LIKE', "%".request()->input('role')."%");   	

			}else{

				$result = $result->where('users.role', 'LIKE', "%".request()->input('role')."%");   

			}
		}
		
		//if(!empty(request()->input('role'))){
		
        /* if(!empty(request()->input('role'))&& request()->input('role')=='Mobile')
		{
		  $result = $result->where('users.rolelabel', null); 
		  
		} else if(!empty(request()->input('role'))&& request()->input('role')!='Mobile'){
			
		  $result = $result->where('users.role', 'LIKE', "%".request()->input('role')."%");   
		}		 */
			
		/*if(!empty(request()->input('role'))=='Mobile'){			
		  //dd(request()->input('role'));die;			
		  $result = $result->where('users.role', 'LIKE', "%".request()->input('role')."%");   
        }*/
		
		//$result = $result->get(); 
	   
		$result=$result->skip(0)->take(903530)->get();
	}
	
	 return $result;   
  }

  public function verifyUser(){		 
	  return $this->hasOne(Userverification::class);
      //return $this->hasOne('App\Models\Userverification');
  } 
}