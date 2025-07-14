<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Schoolmeta;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        // $user_data = User::join('usermetas', 'usermetas.user_id', '=', 'users.id')->where('usermetas.user_id','=',2)->get();
        // $query = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024' and cyclothonrole = 'club';";
        $query = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id";
        $query_excution = DB::select(DB::raw($query));
        $user_data = count($query_excution);

        $school_query = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where um.udise is not null;";
        $school_query_excution = DB::select(DB::raw($school_query));
        $user_school_data = count($school_query_excution);
        dd($user_school_data);
        return view('admin.home', ['user_count'=> $user_data]);

        return view('admin.home');
    }




}
