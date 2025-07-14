{{-- {{ dd($userprofile[0]) }} --}}
@extends('static.layouts.appnet')
@section('title', 'Fit India Test List | Fit India')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" />
<style>
    @media screen and (min-width:992px){
        #ddlTestDate{
            margin-top: 0px !important;
    border: 1px solid;
    height: 50px !important;
    border-color: #dedede;
        }
        #ContentPlaceHolder1_btnGo{
            margin-left: 5px;
        }
    }
    @media screen and (max-width:767px){
        .custom-flexDir{
            flex-direction: row !important;
    }
    }
   
</style>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127986665-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-127986665-1');
</script>
<div id="divloader" runat="server" class="divloader" style="display: none">
    <img src="{{ url('resources/dotnetimages/ajax-loader.gif') }}" />
</div>
<div class="inner-page-header">
    <div class="container back-btn-set">
        {{-- <button class="header-back-btn" onserverclick="GoBack_ServerClick"> --}}
       <div class="row justify-content-end d-flex custom-flexDir  " style="display: flex; justify-content:end;">
        <div class="col-auto">
            <h4 id="lblHeading">
                {{ __('userdashboard.label194') }}
                {{-- <%= Resources.ResourceMaster.label12 %> --}}
            </h4>
        </div>
       <div class="col-auto">
         <a href="{{ url('homeaddusers') }}" class="header-back-btn back-btn-set"  style="display: flex; justify-content: end; margin-right:20px !important;">
            <img src="{{asset('resources/dotnetimages/switch-user.png')}}" />
        </a>
       </div>
       </div>
        {{-- </button> --}}
        
    </div>
</div>
<div id="wrapper">
    <section class="header-bg-2">

        <div class="test-tacken-box">
            <div id="ContentPlaceHolder1_DateHeader" class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 khelo-text-padding">

                        <div id="ContentPlaceHolder1_chkboxdiv" class="col-test-taken toggel-section">
                            <div class="checkbox">
                                <label>
                                    <div class="toggle btn btn-default off" data-toggle="toggle" style="width: 135px; height: 34px;"><input name="ctl00$ContentPlaceHolder1$chkDataToggle" type="checkbox" id="ContentPlaceHolder1_chkDataToggle" data-toggle="toggle" onchange="DataToggleChange();" data-on="School" data-off="Self"><div class="toggle-group"><label class="btn btn-primary toggle-on">School</label><label class="btn btn-default active toggle-off">Self</label><span class="toggle-handle btn btn-default"></span></div></div>

                                </label>
                            </div>


                        </div>

                        <div class="col-test-taken test-hide-on-mob">
                            <span>{{ __('taketest.label306') }}</span>

                        </div>

                        <form name="add-blog-post-form" id="add-blog-post-form" method="POST" action="{{url('/datewisedate')}}">
                        {{-- <form name="add-blog-post-form" id="add-blog-post-form" method="get" action="{{url('/memberdashboard')}}"> --}}
                            @csrf
                            <div class="col-test-date">
                                {{-- {{ dd($alldate) }} --}}
                                <select name="TestDate" id="ddlTestDate" style="margin-top:0px !important;" class="form-control">
                                    @for($i=0;$i<count($alldate);$i++)
                                        {{-- <option  value="@php echo  date("d-m-Y",strtotime($alldate[$i]['CreatedOn'])).' '.'12:00:00 AM' @endphp" @if($i==0) selected @endif>{{ $alldate[$i]["DisplayDate"] }}</option>                       --}}
                                        <option  value="{{ $alldate[$i]['DisplayDate'] }}" {{$alldate[$i]['DisplayDate'] == $DisplayDate  ? 'selected' : ''}}>{{ $alldate[$i]["DisplayDate"] }}</option>
                                    @endfor
                                </select>
                                <input type="hidden" id="userprofileF365Id" name="userprofileF365Id" value="{{ $userprofile[0]['F365Id'] ?? ''}}">
                                <input type="hidden" id="UserDisplayShow" name="UserDisplayShow" value="{{ $DisplayDate ?? ''}}">
                            </div>
                            <input type="hidden" id="UserDisplayShow" name="UserDisplayShow" value="{{ $DisplayDate ?? ''}}">
                            <div class="goBtn">
                                <input type="submit" name="ctl00$ContentPlaceHolder1$btnGo" value="Go" id="ContentPlaceHolder1_btnGo">
                            </div>
                           <div>

                        
                            
                            @php
                                
                            $Age = Session::get('Age');
                        
                            $AgeGroupName = Session::get('AgeGroupName');

                            $taketesturl = url('/taketest').'?Name='.urlencode($userprofile[0]['Name']).'&F365Id='.$userprofile[0]['F365Id'].'&Age='.$Age.'&AgeGroupId='.$AgeGroupId.'&AgeGroupName='. $AgeGroupName .'&GenderId='.$userprofile[0]["GenderId"];
                        @endphp
                            <div class="share-icon hide-all-view">
                                <button onclick="__doPostBack('ctl00$ContentPlaceHolder1$btnExport','')" id="ContentPlaceHolder1_btnExport" style="margin-right: 10px;" class="download-dashboard-btn" value="Export" type="button"><span class="download-txt">Download</span><span class="download-i"><a href="{{ $taketesturl}}"><img style="width: 25px !important;"  src="{{url('resources/dotnetimages/Images/re-test_i.png')}}" alt="download"></a></span></button>
                            </div>
                            <div class="share-icon re-take-text">
    
                                @php
    
                                    $Age = Session::get('Age');
                                    $AgeGroupId = Session::get('AgeGroupId');
                                    $AgeGroupName = Session::get('AgeGroupName');
                                    $taketesturl = url('/taketest').'?Name='.urlencode($userprofile[0]['Name']).'&F365Id='.$userprofile[0]['F365Id'].'&Age='.$Age.'&AgeGroupId='.$AgeGroupId.'&AgeGroupName='. $AgeGroupName .'&GenderId='.$userprofile[0]["GenderId"];
                                @endphp
                                <a  id="ContentPlaceHolder1_Button1" class="download-dashboard-btn" href="{{$taketesturl}}">
                                <span class="download-txt" style="color: #4F83D1;">{{ __('taketest.label304') }}</span>
                                <span class="download-i re-take"><img src="{{url('resources/dotnetimages/Images/re-test_i.png')}}"><span class="mob-test">{{ __('taketest.label304') }}</span></a>
                            </div>
                           </div>
                        </form>


                       
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
            <?php
                // $userprofileGender = $userprofile[0]["Gender"];
                // echo __("userdashboard.$userprofileGender"); exit;
            ?>
                <div class="col-xs-12 col-sm-12 col-md-12">
                        @if (count($userprofile) > 0)
                            {{-- hdrStudentName.InnerHtml = ds_Alldata.Tables[0].Rows[0]["Name"].ToString();
                            Session["NameChild"] = ds_Alldata.Tables[0].Rows[0]["Name"].ToString();
                            Session["GenderChild"] = GetGlobalResourceObject("ResourceUserDashboard", "" + ds_Alldata.Tables[0].Rows[0]["Gender"].ToString() + "").ToString();
                            spnAgeGender.InnerHtml = Session["Age"].ToString() + " " + Resources.ResourceUserDashboard.label3 + "," + GetGlobalResourceObject("ResourceUserDashboard", "" + ds_Alldata.Tables[0].Rows[0]["Gender"].ToString() + "").ToString();
                            spnAG.InnerHtml = Session["Age"].ToString() + " " + Resources.ResourceUserDashboard.label3 + "," + GetGlobalResourceObject("ResourceUserDashboard", "" + ds_Alldata.Tables[0].Rows[0]["Gender"].ToString() + "").ToString(); --}}

                            @php
                                $hdrStudentName = $userprofile[0]['Name'];
                                $Age = Session::get('Age');
                                $AgeGroupName = Session::get('AgeGroupName');
                                // dd($AgeGroupName);
                                $userdashboardlabel3 = __('userdashboard.label3');
                                $userprofileGender = $userprofile[0]["Gender"];
                                $spnAgeGender = $Age ." " .$userdashboardlabel3 .", " .__("userdashboard.$userprofileGender");
                                // dd($spnAgeGender);

                            @endphp
                            {{-- {{ dd(count($resultSet7)) }} --}}
                            @if(count($resultSet7) > 0)
                                @php
                                    // $spnWeightScore = round($resultSet7[0]["Score"] / 1000) + "" + GetGlobalResourceObject("ResourceTakeTest", "label128");
                                    $spnWeightScore = round($resultSet7[0]["Score"] / 1000) ." " .__('taketest.label128');
                                @endphp
                            @else
                                @php
                                    $spnWeightScore = "0" ." ".__('taketest.label128');
                                @endphp
                            @endif

                            {{-- @if(ds_Alldata.Tables[4].Rows.Count > 0) --}}
                            @if(count($resultSet7) > 0)
                                @php
                                    $spnHeightScore = round($resultSet7[1]["Score"] / 10) ." " .__('taketest.label8');
                                @endphp
                            @else
                                @php
                                    // $spnHeightScore.InnerHtml = "0" + GetGlobalResourceObject("ResourceTakeTest", "label8");
                                    $spnHeightScore = "0" ." " .__('taketest.label8');
                                @endphp
                            @endif

                            {{-- spnAgeGroup.InnerHtml = GetGlobalResourceObject("ResourceUserDashboard", "" + Session["AgeGroupName"].ToString() + "").ToString(); --}}
                            @php
                                $spnAgeGroup = __("userdashboard.$AgeGroupName")
                            @endphp
                                                       @php
                                $PhotoPath = $userprofile[0]['PhotoPath']
                            @endphp
                            @if(!$userprofile[0]['PhotoPath'])
                                @if($PhotoPath != 'SchoolImages/School_user_male.png')
                                    @php
                                        $ProfileDiv = "<img src='' class='user-defult-img' alt='No Image Found' />";
                                    @endphp
                                @endif
                            @else
                                @if ($userprofile[0]["GenderId"] == "1")
                                    @php
                                        $ProfileDiv = "<img id = 'imgStudentImage' src = 'SchoolImages/School_user_male.png' alt = 'user' class='circle'/>";                                        
                                    @endphp
                                @else
                                    @php
                                        $ProfileDiv = "<img id = 'imgStudentImage' src = 'SchoolImages/School_user_female.png' alt = 'user' class='circle'/>";                                        
                                    @endphp
                                @endif
                            @endif
                        @endif
                    <div class="user-information">
                        <div class="student-info">
                            @php
                                $tem_id = session::get('F365Id');                                
                                $ParentId = session::get('ParentUserId');
                            @endphp
                            <!-- <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                <img id="imgStudentImage" runat="server" src="{{url('resources/dotnetimages/SchoolImages/School_user_male.png')}}" alt="user" class="circle">
                            </div> -->
                                @if(!empty($usermetas_image))                                                

                                    @if($userprofile[0]['PhotoName'] == "0")

                                        @if($userprofile[0]["GenderId"] == 1) 
                                            <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                                <img id="imgStudentImage" runat="server" src="{{url('resources/dotnetimages/SchoolImages/School_user_male.png')}}" alt="user" class="circle">
                                            </div>                                            

                                        @elseif($userprofile[0]["GenderId"] == 2)

                                            <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                                <img id="imgStudentImage" runat="server" src="{{url('resources/dotnetimages/SchoolImages/School_user_female.png')}}" alt="user" class="circle">
                                            </div>                                            
                                            
                                        @elseif($userprofile[0]["GenderId"] == 3)

                                            <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                                <img id="imgStudentImage" runat="server" src="{{url('resources/dotnetimages/SchoolImages/School_user_female.png')}}" alt="user" class="circle">
                                            </div>                                            
                                        @endif

                                    @elseif($usermetas_image->image != null && $tem_id == $ParentId)
                                        
                                        {{-- <img id="imgStudentImage" src="{{ $usermetas_image->image ?? '' }}" class='user-defult-img' alt='School user male' /> --}}
                                        <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                            <img id="imgStudentImage" runat="server" src="{{ $usermetas_image->image ?? '' }}" alt="user" class="circle">
                                        </div>                                               
                                    @elseif($userprofile[0]['PhotoName'] != '')
                                        
                                        <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                            <img id="imgStudentImage" runat="server" src="{{ $userprofile[0]['PhotoName'] ?? '' }}" alt="user" class="circle">
                                        </div>
                                        
                                    {{-- @elseif($userprofile[0]['PhotoName'] == 0) --}}
                                        
                                        
                                    @else
                                        
                                        @if($userprofile[0]["GenderId"] == "1") 
                                            <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                                <img id="imgStudentImage" runat="server" src="{{url('resources/dotnetimages/SchoolImages/School_user_male.png')}}" alt="user" class="circle">
                                            </div>                                            

                                        @elseif($userprofile[0]["GenderId"] == "2")

                                            <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                                <img id="imgStudentImage" runat="server" src="{{url('resources/dotnetimages/SchoolImages/School_user_female.png')}}" alt="user" class="circle">
                                            </div>                                            
                                            
                                        @elseif($userprofile[0]["GenderId"] == "3")

                                            <div id="ContentPlaceHolder1_ProfileDiv" class="student-img">
                                                <img id="imgStudentImage" runat="server" src="{{url('resources/dotnetimages/SchoolImages/School_user_female.png')}}" alt="user" class="circle">
                                            </div>                                            
                                        @endif
                                    @endif
                                @endif
                            <div class="left-text">
                                <h4 id="ContentPlaceHolder1_hdrStudentName">
                                    {{ Session::get('hidname') }}
                                </h4>
                                <span id="spnAgeGender">
                                    {{ $spnAgeGender ?? "" }}
                                    {{-- {{ Session::get('Age') ?? '' }}yrs,
                                    @if(Session::get('AgeGroupId') == 1)
                                        Male
                                    @elseif(Session::get('AgeGroupId') == 2)
                                        Female
                                    @elseif(Session::get('AgeGroupId') == 3)
                                        Transgender
                                    @endif                                      --}}
                                </span>
                            </div>
                        </div>
                        <div class="st-ht-wet-detail">
                            <div class="st-ht">
                                <h4>{{ __('taketest.label4') }}</h4>
                                {{-- <span id="HeightScore">111cm</span> --}}
                                <span id="HeightScore">{{ $spnHeightScore ?? "" }}</span>
                            </div>
                            <div class="st-img">
                               <img src="{{ url('resources/dotnetimages/weight-icon.png')}}" class="img-responsive">
                            </div>
                            <div class="st-wet">
                                <h4>{{ __('taketest.label5') }}</h4>
                                {{-- <span id="ContentPlaceHolder1_spnWeightScore">111kg</span> --}}
                                <span id="ContentPlaceHolder1_spnWeightScore">{{ $spnWeightScore ?? "" }}</span>
                            </div>
                        </div>
                        <div class="age-group">
                            <h4>{{ __('taketest.label305') }}</h4>
                            <span id="ContentPlaceHolder1_spnAgeGroup">
                                {{-- 19-65 Years --}}
                                <br/>
                                {{ $spnAgeGroup ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--info section-->
    <!--close info section-->
    {{-- <%--------------------------------------------------------- Test Data / Dynamic Section ---------------------------------------------------------%> --}}

    {{-- <div runat="server" id="dvTestBoard">
    </div> --}}

    {{-- <div class="container" id="reportHeader" runat="server">
        <div class='row clearfix'>
            <div class='download-report'>
                <div class='col-xs-12 col-sm-12 col-md-4'>
                    <div class="btn-box">
                        <%-- <a href='FitnessReportA.aspx' type='button' class='btn btn-primary btn-lg '>Download Report <i class='fa fa-file-pdf-o pull-right'></i></a>--%>
                        <asp:Button ID="btnF365Report" runat="server" Class="btn btn-primary btn-lg" OnClick="btnF365Report_Click" />
                        <i class='fa fa-file-pdf-o pull-right dowload-data'></i>
                    </div>
                </div>
                <div class='col-xs-12 col-sm-12 col-md-4'>
                    <div class="btn-box">
                        <%--<a href='#a' type='button' class='btn btn-primary btn-lg'>Fitness History <i class='fa fa-hourglass-3 pull-right'></i></a>--%>
                        <asp:Button ID="btnFitnessHistory" runat="server" Class="btn btn-primary btn-lg" OnClick="btnFitnessHistory_Click" />
                        <i class='fa fa-hourglass-3 pull-right dowload-data'></i>
                    </div>
                </div>

                <div class='col-xs-12 col-sm-12 col-md-4 benchmark'>
                    <div class="btn-box">
                        <div class='y_boys'><span id="spnAG" runat="server"></span></div>
                        <%--                            <a href='#a' type='button' class='btn btn-primary btn-lg '>Benchmark</a>--%>
                        <asp:Button ID="btnBenchMark" runat="server" Class="btn btn-primary btn-lg" OnClick="btnBenchMark_Click" />
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="clearfix"></div>
    @if(count($resultSet5) > 0)
        @php
            $btnF365Report = __('userdashboard.label61');
            $btnFitnessHistory = __('userdashboard.label62');
            $btnBenchMark = __('userdashboard.label62');
        @endphp
    @endif

    {{-- {{ dd($OverallFitnessScore) }} --}}
    {{-- {{ dd($resultSet5) }} --}}
    {{-- {{ dd(count($OverallFitnessScore)) }} --}}
        @if(count($OverallFitnessScore) > 0)
                {{-- {{ dd(round($OverallFitnessScore[0]['OverallPercentage'])) }} --}}
                @php
                    $OverallPercentage = round($OverallFitnessScore[0]['OverallPercentage']);
                @endphp
                @if ($OverallPercentage < 20)
                    @php
                        $OverallPointerClr = "#ff043f;";
                        $OverallTooltipLeft = "2%";
                    @endphp

                @elseif($OverallPercentage >= 20 && $OverallPercentage < 40)
                    @php
                        $OverallPointerClr = "#fc6ba9;";
                        $OverallTooltipLeft = "16%";
                    @endphp
                @elseif ($OverallPercentage >= 40 && $OverallPercentage < 60)
                    @php
                        $OverallPointerClr = "#ffaa62;";
                        $OverallTooltipLeft = "29%";
                    @endphp

                @elseif($OverallPercentage >= 60 && $OverallPercentage < 70)
                    @php
                        $OverallPointerClr = "#f7d54e;";
                        $OverallTooltipLeft = "43%";
                    @endphp

                @elseif($OverallPercentage >= 70 && $OverallPercentage < 80)
                    @php
                        $OverallPointerClr = "#8bd470;";
                        $OverallTooltipLeft = "57%";
                    @endphp

                @elseif($OverallPercentage >= 80 && $OverallPercentage < 90)
                    @php
                        $OverallPointerClr = "#00b289;";
                        $OverallTooltipLeft = "70%";
                    @endphp
                @endif

                @if($OverallPercentage >= 90)
                    @php
                        $OverallPointerClr = "#009bdf;";
                        $OverallTooltipLeft = "84%";
                    @endphp
                @endif

        @else
            @php
                $OverallPointerClr = "#ff043f;";
                $OverallTooltipLeft = "2%";
            @endphp
        @endif
    {{-- {{ dd($BodyMassIndex)}} --}}

    @if(count($BodyMassIndex) > 0)
            @php
                $userbmi = $BodyMassIndex[0]['BMI'];
                $useruw = $BodyMassIndex[0]['UW'];
                $usern = $BodyMassIndex[0]['N'];
                $userow = $BodyMassIndex[0]['OW'];
                $userob = $BodyMassIndex[0]['OB'];
                $userstatus = $BodyMassIndex[0]['STATUS'];
                // dd($userbmi);
            @endphp

            @if($userbmi <= $useruw)
                @php
                    $BMIPointerClr = "#ffd26e;";
                    $BMITooltipLeft = "6%";
                @endphp
            @elseif ($userbmi > $useruw && $userbmi <= $usern)
                @php
                    $BMIPointerClr = "#6bc04b;";
                    $BMITooltipLeft = "32%";
                @endphp

            @elseif ($userbmi > $usern && $userbmi <= $userow)
                @php
                    $BMIPointerClr = "#ffaa62;";
                    $BMITooltipLeft = "56%";
                @endphp
            @else
                @php
                    $BMIPointerClr = "#ff043f;";
                    $BMITooltipLeft = "82%";
                @endphp
            @endif
    @else
        @php
            $BMIPointerClr = "#ffd26e;";
            $BMITooltipLeft = "6%";
        @endphp
    @endif            {{-- //----------------------------------------------------------------------------------------- BMI Score  --}}
    @if (count($BodyMassIndex) != 0)

            <div class='col-xs-12 col-sm-12 col-md-6'>
                    <div class='body-comp-details'>
                        <div class='bmi-heading'>
                        {{-- <h3 class='text-center'>GetGlobalResourceObject("ResourceUserDashboard", "label17").ToString()</h3> --}}
                        <h3 class='text-center'>{{ __('userdashboard.label17') }}</h3>
                        </div>
                        <div class='body-composition card-bg'>
                            <div class='bmi-label'>
                                <div class='ofl-tooltip-center' style='left:{{ $BMITooltipLeft ?? "" }}'>
                                {{-- <span style='background:BMIPointerClr'>Convert.ToDouble(ds_AllData.Tables[5].Rows[0]["BMI"].ToString())<i class='down-arrow-center' style='border-top-color:" + BMIPointerClr'></i></span> --}}
                                <span style='background:{{ $BMIPointerClr }}'>
                                    {{$userbmi??''}}
                                    <i class='down-arrow-center' style='border-top-color:{{ $BMIPointerClr }}'></i>
                                </span>
                                </div>
                                {{-- //<div class='bmi-tooltip-center'><span>ds_AllData.Tables[5].Rows[0]["BMI"].ToString()</span></div> --}}
                                <div class='multi-label-val'>
                                    <div class='bmi-box-01'>
                                        <span>{{$useruw??''}}</span>
                                        <div class='colorPickBox L_01'></div>
                                        {{-- <div class='progress-text progress-level-01'><p>GetGlobalResourceObject("ResourceUserDashboard", "label19").ToString()</p></div> --}}
                                        <div class='progress-text progress-level-01'><p>{{ __('userdashboard.label19') }}</p></div>
                                    </div>
                                <div class='bmi-box-01'>
                                {{-- <span>ds_AllData.Tables[5].Rows[0]["N"].ToString()</span> --}}
                                <span>{{$usern??''}}</span>
                                <div class='colorPickBox L_02'></div>
                                    <div class='progress-text progress-level-02'>
                                        {{-- <p>GetGlobalResourceObject("ResourceUserDashboard", "label20").ToString()</p></div> --}}
                                        <p>{{ __('userdashboard.label20') }}</p>
                                    </div>
                                </div>
                                <div class='bmi-box-01'>
                                    {{-- <span>ds_AllData.Tables[5].Rows[0]["OW"].ToString()</span> --}}
                                    <span>{{ $userow??'' }}</span>
                                    <div class='colorPickBox L_03'></div>
                                    <div class='progress-text progress-level-03'>
                                    {{-- <p>GetGlobalResourceObject("ResourceUserDashboard", "label21").ToString()</p> --}}
                                    <p>{{ __('userdashboard.label21') }}</p>
                                </div>
                            </div>
                            <div class='bmi-box-01'>
                                <span>&nbsp;</span>
                                <div class='colorPickBox L_04'></div>
                                <div class='progress-text progress-level-04'>
                                    {{-- <p>GetGlobalResourceObject("ResourceUserDashboard", "label22").ToString()</p> --}}
                                    <p>{{ __('userdashboard.label22') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='bmi-label-text'>
                    <p>
                    {{-- if (Session["lang"].ToString() == "hi")
                    {
                        ds_AllData.Tables[0].Rows[0]["Name"].ToString(), Session["Age"].ToString() वर्षीय GetGlobalResourceObject("ResourceUserDashboard", ds_AllData.Tables[0].Rows[0]["Gender"].ToString()).ToString() है, जिसकी अनुमानित बीएमआई रेंज " + ds_AllData.Tables[5].Rows[0]["UW"] से " + ds_AllData.Tables[5].Rows[0]["N"].ToString() के बीच होनी चाहिए।";
                    }
                    else
                    {
                        " + ds_AllData.Tables[0].Rows[0]["Name"].ToString() is " + Session["Age"].ToString() year old " + GetGlobalResourceObject("ResourceUserDashboard", ds_AllData.Tables[0].Rows[0]["Gender"].ToString()).ToString(), whose ideal BMI range is between " + ds_AllData.Tables[5].Rows[0]["UW"] to " + ds_AllData.Tables[5].Rows[0]["N"].ToString().";
                    } --}}


                    {{-- //" + ds_AllData.Tables[0].Rows[0]["Name"].ToString() is " + Session["Age"].ToString() year old " + ds_AllData.Tables[0].Rows[0]["Gender"].ToString(). His ideal BMI range is betweeen " + ds_AllData.Tables[5].Rows[0]["UW"] to " + ds_AllData.Tables[5].Rows[0]["N"].ToString(). As per his height of " + Math.Round(Convert.ToDouble(ds_AllData.Tables[4].Rows[1]["Score"]) / 10, 1).ToString() cms, his ideal weight should be in range of 24.8-28.7 kg."; --}}
                    {{-- //<a href='#a'> <i class='fa fa-arrow-circle-o-right'></i> </a> --}}
                    </p>
                        </div>
                    </div>
                </div>
            </div>
    @else

        <div class='col-xs-12 col-sm-12 col-md-6'>
            <div class='body-comp-details'>
                <div class='bmi-heading'>
                {{-- <h3 class='text-center'>" + GetGlobalResourceObject("ResourceUserDashboard", "label17").ToString()</h3> --}}
                <h3 class='text-center'>{{ __('userdashboard.label17') }}</h3>
                </div>
                <div class='body-composition card-bg'>
                    <div class='bmi-label'>
                        <div class='ofl-tooltip-center' style='left:{{ $BMITooltipLeft }};'>
                            <span style='background:"{{ $BMIPointerClr }}'>0<i class='down-arrow-center' style='border-top-color:"{{ $BMIPointerClr }}'></i></span>
                        </div>
                        {{-- //<div class='bmi-tooltip-center'><span>" + ds_AllData.Tables[5].Rows[0]["BMI"].ToString()</span></div> --}}
                        <div class='multi-label-val'>
                            <div class='bmi-box-01'>
                            <span>UW</span>
                                <div class='colorPickBox L_01'>
                                </div>
                                {{-- <div class='progress-text progress-level-01'><p>" + GetGlobalResourceObject("ResourceUserDashboard", "label19").ToString()</p></div> --}}
                                <div class='progress-text progress-level-01'><p>{{ __('userdashboard.label19') }}</p>
                                </div>
                            </div>
                            <div class='bmi-box-01'>
                            <span>N</span>
                                <div class='colorPickBox L_02'>

                                </div>
                            {{-- <div class='progress-text progress-level-02'><p>" + GetGlobalResourceObject("ResourceUserDashboard", "label20").ToString()</p></div> --}}
                                <div class='progress-text progress-level-02'><p>{{ __('userdashboard.label20') }}</p></div>
                            </div>
                            <div class='bmi-box-01'>
                                <span>OW</span>
                                    <div class='colorPickBox L_03'></div>
                                    {{-- <div class='progress-text progress-level-03'><p>" + GetGlobalResourceObject("ResourceUserDashboard", "label21").ToString()</p></div> --}}
                                    <div class='progress-text progress-level-03'><p>{{ __('userdashboard.label21') }}</p></div>
                            </div>
                            <div class='bmi-box-01'>
                                <span>&nbsp;</span>
                                <div class='colorPickBox L_04'></div>
                                {{-- <div class='progress-text progress-level-04'><p>" + GetGlobalResourceObject("ResourceUserDashboard", "label22").ToString()</p></div> --}}
                                <div class='progress-text progress-level-04'><p>{{ __('userdashboard.label22') }}</p></div>
                            </div>
                        </div>
                    </div>
                    <div class='bmi-label-text'>

                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- //----------------------------------------------------------------------------------------- Over all Fitness Score --}}
        @if(count($OverallFitnessScore) > 0)

                <div class='col-xs-12 col-sm-12 col-md-6'>
                    <div class='body-comp-details'>
                        <div class='ofl-heading'>
                            {{-- <h3 class='text-center'>" + GetGlobalResourceObject("ResourceUserDashboard", "label18").ToString() + "</h3> --}}
                            <h3 class='text-center'>{{ __('userdashboard.label18') }}</h3>
                        </div>
                        <div class='body-composition card-bg'>
                            <div class='overall-fitess-label'>
                                {{-- <div class='ofl-tooltip-center' style='left:" + OverallTooltipLeft + ";'> --}}
                                <div class='ofl-tooltip-center' style='left:{{ $OverallTooltipLeft ?? '' }}'>
                                    <span style='background:{{ $OverallPointerClr ?? '' }}'> {{ round($OverallFitnessScore[0]['OverallPercentage']) ?? ''}}
                                        <i class='down-arrow-center' style='border-top-color:"{{ $OverallPointerClr }} + "'></i>
                                    </span>
                                </div>
                                <div class='valeu-details'>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-a'><span>20</span></div>
                                        <div class='color-val-wh'></div>
                                        <div class='text-value'>
                                            <div class='text-label'><span>L1</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-b'><span>40</span></div>
                                        <div class='color-val-mi'></div>
                                        <div class='text-value border-color-01'>
                                            <div class='text-label'><span>L2</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01  border-g-c'><span>60</span></div>
                                        <div class='color-val-cb'></div>
                                        <div class='text-value border-color-02'>
                                            <div class='text-label'><span>L3</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-d'><span>70</span></div>
                                        <div class='color-val-gd'></div>
                                        <div class='text-value border-color-03'>
                                            <div class='text-label'><span>L4</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-e'><span>80</span></div>
                                        <div class='color-val-vg'></div>
                                        <div class='text-value border-color-04'>
                                            <div class='text-label'><span>L5</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-f'><span>90</span></div>
                                        <div class='color-val-athletic'></div>
                                        <div class='text-value border-color-05'>
                                            <div class='text-label'><span>L6</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-g'><span>100</span></div>
                                        <div class='color-val-fit'></div>
                                        <div class='text-value border-color-06'>
                                            <div class='text-label'><span>L7</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='ml-label'>
                                <ul class='list-inline'>
                                    {{-- <li><i class='fa fa-square label-color-01'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label23").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-02'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-03'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label25").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-04'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label26").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-05'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label27").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-06'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label28").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-07'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label29").ToString() + " </li> --}}
                                    <li><i class='fa fa-square label-color-01'></i> {{ __('userdashboard.label23') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-02'></i> {{ __('userdashboard.label24') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-03'></i> {{ __('userdashboard.label25') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-04'></i> {{ __('userdashboard.label26') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-05'></i> {{ __('userdashboard.label27') ?? "" }}  </li>
                                    <li><i class='fa fa-square label-color-06'></i> {{ __('userdashboard.label28') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-07'></i> {{ __('userdashboard.label29') ?? "" }} </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else

                <div class='col-xs-12 col-sm-12 col-md-6'>
                    <div class='body-comp-details'>
                        <div class='ofl-heading'>
                        {{-- <h3 class='text-center'>" + GetGlobalResourceObject("ResourceUserDashboard", "label18").ToString() + "</h3> --}}
                        <h3 class='text-center'>{{ __('userdashboard.label18') ?? "" }}</h3>
                        </div>
                        <div class='body-composition card-bg'>
                            <div class='overall-fitess-label'>
                                <div class='ofl-tooltip-center' style='left:{{ $OverallTooltipLeft ?? '' }};'>
                                    <span style='background:{{ $OverallPointerClr ?? "" }}'>
                                        0<i class='down-arrow-center' style='border-top-color:"{{ $OverallPointerClr ?? "" }}"'></i>
                                    </span>
                                </div>
                                <div class='valeu-details'>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-a'><span>20</span></div>
                                        <div class='color-val-wh'></div>
                                        <div class='text-value'>
                                            <div class='text-label'><span>L1</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-b'><span>40</span></div>
                                        <div class='color-val-mi'></div>
                                        <div class='text-value border-color-01'>
                                            <div class='text-label'><span>L2</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01  border-g-c'><span>60</span></div>
                                        <div class='color-val-cb'></div>
                                        <div class='text-value border-color-02'>
                                            <div class='text-label'><span>L3</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-d'><span>70</span></div>
                                        <div class='color-val-gd'></div>
                                        <div class='text-value border-color-03'>
                                            <div class='text-label'><span>L4</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-e'><span>80</span></div>
                                        <div class='color-val-vg'></div>
                                        <div class='text-value border-color-04'>
                                            <div class='text-label'><span>L5</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-f'><span>90</span></div>
                                        <div class='color-val-athletic'></div>
                                        <div class='text-value border-color-05'>
                                            <div class='text-label'><span>L6</span></div>
                                        </div>
                                    </div>
                                    <div class='label-color-box'>
                                        <div class='point_01 border-g-g'><span>100</span></div>
                                        <div class='color-val-fit'></div>
                                        <div class='text-value border-color-06'>
                                            <div class='text-label'><span>L7</span></div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <div class='ml-label'>
                                <ul class='list-inline'>
                                    {{-- <li><i class='fa fa-square label-color-01'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label23").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-02'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-03'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label25").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-04'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label26").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-05'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label27").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-06'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label28").ToString() + " </li>
                                    <li><i class='fa fa-square label-color-07'></i> " + GetGlobalResourceObject("ResourceUserDashboard", "label29").ToString() + " </li> --}}
                                    <li><i class='fa fa-square label-color-01'></i> {{ __('userdashboard.label23') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-02'></i> {{ __('userdashboard.label24') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-03'></i> {{ __('userdashboard.label25') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-04'></i> {{ __('userdashboard.label26') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-05'></i> {{ __('userdashboard.label27') ?? "" }}  </li>
                                    <li><i class='fa fa-square label-color-06'></i> {{ __('userdashboard.label28') ?? "" }} </li>
                                    <li><i class='fa fa-square label-color-07'></i> {{ __('userdashboard.label29') ?? "" }} </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- if (ds_AllData.Tables[2].Rows.Count > 0) --}}
        @if(count($resultSet5) > 0)
        
            <div class='row clearfix' style='margin:0px ; margin-top:30px; '>
            <div class='overall-fitess'>
            <div class='wrapper-box bg2'>

            {{-- for (int i = 0; i < ds_AllData.Tables[2].Rows.Count; i++) --}}
            @for($i = 0; $i < count($resultSet5); $i++)
                @php
                    $TestCategory = "";
                    $IndividualFeedBack = "";
                    $IndividualLevelFeedback = "";
                    $FCurrentScore = "";
                    $FScoreUnit = "";
                    // $Score = (Convert.ToInt32(ds_AllData.Tables[2].Rows[i]["Percentile"])).ToString();
                    $Score = ($resultSet5[$i]["Percentile"]);
                @endphp

                {{-- if (ds_AllData.Tables[2].Rows.Count > 0) --}}
                @if (count($resultSet5) > 0)
                
                    {{-- if (Convert.ToDouble(ds_AllData.Tables[2].Rows[i]["Percentile"]) == 0) --}}
                    @if($resultSet5[$i]["Percentile"] == 0)
                        @php
                            $IndividualTestGraphClr = "#ff043f;";
                            $IndividualScorelblClr = "#ff043f;";
                            $IndividualBarWidth = "0%";
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label30;
                            $IndividualLevelFeedback = __('userdashboard.label30');
                            $ScoreWidth = "width:128px; display:block; text-align:left;";
                        @endphp
                    {{-- @elseif (Convert.ToDouble(ds_AllData.Tables[2].Rows[i]["Percentile"]) < 20) --}}
                    @elseif($resultSet5[$i]["Percentile"] < 20)
                        @php
                            $IndividualTestGraphClr = "#ff043f;";
                            $IndividualScorelblClr = "#ff043f;";
                            $IndividualBarWidth = "2%";
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label30;
                            $IndividualLevelFeedback = __('userdashboard.label30');
                            $ScoreWidth = "width:128px; display:block; text-align:left;";
                        @endphp
                    
                    @elseif($resultSet5[$i]["Percentile"] >= 20 && $resultSet5[$i]["Percentile"] < 40)
                        @php
                            $IndividualTestGraphClr = "#fc6ba9;";
                            $IndividualScorelblClr = "#fc6ba9;";
                            $IndividualBarWidth = "16%";
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label31;
                            $IndividualLevelFeedback = __('userdashboard.label31');
                            $ScoreWidth = "width:128px; display:block; text-align:left;";
                        @endphp
                    @elseif($resultSet5[$i]["Percentile"] >= 40 && $resultSet5[$i]["Percentile"] < 60)
                        @php
                            $IndividualTestGraphClr = "#ffaa62;";
                            $IndividualScorelblClr = "#ffaa62;";
                            $IndividualBarWidth = "29%";
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label32;
                            $IndividualLevelFeedback = __('userdashboard.label32');
                            $ScoreWidth = "";
                        @endphp
                    @elseif ($resultSet5[$i]["Percentile"] >= 60 && $resultSet5[$i]["Percentile"] < 70)
                        @php
                            $IndividualTestGraphClr = "#f7d54e;";
                            $IndividualScorelblClr = "#f7d54e;";
                            $IndividualBarWidth = "43%";
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label33;
                            $IndividualLevelFeedback = __('userdashboard.label33');
                            $ScoreWidth = "";
                        @endphp
                    
                    @elseif ($resultSet5[$i]["Percentile"] >= 70 && $resultSet5[$i]["Percentile"] < 80)
                        @php
                            $IndividualTestGraphClr = "#8bd470;";
                            $IndividualScorelblClr = "#8bd470;";
                            $IndividualBarWidth = "57%";
                            // $IndividualFeedBack = Resources.ResourceUserDashboard.label37;
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label34;
                            $IndividualFeedBack = __('userdashboard.label37');
                            $IndividualLevelFeedback = __('userdashboard.label34');
                            $ScoreWidth = "";
                        @endphp
                    
                    @elseif ($resultSet5[$i]["Percentile"] >= 80 && $resultSet5[$i]["Percentile"] < 90)
                        @php
                            $IndividualTestGraphClr = "#00b289;";
                            $IndividualScorelblClr = "#00b289;";
                            $IndividualBarWidth = "70%";
                            // $IndividualFeedBack = Resources.ResourceUserDashboard.label38;
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label35;
                            $IndividualFeedBack = __('userdashboard.label38');
                            $IndividualLevelFeedback = __('userdashboard.label35');
                            $ScoreWidth = "width:100%; display:block; text-align:right;";
                        @endphp
                    @elseif ($resultSet5[$i]["Percentile"] >= 90)
                        @php
                            $IndividualTestGraphClr = "#009bdf;";
                            $IndividualScorelblClr = "#009bdf;";
                            $IndividualBarWidth = "84%";
                            // $IndividualFeedBack = Resources.ResourceUserDashboard.label39;
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label36;
                            $IndividualFeedBack = __('userdashboard.label39');
                            $IndividualLevelFeedback = __('userdashboard.label36');
                            $ScoreWidth = "width:100%; display:block; text-align:right;";
                        @endphp
                    @endif
                    @if ($resultSet5[$i]["Percentile"] >= 99.99)
                        @php
                            $Score = "100";
                            $IndividualTestGraphClr = "#009bdf;";
                            $IndividualScorelblClr = "#009bdf;";
                            $IndividualBarWidth = "100%";
                            // $IndividualFeedBack = Resources.ResourceUserDashboard.label39;
                            // $IndividualLevelFeedback = Resources.ResourceUserDashboard.label36;
                            $IndividualFeedBack = __('userdashboard.label39');
                            $IndividualLevelFeedback = __('userdashboard.label36');
                            $ScoreWidth = "width:100%; display:block; text-align:right;";
                        @endphp
                    @endif

                    @if($IndividualFeedBack == "")
                    
                        {{-- if (Convert.ToInt32(Session["AgeGroupId"]) <= 2) --}}
                        @if(Session::get('AgeGroupId') <= 2)
                        
                            @if($resultSet5[$i]["CategoryOrginal"] == "Balance")
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.label40;
                                    $IndividualFeedBack = __('userdashboard.label40');
                                @endphp

                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Agility")
                                @php
                                    $IndividualFeedBack = __('userdashboard.label41');
                                @endphp                            
                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Coordination")
                                @php
                                    // $IndividualFeedBack = GetGlobalResourceObject("ResourceUserDashboard", "label73").ToString();
                                    $IndividualFeedBack = __('userdashboard.label73');
                                @endphp
                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Cardiovascular Endurance")
                                @php
                                    // $IndividualFeedBack = GetGlobalResourceObject("ResourceUserDashboard", "label74").ToString();
                                    $IndividualFeedBack = __('userdashboard.label74');
                                @endphp
                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Speed")
                                @php
                                    $IndividualFeedBack = __('userdashboard.label42');
                                @endphp                            
                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Flexibility")
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.label43;
                                    $IndividualFeedBack = __('userdashboard.label43');
                                @endphp                            
                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Strength")
                                @php
                                    $IndividualFeedBack = __('userdashboard.label44');
                                @endphp
                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Power")
                                @php
                                    $IndividualFeedBack = __('userdashboard.label45');
                                @endphp                            
                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Muscular Endurance")
                                @php
                                    $IndividualFeedBack = __('userdashboard.label93');
                                @endphp                            
                            @elseif ($resultSet5[$i]["CategoryOrginal"] == "Muscular Endurance")
                                @php
                                    $IndividualFeedBack = "To improve Abdominal Strength (partial curl ups) and Muscular Endurance (push-ups/ modified push-ups for Female) 1. You need to Practice climb stairs, hill walk, cycling, dance, push-ups, sit ups, squats, planks, crunches, Naukasana, Shalabhasana, Akarna Dhanurasana etc. to build strength. 2. You need to practice Tadasana, Vrikshasana, Utkatasana, Trikonasana, Katichakrasana, Yoga Mudrasana, Quarter squat, Climb stairs, Crunches and Back extension exercise.";
                                @endphp
                            @else
                                @php
                                    $IndividualFeedBack = "";
                                @endphp
                            @endif
                        @elseif(Session::get('AgeGroupId') >= 3)

                            @if ($resultSet5[$i]["TestTypeId"] == "60") 
                            {{-- // Flamingo Balance Test --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3Flamingo;
                                    $IndividualFeedBack = __('userdashboard.AGrp3Flamingo');
                                @endphp
                            @elseif($resultSet5[$i]["TestTypeId"] == "1001") 
                            {{-- // Vrikshasana (Tree Pose) --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3vrikshana;
                                    $IndividualFeedBack = __('userdashboard.AGrp3vrikshana');
                                @endphp                            
                            @elseif($resultSet5[$i]["TestTypeId"] == "55") 
                            {{-- // Partial Curl Up - 30 seconds --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3Partial30Sec;
                                    $IndividualFeedBack = __('userdashboard.AGrp3Partial30Sec');
                                @endphp                            
                            @elseif($resultSet5[$i]["TestTypeId"] == "1002") 
                            {{-- // Naukasana (Boat Pose) --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3Naukasana;
                                    $IndividualFeedBack = __('userdashboard.AGrp3Naukasana');
                                @endphp                            
                            @elseif($resultSet5[$i]["TestTypeId"] == "57") 
                            {{-- // Push ups (Male)/Modified Push ups (Female) --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3Pushups;
                                    $IndividualFeedBack = __('userdashboard.AGrp3Pushups');
                                @endphp                            
                            @elseif ($resultSet5[$i]["TestTypeId"] == "1003") 
                            {{-- // 2 km Run/Walk --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp32Kmrun;
                                    $IndividualFeedBack = __('userdashboard.AGrp32Kmrun');
                                @endphp                            
                            @elseif ($resultSet5[$i]["TestTypeId"] == "1004") 
                            {{-- // V-Sit Reach Test --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3VSitReach;
                                    $IndividualFeedBack = __('userdashboard.AGrp3VSitReach');
                                @endphp                            
                            @elseif ($resultSet5[$i]["TestTypeId"] == "1005") 
                            {{-- // Chair Stand Test  --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3ChairStand;
                                    $IndividualFeedBack = __('userdashboard.AGrp3ChairStand');
                                @endphp                            
                            @elseif ($resultSet5[$i]["TestTypeId"] == "1006") 
                            {{-- // Chair Sit and Reach Test --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3ChairSit_Reach;
                                    $IndividualFeedBack = __('userdashboard.AGrp3ChairSit_Reach');
                                @endphp                            
                            @elseif ($resultSet5[$i]["TestTypeId"] == "1007") 
                            {{-- // 8 Foot Up-and-Go Test --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp38FtGo;
                                    $IndividualFeedBack = __('userdashboard.AGrp38FtGo');
                                @endphp                            
                            @elseif ($resultSet5[$i]["TestTypeId"] == "1008") 
                            {{-- // 2-Minute Step Test --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp32minuteStep;
                                    $IndividualFeedBack = __('userdashboard.AGrp32minuteStep');
                                @endphp                            
                            @elseif ($resultSet5[$i]["TestTypeId"] == "1009") 
                            {{-- // Back Scratch Test --}}
                                @php
                                    // $IndividualFeedBack = Resources.ResourceUserDashboard.AGrp3BackStretch;
                                    $IndividualFeedBack = __('userdashboard.AGrp3BackStretch');
                                @endphp
                            @endif
                        @endif
                    @endif
                    {{-- if (ds_AllData.Tables[2].Rows[i]["Category"].ToString() == "label51" && ds_AllData.Tables[2].Rows[i]["TestType"].ToString() == "label56") --}}
                    @if($resultSet5[$i]["Category"] == "label51" && $resultSet5[$i]["TestType"] == "label56")
                        @php
                            $TestCategory = "label65";
                        @endphp
                    
                    @elseif($resultSet5[$i]["Category"] == "label51" && $resultSet5[$i]["TestType"] == "label57")
                        @php
                            $TestCategory = "label52";
                        @endphp
                    @else
                        @php
                            $TestCategory = $resultSet5[$i]["Category"];
                        @endphp
                    @endif

                    {{-- @if(!string.IsNullOrEmpty(ds_AllData.Tables[2].Rows[i]["Score"].ToString())) --}}
                    @if($resultSet5[$i]["Score"])
                        @php
                            // int CurrentScore = Convert.ToInt32(ds_AllData.Tables[2].Rows[i]["Score"]);
                            // string CurrentScoreUnit = ds_AllData.Tables[2].Rows[i]["Score_Unit"].ToString();
                            $CurrentScore = $resultSet5[$i]["Score"];
                            $CurrentScoreUnit = $resultSet5[$i]["Score_Unit"];
                        @endphp

                        @if($CurrentScoreUnit == "mm")
                            @php
                                $FCurrentScore = $resultSet5[$i]["Score"] ." " .__('taketest.label8');
                                $FScoreUnit = __('taketest.label8');
                            @endphp
                        @endif
                        
                        @if($CurrentScoreUnit == "msec")
                        
                            {{-- FCurrentScore = Showresult(ds_AllData.Tables[2].Rows[i]["Score"].ToString());
                            FScoreUnit = GetGlobalResourceObject("ResourceTakeTest", "label11").ToString(); --}}
                            @php
                                $FCurrentScore = $resultSet5[$i]["Score"];
                                $FScoreUnit = __('taketest.label11');
                            @endphp
                        @endif
                        @if ($CurrentScoreUnit == "number")
                        
                            {{-- FCurrentScore = ds_AllData.Tables[2].Rows[i]["Score"].ToString() + " " + GetGlobalResourceObject("ResourceTakeTest", "label129").ToString() + "";
                            FScoreUnit = GetGlobalResourceObject("ResourceTakeTest", "label129").ToString(); --}}
                            @php
                                $FCurrentScore = $resultSet5[$i]["Score"] ." " .__('taketest.label129');
                                $FScoreUnit = __('taketest.label129')
                            @endphp
                        @endif
                    @endif
                @endif
                
                <div class='col-xs-12 col-sm-12 col-md-4  border-box-right border-box-bottom'>
                    <div class='info-box'>

                <div class='info-head-caption'>
                <div class='info-box-content'>
                
                <span class='img-icon'>
                    {{-- <a href='{{ url('suggestionvideos'.'/'.$resultSet5[$i]["TestTypeId"].'/'.$resultSet5[$i]["AgeGroupId"]) }}' id='test' onclick='SuggestionVideoPopUp("{{ $resultSet5[$i]["TestTypeId"] }}")'> --}}
                        <img src='{{ url('resources/dotnetimages/'.$resultSet5[$i]["TestImage"]) }}' class=''>
                    {{-- </a> --}}
                    </span>
                {{-- <span class='info-box-text'>" + GetGlobalResourceObject("ResourceUserDashboard", TestCategory).ToString() + "</span> --}}
                <span class='info-box-text'>
                    {{ __("userdashboard.$TestCategory") }}
                </span>
                {{-- <span class='info-box-number'>" + GetGlobalResourceObject("ResourceUserDashboard", ds_AllData.Tables[2].Rows[i]["TestType"].ToString()).ToString() + "</span> --}}
                @php
                    $TestType = $resultSet5[$i]['TestType'];
                @endphp
                <span class='info-box-number'>{{ __("userdashboard.$TestType") }}</span>
                </div>
               
                <div class='percentage-box'>
                {{-- <span class='label-text-a increase-percentage' style='background: " + IndividualScorelblClr + "'>Math.Round(Convert.ToDecimal(Score)) + " " + GetGlobalResourceObject("ResourceHome", "label46").ToString()</span> --}}
                <span class='label-text-a increase-percentage' style='background: {{ $IndividualScorelblClr }}'>
                    @php                        
                        if($Score < 1){
                            $Score;
                        }elseif($Score > 1){
                            $Score = round($Score);
                        }
                    @endphp
                    {{ $Score }} {{ __('testhome.label46') }}
                </span>
                <small class='text-color-cdb small-caption'>{{ $IndividualLevelFeedback }}</small>
                </div>
                </div>

                <div class='progress-group'>

                @if ($resultSet5[$i]["Percentile"] < 20)                   
                    {{-- <div class='progress-bar-less-20-perc' style='width:" + IndividualBarWidth + ";'> --}}                        
                    <div class='progress-bar-less-20-perc' style='width:{{ $IndividualBarWidth }};'>                   
                @else                
                    <div class='progress-bar' style='width:{{ $IndividualBarWidth }};'>
                @endif
                <div class='progress-score'><span></span></div>
                <div class='pointer-position'>
                    {{-- <img src='images/pointer.png'> --}}
                    <img src="{{url('resources/dotnetimages/pointer.png')}}">
                </div>                    
                <div class='progress-unit'>
                    <span style='{{$ScoreWidth}}'>
                        {{-- {{ $FCurrentScore }} --}}
                        @php
                            $value = $resultSet5[$i]["Score"];
                            $unit = $resultSet5[$i]["Score_Unit"];
                            echo changeparmeter($value, $unit)
                        @endphp
                        {{-- {{ changeparmeter($value, $unit) }} --}}
                    </span>
                </div>

                </div>
                <div class='progress-gray-bg'>
                    <div class='endurance-bg-orange progress-endurance' style='background:{{$IndividualTestGraphClr}}; width:{{$IndividualBarWidth}};'></div>
                </div>
                </div>

                <div class='text-content'>
                
                {{-- @if(Convert.ToInt32(ds_AllData.Tables[2].Rows[i]["Percentile"]) < 90) --}}
                @if($resultSet5[$i]["Percentile"] < 90)

                    <div class='suggestionvideodiv' onclick='SuggestionVideoPopUp("{{ $resultSet5[$i]["TestTypeId"] }}")'>
                        {{-- GetGlobalResourceObject("ResourceUserDashboard", "lblsuggheadg").ToString() --}}
                            {{ __('userdashboard.lblsuggheadg') }}
                        <br/>
                        <span class='suggestionVideo'>
                            <a href='{{ url('suggestionvideos'.'/'.$resultSet5[$i]["TestTypeId"].'/'.$resultSet5[$i]["AgeGroupId"]) }}' id='test' >
                                {{-- <img src='Images/test_play.png' class='demo-test'> --}}
                                <img src="{{url('resources/dotnetimages/Images/test_play.png')}}" class='demo-test'>
                            </a>
                        </span>
                    </div>

                @endif                
                
                <p>{{ $IndividualFeedBack; }}
                    {{-- <a href='#a' onclick='ViewTestHistory(" + i + ")'> " + GetGlobalResourceObject("ResourceUserDashboard", "label53").ToString() + "  --}}
                        {{-- Route::get('/testresulthistory/{id?}/{testtypeid?}/{age?} --}}
                        @php
                            $F365Id = $resultSet5[$i]['F365Id'];
                            $TestTypeId = $resultSet5[$i]['TestTypeId'];
                            $age = Session::get('Age'); 
                        @endphp
                    <a href='{{url('/testresulthistory'.'/'.$F365Id.'/'.$TestTypeId.'/'. $age)}}' onclick='ViewTestHistory(" + i + ")'>{{ __('userdashboard.label53') }}
                        <i class='fa fa-arrow-circle-o-right'></i> 
                    </a>
                </p>
                </div>

                </div>
                </div>

                {{-- <input type='hidden' id='{{ $hidTestTypeId }}' value='{{ $resultSet5[$i]['TestTypeId'] }}'/> --}}

                @php
                    $AgeGroupId = $resultSet5[$i]['AgeGroupId'];
                    
                @endphp

            @endfor

            </div>
            </div>
            </div>
        @endif
    </div>
    </section>
    </div>
    <!--share icon only mobile device-->
    {{-- <div class="share-btn-mobile"><i class="fa fa-share-alt"></i></div> --}}
    <div id="ContentPlaceHolder1_reportHeader" class="container">
        <div class="row clearfix">
            <div class="download-report">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <input type="hidden" id="userF365Id" name="userF365Id" value="{{ $userprofile[0]['F365Id'] ?? ''}}">
                    <input type="hidden" id="UserDisplayDate" name="UserDisplayDate" value="{{ $DisplayDate ?? ''}}">
                    <div class="btn-box">
                        <a href="javascript:void(0)" name="F365Report" id="F365Report" class="btn btn-primary btn-lg" style="height:40px;">
                        {{-- <input type="submit" name="$btnF365Report" value="View Report" id="F365Report" class="btn btn-primary btn-lg"> --}}
                            <i class="fa fa-file-pdf-o pull-right dowload-data"></i>
                            {{ __('userdashboard.label61') }}
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="btn-box">
                        {{-- <input type="submit" name="FitnessHistory" value="Fitness History" id="FitnessHistory" class="btn btn-primary btn-lg"> --}}
                        {{-- <i class="fa fa-hourglass-3 pull-right dowload-data"></i> --}}
                        <a href="javascript:void(0)" id="btnFitnessHistory" name="btnFitnessHistory" Class="btn btn-primary btn-lg" style="height:40px;">
                            <i class='fa fa-hourglass-3 pull-right dowload-data'></i>
                            {{ __('userdashboard.label62') }}
                        </a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 benchmark">
                    <div class="btn-box">
                        <div class="y_boys">
                            <span id="ContentPlaceHolder1_spnAG">
                                {{-- 23 yrs,Male --}}
                                {{ $spnAgeGender ?? "" }}
                            </span>
                        </div>
                        {{-- <input type="submit" name="BenchMark" value="Benchmark" id="BenchMark" class="btn btn-primary btn-lg"> --}}
                        {{-- <a href="javascript:void(0)" id="btnBenchMark" name="btnBenchMark" Class="btn btn-primary btn-lg" style="height:40px;"> --}}
                            @php
                                
                                $GenderId = Session::get('GenderId')
                            @endphp
                        <a href="{{ url('benchmark'.'/'.$age.'/'. $GenderId) }}" id="btnBenchMark" name="btnBenchMark" Class="btn btn-primary btn-lg" style="height:40px;">
                            {{ __('userdashboard.label500') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row clearfix" style="margin-top:30px;"><div class="overall-fitess"><div class="wrapper-box bg2"><div class="col-xs-12 col-sm-12 col-md-4  border-box-right border-box-bottom"><div class="info-box"><div class="info-head-caption"><div class="info-box-content"><span class="img-icon"><a href="javascript:void(0);" id="test" onclick="SuggestionVideoPopUp(60)"><img src="Images/balance_i.png" class=""></a></span><span class="info-box-text">Balance</span><span class="info-box-number">Flamingo Balance Test</span></div><div class="percentage-box"><span class="label-text-a increase-percentage" style="background: #009bdf;">100 pts</span><small class="text-color-cdb small-caption">Athletic</small></div></div><div class="progress-group"><div class="progress-bar" style="width:100%;"><div class="progress-score"><span></span></div><div class="pointer-position"><img src="images/pointer.png"></div><div class="progress-unit"><span style="width:100%; display:block; text-align:right;">5 times</span></div></div><div class="progress-gray-bg"><div class="endurance-bg-orange progress-endurance" style="background:#009bdf;; width:100%;"></div></div></div><div class="text-content"><p>Keep it up <a href="#a" onclick="ViewTestHistory(0)"> View History <i class="fa fa-arrow-circle-o-right"></i> </a></p></div></div></div><input type="hidden" runat="server" id="hidTestTypeId0" value="60"><div class="col-xs-12 col-sm-12 col-md-4  border-box-right border-box-bottom"><div class="info-box"><div class="info-head-caption"><div class="info-box-content"><span class="img-icon"><a href="javascript:void(0);" id="test" onclick="SuggestionVideoPopUp(55)"><img src="Images/strength_i.png" class=""></a></span><span class="info-box-text">Abdominal muscular strength and endurance</span><span class="info-box-number">Partial Curl ups</span></div><div class="percentage-box"><span class="label-text-a increase-percentage" style="background: #ff043f;">0 pts</span><small class="text-color-cdb small-caption">Work Harder</small></div></div><div class="progress-group"><div class="progress-bar-less-20-perc" style="width:2%;"><div class="progress-score"><span></span></div><div class="pointer-position"><img src="images/pointer.png"></div><div class="progress-unit"><span style="width:128px; display:block; text-align:left;">2 times</span></div></div><div class="progress-gray-bg"><div class="endurance-bg-orange progress-endurance" style="background:#ff043f;; width:2%;"></div></div></div><div class="text-content"><div class="suggestionvideodiv" onclick="SuggestionVideoPopUp(55)">Suggestions for improvement<br><span class="suggestionVideo"><a href="javascript:void(0);" id="test"><img src="Images/test_play.png" class="demo-test"></a></span></div><p>Abdominal crunch, Knees to chest, Leg raises, Planks, Hollow body holds, V-tucks, Back extensions, Superman holds <a href="#a" onclick="ViewTestHistory(1)"> View History <i class="fa fa-arrow-circle-o-right"></i> </a></p></div></div></div><input type="hidden" runat="server" id="hidTestTypeId1" value="55"><div class="col-xs-12 col-sm-12 col-md-4  border-box-right border-box-bottom"><div class="info-box"><div class="info-head-caption"><div class="info-box-content"><span class="img-icon"><a href="javascript:void(0);" id="test" onclick="SuggestionVideoPopUp(57)"><img src="Images/endurance_i.png" class=""></a></span><span class="info-box-text">Muscular Endurance</span><span class="info-box-number">Push ups</span></div><div class="percentage-box"><span class="label-text-a increase-percentage" style="background: #fc6ba9;">23 pts</span><small class="text-color-cdb small-caption">Must Improve</small></div></div><div class="progress-group"><div class="progress-bar" style="width:16%;"><div class="progress-score"><span></span></div><div class="pointer-position"><img src="images/pointer.png"></div><div class="progress-unit"><span style="width:128px; display:block; text-align:left;">5 times</span></div></div><div class="progress-gray-bg"><div class="endurance-bg-orange progress-endurance" style="background:#fc6ba9;; width:16%;"></div></div></div><div class="text-content"><div class="suggestionvideodiv" onclick="SuggestionVideoPopUp(57)">Suggestions for improvement<br><span class="suggestionVideo"><a href="javascript:void(0);" id="test"><img src="Images/test_play.png" class="demo-test"></a></span></div><p>Wall Push ups, Inclined push ups, Knee push ups, Assisted floor push ups, push ups, Declined push ups, Dumbbell press, Triceps Dips <a href="#a" onclick="ViewTestHistory(2)"> View History <i class="fa fa-arrow-circle-o-right"></i> </a></p></div></div></div><input type="hidden" runat="server" id="hidTestTypeId2" value="57"></div></div></div> --}}
@endsection
@php
//    $v = __('taketest.label8');
//    echo $v;

function changeparmeter($value, $unit)
{

    
    if ($unit == 'mm') {
        if ($value < 1000 && $value >= 0) {
            $actualvalue = $value / 10;

            if (is_int($actualvalue)) {
                return $actualvalue . '.' . '0';
            } else {
                return $actualvalue;
            }
        } elseif ($value > -1000 && $value < 0) {
            $actualvalue = $value / 10;

            if (is_int($actualvalue)) {
                return $actualvalue . '.' . '0';
            } else {
                return $actualvalue;
            }
        }


    }

    if ($value >= '100000' && $unit == 'msec') {
        $actualvalue = $value / 60000;
        $decimalindex = strrpos($actualvalue, '.');
        $intvalue = substr($actualvalue, 0, $decimalindex);
        $decimalvalue = substr($actualvalue, $decimalindex + 1);
        $finaldecimalvalue = substr($decimalvalue, 0, 2);

        if (is_int($finaldecimalvalue < 10)) {
            return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue * 10 . ' ' . __('taketest.label66');
        } elseif (is_int($actualvalue)) {
            return $actualvalue . ' ' . __('taketest.label11') . ' ' . '0.0' . ' ' . __('taketest.label66');
        } else {
            return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue . ' ' . __('taketest.label66');
        }
    } elseif ($value <= '100000' && $unit == 'msec') {
        $actualvalue = $value / 1000;
        if ($actualvalue >= 60) {
            $actualvalue = $actualvalue / 60;
            if (is_int($actualvalue)) {
                return $actualvalue . ' ' . __('taketest.label11') . ' ' . '0.0' . ' ' . __('taketest.label66');
            } else {
                $decimalindex = strrpos($actualvalue, '.');
                $intvalue = substr($actualvalue, 0, $decimalindex);
                $decimalvalue = substr($actualvalue, $decimalindex + 1);
                $finaldecimalvalue = substr($decimalvalue, 0, 2);
                if ($finaldecimalvalue < 10) {
                    return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue * 10 . ' ' . __('taketest.label66');
                } else {
                    return $intvalue . ' ' . __('taketest.label11') . ' ' . $finaldecimalvalue . ' ' . __('taketest.label66');
                }
            }
        }
        if (is_int($actualvalue)) {
            return round($actualvalue,2) . '.0' . ' ' . __('taketest.label66');
        } else {
            return round($actualvalue,2) . ' ' . __('taketest.label66');
        }
    }
    if($unit=='number'){
    return $value ." ". __('userdashboard.label38');
    }
}

@endphp
<script src="{{ asset('public/js_data/en/label.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

$(document).on('click','#ContentPlaceHolder1_btnGo',function(){
    // alert('done');
        $('#divloader').show();
})

//     $(window).unload(function(){
//         alert('done');
//         $('#divloader').show();
// });
$(document).on('click','#F365Report',function(){
    // alert("13213213213213");
    // e.preventDefault();
    // F365Report
    // return false;
    var userF365Id = $('#userF365Id').val();
    var UserDisplayDate = $('#UserDisplayDate').val();
    console.log("userF365Id",userF365Id,UserDisplayDate);
    // return false;
    // alert("asdfasdfsadf");
    $.ajax({
        method: "get",
        url: baseurl + "/member_view_report/" + userF365Id+'/'+UserDisplayDate,
        contentType: false,
        processData: false,
        headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            // window.location = baseurl + "/member_view_report/327216/10%20May%202023";
            // window.location = baseurl + "/member_view_report/327216/"+UserDisplayDate;
            window.location = baseurl + "/member_view_report/"+userF365Id+"/"+UserDisplayDate;
            // window.location.reload();
            return false;

        }
    });
    return false;

})

$(document).on('click','#btnFitnessHistory',function(){
    // e.preventDefault();
    // F365Report
    var userF365Id = $('#userF365Id').val();
    // alert(userF365Id);
    $.ajax({
        method: "get",
        url: baseurl + "/member_fitness_history/" + userF365Id,
        contentType: false,
        processData: false,
        headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            window.location = baseurl + "/member_fitness_history/"+userF365Id;
            // window.location.reload();
            return false;

        }
    });
    return false;

})
</script>
