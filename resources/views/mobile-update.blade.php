<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">
    <title>Mobile Update</title>
    <link rel="icon" href="resources/images/fit-fav.ico" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://103.65.20.170/fitind/resources/css/bootstrap.min.css" media="screen">

<style>
* {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
body {
    padding: 0;
    margin: 0;
    font-family: 'Roboto', sans-serif;
}
.mobile_app_base {
    background: #fcffcc;
    padding-top: 30px;
}
.mini_area {
    display: flex;
    align-items: center;
}

.fluid-img {
    max-width: 100%;
    height: auto;
}
.mobile_area_div {
    padding: 0 10%;
    width: 60%;
}
.mobile_area_div_cust {
    margin-bottom: 15px;
    height: 100px;
}
.app_btn {
    padding-bottom: 30px;
}
.app_btn a {
    margin: 0 7px;
}
.mini_area {
    display: flex;
    align-items: center;
}
.rp{padding:0;}
.mini_area_left{width:35%;}
@media (max-width: 767px) { 
    .mini_area_left{display:none;}
    .flex_direc{  flex-direction: column-reverse;}
    /* .mini_area{display:none;} */
    .mobile_area_div{width:100%;}
    .app_btn img { height: 40px;}
    .mobile_area_div_cust {
    margin-bottom: 15px;
    height: 80px;
}
.mini_area_left {
    width: 80%;
}
.mini_respo img{padding: 2% 2% 0 2%;}
/* .mini_area img{
    width: 80%;
    margin-bottom: 44px;
} */


.mobile_app_base {
   
    height: 100vh;
    display: flex;
    align-items: center;
}
 }
 @media (max-width: 320px) { 
        .mobile_area_div {
            padding: 0 5%;
            
        }
        
 }

</style>
</head>
    <body>
    <section class="section_r_p">
        <div class="container-fluid">      
<!-- this section commented -->
            <div class="row mobile_app_base ">
               <div class="col-sm-12 col-md-12 d-flex justify-content-between align-items-end rp flex_direc">
                    <div class="mini_area mini_respo">
                        <img src="http://103.65.20.170/fitind/resources/imgs/home/mobile_and_app.png" class="fluid-img ">
                    </div>                    
                    <div class="mobile_area_div text-center">
                        <img src="http://103.65.20.170/fitind/resources/imgs/home/mobileapplogo.png" class="mobile_area_div_cust " alt="Apple" title="Apple Button">
                        <div>
                            <p style="font-size:16px;">Check your Fitness Level Score, Track your Steps.Track your Sleep, Track your calorie intake,Be Part of Fit India Events, Get customized DietPlans Age-wise fitness level<!--Check your Fitness Level Score, Track your Steps.Track your Sleep, Track your calorie intake,Be Part of Fit India Events, Get customized DietPlans Age-wise fitness level--></p>
                            <div class="app_btn">
                                <a href="https://apps.apple.com/us/app/fit-india-mobile-app/id1581063890"><img src="http://103.65.20.170/fitind/resources/imgs/home/apple.png" alt="Apple" title="Apple Button"></a>
                                <a href="https://play.google.com/store/apps/details?id=com.sai.fitIndia"><img  src="http://103.65.20.170/fitind/resources/imgs/home/google.png" alt="Google" title="Google Button"></a>
                            </div>
                        <div>                            
                    </div>  
                  </div>
                 </div>
                <div class="mini_area mini_area_left" >
                  <img src="resources/imgs/home/mobile.png" class="fluid-img">
                </div>
              <div>
            </div>
            <!-- close this section commented-->
          </div>
         </div>
        </div>
    </section>
    </body>
</html>

