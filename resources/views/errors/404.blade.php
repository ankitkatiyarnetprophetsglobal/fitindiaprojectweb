
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">
    <title>404 page</title>
    <link rel="icon" href="resources/images/fit-fav.ico" sizes="32x32">

<style>
* {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
body {
    padding: 0;
    margin: 0;
}
#notfound {
    position: relative;
    height: 100vh;
}
#notfound .notfound {
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
.notfound {
    /* max-width: 560px;
    width: 100%; */
    padding-left: 160px;
    line-height: 1.1;
}
.notfound .notfound-404 {
    position: absolute;
    left: 0;
    top: 0;
    display: inline-block;
    width: 140px;
    height: 140px;
    background-image: url(resources/imgs/fit-india_logo.png);
    background-size: contain;
    background-repeat: no-repeat;
}
.notfound .notfound-404:before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-transform: scale(2.4);
    -ms-transform: scale(2.4);
    transform: scale(2.4);
    border-radius: 50%;
    background-color: #f2f5f8;
    z-index: -1;
}

.notfound h1 {
    font-family: nunito, sans-serif;
    font-size: 21px;
    font-weight: 400;
    margin: 0;
    line-height:1.5;
    margin-top: 48px;
    color: #151723;
}
.notfound a{text-align:center;}
.notfound p {
    font-family: nunito, sans-serif;
    color: #595959;
    font-weight: 400;
    line-height: 1.5;
    margin-top:5px;
}
.notfound a {
    font-family: nunito, sans-serif;
    display: block;
    font-weight: 700;
    border-radius: 40px;
    text-decoration: none;
    text-align: center;
    color: #388dbc;
    width: 40%;
    margin: 0 auto;
}
.gohome{background:#01537c;
border:1px solid #fff;
padding:15px 30px;
border-radius:100px;
text-align:center;
color:#fff!important;
font-weight:300!important;
}
@media only screen and (max-width: 767px) {
    .notfound .notfound-404 {
    width: 75px;
    height: 75px;
    margin: 0 auto;
}
    .notfound {
        padding-left: 30px;
        padding-right: 30px;
        padding-top: 110px;
    }

    #notfound .notfound {
  text-align:center;
    width: 100%;
    }
    .notfound .notfound-404:before {
    content: "";
    position: absolute;
    width: 60px;
    height: 60px;
    left: 7%;
    -webkit-transform: scale(2.4);
    -ms-transform: scale(2.4);
    transform: scale(2.4);
    border-radius: 50%;
    background-color: #f2f5f8;
    z-index: -1;

}
.notfound .notfound-404 {
    position: relative;
    /* left: 0; */
    /* top: 0; */
    display: block;
    text-align: center;
    width: 75px;
    height: 75px;
   
    background-size: contain;
    background-repeat: no-repeat;
}
.notfound h1 {
   
    margin-top: 50px;
}
#notfound .notfound {
 
    left: 50%;
    top: 35%;
    -webkit-transform: translate(-50%, -40%);
    -ms-transform: translate(-50%, -40%);
    transform: translate(-50%, -40%);
}

.notfound a {
   
    width: 70%;
}
}
</style>
</head>
<body>
<section style="background: #dbdbdb;">
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404"></div>
                <!-- <h1>404</h1> -->
                <h1>Currently Server is experiencing high traffic load</h1>
                <p>Request you to please wait for sometime and try again.</p>
                <a href="https://fitindia.gov.in/" class="gohome">GO HOME</a>
        </div>
    </div>   
</body>
</section>


