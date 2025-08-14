<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Auth;
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
    // Auth::user();
    // $admins_role = Auth::user()->role_id;
    // dd("1213131331");
    $user = DB::table('users')
      ->leftJoin('usermetas', 'users.id', '=',  'usermetas.user_id')
      ->orderBy('users.id', 'desc')
      ->select(['users.id', 'users.name', 'users.email', 'users.role', 'users.rolelabel', 'users.phone', 'usermetas.gender', 'usermetas.city', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'users.created_at']);
    $curcount = $user->count();

    $school_star_query = DB::table('wp_star_rating_status')
      ->leftJoin('users', 'users.id', '=', 'wp_star_rating_status.user_id')
      ->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
      ->select(array('wp_star_rating_status.*', 'users.id as userid', 'users.name', 'users.email', 'users.phone', 'users.role', 'users.rolelabel', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'wp_star_rating_status.created'));
    $school_star_count = $school_star_query->count();

    $total_count_cyclothon = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%';";

    $data_total_count_cyclothon = DB::select(DB::raw($total_count_cyclothon));

    // dd(count($data_total_count_cyclothon));
    $data_total_count_cyclothon = count($data_total_count_cyclothon);


    $total_count_cyclothon_individual = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%' and usermetas.cyclothonrole = 'individual';";

    $data_total_count_cyclothon_individual = DB::select(DB::raw($total_count_cyclothon_individual));

    // dd(count($data_total_count_cyclothon_individual));
    $data_total_count_cyclothon_individual = count($data_total_count_cyclothon_individual);

    // $total_count_cyclothon_individual_blank = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024' and cyclothonrole is null;";
    $total_count_cyclothon_individual_blank = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%' and usermetas.cyclothonrole is null;";

    $data_total_count_cyclothon_individual_blank = DB::select(DB::raw($total_count_cyclothon_individual_blank));

    // dd(count($data_total_count_cyclothon_individual));
    $data_total_count_cyclothon_individual_blank = count($data_total_count_cyclothon_individual_blank);

    $total_individual = $data_total_count_cyclothon_individual_blank + $data_total_count_cyclothon_individual;


    // $total_count_cyclothon_organization = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024' and cyclothonrole = 'organization';";
    $total_count_cyclothon_organization = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%' and usermetas.cyclothonrole = 'organization';";

    $total_count_cyclothon_organization = DB::select(DB::raw($total_count_cyclothon_organization));

    // dd(count($data_total_count_cyclothon_individual));
    $data_total_count_cyclothon_organization = count($total_count_cyclothon_organization);

    // $total_count_cyclothon_club = "SELECT * FROM users as u inner join usermetas as um on u.id = um.user_id where u.rolewise = 'cyclothon-2024' and cyclothonrole = 'club';";
    $total_count_cyclothon_club = "select users.id,users.name,users.email,users.role,users.rolelabel,users.phone,usermetas.gender,usermetas.city,usermetas.state,usermetas.district,usermetas.block,users.created_at from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%' and usermetas.cyclothonrole = 'club';";

    $total_count_cyclothon_club = DB::select(DB::raw($total_count_cyclothon_club));

    // dd(count($data_total_count_cyclothon_individual));
    $data_total_count_cyclothon_club = count($total_count_cyclothon_club);

    $total_namo_fit_india_cycling_club = "SELECT *  FROM `users` WHERE `role` LIKE 'namo-fit-india-cycling-club'";

    $total_count_namo_fit_india_cycling_club = DB::select(DB::raw($total_namo_fit_india_cycling_club));

    // dd(count($data_total_count_cyclothon_individual));
    $data_total_count_namo_fit_india_cycling_club = count($total_count_namo_fit_india_cycling_club);
    // dd($data_total_count_namo_fit_india_cycling_club);


        $clubcountNamoSOC = $data_total_count_namo_fit_india_cycling_club + $data_total_count_cyclothon_club;
        $total_count_cyclothon = $data_total_count_cyclothon + $data_total_count_namo_fit_india_cycling_club;
        $fourth_count = DB::table('soc_event_participations as sop')
                ->join('users', 'users.id', '=', 'sop.user_id')
                ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
                ->leftJoin('soc_event_participation_receives as sopr', function($join) {
                    $join->on('sop.user_id', '=', 'sopr.user_id')
                        ->on('sop.socemid', '=', 'sopr.socemid');
                })
                ->where('sop.socemid', 5)
                ->count();
        $fifth_count = DB::table('soc_event_participation_receives as sopr')
        ->join('users', 'users.id', '=', 'sopr.user_id')
        ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
        ->where('sopr.socemid', 5)
        ->whereNotIn('sopr.user_id', function($query) {
            $query->select('user_id')
                ->from('soc_event_participations')
                ->where('socemid', 5);
        })
        ->count();
        $sixth_count = DB::table('soc_event_participation_receives as sopr')
            ->join('users', 'users.id', '=', 'sopr.user_id')
            ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
            ->where('sopr.socemid', 5)
            ->whereIn('sopr.user_id', function($query) {
                $query->select('user_id')
                    ->from('soc_event_participations')
                    ->where('socemid', 5);
            })
            ->count();
        $seventh_count = DB::table('soc_event_participation_receives as sopr')
        ->join('users', 'users.id', '=', 'sopr.user_id')
        ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
        ->where('sopr.socemid', 7)
        ->whereNotNull('sopr.user_id')
        ->count();

        $eventdate = DB::table('soc_event_masters')
                    ->where('status', 0)
                    ->orderBy('id', 'DESC')
                    ->select('event_date')
                    ->first();
        // dd($eventdate->event_date);
        if(isset($eventdate)){
            $date_format = $eventdate->event_date;
            $event_date = date('d-m-Y', strtotime($date_format));
            // dd($event_date);
            // date('d-m-Y', strtotime($event_date));
        }else{
            $event_date = "11-08-2025";
        }


    return view('admin.home', compact('curcount', 'school_star_count', 'total_count_cyclothon', 'total_individual', 'clubcountNamoSOC','fourth_count','fifth_count','sixth_count','seventh_count','event_date'));
    // dd($curcount);
    // return view('admin.home');
  }
}
