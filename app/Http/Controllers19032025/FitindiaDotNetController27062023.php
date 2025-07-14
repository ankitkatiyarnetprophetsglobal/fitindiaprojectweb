<?php

namespace App\Http\Controllers;

use FontLib\TrueType\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Session;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Exception;
class FitindiaDotNetController extends Controller
{
    private $DB_SQL_CONNECTION = 'sqlsrv';
    private $DB_SQL_HOST = '10.72.163.124';
    private $DB_SQL_PORT = '1433';
    private $DB_DATABASE_SQL_NAME = 'FitIndia_Fitness';
    private $DB_SQL_PASSWORD = 'Adm$2^3#SqlServ';
    private $DB_SQL_USERNAME = 'sa';

    Public function Base64Decode($data){

        try {        

            $data_string = base64_decode($data);        
            return $data_string;
        } catch (Exception $e) {
            return view('404');
        }
    }
    Public function testlistview(Request $request){
        try {
            $Language=Session::get('lang');
            $ParentUserId=Session::get('F365Id');
            $ParentUserName=Session::get('hidname');
            $ParentUserAgeGroupId=Session::get('AgeGroupId');
            $ParentUserGenderId=Session::get('GenderId');
            $ParentUserAgeGroupName=Session::get('AgeGroupName');
            $ParentUserAge=Session::get('Age');
            return view('static/index',['ParentUserId'=>$ParentUserId,'ParentUserName'=>$ParentUserName,'ParentUserAgeGroupId'=>$ParentUserAgeGroupId,'ParentUserGenderId'=>$ParentUserGenderId,'ParentUserAgeGroupName'=>$ParentUserAgeGroupName,'ParentUserAge'=>$ParentUserAge]);
        } catch (Exception $e) {
            return view('404');
        }   

    }
    public function InitializeCulture(Request $request){
        // dd(123456);
        error_reporting(E_ALL);
        ini_set('display_errors','On');
        $targeturl = "";
        try{        
            // dd(123456789);
            $request->session()->put('PostFrom', "PostFrom");
            $RandomNumber = "";
            $Language = "";
            $RandomNumber1 = "";
            $decryptedData = "";
            $ParentId = "";
        
            $data = $request['data'];
            if ($data == "" || $data == null){

                $request->session()->put('ErrorCode', 4);                
                $targeturl = "testlist";
                return redirect($targeturl);
                
            }else{
                
                //----- Decrypting the query string
                
                $decryptedData = $this->Base64Decode($data);
                //----- Getting language
                // dd($decryptedData);
                // Language = Request.QueryString["target"];
                $Language = $request['target'];
                // dd($Language);
                App::setLocale($Language);
                // Session["lang"] = Language;
                $request->session()->put('lang', $Language);
                // $targeturl = "Home.aspx";
                $targeturl = "homeaddusers";
                // return redirect($targeturl);

                if ($Language == "" || $Language == null){
                    // Language = "en";
                    // Session["lang"] = Language;
                    $Language = "en";
                    $request->session()->put('lang', $Language);
                }

                //     if (decryptedData == "" || decryptedData == null)
                if ($decryptedData == "" || $decryptedData == null){
                    // dd(654);
                    // Session["ErrorCode"] = 4;
                    // Response.Redirect(targeturl);
                    $request->session()->put('ErrorCode', 4);
                    return redirect($targeturl);
                    // return redirect()->route($targeturl);

                }else{
                    // dd(987);
                    // env('DB_SQL_CONNECTION');
                    $mssqluser_hostname = $this->DB_SQL_HOST;        
                    $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
                    $mssqluser_password = $this->DB_SQL_PASSWORD;
                    $mssqluser_name= $this->DB_SQL_USERNAME;
                    
                    // $conn = new PDO("sqlsrv:Server=$mssqluser_hostname,1433;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");
                    // dd($conn);

                    $db_ext = DB::connection('sqlsrv');
                    // dd($db_ext);
                    $decryptedData = $decryptedData;
                    // dd($decryptedData);
                    $Output = 0;
                    // $data = $db_ext->select("EXEC spGetFitnessUser $decryptedData");
                    // $data = "EXEC spUserFitIndiaAuthentcationWeb '$decryptedData',$Output";
                    // dd($data);
                    $conn = new PDO("sqlsrv:Server=$mssqluser_hostname,1433;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");
                    // dd($conn);
                    $dataresult = $conn->prepare("EXEC spUserFitIndiaAuthentcationWeb "."'$decryptedData'".",$Output");
                    $dataresult->execute();           
                    $data = $dataresult->fetchAll(PDO::FETCH_ASSOC);
                    // dd($data);
                    // $data = $db_ext->select("EXEC spUserFitIndiaAuthentcationWeb "."'$decryptedData'".",$Output");
                    // echo '<pre>';
                    // print_r($data);
                    // exit;
                    // dd($data);
                    if ($Output == 0){
                        // dd($data[0]);
                        // Session["ParentUserId"] = ds.Tables[0].Rows[0]["F365Id"];
                        // Session["Name"] = ds.Tables[0].Rows[0]["Name"];
                        // Session["Emailid"] = ds.Tables[0].Rows[0]["EmailId"];
                        // Session["Gender"] = ds.Tables[0].Rows[0]["Gender"];
                        // Session["MobileNo"] = ds.Tables[0].Rows[0]["MobileNo"];
                        // Session["ErrorCode"] = 0;
                        // dd($data[0]->ParentId);
                        // dd($data);
                        if($data[0]->ParentId == null){
                            $ParentId = 0;
                        }else{
                            $ParentId = $data[0]->F365Id;
                        }
                        // dd($ParentId);
                        $F365Id = $data[0]->F365Id;
                        $type = 1;
                        $request->session()->put('lang', $Language);
                        $request->session()->put('ParentUserId', $data[0]->F365Id);
                        $request->session()->put('ParentId', $ParentId);
                        $request->session()->put('Name', $data[0]->Name);
                        $request->session()->put('Emailid', $data[0]->EmailID);
                        // dd(1);
                        $request->session()->put('Gender', $data[0]->Gender);
                        $request->session()->put('MobileNo', $data[0]->MobileNo);
                        $request->session()->put('ErrorCode', 0);
                        // SqlCommand sqlComm = new SqlCommand("spGetFitnessUser", Con);
                        $userinformation = $db_ext->select("EXEC spGetFitnessUser $F365Id,$type");
                        // dd($userinformation[0]);
                        foreach($userinformation as $x => $val) {
                            // dd($val->F365Id);
                            // dd($val->ParentId);
                            if($val->F365Id == $val->ParentId){
                                // HttpContext.Current.Session["hidname"] = ds.Tables[0].Rows[0]["Name"];
                                // HttpContext.Current.Session["F365Id"] = ds.Tables[0].Rows[0]["F365Id"];
                                // HttpContext.Current.Session["Age"] = ds.Tables[0].Rows[0]["Age"];
                                // HttpContext.Current.Session["AgeGroupId"] = ds.Tables[0].Rows[0]["AgeGroupId"];
                                // HttpContext.Current.Session["AgeGroupName"] = ds.Tables[0].Rows[0]["AgeGroupName"];
                                // HttpContext.Current.Session["GenderId"] = ds.Tables[0].Rows[0]["GenderId"];
                                // HttpContext.Current.Session["IsChecked"] = "0";

                                $request->session()->put('hidname',$val->Name);
                                $request->session()->put('F365Id',$val->F365Id);
                                $request->session()->put('Age' , $val->Age);
                                $request->session()->put('AgeGroupId' , $val->AgeGroupId);
                                $request->session()->put('AgeGroupName' , $val->AgeGroupName);
                                $request->session()->put('GenderId' , $val->GenderId);
                                $request->session()->put('IsChecked' , "0");
                            }
                        }
                        return redirect($targeturl);
                    }elseif ($Output == 2){
                        // Session["ErrorCode"] = output;
                        // Response.Redirect(targeturl);
                        $request->session()->put('ErrorCode', 'output');
                        // return redirect()->route($targeturl);
                        // Response.Redirect($targeturl);
                        return redirect($targeturl);
                    // else if (output == 3)
                    }elseif($Output == 3){
                        // Session["ErrorCode"] = output;
                        // Response.Redirect(targeturl);
                        $request->session()->put('ErrorCode', 'output');
                        // return redirect()->route($targeturl);
                        // Response.Redirect($targeturl);
                        return redirect($targeturl);
                    }
                }
                //  Response.Redirect(targeturl);
                // Response.Redirect($targeturl);
                return redirect($targeturl);
            }
        }catch (\Exception $e) {
            // dd(456789);
            return $e->getMessage();
        }
    }
    public function GetInstructiontPopup(Request $request){

        $db_ext = DB::connection('sqlsrv');

        $Testtypeinstructionsfitindia = $db_ext->table('TestTypeInstructionsFitIndia')->where([['TestTypeId','=',$request->TestTypeId],['AgeGroupId','=',$request->AgeGroupId]])->get();

        return response()->json(['filename'=>'dotnetdatabase.','data'=>$Testtypeinstructionsfitindia]);
    }
    public function homelistview(Request $request){                
        try {
            $db_ext = DB::connection('sqlsrv');
            $userid = $request->session()->get('ParentUserId');

            $type = 1;        
            $data = $db_ext->select("EXEC spGetFitnessUser $userid,$type");
            
            krsort($data);
            
            $ParentId = $data[0]->ParentId;
            if($ParentId != null){        
                $typedata = 2;
                $datacount = $db_ext->select("EXEC spGetFitnessUser $ParentId,$typedata");
                $countdatacount = count($datacount);
            }else{
                $countdatacount = 0;
            }
            $Language=Session::get('lang');
            App::setLocale($Language);     
            return view('static.homemember', [
                'data' => $data,
                'countdatacount' => $countdatacount

            ]);
        } catch (Exception $e) {
            return view('404');
        }	
    }
    public function storedata(Request $request){

        try {
            $hidF365 = $request['hidF365'];

            $this->validate($request, [
                // 'email'   => 'required|email',
                // 'password' => 'required|min:6',
                // 'captcha' => ['required','captcha'],
                ],[
                    // 'email.required' => 'The Email field is required.',
                    // 'email.email' => 'Please enter the valid Email ID',
                    // 'password.required' => 'The Password field is required.',
                    // 'captcha.required' => 'The captcha field is required.',
                    // 'captcha.captcha' => 'Invalid Captcha',
                ]
            );

            if($request->file('fileUpload1')){
                $year = date("Y/m");
                $imageName = $request->file('fileUpload1')->store($year,['disk'=> 'uploads']);
                // $imagefullpath = url('wp-content/uploads/'.$imageName);
                $imagefullpath = url('wp-content/uploads/'.$imageName);
            }else{

            }            

            $KheloIndiaId = 0;
            $UserName = "";
            $FirstName = $request['FirstName'];            
            $parent_mobileno = $request->session()->get('MobileNo');
            $MobileNo = $parent_mobileno;
            $dob = $request['dob'];            
            $parent_emailid = $request->session()->get('Emailid');
            $email = $parent_emailid;
            $GenderGroup = $request['GenderGroup'];
            $AddressLine1 = "";
            $AddressLine2 = "";
            $District = 0;
            $State = 0;
            $PinCode = 0;
            $PreferredSports = "";
            $UserPrivacyAcceptance = 0;
            $UserPrivacyAcceptanceDateTime = "";
            $UIDTypeId = 0;
            $UIDNo = "";
            $disability= "";
            $hidF365 = $request['hidF365'];

            if($hidF365 == 0){                

                $parentid = Session::get('ParentUserId');                
                $imageName = 0;
                $imagefullpath = 0;
                $F365Id = "''";
        
            }else if($hidF365 != 0){
                
                $parentid = Session::get('ParentUserId');;
                $F365Id = $request['hidF365'];   
            }
            $PrivacyAcceptedVersion = 0;
            $PhotoPath = $imageName;
            $PhotoName = $imagefullpath;
            $ContentType= "image/bmp";
            $Data = 'NULL';
            $db_ext = DB::connection('sqlsrv');            
            $data = $db_ext->insert("EXEC spKheloIndiaFitnessSignup $F365Id,$KheloIndiaId,"."'$UserName'".","."'$FirstName'".","."'$MobileNo'".","."'$email'".","."'$dob'".",$GenderGroup,"."'$AddressLine1'".","."'$AddressLine2'".",$District,$State,$PinCode,"."'$PreferredSports'".",$UserPrivacyAcceptance,"."'$UserPrivacyAcceptanceDateTime'".",$UIDTypeId,"."'$UIDNo'".","."'$disability'".",$parentid,"."'$PrivacyAcceptedVersion'".","."'$PhotoPath'".","."'$PhotoName'".","."'$ContentType'".",$Data");
        } catch (Exception $e) {
            return view('404');
        }	

    }
    public function getdata($id){
        try {
            $db_ext = DB::connection('sqlsrv');
            $data = $db_ext->select("EXEC spGetChildData $id");
            return response()->json(['success' => true, 'message' => 'records found', 'data' => $data[0]]);
        } catch (Exception $e) {
            return view('404');
        }	        
    }
    public function deactivatemember($id){
        try {
            $isActive = 0;
            $db_ext = DB::connection('sqlsrv');
            $data = $db_ext->insert("EXEC spActiveChild $id,$isActive");        
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function activatemember($id){
        try {
            $isActive = 1;
            $db_ext = DB::connection('sqlsrv');
            $data = $db_ext->insert("EXEC spActiveChild $id,$isActive");
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function getalldata(Request $request, $ParentId){

        try {
            $db_ext = DB::connection('sqlsrv');
            $userid = $request->session()->get('ParentUserId');
            $type = 2;
            $data = $db_ext->select("EXEC spGetFitnessUser $ParentId,$type");        
            return response()->json(['success' => true, 'message' => 'records found', 'data' => $data]);
        } catch (Exception $e) {
            return view('404');
        }

    }
    // public function memberdashboard(Request $request, $memberId, $Age){
    public function memberdashboard(Request $request,$Name,$F365Id,$Age,$AgeGroupId,$AgeGroupName,$GenderId){
        
        try{        
            $Language=Session::get('lang');        
            App::setLocale($Language);
            $db_ext = DB::connection('sqlsrv');
            $date = "null";        
            $memberId = $F365Id;
            $request->session()->put('hidname', $Name);
            $request->session()->put('F365Id', $F365Id);
            $request->session()->put('Age', $Age);
            $request->session()->put('AgeGroupId', $AgeGroupId);
            $request->session()->put('AgeGroupName', $AgeGroupName);
            $request->session()->put('GenderId' , $GenderId);
            $request->session()->put('UID' , 0);
            $request->session()->put('IsChecked' , "0");

            $mssqluser_hostname = $this->DB_SQL_HOST;        
            $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
            $mssqluser_password = $this->DB_SQL_PASSWORD;
            $mssqluser_name= $this->DB_SQL_USERNAME;
            
            $conn = new PDO("sqlsrv:Server=$mssqluser_hostname,1433;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");
            
            $stmt = $conn->prepare("EXEC sp_DashboardReportCard $date,$memberId");
            
            $stmt->execute();
            
            $resultSet1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $stmt->nextRowset();

            
            $resultSet2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $DisplayDate = $resultSet2[0]['DisplayDate']; //10 May 2023
            
            $stmt = $conn->prepare("EXEC sp_DashboardReportCard "."'$DisplayDate'".",$memberId");        

            $stmt->execute();        
            
            $userprofile = $stmt->fetchAll(PDO::FETCH_ASSOC);   //Done        
            
            $stmt->nextRowset();

            // Fetch the second result set
            $alldate = $stmt->fetchAll(PDO::FETCH_ASSOC);        

            $stmt->nextRowset();
            $resultSet5 = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            // dd($resultSet5);
            $stmt->nextRowset();
            $OverallFitnessScore = $stmt->fetchAll(PDO::FETCH_ASSOC);        

            $stmt->nextRowset();
            $resultSet7 = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // dd(count($resultSet7));
            if(count($resultSet7) != 0){

                $user_wight = $resultSet7[0]['Score']/1000; //user wight
                $user_hight = $resultSet7[1]['Score']/10; //user hight

            }else{

                $user_wight = "";
                $user_hight = "";
            }
            $age = Session::get('Age'); //user wight
            $age_group = Session::get('AgeGroupId'); //user wight
            $stmt->nextRowset();
            $BodyMassIndex = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the statement handle
            $stmt->closeCursor();


            return view('static.dashbordmember', [
                'userprofile' => $userprofile,
                'user_wight' => $user_wight,
                'user_hight' => $user_hight,
                'age' => $age,
                'age_group' => $age_group,
                'OverallFitnessScore' => $OverallFitnessScore,
                'BodyMassIndex' => $BodyMassIndex,
                'alldate' => $alldate,
                'AgeGroupId' => $AgeGroupId,
                'resultSet5' => $resultSet5,
                'resultSet7' => $resultSet7,
                'DisplayDate' => $DisplayDate,
            ]);
        } catch (Exception $e) {
            return view('404');
        }

    }
    public function datewisedashboard(Request $request){
        
        try{
            $Language=Session::get('lang');

            App::setLocale($Language);
            
            $memberId = $request['userprofileF365Id'];
            $DisplayDate = $request['TestDate'];
            $AgeGroupId = 3;        
            $mssqluser_hostname = $this->DB_SQL_HOST;        
            $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
            $mssqluser_password = $this->DB_SQL_PASSWORD;
            $mssqluser_name= $this->DB_SQL_USERNAME;
            $conn = new PDO("sqlsrv:Server=$mssqluser_hostname;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");

            $stmt = $conn->prepare("EXEC sp_DashboardReportCard "."'$DisplayDate'".",$memberId");
         

            $stmt->execute();
            
            // Fetch the first result set
            $userprofile = $stmt->fetchAll(PDO::FETCH_ASSOC);   //Done

            // Move to the next result set
            $stmt->nextRowset();

            // Fetch the second result set
            $alldate = $stmt->fetchAll(PDO::FETCH_ASSOC);            

            $stmt->nextRowset();
            $resultSet5 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // dd($resultSet5);

            $stmt->nextRowset();
            $OverallFitnessScore = $stmt->fetchAll(PDO::FETCH_ASSOC);            

            $stmt->nextRowset();
            $resultSet7 = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($resultSet7) != 0){

                $user_wight = $resultSet7[0]['Score']/1000; //user wight
                $user_hight = $resultSet7[1]['Score']/10; //user hight

            }else{

                $user_wight = "";
                $user_hight = "";
            }

            $age = 28; //user wight
            $age_group = '19-65'; //user wight
            $stmt->nextRowset();
            $BodyMassIndex = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return view('static.dashbordmember', [
                'userprofile' => $userprofile,
                'user_wight' => $user_wight,
                'user_hight' => $user_hight,
                'age' => $age,
                'age_group' => $age_group,
                'OverallFitnessScore' => $OverallFitnessScore,
                'BodyMassIndex' => $BodyMassIndex,
                'alldate' => $alldate,
                'AgeGroupId' => $AgeGroupId,
                'resultSet5' => $resultSet5,
                'resultSet7' => $resultSet7,
                'DisplayDate' => $DisplayDate,
            ]);
        } catch (Exception $e) {
            return view('404');
        }

    }
    public function memberviewreport($userF365Id,$UserDisplayDate,Request $request){

        
        try{
            $memberId = $request->session()->get('F365Id');        
            $DisplayDate = $UserDisplayDate;        
            $mssqluser_hostname = $this->DB_SQL_HOST;        
            $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
            $mssqluser_password = $this->DB_SQL_PASSWORD;
            $mssqluser_name= $this->DB_SQL_USERNAME;
            // DB_SQL_user_name
            $conn = new PDO("sqlsrv:Server=$mssqluser_hostname;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");
            $stmt = $conn->prepare("EXEC sp_DashboardReportCard"."'$DisplayDate'".",$memberId");            

            $stmt->execute();
            
            // Fetch the first result set
            $userprofile = $stmt->fetchAll(PDO::FETCH_ASSOC);   //Done            
            // Move to the next result set
            $stmt->nextRowset();

            // Fetch the second result set
            $alldate = $stmt->fetchAll(PDO::FETCH_ASSOC);            

            $stmt->nextRowset();
            $resultSet5 = $stmt->fetchAll(PDO::FETCH_ASSOC);            

            $stmt->nextRowset();
            $OverallFitnessScore = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->nextRowset();
            $resultSet7 = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->nextRowset();
            $resultSet8 = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if(count($alldate) > 1){
    
                $stmt = $conn->prepare("EXEC sp_F365ReportCardPrevious"."'$DisplayDate'".",$memberId");

                $stmt->execute();

                // Fetch the first result set
                $userprofilePrevious = $stmt->fetchAll(PDO::FETCH_ASSOC);   //Done
            
                // Move to the next result set
                $stmt->nextRowset();

                // Fetch the second result set
                $alldatePrevious = $stmt->fetchAll(PDO::FETCH_ASSOC);            

                $stmt->nextRowset();
                $resultSet5Previous = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt->nextRowset();
                $OverallFitnessScorePrevious = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt->nextRowset();
                $resultSet7Previous = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // dd($resultSet7Previous);

                $stmt->nextRowset();
                $resultSet8Previous = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // dd($resultSet8Previous);

            }else{
                $userprofilePrevious = array();
                $alldatePrevious = array();
                $resultSet5Previous = array();
                $OverallFitnessScorePrevious = array();
                $resultSet7Previous = array();
                $resultSet8Previous = array();
            }

            return view('static.memberviewreport', [
                'userF365Id' => $userF365Id,
                'UserDisplayDate' => $UserDisplayDate,
                'userprofile' => $userprofile,
                'alldate' => $alldate,
                'resultSet5' => $resultSet5,
                'OverallFitnessScore' => $OverallFitnessScore,
                'resultSet7' => $resultSet7,
                'resultSet8' => $resultSet8,
                'userprofilePrevious' => $userprofilePrevious,
                'alldatePrevious' => $alldatePrevious,
                'resultSet5Previous' => $resultSet5Previous,
                'OverallFitnessScorePrevious' => $OverallFitnessScorePrevious,
                'resultSet7Previous' => $resultSet7Previous,
                'resultSet8Previous' => $resultSet8Previous,
            ]);
        } catch (Exception $e) {
            return view('404');
        }


    }
    public function memberfitnesshistory($userF365Id){
        
        try{

            $db_ext = DB::connection('sqlsrv');
            $FitnessHistory = $db_ext->select("EXEC spGetFitnessHistory $userF365Id");
            $datewise = $FitnessHistory[0]->DisplayDate;
         
            foreach ($FitnessHistory as $key => $value){
         
                $displayalldata[$key]['DisplayDate'] = $value->DisplayDate;
                $displayalldata[$key]['DATE'] = $value->DATE;
                $displayalldata[$key]['F365Id'] = $value->F365Id;
                $displayalldata[$key]['Name'] = $value->Name;
                $displayalldata[$key]['Age'] = $value->Age;
                $displayalldata[$key]['BMI'] = $value->BMI;
                $displayalldata[$key]['Weight'] = $value->Weight;
                $displayalldata[$key]['Height'] = $value->Height;
                $displayalldata[$key]['UW'] = $value->UW;
                $displayalldata[$key]['N'] = $value->N;
                $displayalldata[$key]['OW'] = $value->OW;
                $displayalldata[$key]['OB'] = $value->OB;
                $displayalldata[$key]['STATUS'] = $value->STATUS;

                    $datawise = $db_ext->select("EXEC spGetTestHistoryData $userF365Id,"."'$value->DisplayDate'"."");
         
                    foreach($datawise as $k => $v){
                        // dd($v);
                        if($value->DisplayDate == $v->DisplayDate){

                            $displayalldata[$key][$k]['DisplayDateV'] = $v->DisplayDate;
                            $displayalldata[$key][$k]['DATEV'] = $v->DATE;
                            $displayalldata[$key][$k]['F365IdV'] = $v->F365Id;
                            $displayalldata[$key][$k]['Test_Category_IDV'] = $v->Test_Category_ID;
                            $displayalldata[$key][$k]['TCNV'] = $v->TCN;
                            $displayalldata[$key][$k]['TestTypeIdV'] = $v->TestTypeId;
                            $displayalldata[$key][$k]['TTNV'] = $v->TTN;
                            $displayalldata[$key][$k]['Score_CriteriaV'] = $v->Score_Criteria;
                            $displayalldata[$key][$k]['Score_MeasurementV'] = $v->Score_Measurement;
                            $displayalldata[$key][$k]['ScoreV'] = $v->Score;
                            $displayalldata[$key][$k]['PercentileV'] = $v->Percentile;

                        }
                    }
            }
         
            return view('static.memberfitnesshistory', [
                'userF365Id' => $userF365Id,
                'FitnessHistory' => $FitnessHistory,
                'displayalldata' => $displayalldata
            ]);
        } catch (Exception $e) {
            return view('404');
        }
        
    }
    public function takpsave600mtupsave(Request $request){
        try{
            $db_ext = DB::connection('sqlsrv');
            $F365Id=$request->UserId;
            $AgeGroupId=$request->AgeGroupId;
            $ParentId=$request->ParentId;
            $Age=$request->Age;
            $Gender=$request->Gender;
            $testtypeid=$request->TestTypeId;

            $score=$request->Score600;

            $scoreunit=$request->Score600unit;

            $data11 = $db_ext->insert("EXEC spSaveIndividualTestData $F365Id,$AgeGroupId,$testtypeid,$score,"."'$scoreunit'".",$ParentId,$Age,$Gender");

            $data12=$db_ext->select("EXEC spGetTestResult $F365Id");

            return $data12;
        } catch (Exception $e) {
            return view('404');
        }

    }
    public function takpsavepushupsave(Request $request){

        try{
            $db_ext = DB::connection('sqlsrv');

            $F365Id=$request->UserId;
            $AgeGroupId=$request->AgeGroupId;
            $ParentId=$request->ParentId;
            $Age=$request->Age;
            $Gender=$request->Gender;
            $testtypeid=$request->TestTypeId;

            $score=$request->ScorePushup;
            $scoreunit=$request->ScorePushupunit;

            $data9 = $db_ext->insert("EXEC spSaveIndividualTestData $F365Id,$AgeGroupId,$testtypeid,$score,"."'$scoreunit'".",$ParentId,$Age,$Gender");

            $data10=$db_ext->select("EXEC spGetTestResult $F365Id");

            return $data10;
        } catch (Exception $e) {
            return view('404');
        }

    }
    public function takpartialcurlsave(Request $request){
        try{
            $db_ext = DB::connection('sqlsrv');

            $F365Id=$request->UserId;
            $AgeGroupId=$request->AgeGroupId;
            $ParentId=$request->ParentId;
            $Age=$request->Age;
            $Gender=$request->Gender;
            $score=$request-> ScorePartial;
            $scoreunit=$request->ScorePartialunit;
            $testtypeid=$request->TestTypeId;

            $data8 = $db_ext->insert("EXEC spSaveIndividualTestData $F365Id,$AgeGroupId,$testtypeid,$score,"."'$scoreunit'".",$ParentId,$Age,$Gender");

            $data9=$db_ext->select("EXEC spGetTestResult $F365Id");

            return $data9;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function taksave50mtdashsave(Request $request){
        try{
            $db_ext = DB::connection('sqlsrv');

            $F365Id=$request->UserId;
            $score=$request->Score50;
            $scoreunit=$request->Score50unit;
            $AgeGroupId=$request->AgeGroupId;
            $ParentId=$request->ParentId;
            $Age=$request->Age;
            $Gender=$request->Gender;
            $testtypeid=$request->TestTypeId;

            $data6 = $db_ext->insert("EXEC spSaveIndividualTestData $F365Id,$AgeGroupId,$testtypeid,$score,"."'$scoreunit'".",$ParentId,$Age,$Gender");

            $data7=$db_ext->select("EXEC spGetTestResult $F365Id");

            return $data7;
        } catch (Exception $e) {
            return view('404');
        }

    }
    public function taktestsitrichsave(Request $request){

        try{
            $db_ext = DB::connection('sqlsrv');

            $F365Id=$request->UserId;
            $score=$request->score;
            $scoreunit=$request->scoreunit;
            $AgeGroupId=$request->AgeGroupId;
            $ParentId=$request->ParentId;
            $Testtypeid=$request->TestTypeId;
            $Age=$request->Age;
            $Gender=$request->Gender;

            if($Gender=='male'){
            $Gender=1;
            }

            if($Gender=='female'){
            $Gender=2;
            }

            if($Gender=='Transgender'){
            $Gender=3;
            }

            $data4 = $db_ext->insert("EXEC spSaveIndividualTestData $F365Id,$AgeGroupId,$Testtypeid,$score,"."'$scoreunit'".",$ParentId,$Age,$Gender");

            $data5=$db_ext->select("EXEC spGetTestResult $F365Id");

            return $data5;
        } catch (Exception $e) {
            return view('404');
        }

    }
    public function taktestsave(Request $request){


        try{

            $db_ext = DB::connection('sqlsrv');
            $F365Id=$request->UserId;
            $Height=$request->Height;
            $Weight=$request->Weight;
            $AgeGroupId=$request->AgeGroupId;
            $ParameterOfWeight=$request->ParameterOfWeight;
            $ParameterOfHeight=$request->ParameterOfHeight;
            $Age=$request->Age;
            $Gender=$request->Gender;

            $ParentId=$request->ParentId;
        
            $data1 = $db_ext->insert("EXEC spSaveIndividualTestData $F365Id,$AgeGroupId,6,$Weight,"."'$ParameterOfWeight'".",$ParentId,$Age,$Gender");

            $data2 = $db_ext->insert("EXEC spSaveIndividualTestData $F365Id,$AgeGroupId,7,$Height,"."'$ParameterOfHeight'".",$ParentId,$Age,$Gender");

            $data3 = $db_ext->select("EXEC spGetTestResult $F365Id");

            return $data3;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function taketestview(Request $request ){

        try{
            $Language=Session::get('lang');
            
            App::setLocale($Language);
            $db_ext = DB::connection('sqlsrv');
            $F365Id = $_GET['F365Id'];
            // dd($F365Id);
            // $F365Id=328243;

            $data=$db_ext->select("EXEC spGetTestResult  $F365Id");

            return view('static.taketest',['data'=>$data]);
        } catch (Exception $e) {
            return view('404');
        }

    }
    public function usersdashboard(Request $request){
        try{
                $Userid=$request->UserId;
                $db_ext = DB::connection('sqlsrv');
                
                $mssqluser_hostname = $this->DB_SQL_HOST;        
                $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
                $mssqluser_password = $this->DB_SQL_PASSWORD;
                $mssqluser_name= $this->DB_SQL_USERNAME;

                // DB_SQL_user_name
                $conn = new PDO("sqlsrv:Server=$mssqluser_hostname;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");

                // Prepare the stored procedure call
                $f365id = $request->UserId;
                $stmt = $conn->prepare("EXEC spGetOverallPercentage $f365id");

                // Execute the stored procedure
                $stmt->execute();

                // Fetch the first result set
                $resultSet1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt->nextRowset();

                $resultSet2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt->closeCursor();
                $data=[$resultSet1,$resultSet2 ];

                return $data;

            } catch (Exception $e) {
                return view('404');
            }


    }  
    function HeightConvertern($mm)
    {
        try{
            $stmm = "0";
            $stcm = "0";
            $cm = floor($mm / 10);
            $mm = $mm % 10;
            $stmm = $mm;
            $stcm = $cm;
            $swt = $stcm . "." . $stmm . "";
            return $swt;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function WeightConverter($gr)
    {
        try{
            $stg = "0";
            $stkg = "0";
            $kg = floor($gr / 1000);
            $gr = $gr % 1000;
            $stg = $gr;
            $stkg = $kg;
            $swt = $stkg . "." . $stg;
            return $swt;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function TimeConverter($strmsec)
    {
        try{
            $msec = floatval($strmsec);
            $stsec = "0";
            $stmsec = "0";
            $stmin = "0";
            $sec = floor($msec / 1000);
            $msec = $msec % 1000;
            $stmsec = $msec;
            $min = floor($sec / 60);
            $stmin = $min;
            $sec = $sec % 60;
            $stsec = $sec;
            //string mn = stmin + ":" + stsec + ":" + stmsec + " min";
            $mn = $stsec . "." . $stmsec;
            return $mn;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function ShowresultScore($strmsec)
    {
       try{
            $msec = floatval($strmsec);
            $stsec = "0";
            $stmsec = "0";
            $stmin = "0";
            $sec = floor($msec / 1000);
            $msec = $msec % 1000;
            $stmsec = $msec;
            $min = floor($sec / 60);
            $stmin = $min;
            $sec = $sec % 60;
            $stsec = $sec;
            //string mn = stmin + ":" + stsec + ":" + stmsec + " min";
            $mn = "";
            //string mn = stmin + ":" + stsec + ":" + stmsec + " min";
            if ($stmin == "0")
                $mn = $stsec . "." . $stmsec . " sec";
            else
                $mn = $stmin . "." . $stsec . "." . $stmsec . " sec";
            return $mn;
        } catch (Exception $e) {
            return view('404');
        }
        //return mn;
    }
    public function Showresult($strmsec)
    {
        try{
            $msec = $strmsec;
            $stsec = "0";
            $stmsec = "0";
            $stmin = "0";
            $sec = floatval($msec / 1000);
            $msec = $msec % 1000;
            $stmsec = $msec;
            $min = floatval($sec / 60);
            $stmin = $min;
            $sec = $sec % 60;
            $stsec = $sec;
            $mn = "";


            $decimalindex = strrpos($stmin, '.');
            $intvalue = substr($stmin , 0, $decimalindex);
            $decimalvalue = substr($stmin , $decimalindex + 1);
            $finaldecimalvalue = substr($decimalvalue, 0, 2);
            
            $sec = $sec % 60;
            $stsec = $sec;
            $mn = "";


            if ($stmin != "0") {
                $mn = $intvalue.'.'.$finaldecimalvalue.' '. _('testhome.label94') ." ". $stsec . "." . $stmsec . _('testhome.label95');
            } else {
                $mn = $stsec . "." . $stmsec . __('testhome.label95');
            }

            return $mn;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function FitnessTestGrades($ftscore)
    {
        try{
            $grade = "";
            if ($ftscore >= 90)
                $grade = "L7";
            else
                if ($ftscore >= 80)
                $grade = "L6";
            else
                    if ($ftscore >= 70)
                $grade = "L5";
            else
                        if ($ftscore >= 60)
                $grade = "L4";
            else
                //if (ftscore >= 45)
                if ($ftscore >= 40)
                    $grade = "L3";
                else
                    //  if (ftscore >= 35)
                    if ($ftscore >= 20)
                        $grade = "L2";
                    else
                        $grade = "L1";

            return $grade;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function LifeStyleGrades($LSScore)
    {
        try{
            $LSGrades = "";

            if ($LSScore > 16)
                $LSGrades = "A";
            else
                if ($LSScore >= 12)
                $LSGrades = "B";
            else
                    if ($LSScore >= 8)
                $LSGrades = "C";
            else
                        if ($LSScore >= 4)
                $LSGrades = "D";
            else
                $LSGrades = "E";

            return $LSGrades;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function mthdBMIInterpretation($bmistatus)
    {
        try{
            $bmidisplay = "";
            if ($bmistatus == "N")
                $bmidisplay = __('testhome.label101');
            else if ($bmistatus == "UW")
                $bmidisplay =  __('testhome.label102');
            else
                if (($bmistatus == "OW") || ($bmistatus == "OB"))
                $bmidisplay = __('testhome.label103');
            return $bmidisplay;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function mthdRatingTotalLifestyleScore($totallifestylescore)
    {
       try{
            $ratingtotallifestylescore = "";
            if ($totallifestylescore > 48)
                $ratingtotallifestylescore = "A";
            else
                if ($totallifestylescore >= 36)
                $ratingtotallifestylescore = "B";
            else
                    if ($totallifestylescore >= 24)
                $ratingtotallifestylescore = "C";
            else
                        if ($totallifestylescore >= 12)
                $ratingtotallifestylescore = "D";
            else
                $ratingtotallifestylescore = "E";

            return $ratingtotallifestylescore;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function mthdTitleTtlFitnessScore($ratingttlfitnesscr)
    {
        try{
            $TitleTtlFitnessScore = "";
            switch ($ratingttlfitnesscr) {
                case "L7":
                    $TitleTtlFitnessScore = "Athletic";
                    break;
                case "L6":
                    $TitleTtlFitnessScore = "Sports fit";
                    break;
                case "L5":
                    $TitleTtlFitnessScore = "Very Good";
                    break;
                case "L4":
                    $TitleTtlFitnessScore = "Good";
                    break;
                case "L3":
                    $TitleTtlFitnessScore = "Can do better";
                    break;
                case "L2":
                    $TitleTtlFitnessScore = "Must improve";
                    break;
                case "L1":
                    $TitleTtlFitnessScore = "Work Harder";
                    break;
                default:
                    $TitleTtlFitnessScore = "";
                    break;
            }
            return $TitleTtlFitnessScore;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function mthdTitleTtlLifeStyleScore($ratingtotallifestylescore)
    {
        try{
            $TitleTtlLifeStyleScore = "";
            switch ($ratingtotallifestylescore) {
                case "A":
                    $TitleTtlLifeStyleScore = "Excellent";
                    break;
                case "B":
                    $TitleTtlLifeStyleScore = "Very Good";
                    break;
                case "C":
                    $TitleTtlLifeStyleScore = "Good";
                    break;
                case "D":
                    $TitleTtlLifeStyleScore = "Improve";
                    break;
                case "E":
                    $TitleTtlLifeStyleScore = "Change";
                    break;
                default:
                    $TitleTtlLifeStyleScore = "";
                    break;
            }
            return $TitleTtlLifeStyleScore;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function mthdTitleBMI($bmistatus)
    {
        try{
            $$TitleBMI = "";
            switch ($bmistatus) {
                case "UW":
                    $TitleBMI = "Under Weight";
                    break;
                case "N":
                    $TitleBMI = "Normal";
                    break;
                case "OW":
                    $TitleBMI = "Over Weight";
                    break;
                case "OB":
                    $TitleBMI = "Obese";
                    break;
                default:
                    $TitleBMI = "NA";
                    break;
            }
            return $TitleBMI;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function mthdBMIStatus($chkbmi, $bmi)
    {
        try{
            $db_ext = DB::connection('sqlsrv');
            $bmiqry  = $db_ext->select(DB::raw("select Age,[UW],[N],[OW],[OB] from LP_BMI_List where Age = '" . $chkbmi . "'"));

            $uw = 0;
            $n = 0;
            $ow = 0;
            $ob = 0;


            if ($bmiqry) {
                $uw = floatval($bmiqry[0]->UM);
                $n = floatval($bmiqry[0]->N);
                $ow = floatval($bmiqry[0]->OW);
                $ob = floatval($bmiqry[0]->OB);
            }
            $bmistatus = "";
            if ($bmi != 0.00) {
                if ($bmi <= $uw)
                    $bmistatus = "UW";
                else
                        if ($bmi <= $ow)
                    $bmistatus = "N";
                else
                            if ($bmi <= $ob)
                    $bmistatus = "OW";
                else
                                if ($bmi > $ob)
                    $bmistatus = "OB";
            } else $bmistatus = "NA";
            return $bmistatus;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function mthdBMIRating($chkbmi, $bmi)
    {
        try{
            $bmistatus = $this->mthdBMIStatus($chkbmi, $bmi);
            $BMIRating = $this->mthdTitleBMI($bmistatus);
            return $BMIRating;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function mthdFitnessRating($perc)
    {
        try{
            $rating = $this->FitnessTestGrades($perc);
            //mthdFitnessRating(perc);
            $Title = $this->mthdTitleTtlFitnessScore($rating);
            return $Title;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function getfitnessrecomdations($level, $Test_Name)
    {
        try{
            $recomndation = "";
            if ($level == "L7") {
                $recomndation = "Sports Fit.  Keep it up!";
            } else if ($level == "L6") {
                $recomndation = "Athletic.  There is scope for improvement.";
            } else if ($level == "L5") {
                $recomndation = "Very Good.  You can improve!";
            } else {
                if ($Test_Name == "One leg stork test") {
                    $recomndation = "To improve balance, you should practice one foot balance, walking on toes and heel-toe walking, lunges and Pilates.";
                } else if ($Test_Name == "Illinois circuit") {
                    //drCampReportCard["Recommendation_" + tstname.Replace(" ", string.Empty)] = "Agility requires the integration of isolated movement skills using a combination of balance, coordination, speed, reflexes, strength, and endurance. You can practice 10m shuttle run, zigzag run, crisscross rope jumping to improve agility.";
                    $recomndation = "You can practice 10m shuttle run, zigzag run, crisscross rope jumping to improve agility.";
                } else if ($Test_Name == "30 mt. dash") {
                    $recomndation = "You can practice quick sprints (50 yards), frog hops and one leg hops to improve speed. You can also do leg stretching to increase stride length which in turn improves speed.";
                } else if ($Test_Name == "Sit and reach test") {
                    $recomndation = "You need to practice stretching, yoga, tai-chi and pilates on regular basis to develop flexibility.";
                } else if ($Test_Name == "Sargent jump") {
                    $recomndation = "You need to practice quarter squat, climb stairs,  crunches and back extension exercise.";
                } else if ($Test_Name == "Sit Ups") {
                    $recomndation = "You  need to practice to climb stairs, hill walk, cycling, dance, pushups, sit-ups, squats, crunches, power yoga etc. to build strength.";
                }
                /////////////////////////////////
                else if ($Test_Name == "Catch") {
                    $recomndation = "You can improve by practice paper airplane throw, handkerchief catch, frisbee.";
                } else if ($Test_Name == "Endurance") {
                    $recomndation = "You can do road cycling, swimming, aerobics, running and dancing to improve endurance.";
                } else if ($Test_Name == "Throw") {
                    $recomndation = "You can improve by practice paper airplane throw,Frisbee.";
                }
            }

            return $recomndation;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function testresulthistory(Request $request ,$F365Id,$Testtypeid,$Age) 
    {
        try{
        $Language=Session::get('lang');
        
        App::setLocale($Language);
  
        $db_ext = DB::connection('sqlsrv');
        // $bmiqry  = $db_ext->select(DB::raw("select Age,[UW],[N],[OW],[OB] from LP_BMI_List where Age = '73f' "));
        // dd( $bmiqry);
        
        $TestTypeId = $Testtypeid;
        $Userid = $F365Id;
        $Userage=$Age;
        $date = date("m-d-Y h:i:s a");
        $testcategory = "";
        $testdescvalue = "";
        $FitnessLebel = "";
        $Feedback = "";
        $FCurrentScore="";
        $UltimateGoal="";
    
        $data = $db_ext->select(DB::raw("select TTM.Test_Name as TestName, TCM.Test_Name as TestCategory from TestTypeMaster TTM inner join TestCategoryMaster TCM on TTM.Test_Category_ID = TCM.Test_ID  where TTM.Test_Type_ID='" . $TestTypeId . "' "));
        if (($data[0]->TestCategory == 'label51') && ($data[0]->TestName == 'label56')) {
            $testcategory = "label65";
        } elseif (($data[0]->TestCategory == 'label51') && ($data[0]->TestName == 'label57')) {
            $testcategory = "label52";
        } else {
            $testcategory = $data[0]->TestCategory;
        }
    
        $testname = $data[0]->TestName;
        if ($TestTypeId == "1") {
            $testdescvalue = "label17";
        } else if ($TestTypeId == "2") {
            $testdescvalue = "label18";
        } else if ($TestTypeId == "5") {
            $testdescvalue = "label19";
        } else if ($TestTypeId == "8") {
            $testdescvalue = "label20";
        } else if ($TestTypeId == "9") {
            $testdescvalue = "label21";
        } else if ($TestTypeId == "10" || $TestTypeId == "11") {
            $testdescvalue = "label22";
        } else if ($TestTypeId == "12") {
            $testdescvalue = "";
        } else if ($TestTypeId == "13") {
            $testdescvalue = "label23";
        } else if ($TestTypeId == "55") {
            $testdescvalue = "label24";
        } else if ($TestTypeId == "54") {
            $testdescvalue = "label25";
        } else if ($TestTypeId == "19") {
            $testdescvalue = "label26";
        } else if ($TestTypeId == "59") {
            $testdescvalue = "label27";
        } else if ($TestTypeId == "60") {
            $testdescvalue = "label28";
        } else if ($TestTypeId == "57") {
            $testdescvalue = "label29";
        } else if ($TestTypeId == "1001") {
            $testdescvalue = "label31";
        } else if ($TestTypeId == "1002") {
            $testdescvalue = "label32";
        } else if ($TestTypeId == "1003") {
            $testdescvalue = "label33";
        } else if ($TestTypeId == "1004") {
            $testdescvalue = "label34";
        } else if ($TestTypeId == "1005") {
            $testdescvalue = "label35";
        } else if ($TestTypeId == "1006") {
            $testdescvalue = "label36";
        } else if ($TestTypeId == "1007") {
            $testdescvalue = "label37";
        } else if ($TestTypeId == "1008") {
            $testdescvalue = "label38";
        } else if ($TestTypeId == "1009") {
            $testdescvalue = "label39";
        }
    
        
    
        //   $mssqluser_name ='sa';
        //   $mssqluser_password ='Sai@123';
        //   $mssqluser_databases = 'FitIndia_Fitness';
        //   $mssqluser_hostname = '192.168.23.254';

        $mssqluser_hostname = $this->DB_SQL_HOST;        
        $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
        $mssqluser_password = $this->DB_SQL_PASSWORD;
        $mssqluser_name= $this->DB_SQL_USERNAME;
        $date = date("m-d-Y h:i:s a");
    
        $conn = new PDO("sqlsrv:Server=$mssqluser_hostname;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");
        $stmt = $conn->prepare("EXEC sp_GetTestHistory $Userid,'$date',$TestTypeId ");
        $stmt->execute();
        $resultSet1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->nextRowset();
        $resultSet2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $stmt->closeCursor();
      
     
      
      
  
       if ($resultSet1[0]['ScoreUnit'] == 'mm') {
        $FCurrentScore=$this->HeightConvertern(floatval($resultSet1[0]['Score'])).__('taketest.label8');
         $FScoreUnit =__('taketest.label8');
         $UltimateGoal=$this->HeightConvertern(floatval($resultSet2[0]['L7'])).__('taketest.label8');
       }
      
       if ($resultSet1[0]['ScoreUnit'] == 'msec') {
        $FCurrentScore=$this->ShowresultScore(floatval($resultSet1[0]['Score']));
         $FScoreUnit =__('taketest.label11');
         $UltimateGoal=$this->HeightConvertern(floatval($resultSet2[0]['L7'])).__('taketest.label8');
       }
  
       if ($resultSet1[0]['ScoreUnit'] == 'number') {
        $FCurrentScore=$resultSet1[0]['Score'].__('taketest.label129');
         $FScoreUnit =__('taketest.label129');
         $UltimateGoal=(floatval($resultSet2[0]['L7'])).__('taketest.label8');
       }
       
       if ($resultSet1[0]['ScoreUnit'] == 'number') {
        $FCurrentScore=$resultSet1[0]['Score'].__('taketest.label129');
         $FScoreUnit =__('taketest.label129');
         $UltimateGoal=(floatval($resultSet2[0]['L7'])).__('taketest.label8');
       }
      if(floatval($resultSet1[0]['Percentile'] )<20){
        $FitnessLebel = "L1";
        $Feedback = "";
  
      }elseif(floatval($resultSet1[0]['Percentile'] )>=20 && floatval($resultSet1[0]['Percentile'] )<40){
        $FitnessLebel = "L2";
        $Feedback = "";
  
      }elseif((floatval($resultSet1[0]['Percentile'] )>=40) && (floatval($resultSet1[0]['Percentile'] ))<60)
      {
        $FitnessLebel = "L3";
        $Feedback = "";
  
      }elseif((floatval($resultSet1[0]['Percentile'] )>=60) && (floatval($resultSet1[0]['Percentile'] ))<70)
      {
        $FitnessLebel = "L4";
        $Feedback = "";
  
      }elseif((floatval($resultSet1[0]['Percentile'] )>=70) && (floatval($resultSet1[0]['Percentile'] ))<80)
      {
        $FitnessLebel = "L5";
        $Feedback =__('userdashboard.label37');
  
      }
      elseif((floatval($resultSet1[0]['Percentile'] )>=80) && (floatval($resultSet1[0]['Percentile'] ))<90)
      {
        $FitnessLebel = "L6";
        $Feedback =__('userdashboard.label38');
  
      }
  
      if((floatval($resultSet1[0]['Percentile'] )>=90))
      {
        $FitnessLebel = "L7";
        $Feedback =__('userdashboard.label39');
  
      }
  
      if ($Feedback == "")
      {
          if ($resultSet1[0]["Test_Name"] == "Balance")
          {
              $Feedback =  __('userdashboard.label40');
          }
          else if ($resultSet1[0]["Test_Name"] == "Agility")
          {
              $Feedback =  __('userdashboard.label41');
          }
          else if ($resultSet1[0]["Test_Name"] == "Speed")
          {
              $Feedback =  __('userdashboard.label42');
          }
          else if ($resultSet1[0]["Test_Name"] == "Flexibility")
          {
              $Feedback =  __('userdashboard.label43');
          }
          else if ($resultSet1[0]["Test_Name"] == "Strength")
          {
              $Feedback =  __('userdashboard.label44');
          }
          else if ($resultSet1[0]["Test_Name"] == "Power")
          {
              $Feedback =  __('userdashboard.label45');
          }
          else
          {
              $Feedback = "";
          }
      }
  
      
        $myscore=$FCurrentScore."/".round($resultSet1[0]["Percentile"]).__('testhome.label46') ;
        $p_nxtgl= "L7/ " . $UltimateGoal . "";
        
        return view('static.testresulthistory', 
        ['testcategory' => $testcategory,
        'TestTypeId'=>$TestTypeId,
        'Userage'=>$Userage,
        'Userid'=>$F365Id,
        'testname' => $testname, 
        'testdescvalue' => $testdescvalue,
        'Feedback'=>$Feedback,
        'FitnessLebel'=>$FitnessLebel,
        'myscore'=>$myscore,
        'p_nxtgl'=>$p_nxtgl]);
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function BindData(Request $request)
    {
      try{        
            $db_ext = DB::connection('sqlsrv');
            $Userid = $request->Userid;
            $TestTypeId=$request->Testtypeid;
            $date = date("m-d-Y h:i:s a");
            $data = $db_ext->select("EXEC sp_GetTestHistory $Userid,'$date',$TestTypeId ");
            return $data;
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function classwisetestdetails(Request $request)
    {
        try{
            $Userid = $request->Userid;
            $TestTypeId=$request->Testtypeid;
            $db_ext = DB::connection('sqlsrv');
        
            // $date = "06-01-2023 12:00:00.000 AM";
            $date = date("m-d-Y h:i:s a");
        
            $age =$request->Userage;
    
            // $data = $db_ext->select("EXEC sp_StudentInAgeScoreChart ,'06-01-2023',$age,$Userid,1005");
            $StudentInAgeScoreChartdata=$db_ext->select("EXEC sp_StudentInAgeScoreChart '$date','$age','$Userid', $TestTypeId");
            
            $classwisetest_details=[];
            $classwisetest_details['bestscore']=$StudentInAgeScoreChartdata[0]->BestScore;
            $classwisetest_details['classavgscore']=$StudentInAgeScoreChartdata[0]->AvgScore;
            $classwisetest_details['myscore']=$StudentInAgeScoreChartdata[0]->IndividualScore;
            $classwisetest_details['measurement']=$StudentInAgeScoreChartdata[0]->ScoreMeasurement;
            $classwisetest_details['status']=$StudentInAgeScoreChartdata[0]->ScoreCriteria;
        
        
            if($StudentInAgeScoreChartdata[0]->ScoreMeasurement=="Time"){
                $classwisetest_details['cal_bestscore'] =$StudentInAgeScoreChartdata[0]->BestScore;
                $classwisetest_details['clac_classavg_score'] = $this->Showresult($StudentInAgeScoreChartdata[0]->AvgScore);
                $classwisetest_details['calc_myscore'] = $this->Showresult($StudentInAgeScoreChartdata[0]->IndividualScore);
            }elseif($StudentInAgeScoreChartdata[0]->ScoreMeasurement=="Distance"){
                $classwisetest_details['cal_bestscore'] =$this->HeightConvertern($StudentInAgeScoreChartdata[0]->BestScore);
                $classwisetest_details['clac_classavg_score'] =$this->HeightConvertern($StudentInAgeScoreChartdata[0]->AvgScore);
                $classwisetest_details['calc_myscore'] = $this->HeightConvertern($StudentInAgeScoreChartdata[0]->IndividualScore);
            }
            
            elseif(($StudentInAgeScoreChartdata[0]->ScoreMeasurement=="Count")||($StudentInAgeScoreChartdata[0]->ScoreMeasurement=="Fixed_Score")){
                $classwisetest_details['cal_bestscore'] =$StudentInAgeScoreChartdata[0]->BestScore.__('testhome.label96');
                $classwisetest_details['clac_classavg_score'] =$StudentInAgeScoreChartdata[0]->AvgScore.__('testhome.label96');
                $classwisetest_details['calc_myscore'] = $StudentInAgeScoreChartdata[0]->IndividualScore.__('testhome.label96');
            }
        
            return $classwisetest_details;
        } catch (Exception $e) {
            return view('404');
        }
  
    }
    public function benchmarkview(Request $request,$age,$GenderId)
    {  
        try{
            $Language=Session::get('lang');
            
            App::setLocale($Language);
            $db_ext = DB::connection('sqlsrv');
            $benchmark = $db_ext->select("EXEC spGetBenchMark $age, $GenderId");
            // dd($benchmark);
            return view('static.benchmark', ["benchmark" => $benchmark]);
        } catch (Exception $e) {
            return view('404');
        }
    }
    public function SuggestionVideos($Testtypeid,$AgeGroupId)
    {
        try{
            return view('static.suggestvideo',['Testtypeid'=>$Testtypeid,'AgeGroupId'=>$AgeGroupId]);
        } catch (Exception $e) {
            return view('404');
        }	
    }
  
    public function Suggestedvideo(Request $request)
    {
        try{
            $db_ext = DB::connection('sqlsrv');
            $data = $db_ext->select("spGetTestTypeInstructionsFitIndia $request->TestTypeId,$request->AgeGroupId");
            //  dd( $data);
            return $data;
        } catch (Exception $e) {
            return view('404');
        }	
    }

    public function Suggestionvideopopup(Request $request){
        try{
            return  $request->session()->put('suggestvideo', $request->TestTypeId);
        } catch (Exception $e) {
            return view('404');
        }	
    }
    
}
