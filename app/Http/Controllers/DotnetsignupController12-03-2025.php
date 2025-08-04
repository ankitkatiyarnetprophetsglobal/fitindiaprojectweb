<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Response;
use App\Models\SchoolWeek;
use Illuminate\Support\Facades\DB;
use PDO;

class DotnetsignupController extends Controller
{
    // server mssql conection
    private $DB_SQL_CONNECTION = 'sqlsrv';
    private $DB_SQL_HOST = '10.72.163.124';
    private $DB_SQL_PORT = '1433';
    private $DB_DATABASE_SQL_NAME = 'FitIndia_Fitness';
    private $DB_SQL_PASSWORD = 'Adm$2^3#SqlServ';
    private $DB_SQL_USERNAME = 'sa';

    public function signupdotnet(Request $request){        
        try {
            
            $apitoken = $request['apitoken'];
            $dot_net_apitoken = 'A1P002';
            // dd($dot_net_apitoken);
            $data = $request['data'];
            if ($apitoken == $dot_net_apitoken) {

                foreach ($data as $x => $val) {
                    
                    // $db_ext = DB::connection('sqlsrv');

                    $KheloIndiaId = $val['KheloIndiaId'];
                    $UserName = $val['UserName'];
                    $name = $val['Name'];
                    $MobileNo = $val['MobileNo'];
                    $EmailID = $val['EmailID'];
                    $Gender = $val['Gender'];
                    $DOB = $val['DOB'];
                    $QueryType = $val['QueryType'];
                    $AddressLine1 = $val['AddressLine1'];
                    $AddressLine2 = $val['AddressLine2'];
                    $District = $val['District'];
                    $State = $val['State'];
                    $PinCode = $val['PinCode'];
                    $UIDNo = $val['UIDNo'];
                    $Block = $val['Block'];
                    $Age = $val['Age'];
                    $Role = $val['Role'];
                    $PhotoName = $val['PhotoName'];
                    $Weight  = "";
                    $Height  = "";
                    $Distance = "";
                    $ScoreUint = "";
                    
                    // $data = $db_ext->select("EXEC spFITIndiaSignUp $KheloIndiaId," . "'$UserName'" . "," . "'$name'" . "," . "'$MobileNo'" . "," . "'$EmailID'" . "," . "'$Gender'" . "," . "'$DOB'" . "," . "'$QueryType'" . "," . "'$AddressLine1'" . "," . "'$AddressLine2'" . "," . "'$District'" . "," . "'$State'" . "," . "'$PinCode'" . "," . "'$UIDNo'" . "," . "'$Block'" . "," . "'$Age'" . "," . "'$Role'" . "," . "'$PhotoName'" . "," . "'$Weight'" . "," . "'$Height '" . "," . "'$Distance '" . "," . "'$ScoreUint'");
                    $mssqluser_hostname = $this->DB_SQL_HOST;        
                    $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
                    $mssqluser_password = $this->DB_SQL_PASSWORD;
                    $mssqluser_name= $this->DB_SQL_USERNAME;                    
                    $conn = new PDO("sqlsrv:Server=$mssqluser_hostname,1433;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");
                    // dd($conn);
                    // dd("EXEC spFITIndiaSignUp $KheloIndiaId," . "'$UserName'" . "," . "'$name'" . "," . "'$MobileNo'" . "," . "'$EmailID'" . "," . "'$Gender'" . "," . "'$DOB'" . "," . "'$QueryType'" . "," . "'$AddressLine1'" . "," . "'$AddressLine2'" . "," . "'$District'" . "," . "'$State'" . "," . "'$PinCode'" . "," . "'$UIDNo'" . "," . "'$Block'" . "," . "'$Age'" . "," . "'$Role'" . "," . "'$PhotoName'" . "," . "'$Weight'" . "," . "'$Height '" . "," . "'$Distance '" . "," . "'$ScoreUint'");
                    $dataresult = $conn->prepare("EXEC spFITIndiaSignUp $KheloIndiaId," . "'$UserName'" . "," . "'$name'" . "," . "'$MobileNo'" . "," . "'$EmailID'" . "," . "'$Gender'" . "," . "'$DOB'" . "," . "'$QueryType'" . "," . "'$AddressLine1'" . "," . "'$AddressLine2'" . "," . "'$District'" . "," . "'$State'" . "," . "'$PinCode'" . "," . "'$UIDNo'" . "," . "'$Block'" . "," . "'$Age'" . "," . "'$Role'" . "," . "'$PhotoName'" . "," . "'$Weight'" . "," . "'$Height '" . "," . "'$Distance '" . "," . "'$ScoreUint'");                    
                    // $dataresult = $conn->prepare("EXEC spFitIndiaRefNo 1994429,'ItD733MTk5NDQyOQ==NKCvqq','Login','en'");
                    $dataresult->execute();           
                    $data = $dataresult->fetchAll(PDO::FETCH_OBJ);                    
                    $MSG = $data[0]->MSG;

                    if ($MSG == 6) {
                        return Response::json(array(
                            'IsSuccess'    => "false",
                            'Message'      =>  "Data already exist",
                            'Result'   =>  "$MSG"
                        ));
                    }
                    if ($MSG == 0) {
                        $MSGid = $data[0]->Id;
                        return Response::json(array(
                            'IsSuccess'    => "true," . "$MSGid",
                            'Message'      =>  "Data Saved Successfully",
                            'Result'   =>  "$MSG"
                        ));
                    }
                    if ($MSG == 4) {
                        return Response::json(array(
                            'IsSuccess'    => "true",
                            'Message'      =>  "Data Updated Successfully",
                            'Result'   =>  "$MSG"
                        ));
                    }                    
                }
            } else {

                return Response::json(array(
                    'IsSuccess'    => "false",
                    'Message'      =>  "Invalid Token",
                    'Result'   =>  "3"
                ));
            }
        } catch (\Exception $ex) {

            $Message =  $ex->getMessage();            
            return Response::json(array(
                'IsSuccess'    => "false",
                'Message'      =>  "$Message",
                'Result'   =>  "3"
            ));
        }        
    }
    public function refnodotnet(Request $request){
        
        try {
            // dd(113123);
            $apitoken = $request['apitoken'];

            // $dot_net_refno_apitoken = env('dot_net_refno_apitoken');            
            $dot_net_refno_apitoken = 'A2P0R2';            

            $data = json_decode($request['data'], ENT_QUOTES);
            
            if ($apitoken == $dot_net_refno_apitoken) {
                foreach ($data as $x => $val) {
            
                    // $db_ext = DB::connection('sqlsrv');
            
                    $userid = $val['userid'];
                    $RefNo = $val['RefNo'];
                    $ReqURL = $val['ReqURL'];
                    $lang = $val['lang'];

                    // $data = $db_ext->select("EXEC spFitIndiaRefNo $userid,"."'$RefNo'".","."'$ReqURL'".","."'$lang'");
                    // old code
                    $mssqluser_hostname = $this->DB_SQL_HOST;        
                    $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
                    $mssqluser_password = $this->DB_SQL_PASSWORD;
                    $mssqluser_name= $this->DB_SQL_USERNAME;
                    // // dd($mssqluser_name);
                    $conn = new PDO("sqlsrv:Server=$mssqluser_hostname,1433;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");

                    // $dataresult = $conn->prepare("EXEC spFitIndiaRefNo $userid,"."'$RefNo'".","."'$ReqURL'".","."'$lang'");
                    // dd($dataresult);
                    // $dataresult->execute();           

                    // $data = $dataresult->fetchAll(PDO::FETCH_OBJ);
                    // dd($data);
                    // $MSG = $data[0]->MSG;

                    // $stmt1 = $conn->prepare("EXEC spFitIndiaRefNo1 $userid,'ItD733MTk5NDQyOQ==NKCvqq','Login','en'");
                    $stmt1 = $conn->prepare("EXEC spFitIndiaRefNo1 $userid,"."'$RefNo'".",'Login','en'");
                    // $stmt1 = $conn->prepare("EXEC spFitIndiaRefNo $userid,"."'$RefNo'".","."'$ReqURL'".","."'$lang'");
                    // $stmt1 = $conn->prepare("EXEC spFITIndiaSignUp 1998785,'User','User','test','undefined','1','02/17/2001','insert','test','test','1','1','110051','UI001','test','18','subscriber','test','',' ',' ',''");
                    $stmt1->execute();
                    $data1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);   //Done
                    
                    if(!empty($data1)){
                        $MSG = $data1[0]['MSG'];
                    }
                    
                    // Move to the next result set
                    $stmt1->nextRowset();

                    // Fetch the second result set
                    $alldate = $stmt1->fetchAll(PDO::FETCH_ASSOC);                                
                    
                    if(!empty($alldate)){
                        $MSG = $alldate[0]['MSG'];
                    }

                    $stmt1->nextRowset();

                    $resultSet5 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(!empty($resultSet5)){
                        $MSG = $resultSet5[0]['MSG'];
                    }

                    $stmt1->nextRowset();

                    $OverallFitnessScore = $stmt1->fetchAll(PDO::FETCH_ASSOC); 
                    
                    if(!empty($OverallFitnessScore)){
                        $MSG = $OverallFitnessScore[0]['MSG'];
                    }
                    
                    $stmt1->nextRowset();

                    $userinformation = $stmt1->fetchAll(PDO::FETCH_OBJ);
                    
                    if(!empty($userinformation)){
                        $MSG = $userinformation[0]['MSG'];
                    }

                    if ($MSG == 5) {
                        return Response::json(array(
                            'IsSuccess'    => "false",
                            'Message'      =>  "Duplicate refno.",
                            'Result'   =>  "$MSG"
                        ));
                    }

                    if ($MSG == 1) {
                        return Response::json(array(
                            'IsSuccess'    => "false",
                            'Message'      =>  "Invalid input",
                            'Result'   =>  "$MSG"
                        ));
                    }

                    if ($MSG == 0) {
                        $MSGid = $data[0]->Id;
                        return Response::json(array(
                            'IsSuccess'    => "true," . "$MSGid",
                            'Message'      =>  "Data Saved Successfully",
                            'Result'   =>  "$MSG"
                        ));
                    }                    
                }
            }else{

                return Response::json(array(
                    'IsSuccess'    => "false",
                    'Message'      =>  "Invalid Token",
                    'Result'   =>  "3"
                ));

            }
        } catch (\Exception $ex) {

            $Message =  $ex->getMessage();
            // dd($Message);
            return Response::json(array(
                'IsSuccess'    => "false",
                'Message'      =>  "$Message",
                'Result'   =>  "3"
            ));
        }        
    }
    public function dashboard(Request $request){

        try {

            $apitoken = $request['apitoken'];        
            $dot_net_refno_apitoken = 'A2P0R1';

            $data = json_decode($request['data'], ENT_QUOTES);

            if ($apitoken == $dot_net_refno_apitoken) {
            
                foreach ($data as $x => $val) {
            
                    $db_ext = DB::connection('sqlsrv');
                    $fitindiaid = $val['fitindiaid'];

                    // $data = $db_ext->select("EXEC spGetFitnessDashboard $fitindiaid");
                    $mssqluser_hostname = $this->DB_SQL_HOST;        
                    $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
                    $mssqluser_password = $this->DB_SQL_PASSWORD;
                    $mssqluser_name= $this->DB_SQL_USERNAME;
                    // dd($mssqluser_name);
                    $conn = new PDO("sqlsrv:Server=$mssqluser_hostname,1433;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");

                    $dataresult = $conn->prepare("EXEC spGetFitnessDashboard $fitindiaid");
                    $dataresult->execute();           
                    $data = $dataresult->fetchAll(PDO::FETCH_OBJ);
                    // dd($data);
                    // $MSG = $data[0]->MSG;
                    
                    $MSG = $data[0]->MSG;
                    $overallpercentage = $data[0]->overallpercentage;

                    if($MSG ==  0 && $overallpercentage == .00){

                        $fitindiaid = $data[0]->ID;

                        return Response::json(array(
                            'IsSuccess'    =>  "true," . "$fitindiaid",
                            'Message'      =>  "Test not taken",
                            'Result'   =>  -1
                        ));

                    }elseif($MSG ==  0 && $overallpercentage > .00){

                        return Response::json(array(
                            'IsSuccess'    =>  "true",
                            'Message'      =>  "Test data found",
                            'Result'   =>  $overallpercentage
                        ));

                    }else{

                        return Response::json(array(
                            'IsSuccess'    =>  "true," . "$fitindiaid",
                            'Message'      =>  "Test not taken",
                            'Result'   =>  -1
                        ));
                    }
                }

            }else{                

                return Response::json(array(
                    'IsSuccess'    => "false",
                    'Message'      =>  "Invalid Token",
                    'Result'   =>  "3"
                ));
            }

        } catch (\Exception $ex) {            

            return Response::json(array(
                'IsSuccess'    => "false",
                'Message'      =>  "User does not exist",
                'Result'   =>  "1"
            ));            
        }        
    }

    public function refnocopy(Request $request){
        try{

                  
            $mssqluser_hostname = $this->DB_SQL_HOST;        
            $mssqluser_databases = $this->DB_DATABASE_SQL_NAME;
            $mssqluser_password = $this->DB_SQL_PASSWORD;
            $mssqluser_name= $this->DB_SQL_USERNAME;
            // dd($mssqluser_name.'-------'.$mssqluser_password.'-------'.$mssqluser_databases.'-------'.$mssqluser_hostname.'-------');
            $conn = new PDO("sqlsrv:Server=$mssqluser_hostname,1433;Database=$mssqluser_databases", "$mssqluser_name", "$mssqluser_password");
            // dd($conn);
            // $F365Id = Session::get('ParentUserId');
            $type = 1;

            // $stmt1 = $conn->prepare('EXEC spFitIndiaRefNo 1994429,"ItD733MTk5NDQyOQ==NKCvqq","Login","en"');
            $stmt1 = $conn->prepare("EXEC spFitIndiaRefNo1 1998785,'ItD733MTk5NDQyOQ==NKCvqq','Login','en'");
            // $stmt1 = $conn->prepare("EXEC spFITIndiaSignUp 1998785,'User','User','test','undefined','1','02/17/2001','insert','test','test','1','1','110051','UI001','test','18','subscriber','test','',' ',' ',''");
            $stmt1->execute();
			$userprofile = $stmt1->fetchAll(PDO::FETCH_ASSOC);   //Done
            //dd($userprofile);
            // Move to the next result set
            $stmt1->nextRowset();

            // Fetch the second result set
            $alldate = $stmt1->fetchAll(PDO::FETCH_ASSOC);            
			// dd($alldate);
            $stmt1->nextRowset();
            $resultSet5 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            dd($resultSet5);

            $stmt1->nextRowset();
            $OverallFitnessScore = $stmt1->fetchAll(PDO::FETCH_ASSOC); 
            // dd($OverallFitnessScore);
			// dd($stmt1->fetchAll());
            $userinformation = $stmt1->fetchAll(PDO::FETCH_OBJ);
            dd($userinformation);
        } catch (\Exception $ex) {

            $Message =  $ex->getMessage();
            dd($Message);
        }
    }
}
