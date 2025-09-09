<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.centered {
  position: absolute;
  top: 95%;
  left: 50%;
  transform: translate(-50%, -50%);
   margin: :0px auto;
   padding: :0px auto;
   text-transform: uppercase;
}

</style>
</head>

<body style="padding:0;margin:0;">
  <div style="position:relative;margin:-28px; ">
    <img src="{{ asset($participant_certificate) }}"  alt="" style="width:100%;margin:0px auto;height:758px;">
  </div>

  {{-- <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:24px;font-weight:bold;position:absolute;top: 37%;width:68%;text-align:center;">{{$participant_name}} </div> --}}
  <div class="centered" style="{{ $participant_certificate_name_css ?? '' }}">{{$participant_name ?? '' }} </div>
  {{-- <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:24px;font-weight:bold;position:absolute;top: 26%;width:68%;text-align:center;">{{$organiser_name}} </div> --}}
  <div class="centered" style="{{ $participant_organizer_name_css ?? '' }}">({{$organiser_name ?? '' }}) </div>
  {{-- @if(Auth::user()->rolewise == 'cyclothon-2024') --}}
  @if($categories_event_id == 13078)
    <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:12px;font-weight:bold;position:absolute;top: 69.2%;width:70%;">{{$serialno_with_id ?? ""}}</div>
    <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49.2%;width:52%;text-align:right;">{{$eventstartdate ?? ''}} </div>
    {{-- <div class="" style="font-family:Helvetica Nune,Helvetica;font-size:14px;font-weight:bold;position:absolute;top: 48%;width:50%; left:82% !important;">{{$eventenddate ?? '' }}) </div> --}}
    <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49%;width:80%;">{{$districts ?? '--' }},{{ $state ?? '--' }} </div>
  @endif
  @if($categories_event_id == 13083)
    <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:12px;font-weight:bold;position:absolute;top: 86.3%;width:70%;">{{$serialno_with_id ?? ""}}</div>
    {{-- <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49.2%;width:52%;text-align:right;">{{$eventstartdate ?? ''}} </div> --}}
    {{-- <div class="" style="font-family:Helvetica Nune,Helvetica;font-size:14px;font-weight:bold;position:absolute;top: 48%;width:50%; left:82% !important;">{{$eventenddate ?? '' }}) </div> --}}
    <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 90.3%;width:80%; left:53% !important;">{{ date('d-m-Y') ?? '--' }}</div>
  @endif
  {{-- @endif --}}
  {{-- {{ dd() }} --}}

</body>
</html>

