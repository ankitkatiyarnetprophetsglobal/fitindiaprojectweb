<?php
namespace App\Http\Controllers\Api;
use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Models\User;
use App\Models\Usermeta;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'create','useremail']]);
    }

	/* public function get_useremail_list(Request $request){
           $messsages = array(
				'mobile.required'=>'Please enter the mobile number.',
				'mobile.numeric'=>'Please enter numeric value.',
		 		'mobile.digits'=>'Please enter min 10 digit number.',
		    );

		 try {

			if(!empty($request->mobile) && is_numeric($request->mobile) && $request->mobile=='0000000000'){

			  return Response::json(array(
					'status' => 'error', 'code'  =>  500, 'data' =>'[]'
				), 500);

			} else if(!empty($request->mobile) && is_numeric($request->mobile) && $request->mobile!='0000000000'){

				$validator = Validator::make( array("mobile" => $request->mobile),['mobile' => 'required|digits:10'],$messsages);

			} else{

				return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'=>'Invalid Input'
				), 422);
			}

			if($validator->fails()){
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  $validator->messages()->first()
				), 422);
			}

			if(!empty($request->mobile)){

			  $archive = User::where('phone','=',$request->mobile)->orderBy('name','ASC')->groupBy('id')->get();
			}

			$event_archive=array();

		    if(!empty($archive)){

			   foreach($archive as $cval){

					 $achdata=array(
						"name" => $cval->name,
					    "email" => $cval->email
					);

				  array_push($event_archive,$achdata);
			    }
			}

			if(!empty($event_archive)){
				  return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'message'   => $event_archive,
				  ), 200);

			} else {

				  return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   => 'Data not found.',
				  ), 404);
			}

		} catch(Exception $e){

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  $e->getmessage()
				), 404);
		}
	} */

    function useremail(Request $request){

		$mobile = $request->mobile;

		$messsages = array(
				'mobile.required'=>'Please enter the mobile number.',
				'mobile.numeric'=>'Please enter numeric value.',
				'mobile.digits'=>'Please enter min 10 digit number.',
		);

		if(!empty($request->mobile) && is_numeric($request->mobile) && $request->mobile=='0000000000'){

		  return Response::json(array(
				'status' => 'error', 'code'  =>  500, 'data' =>'[]'
			), 500);

		} else if(!empty($request->mobile) && is_numeric($request->mobile) && $request->mobile!='0000000000'){

			$validator = Validator::make( array("mobile" => $mobile),['mobile' => 'required|digits:10'],$messsages);

		} else{

			return Response::json(array(
				'status' => 'error', 'code'  =>  422, 'message'=>'Invalid Input'
			), 422);
		}

		if($validator->fails()){
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  $validator->messages()->first()
            ), 422);
        }

		if(is_numeric($mobile)){
		    //$user = User::where('phone', $mobile)->get();
            $user = User::where('phone','=',$request->mobile)->orderBy('name','ASC')->get();
		}

		$marray=array();
		$userdata='';

		if(!empty($user)){
		  foreach($user as $val){
			$userdata=array(
					"name" => $val->name,
					"email" => $val->email
			   );

			  array_push($marray,$userdata);
		    }
		}

        if(!empty($marray)){

		  return Response::json(array(
			'status'    => 'success',
			'code'      =>  200,
			'data'   => $marray,
		  ), 200);

		} else {

		  return Response::json(array(
			'status'    => 'error',
			'code'      =>  422,
			'message'   =>  'User not found'
		   ), 422);
		}
	}

	function check(Request $request){
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

		if ($validator->fails()) {
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  $validator->messages()->first()
            ), 422);

        }

		 $user = User::where('email', $request->email)->first();
		 if($user){

			return Response::json(array(
                'status'    => 'success',
                'code'      =>  200,
                'message'   =>  'User exist with email '.$user->email
            ), 200);
		 }

		return Response::json(array(
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  'User not found'
            ), 422);
	}


	function login(Request $request){

    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  $validator->messages()->first()
            ), 422);

            //return response()->json($validator->errors(), 422);
        }


        if(!$token = auth('api')->attempt($validator->validated())) {

            return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);


            //return response()->json(['error' => 'Unauthorized'], 401);
        }

        return Response::json(array(
            'token' => $this->createNewToken($token),
            'status'    => 'success',
            'code'      =>  200,
            'message'   =>  array('msg'=>'You are successfully logged in')
        ), 200);
	}

	public function getAuthUser(Request $request)
    {
        return response()->json(auth('api')->user());
    }


    function store(Request $request){
        $rules=array(
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:subscriber,school,group' ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:10', 'max:10'],
            'password' => ['required', 'string', 'min:8'],
            //'age' => ['required', 'min:1','max:2' ],
        );

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  400,
                'message'   =>  array('msg'=>$validator->messages()->first())
            ), 400);

            //return $validator->messages()->all();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' =>  $request->role,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        if($user){

            $usermeta = new Usermeta();

            $usermeta->user_id = $user->id;
            if($request->phone) $usermeta->mobile = $request->phone;
            if($request->gender) $usermeta->gender = $request->gender;
            if($request->dob) $usermeta->dob = $request->dob;
            if($request->age) $usermeta->age = $request->age;
            if($request->address) $usermeta->address = $request->address;
            if($request->pincode) $usermeta->pincode = $request->pincode;
            if($request->height) $usermeta->height = $request->height;
            if($request->weight) $usermeta->weight = $request->weight;
            if($request->state) $usermeta->state = $request->state;
            if($request->district) $usermeta->district = $request->district;
            if($request->block) $usermeta->block = $request->block;
            if($request->city) $usermeta->city = $request->city;
            if($request->udise) $usermeta->udise = $request->udise;
            if($request->orgname) $usermeta->orgname = $request->orgname;
            $usermeta->save();
        }


        if($user->id){

			if ( $token = auth('api')->attempt($validator->validated())) {
				//return $this->createNewToken($token);
                $usertoken = $this->createNewToken($token);
			//}

            return Response::json(array(
                'token' => $usertoken,
                'status'    => 'success',
                'code'      =>  200,
                'message'   =>  array('msg'=>'User has been created successfully')
            ), 200);
          }
       }
       //return $user;
    }

   function update(Request $request){

        $user = auth('api')->user();

		//dd($user->id);die();

        if($user){

            $json_data = json_decode($request->json_val,true);

			dd($json_data);die();

            if($json_data==null){
                $json_data = json_decode(base64_decode($request->json_val),true);
            }
            $user = User::find($user->id);
            $user->name = $json_data['name'];
            $user->save();

            $usermeta = Usermeta::where('user_id', $user->id)->first();
            if(!empty($json_data['phone'])) $usermeta->mobile = $json_data['phone'];
            if(!empty($json_data['gender'])) $usermeta->gender = $json_data['gender'];
            if(!empty($json_data['dob'])) $usermeta->dob = $json_data['dob'];
            if(!empty($json_data['age'])) $usermeta->age = $json_data['age'];
            if(!empty($json_data['address'])) $usermeta->address = $json_data['address'];
            if(!empty($json_data['pincode'])) $usermeta->pincode = $json_data['pincode'];
            if(!empty($json_data['height'])) $usermeta->height = $json_data['height'];
            if(!empty($json_data['weight'])) $usermeta->weight = $json_data['weight'];
            if(!empty($json_data['state'])) $usermeta->state = $json_data['state'];
            if(!empty($json_data['district'])) $usermeta->district = $json_data['district'];
            if(!empty($json_data['block'])) $usermeta->block = $json_data['block'];
            if(!empty($json_data['city'])) $usermeta->city = $json_data['city'];
            if(!empty($json_data['udise'])) $usermeta->udise = $json_data['udise'];
            if(!empty($json_data['orgname'])) $usermeta->orgname = $json_data['orgname'];

            $year = date("Y/m");
            if($request->file('profile_pic'))
            {
                $imageName1 = $request->file('profile_pic')->store($year,['disk'=> 'uploads']);
                $imageName1 = url('wp-content/uploads/'.$imageName1);
                $usermeta->image = $imageName1;
            }

            $usermeta->save();
            if($user->id){

				$data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)->get(['users.id','users.role','users.name', 'users.email', 'users.phone', 'usermetas.*']);
				return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'user'   =>  $data
					 ), 200);

                return Response::json(array(
                    'status'    => 'success',
                    'code'      =>  200,
                    'message'   =>  array('msg'=>'User has been updated successfully')
                ), 200);
            }
        }else{
             return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }
    }
     function update_new(Request $request){
        $user = auth('api')->user();
        if($user){


            $json_data = json_decode($request->json_val,true);
            $user = User::find($json_data['id']);
            $user->name = $json_data['name'];
            $user->save();

            $usermeta = Usermeta::where('user_id', $json_data['id'])->first();
            if(!empty($json_data['phone'])) $usermeta->mobile = $json_data['phone'];
            if(!empty($json_data['gender'])) $usermeta->gender = $json_data['gender'];
            if(!empty($json_data['dob'])) $usermeta->dob = $json_data['dob'];
            if(!empty($json_data['age'])) $usermeta->age = $json_data['age'];
            if(!empty($json_data['address'])) $usermeta->address = $json_data['address'];
            if(!empty($json_data['pincode'])) $usermeta->pincode = $json_data['pincode'];
            if(!empty($json_data['height'])) $usermeta->height = $json_data['height'];
            if(!empty($json_data['weight'])) $usermeta->weight = $json_data['weight'];
            if(!empty($json_data['state'])) $usermeta->state = $json_data['state'];
            if(!empty($json_data['district'])) $usermeta->district = $json_data['district'];
            if(!empty($json_data['block'])) $usermeta->block = $json_data['block'];
            if(!empty($json_data['city'])) $usermeta->city = $json_data['city'];
            if(!empty($json_data['udise'])) $usermeta->udise = $json_data['udise'];
            if(!empty($json_data['orgname'])) $usermeta->orgname = $json_data['orgname'];

            $year = date("Y/m");
            if($request->file('profile_pic'))
            {
                $imageName1 = $request->file('profile_pic')->store($year,['disk'=> 'uploads']);
                $imageName1 = url('wp-content/uploads/'.$imageName1);
                $usermeta->image = $imageName1;
            }

            $usermeta->save();
            if($user->id){

				$data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)->get(['users.id','users.role','users.name', 'users.email', 'users.phone', 'usermetas.*']);
				return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'user'   =>  $data
					 ),
					 200
				 );


            }
        }else{
             return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }
    }




	public function logout() {
       $logout = auth('api')->logout();

       return Response::json(array(
        'status'    => 'success',
        'code'      =>  200,
        'message'   =>  'User successfully signed out'
        ), 200);



       // return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile(Request $request) {

       // return response()->json(auth('api')->user());
        $user = auth('api')->user();

        if($user){

            $data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)
              ->get(['users.id','users.role','users.name', 'users.email', 'users.phone', 'usermetas.*']);
            return Response::json(array(
                'status'    => 'success',
                'code'      =>  200,
                'user'   =>  $data
                 ), 200);

        }else{
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){

        $user = auth('api')->user();

		$data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)
		->get(['users.id', 'users.role', 'users.name', 'users.email', 'users.phone', 'usermetas.user_id', 'usermetas.dob', 'usermetas.age', 'usermetas.gender', 'usermetas.address', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'usermetas.city', 'usermetas.orgname', 'usermetas.udise', 'usermetas.pincode', 'usermetas.height', 'usermetas.weight', 'usermetas.image', 'usermetas.board',
		'usermetas.created_at', 'usermetas.updated_at' ]);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            //'user' => auth('api')->user()->usermeta()
            'user' => $data
        ]);
    }

    public function setFitnessScore(Request $request){
		try{
			$user = auth('api')->user();
				if($user->id){
					$validator =  Validator::make($request->all(),[
				    'user_id' => 'required|numeric',
				    'user_email' => 'required|email',
				    'score' => 'required|numeric',
				    ]);
				    if($validator->fails()){
				        return Response::json(array(
									'status'    => 'failed',
									'code'      =>  422,
									'msg'   => $validator->errors()
								), 422);
				    }
					$user_id = $request->user_id;
					$user_email = $request->user_email;
					$score = $request->score?$request->score:0;
					$created_at = date('Y-m-d H:i:s');
					$updated_at = date('Y-m-d H:i:s');
					$values = array('user_id' => $user_id, 'user_email' => $user_email, 'fitness_score' => $score, 'created_at'=>$created_at, 'updated_at'=>$updated_at);
					$scoredata = DB::table('fitness_score')->updateOrInsert(['user_id'=>$user_id], $values);
					if(isset($scoredata)){
						return Response::json(array(
							'status'    => 'success',
							'code'      =>  200,
							'msg'   => 'Score Updated'
						), 200);

					}else{
						return Response::json(array(
							'status'    => 'error',
							'code'      =>  401,
							'msg'   => 'Some technical issue'
						), 401);
					}
				}else{
					return Response::json(array(
							'status'    => 'error',
							'code'      =>  401,
							'data'   => 'Unauthorize User'
						), 401);
				}

		} catch (\Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'data'   => $e->getMessage()
				), 401);
        }
	}
}
