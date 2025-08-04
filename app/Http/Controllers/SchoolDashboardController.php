<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolDashboard;
use App\Models\Siteoption;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use App\Models\DashboardTile;

class SchoolDashboardController extends Controller
{
    //
    public function index(){
        $tiles = DashboardTile::get();
    
        $schooldata =  SchoolDashboard::orderBy('flag', 'desc')->get();
        $siteopts = Siteoption::whereIn('key', ['visitors', 'totalschools', 'flag_boards', 'flag_states', 'schools_flagreq','flagupdateOn', 'flag', 'threestar', 'fivestar'] )->select('key','value')->get()->toArray();
        return view('schooldashboard', compact('schooldata', 'siteopts','tiles'));
    }
    
    public function updatestat(){
        $states = State::all();
        
        
        foreach($states as $state){
            $state = $state->name;
            
            
            $flagcnt = DB::table('wp_star_rating_status')        
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
                ->where('usermetas.state', '=' ,$state)
                ->where('wp_star_rating_status.cat_id', 1621)
                ->count();
            
            $threecnt = DB::table('wp_star_rating_status as flg')
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'flg.user_id')
                ->leftJoin('wp_star_rating_status as fvs', function($join)
                         {
                             $join->on('fvs.user_id', '=', 'usermetas.user_id')
                                  ->where('fvs.cat_id',  1623);
                          })
                ->where('usermetas.state', '=' ,$state)
                ->where('flg.cat_id', 1622)
                ->where('fvs.user_id', '=', NULL)
                ->count();  
                
            $fivecnt = DB::table('wp_star_rating_status')
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
                ->where('usermetas.state', '=' ,$state)
                ->where('wp_star_rating_status.cat_id', 1623)
                ->count();
            
            DB::table('wp_state_data')->where('state',$state)->update(
                [
                    'flag' => $flagcnt,
                    'threestar' => $threecnt,
                    'fivestar' => $fivecnt,
                ]
            );
            
            echo $state.' - '.$flagcnt.' - '.$threecnt.' - '.$fivecnt; 
            
            
            echo '<br>';
        }
        
        
        $flagtot = DB::table('wp_star_rating_status')        
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
                ->where('wp_star_rating_status.cat_id', 1621)
                ->count();
        
        $threetot = DB::table('wp_star_rating_status as flg')
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'flg.user_id')
                ->leftJoin('wp_star_rating_status as fvs', function($join)
                         {
                             $join->on('fvs.user_id', '=', 'usermetas.user_id')
                                  ->where('fvs.cat_id',  1623);
                          })
                ->where('flg.cat_id', 1622)
                ->where('fvs.user_id', '=', NULL)
                ->count();
                
        $fivetot = DB::table('wp_star_rating_status')
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
                ->where('wp_star_rating_status.cat_id', 1623)
                ->count();
                
                
        
        
        $flagtot = DB::table('wp_star_rating_status')        
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
                ->where('wp_star_rating_status.cat_id', 1621)
                ->count();
        
        DB::table('siteoptions')->where('key', 'flag')->update(['value' => $flagtot]);
        DB::table('siteoptions')->where('key', 'schools_flagreq')->update(['value' => $flagtot]);
        
        
        $threetot = DB::table('wp_star_rating_status as flg')
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'flg.user_id')
                ->leftJoin('wp_star_rating_status as fvs', function($join)
                         {
                             $join->on('fvs.user_id', '=', 'usermetas.user_id')
                                  ->where('fvs.cat_id',  1623);
                          })
                ->where('flg.cat_id', 1622)
                ->where('fvs.user_id', '=', NULL)
                ->count();
        DB::table('siteoptions')->where('key', 'threestar')->update(['value' => $threetot]);

        
        $fivetot = DB::table('wp_star_rating_status')
                ->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
                ->where('wp_star_rating_status.cat_id', 1623)
                ->count();
        DB::table('siteoptions')->where('key', 'fivestar')->update(['value' => $fivetot]);

        
        $totschool = DB::table('users')->where('role','school')->count();
        DB::table('siteoptions')->where('key', 'totalschools')->update(['value' => $totschool]);
        
        
        DB::table('siteoptions')->where('key', 'flagupdateOn')->update(['value' => date('Y-m-d')]);
        
        
        
                
    }
}
