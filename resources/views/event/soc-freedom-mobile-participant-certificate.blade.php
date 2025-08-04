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
        <img src="{{ asset('resources/imgs/certificate/cyclothon/participant.png') }}" alt="" style="width:100%;margin:0px auto;height:768px;">
        <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:24px;font-weight:bold;position:absolute;top:36%;width:75%;text-align:center;">{{$participant_name ?? ''}}</div>        
        <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:12px;font-weight:bold;position:absolute;top:67.5%;width:66%;">{{$serialno_with_id ?? ''}}</div>
        <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49.2%;width:52%;text-align:right;">{{$user_date ?? ''}} </div>
        <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:18px;font-weight:bold;position:absolute;top: 49%;width:75%;">{{$usermeta_datadistrict ?? '' }},{{ $usermeta_data_state ?? '' }} </div>
        
    </div>       
  </body>
</html>

