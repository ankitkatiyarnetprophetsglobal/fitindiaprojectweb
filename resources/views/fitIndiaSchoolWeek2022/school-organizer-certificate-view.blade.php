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
      <div style="position:relative;margin:-35px;"><img src="https://fitindia.gov.in/resources/imgs/certificate/school_week_2022/participant.jpg" alt="" style="width:100%;margin:0px auto;height:758px;"></div>
      <div class="centered" style="font-family:Helvetica Nune,Helvetica;font-size:24px;font-weight:bold;position:absolute;top:48%;width:75%;text-align:center;">{{ request('name') ?? ''}}</div>
  </body>
</html> 

