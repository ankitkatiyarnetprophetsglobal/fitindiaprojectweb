
@extends('static.layouts.appnet')
@section('title', 'Fitness | KheloIndia')
@section('content') 

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127986665-1"></script>



    <link href="{{('resources/css/khelo-india.css')}}" rel="stylesheet" />

    <link href="{{('resources/css/bootstrap-toggle.min.css')}}" rel="stylesheet" />
   
    <script src="{{url('resources/Scripts/jquery.min.js')}}"></script>
    <script src="{{url('resources/Scripts/bootstrap.min.js')}}"></script>

    {{-- <div class="inner-page-header">
        <div class="container back-btn-set">
            <button class="header-back-btn" runat="server" onserverclick="GoBack_ServerClick">
                <img src="{{url('resources/dotnetimages/switch-user.png')}}" /></button>
            <h4 id="lblHeading" runat="server">{{__('testmaster.label12')}}</h4>
        </div>
    </div> --}}

    <div class="fxd-mdl">
        <div class="fxd-modal-bx">
            <div class="modal-header inner-page-header fxd-head" style="margin-top: 0px;">
                <button type="button" class="backtomain" onclick="closePopup();" aria-label="Close">
                        <span aria-hidden="true">

                            <img src="{{url('resources/dotnetimages/back-arrow.svg')}}" alt="back" class="back-arrow" /></span>
                    </button>
                <h4 class="modal-title " id="testHeading"></h4>
            </div>
        </div>
        <div class="fitness-app-main-col take-test-popup" style="margin-top: 0px;">
            <div class="take-test-margin-auto">
                <div class="col-md-12">
                    <div class="row">
                        <div class="app-banner-slider">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active" id="lblVideoSource">
                                    </div>
                                    <div id="vdoNotPresent" class="notFound">
                                        <img src="{{url('resources/dotnetimages/notfoundvideo.jpg')}}" alt="notfoundvideo" />
                                        <br />
                                        <label id="lblvideonotavab"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
    <script type="text/javascript">
        var script = document.createElement('script');
      
        var lang = "{{ Session::get('lang')}}";
        if (lang=="en") {
            script.src = "{{ asset('public/js_data/en/testinstruction.js') }}"
        }else{
            script.src = "{{ asset('public/js_data/hi/testinstruction.js') }}"
        }

        document.head.appendChild(script);
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#navbar1').css('display', 'none');
            $('#landingdescription').css('display', 'none');
            $('#vdoNotPresent').hide();
            SuggestionVideoPopUp();
        });

        function SuggestionVideoPopUp() {
            var userTesttypeId="{{$Testtypeid}}";
            var userageGroupId="{{$AgeGroupId}}";
            $.ajax({
                type: "POST",
                url: "{{url('SuggestionVideos/GetSuggestionVideoPopup')}}",
                data: {
                    TestTypeId:userTesttypeId,
                    AgeGroupId:userageGroupId,
                    _token: $('meta[name="csrf-token"]').attr('content')},
               
              
                success: function (data) {
                    if (data != null && data.length > 0) {
                        //$('#lblScoringContent').html(data.d[0].TestScoringContent);
                        //$('#lblEquipmentContent').html(data.d[0].TestEquipmentContent);
                        //$('#lblMeasureContent').html(data.d[0].TestMeasureContent);
                        //$('#lblPerformContent').html(data.d[0].TestPerformContent);
                        // data.TestSuggestionVideoSourceLst.length

                        if (data.length > 0) {
                            // var row ="{{ __('testinstruction.label78') }}";
                            // for (var i = 0; i < data.d[0].TestSuggestionVideoSourceLst.length; i++) {
                             //     row += data.d[0].TestSuggestionVideoSourceLst[i];
                            // }
                            // // 'label78' :'<iframe width="560" height="315" src="https ://www.youtube.com/embed/Nxfp2GNlPmU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                            // 'label33':'<iframe width="560" height="315" src="https://www.youtube.com/embed/-zqXnSMvxRI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
    
                            document.getElementById('lblVideoSource').innerHTML=label_data[data[0].VideoSource];
    
                        }
                        else {
                            $('#lblvideonotavab').html("Video is not available");
                            $('#vdoNotPresent').show();
                        }

                         $('#lblHeading').html(data[0].TestHeading);
                         $('#testHeading').html(data[0].TestHeading);
                         $('#myModal').modal('show');
                    }
                    else {
                        $('#lblvideonotavab').html("Video is not available");
                        $('#vdoNotPresent').show();
                        $('#myModal').modal('show');
                    }
                },
                failure: function (data) {
                    console.log(data.error);
                }
            });
        }
        

        var date="{{Session::get('date')}}";
        var Age ="{{Session::get('Age')}}";
        var AgeGroupId = "{{Session::get('AgeGroupId')}}";
        var AgeGroupName ="{{Session::get('AgeGroupName')}}";
        var F365Id="{{Session::get('F365Id')}}";
        var Name="{{Session::get('hidname')}}";
        var GenderId="{{Session::get('GenderId')}}";
            // '/memberdashboard/{Name?}/{F365Id?}/{Age?}/{AgeGroupId?}/{AgeGroupName?}/{GenderId?}',


            


            function closePopup() {
                if(date){
                window.location=href="{{ url('datewisedate') }}";
                }else{
                    window.location=href=`{{ url('memberdashboard/${Name}/${F365Id}/${Age}/${AgeGroupId}/${AgeGroupName}/${GenderId}')}}`;
                }
            }
        
    </script>

@endsection
