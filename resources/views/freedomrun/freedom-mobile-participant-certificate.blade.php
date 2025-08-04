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
  {{-- <div style="position:relative;margin:-28px; "><img src="{{ asset('resources/imgs/certificate/certificate_organisers.jpg') }}" alt="" style="width:100%;margin:0px auto;height:758px;"></div>
  <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:24px;font-weight:bold;position:relative;top:74%;width:100%;text-align:center;">{{$name}}</div> --}}
  <div style="position:relative;margin:-28px; ">
    {{-- <img src="{{ asset('resources/imgs/certificate/freedomrun22-part.jpeg') }}"  alt="" style="width:100%;margin:0px auto; position:relative;z-index: -100; "> --}}
    {{-- <img src="{{ asset('resources/imgs/certificate/certificate_participants.jpg') }}"  alt="" style="width:100%;margin:0px auto; position:relative;z-index: -100; "> --}}
    <img src="{{ asset('resources/imgs/certificate/cyclothon/participant.png') }}"  alt="" style="width:100%;margin:0px auto; position:relative;z-index: -100; ">
    {{-- <div> --}}
      {{-- <img src="{{ $map_image}}"  alt="" style="right:2%;top:5%;width:10%;hight:15%;margin:0px auto; position:absolute;z-index: 100000;"> --}}
      <div class="centered" style="font-family:Helvetica Nune,Helvetica; font-size:24px; font-weight:bold; position:absolute; margin-top:-395px;width:100%; text-align:center; color:blue; z-index: 10000000000000;">
        {{$participant_name}}
    {{-- </div> --}}
    </div>
  </div>
</body>
</html>

