<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('user/create', [App\Http\Controllers\Api\UserController::class,'store']);
Route::post('user/login', [App\Http\Controllers\Api\UserController::class,'login']);

//Route::group(['middleware' => 'auth'], function () {

    Route::post('user/logout', [App\Http\Controllers\Api\UserController::class, 'logout']);
    Route::post('user/profile', [App\Http\Controllers\Api\UserController::class, 'userProfile']);
    Route::post('user/update', [App\Http\Controllers\Api\UserController::class, 'update']);
    Route::post('user/update_new', [App\Http\Controllers\Api\UserController::class, 'update_new']);
    Route::post('user/set_fitness_score', [App\Http\Controllers\Api\UserController::class, 'setFitnessScore']);
//Check User Exist
    Route::post('user/check', [App\Http\Controllers\Api\UserController::class, 'check']);

//Current Logged in User
    Route::post('user/current', [App\Http\Controllers\Api\UserController::class,'getAuthUser']);

//Sleep Module
 	Route::post('sleep/addsleep', [App\Http\Controllers\Api\SleepController::class,'store']);
	Route::get('sleep', [App\Http\Controllers\Api\SleepController::class,'index']);
	Route::post('sleep/updategoal', [App\Http\Controllers\Api\SleepController::class,'goal']);

//Water
	Route::post('water/addwater', [App\Http\Controllers\Api\WaterController::class,'store']);
	Route::get('water', [App\Http\Controllers\Api\WaterController::class,'index']);
	Route::post('water/updategoal', [App\Http\Controllers\Api\WaterController::class,'goal']);

//Steps
	Route::post('step/addstep', [App\Http\Controllers\Api\StepController::class,'store']);
	Route::get('step', [App\Http\Controllers\Api\StepController::class,'index']);
	Route::post('step/updategoal', [App\Http\Controllers\Api\StepController::class,'goal']);

//tips
	Route::get('tips', [App\Http\Controllers\Api\TipsController::class,'index']);
	Route::get('foodchart', [App\Http\Controllers\Api\FoodChartController::class,'index']);

	Route::get('foodname', [App\Http\Controllers\Api\FoodChartController::class,'foodname']);
	Route::get('servingquantity', [App\Http\Controllers\Api\FoodChartController::class,'servingquantity']);


//
	Route::get('location', [App\Http\Controllers\Api\LocationController::class,'index']);

	Route::post('food/calorieintake', [App\Http\Controllers\Api\FoodChartController::class,'calorieintake']);
	Route::get('getcalorieintake', [App\Http\Controllers\Api\FoodChartController::class,'calorieintakeget']);
	Route::delete('food/deletecalorieintake',[App\Http\Controllers\Api\FoodChartController::class,'destroy']);

//});

/********************************Nagendra Kumar**************************************/

Route::post('send_password_link', [App\Http\Controllers\Api\PasswordResetRequestController::class,'sendEmail']);
Route::post('verify_password_otp', [App\Http\Controllers\Api\PasswordResetRequestController::class,'verifypasswordotp']);
Route::post('update_password', [App\Http\Controllers\Api\ChanagePasswordController::class,'updatePassword']);

Route::post('verify_user_email', [App\Http\Controllers\Api\UserVerify::class, 'verify_user_email']);

Route::post('verifyingemail', [App\Http\Controllers\Api\UserVerify::class, 'verifyuser']);
//Route::post('geteventarchive', [App\Http\Controllers\Api\EventArchiveController::class, 'eventarchive']);
//Route::post('geteventarchive', [App\Http\Controllers\Api\UserVerify::class, 'eventarchive']);
Route::post('geteventarchive', [App\Http\Controllers\Api\EventArchiveController::class, 'eventarchive']);
Route::post('geteventarchivev1', [App\Http\Controllers\Api\EventArchiveController::class, 'eventarchivevone']);

Route::post('user/challenge/verifyotp', [App\Http\Controllers\Api\UserVerify::class, 'challange_otp']);

/********************************Nagendra Kumar**************************************/

//Api Route

Route::get('your-stories', [App\Http\Controllers\Api\YourStoriesController::class, 'yourstory']);
Route::get('share-your-story', [App\Http\Controllers\Api\YourStoriesController::class, 'sharestory']);

Route::get('get-active', [App\Http\Controllers\Api\GetActiveController::class, 'getactive']);
Route::get('media', [App\Http\Controllers\Api\MediaController::class, 'media']);
Route::get('fit-india-school', [App\Http\Controllers\Api\FitindiaSchoolController::class,'fitindiaschool']);
Route::get('fit-india-school-registration', [App\Http\Controllers\Api\FitindiaSchoolController::class, 'fitindscreg']);
Route::get('create-event', [App\Http\Controllers\Api\FitindiaSchoolController::class, 'createevent']);
Route::get('my-events', [App\Http\Controllers\Api\FitindiaSchoolController::class, 'myevent']);
Route::get('fit-india-school-certification', [App\Http\Controllers\Api\FitindiaSchoolController::class, 'fitindiacertification']);

//Events Api Route



Route::get('fit-india-school-week-2020', [App\Http\Controllers\Api\FitindSch2020Controller::class, 'fitindsch2020']);
Route::get('fit-india-cyclothon-2020', [App\Http\Controllers\Api\FitindSch2020Controller::class, 'fitindCyclothon2020']);

Route::get('fit-india-prabhatpheri-2020', [App\Http\Controllers\Api\FitindSch2020Controller::class, 'fitindPrabhatpheri2020']);
Route::post('user/profilepic', [App\Http\Controllers\Api\ProfileController::class, 'profilepic']);
Route::get('user-certificate-event-sunday/{user_id}', [App\Http\Controllers\Api\ProfileController::class, 'user_certificate_event_sunday']);
// Route::get('user-certificate-event-sunday/{user_id}/{event_id}',[App\Http\Controllers\Auth\EventCatController::class, 'user_certificate_event_sunday'])->name('usercertificateeventsunday');

Route::post('user/getuseremail', [App\Http\Controllers\Api\UserController::class, 'useremail']);
Route::post('user/check_status_gm_local', [App\Http\Controllers\Api\ProfileController::class,'checkStatusGmOrLb']);
Route::post('user/schoolauth', [App\Http\Controllers\Api\SchoolCertificationController::class, 'schoolauth']);
Route::post('user/check_status_youthclub', [App\Http\Controllers\Api\ProfileController::class,'checkStatusYouthClub']);
Route::post('user/check_status_corporate', [App\Http\Controllers\Api\ProfileController::class,'checkStatusCorporate']);

//file_upload_quiz_questions
//remove first row
//Route::post('uploadPklquiz', [App\Http\Controllers\PklQuizController::class, 'uploadPklquiz'])->name('uploadPklquiz');

// dotnet api
Route::post('Signup', [App\Http\Controllers\DotnetsignupController::class, 'signupdotnet'])->name('signupdotnet');
Route::post('RefNo', [App\Http\Controllers\DotnetsignupController::class, 'refnodotnet'])->name('refnodotnet');
Route::post('refnocopy', [App\Http\Controllers\DotnetsignupController::class, 'refnocopy'])->name('refnocopy');
Route::post('dashboard', [App\Http\Controllers\DotnetsignupController::class, 'dashboard'])->name('dashboard');
// tracking image upload
Route::post('trackingpic', [App\Http\Controllers\TrackingController::class, 'trackingpic'])->name('trackingpic');
Route::post('gettrackingpic', [App\Http\Controllers\TrackingController::class, 'gettrackingpic'])->name('gettrackingpic');

Route::post('trackingpic-v1', [App\Http\Controllers\Trackingv1Controller::class, 'trackingpicv1'])->name('trackingpicv1');
Route::post('post-abha-aabhar-image-url', [App\Http\Controllers\Trackingv1Controller::class, 'post_abha_aabhar_image_url'])->name('postabhaaabharimageurl');
Route::post('post-abha-image-url', [App\Http\Controllers\Trackingv1Controller::class, 'postabhaimageurl'])->name('postabhaimageurl');
Route::post('gettrackingpic-v1', [App\Http\Controllers\Trackingv1Controller::class, 'gettrackingpicv1'])->name('gettrackingpicv1');
Route::post('encrypteddata', [App\Http\Controllers\TestingController::class, 'encrypteddata'])->name('encrypteddata');
Route::post('deletedusersbyemail', [App\Http\Controllers\CommontypeController::class, 'deletedusersbyemail'])->name('deletedusersbyemail');
Route::post('get_version', [App\Http\Controllers\CommontypeController::class, 'get_version'])->name('get_version');
Route::post('version_update', [App\Http\Controllers\CommontypeController::class, 'version_update'])->name('version_update');



Route::post('convertmethod', [App\Http\Controllers\CommontypeController::class, 'convertmethod'])->name('convertmethod');
Route::post('post-image-cycle-image', [App\Http\Controllers\CommontypeController::class, 'post_image_cycle_image'])->name('postimagecycleimage');
Route::post('post-image-cycle-image-v2', [App\Http\Controllers\CommontypeController::class, 'post_image_cycle_image_v2'])->name('postimagecycleimagev2');


Route::get('get-post-details-view/{id}/{user_id?}', [App\Http\Controllers\PostsController::class, 'getpostdetailsview'])->name('getpostdetailsview');
Route::get('get-post-details-rss-view/{id}', [App\Http\Controllers\PostsController::class, 'getpostdetailsrssview'])->name('getpostdetailsrssview');
