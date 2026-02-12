<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Notification</title>
</head>
<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'poppins';
    }
    .video-section{
        width: 90%;
        padding: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 30px;
        margin-top: 30px;
    }
    .video-section .section{
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .video-section .section .video , .video-section .section .text{
        width: 40%;
    }
        @media screen and (max-width:991px) {
            .video-section .section .video , .video-section .section .text{
        width: 90%;
    }
    }
    .video-section .section .text h5{
        font-size: 24px;
        font-weight: 400;
        color: #434354;
    }
    .text-tiles{
        width: 90%;
        padding: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .text-tiles .heading{
        margin-bottom: 30px;
    }
    .text-tiles .heading h2{
        font-size: 22px;
        color: #434354;
        font-weight: 700;
        text-align: center;
        margin-bottom: 5px;
    }
    .text-tiles .heading h6{
        font-size: 18px;
        color: #434354;
        font-weight: 400;
        text-align: center;
    }
    .text-tiles .tiles{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .text-tiles .tile{
        margin-bottom: 12px;
        width: 40%;
    }
    @media screen and (max-width:991px) {
           .text-tiles .tile{
        margin-bottom: 12px;
        width: 90%;
    }
    }
    .text-tiles .tiles .tile h3{
        font-size: 22px;
        color: #434354;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .text-tiles .tiles .tile h4{
        font-size: 16px;
        color: #434354;
        font-weight: 400;
        margin-bottom: 5px;
    }
    .desktop-img{
        width: 100%;
    }
    .mobile-img{
        width: 100%;
        display: none;
    }
    @media screen and (max-width:991px) {
       .desktop-img{
        display: none;
       }
       .mobile-img{
        display: block;
       }
    }
</style>
<body>
    {{-- <img src="Banner.png" class="desktop-img" alt="">
    <img src="Step.png" class="desktop-img" alt="">
    <img src="Banner-mob.png" class="mobile-img" alt="">
    <img src="Step-mob.png" class="mobile-img" alt=""> --}}
    <img src="{{asset('resources/imgs/automaticcyclingtracking/Banner.png') }}" class="desktop-img" alt="">
    <img src="{{asset('resources/imgs/automaticcyclingtracking/Step.png') }}" class="desktop-img" alt="">
    <img src="{{asset('resources/imgs/automaticcyclingtracking/Banner-mob.png') }}" class="mobile-img" alt="">
    <img src="{{asset('resources/imgs/automaticcyclingtracking/Step-mob.png') }}" class="mobile-img" alt="">
    <div class="video-section">
        <div class="section">
            <div class="video">

            </div>
            <div class="text">
                <h5>Watch how the new Automatic Cycling Detection feature makes your ride tracking effortless. Just enable it once — and every future ride will be tracked automatically!</h5>
            </div>
        </div>
    </div>
   <div class="text-tiles">
    <div class="heading">
        <h2>🌿The Carbon Credit Model</h2>
        <h6>Every kilometer you move counts toward a cleaner planet</h6>
    </div>
    <div class="tiles">
        <div class="tile">
            <h3>🚴It starts simple:</h3>
            <h4>Each ride you take adds up — Distance × Emission Factor = Your Carbon Credit.</h4>
        </div>
        <div class="tile">
            <h3>🌍 Did you know?</h3>
            <h4>Driving 1 km emits 0.2 kg of CO₂, but cycling that distance saves it — 10,000 km equals 2 tons of CO₂ saved, the same as planting 90+ trees! 🌱</h4>
        </div>
        <div class="tile">
            <h3>⚙️ Smart Tracking makes it easy.</h3>
            <h4>Your device auto-detects your rides, tracks distance, calories, and carbon savings, and keeps running even in the background. Get instant feedback — every ride, every win.</h4>
        </div>
        <div class="tile">
            <h3>🎯 Turn movement into motivation.</h3>
            <h4>Earn Fit India Coins by cycling, walking, running, or yoga. Log your meals, join challenges, and stay consistent.</h4>
        </div>
        <div class="tile">
            <h3>🎁 Your effort gets rewarded!</h3>
            <h4>Unlock digital perks like fitness vouchers and app access, or claim real rewards — gear, merchandise, and healthy goodies.</h4>
        </div>
    </div>
   </div>
</body>
</html>
