<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

 
  @if($cat_id == 1622)
  <style>
     .container {
      position: relative;
      width: 100%;
      max-width: 1000px; /* adjust to your certificate width */
      margin: 0 auto;
    } 
    .centered1 {
      position: absolute;
      top: -5.5%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 80%;
      text-align: center;
      font-family: 'Great Vibes', cursive;
      font-size: 28px;
      color: #cb9128;
      word-wrap: break-word;
    }
    </style>
      @elseif($cat_id == 1623)
       <style>
     .container {
      position: relative;
      width: 100%;
      max-width: 1000px; /* adjust to your certificate width */
      margin: 0 auto;
    } 
    .centered1 {
      position: absolute;
      top: -6.3%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 80%;
      text-align: center;
      font-family: 'Great Vibes', cursive;
      font-size: 28px;
      color: #cb9128;
      word-wrap: break-word;
    }
  </style>
      @endif
    
</head>

<body>
  <div class="container">
    <div style="float:left;">
      @if($cat_id == 1622)
      <img src="{{ asset('wp-content/uploads/2025/certificates/Certificate3start.png') }}" alt="" style="width:100%; margin:0 auto;">
      @elseif($cat_id == 1623)
      <img src="{{ asset('wp-content/uploads/2025/certificates/Certificate5start.png') }}" alt="" style="width:100%; margin:0 auto;">
      @endif


    </div>
    <div class="centered1">{{$name}} </div>
  </div>
</body>

</html>