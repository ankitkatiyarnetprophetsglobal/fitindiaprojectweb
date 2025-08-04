<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap");

    body {
      margin: 0;
      font-family: Roboto, sans-serif;
    }

    @page {
      margin: 0;
    }

    @media print {
      @page {
        size: letter landscape;
        margin: 0;
      }
    }

    p {
      font-family: Roboto, sans-serif;
      margin: 0 0 10px 0
    }

    .page {

      height: 860px;
      width: 1070px;
      background-repeat: no-repeat;
      background-size: cover;
      position: absolute;
      left: 0;
      top: 0;
      z-index: -1;
    }

    .certificate-content {
      text-align: center;
      width: 100%;
      margin-top: 320px
    }

    .blue {
      color: #00A5FF;
      font-size: 28px;
      font-weight: 400;
    }

    .orange {
      color: #FF9C2A;
      font-size: 28px;
      font-weight: 400;
    }

    .congratulations {
      color: #2F2F2F !important;
      font-size: 24px !important;

    }

    .slogan {
      font-size: 20px;
      margin-top: 18px;

    }

    .name {
      font-size: 36px !important;
      top: 265px;
      position: absolute;
      left: 2%;
      right: 2%;
      font-family: Arial, Helvetica, sans-serif;
      color: #000;
      font-weight: 400;
      color: #292775;
    }

    .success {
      font-size: 19px;
      color: #434343;
    }

    .name1 {

      top: 427px;
    }
  </style>
</head>

<body>
  <div class="page">
    <!--   <img src="{{ asset('wp-content/uploads/doc/Blue-certificate.jpg') }}" width="1100" height="815"> -->
   <img src="{{ asset('resources/imgs/certificate/school_participant_certificate.png') }}" width="1124" height="798">
  </div>
  <div class="certificate-content">
    <!--  <p class="blue">OF RECOGNITION</p>
  <p class="congratulations">Congratulations to</p>-->

    <p class="blue name"><?php print_r(strtoupper($participant)); ?></p>
    <!--<p class="success">for Successfully participating in <br>{{ $cat }}  Organised By <br></p> -->
    <h1 class="name name1"> {{ $organiser_name }} </h1>
    <!-- <p class="slogan"> FIT INDIA DECEMBER CAMPAIGN 2020 - 21 | <?php print_r($startdate); ?>  - <?php print_r($enddate); ?> </p>  -->
  </div>
</body>

</html>