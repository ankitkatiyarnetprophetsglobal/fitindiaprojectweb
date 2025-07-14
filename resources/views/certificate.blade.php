<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Lobster&family=Satisfy&display=swap" rel="stylesheet"> -->

<style>
  /*@import url('https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap');

  @font-face {
    font-family:Great Vibes;
    src: url('resources/css/GreatVibes-Regular.ttf');
}*/
.container {
  position: relative;
  text-align: center;
  color: black;
  width: 100%;
  margin: :0px auto;
  padding: :0px auto;
}

.centered1 {
  position: absolute;
  top: 43.5%;
   width: 800px;
  left: 45%;
  text-align: center;
  transform: translate(-45%, -50%);
   margin: :0px auto;
   padding: :0px auto; 
   text-transform: capitalize;  
font-family: 'Great Vibes'!important;
font-size: 28px;
 color: #cb9128;
}
.dated{
   position: absolute;

  top: 4.7%;
  left: 50%;
  transform: translate(-50%, -50%);
   margin: :0px auto;
   padding: :0px auto;
   text-transform: capitalize;

}
.centered {
  position: absolute;

  top: 47%;
  left: 50%;
  transform: translate(-50%, -50%);
   margin: :0px auto;
   padding: :0px auto;
   text-transform: capitalize;
}
.centered2 {
font-family: 'Great Vibes'!important;

  position: absolute;
  top: 63%;
  left: 50%;
  transform: translate(-50%, -50%);
   margin: :0px auto;
   padding: :0px auto;
   font-size: 28px;
   color: #cb9128;
   text-transform: capitalize;
}
</style>
</head>
<body>
<div class="container">
  <div style="float:left;">
   <!--  <img src="{{ asset('wp-content/uploads/doc/flag.png') }}" alt="" style="width:100%;margin:0px auto;"> -->
    <img src="{{ asset('resources/imgs/certificate/school_flag_certificate.jpg') }}" alt="" style="width:100%;margin:0px auto;">
  </div>
  <div class="dated"></div>
  <div class="centered">{{$cities}}</div>
  <div class="centered1">{{$name}}</div>
  <div class="centered2">{{$name}}</div>  
</div>
</body>
</html> 

