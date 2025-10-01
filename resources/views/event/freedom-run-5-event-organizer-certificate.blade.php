<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.centered {
  position: absolute;
  top: 47%;
  left: 50%;
  transform: translate(-50%, -50%);
   margin: :0px auto;
   padding: :0px auto;
   text-transform: uppercase;
}

</style>
</head>
  <body style="padding:0;margin:0;">
      <div style="position:relative;margin:-35px;">
        {{-- <img src="{{ asset('resources/imgs/certificate/freedom-run-5/freedom-run-5-organizer.jpeg') }}" alt="" style="width:100%;margin:0px auto;height:768px;">         --}}
        <img src="{{ asset($organizer_certificate) }}" alt="" style="width:100%;margin:0px auto;height:768px;">
    </div>

        {{-- <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:24px;font-weight:bold;position:absolute;top:45%;width:75%;text-align:center;">{{$name}}</div> --}}
        <div class="centered" style="{{ $organizer_style_name  ?? '' }}">{{ $name ?? '' }}</div>
    @if($categories_event_id == 13078)
        <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:12px;font-weight:bold;position:absolute;top:69.2%;width:70.5%;">{{$serialno_with_id ?? ''}}</div>
        <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49.2%;width:52%;text-align:right;">{{$eventstartdate ?? ''}} </div>
        {{-- <div class="" style="font-family:Helvetica Nune,Helvetica;font-size:14px;font-weight:bold;position:absolute;top: 48%;width:50%; left:82% !important;">{{$eventenddate ?? '' }}) </div> --}}
        <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49%;width:80%;">{{$districts ?? '--' }},{{ $state ?? '--' }} </div>
    @endif
    @if($categories_event_id == 13084)
        <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:12px;font-weight:bold;position:absolute;top: 2.5%;width:0%; right:-24%;">{{$serialno_with_id ?? ""}}</div>
        {{-- <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49.2%;width:52%;text-align:right;">{{$eventstartdate ?? ''}} </div> --}}
        {{-- <div class="" style="font-family:Helvetica Nune,Helvetica;font-size:14px;font-weight:bold;position:absolute;top: 48%;width:50%; left:82% !important;">{{$eventenddate ?? '' }}) </div> --}}
        {{-- <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49%;width:80%;">{{$districts ?? '--' }},{{ $state ?? '--' }} </div> --}}
    @endif
  </body>
</html>

