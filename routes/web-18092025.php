<?php
/*use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\StateController;
use App\Http\Controllers\Admin\Auth\DistrictController;
use App\Http\Controllers\Admin\Auth\BlockController;
//use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\EventController;*/
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\StateController;
use App\Http\Controllers\Admin\Auth\DistrictController;
use App\Http\Controllers\Admin\Auth\BlockController;
use App\Http\Controllers\Admin\Auth\UserController;
use App\Http\Controllers\Admin\Auth\EventController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\FoodChartController;
use App\Http\Controllers\Admin\Auth\SleepChartController;
use App\Http\Controllers\Admin\Auth\EventCatController;
use App\Http\Controllers\Admin\Auth\EventArchiveController;
use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\ChampionController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\SendmailController;
use App\Http\Controllers\Admin\Auth\AmbsController;
use App\Http\Controllers\Admin\Auth\ChampController;
use App\Http\Controllers\Admin\Auth\PostController;
use App\Http\Controllers\Admin\Auth\SoceventController;
use App\Http\Controllers\Admin\Auth\MaganageDashboardController ;
use App\Http\Controllers\Admin\Auth\MaganageImageStatusController ;
use App\Http\Controllers\Admin\Auth\PostCatController;
use App\Http\Controllers\Admin\Auth\FoodnameController;
use App\Http\Controllers\Admin\Auth\FoodquantityController;
use App\Http\Controllers\Admin\Auth\StarratingstatusController;
use App\Http\Controllers\Admin\Auth\AnnouncementsController;
use App\Http\Controllers\Admin\Auth\BulletinController;
use App\Http\Controllers\Admin\Auth\UserimagesController;
use App\Http\Controllers\Api\YourStoriesController;
use App\Http\Controllers\PasswordresetController;
use App\Http\Controllers\FitnessquizController;
use App\Http\Controllers\fitindiaquizresultdata;
/******************nagendra ********************************/
use App\Http\Controllers\LocalizationController;
/******************nagendra ********************************/

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\ChanagePasswordController;
use App\Http\Controllers\Admin\Auth\YouthController;


use App\Http\Controllers\Admin\Auth\QuizController;
use App\Http\Controllers\Admin\Auth\QuizWinnerController;
use App\Http\Controllers\Admin\Auth\QuizOrgController;
use App\Http\Controllers\Admin\Auth\PrkController;
use App\Http\Controllers\Admin\Auth\FitEnthController;
use App\Http\Controllers\Admin\Auth\FreedomrunbackendController;
use App\Http\Controllers\Admin\Auth\CorporatebackendController;
use App\Http\Controllers\Admin\Auth\WebrewardController;
use App\Http\Controllers\FitindiaDotNetController;
use App\Http\Controllers\FitindiaDotNetreportController;
use App\Http\Controllers\RssController;
use App\Http\Middleware\XSSprotect;
use App\Http\Controllers\Auth\SchoolController;
use App\Http\Controllers\Admin\WebsiteQuickChageController;


use App\Http\Controllers\WebNotificationController;
use App\Http\Controllers\Admin\Auth\PushNotificationController;

/* Use for Quiz master */
use App\Http\Controllers\Admin\Auth\QuizMaster\QuizCategoryController;
use App\Http\Controllers\Admin\Auth\QuizMaster\QuizTitleController;
use App\Http\Controllers\Admin\Auth\QuizMaster\QuizQuestionController;
use App\Http\Controllers\Admin\Auth\QuizMaster\AppVersionController;
use App\Http\Controllers\Admin\Auth\QuizMaster\AppBannerController;
use App\Http\Controllers\Admin\Auth\QuizMaster\SocEventMasterController;
use App\Http\Controllers\Admin\Auth\QuizMaster\QueryExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('testing',[App\Http\Controllers\HomeController::class,'testing']);
//Route::get('/', function () {    return view('welcome'); });

Route::group(['middleware' => ['xssprotect']], function () {
    Auth::routes();
});
Route::get('/clear-cache-all', function() {
    Artisan::call('config:clear');
    // Artisan::call('cache:clear');
    dd("Cache Clear All");
});

Route::get('/clear-view-cache', function() {
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('cache:clear');
    return 'View cache has jut been removed';
});

Route::get('/fitindia-site-down-site-sal-46mkeB8yaQZ7Lego7nRo', function() {
    $exitCode = Artisan::call('down');
    return 'down';
});
Route::get('/fitindia-site-up-site-sal-Pk9tpVWSYUsJTqUhDTN7', function() {
    Artisan::call('up');
    return 'up';
});
Route::post('/verify-otp', [App\Http\Controllers\Auth\LoginController::class, 'verifyOTP'])->name('verify-otp');
Route::post('/resend-otp', [App\Http\Controllers\Auth\LoginController::class, 'resendOTP'])->name('resend-otp');
Route::get('/logout-session', [App\Http\Controllers\Auth\LogoutController::class, 'logoutSession'])->name('logout-session');
/*Route::prefix('admin')->group(function (){
    Route::get('login', [App\Http\Controllers\Auth\Admin\LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Auth\Admin\LoginController::class,'login']);
    Route::get('dashboard', [App\Http\Controllers\Auth\Admin\AdminDashboard::class,'dashboard'])->name('admin.dashboard');
});*/

//Route::post('get-district', [RegisterController::class,'getDistrict'])->name('getdistrict');

//Route::get('update-password/{token?}', [ResetPasswordController::class,'showLinkRequestForm'])->name('showLinkRequestForm');

//Route::get('update-password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

//Route::get('update-password/{token?}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');

Route::get('update-password/{token?}', [ResetPasswordController::class,'showResetForm'])->name('showResetForm');

//Route::get('update-password/{token?}', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('/update_password', [App\Http\Controllers\Api\ChanagePasswordController::class,'updatePassword'])->name('updatePassword');

Route::group(['prefix'=>'admin', 'as'=>'admin.', 'middleware' => 'auth:admin'], function(){
    //freedomrun start
    Route::resource('webreward',WebrewardController::class);
    Route::get('freedomrun_partners',[FreedomrunbackendController::class,'pexport']);
    Route::get('freedomrun_export',[FreedomrunbackendController::class,'export']);
    Route::resource('freedomrun-individual', FreedomrunbackendController::class);
    Route::get('freedomrun-partner', [FreedomrunbackendController::class, 'partner'])->name('partner');
    Route::get('freedomrun-organizer', [FreedomrunbackendController::class, 'organizer'])->name('organizer');
    Route::get('partner-activation/{ambs}/{aid}',[FreedomrunbackendController::class,'partnerActive']);
    Route::post('partner-activation',[FreedomrunbackendController::class,'partnerActive']);
    Route::get('freedomrun-partner/{id}/pedit',[FreedomrunbackendController::class,'partnerEstatus'])->name('freedomrun-partner.pedit');
    Route::delete('freedomrun-partner/{id}/pdestroy',[FreedomrunbackendController::class,'partnerDelete'])->name('freedomrun-partner.pdestroy');
    Route::delete('freedomrun-organizer/{id}/odestroy',[FreedomrunbackendController::class,'organizerDelete'])->name('freedomrun-organizer.odestroy');
    Route::patch('freedomrun-partner/{id}/pupdate',[FreedomrunbackendController::class,'partnerUpstatus'])->name('freedomrun-partner.pupdate');
    Route::get('freedomrun-organizer/{id}/orgedit',[FreedomrunbackendController::class,'organizerEstatus'])->name('freedomrun-organizer.orgedit');
    Route::patch('freedomrun-organizer/{id}/pupdate',[FreedomrunbackendController::class,'organizerUpstatus'])->name('freedomrun-organizer.pupdate');

    Route::delete('partnerDeleteAll',[FreedomrunbackendController::class,'partnerdeleteAll']);
    Route::get('changepassword', [UserController::class, 'resetpassForm'])->name('changepassword');
    Route::post('resetpassword', [UserController::class, 'resetPassword'])->name('resetpassword');

    //End freedom run

    Route::post('prerak-activation',[PrkController::class,'active']);
    Route::get('preraklist', [PrkController::class,'index']);
    Route::get('prerakdetails/{pid}', [PrkController::class,'show']);
    Route::get('prerak_export',[PrkController::class,'exportPrerak']);
    Route::post('influencer-upgrade',[PrkController::class,'influencerUpgrade']);

    Route::post('enthusiast-activation',[FitEnthController::class,'active']);
    Route::get('enthusiastlist', [FitEnthController::class,'index']);
    Route::get('enthusiastdetails/{pid}', [FitEnthController::class,'show']);
    Route::get('enthusiast_export',[FitEnthController::class,'exportEnthusiast']);
    Route::post('fitevent-specialist-upgrade',[FitEnthController::class,'fitnessEventUpgrade']);

    Route::resource('quizs', QuizController::class);
    Route::get('quiz_export',[QuizController::class,'quizExport']);

    Route::resource('quizwinners', QuizWinnerController::class);
    Route::get('quiz_winner_export',[QuizWinnerController::class,'quizwinnerexport']);

    Route::get('quiz-organizers', [QuizOrgController::class, 'index'])->name('quizorganizer');
    Route::get('quiz-organizers-export', [QuizOrgController::class, 'quizorgexport'])->name('quizorganizerexport');

    Route::get('deletequizorg/{id}',[QuizOrgController::class, 'deletequizorg'])->name('deletequizorg');
    Route::resource('eventarchive', EventArchiveController::class);
    Route::resource('bulletin', BulletinController::class);

    Route::get('localbodylist/{id?}',[AmbsController::class, 'localbodyAmbDetail'])->name('localbodyAmbDetail');

    Route::resource('states', StateController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('blocks', BlockController::class);
    Route::resource('users', UserController::class);
    Route::get('user_export',[UserController::class,'userExport']);
    //Route::get('user_pdf',[UserController::class,'createPDF']);
    Route::get('edit-user/{id}',[UserController::class,'editUser']);
    Route::get('user-destroy/{id}',[UserController::class,'destroyUser']);

    Route::post('user-profile-dis',[UserController::class,'userprofileDis'])->name('user-profile-dis');
    Route::post('user-profile-blk',[UserController::class,'userprofileBlk'])->name('user-profile-blk');
    Route::resource('events', EventController::class);
    Route::get('edit-event/{id}',[EventController::class,'editEvent']);
    Route::get('events-show/{id}',[EventController::class,'eventShow']);
    Route::get('event-destroy/{id}',[EventController::class,'destroyEvent']);
    //Route::get('search',[UserController::class,'searchData']);
    Route::get('event_export',[EventController::class,'export']);
    Route::resource('foodcharts', FoodChartController::class);
    Route::resource('sleepcharts', SleepChartController::class);
    Route::resource('eventcats', EventCatController::class);
    Route::get('status/{type}/{id}',[EventCatController::class,'status']);

    Route::resource('ambassadors',AmbsController::class);
    Route::get('ambassador-activation/{ambs}/{aid}',[AmbsController::class,'ambsActive']);
    Route::post('ambassador-activation',[AmbsController::class,'ambsActive']);
    Route::get('ambassador_export',[AmbsController::class,'exportAmbassador']);
    Route::get('panchayatlist',[AmbsController::class,'gramPanchayatAmbassadorList']);
    Route::get('panchayatdetail',[AmbsController::class,'gramPanchayatAmbDetail']);
    /*  Route::post('panchayat-ambassador-list',[AmbsController::class,'gramPanchayatAmbassadorList']);*/


    Route::resource('champions', ChampController::class);
    Route::get('champion_export',[ChampController::class,'exportChamp']);
    Route::get('champ-status/{champ}/{cid}',[ChampController::class,'champStatus']);
    Route::post('champ-status',[ChampController::class,'champStatus']);
    Route::resource('posts', PostController::class);
    Route::resource('socevents', SoceventController::class);
    Route::get('/nemoclub-data', [SoceventController::class, 'nemoclubdata'])->name('nemoclubdata');
    Route::get('/nemoclub/export', [SoceventController::class, 'exportNemoClubData'])->name('admin.nemoclub.export');
    Route::get('socadmin-write', [SoceventController::class, 'socadmin_write'])->name('socadminwrite');
        // 18-08-2025 Index page
    Route::get('soc-report-index', [\App\Http\Controllers\SocReportController::class, 'index'])->name('soc-reports.index');
    Route::get('soc-report-download', [\App\Http\Controllers\SocReportController::class, 'download'])->name('soc-reports.download');

    Route::resource('dashboard-tiles', MaganageDashboardController::class);
    //Images Status Approve
    Route::get('/image_index', [MaganageImageStatusController::class, 'image_index'])->name('image_index');
    Route::post('/image_approve/{id}', [MaganageImageStatusController::class, 'image_approve'])->name('image-approve');
    Route::post('/image_reject/{id}', [MaganageImageStatusController::class, 'image_reject'])->name('image-reject');
    Route::post('/image_status/{id}', [MaganageImageStatusController::class, 'image_updateStatus'])->name('image-status');
    Route::post('/image_bulk_approve', [MaganageImageStatusController::class, 'image_bulkApprove'])->name('image-bulk-approve');
    Route::post('/image_bulk_reject', [MaganageImageStatusController::class, 'image_bulkReject'])->name('image-bulk-reject');
    // End Images Status

    Route::get('socadmin-create-write', [SoceventController::class, 'socadmin_create_write'])->name('socadmin-create-write');
    Route::post('store-soc-admin-user', [SoceventController::class, 'store_soc_admin_user'])->name('storesocadminuser');
    Route::get('destroy-soc-admin-id/{id}', [SoceventController::class, 'destroy_soc_admin_id'])->name('destroysocadminid');
    Route::post('nemoclub-dispatch-status',[SoceventController::class,'nemoclub_dispatch_status']);
    Route::get('send-to-approval/{id}',[PostController::class,'SendToApproval'])->name('SendToApproval');
    Route::get('ready-to-publish/{id}',[PostController::class,'ReadyToPublish'])->name('ReadyToPublish');
    Route::get('post-comment-status/{id}/{commitstatus?}/{postid?}',[PostController::class,'PostCommentStatus'])->name('PostCommentStatus');
    Route::get('rejected/{id}',[PostController::class,'Rejected'])->name('Rejected');
    Route::resource('category', PostCatController::class);
    Route::resource('foodnames', FoodnameController::class);
    Route::resource('servingquantities', FoodquantityController::class);
    Route::get('post_status/{post_status}/{id}',[PostCatController::class,'post_status']);
    Route::resource('starratings', StarratingstatusController::class);

    Route::get('schoolcert_export',[StarratingstatusController::class,'export']);

    Route::get('starrating-certificate/{cat_id}/{user_id}',[StarratingstatusController::class,'starRatingCertificate']);
    Route::get('schoolflag/{cat_id}/{user_id}',[StarratingstatusController::class,'FlagRequest']);
    Route::resource('announcement', AnnouncementsController::class);
    Route::get('announcement/{id}/edit',[AnnouncementsController::class], 'edit');
    Route::get('announcement/{id}/status',[AnnouncementsController::class,'announStatus'])->name('announcement.status');

    Route::resource('userimages', UserimagesController::class);
    Route::get('userimagedeactive/{id}',[UserimagesController::class,'userimagedeactive'])->name('userimagedeactive');
    Route::get('userimageactive/{id}',[UserimagesController::class,'userimageactive'])->name('userimageactive');

    /*******************nagendra********************************/

    Route::resource('youths', YouthController::class);
    Route::get('youths_export',[YouthController::class,'export']);

        Route::post('/getquizpartner', [App\Http\Controllers\Admin\Auth\QuizController::class, 'getquizpartner'])->name('getquizpartner');

    Route::get('/youths/{uid}/{catid}',[App\Http\Controllers\Admin\Auth\YouthController::class,'show'])->name('youths.show');

    Route::resource('corporate', CorporatebackendController::class);
    Route::get('corporatedetail/{cid}',[CorporatebackendController::class,'corporatedetail']);
    Route::get('corporate_export',[CorporatebackendController::class,'export']);
    Route::get('gujarat-events',[EventController::class,'gujaratEvent']);
    Route::resource('pushnotification', PushNotificationController::class);
    Route::get('pushnotefication',[App\Http\Controllers\Admin\Auth\WebNotificationController::class,'pushnotefication']);
    Route::post('sendingwebnotification', [App\Http\Controllers\Admin\Auth\WebNotificationController::class, 'sendingwebnotification'])->name('sendingwebnotification');


    Route::get('quiz-dashboard', function () {
        return view('admin.Quizmaster.quiz_categories.quiz_dashboard');
    })->name('admin.Quizmaster.quiz-categories.quiz_dashboard');
    /* 16-07-2025 Below Routes for daily Dashboard  */
    Route::get('quiz-dashboard', function () {
        return view('admin.Quizmaster.quiz_categories.quiz_dashboard');
    })->name('admin.Quizmaster.quiz-categories.quiz_dashboard');;
    // Quiz Categories 🔹 Quiz Titles 🔹 Quiz Questions
    Route::resource('quiz-categories', QuizCategoryController::class);
    Route::resource('quiz-titles', QuizTitleController::class);
    Route::resource('quiz-questions', QuizQuestionController::class);
    Route::resource('app_versions', AppVersionController::class);
    Route::resource('app_banners', AppBannerController::class);
    Route::resource('soc-events', SocEventMasterController::class);
    Route::post('soc-events-upload', [SocEventMasterController::class,'upload'])->name('socevent.upload');
    Route::get('/query-export', [QueryExportController::class, 'index'])->name('query.form');
    Route::post('/query-export', [QueryExportController::class, 'export'])->name('query.export');
    /* 16-07-2025  End Routes for daily Dashboard  */
});

// Route::get('wp-admin', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm']);

Route::namespace("Admin")->prefix('admin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');
    Route::namespace('Auth')->group(function(){
        Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
        Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.postlogin');
        Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
        // start soc admin download data
        Route::get('/soc-download-event-report', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_event_report'])->name('socadmin.soc_download_event_report');
        Route::get('/soc-download-event-report-data', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_event_report_data'])->name('socadmin.soc_download_event_report_data');
        Route::get('/soc-download-report-both-data', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_report_both_data'])->name('socadmin.soc_download_report_both_data');
        Route::get('/soc-download-report-cycle-return-data', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_report_cycle_return_data'])->name('socadmin.soc_download_report_cycle_return_data');
        Route::get('/soc-download-national-sport-day-2025', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_national_sport_day_2025'])->name('socadmin.soc_download_national_sport_day_2025');
        Route::get('/soc-withparticipantnum-download-nationalsportday2025', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_withparticipantnum_download_nationalsportday2025'])->name('socadmin.soc-withparticipantnum-download-nationalsportday2025');

        // end soc admin download data
    });
});

Route::namespace("socadmin")->prefix('socadmin')->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\Socadmin\HomeController::class, 'dashboard'])->name('socadmin.dashboard');
    Route::get('/kicform', [App\Http\Controllers\Socadmin\HomeController::class, 'kicformindex'])->name('kicadmin.kicform');
    Route::get('/kiccreateform', [App\Http\Controllers\Socadmin\HomeController::class, 'kic_create_form'])->name('kicadmin.kiccreateform');
    Route::POST('/kicformstore', [App\Http\Controllers\Socadmin\HomeController::class, 'kic_store_form'])->name('kicadmin.kicstoreform');
    Route::get('/kicformedit/{id}', [App\Http\Controllers\Socadmin\HomeController::class, 'soc_edit_form'])->name('kicadmin.socstoreedit');
    Route::POST('/kicformupdate', [App\Http\Controllers\Socadmin\HomeController::class, 'soc_update_form'])->name('kicadmin.kicupdateform');
    Route::get('/soc-download-event-report', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_event_report'])->name('socadmin.soc_download_event_report');
    Route::get('/soc-download-event-report-data', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_event_report_data'])->name('socadmin.soc_download_event_report_data');
    Route::get('/soc-download-report-both-data', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_report_both_data'])->name('socadmin.soc_download_report_both_data');
    Route::get('/soc-download-report-cycle-return-data', [App\Http\Controllers\Socadmin\DownloadSocController::class, 'soc_download_report_cycle_return_data'])->name('socadmin.soc_download_report_cycle_return_data');

});

//Route::get('edit-profile/{id}', [App\Http\Controllers\Auth\UserController::class, 'editProfile']);
Route::get('edit-profile', [App\Http\Controllers\Auth\UserController::class, 'editProfile']);
Route::put('update-profile/{id}', [App\Http\Controllers\Auth\UserController::class, 'update']);
//Route::get('school-profile/{id}', [App\Http\Controllers\Auth\UserController::class, 'schoolProfile']);
Route::get('school-profile', [App\Http\Controllers\Auth\UserController::class, 'schoolProfile']);
Route::get('edit-school-password', [App\Http\Controllers\Auth\UserController::class, 'edit_school_password']);
Route::post('update-school-password', [App\Http\Controllers\Auth\UserController::class, 'update_school_password']);
Route::put('update-school/{id}', [App\Http\Controllers\Auth\UserController::class, 'updateSchool']);
Route::post('profile-dis', [App\Http\Controllers\Auth\UserController::class,'profileDis'])->name('profile-dis');
Route::post('profile-blk', [App\Http\Controllers\Auth\UserController::class,'profileBlk'])->name('profile-blk');
//UserRegistrationOperation

/*******************nagendra********************************/
Route::post('/getyouthsdistrict', [App\Http\Controllers\Admin\Auth\YouthController::class, 'getyouthsdistrict'])->name('getyouthsdistrict');
Route::post('/getyouthsblock', [App\Http\Controllers\Admin\Auth\YouthController::class, 'getyouthsblock'])->name('getyouthsblock');
/**********************************************/

Route::post('get-district', [RegisterController::class,'getDistrict'])->name('getdistrict');
Route::post('get-block', [RegisterController::class,'getBlock'])->name('getblock');

//User Account
// Route::get('/dashboard', [App\Http\Controllers\Auth\UserController::class, 'index'])->name('dashboard');

//User Event
// Route::get('/create-event', [App\Http\Controllers\Auth\EventController::class, 'createevent'])->name('create-event');
Route::get('/my-events', [App\Http\Controllers\Auth\EventController::class, 'myevents'])->name('my-events');
Route::get('/my-events/{id}', [App\Http\Controllers\Auth\EventController::class, 'myEventsByYear']);
Route::post('/create-event', [App\Http\Controllers\Auth\EventController::class, 'storeevent'])->name('store-event');
Route::get('/eventedit/{id}',[App\Http\Controllers\Auth\EventController::class, 'edit'])->name('eventedit');
Route::post('/updateevent',[App\Http\Controllers\Auth\EventController::class, 'updateevent'])->name('updateevent');
Route::get('school-quiz', [App\Http\Controllers\Auth\EventController::class, 'schoolQuiz'])->name('school-quiz');
Route::post('save-quiz', [App\Http\Controllers\Auth\EventController::class, 'saveQuiz'])->name('save-quiz');

Route::delete('eventdestroy/{id}',[App\Http\Controllers\Auth\EventController::class, 'eventdestroy'])->name('eventdestroy');
Route::get('/eventspic',[App\Http\Controllers\Auth\EventController::class, 'eventspic'])->name('eventspic');
Route::get('/eventspic/{id}',[App\Http\Controllers\Auth\EventController::class, 'eventsPicByYear']);
Route::get('/my-status',[App\Http\Controllers\Auth\EventController::class, 'myApplicationStatus'])->name('my-status');

// cms
Route::get('/cms-listview', [App\Http\Controllers\Auth\CmsController::class, 'cmslistview'])->name('cms-listview');


//brij
Route::post('get_reward_userdetail',[WebrewardController::class,'getuserdetail'])->name('get_reward_userdetail');
Route::post('update_reward_status',[WebrewardController::class,'update_status'])->name('update_reward_status');

// Shakti
Route::get('/event-e-cert/{id}',[App\Http\Controllers\Auth\EventController::class, 'eventEcert'])->name('event-e-cert');
Route::post('/download-e-cert',[App\Http\Controllers\Auth\EventController::class, 'dwldEcert'])->name('download-e-cert');
Route::get('/add-participant/{id}',[App\Http\Controllers\Auth\EventController::class, 'addParticipant'])->name('add-participant');
Route::post('/updatparticipant',[App\Http\Controllers\Auth\EventController::class, 'updateParticipant'])->name('updatparticipant');

// Shakti End

//Mobile Event Controller
//User Event
Route::get('/mobile-create-event', [App\Http\Controllers\Auth\MobileEventController::class, 'createevent'])->name('mobile-create-event');
Route::get('/mobile-my-events', [App\Http\Controllers\Auth\MobileEventController::class, 'myevents'])->name('mobile-my-events');
Route::get('/mobile-my-events/{id}', [App\Http\Controllers\Auth\MobileEventController::class, 'myEventsByYear']);
Route::post('/mobile-create-event', [App\Http\Controllers\Auth\MobileEventController::class, 'storeevent'])->name('mobile-store-event');
Route::get('/mobile-eventedit/{id}',[App\Http\Controllers\Auth\MobileEventController::class, 'edit'])->name('mobile-eventedit');
Route::post('/mobile-updateevent',[App\Http\Controllers\Auth\MobileEventController::class, 'updateevent'])->name('mobile-updateevent');
/*Route::get('school-quiz', [App\Http\Controllers\Auth\MobileEventController::class, 'schoolQuiz'])->name('school-quiz');
Route::post('save-quiz', [App\Http\Controllers\Auth\MobileEventController::class, 'saveQuiz'])->name('save-quiz');
*/

Route::delete('mobile-eventdestroy/{id}',[App\Http\Controllers\Auth\MobileEventController::class, 'eventdestroy'])->name('mobile-eventdestroy');
Route::get('/mobile-eventspic',[App\Http\Controllers\Auth\MobileEventController::class, 'eventspic'])->name('mobile-eventspic');
Route::get('/mobile-eventspic/{id}',[App\Http\Controllers\Auth\MobileEventController::class, 'eventsPicByYear']);
Route::get('/mobile-my-status',[App\Http\Controllers\Auth\MobileEventController::class, 'myApplicationStatus'])->name('mobile-my-status');

Route::get('/mobile-event-e-cert/{id}',[App\Http\Controllers\Auth\MobileEventController::class, 'eventEcert'])->name('mobile-event-e-cert');
Route::post('/mobile-download-e-cert',[App\Http\Controllers\Auth\MobileEventController::class, 'dwldEcert'])->name('mobile-download-e-cert');
Route::get('/mobile-add-participant/{id}',[App\Http\Controllers\Auth\MobileEventController::class, 'addParticipant'])->name('mobile-add-participant');
Route::post('/mobile-updatparticipant',[App\Http\Controllers\Auth\MobileEventController::class, 'updateParticipant'])->name('mobile-updatparticipant');
// End Mobile Event Controller

//Ambassador
Route::post('ambs-district', [AmbassadorController::class,'AmbsDistrict'])->name('ambsdistrict');
Route::post('ambs-block', [AmbassadorController::class,'AmbsBlock'])->name('ambsblock');
Route::post('ambs-store',[AmbassadorController::class,'AmbdStore'])->name('ambs-store');

//Champion
Route::post('champ-district', [ChampionController::class,'ChampDistrict'])->name('champdistrict');
Route::post('champ-block', [ChampionController::class,'ChampBlock'])->name('champblock');
Route::post('champ-store',[ChampionController::class,'ChampStore'])->name('champ-store');
//Ambassodar
Route::resource('ambassador', AmbassadorController::class);
//Champion
Route::resource('champion', ChampionController::class);
//parner
// shakti start
Route::resource('become-partner', PartnerController::class);
//shakti end



Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
//Static Pages
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact-us');

Route::view('/terms-conditions','terms_condition')->name('termConditions');
Route::view('/privacypolicy','privacy_policy')->name('privacyPolicy');
/*Get Active Route*/
Route::get('/get-active', [App\Http\Controllers\HomeController::class, 'getactive'])->name('getactive');
Route::get('/get-active/{id}', [App\Http\Controllers\HomeController::class, 'getActiveDetail'])->name('getactivedetail');
Route::get('/get-category-posts', [App\Http\Controllers\HomeController::class, 'getCategoryPosts'])->name('getcatposts');

//share-your-story
Route::get('/fit-india-dialogue', [App\Http\Controllers\HomeController::class, 'fidialogue'])->name('fit-india-dialogue');
Route::post('share-your-story', [App\Http\Controllers\Api\YourStoriesController::class, 'storeyourstory'])->name('sharestory.store');

Route::get('/api-share-your-story', [App\Http\Controllers\Api\YourStoriesController::class, 'apishareyourstory'])->name('apishareyourstory');

Route::post('/api-share-your-story', [App\Http\Controllers\Api\YourStoriesController::class, 'apistoreYourstory'])->name('apistoreYourstory');


Route::get('/share-your-story', [App\Http\Controllers\Api\YourStoriesController::class, 'sharestory']);
Route::post('/storeyourstory', [App\Http\Controllers\Api\YourStoriesController::class, 'storeYourstory'])->name('storeyourstory');


Route::get('/sendemail',[SendmailController::class,'sendemail'])->name('sendemail');

/****************************Priyanshi*********************************/
/****************************Menu Route********************************/
// women week for bicycle day
// Route::view('world-bicycle-day', 'women_week_bicycle_day');
// National Sports day
// Route::view('national-sports-day-2022', 'national-sports-day');
Route::view('national-sports-day-2023', 'nationalsportsday2023');
// Route::view('national-sports-day-2025', 'nationalsportsday2025');
Route::view('national-sports-day-merchandise-creatives-2025','nationalsportsdaymerchandisecreatives2025');
Route::view('past-glimpses-2025', 'pastglimpses2025');
Route::view('fit-india-pledge-2025', 'fitindiapledgeview2025');
Route::view('fit-india-week-2023', 'fitindiaweek2023');
Route::view('fit-india-week-2024', 'fitindiaweek2024');
Route::view('fit-india-women-week', 'internationalwomen');
// Route::view('cyclothon-2024', 'cyclothon2024');
// Route::view('fit-india-cycling-drive', 'cyclothon2024');
Route::view('errorfitindia', 'severdownpage');
Route::view('cyclothon-report-2024', 'cyclothonreport2024'); // Report execl
// Route::view('fit-india-women-week', 'fitindiawomenweek');
Route::view('national-sports-day-2024', 'nationalsportsday2024');
Route::view('past-glimpses-2023', 'pastglimpses2023');
Route::view('past-glimpses-2024', 'pastglimpses2024');
Route::view('fiw-past-glimpses-2024', 'fiwpastglimpses2024');
Route::view('fit-india-Weekpast-glimpses-2024', 'fitindiaWeekpastglimpses2024');
Route::view('register-for-fit-india-2023', 'registerforfitindia2023');
Route::view('fit-india-week-report-2023', 'fitindiaweekreport2023'); // Report execl
Route::view('cyclothon-2024', 'cyclothonreport2024'); // Report execl
Route::view('excel-fit-india-week-report', 'excelfitindiaweekreport'); // Report execl
Route::view('excel-fit-india-week-report-copy', 'excelfitindiaweekreportcopy'); // Report execl
Route::view('fit-india-rajasthan-report-2024', 'fitindiaweekreport2024'); // Report execl
Route::view('fit-india-report', 'fitindiareport'); // Report execl
Route::view('fit-india-pledge-2023', 'fitindiapledgeview2023');

// open event page
Route::view('fit-india-swacchta-freedom-run-5.0', 'fitinswacchtafreedomrun5');
Route::view('freedom-run-5.0-merchandise','freedomrunmerchandise');
Route::view('fit-india-pledge-freedom-run-5', 'fitindiapledgeviewfreedomrun5');
Route::view('past-glimpses-freedom-run-5', 'pastglimpsesfreedomrun5');
// end event page
Route::get('fit-india-school-week', [App\Http\Controllers\GeneralController::class, 'fitindschoolweek2020']);
Route::view('fit-india-cyclothon-2021','fit-india-cyclothon-2021');
Route::view('fit-india-cyclothon-2020','fit-india-cyclothon-2020');
Route::view('fit-india-prabhatpheri-2020','fit-india-prabhatpheri-2020');
Route::view('fit-india-school','fit-india-school');
Route::view('fit-india-youth-club-certification','fit-india-youth-club-certification');
Route::view('namo-cycling-club','fit-india-namo-club');
Route::view('namo-fit-india-youth-club','namo-fit-india-cycling-club');
Route::view('fit-india-school-registration','fit-india-school-registration');
Route::view('fit-india-youthclub-registration','fit-india-youthclub-registration');
//Route::view('fit-india-school-certification','fit-india-school-certification');
//Route::view('your-stories','your-stories');
Route::get('your-stories',[App\Http\Controllers\YourStoriesController::class,'index']);
Route::view('share-your-story','share-your-story');
Route::view('share-your-story1','share-your-story1');
Route::view('/fit-india-walkathon-200-km-by-itbp','fit-india-walkathon-200-km-by-itbp');
Route::view('media','media');
Route::view('dialogue-session-2','dialogue-session-2');
Route::view('fitnessprotocols','fitnessprotocols');
Route::get('fit-india-champions', [App\Http\Controllers\ChampionController::class, 'championList']);
Route::get('fit-india-ambassador', [App\Http\Controllers\AmbassadorController::class, 'ambassadorList']);

/***** Gram panchyat frontend *******/
Route::get('gram-panchayat-ambassador', [App\Http\Controllers\Auth\GramPanchayatController::class,'index'])->name('gram-panchayat-ambassador');
Route::post('gram_panchayat_store', [App\Http\Controllers\Auth\GramPanchayatController::class,'store'])->name('gram_panchayat_store');
Route::get('/gram-panchayat-apply-again/{id}', [App\Http\Controllers\Auth\GramPanchayatController::class, 'gramPanchayatApplyAgain']);
Route::get('download-grampanchayat-certificates', [App\Http\Controllers\Auth\GramPanchayatController::class, 'myGramPanchayatCertificate']);
Route::post('/update_grampanchayat_newevent', [App\Http\Controllers\Auth\GramPanchayatController::class, 'updateGramPanchayatNewEvent']);
Route::get('grampanchayat-ambassador-mobile', [App\Http\Controllers\Auth\GramPanchayatController::class,'mobileGrampanchayat'])->name('grampanchayat-ambassador-mobile');
Route::get('/gmapply-again-mobile', [App\Http\Controllers\Auth\GramPanchayatController::class, 'gmApplyAgainMobile']);
Route::get('mobile-grampanchayat-certificates', [App\Http\Controllers\Auth\GramPanchayatController::class, 'mobileGramPanchayatCertificate']);
/*******End panchayat frontend ********/

/**** localbody frontend ******/
Route::get('local-bodyambassador-mobile', [App\Http\Controllers\Auth\LocalbodyController::class,'mobileLocalBody'])->name('local-bodyambassador-mobile');
Route::get('local-bodyambassador', [App\Http\Controllers\Auth\LocalbodyController::class,'index'])->name('local-bodyambassador');
Route::post('store-local-bodyambassador', [App\Http\Controllers\Auth\LocalbodyController::class,'store'])->name('store-local-bodyambassador');
Route::post('update_localbody_newevent', [App\Http\Controllers\Auth\LocalbodyController::class, 'updateLocalBodyNewEvent']);
Route::get('/lbapply-again-mobile', [App\Http\Controllers\Auth\LocalbodyController::class, 'lbApplyAgainMobile']);
Route::get('/localbody-apply-again/{id}', [App\Http\Controllers\Auth\LocalbodyController::class, 'localbodyApplyAgain']);
Route::get('download-loalbody-certificates', [App\Http\Controllers\Auth\LocalbodyController::class, 'myLocalbodyCertificate']);
Route::get('mobile-localbody-certificates', [App\Http\Controllers\Auth\LocalbodyController::class, 'mobileLocalbodyCertificate']);
/***** End localbody ambassador ******/

/****** Gram panchyat and localbody public page *********/
Route::get('fit-india-panchayat', [App\Http\Controllers\Auth\GramPanchayatController::class, 'gramPanchayatAmbassadorList']);
Route::get('fit-india-localbody',[App\Http\Controllers\Auth\LocalbodyController::class, 'localbodyAmbassadorList']);
/***** End Gram panchyat and localbody public page*****/

//Route::view('all-events','all-events');
Route::view('champion-and-ambassador','champion-and-ambassador');
Route::view('covid-19-info','covid-19-info');
Route::view('fit-india-school-week-2020','covid-19-info');
Route::view('event-archives','event-archives');
Route::get('fit-india-school-week-2020', [App\Http\Controllers\GeneralController::class, 'fitindschoolweek2020']);
Route::view('fit-india-freedom-rider-cycle-rally-2022','fit-india-freedom-rider-cycle-rally-2022');

Route::get('schooldashboard', [App\Http\Controllers\SchoolDashboardController::class, 'index'])->name('schooldashboard');

Route::get('/fit-india-youth-club-certificate', [App\Http\Controllers\Auth\YouthCertController::class, 'index'])->name('youthcert');
Route::post('/storeyouthcert', [App\Http\Controllers\Auth\YouthCertController::class, 'storeyouthcert'])->name('storeyouthcert');
Route::post('/updateyouthcert', [App\Http\Controllers\Auth\YouthCertController::class, 'updateyouthcert'])->name('updateyouthcert');
Route::get('/youthclub-cert', [App\Http\Controllers\Auth\YouthCertController::class, 'certYouthclub'])->name('youthclub-cert');
Route::get('/mobile-youthclub-cert', [App\Http\Controllers\Auth\GramPanchayatController::class, 'mobileCertYouthclub'])->name('mobile-youthclub-cert');


//School Certificate Request
Route::get('/fit-india-school-certification', [App\Http\Controllers\Auth\CertificateController::class, 'index'])->name('schoolcert');
Route::post('/flagstore', [App\Http\Controllers\Auth\CertificateController::class, 'flagstore'])->name('flagstore');
Route::post('/threestar', [App\Http\Controllers\Auth\CertificateController::class, 'threestar'])->name('threestar');
Route::post('/fivestar', [App\Http\Controllers\Auth\CertificateController::class, 'fivestar'])->name('fivestar');

Route::get('reloadcaptcha',[App\Http\Controllers\CaptchaController::class, 'reloadCaptcha'])->name('reloadCaptcha');
Route::post('getroles',[App\Http\Controllers\RoleController::class, 'index'])->name('getroles');
Route::get('download-certificate/{id}', [App\Http\Controllers\Auth\CertificateController::class, 'schoolCertificate']);
Route::get('mobile-flag-certificate', [App\Http\Controllers\Auth\GramPanchayatController::class, 'mobileSchoolCertificate']);
Route::get('download-ambassador-certificate', [App\Http\Controllers\Auth\CertificateController::class, 'myAmbassadorCertificate']);
Route::get('download-champion-certificate', [App\Http\Controllers\Auth\CertificateController::class, 'myChampionCertificate']);

Route::get('sitecounter', [App\Http\Controllers\GeneralController::class, 'sitecounter']);

############################################################################

Route::post('storeyouthcert1', [App\Http\Controllers\Auth\LocalbodyController::class, 'storeyouthcert1'])->name('storeyouthcert1');
Route::get('getyouthclubcertificate', [App\Http\Controllers\Auth\LocalbodyController::class, 'youthclubcertificate'])->name('youthclubcertificate');
Route::post('updateyouthcert1', [App\Http\Controllers\Auth\LocalbodyController::class, 'updateyouthcert1'])->name('updateyouthcert1');

Route::get('getcertificate', [App\Http\Controllers\Auth\LocalbodyController::class, 'certification'])->name('certification');
Route::post('/flagstore1', [App\Http\Controllers\Auth\LocalbodyController::class, 'flagstore1'])->name('flagstore1');
Route::post('/threestar1', [App\Http\Controllers\Auth\LocalbodyController::class, 'threestar1'])->name('threestar1');
Route::post('/fivestar1', [App\Http\Controllers\Auth\LocalbodyController::class, 'fivestar1'])->name('fivestar1');

############################################################################
Route::get('all-events', [App\Http\Controllers\GeneralController::class, 'getallEvents']);
Route::get('event-search', [App\Http\Controllers\GeneralController::class, 'getallEvents'])->name('event-search');
Route::get('show-events-list/{id}', [App\Http\Controllers\GeneralController::class, 'showEvent']);
Route::get('video-stream', [App\Http\Controllers\GeneralController::class, 'showVideo']);
Route::get('event-video-search', [App\Http\Controllers\GeneralController::class, 'showVideo'])->name('event-video-search');

Route::get('photo-stream', [App\Http\Controllers\GeneralController::class, 'getallPhotos']);
Route::get('photo-search', [App\Http\Controllers\GeneralController::class, 'getallPhotos'])->name('photo-search');

Route::post('save-feedback', [App\Http\Controllers\GeneralController::class, 'feedbackStore'])->name('save-feedback');
Route::get('feedback', [App\Http\Controllers\GeneralController::class, 'feedback'])->name('feedback');


//Route::get('update-stat', [App\Http\Controllers\GeneralController::class, 'updatestat']);

Route::view('become-a-partner','become-a-partner');
Route::view('screen-reader-access','screen-reader-access');
Route::view('fit-india-icons','fit-india-icons');

Route::view('indigenousgames','indigenoussports');

//Route::view('indigenoussports','indigenoussports');
Route::view('help','help');
Route:: view('site-map','site-map');

Route::view('wim','wim');

Route::view('cert-notification','event.uncomplete-cert');
Route::get('update-stat', [App\Http\Controllers\SchoolDashboardController::class, 'updatestat']);
Route::get('password_change', [App\Http\Controllers\PasswordresetController::class, 'changePassword'])->name('password_change');
Route::post('reset_password_without_token', [App\Http\Controllers\PasswordresetController::class, 'validatePasswordRequest']);
Route::post('reset_password', [App\Http\Controllers\PasswordresetController::class, 'resetPassword'])->name('reset_password');
Route::get('your-story', [App\Http\Controllers\GeneralController::class, 'shareStory'])->name('your-story');
Route::post('save-story', [App\Http\Controllers\GeneralController::class, 'saveStory'])->name('save-story');
Route::get('national-sports-day-2025', [App\Http\Controllers\GeneralController::class, 'nsd_show_static_page'])->name('nsd-show-static-page');
Route::get('nsd-upload-image', [App\Http\Controllers\GeneralController::class, 'nsd_upload_image'])->name('nsd-upload-image');
Route::post('save-upload-image', [App\Http\Controllers\GeneralController::class, 'save_upload_image'])->name('save-upload-image');
//Route::get('school-quiz', [App\Http\Controllers\GeneralController::class, 'schoolQuiz'])->name('school-quiz');
//Route::post('save-quiz', [App\Http\Controllers\GeneralController::class, 'saveQuiz'])->name('save-quiz');
Route::view('fitness-from-home-series','fitness-from-home-series');
Route::get('fit-india-yoga-center-info/{id}', [App\Http\Controllers\YogaCenterController::class, 'index']);
URL::forceScheme('https');

//8-6-2021
Route::view('fit-india-quiz','fit-india-quiz');



//Sandeep Quz

//Route::get('fi-quiz/{id}', [App\Http\Controllers\Quiz::class, 'index'])->name('quizform');
//Route::post('fi-quiz', [App\Http\Controllers\Quiz::class, 'store'])->name('quizstore');
Route::get('road-to-tokyo-2020-quiz/{id}/{eid?}/{seid?}', [App\Http\Controllers\Quiz::class, 'index'])->name('quizform');
Route::post('road-to-tokyo-2020-quiz', [App\Http\Controllers\Quiz::class, 'store'])->name('quizstore');
Route::get('road-to-tokyo-2020-quiz-hn/{id}/{eid?}/{seid?}', [App\Http\Controllers\Quiz::class, 'indexhn'])->name('quizformhn');
Route::post('road-to-tokyo-2020-quiz-hn', [App\Http\Controllers\Quiz::class, 'storehn'])->name('quizstorehn');

// Route::get('quiz-partner-upload', [App\Http\Controllers\Quiz::class, 'quizPartnerUpload'])->name('quizpartnerupload');
// Route::post('quiz-partner-upload', [App\Http\Controllers\Quiz::class, 'quizPartnerUploadstore'])->name('quizpartnerupload.store');

// Route::view('quiz-winner','quiz-winner');

// Route::get('quiz-partner', [App\Http\Controllers\Quiz::class, 'quizPartner'])->name('quiz-partner-form');
// Route::post('quiz-partner', [App\Http\Controllers\Quiz::class, 'quizPartnerregister'])->name('quiz-partner');

// Route::get('quiz-partner-login', [App\Http\Controllers\Quiz::class, 'quizPartnerLoginForm'])->name('quiz-partner-login-form');
// Route::post('quiz-partner-login', [App\Http\Controllers\Quiz::class, 'quizPartnerLogin'])->name('quiz-partner-login');

// Route::get('quiz-partner-dashboard', [App\Http\Controllers\Quiz::class, 'quizPartnerDashboard'])->name('quiz-partner-dashboard');

Route::get('road-to-tokyo-2020/{id}/{eid?}/{seid?}', [App\Http\Controllers\Quiz::class, 'roadtotokyo'])->name('roadtotokyo');
Route::get('road-to-tokyo-2020-hn/{id}/{eid?}/{seid?}', [App\Http\Controllers\Quiz::class, 'roadtotokyohn'])->name('roadtotokyohn');

Route::get('road-to-tokyo-2020-winner/{id}/{eid?}/{seid?}', [App\Http\Controllers\Quiz::class, 'roadtotokyowinner'])->name('roadtotokyowinner');
Route::post('quiz-logout', [App\Http\Controllers\Quiz::class, 'logout'])->name('quiz.logout');

Route::get('update-quiz-winners', [App\Http\Controllers\Quiz::class, 'winnersupdate'])->name('quiz.winners.update');
Route::post('getquizques', [App\Http\Controllers\Quiz::class, 'getquizques'])->name('getques');
Route::get('tokyoquizcert/{name}', [App\Http\Controllers\Quiz::class, 'tokyoquizcert'])->name('tokyoquizcert');
Route::view('pevents','partcipant-events');
Route::view('fit-india-yoga-centres','fit-india-yoga-centres');

Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'lang']);
Route::get('fitness-quiz', [App\Http\Controllers\FitnessquizController::class, 'fitnessquiz']);
Route::post('fitness-quiz', [App\Http\Controllers\FitnessquizController::class, 'savefitnessquiz']);
Route::post('getfitnessques', [App\Http\Controllers\FitnessquizController::class, 'getfitnessques']);

/***** 26-7-2021 routes *****/
Route::view('influencer','influencer');
Route::view('influencer-mobile','influencer-mobile');

//prerak
Route::get('fit-india-prerak', [App\Http\Controllers\PrerakController::class, 'prerakList']);
Route::post('check-refer-code',[App\Http\Controllers\PrerakController::class,'check_refer_code'])->name('check-refer-code'); // on live
Route::get('/prerak', [App\Http\Controllers\PrerakController::class, 'index']); // on live
Route::get('/prerak-apply-again/{type}/{id}', [App\Http\Controllers\PrerakController::class, 'prerakApplyAgain']); // on live
Route::post('/prerak_ft_test', [App\Http\Controllers\PrerakController::class, 'checkFitnessTest'])->name('prerak_ft_test'); // on live
Route::post('/add-prerak', [App\Http\Controllers\PrerakController::class, 'store']); // on live
Route::get('download-fitevent-certificate', [App\Http\Controllers\PrerakController::class, 'myFiteventCertificate']);
Route::get('download-fitambassador-certificate', [App\Http\Controllers\PrerakController::class, 'myFitAmbassadorCertificate']);
Route::get('download-fitchampion-certificate', [App\Http\Controllers\PrerakController::class, 'myFitChampionCertificate']);
Route::get('download-prerak-certificate', [App\Http\Controllers\PrerakController::class, 'myPrerakCertificate']);
Route::get('download-ambassador-certificates', [App\Http\Controllers\PrerakController::class, 'myAmbassadorCertificate']);
Route::get('download-champion-certificates', [App\Http\Controllers\PrerakController::class, 'myChampionCertificate']);
Route::post('/update_prerak_newevent', [App\Http\Controllers\PrerakController::class, 'updatePrerakNewEvent']);
/**** end 26-7-2021 routes*****/


//freedomrun
/*Route::get('freedom-run/{id}', [App\Http\Controllers\Auth\FreedomrunController::class, 'index'])->name('freedom-run');*/
//Route::post('freedom-run/{id}', [App\Http\Controllers\Auth\FreedomrunController::class, 'store'])->name('freedom-run');
Route::get('create-freedomrun-event', [App\Http\Controllers\Auth\FreedomrunController::class, 'createFreedomrunEvent'])->name('create-freedomrun-event');
Route::post('create-freedomrun-event', [App\Http\Controllers\Auth\FreedomrunController::class, 'store'])->name('create-freedomrun-event');
Route::post('freedomrun-add-individual', [App\Http\Controllers\Auth\FreedomrunController::class, 'addIndividualFreedomRun'])->name('freedomrun-add-individual');
Route::get('freedom-run-events', [App\Http\Controllers\Auth\FreedomrunController::class, 'show'])->name('freedom-run-events');
Route::get('freedom-run-partcipant/{id}', [App\Http\Controllers\Auth\FreedomrunController::class, 'addFreedomRunPartcipant'])->name('freedomrun-add-participant');
Route::post('freedom-update-partcipant', [App\Http\Controllers\Auth\FreedomrunController::class, 'updateFreedomRunParticipant'])->name('freedom-update-partcipant');
Route::get('freedom-run-update/{id}', [App\Http\Controllers\Auth\FreedomrunController::class, 'update'])->name('freedom-run-update');
Route::post('freedom-update-value', [App\Http\Controllers\Auth\FreedomrunController::class, 'edit'])->name('freedom-update-value');

/*Route::get('freedom-run-info', [App\Http\Controllers\Auth\FreedomrunController::class, 'freedomrunInfo'])->name('freedom-run-info');*/
// Route::get('freedom-run-2.0', [App\Http\Controllers\Auth\FreedomrunController::class, 'freedomrunInfo'])->name('freedom-run-2.0');
// Route::get('freedom-run-3.0', [App\Http\Controllers\Auth\FreedomrunController::class, 'freedomrunInfo'])->name('freedom-run-3.0');
Route::get('Fit-India-Swachhata-Freedom-Run-4.0', [App\Http\Controllers\Auth\FreedomrunController::class, 'freedomrunInfo'])->name('freedom-run-4.0');
Route::get('Fit-India-Swachhata-Freedom-Run-4.0', [App\Http\Controllers\Auth\FreedomrunController::class, 'freedomrunInfo'])->name('freedom-run-4.0');
/*Route::view('freedom-run-dashboard','freedomrun.freedom-run-dashboard'); */
Route::view('partner-organization','freedomrun.partner-organization');
Route::post('check-individual-existance', [App\Http\Controllers\Auth\FreedomrunController::class, 'checkIndividualExistance'])->name('check-individual-existance');
Route::post('freedomrun-add-partners', [App\Http\Controllers\Auth\FreedomrunController::class, 'addFreedomRunPartners'])->name('freedomrun-add-partners');
Route::get('show-freedom-updatedetail/{id}', [App\Http\Controllers\Auth\FreedomrunController::class, 'showEventUpdateDetails']);
// Route::get('freedom-certificate-process/{id}', [App\Http\Controllers\Auth\FreedomrunController::class, 'freedomCertificateProcess']);
Route::post('download-freedomrun-certificate',[App\Http\Controllers\Auth\FreedomrunController::class, 'downloadFreedomCertificate'])->name('download-freedomrun-certificate');
Route::get('freedomrun-events',[App\Http\Controllers\Auth\FreedomrunController::class, 'freedomrunEvents'])->name('freedomrun-events');
Route::get('freedomrun-events-mobile', [App\Http\Controllers\Auth\FreedomrunController::class, 'mobileFreedomrunEvents'])->name('freedomrun-events-mobile');
Route::delete('freedomrun-event-destroy/{id}',[App\Http\Controllers\Auth\FreedomrunController::class, 'freedomrunEventDestroy'])->name('freedomrun-event-destroy');
Route::get('check-individual-existance-second/{id}', [App\Http\Controllers\Auth\FreedomrunController::class, 'checkIndividualExistanceSecond']);
// Route::get('download-mobile-event-certificate/{name}/{eventname}/{type}',[App\Http\Controllers\Auth\FreedomrunController::class, 'mobiledownloadFreedomCertificate'])->name('download-event-certificate');
Route::get('download-mobile-event-certificate/{user_id}/{event_id}',[App\Http\Controllers\Auth\FreedomrunController::class, 'mobiledownloadFreedomCertificate'])->name('download-mobile-event-certificate');
Route::get('soc-download-mobile-event-certificate/{user_id}/{os_type}/{event_id}/{usermeta_datadistrict}/{usermeta_data_state}',[App\Http\Controllers\Auth\FreedomrunController::class, 'socmobiledownloadFreedomCertificate'])->name('download-mobile-event-certificate');
// Route::get('view-mobile-event-certificate/{name}',[App\Http\Controllers\Auth\FreedomrunController::class, 'mobileviewFreedomCertificate'])->name('view-event-certificate');
Route::view('freedomrun-events-creatives','freedomrun-events-creatives');


Route::get('freedomrun-events-pics', [App\Http\Controllers\Auth\FreedomrunController::class, 'freedomrunEventsPics'])->name('freedomrun-events-pics');

Route::view('mobile-update','mobile-update');
Route::view('redirect-mobile-updator','redirect-mobile-updator');

Route::view('schoolweek-info','schoolweek-info');
Route::view('school-week-merchandise','school-week-merchandise');
// Route::view('schoolweekmerchandise2023','schoolweekmerchandise2023');
// Route::view('nationalsportsdaymerchandise2023','national-sports-day-merchandise2023');
Route::view('fitindiaindiaweekmerchandise2023','fit-india-week-merchandise2023');
Route::view('fitindiaindiaweekmerchandise2024','fit-india-week-merchandise2024');
Route::view('fit-india-women-week-merchandise','international_women_merchandise');
Route::view('national-sports-day-merchandise-creatives-2024','nationalsportsdaymerchandisecreatives2024');
Route::post('download-school-banner',[App\Http\Controllers\GeneralController::class,'downloadSchoolBanner'])->name('download-school-banner');
Route::view('app-store-redirect','app-store-redirect');

Route::get('create-corporate', [App\Http\Controllers\Auth\CorporateController::class, 'create'])->name('create-corporate');
Route::post('store-corporate', [App\Http\Controllers\Auth\CorporateController::class, 'store'])->name('store-corporate');
Route::get('corporate-detail', [App\Http\Controllers\Auth\CorporateController::class, 'show'])->name('corporate-detail');
Route::get('mobile-create-corporate', [App\Http\Controllers\Auth\CorporateController::class, 'mobileCreateCorporate'])->name('mobile-create-corporate');
Route::get('mobile-corporate-detail', [App\Http\Controllers\Auth\CorporateController::class, 'showByMobile'])->name('mobile-corporate-detail');
Route::get('/mobile-corporate-cert', [App\Http\Controllers\Auth\CorporateController::class, 'mobileCertCorporate'])->name('mobile-corporate-cert');
Route::post('check-multiple-fitscore', [App\Http\Controllers\Auth\CorporateController::class, 'check_fitness_test'])->name('check-multiple-fitscore');
Route::post('check-multiple-fitscore-new', [App\Http\Controllers\Auth\CorporateController::class, 'check_fitness_test_new'])->name('check-multiple-fitscore-new');
Route::view('coming-soon','coming-soon');
Route::view('awards','awards');
Route::get('external-event-registration', [App\Http\Controllers\ExternaleventController::class, 'index'])->name('external-event-registration');
Route::post('external-event-add', [App\Http\Controllers\ExternaleventController::class, 'external_event_register'])->name('external-event-add');
Route::get('external-event-activity',[App\Http\Controllers\ExternaleventController::class, 'create'])->name('external-event-activity');
Route::post('external-activity-store',[App\Http\Controllers\ExternaleventController::class, 'store'])->name('external-activity-store');
Route::view('external-event-info','external_event/external-event-info');
Route::view('organization-rewards','organization-rewards');
Route::get('episode-quiz',[App\Http\Controllers\EpisodeController::class, 'index'])->name('episode-quiz');
Route::post('episode-quiz-post',[App\Http\Controllers\EpisodeController::class, 'store'])->name('episode-quiz-post');
Route::view('term-and-condition','episode_quiz/term-and-condition');




////School-week-2022

Route::get('event-uploadexcel/{id}',[App\Http\Controllers\Auth\SchoolController::class, 'Uploadexcel'])->name('Uploadexcel');
Route::post('event-uploadexcel',[App\Http\Controllers\Auth\SchoolController::class, 'updateBulkUploadExcel'])->name('updateBulkUploadExcel');
Route::get('create-school-event', [App\Http\Controllers\Auth\SchoolController::class, 'createFreedomrunEvent'])->name('create-school-event');
Route::post('create-school-event', [App\Http\Controllers\Auth\SchoolController::class, 'store'])->name('create-school-event-post');
Route::get('school-events',[App\Http\Controllers\Auth\SchoolController::class, 'freedomrunEvents'])->name('school-events');
Route::get('school-run-update/{id}', [App\Http\Controllers\Auth\SchoolController::class, 'update'])->name('school-run-update');
Route::post('school-update-value', [App\Http\Controllers\Auth\SchoolController::class, 'edit'])->name('school-update-value');
Route::get('school-updatedetail/{id}', [App\Http\Controllers\Auth\SchoolController::class, 'showEventUpdateDetails']);
Route::delete('school-event-destroy/{id}',[App\Http\Controllers\Auth\SchoolController::class, 'freedomrunEventDestroy'])->name('school-event-destroy');
Route::get('school-add-partcipant/{id}', [App\Http\Controllers\Auth\SchoolController::class, 'addFreedomRunPartcipant'])->name('school-add-partcipant');
Route::post('school-update-partcipant', [App\Http\Controllers\Auth\SchoolController::class, 'updateFreedomRunParticipant'])->name('school-update-partcipant');
Route::get('school-certificate-process/{id}', [App\Http\Controllers\Auth\SchoolController::class, 'freedomCertificateProcess']);
Route::post('download-school-certificate',[App\Http\Controllers\Auth\SchoolController::class, 'downloadFreedomCertificate'])->name('download-school-certificate');
Route::get('fit-india-school-week-2022', [App\Http\Controllers\GeneralController::class, 'fitindschoolweek2022']);
// Route::get('fitindiaschoolweek2022viewpage', [App\Http\Controllers\Auth\SchoolController::class, 'fitindiaschoolweek2022viewpage']);
Route::get('fit-india-school-week-2022-viewpage/{name?}', [App\Http\Controllers\Auth\SchoolController::class, 'fitindiaschoolweek2022viewpage']);
Route::get('fitindiaweek-events-pics', [App\Http\Controllers\Auth\SchoolController::class, 'freedomrunEventsPics'])->name('fitindiaweek-events-pics');

//excel route
Route::get('get_csv_image', [\App\Http\Controllers\CsvController::class, 'get_excel_image']);
Route::get('get_csv', [\App\Http\Controllers\CsvController::class, 'get_csv'])->name('get_csv');
Route::get('all_get_csv', [\App\Http\Controllers\CsvController::class, 'all_get_csv'])->name('all_get_csv');
Route::get('get_excel_school_event', [App\Http\Controllers\CsvController::class, 'get_excel_school_event']);
Route::get('lastmonthRegistration', [App\Http\Controllers\CsvController::class, 'lastmonthRegistration']);
Route::get('registrationwithdistance', [App\Http\Controllers\CsvController::class, 'registrationwithdistance']);

//excel route 09-08-2023 fitindia week 2023
Route::get('event_get_csv_image', [\App\Http\Controllers\CsveventController::class, 'get_excel_image']);
Route::get('event_get_csv', [\App\Http\Controllers\CsveventController::class, 'get_csv'])->name('event_get_csv');
Route::get('event_all_get_csv', [\App\Http\Controllers\CsveventController::class, 'all_get_csv'])->name('event_all_get_csv');
Route::get('event_get_excel_school_event', [App\Http\Controllers\CsveventController::class, 'get_excel_school_event']);
Route::get('event_lastmonthRegistration', [App\Http\Controllers\CsveventController::class, 'lastmonthRegistration']);
Route::get('event_get_csv_participant', [\App\Http\Controllers\CsveventController::class, 'event_get_csv_participant']);
Route::get('registrationwithdistanceevent', [App\Http\Controllers\CsveventController::class, 'registrationwithdistanceevent']);
Route::get('event_get_csv_participant_count', [\App\Http\Controllers\CsveventController::class, 'event_get_csv_participant_count']);
Route::get('event_role_wise_user_registration', [\App\Http\Controllers\CsveventController::class, 'event_role_wise_user_registration']);
Route::get('event_date_wise_user_registration', [\App\Http\Controllers\CsveventController::class, 'event_date_wise_user_registration']);
Route::get('demandreport2023', [\App\Http\Controllers\CsveventController::class, 'demandreport2023']);
Route::get('one-year-users', [\App\Http\Controllers\CsveventController::class, 'one_year_users']);
Route::get('soc-event-report', [\App\Http\Controllers\CsveventController::class, 'socEventReport13072025']);
Route::get('soc-event-report-data', [\App\Http\Controllers\CsveventController::class, 'socEventReportdata13072025']);
Route::get('soc-report-both-table-data', [\App\Http\Controllers\CsveventController::class, 'soc_report_both_data']);
Route::get('soc-report-cycle-return-data', [\App\Http\Controllers\CsveventController::class, 'soc_report_cycle_return_data']);
// Route::get('all_data_registration', [\App\Http\Controllers\CsveventController::class, 'all_data_registration']);

Route::get('delete-user-details', [\App\Http\Controllers\CsveventController::class, 'delete_user_detail']);



Route::get('/dashboard', [App\Http\Controllers\Auth\UserController::class, 'index'])->name('dashboard');
//event route
Route::get('create-event', [App\Http\Controllers\Auth\EventCatController::class, 'createFreedomrunEvent'])->name('create-event');
Route::get('events-pics', [App\Http\Controllers\Auth\EventCatController::class, 'EventsPics'])->name('events-pics');
Route::get('myeventsearchimages/{id}', [App\Http\Controllers\Auth\EventCatController::class, 'EventSearchImages'])->name('myevent-search-images');
Route::get('eventdatesearch/{id}', [App\Http\Controllers\Auth\EventCatController::class, 'eventdatesearch'])->name('event-date-search');
Route::post('create-event', [App\Http\Controllers\Auth\EventCatController::class, 'store'])->name('create-event-post');
Route::get('list-events',[App\Http\Controllers\Auth\EventCatController::class, 'listofEvents'])->name('list-events');
Route::get('myeventsearch/{id?}',[App\Http\Controllers\Auth\EventCatController::class, 'myeventsearching'])->name('myevent-search');
Route::get('event-run-update/{id}', [App\Http\Controllers\Auth\EventCatController::class, 'update'])->name('event-run-update');
Route::post('event-update-value', [App\Http\Controllers\Auth\EventCatController::class, 'edit'])->name('event-update-value');
Route::get('event-updatedetail/{id}', [App\Http\Controllers\Auth\EventCatController::class, 'showEventUpdateDetails']);
Route::delete('event-event-destroy/{id}',[App\Http\Controllers\Auth\EventCatController::class, 'freedomrunEventDestroy'])->name('event-event-destroy');
Route::get('event-event-uploadexcel/{id}',[App\Http\Controllers\Auth\EventCatController::class, 'Uploadexcel'])->name('event-Uploadexcel');
Route::post('event-event-uploadexcel',[App\Http\Controllers\Auth\EventCatController::class, 'updateBulkUploadExcel'])->name('eventupdateBulkUploadExcel');
Route::get('event-certificate-process/{id}', [App\Http\Controllers\Auth\EventCatController::class, 'freedomCertificateProcess']);
Route::get('event-add-partcipant/{id}', [App\Http\Controllers\Auth\EventCatController::class, 'eventaddPartcipant'])->name('event-add-partcipant');
Route::post('event-update-partcipant', [App\Http\Controllers\Auth\EventCatController::class, 'updateFreedomRunParticipant'])->name('event-update-partcipant');
Route::post('download-event-certificate',[App\Http\Controllers\Auth\EventCatController::class, 'downloadFreedomCertificate'])->name('download-event-certificate');
Route::get('user-certificate-event-sunday/{user_id}/{event_id}',[App\Http\Controllers\Auth\EventCatController::class, 'user_certificate_event_sunday'])->name('usercertificateeventsunday');
Route::get('download_registration_certificate', [App\Http\Controllers\Auth\EventCatController::class, 'DownloadRegistrationCertificate'])->name('download-registration-certificate');
// Event Report
Route::get('get-all-event', [\App\Http\Controllers\ReporteventController::class, 'getallevent']);
Route::get('report-event-get-csv-image/{id?}', [\App\Http\Controllers\ReporteventController::class, 'get_excel_image']);
Route::get('report-event-get-csv/{id?}', [\App\Http\Controllers\ReporteventController::class, 'get_csv'])->name('event_get_csv');
Route::get('report-event-all-get-csv/{event_id?}', [\App\Http\Controllers\ReporteventController::class, 'all_get_csv'])->name('event_all_get_csv');
Route::get('report-event-get-excel-school-event/{event_id?}', [App\Http\Controllers\ReporteventController::class, 'get_excel_school_event']);
Route::get('report-event-day-wise-Registration/{from?}/{to?}/{event_id?}', [App\Http\Controllers\ReporteventController::class, 'lastdaywiseRegistration']);
Route::get('report-event-get-csv-participant/{from?}/{to?}/{event_id?}', [\App\Http\Controllers\ReporteventController::class, 'event_get_csv_participant']);
Route::get('report-event-get-csv-participant-count', [\App\Http\Controllers\ReporteventController::class, 'event_get_csv_participant_count']);
Route::get('report-event-role-wise-user-registration', [\App\Http\Controllers\ReporteventController::class, 'event_role_wise_user_registration']);
Route::get('report-event-date-wise-user-registration', [\App\Http\Controllers\ReporteventController::class, 'event_date_wise_user_registration']);
Route::get('report-event-state-wise-user-registration', [\App\Http\Controllers\ReporteventController::class, 'event_state_wise_user_registration']);
Route::get('state-summary', [\App\Http\Controllers\ReporteventController::class, 'statesummary']);
Route::get('total-participation', [\App\Http\Controllers\ReporteventController::class, 'totalparticipation']);
Route::get('role-wise-participation', [\App\Http\Controllers\ReporteventController::class, 'rolewiseparticipation']);
Route::get('role-wise-participation-13059', [\App\Http\Controllers\ReporteventController::class, 'rolewiseparticipation13059']);
Route::get('cyclothonRegistration', [\App\Http\Controllers\ReporteventController::class, 'cyclothonRegistration']);
Route::get('cyclothonRegistrationrolewise', [\App\Http\Controllers\ReporteventController::class, 'cyclothonRegistrationrolewise']);
Route::get('certification-download-report', [\App\Http\Controllers\ReporteventController::class, 'certificationdownloadreport']);
Route::get('school-download-report', [\App\Http\Controllers\ReporteventController::class, 'schooldownloadreport']);
Route::get('hanolcyclothonrenningdatawise', [\App\Http\Controllers\ReporteventController::class, 'hanolcyclothonrenningdatawise']);
Route::get('cyclothonrenningdatawise', [\App\Http\Controllers\ReporteventController::class, 'cyclothonrenningdatawise']);
Route::get('coiregistrationdrivereport', [\App\Http\Controllers\ReporteventController::class, 'coiregistrationdrivereport']);
// Route::POST('report-fit-india-event', 'reportfitindiaevent');


// Open Excel
Route::get('excel-registration-count', [\App\Http\Controllers\ReportexceleventController::class, 'registration_count']);
Route::get('excel-registration-cycling-event', [\App\Http\Controllers\ReportexceleventController::class, 'registration_cycling_event']);
Route::get('excel-registration-fiw-2024', [\App\Http\Controllers\ReportexceleventController::class, 'excelregistrationfiw2024']);
Route::get('certification-trackings-tracking', [\App\Http\Controllers\ReportexceleventController::class, 'certification_trackings_tracking']);
// Route::get('excel-registration-namo-fitIndia-club', [\App\Http\Controllers\ReportexceleventController::class, 'excelregistrationnamofitindiaclub']);
Route::get('excel-registration-cyclothon2024', [\App\Http\Controllers\ReportexceleventController::class, 'registration_cyclothon2024']);
// End Excel

Route::get('excel-all-report', [\App\Http\Controllers\ReportexceleventController::class, 'excelallreport'])->name('excel-all-report');
Route::post('excel-report', [\App\Http\Controllers\ReportexceleventController::class, 'createreport'])->name('excel-report');


Route::get('report-rajasthan-get-csv-participant-count', [\App\Http\Controllers\ReportrajasthanController::class, 'event_get_csv_participant_count']);
Route::get('report-rajasthan-date-wise-user-registration', [\App\Http\Controllers\ReportrajasthanController::class, 'event_date_wise_user_registration']);
Route::get('report-rajasthan-get-csv-image/{id?}', [\App\Http\Controllers\ReportrajasthanController::class, 'get_excel_image']);
// Route::get('report-event-state-wise-user-registration', [\App\Http\Controllers\ReportregistrationController::class, 'event_state_wise_user_registration']);

//Quiz Routes

Route::get('quiz-school-week-2022', [App\Http\Controllers\PklQuizController::class, 'landingPage'])->name('quiz-landingPage');
Route::get('school-week-quiz-dashboard', [App\Http\Controllers\PklQuizController::class, 'dashboard'])->name('school-week-quiz-dashboard');
Route::get('road-to-school-week-quiz', [App\Http\Controllers\PklQuizController::class, 'schoolIndex'])->name('schoolQuizform');
Route::post('getschoolquizques', [App\Http\Controllers\PklQuizController::class, 'getschoolquizques'])->name('getschoolquizques');
Route::post('road-to-school-week-quiz', [App\Http\Controllers\PklQuizController::class, 'schoolStore'])->name('schoolQuizStore');
Route::get('schoolQuizCert/{name}', [App\Http\Controllers\PklQuizController::class, 'schoolQuizCert'])->name('schoolQuizCert');

//quiz excel
Route::get('downloadPklQuizReport/{today?}', [App\Http\Controllers\PklQuizController::class, 'downloadPklQuizReport'])->name('downloadPklQuizReport');
Route::get('downloadPklQuizWinner/{zone?}', [App\Http\Controllers\PklQuizController::class, 'downloadPklQuizWinner'])->name('downloadPklQuizWinner');

//// IYM Routes
Route::get('iym-contest-index', [App\Http\Controllers\IymController::class, 'index']);
Route::get('iym-quiz-questions', [App\Http\Controllers\IymController::class, 'getQuestions']);
Route::get('iym-quiz', [App\Http\Controllers\IymController::class, 'encrypt']);
Route::Post('iym-quiz-submit', [App\Http\Controllers\IymController::class, 'iym_quizSubmit']);
Route::get('iym-thankyou', [App\Http\Controllers\IymController::class, 'iym_thankYou']);
Route::get('downloadIymWinner/{date?}', [App\Http\Controllers\IymController::class, 'downloadImyWinner'])->name('downloadImyWinner');
Route::get('total_iym_participant/{date?}',[App\Http\Controllers\IymController::class,'getTotalParticipant']);
Route::get('downloadIytimeswisemWinner/00:00:00/{date?}', [App\Http\Controllers\IymController::class, 'downloadIytimeswisemWinner'])->name('downloadIytimeswisemWinner');
Route::get('downloadIytimeswisetwomWinner/12:00:00/{date?}', [App\Http\Controllers\IymController::class, 'downloadIytimeswisetwomWinner'])->name('downloadIytimeswisetwomWinner');
Route::get('downloadtotalWinner', [App\Http\Controllers\IymController::class, 'downloadtotalWinner'])->name('downloadtotalWinner');


//quiz result - ashish

Route::get('getuserresultvalue',[fitindiaquizresultdata::class,'index']);
Route::post('get-user-result-value',[fitindiaquizresultdata::class,'getresult']);
Route::get('resultshow',[fitindiaquizresultdata::class,'resultshow']);


Route::get('/testlist',[App\Http\Controllers\FitindiaDotNetController::class,'testlistview']);
Route::get('/InitializeCulture/{data?}',[FitindiaDotNetController::class,'initializeculture'])->name('initializeculture');
Route::get('/homeaddusers/{id?}',[FitindiaDotNetController::class,'homelistview'])->name('homelistview');
Route::post('/storedata',[FitindiaDotNetController::class,'storedata'])->name('storedata');
Route::get('/getdata/{id?}',[FitindiaDotNetController::class,'getdata'])->name('getdata');
Route::get('/deactivate_member/{id?}',[FitindiaDotNetController::class,'deactivatemember'])->name('deactivatemember');
Route::get('/activate_member/{id?}',[FitindiaDotNetController::class,'activatemember'])->name('activatemember');
Route::get('/getalldata/{ParentId?}',[FitindiaDotNetController::class,'getalldata'])->name('getalldata');
Route::get('/memberdashboard/{Name?}/{F365Id?}/{Age?}/{AgeGroupId?}/{AgeGroupName?}/{GenderId?}',
            [FitindiaDotNetController::class,'memberdashboard'])
            ->name('memberdashboard');
Route::get('/member_view_report/{userF365Id?}/{UserDisplayDate?}',[FitindiaDotNetController::class,'memberviewreport'])->name('memberviewreport');
Route::get('/member_fitness_history/{userF365Id?}',[FitindiaDotNetController::class,'memberfitnesshistory'])->name('memberfitnesshistory');
Route::match(['GET','POST'],'/datewisedate',[FitindiaDotNetController::class,'datewisedashboard'])->name('datewisedashboard');
Route::post('TestListaspx/GetInstructiontPopup',[App\Http\Controllers\FitindiaDotNetController::class,'GetInstructiontPopup']);
Route::get('/taketest/{Name?}/{F365Id?}/{Age?}/{AgeGroupId?}/{AgeGroupName?}/{GenderId?}',[App\Http\Controllers\FitindiaDotNetController::class,'taketestview']);
Route::get('/benchmark/{age?}/{GenderId?}',[App\Http\Controllers\FitindiaDotNetController::class,'benchmarkview']);
Route::post('savetaketestdata',[App\Http\Controllers\FitindiaDotNetController::class,'taktestsave']);
Route::post('savetaketestsitrich',[App\Http\Controllers\FitindiaDotNetController::class,'taktestsitrichsave']);
Route::post('save50mtdash',[App\Http\Controllers\FitindiaDotNetController::class,'taksave50mtdashsave']);
Route::post('savepartialcurl',[App\Http\Controllers\FitindiaDotNetController::class,'takpartialcurlsave']);
Route::post('savepushup',[App\Http\Controllers\FitindiaDotNetController::class,'takpsavepushupsave']);
Route::post('save600runwalk',[App\Http\Controllers\FitindiaDotNetController::class,'takpsave600mtupsave']);
Route::post('/usersdatadashboard',[FitindiaDotNetController::class,'usersdashboard']);
Route::get('/testresulthistory/{F365Id?}/{Testtypeid?}/{Age?}',[FitindiaDotNetController::class,'testresulthistory']);
Route::post('/TestResultHistory/BindData',[FitindiaDotNetController::class,'BindData']);
Route::post('/TestResultHistory/classwisetestdetails',[FitindiaDotNetController::class,'classwisetestdetails']);
Route::get('/suggestionvideos/{Testtypeid?}/{AgeGroupId?}',[FitindiaDotNetController::class,'SuggestionVideos']);
Route::post('/SuggestionVideos/GetSuggestionVideoPopup',[FitindiaDotNetController::class,'Suggestedvideo']);


Route::get('/fitindiareportview',[FitindiaDotNetreportController::class,'fitindiareport']);

Route::view('termsandconditions','termsandconditions');
Route::view('socbookingterms','socbookingterms');
Route::view('revisedpolicy','revisedpolicys');

Route::view('/data-deletion','data_deletion')->name('data_deletion');

// Route::get('fitindiaweekregister',[App\Http\Controllers\Auth\FitindiaweekregisterController::class,'showRegistrationForm'])->middleware('limit.ip:registration')->name('showRegistrationForm');

Route::get('cyclothonregistrationform',[App\Http\Controllers\Auth\RegisterController::class,'cyclothonshowRegistrationForm'])->middleware('limit.ip:registration')->name('cyclothonshowRegistrationForm');
Route::get('coiregistration',[App\Http\Controllers\Auth\RegisterController::class,'coiregistration'])->middleware('limit.ip:registration')->name('coiregistration');
Route::get('register',[App\Http\Controllers\Auth\RegisterController::class,'showRegistrationForm'])->middleware('limit.ip:registration')->name('register');
Route::get('coiregistrationdrive',[App\Http\Controllers\Auth\RegistereventbaisController::class,'coiregistrationdrive'])->middleware('limit.ip:registration')->name('coiregistrationdrive');
Route::post('saveregisterdrive',[App\Http\Controllers\Auth\RegistereventbaisController::class,'saveregisterdrive'])->middleware('limit.ip:registration')->name('saveregisterdrive');




// Route::get('wp-content/uploads/{name?}/{state?}/ankit/fkwkzhLNPCqU1Xl7v55Dzc44YReFaXV4oHx12iUh.jpg',[App\Http\Controllers\Auth\FitindiaweekregisterController::class,'imgaeshow'])->name('imgaeshow');
// Route::get('wp-content/uploads/fitindiaweek2023/Jammu%20and%20Kashmir/ankit/fkwkzhLNPCqU1Xl7v55Dzc44YReFaXV4oHx12iUh.jpg',[App\Http\Controllers\Auth\FitindiaweekregisterController::class,'imgaeshow'])->name('imgaeshow');
// wp-content/uploads/fitindiaweek2023/Jammu%20and%20Kashmir/ankit/fkwkzhLNPCqU1Xl7v55Dzc44YReFaXV4oHx12iUh.jpg

// Route::get('/wp-content/uploads/{a?}/{b?}/{c?}/{d?}',function(){
// dd('done');
// });
// Route::get('duplicateemailcheck/{emailid?}', [App\Http\Controllers\GeneralController::class, 'duplicate_email_check']);
Route::post('duplicateemailcheck/{emailid?}', [App\Http\Controllers\GeneralController::class, 'duplicate_email_check'])->name('duplicateemailcheck');
Route::post('duplicatemobilecheck', [App\Http\Controllers\GeneralController::class, 'duplicate_mobile_check'])->name('duplicatemobilecheck');
Route::post('emailotpcheck', [App\Http\Controllers\GeneralController::class, 'email_otp_check'])->name('emailotpcheck');
Route::post('mobileotpcheck', [App\Http\Controllers\GeneralController::class, 'mobile_otp_check'])->name('mobileotpcheck');
Route::get('useremailw', [App\Http\Controllers\GeneralController::class, 'useremailw'])->name('useremailw');
// Route::get('useremailall', [App\Http\Controllers\GeneralController::class, 'useremailall'])->name('mobileotpcheck');
Route::get('fit-india-cycling-drive', [App\Http\Controllers\GeneralController::class, 'fit_india_cycling_drive'])->name('fit_india_cycling_drive');
Route::get('fit-india-cycling-drive-update-banner', [App\Http\Controllers\GeneralController::class, 'fit_india_cycling_drive_update_banner'])->name('fit_india_cycling_drive_update_banner');
Route::get('fit-india-cycling-drive-app-update-banner', [App\Http\Controllers\GeneralController::class, 'fit_india_cycling_drive_app_update_banner'])->name('fit_india_cycling_drive_app_update_banner');
Route::get('ankit',function(){
    $response = Http::post('http://localhost/fit_india_api_git/api/v2/generateotpvtwo', [
        // $response = Http::post('https://service.fitindia.gov.in/api/v2/generateotpvtwo', [
            'reqtime' => "9yh5lwmBrPe2aL6EeDJTYQ==",
            'email' => "HKKCfpboFPoBYQrKX61e2w==",
            'mobile' => "CPGgOvOGtQe7gMnLaeqwGg==",
        ]);
    dd($response->collect());
    dd($response->body());
});


// Route::view('/registercopy','registercopy')->name('registercopy');

Route::get('registercopy', [App\Http\Controllers\GeneralController::class, 'registercopy'])->name('registercopy');
Route::get('convertintostringtoencrypt', [App\Http\Controllers\GeneralController::class, 'convertintostringtoencrypt'])->name('convertintostringtoencrypt');
Route::get('password-generator/{password}', [App\Http\Controllers\GeneralController::class, 'passrdgentor'])->name('passworgen');
// Route::get('register',[App\Http\Controllers\Auth\RegisterController::class,'cyclothonshowRegistrationForm'])->middleware('limit.ip:registration')->name('register');
//
Route::get('/rss', [RssController::class, 'generateRssFeed']);



Route::get('import-excel', [App\Http\Controllers\SocadminImportController::class, 'index'])->name('index');
Route::post('import-excel', [App\Http\Controllers\SocadminImportController::class, 'import'])->name('import.excel');
// Route::get('/import-excel', 'ExcelImportController@index')->name('import.excel');
// Route::post('/import-excel', 'ExcelImportController@import');

Route::get('/admin/banner-update', [App\Http\Controllers\Admin\WebsiteQuickChangeController::class, 'edit'])->name('banner.edit');
Route::post('/admin/banner-update', [App\Http\Controllers\Admin\WebsiteQuickChangeController::class, 'update'])->name('banner.update');

// New Validated Domain
Route::get('/redirect', function (\Illuminate\Http\Request $request) {
    $url = $request->query('url');
    return redirect()->away($url);
})->name('redirect');

Route::fallback(function () {
    return redirect('/');
});

URL::forceScheme('https');
