
<html lang="en"><head>
    <meta charset="UTF-8">
    <title>Document</title>
   <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap");
        
        
        
        @font-face {
        font-family: 'Arizonia';
        src: url({{ asset('storage/fonts/Arizonia-Regular.woff2') }}) format('woff2'),
            url({{ asset('storage/fonts/Arizonia-Regular.woff') }}) format('woff');
			url({{ asset('storage/fonts/Arizonia-Regular.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap; 
        } 
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
		p { font-family: Roboto, sans-serif; margin: 0 0 10px 0 }
        .page {
            
            height: 860px;
            width: 1056px;
            background-repeat: no-repeat;
            background-size: cover;
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
        }
    .certificate-content{
      text-align: center;
      width: 100%;
      margin-top: 320px
    }
    
    .blue {
            color: #00A5FF !important;
            font-size: 40px !important;
            font-weight: 700 !important;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }
    

      .congratulations{
      color: #2F2F2F !important;
      font-size: 24px !important;
      
    }
    .slogan{
      font-size: 22px;
      margin-top:18px;
            
    }

        .name {
            font-size: 28px !important;
            
        }

     

    </style>
</head>
<body>
    <div class="page">
		<img src="{{ asset('resources/imgs/certificate/quiz_certificate/certificate.jpg') }}" width="1122" height="800">
    </div>
	<div class="certificate-content" style="font-family:'Montserrat'; text-align:center;  font-weight:700; font-size:40px; " >
		<p class="blue name" style="font-family:'Montserrat';   text-align:center;  font-weight:500; position:relative; top:-4%; left:25%; width:48%;">{{ strtoupper($name) }}</p> 
        {{-- {{ strtoupper($name) }} --}}
    </div>
</body>
</html>




