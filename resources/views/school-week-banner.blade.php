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
            width: 1100px;
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
            font-weight: 700;
        }

        .orange {
            color: #FF9C2A;
            font-size: 28px;
            font-weight: 700;
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
            font-size: 40px !important;
            top: 630px;
            position: absolute;
            left: 10%;
            right: 10%;
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
            font-weight: 700;
        }

        .success {
            font-size: 19px;
            color: #434343;
        }
    </style>
</head>

<body>
    <div class="page">
        <img src="{{ asset('resources/imgs/downloadofficiallogos/slider1.jpg') }}" width="1125" height="795">
    </div>
    <div class="certificate-content">

        <h1 class="blue name"><?=@$school_name?></h1>


    </div>
</body>

</html>