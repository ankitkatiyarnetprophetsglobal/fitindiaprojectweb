<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\EventCat;
use App\Models\CertificationTrackings;
use App\Models\User;
use PDF;

class ProfileController extends Controller
{
    //
	public function profilepic(Request $request){
		// dd("asdfasdfasdf");
		$image = '';
        $year = date("Y/m"); 
		//echo $year;
            
        if(!empty($request->file('image'))){
            $image = $request->file('image')->store( $year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
			if(!empty($image)){
				return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'url'   =>  $image
				),
				200);
			}else{
				
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  400,
					'message'   =>  'Image not uploaded'
				), 400);
			
			}
			
        }
		
		return Response::json(array(
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  'Image not found'
            ), 422);
			
			
	}
	public function checkStatusGmOrLb(){
		$auth_id = $_POST['auth_id'];
		$usersData = DB::table('users')->where('id',$auth_id)->first();
		/*$lb_cert_url = url("/mobile-localbody-certificates?auth_id='".$auth_id."'");
		$gm_cert_url = url("/mobile-grampanchayat-certificates?auth_id'".$auth_id."'");*/
		$lb_cert_url = url("/mobile-localbody-certificates");
		$gm_cert_url = url("/mobile-grampanchayat-certificates");
		if(!empty($usersData)){
			if(!empty($auth_id)){
				$result1 = DB::table('gram_panchayat_ambassador')->where('user_id',$auth_id)->first();
				$result2 = DB::table('local_body_ambassador')->where('user_id',$auth_id)->first();
				$data1='';
				$data2='';

				if(!empty($result1)){
					$data1 = $result1;
				}
				if(!empty($result2)){
					$data2 = $result2;
				}
				return Response::json(array(
						'gm_status' => @$data1?@$data1->status:'-1',
						'lb_status'	=> @$data2?@$data2->status:'-1',
						'lb_code'	=> @$data1?200:400,
						'gm_code'	=> @$data2?200:400,
						'gm_data'   => @$data1?$gm_cert_url:'Link not created',
						'lb_data'   => @$data2?$lb_cert_url:'Link not created'
					), 200);
			}else{
				return Response::json(array(
						'status'    => 'failed',
						'code'      =>  400,
						'data'   => 'Something Wrong'
					), 400);
			}
		}else{
			return Response::json(array(
						'status'    => 'failed',
						'code'      =>  400,
						'data'   => 'User not found'
					), 400);
		}
	} 
	public function checkStatusYouthClub(){
		$auth_id = $_REQUEST['auth_id'];
		$usersData = DB::table('users')->where('id',$auth_id)->first();
		$cert_url = url("/mobile-youthclub-cert");
		if(!empty($auth_id)){
			if(!empty($usersData)){
				$result = DB::table('wp_youth_club_details')->where('user_id',$auth_id)->first();
				if(!empty($result)){
					return Response::json(array(
						'status' => 1,
						'code'	=> 200,
						'data'   => $cert_url,
					), 200);
				}else{
					return Response::json(array(
						'status' => 0,
						'code'	=> 400,
						'data'   => 'Link not created',
					), 400);
				}
			}else{
				return Response::json(array(
						'status'    => 2,
						'code'      =>  400,
						'data'   => 'User not found'
					), 400);
			}
		}else{
			return Response::json(array(
						'status'    => 3,
						'code'      =>  400,
						'data'   => 'Auth id can not be empty'
					), 400);
		}
	}
	public function checkStatusCorporate(){
		try{
			$auth_id = $_REQUEST['auth_id'];
			$usersData = DB::table('users')->where('id',$auth_id)->first();
			$cert_url = url("/mobile-corporate-cert");
			if(!empty($auth_id)){
				if(!empty($usersData)){
					$result = DB::table('corporates')->where('user_id',$auth_id)->first();
					if(!empty($result)){
						return Response::json(array(
							'status' => 1,
							'code'	=> 200,
							'msg'   => 'Form approved',
							'link'	=> $cert_url
						), 200);
					}else{
						return Response::json(array(
							'status' => 0,
							'code'	=> 400,
							'msg'   => 'Please fill the form',
							'link'	=> 'No Link'
						), 400);
					}
				}else{
					return Response::json(array(
							'status'    => 2,
							'code'      =>  400,
							'msg'   => 'User not found',
							'link'	=> 'No Link'
						), 400);
				}
			}else{
				return Response::json(array(
							'status'    => 3,
							'code'      =>  400,
							'msg'   => 'Unauthorized User',
							'link'	=> 'No Link'
						), 400);
			}
		}
		catch(Exception $e) {
  			return Response::json(array(
							'status'    => 0,
							'code'      =>  400,
							'msg'   => $e->getMessage(),
							'link'	=> "No Link"
						), 400);
		}
	}



	public function user_certificate_event_sunday($user_id){ 
        try{

            // dd("user_certificate_event_sunday");
			$active_all_user = User::where([['users.id','=' , $user_id]])->first();            
            
            if (isset($active_all_user)){
                $organiser_name = $active_all_user['name'];
                $certificate_type = "mobile";
                $categories = EventCat::where([['id',13078],['status',2]])->orderBy('id', 'DESC')->first();                  
				$categoriesid = $categories['id'];                
                $certificationtracking = new CertificationTrackings();
                $certificationtracking->user_id = $user_id;                    
                $certificationtracking->name = $organiser_name;                    
                $certificationtracking->user_type = $certificate_type;                    
                $certificationtracking->event_id = $categoriesid;                    
                $certificationtracking->event_name = $categories->name;                    
                $certificationtracking->event_participant_certification_name = null;                    
                $certificationtracking->status = 1;                    
                $certificationtracking->save();
                
                $participant = null;          

                $pdf = PDF::loadView('event.freedom-run-5-event-organizer-certificate',

                        [
                            'name' =>  $organiser_name, 
                            'organizer_certificate' => $categories['organizer_certificate'],
                            'organizer_style_name' => $categories['organizer_style_name']
                        ])->setPaper('a4', 'landscape');
                        $pdf->getDomPDF()->setHttpContext(
                        stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])

                    );                
            
                return $pdf->download($organiser_name.".pdf");                

            }else{

                // return Response::json(array(
                //     'status'    => 'error',
                //     'code'      =>  200,
                //     'message'   =>  'Data not found',
                //     'data'   => null,
                // ), 401);
            }                        
                
        }catch (Exception $e) {

            return abort(404);
        
        }
    }


}
