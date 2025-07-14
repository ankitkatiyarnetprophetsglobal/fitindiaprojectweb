<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap");

    body {

      font-family: Roboto, sans-serif;
      padding: 0;

      height: 793px;
      width: 1124px;
      position: relative;
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


      background-repeat: no-repeat;
      background-size: contain;
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
      top: 290px;
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

      top: 340px;
    }
  </style>
</head>

<body>
  <div class="page">
    <img src="{{ asset('resources/imgs/certificate/cyclothon-organizer.png') }}" width="100%" height="793">

    <div class="certificate-content">
      <h1 class="name name1"> {{ $organiser_name }} </h1>
    </div>
  </div>
</body>

</html>