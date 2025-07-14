<?php

namespace App\Http\Controllers\Socadmin;
use App\Http\Controllers\Controller;
use App\Models\Socinfomaster;
use App\Models\Socmedia;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\Exception;

use Illuminate\Http\Request;


class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    public function dashboard(Request $request){

        // dd("Done 2");
        try {

            $data = '{
                "userData": {
                    "name": "SKIC Nasik",
                    "username": "SKIC_Nasik",
                    "nsrs_id": "SKICA0110MS",
                    "user_id": 2920,
                    "role_id": 82,
                    "role_name": "SKIC (SLKIC)",
                    "isStake_Holder": false,
                    "isSuper_Admin": false,
                    "dashboard": "academy-dashboard",
                    "allowedApps": "1,4,8,11",
                    "redirection": ""
                },
                "profileData": {
                    "fullName": "SKIC Nasik",
                    "designation": "SKIC (SLKIC)",
                    "gender": "N/A",
                    "date_of_birth": null,
                    "profile_photo": null,
                    "sport_id": "5,16",
                    "sport_name": "Swimming,Athletics",
                    "mobileNo": "8080401414",
                    "emailId": "saircmumbai@gmail.com",
                    "fullAddress": ", ",
                    "city": null,
                    "state": "Maharashtra",
                    "pincode": null,
                    "postedLocation": "",
                    "postedSince": null
                },
                "expiryTime": "2025-05-21T11:09:07.7013339+05:30",
                "sessionId": "3b251b2b-2736-491e-b655-f9a5bbd7ee2d",
                "alreadyLoggedIn": false,
                "jwtToken": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJJc3N1ZXIiOiJOJFIkIiwiUm9sZSI6IjgyIiwiZGV0YWlsSWQiOiIyOTIwIiwiaXNTdGFrZUhvbGRlciI6IkZhbHNlIiwidW5pcXVlX25hbWUiOiJTS0lDQTAxMTBNUyIsImV4cCI6MTc0NzgwNTk0NywiaXNzIjoiTiRSJF9CQGNrIiwiYXVkIjoiTiRSJF9GUjBOVCJ9.9MMEsgA3gHLPnPxXeMUPKSqVuJ-5H9D3-8jnopKcl6o"
            }';
            // dd($data);
            $json_data = json_decode($data);
            // dd($json_data->userData);
            // dd($json_data->profileData->fullName);
            $fullName = $json_data->profileData->fullName;

            $request->session()->put('fullName', $fullName);

            return view('kicadmin.home');

        }catch (Exception $e) {

            return abort(404);

        }
        exit;
        // $user = DB::table('users')
		// 		->leftJoin('usermetas','users.id', '=',	'usermetas.user_id')
		// 		->orderBy('users.id','desc')
		// 		->select(['users.id','users.name','users.email','users.role','users.rolelabel','users.phone','usermetas.gender','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at']);
        // $curcount = $user->count();

        // $school_star_query = DB::table('wp_star_rating_status')
		// 		->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
		// 		->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
		// 		->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role','users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'));
        // $school_star_count = $school_star_query->count();

        // return view('kicadmin.home', compact('curcount','school_star_count'));
        // dd($curcount);
        // return view('admin.home');
    }

    public function kicformindex(Request $request){

        try {
            $data_master = Socinfomaster::where('status',1)->orderBy('id', 'DESC')->paginate(10);
            // dd($data_master);
            return view('kicadmin.kicform.index', compact('data_master'));

            // return view('kicadmin.kicform.index');

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function kic_create_form(Request $request){

        try {

            return view('kicadmin.kicform.create');

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function kic_store_form(Request $request){
        //  dd($request->all());
        try {
                $request->validate([
                        'name_center' => 'required',
                        'type_center' => 'required',
                        'location' => 'required',
                        'date' => 'required',
                        'cycling_route_start_date' => 'required',
                        'cycling_route_end_date' => 'required',
                        'number_participants' => 'required',
                        'prt_image' => 'required',
                        'video_link' => 'required',
                        'status' => 'required',
                        /* 'description' => 'required',
                        'doc' => 'required|mimes:doc,xlsx,pdf,jpg,png,jpeg,gif,svg|max:1000000' */
                    ],[
                        'name_center.required' => 'Name of the center field is required.',
                        'type_center.required' => 'Type of center field is required.',
                        'location.required' => 'Location field is required.',
                        'date.required' => 'Date field is required.',
                        'cycling_route_start_date.required' => 'Cycling route start date field is required.',
                        'cycling_route_end_date.required' => 'Cycling route end date field is required.',
                        'number_participants.required' => 'Number Participants field is required.',
                        'prt_image.required' => 'Upload photo field is required.',
                        'video_link.required' => 'Upload video field is required.',
                        'status.required' => 'Status field is required.',

                        /*'description.required' => 'Description field is required.',
                        'doc.required' => 'Please upload attachment file.',
                        'doc.mimes' => 'Please upload doc,xlsx,pdf,jpg,png,jpeg,gif,svg.',
                        'doc.max' => 'Please upload maximum 1000000 size file.', */
                    ]
                );


            $socinfomaster = new Socinfomaster;
			$socinfomaster->name_center = $request->name_center;
			$socinfomaster->type_center = $request->type_center;
			$socinfomaster->location = $request->location;
			$socinfomaster->date = $request->date;
			$socinfomaster->cycling_route_start_from = $request->cycling_route_start_date;
			$socinfomaster->cycling_route_end = $request->cycling_route_end_date;
			$socinfomaster->number_participants = $request->number_participants;
			$socinfomaster->status = 1;
			$socinfomaster->created_name = "ankit katiyar";
			// $socinfomaster->updated_name = $request->mobile;
			$socinfomaster->created_email = "katiyar.ankit93@gmail.com";
			// $socinfomaster->updated_email = $request->mobile;
			$socinfomaster->save();

            if($request->hasfile('prt_image') || $request['video_link']) {

                foreach($request->file('prt_image') as $file){

                    $event_name_store = "soc";
                    $state = "delhi";
                    $name = $file->getClientOriginalName();
                    $name = $file->store($event_name_store.'/'.$state.'/'.'event_image',['disk'=> 'uploads']);
                    $image_name = url('wp-content/uploads/'.$name);

                    $socvideo = new Socmedia;
                    $socvideo->soc_info_id = $socinfomaster->id;
                    $socvideo->photo = $image_name;
                    $socvideo->status = 1;
                    $socvideo->save();
                }
            }

            if($request['video_link']) {

                foreach($request['video_link'] as $videolink){

                    $socvideo = new Socmedia;
                    $socvideo->soc_info_id = $socinfomaster->id;
                    $socvideo->video_link = $videolink;
                    $socvideo->status = 1;
                    $socvideo->save();
                }
            }
            dd("asdfasdfasdf");
            // return view('kicadmin.kicform.create');
            return view('kicadmin.kicform.index');

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function soc_edit_form($id){

        try {
            $id = decrypt($id);
            // dd($id);
            $data_edit = Socinfomaster::
                                        // join('socmedias', 'socmedias.soc_info_id', '=', 'socinfomasters.id')
                                        where([['socinfomasters.status',1],['socinfomasters.id','=',$id]])->orderBy('socinfomasters.id', 'DESC')->first();
            $media_photo_data = Socmedia::where([['socmedias.status',1],['socmedias.soc_info_id','=',$id],['socmedias.photo','!=',""]])->orderBy('socmedias.id', 'DESC')->get();
            $media_video_data = Socmedia::where([['socmedias.status',1],['socmedias.soc_info_id','=',$id],['socmedias.video_link','!=',""]])->orderBy('socmedias.id', 'DESC')->get();

            // dd($media_video_data);
            return view('kicadmin.kicform.socview', ['data_edit' => $data_edit, 'media_photo_data' => $media_photo_data, 'media_video_data' => $media_video_data]);
            // dd($data_edit);

        }catch (Exception $e) {

            return abort(404);

        }
    }

    public function soc_update_form(Request $request){

        try {
            dd($request->all());
            // dd($request['center_id']);
            $photo_update_id = $request['photo_update_id'];
            if (isset($photo_update_id)) {

                $photo_update_id = decrypt($photo_update_id);
                $photo_socmedia_data = Socmedia::where([['socmedias.status',1],['socmedias.id','=',$photo_update_id]])->orderBy('socmedias.id', 'DESC')->first();

                // if($request->hasfile('prt_image') || $request['video_link']) {
                //     $event_name_store = "soc";
                //     $state = "delhi";
                //     $name = $file->getClientOriginalName();
                //     $name = $file->store($event_name_store.'/'.$state.'/'.'event_image',['disk'=> 'uploads']);
                //     $image_name = url('wp-content/uploads/'.$name);
                //     $updated_name = "ankit katiyar";
                //     $updated_email = "ankit.katiyar@netprophetsglobal.com";
                //     // $data_update = Socinfomaster::where('id', $center_id)->update([
                //     //                                                         'location' => $location,
                //     //                                                         'date' => $date,
                //     //                                                         'cycling_route_start_from' => $cycling_route_start_date,
                //     //                                                         'cycling_route_end' => $cycling_route_end_date,
                //     //                                                         'number_participants' => $number_participants,
                //     //                                                         'updated_name' => $updated_name,
                //     //                                                         'updated_email' => $updated_email
                //     //                                                     ]);
                // }
                // dd($photo_socmedia_data);

            }

            $center_id = $request['center_id'];
            $center_id = decrypt($center_id);


            // dd($photo_update_id);
            $location = $request['location'];
            $date = $request['date'];
            $cycling_route_start_date = $request['cycling_route_start_date'];
            $cycling_route_end_date = $request['cycling_route_end_date'];
            $number_participants = $request['number_participants'];
            // dd($number_participants);
            // $center_id = 20;
            // dd($center_id);
            $data_edit = Socinfomaster::where([['socinfomasters.status',1],['socinfomasters.id','=',$center_id]])->orderBy('socinfomasters.id', 'DESC')->first();

            if(isset($data_edit)){

                $updated_name = "ankit katiyar";
                $updated_email = "ankit.katiyar@netprophetsglobal.com";
                $data_update = Socinfomaster::where('id', $center_id)->update([
                                                                        'location' => $location,
                                                                        'date' => $date,
                                                                        'cycling_route_start_from' => $cycling_route_start_date,
                                                                        'cycling_route_end' => $cycling_route_end_date,
                                                                        'number_participants' => $number_participants,
                                                                        'updated_name' => $updated_name,
                                                                        'updated_email' => $updated_email
                                                                    ]);
                $data_master = Socinfomaster::where('status',1)->orderBy('id', 'DESC')->paginate(10);

                // return view('kicadmin.kicform.index', [
                //                                         'data_master' => $data_master,
                //                                         'success' => 'Participants updated successfully'
                //                                     ]);
                return redirect()->route('kicadmin.kicform')->with('success', 'Item successfully created!');

            }

            // $media_photo_data = Socmedia::where([['socmedias.status',1],['socmedias.soc_info_id','=',$id],['socmedias.photo','!=',""]])->orderBy('socmedias.id', 'DESC')->get();
            // $media_video_data = Socmedia::where([['socmedias.status',1],['socmedias.soc_info_id','=',$id],['socmedias.video_link','!=',""]])->orderBy('socmedias.id', 'DESC')->get();

            // dd($media_data);
            // return view('kicadmin.kicform.socview', ['data_edit' => $data_edit, 'media_photo_data' => $media_photo_data, 'media_video_data' => $media_video_data]);
            // dd($data_edit);

        }catch (Exception $e) {

            return abort(404);

        }
    }

}
