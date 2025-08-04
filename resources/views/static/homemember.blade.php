

@extends('static.layouts.appnet')
@section('title', 'Fit India Test List | Fit India')
@section('content')


<style>
    .cards-dv {
        margin-bottom: 15px;
    }

    .scrolling-wrapper {
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
    }

        .scrolling-wrapper .card, .nav-tabs.scrolling-wrapper .tab-list {
            display: inline-block;
        }


    .scrolling-wrapper-flexbox {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
    }

        .scrolling-wrapper-flexbox .card {
            flex: 0 0 auto;
            margin-right: 3px;
        }

    .card {
        width: 98%;
        height: auto;
        margin-right: 2px;
    }

    .scrolling-wrapper .card {
        width: 94%;
    }

    .scrolling-wrapper .tab-list {
        width: auto;
        height: auto;
        margin-right: 2px !important;
    }
        /*.scrolling-wrapper .tab-list:last-child {
        margin-right: 0px !important;
     }*/
        .scrolling-wrapper .tab-list a {
            padding: 3px 15px 5px 15px;
        }

    .scrolling-wrapper, .scrolling-wrapper-flexbox, .nav-tabs.scrolling-wrapper {
        height: auto;
        /*margin-bottom: 10px;*/
        width: 100%;
        -webkit-overflow-scrolling: touch;
    }

    .nav-tabs.scrolling-wrapper {
        margin-bottom: 5px;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .know-more-banner {
        margin-bottom: 0;
    }

    .know-about-tab > li > a {
        font-size: 14px;
    }
    .d-none{
        display: none;
    }

</style>
<header id="headermasterpage" >

    <div class="fix-header-app" id="headermaster" >

        <div class="header-menu-tab" id="navbar1">
            <ul>
                {{-- <li id="mychildren" class="busy"><a href="">Member</a></li> --}}
                <li id="mychildren" style="font-size: 14px;" class="busy"><a href="homeaddusers"><div id="listmember">{{ __('testhome.label802') }}</div></a></li>
                {{-- <li id="mychildren" class="busy"><a href="{{ route('home', $group) }}">Member</a></li> --}}
                <li id="tests"  style="font-size: 14px;" class="busy"><a href="testlist">{{__('testhome.label78')}}</a></li>

            </ul>
            <div class="clearfix"></div>
        </div>


    </div>
</header>
<div id="divloader" runat="server" class="divloader" style="display: none">
    <img src="{{ url('resources/dotnetimages/ajax-loader.gif') }}" />
</div>

    <div class="know-more-new-col howto-margin">
        <div class="container">


            <div class="container">
                <div id="divmembers">
                    <div class="app-member-col" id="divmemberscol">
                        <div id="divAllUser" style="margin-top: 65px;" >
                            <div class='row'><div class='col-xs-12 col-sm-12 col-md-12'>
                                <h4>My Members</h4>
                            </div>
                            <div class='clearfix'></div>
                            <div class="ajaxreloadalldata">
                                @php $i=0; @endphp
                                @foreach ($data as $data_value)
                                
                                    @php $i++; @endphp
                                    <?php //echo '<pre>'; print_r($data_value); exit;?>

                                    <div class='col-xs-12 col-sm-4 col-md-3' id='div1' runat='server'>
                                        <div class='app-member-detail'><div class='member-img' id='memberImage' runat='server'>
                                            {{-- <img src='SchoolImages/School_user_male.png' class='user-defult-img' alt='No Image Found' /> --}}
                                            {{-- {{ dd($data_value->PhotoPath) }} --}}
                                                              
                                           
                                            @if($data_value->ParentId == null)                                               

                                                @if(!empty($usermetas_image))                                                

                                                    @if($usermetas_image->image != null)
                                                        
                                                        <img src="{{ $usermetas_image->image ?? '' }}" class='user-defult-img' alt='School user male' />
                                                    @elseif($usermetas_image->image == null)
                                                        
                                                        @if($data_value->GenderId == 1) 

                                                            <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_male.png') }}" class='user-defult-img' alt='School user male' />

                                                        @elseif($data_value->GenderId == 2)

                                                            <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_female.png') }}" class='user-defult-img' alt='School user female' />
                                                            
                                                        @elseif($data_value->GenderId == 3)
                                                        
                                                            <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_female.png') }}" class='user-defult-img' alt='School user female' />
                                                        
                                                        @endif
                                                    @endif
                                                @endif
                                                
                                                @if(empty($usermetas_image))

                                                    @if($data_value->GenderId == 1) 

                                                        <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_male.png') }}" class='user-defult-img' alt='School user male' />

                                                    @elseif($data_value->GenderId == 2)

                                                        <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_female.png') }}" class='user-defult-img' alt='School user female' />
                                                        
                                                    @elseif($data_value->GenderId == 3)
                                                    
                                                        <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_female.png') }}" class='user-defult-img' alt='School user female' />
                                                    
                                                    @endif

                                                @endif
                                            @elseif($data_value->F365Id != $data_value->ParentId)
                                                @if($data_value->PhotoPath == 0)

                                                    @if($data_value->GenderId == 1) 

                                                        <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_male.png') }}" class='user-defult-img' alt='School user male' />

                                                    @elseif($data_value->GenderId == 2)

                                                        <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_female.png') }}" class='user-defult-img' alt='School user female' />
                                                        
                                                    @elseif($data_value->GenderId == 3)
                                                    
                                                        <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_female.png') }}" class='user-defult-img' alt='School user female' />
                                                    
                                                    @endif

                                                @elseif($data_value->PhotoPath != '')
                                                    <img src="{{ url('wp-content/uploads/'.$data_value->PhotoPath) }}" class='user-defult-img' alt='No Image Found' />
                                                @else

                                                    @if($data_value->GenderId == 1) 

                                                    <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_male.png') }}" class='user-defult-img' alt='School user male' />

                                                @elseif($data_value->GenderId == 2)

                                                    <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_female.png') }}" class='user-defult-img' alt='School user female' />
                                                    
                                                @elseif($data_value->GenderId == 3)
                                                
                                                    <img src="{{ url('resources/dotnetimages/SchoolImages/School_user_female.png') }}" class='user-defult-img' alt='School user female' />
                                                
                                                @endif
                                                @endif
                                            @endif
                                            <!-- <div class='edit-icon'><img src = 'http://192.168.23.254:190/Images/edit.png'/></div> -->
                                            @if($data_value->ParentId == null)
                                            @elseif($data_value->F365Id != $data_value->ParentId)
                                                <div class='edit-icon'>
                                                    {{-- <img src = "{{ url('wp-content/uploads/edit.png')}}"/> --}}
                                                    <img src = "{{ url('resources/dotnetimages/edit.png')}}"/>
                                                </div>
                                            @endif

                                            @if($data_value->ParentId != null)
                                                <input id='btnEdit' name='btnEdit' onclick='EditStudent({{ $data_value->F365Id ?? "" }})' type='button' data-toggle='modal' data-target='#myModal'/>
                                            @endif
                                        </div>
                                            <div class='member-detail'>
                                                <div class='detail'><p>{{ $data_value->Name ?? '' }}</p>
                                                    <span>
                                                        {{ $data_value->Age ?? '' }}   
                                                        {{ __('testhome.label32') }}
                                                    </span>
                                                    <span>
                                                        @if($data_value->GenderId == 1)
                                                            {{ __('testhome.label24') }}
                                                        @elseif($data_value->GenderId == 2)
                                                        {{ __('testhome.label25') }}
                                                        @elseif($data_value->GenderId == 3)
                                                        {{ __('testhome.label26') }}
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class='score-col'>
                                                    <span class='score-txt'>Fitness Score</span>
                                                    <span class='score' id='overallscore0'>{{ round($data_value->OverallPercentage) ?? '' }} pts</span>
                                                        @if ($data_value->OverallPercentage < 20)
                                                        {{-- // work harder                                                                              --}}
                                                            <span class='score-level'id="overallscorelevel{{$i}}"> <i class='fa fa-square label-color-01'></i>{{__('testhome.label87')}}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}
                                                        @elseif ($data_value->OverallPercentage >= 20 && $data_value->OverallPercentage < 40)
                                                        {{-- Must Approve --}}
                                                            <span class='score-level'id="overallscorelevel{{$i}}"> <i class='fa fa-square label-color-02'></i>{{__('testhome.label89')}}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}
                                                        @elseif ($data_value->OverallPercentage >= 40 && $data_value->OverallPercentage < 60)
                                                            {{-- can do better --}}
                                                            <span class='score-level'id="overallscorelevel{{ $i}}"> <i class='fa fa-square label-color-03'></i>{{__('testhome.label90')}}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}

                                                        @elseif ($data_value->OverallPercentage >= 60 && $data_value->OverallPercentage < 70)
                                                            {{-- //good --}}
                                                            <span class='score-level'id="overallscorelevel{{ $i}}"> <i class='fa fa-square label-color-04'></i>{{__('testhome.label91')}}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}

                                                        @elseif ($data_value->OverallPercentage >= 70 && $data_value->OverallPercentage < 80)
                                                            {{-- //Very Good --}}
                                                            <span class='score-level'id="overallscorelevel{{ $i}}"> <i class='fa fa-square label-color-05'></i>{{__('testhome.label92')}}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}

                                                        @elseif ($data_value->OverallPercentage >= 80 && $data_value->OverallPercentage < 90)
                                                            {{-- //Excellent --}}
                                                            <span class='score-level'id="overallscorelevel{{ $i}}"> <i class='fa fa-square label-color-06'></i>{{__('testhome.label93')}}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}

                                                        @elseif ($data_value->OverallPercentage >= 90)
                                                            {{-- //athletic --}}
                                                            <span class='score-level' id="overallscorelevel{{ $i}}"> <i class='fa fa-square label-color-07'></i>{{__('testhome.label88')}}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}
                                                        @endif
                                                        <!-- @if ($data_value->OverallPercentage < 20)
                                                        {{-- // work harder                                                                              --}}
                                                            <span class='score-level' id='overallscorelevel" + i + "'> <i class='fa fa-square label-color-01'></i>{{ $data_value->OverallPercentage ?? '' }}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}
                                                        @elseif ($data_value->OverallPercentage >= 20 && $data_value->OverallPercentage < 40)
                                                        {{-- Must Approve --}}
                                                            <span class='score-level' id='overallscorelevel" + i + "'> <i class='fa fa-square label-color-02'></i>{{ $data_value->OverallPercentage ?? '' }}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}
                                                        @elseif ($data_value->OverallPercentage >= 40 && $data_value->OverallPercentage < 60)
                                                            {{-- can do better --}}
                                                            <span class='score-level' id='overallscorelevel" + i + "'> <i class='fa fa-square label-color-01'></i>{{ $data_value->OverallPercentage ?? '' }}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}

                                                        @elseif ($data_value->OverallPercentage >= 60 && $data_value->OverallPercentage < 70)
                                                            {{-- //good --}}
                                                            <span class='score-level' id='overallscorelevel" + i + "'> <i class='fa fa-square label-color-01'></i>{{ $data_value->OverallPercentage ?? '' }}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}

                                                        @elseif ($data_value->OverallPercentage >= 70 && $data_value->OverallPercentage < 80)
                                                            {{-- //Very Good --}}
                                                            <span class='score-level' id='overallscorelevel" + i + "'> <i class='fa fa-square label-color-01'></i>{{ $data_value->OverallPercentage ?? '' }}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}

                                                        @elseif ($data_value->OverallPercentage >= 80 && $data_value->OverallPercentage < 90)
                                                            {{-- //Excellent --}}
                                                            <span class='score-level' id='overallscorelevel" + i + "'> <i class='fa fa-square label-color-01'></i>{{ $data_value->OverallPercentage ?? '' }}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}

                                                        @elseif ($data_value->OverallPercentage >= 90)
                                                            {{-- //athletic --}}
                                                            <span class='score-level' id='overallscorelevel" + i + "'> <i class='fa fa-square label-color-01'></i>{{ $data_value->OverallPercentage ?? '' }}</span> {{-- " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + " --}}
                                                        @endif -->




                                                    {{-- <span class='score-level' id='overallscorelevel0'>
                                                        <i class='fa fa-square label-color-03'></i> Can do better
                                                    </span> --}}
                                                </div>
                                                <div class='clearfix hide-mob'></div>
                                            </div>
                                            <div class='view-details'>
                                                <div class='btndetails' style='display:block'>
                                                    {{-- <a href='#a' class='dashbtn' onclick='getUserDataDetails(0)'> --}}
                                                    {{-- <a href='{{ url('/')}}/memberdashboard/{{ $data_value->F365Id }}' class='dashbtn'> --}}
                                                        @php
                                                            $url = url('/memberdashboard').'/'.$data_value->Name.'/'.$data_value->F365Id.'/'.$data_value->Age.'/'.$data_value->AgeGroupId.'/'.$data_value->AgeGroupName.'/'.$data_value->GenderId;
                                                        @endphp
                                                    <a href='javascript:void(0)' onclick='checkUser("{{$url}}",{{$data_value->F365Id}})' class='dashbtn'>
                                                    {{-- <a href='{{route('memberdashboard',['Name'=>$data_value->Name,'F365Id'=>$data_value->F365Id])}}' class='dashbtn'> --}}
                                                        <span>
                                                            <?php 
                                                            echo mb_strimwidth(__('testhome.label47'), 0, 8, "...");
                                                            ?>
                                                            {{-- {{ __('testhome.label47') }} --}}
                                                        </span>
                                                    </a>
                                                    <!-- <a href='javascript:void(0)' class='taketestbtn' onclick='getUserDataTakeTest(0)'> -->
                                                    <!-- <a href='{{url('taketest') }}' class='taketestbtn' >
                                                        <span>Take a Test</span>
                                                    </a> -->
                                                    @php
                                                        $taketesturl = url('/taketest').'?Name='.urlencode($data_value->Name).'&F365Id='.$data_value->F365Id.'&Age='.$data_value->Age.'&AgeGroupId='.$data_value->AgeGroupId.'&AgeGroupName='.$data_value->AgeGroupName.'&GenderId='.$data_value->GenderId;
                                                    @endphp
                                                    {{-- <a href={{$taketesturl}} class='taketestbtn' ><span>{{ __('testhome.label8') }}</span></a> --}}
                                                    <a href='javascript:void(0)' class='taketestbtn' onclick='checkUseractive("{{ $taketesturl }}",{{ $data_value->F365Id }})'>
                                                        <span>
                                                            <?php 
                                                            echo mb_strimwidth(__('testhome.label8'), 0, 8, "...");
                                                            ?>
                                                            {{-- {{ __('testhome.label8') }} --}}
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                            {{-- {{ dd($data_value) }} --}}
                                            <input type='hidden' id='F365Id' value='{{ $data_value->F365Id ?? "" }}'/>
                                            <input type='hidden' id='ParentId' value='{{ $data_value->ParentId ?? $data_value->F365Id }}'/>
                                            <input type='hidden' class="IsActiveId_{{ $data_value->F365Id }}" value='{{ $data_value->IsActive ?? "" }}'/>
                                            <input type='hidden' class='OverallPercentageId_{{ $data_value->F365Id }}' value='{{ $data_value->OverallPercentage ?? "" }}'/>
                                            <input type='hidden' class='langId_{{ $data_value->F365Id }}' value='{{ Session::get('lang') }}'/>
                                            <input type='hidden' id='hidf365name0' value='User'/>
                                            <input type='hidden' id='hidf365id0' value='327216'/>
                                            <input type='hidden' id='hidage0' value='23'/><input type='hidden' id='hidagegroupid0' value='3'/>
                                            <input type='hidden' id='hidagegroupname0' value='label13'/>
                                            <input type='hidden' id='hidgenderid0' value='1'/>
                                            <input type='hidden' id='hidad0' value='1'/>
                                            <input type='hidden' id='hiduid0' value='UI001'/>
                                            <div class='clearfix'></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class='add-child-btn-col'>
                                <a href='#' class='add-child-btn' data-toggle='modal' data-target='#myModal' id='addMember' style="margin-right: 18px;"  onclick='addStudent()'>
                                    {{ __('testhome.label800') }}
                                </a>
                            </div>
                        </div>
                        @if($countdatacount > 3)
                            <div class='view-all-member-col btnviewall'>
                                    <a id="allusers" href='javascript:void(0)'>
                                        {{ __('testhome.label801') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal Popup Signup Start -->
     <div class="modal right fade" id="myModal" role="dialog" style="display: none;">
        <div class="modal-dialog full-width-model">

            <!-- Modal content Start-->

            <form class="user_save_users" enctype="multipart/form-data">
                @csrf
                <div class="modal-content add-member-popup">
                    <div class="modal-header">
                        <button type="button" id="btnClose" class="close" data-dismiss="modal">
                            {{-- <img src="Images/switch-user.png" /></button> --}}
                            <!-- <img src="http://192.168.23.254:190/Images/switch-user.png"/></button> -->
                            <img src="{{ url('resources/dotnetimages/switch-user.png') }}"/></button>
                        <!-- <h4 class="modal-title" id="HeadingMem"><%= Resources.ResourceHome.label11 %></h4> -->
                        <h4 class="modal-title" id="HeadingMem">{{ __('testhome.label82') }}</h4>
                        <!-- <h4 class="modal-title" id="HeadingMem">ADD MEMBER'S DETAILS</h4> -->
                    </div>

                    <div class="modal-body">
                        <div class="mdl-dv">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Name">
                                            <!-- {{-- <%= Resources.ResourceHome.label12 %> --}} -->
                                            {{ __('testhome.label12') }}
                                            <!-- Name -->
                                            <em>*</em>
                                        </label>
                                        <input type="text" ID="FirstName" name="FirstName"  class="form-control" placeholder="Name" style="font-size: 16px;"  onkeypress="return (event.charCode > 64 &amp;&amp; 
                                                    event.charCode < 91) || (event.charCode > 96 &amp;&amp; event.charCode < 123) || event.charCode == 32"/>
                                        <!-- <span class="errorMessage" id="error_FirstName" style="display:none">Please enter full name</span> -->
                                        <span class="errorMessage" id="error_FirstName" style="display:none;color:red">{{ __('testhome.label83') }}</span>
                                        {{-- <span class="errorMessage" id="spnfirstname" style="display: none"><%= Resources.ResourceHome.label13 %></span> --}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Name">
                                            {{-- <%= Resources.ResourceHome.label14 %> --}}
                                            {{ __('testhome.label14') }}
                                            <!-- DOB -->
                                            <em>*</em>
                                        </label>
                                        @php
                                            $time_max = strtotime("-5 year", time());
                                            $max_date = date("Y-m-d", $time_max);                                            
                                            $time_min = strtotime("-100 year", time());
                                            $min_date = date("Y-m-d", $time_min);
                                        @endphp     
                                        <input type="date" ID="DOB" name="dob"  class="form-control w-100" style="width: 100% !important; font-size:16px; -webkit-appearance: none;" min="{{ $min_date }}" max="{{ $max_date }}" placeholder=""/>
                                        {{-- <input type="date" id="start" name="trip-start" value="{{ $max_date }}" min="{{ $min_date }}" max="{{ $max_date }}"> --}}
                                        <!-- <span class="errorMessage" id="error_DOB" style="display: none">Please fill date</span> -->
                                        <span class="errorMessage" id="error_DOB" style="display: none; color:red ">{{ __('testhome.label86') }}</span>
                                        {{-- <span class="errorMessage" id="spndob" style="display: none"><%= Resources.ResourceHome.label13 %></span> --}}
                                    </div>
                                </div>
                                {{-- <div class="clearfix"></div> --}}
                                    <div class="col-xs-12 col-md-6" style="display: none">
                                        <div class="form-group">
                                            <!-- <label for="Name"><%= Resources.ResourceHome.label15 %></label> -->
                                            <label for="Name">{{ __('testhome.label15') }}</label>
                                            <input type="text" ID="Email" name="email"   CssClass="form-control" Placeholder="{{ __('testhome.label15') }}" />
                                            <!-- <span class="errorMessage" id="spnemail" style="display: none"><%= Resources.ResourceHome.label18 %></span> -->
                                            <span class="errorMessage" id="spnemail" style="display: none;color:red">{{ __('testhome.label18') }}</span>
                                        </div>
                                    </div>

                                {{-- <div class="col-xs-12 col-md-6" style="display:none">
                                    <div class="form-group">
                                        <label for="Name">{{ __('testhome.label16') }}</label>
                                        <input type="text" ID="Phone"  CssClass="form-control" Placeholder="<% $Resources:ResourceHome,label16 %>" TextMode="Number" />
                                        <span class="errorMessage" id="spnphone" style="display:none">{{ __('testhome.label13') }}</span>
                                    </div>
                                </div> --}}
                                <div class="clearfix"></div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="gender-div">
                                            {{ __('testhome.label17') }}
                                            <em>*</em>
                                        </div>
                                        <label class="radio-inline">
                                            <input type="radio" class="add_member_gender"  id="male" name="GenderGroup" Text="Male"  value="1"/>
                                                <label for="ContentPlaceHolder1_Male">{{ __('testhome.label24') }}</label>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" class="add_member_gender" id="female" name="GenderGroup" Text="Female" value="2"/>
                                            <label for="ContentPlaceHolder1_Female">{{ __('testhome.label25') }}</label>
                                        </label>
                                        <label class="radio-inline" style="display: none">
                                            <input type="radio" id="Transgender" GroupName="GenderGroup" Text="Transgender" />
                                            <label for="ContentPlaceHolder1_Transgender">{{ __('testhome.label26') }}</label>
                                        </label>
                                        <span class="errorMessage" id="error_add_member_gender" style="display: none;color:red">{{ __('testhome.label13') }}</span>
                                    </div>

                                </div>
                                {{-- <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="gender-div">
                                            {{ __('testhome.label17') }}
                                            <!-- Gender -->
                                            <em>*</em>
                                        </div>
                                        <label class="radio-inline">
                                            <input type="radio" ID="Male"  Name="GenderGroup" Text="Male" />
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" ID="Female" Name="GenderGroup" Text="Female" />
                                        </label>
                                        <label class="radio-inline" style="display: none">
                                            <input type="radio" ID="Transgender"  GroupName="GenderGroup" Text="Transgender" />
                                        </label>
                                        <span class="errorMessage" id="spngender" style="display: none"><%= Resources.ResourceHome.label13 %></span>
                                    </div>
                                </div> --}}
                                <div class="col-xs-12 col-md-6 col-sm-6" id="UIdDropDown" style="display:none;">
                                    <label for="Name">
                                        {{ __('testhome.label19') }}
                                    </label>
                                    <div class="clearfix"></div>
                                    <div class="form-inner2">
                                        <div class="form-group">
                                            {{-- <asp:DropDownList ID="ddlUID"  CssClass="form-control"></asp:DropDownList> --}}
                                            <select CssClass="form-control" ID="ddlUID">
                                            </select>
                                            <span class="errorMessage" id="spnddluid" style="display: none;color:red">{{ __('testhome.label13') }}</span>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-xs-12 col-md-6 col-sm-6" id="dvuid" style="display:none;">
                                <div class="form-inner2">
                                    <div class="form-group unic-id-input">
                                        <label>{{ __('testhome.label20') }}</label>
                                        <input type="text" ID="UID"  CssClass="form-control" Placeholder="{{ __('testhome.label20') }}" />
                                        <span class="errorMessage validate-error-span" id="spnuid" style="display: none">{{ __('testhome.label13') }}</span>

                                        <button type="button" id="btnValidate" class="btn btn-default member-btn-submit validate-btn" onclick="ValidateId()">
                                            <span class="btn-text-velidate">{{ __('testhome.label43') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                                <div class="col-xs-12" id="spndanger" style="display:none;">
                                    <div class="alert alert-success" id="validationclass"></div>
                                </div>

                                {{-- <div class="col-xs-12 col-md-6" id="photodiv" style="display:none;">
                                    <div class="form-group">
                                        <label for="Name">
                                            <%= Resources.ResourceMaster.label21 %>
                                        </label>
                                        <asp:FileUpload ID="FileUpload1"  />
                                    </div>
                                </div> --}}

                                <div class="col-xs-12 col-md-6" id="photodiv" style="display:none;">
                                {{-- <div class="col-xs-12 col-md-6" id="photodiv"> --}}
                                    <div class="form-group">
                                        <label for="Name">
                                            {{ __('testhome.label84') }}
                                        </label>
                                        <input type="file" id="FileUpload1" name="fileUpload1" accept="image/png, image/gif, image/jpeg"/>
                                    </div>
                                    <span class="errorMessage" id="errorimageupload" style="display: none;color:red">{{ __('testhome.label85') }}</span>
                                </div>



                                <div class="col-xs-12 col-md-12" id="privacyterms">
                                    <p>{{ __('testhome.label41') }}</p>
                                    <p>{{ __('testhome.label42') }}</p>
                                </div>


                                <div class="col-xs-12 col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{ __('testhome.label22') }}</label>
                                            <!-- <label>Enter the below characters:</label> -->
                                        </div>
                                        <div class="um-field" id="capcha-page-cont" style="display:block;">
                                           <div style="display: flex; justify-content:space-between; width:100% ">
                                            <div id="pagecaptcha-cont">
                                                <div class="captchaimg" style="margin-left: 10px;">
                                                    <span>{!! captcha_img() !!}</span>
                                                </div>
                                            </div>
                                            <div class="captcha-reset-btn" style="width: 100%; margin-right:10px; display:flex;">
                                                <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
                                            </div>
                                           </div>
                                            <div class="captcha-txtbx">
                                            <input type="text" id="captcha" name="captcha" class="form-control" required="" placeholder="Captcha">
                                                <!-- <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror"  placeholder="Captcha"> -->
                                                @error('captcha')
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <span class="errorMessage" id="errorcaptcha" style="display: none;color:red">Please fill captcha</span>
                                            <div style="clear:both;"></div>
                                            <span class="errorinvalidcaptcha" id="errorinvalidcaptcha" style="display: none;color:red">Invalid Captcha</span>
                                            <div style="clear:both;"></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <input type="Hidden" id="hidF365" name="hidF365" Value="0"/>
                    <input type='Hidden' id='UserParentId' name="UserParentId" value='{{ $data_value->ParentId ?? "" }}'/>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" id="activate" class="btn btn-default member-btn-submit model-active-btn busy" Style="display: none" OnClick="return btn_activate()">Activate</button>
                        <a href="javascript:void(0)" id="deactivate" name="btn_Deactivate" class="btn btn-default member-btn-submit model-inactive-btn busy" Style="display: none" OnClick="return btn_Deactivate()">Deactivate</a>
                        {{-- <button type="submit" id="save_user" class="btn btn-default member-btn-submit" OnClick="btnSave_User">Save</button> --}}
                        <button type="submit" id="save_user" class="btn btn-default member-btn-submit" Style="display: none">Save</button>
                        <input type="Hidden" id="hidLang"/>
                        <input type="Hidden" id="hidimagename"/>
                        <input type="Hidden" id="hidimagepath"/>
                    </div>
                </div>
            </form>
            <!-- Modal content End-->


        </div>
    </div>
    <!-- Modal Popup End -->

    <!-- Modal Popup Message Start -->
    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog fitness-app-model thankyou-popup">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <p id="content1"></p>
                </div>
                <div class="modal-footer">
                    <!-- <a href="#" type="button" onclick="closeModal();" class="btn btn-default thankyou-btn"><%= Resources.ResourceHome.label36 %></a> -->
                    <a href="#" type="button" onclick="closeModal();" class="btn btn-default thankyou-btn">{{ __('testhome.label36') }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Popup End -->
    <script src="{{ asset('public/js_data/en/label.js') }}"></script>
    <script>
        function openModal(displayText) {
            $("#myModal1").removeClass("modal fade");
            $("#myModal1").addClass("modal fade in");
            $("#myModal1").css("display", "block");
            $("#myModal1").css("background", "rgba(0,0,0,0.5)");
            $("#content1").html(displayText);
            return false;
        }
        function openLoginModal() {
            $("#myModal1").removeClass("modal fade");
            $("#myModal1").addClass("modal fade in");
            $("#myModal1").css("display", "block");
            $("#myModal1").css("background", "rgba(0,0,0,0.5)");
            $("#content1").html("Please login to add a member.");
        }
        //------------close mdal popup-------------------//
        function closeModal() {
            $("#myModal1").removeClass("modal fade in");
            $("#myModal1").addClass("modal fade");
            $("#myModal1").css("display", "none");
        }
   function checkUser(url,unique){    
       
        if($(".OverallPercentageId_"+unique).val() != .00 && $(".IsActiveId_"+unique).val() == 1){
            window.location.href = url;
        }
        
        if($(".IsActiveId_"+unique).val() == 0){        
            return false;
            if($(".langId_"+unique).val() == 'en'){

                openModal("User is deactive, please activate before taking test");
                return false;

            }else if($(".langId_"+unique).val() == 'hn'){

                alert("सदस्य निष्क्रिय है, कृपया डैशबोर्ड देखने से पहले सक्रिय करें");
                return false;
            }
        }        
        
        if($(".OverallPercentageId_"+unique).val() == .00){

            if($(".langId_"+unique).val() == 'en'){

                openModal("Please take test first before viewing dashboard");
                return false;

            }else if($(".langId_"+unique).val() == 'hn'){

                alert("डैशबोर्ड देखने से पहले कृपया पहले परीक्षण करें");
                return false;
            }
        
        }        
    }

    function checkUseractive(taketesturl,unique){    
       
       if($(".IsActiveId_"+unique).val() == 1){

           window.location.href = taketesturl;
        
       }    
    
       if($(".IsActiveId_"+unique).val() == 0){        
        
           if($(".langId_"+unique).val() == 'en'){

               openModal("User is deactive, please activate before taking test");
               return false;

           }else if($(".langId_"+unique).val() == 'hn'){

               alert("सदस्य निष्क्रिय है, कृपया डैशबोर्ड देखने से पहले सक्रिय करें");
               return false;
           }
       }        
   	}

        jQuery('#reload').click(function () {
            jQuery.ajax({
                type: 'GET',
                url: "{{ route('reloadCaptcha')}}",
                success: function (data) {
                    jQuery(".captchaimg span").html(data.captcha);
                }
            });
        });

        $(document).ready(function () {
            $('#navbar1').css('display', 'block');
            $('#landingdescription').css('display', 'block');
            $('#mychildren').addClass("active");
            $('#tips').removeClass("active");
        });
        function goBack() {
            window.location=href="{{ url('homeaddusers') }}";
        }

        function gotohometest() {
            window.location.href = "Home.aspx";
            window.location.href = "TakeTest.aspx";
        }


        function btn_activate(){

            $('#divloader').show();
            
            var memberid = $('#hidF365').val();
            $.ajax({
                method: "get",
                url: baseurl + "/activate_member/" + memberid,
                contentType: false,
                processData: false,
                headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#divloader').hide();
                    window.location.reload();
                    return false;

                }
            });
        }

        function btn_Deactivate(){

            $('#divloader').show();
            var memberid = $('#hidF365').val();

            $.ajax({
                method: "get",
                url: baseurl + "/deactivate_member/" + memberid,
                contentType: false,
                processData: false,
                headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {

                    $('#divloader').hide();
                    window.location.reload();
                    return false;
                }
            });



        }

        function EditStudent(F365Id){
            
            $('#divloader').show();
            $('#photodiv').css('display', 'block');
            $('#save_user').css('display', 'block');
            $("#save_user").text('Update');
            var memberid = F365Id;
            var formdata = {id:memberid};
            $.ajax({
                method: "get",
                url: baseurl + "/getdata/" + memberid,
                contentType: false,
                processData: false,
                headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },

                success: function (response) {      
                    
                    $('#divloader').hide();

                    $('#hidF365').val(response.data.F365Id);
                    $('#FirstName').val(response.data.Name);
                    $('#DOB').val(response.data.DOB);
                    if(response.data.Gender == 1){

                        $("#male").prop("checked", true);
                    }else if(response.data.Gender == 2){

                        $("#female").prop("checked", true);
                    }

                    if(response.data.IsActive == 1){

                        $('#activate').css('display', 'none');
                        $('#deactivate').css('display', 'block');
                        $('#FirstName').attr('readonly', false);
                        $('#DOB').attr('readonly', false);
                        $('#male').attr('readonly', false);
                        $('#female').attr('readonly', false);
                        $('#FileUpload1').attr('readonly', false);
                        $('#capcha-page-cont').css('display', 'block');

                    }else if(response.data.IsActive == 0){
                        $('#activate').css('display', 'block');
                        $('#deactivate').css('display', 'none');
                        $('#FirstName').attr('readonly', true);
                        $('#DOB').attr('readonly', true);
                        $('#male').attr('readonly', true);
                        $('#female').attr('readonly', true);
                        $('#FileUpload1').attr('readonly', true);
                        $('#capcha-page-cont').css('display', 'none');

                    }
                }
            });
        }

        function addStudent(){
            $('.user_save_users')[0].reset();
            @php
                $time_max = strtotime("-5 year", time());
                $max_date = date("Y-m-d", $time_max);
            @endphp     
           
            $('#save_user').css('display', 'block');
            $('#hidF365').val('0');
            // $("#photodiv").removeAttr("style");
            $("#photodiv").removeAttr("style");
            // $("#photodiv").removeClass("display: none");
            $('#photodiv').css('display', 'none');
            $('#activate').css('display', 'none');
            $('#deactivate').css('display', 'none');
            $("#save_user").text('Save');
        }

        function closePopup() {
            alert(987897897);
            $('#myModal').modal('hide');
            $('#lblVideoSource').html("");
            // window.location.reload();
            // return false;
        }

        $('.user_save_users').on('submit',function(e){
        
            $('#divloader').show();
            
            e.preventDefault();

            var getSelectedValue = document.querySelector('input[name="GenderGroup"]:checked');

            if($('#FirstName').val()  == ''){
                $("#error_FirstName").css("display", "block");
                $('#divloader').hide();
                return false;

            }

            if($('#DOB').val()  == ''){
                $("#error_DOB").css("display", "block");
                $('#divloader').hide();
                return false;
            }
            
            if($('#captcha').val()  == ''){
                $("#errorcaptcha").css("display", "block");
                $('#divloader').hide();
                return false;
            }

            if(getSelectedValue == null){
                $("#error_add_member_gender").css("display", "block");
                $('#divloader').hide();
                return false;

            }

            if($('#hidF365').val()  != 0){

                
                var ext = $('#FileUpload1').val().split('.').pop().toLowerCase();
                console.log("FileUpload1",ext);

                if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){

                    $('#divloader').hide();
                    $("#errorimageupload").css("display", "block");
                    return false;

                }else{

                    $("#errorimageupload").css("display", "none");

                }
            }

            var formdata =  new FormData($('.user_save_users')[0]);

            $.ajax({

                method: "POST",
                url: baseurl + "/storedata",
                data: formdata,
                contentType: false,
                processData: false,
                headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {

                    if(response.success == false){
                        $("#errorinvalidcaptcha").css("display", "block");
                        $('#divloader').hide();

                        jQuery.ajax({
                            type: 'GET',
                            url: "{{ route('reloadCaptcha')}}",
                            success: function (data) {
                                jQuery(".captchaimg span").html(data.captcha);
                            }
                        });
                        
                        return false;
                    }else{
                        window.location.reload();
                    }   
                    // window.location.reload();
                    // // $('#divloader').hide();
                    // return false;
                }

            });
        })

    $(document).on('click','#allusers',function(){
    
        $('#divloader').show();
        var ParentId = $('#ParentId').val();        

        $.ajax({

            method: "get",
            url: baseurl + "/getalldata/" + ParentId,            
            contentType: false,
            processData: false,
            headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#divloader').hide();                    
                    $('.btnviewall').addClass('d-none');                    
                    console.log("response",response)
                    var html = '';                
                        for(let i = response.data.length-1; i > -1; i--){ 
                            // console.log("111111",response.user_image_parentid);
                            
                            blankimage = "School_user_male.png";
                            // if(response.data[i].ParentId == null){

                            //     console.log("111111",response.user_image_parentid);
                            //     image = `<img src="${response.user_image_parentid}" class='user-defult-img' alt='Image Found' />`;

                            // }else if(response.data[i].ParentId != null){

                            //     console.log("222222");
                            // }
                            if(response.data[i].ParentId == null){

                                edit_image = ``;                                

                                if(response.data[i].ParentId == null){
                                    if(response.data[i].ParentId == null){
                                        image = `<img src="${response.user_image_parentid}" class='user-defult-img' alt='Image' />`;
                                    }else if(response.data[i].GenderId == 1){    
                                        image =  `<img src="<?php echo url('resources/dotnetimages/SchoolImages/School_user_male.png') ?>" class='user-defult-img' alt='School user male' />`;
                                    }else if(response.data[i].GenderId == 2){
                                        image =  `<img src="<?php echo url('resources/dotnetimages/SchoolImages/School_user_female.png') ?>" class='user-defult-img' alt='School user female' />`;
                                    }else if(response.data[i].GenderId == 3){
                                        image =  `<img src="<?php echo url('resources/dotnetimages/SchoolImages/School_user_female.png') ?>" class='user-defult-img' alt='School user female' />`;
                                    }
                                }else{
                                    image = `<img src="${response.user_image_parentid}" class='user-defult-img' alt='Image Found' />`;
                                }
                            
                            }else{
                            
                                edit_image = `<input id='btnEdit' name='btnEdit' onclick='EditStudent(${response.data[i].F365Id})' type='button' data-toggle='modal' data-target='#myModal'/>`;
                            

                                if( response.data[i].PhotoPath == null || response.data[i].PhotoPath == "" || response.data[i].PhotoPath == 'undefined' || response.data[i].PhotoPath == 0){
                                    if(response.data[i].GenderId == 1){    
                                        image =  `<img src="<?php echo url('resources/dotnetimages/SchoolImages/School_user_male.png') ?>" class='user-defult-img' alt='School user male' />`;
                                    }else if(response.data[i].GenderId == 2){
                                        image =  `<img src="<?php echo url('resources/dotnetimages/SchoolImages/School_user_female.png') ?>" class='user-defult-img' alt='School user female' />`;
                                    }else if(response.data[i].GenderId == 3){
                                        image =  `<img src="<?php echo url('resources/dotnetimages/SchoolImages/School_user_female.png') ?>" class='user-defult-img' alt='School user female' />`;
                                    }
                                }else{

                                    image = `<img src="<?php echo url('wp-content/uploads/${response.data[i].PhotoPath}') ?>" class='user-defult-img' alt='No Image Found' />`;
                                }
                            }


                            if(response.data[i].GenderId == 1){
                                GenderId = "{{ __('testhome.label24')}}";
                            }else if(response.data[i].GenderId == 2){
                                GenderId = "{{ __('testhome.label25')}}";
                            }else {
                                GenderId = "{{ __('testhome.label26')}}";
                            }
                            OverallPercentage = Math.round(response.data[i].OverallPercentage)

                            if(OverallPercentage < 20){
                                // work harder
                                OverallPercentagestatus = `<span class='score-level'id='overallscorelevel${i}'> <i class='fa fa-square label-color-01'></i>{{__('testhome.label87')}}</span>` // GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString()
                            }else if (OverallPercentage >= 20 && OverallPercentage < 40){
                                // Must Approve
                                OverallPercentagestatus = `<span class='score-level'id='overallscorelevel${i}'> <i class='fa fa-square label-color-02'></i>{{__('testhome.label89')}}</span>` // " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + "
                            }else if (OverallPercentage >= 40 && OverallPercentage < 60){
                                // can do better
                                OverallPercentagestatus = `<span class='score-level'id='overallscorelevel${i}'> <i class='fa fa-square label-color-03'></i>{{__('testhome.label90')}}</span>` // " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + "

                            }else if (OverallPercentage >= 60 && OverallPercentage < 70){
                                //good
                                OverallPercentagestatus = `<span class='score-level'id='overallscorelevel${i}'> <i class='fa fa-square label-color-04'></i>{{__('testhome.label91')}}</span>` // " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + "

                            }else if (OverallPercentage >= 70 && OverallPercentage < 80){
                                //Very Good
                                OverallPercentagestatus = `<span class='score-level'id='overallscorelevel${i}'> <i class='fa fa-square label-color-05'></i>{{__('testhome.label92')}}</span>` // " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + "

                            }else if (OverallPercentage >= 80 && OverallPercentage < 90){
                                // //Excellent
                                OverallPercentagestatus = `<span class='score-level'id='overallscorelevel${i}'> <i class='fa fa-square label-color-06'></i>{{__('testhome.label93')}}</span>` // " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + "

                            }else if (OverallPercentage >= 90){
                                //athletic
                                OverallPercentagestatus = `<span class='score-level'id='overallscorelevel${i}'> <i class='fa fa-square label-color-07'></i>{{__('testhome.label88')}}</span>` // " + GetGlobalResourceObject("ResourceUserDashboard", "label24").ToString() + "
                            }

                            
                            if(response.data[i].ParentId == null){
                                var htmlimage  = '';
                            }else if(response.data[i].F365Id != response.data[i].ParentId){
                                var htmlimage = `<div class='edit-icon'>
                                    <img src = '${baseurl}/resources/dotnetimages/edit.png'/>
                                    </div>`;
                            }else{
                                var htmlimage  = '';
                            }
                            var username = encodeURI(response.data[i].Name);
                            html +=`<div class='col-xs-12 col-sm-4 col-md-3' id='div1' runat='server'>
                                            <div class='app-member-detail'><div class='member-img' id='memberImage' runat='server'>
                                                    ${image}
                                                    ${htmlimage}
                                                    ${edit_image}
                                                </div>
                                                    <div class='member-detail'>
                                                        <div class='detail'><p>${response.data[i].Name}</p>
                                                            <span>${response.data[i].AGE} {{__('testhome.label32') }}</span>
                                                            <span>
                                                                ${GenderId}
                                                            </span>
                                                        </div>
                                                        <div class="score-col">
                                                            <span class="score-txt">{{__('testhome.label34') }}</span>
                                                            <span class="score" id="overallscore0">${OverallPercentage} pts</span>
                                                            <span class="score-level" id="overallscorelevel4"> ${OverallPercentagestatus}</span>
                                                        </div>
                                                    </div>


                                                    <div class='view-details' style="display:flex !important;'">
                                                        <div class='btndetails' style='display:block'>
                                                            <a style="margin-right:42px !important;" onclick="checkUser('${baseurl}/memberdashboard/${response.data[i].Name}/${response.data[i].F365Id}/${response.data[i].AGE}/${response.data[i].AgeGroupId}/${response.data[i].AgeGroupName}/${response.data[i].GenderId}',${response.data[i].F365Id})" href="javascript:void(0)" class='dashbtn'>
                                                                <span>
                                                                    <?php 
                                                                        echo mb_strimwidth(__('testhome.label47'), 0, 8, "...");
                                                                    ?>
                                                                </span>
                                                            </a>
                                                            <a href='${baseurl}/taketest/?Name=${username}&F365Id=${response.data[i].F365Id}&Age=${response.data[i].AGE}&AgeGroupId=${response.data[i].AgeGroupId}&AgeGroupName=${response.data[i].AgeGroupName}&GenderId=${response.data[i].GenderId}' class='taketestbtn' onclick='getUserDataTakeTest(0)'>
                                                                <span>
                                                                    <?php 
                                                                        echo mb_strimwidth(__('testhome.label8'), 0, 8, "...");
                                                                    ?>                                                                    
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <input type='hidden' id='F365Id'  value="${response.data[i].F365Id}"/>
                                                    <input type='hidden' id='ParentId' value="${response.data[i].ParentId}"/>
                                                    <input type='hidden' class='IsActiveId_${response.data[i].F365Id}' value="${response.data[i].IsActive}"/>
                                                    <input type='hidden' class='OverallPercentageId_${response.data[i].F365Id}' value="${response.data[i].OverallPercentage}"/>
                                                    <input type='hidden' class='langId_${response.data[i].F365Id}' value="{{ Session::get('lang') }}"/>
                                                    <input type='hidden' id='hidf365name0' value='User'/>
                                                    <input type='hidden' id='hidf365id0' value='327216'/>
                                                    <input type='hidden' id='hidage0' value='23'/><input type='hidden' id='hidagegroupid0' value='3'/>
                                                    <input type='hidden' id='hidagegroupname0' value='label13'/>
                                                    <input type='hidden' id='hidgenderid0' value='1'/>
                                                    <input type='hidden' id='hidad0' value='1'/>
                                                    <input type='hidden' id='hiduid0' value='UI001'/>
                                                    <div class='clearfix'></div>
                                                </div>
                                            </div>`
                            }
                                $('.ajaxreloadalldata').html(html);

                    return false;
                }

        });

        // alert(987654);
    })
    </script>
@endsection


