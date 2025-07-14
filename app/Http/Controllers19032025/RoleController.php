<?php
namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request,Response;

class RoleController extends Controller
{    
	public function index(Request $request){
		
		//return Role::where('groupof',$request->groupid)->select('id','slug','name')->orderby('name')->get();
		$roles = Role::where('groupof',$request->groupid)
                 ->whereNotIn('slug', ['champion','smambassador','sai_user','author','gmambassador','caadmin','gram_panchayat','lbambassador','ghd','stateadmin'])->orderBy('name', 'ASC')->get();
		return $roles;
	}
}
