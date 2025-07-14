<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userleaderboardimages;



class UserimagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if($request->input('search')=='search' && $request->input('searchuserimage') != null){

            $searchuserimage = $request->input('searchuserimage');

            if(is_numeric($searchuserimage) == true){

                $filed_name = 'users.phone';

            }else{

                $filed_name = 'users.name';
            }

            $userimagedate = Userleaderboardimages::
                                                join('users', 'users.id', '=', 'user_leaderboard_images.user_id')
                                                // ->where($filed_name, "=", $searchuserimage)
                                                ->where($filed_name, "like", '%'.$searchuserimage.'%')
                                                ->select(
                                                        'user_leaderboard_images.id as user_leaderboard_images_id',
                                                        'users.id as usersid',
                                                        'users.name as usersname',
                                                        'users.phone as phone',
                                                        'user_leaderboard_images.user_cycle_image as user_cycle_image',
                                                        'user_leaderboard_images.status as status'
                                                        )
                                                ->orderBy('user_leaderboard_images.id','desc')
                                                ->paginate(10);
            // dd($userimagedate);
        }else{

            $userimagedate = Userleaderboardimages::
                                                join('users', 'users.id', '=', 'user_leaderboard_images.user_id')
                                                ->select(
                                                        'user_leaderboard_images.id as user_leaderboard_images_id',
                                                        'users.id as usersid',
                                                        'users.name as usersname',
                                                        'users.phone as phone',
                                                        'user_leaderboard_images.user_cycle_image as user_cycle_image',
                                                        'user_leaderboard_images.status as status'
                                                        )
                                                ->orderBy('user_leaderboard_images.id','desc')
                                                // ->get();
                                                ->paginate(10);
            $searchuserimage = '';
        }
        // dd($userimagedate);
		$userimagedate_count = count($userimagedate);
        return view('admin.userimagedate.index',compact('userimagedate_count','userimagedate','searchuserimage'));
    }

    public function userimagedeactive($id)
    {
        try{

            $id = decrypt($id);

            $userimagedate = Userleaderboardimages::
                                                join('users', 'users.id', '=', 'user_leaderboard_images.user_id')
                                                ->select(
                                                        'user_leaderboard_images.id as user_leaderboard_images_id',
                                                        'users.id as usersid',
                                                        'users.name as usersname',
                                                        'users.phone as phone',
                                                        'user_leaderboard_images.user_cycle_image as user_cycle_image',
                                                        'user_leaderboard_images.status as status'
                                                        )
                ->where([['status', '=' ,0],['user_leaderboard_images.id','=',$id]])->first();
            // if(count($userimagedate) > 0){
            if(isset($userimagedate)){
                $id = $userimagedate['user_leaderboard_images_id'];
                $update_query = Userleaderboardimages::where([
                                                                ['id', '=', $id],
                                                            ])
                                                            ->update([
                                                                'status' => 1
                                                            ]);
                return redirect()->back()->withSuccess('Successfully updated');
                // dd($userimagedate);

            }else{
                return abort(404);
            }
            return view('admin.announcement.create');
        } catch(Exception $e) {

            // dd($e->getMessage());
            return abort(404);
        }
    }

    public function userimageactive($id)
    {
        try{

            $id = decrypt($id);

            $userimagedate = Userleaderboardimages::
                                                join('users', 'users.id', '=', 'user_leaderboard_images.user_id')
                                                ->select(
                                                        'user_leaderboard_images.id as user_leaderboard_images_id',
                                                        'users.id as usersid',
                                                        'users.name as usersname',
                                                        'users.phone as phone',
                                                        'user_leaderboard_images.user_cycle_image as user_cycle_image',
                                                        'user_leaderboard_images.status as status'
                                                        )
                                                ->where([['status', '=' ,1],['user_leaderboard_images.id','=',$id]])->first();
            // if(count($userimagedate) > 0){
            if(isset($userimagedate)){
                $id = $userimagedate['user_leaderboard_images_id'];
                $update_query = Userleaderboardimages::where([
                                                                ['id', '=', $id],
                                                            ])
                                                            ->update([
                                                                'status' => 0
                                                            ]);
                return redirect()->back()->withSuccess('Successfully updated');
                // dd($userimagedate);

            }else{
                return abort(404);
            }

        } catch(Exception $e) {

            // dd($e->getMessage());
            return abort(404);
        }
    }
}
