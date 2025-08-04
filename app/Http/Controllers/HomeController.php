<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\PostCat;
use App\Models\WebsiteBanner;
use App\Models\Post;
use App\Models\Newsletter;

use Illuminate\Support\Facades\Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //echo 'fitindia';
        $participantSumQuery = DB::table('freedomruns')->where('role','organizer')->sum('total_participant');
        $organizerKmSumQuery = DB::table('freedomruns')->where('role','organizer')->sum('total_kms');
        $individualKmSumQuery = DB::table('freedomruns')->where('role','individual')->sum('kmrun');
        $individualCount = DB::table('freedomruns')->where('role','individual')->count();
        $websitebanner = WebsiteBanner::where('status',1)->orderBy('order', 'ASC')->get();
        $newsletter_data = Newsletter::where('status',1)->orderBy('id', 'ASC')->get();
        // dd($newsletter_data);
        $pnt_total = $participantSumQuery+$individualCount;
        $kms_total = $organizerKmSumQuery+$individualKmSumQuery;
        return view('home',compact('pnt_total','kms_total','websitebanner','newsletter_data'));
    }

    public function test()
    {
        $user = User::first();
        return $user->usermeta;
    }

    public function contact()
    {
        return view('contact');
    }
    public function about()
    {
        return view('about');
    }

	public function fidialogue()
    {
        return view('fidialogue');
    }

    public function getactive(Request $request)
    {
        $post_category = PostCat::all();
        $post = Post::all();
        return view('get-active', compact('post_category','post'));
    }

    public function getCategoryPosts(Request $request){

        //dd($request);die;
        if($request->ajax()){
            $cat_id = $request->category_id;
            //dd($cat_id);
            if(empty($cat_id)){
                $cat_name = 'children';
                $post = Post::all();
            } else {
                $post_category = PostCat::find($cat_id);
                $cat_name = $post_category->name;
                $post=DB::table("posts")
                           ->select("*")
                           ->whereRaw("find_in_set('".$cat_name."',post_category)")
                           ->get();
                //dd($post);
            }
            return view('get-category-posts', compact('post','cat_name'));
        }
    }

    public function getActiveDetail($id){
        $post = Post::find($id);
        return view('get-active-details', compact('post'));
    }

public function testing(){

  require_once("test/mail/mail.php");

$from = "noreply.fitindia@gov.in"; // example: testemail@domain.com

$to = "aklaravel@gmail.com"; // example: testemail@domain.com

$subject = "Text from PHP code through HostName";

$msg = "Sample Message Body";

$res = send_mail($from, $to, $subject, $msg);

if($res){
return true;
}
else
{
return false;
}


    //  $otp = 1234;
     // $email = 'aklaravel@gmail.com';
     //   Mail::send('mail.email',['otp' => $otp,'email' => $email],function ($message) {

       //     $message->to('aklaravel@gmail.com')->subject('FIT INDIA Email verification OTP');
      //  });
}


}
