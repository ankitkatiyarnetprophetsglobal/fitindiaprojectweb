@extends('layouts.app')
@section('title', 'Update Participants | Fit India')
@section('content')
<style>

    .bulkUpload-row{}
    .bulkUpload-row h4{font-size: 22px;
    letter-spacing: .29px;}
    .bulkUpload-row h6{color: #000000;}
    .bulkUpload-row .btn-orange{background-color: #C76E15;
    color: #fff;
    padding: 11px 20px;
    border-radius: 0;
    font-size: 15px;
    font-weight: normal;}
    .bulkUpload-row{}
     .custonFileUpload{
    position: relative;
    margin-right: 10px;cursor: pointer;
}
.custonFileUpload .uploadLevel{
    background: #0F6CAB;
    color: #fff;
    padding: 11px 25px;
    font-size: 15px;
    cursor: pointer;
}
    .custonFileUpload .inputfileUpload{
    position: absolute;
    top: 0;
    opacity: 0;
    width: 192px;
    right: 0;
    cursor: pointer;
}
    .btn-blue{
    background: #0F6CAB;
    border-radius: 0;
    color: #fff;
    padding-left: 25px;
    padding-right: 25px;
}
.btn-blue:hover{color: #fff}
.bulkUpload-row .viewData{font-size: 16px;
    text-decoration: underline;
    color: #000000;}
</style>
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section>
    <div class="banner_area">
            <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
            @include('event.userheader')

            <div class="container">
                <div class="et_pb_row">
                    <div class="row ">
                        
                        @include('event.sidebar')
            
                        <div class="col-sm-12 col-md-9 school_update">
                           
                            
                       
                        <!-- <div class="col-sm-12 col-md-8 ">
                            <div class=""> -->
              
                <div class="container" id="{{ $active_section_id }}">
                    @if (session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if (Session::has('error_message'))
                                   <div class="alert alert-danger">
                                     <strong>Error!</strong> {{ Session::get('error_message') }}
                                   </div>
                                 @endif
                
                    <div class="row bulkUpload-row">
                        <div class="col-md-12">
                            <h4 class="mb-3">Suggest Outstanding Sport Talent</h4>
                            <hr/>
                            <h6 class="mb-4">Bulk Upload</strong></h6>
                            <a href="{{url('public/excel/Sample.xlsx')}}" class="btn btn-orange">Download Sample Excel</a>
                            <hr class="mt-lg-4"/>
                                    {{-- @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif --}}
                    {{-- <form action="{{ route('updateBulkUploadExcel') }}" method="POST" enctype="multipart/form-data"> --}}
                    <form action="{{ route('eventupdateBulkUploadExcel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
                    <input type="hidden" name="id" value="{{ $event->id }}">
                  
                        <div class="form-group">
                            {{-- <label for="userEmail"><b>Organization Name</b></label> --}}
                             <input type="hidden" class="form-control" name="name" value="{{$event->name}}" readonly > 
                            <!-- <input type="text" class="form-control" name="name" value="Freedomrun" readonly> -->
                        </div>
                       <!--  <h2><strong>Add Participants *</strong></h2> -->
                        <!-- <div class="form-group">
                            <label for="userEmail"><b>No of Participants*</b></label>
                            <input type="text" class="form-control" name="participantnum" value="{{$event->participantnum}}" readonly>
                            {!!$errors->first("participantnum", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        -->
                        <div class="form-group">

                            {{-- <div class="d-flex">
                                <div class="custonFileUpload">
                                    <label for="userEmail" class="uploadLevel">Upload Student Excel</label>
                                    <input type="file" class="form-control inputfileUpload" name="ex_file_sheet" accept =".xlsx">
                                    </div>
                                    <button type="submit" class="btn btn-blue">Submit</button>
                            </div> --}}
                            <div class="d-flex align-items-md-end align-items-start">
                                <div class="custonFileUpload">
                                    <label for="userEmail" style="font-size: 16px; color:black; font-weight:bold" class="">Upload Student Excel</label>
                                    <input type="file" class="form-control" name="ex_file_sheet" accept =".xlsx" required>
                                    </div>
                                    <button type="submit" class="btn btn-blue mt-md-0 mt-2" style="height:40px; border-radius:4px">Submit</button>
                            </div>
                             @error('ex_file_sheet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                             <!--  <div class="login-row"> 
                         <div class="um-field" id="capcha-page-cont">
                           <label for="captcha">Please Enter the Captcha Text</label><br>
                           <div style="float:left; width:115px;  margin: 6px 0;" id="pagecaptcha-cont">
                                <div class="captchaimg">
                                    <span>{!! captcha_img() !!}</span>
                                </div>
                            </div>
                           <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                             <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
                           </div>
                           
                           <div style="float:left; width:40%">
                               <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required  placeholder="Captcha">
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                           <div style="clear:both;"></div>
                       </div>
                     </div> -->
                     
                            </div>
                  
                    
                                    
                    {{-- <div class="center-on-small-only">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> --}}
                    <hr class="mt-lg-4"/>
                    @if(isset($event->excel_sheet))
                    <div>
                        <a href="{{url('storage/app/public/excel/'.$event->excel_sheet)}}" class="viewData">View Uploaded Data</a>
                    </div>
                    @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div></div></div></div>

</section>

<script>
    
jQuery('#reload').click(function () {
    jQuery.ajax({
    type: 'GET',
    url: "{{ route('reloadCaptcha')}}",
    success: function (data) {
		jQuery(".captchaimg span").html(data.captcha);
    }
    });
});
</script>

@endsection