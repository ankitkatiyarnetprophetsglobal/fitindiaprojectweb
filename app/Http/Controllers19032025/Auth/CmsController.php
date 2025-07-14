<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response,Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventCat;
use App\Models\Ambassador;
use App\Models\Champion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Schoolquiz;
use App\Models\Freedomrun;
class CmsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function cmslistview(){
		// dd(123412341234);
		$events = Event::where( 'user_id', Auth::user()->id )->get();
		$role = auth()->user()->role;
		return view('cms.listview', ['role' => $role , 'events' =>$events]);
	}
	
	public function schoolQuiz(){
		$role = Auth::user()->role;
        if($role){

            $events = Event::where( 'user_id', Auth::user()->id )->get();
			$role = Role::where('slug', $role)->first()->name;
            return view('event.school-quiz', ['role' => $role , 'events' =>$events]);
        }
	}
}
