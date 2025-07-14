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
            position: relative;

        }

        .slogan {
            font-size: 22px;
            margin-top: 18px;

        }

        .name {
            font-size: 36px !important;
                top: 375px;
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
    </style>
</head>

<body>
    <div class="page">
        <!--  <img src="{{ asset('wp-content/uploads/doc/Orange-certificate.jpg') }}" width="1100" height="815"> -->
        <!-- <img src="{{ asset('resources/imgs/certificate/Orange-certificate.jpg') }}" width="1920" height="1164"> -->
     <img src="{{ asset('resources/imgs/certificate/school_organizer_certificate.png') }}" width="1124" height="795">
    </div>
    <div class="certificate-content">
        <!--  <p class="blue">OF RECOGNITION</p>
  <p class="congratulations">Congratulations to</p>
 -->
        <h1 class="blue name"><?php print_r(strtoupper($organiser_name)); ?></h1>
    </div>
</body>



</html>