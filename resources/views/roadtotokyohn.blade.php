<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <title>रोड टू टोक्यो प्रश्नोत्तरी</title>
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        line-height: 1.5em
    }

    .main-poster {
        width: 100%;
    }

    h1,
    h2,
    h3 {
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
    }

    h2 {
        font-size: 18px;
    }

    h3 {
        font-size: 16px;
    }

    p {
        font-size: 14px;
        line-height: 1.5em;
    }

    figure {
        margin-bottom: 30px;
    }

    ul {
        list-style: lower-roman;
        line-height: 2em;
    }

    ul ul {
        list-style: square;
    }

    .card {
        box-shadow: 0 5px 15px rgb(0 0 0 / 15%);
        border-radius: 0.5rem;
        overflow: hidden;
    }

    #main-footer {
        text-align: center;
        color: #999;
    }

    #main-footer p {
        font-size: 12px;
    }
	
	.quiz-lang {
		margin-top: 15px;
    margin-bottom: 15px;
    color:#333;
	}
    .quiz-lang a {
	    color:#333;
        margin:0 5px;
	}
    .quiz-lang .active {
		font-weight:600;
	}
	
    </style>
	
</head>

<body>
    <main class="qz-bx mt-2 pt-4 pb-3">
        <div class="container">
            <div class="row">
			
                <div class="col-md-8 offset-md-2">
                <div class="quiz-lang text-right"> <span><a href="{{ route('roadtotokyo',$encrypted) }}">English</a></span> | <span><a href="{{ route('roadtotokyohn',$encrypted) }}" class="active">हिंदी</a></span> </div>
                    <div class="card">
                        <figure class="mb-0"><img src="{{ $quizimgs->mainimage }}" class="main-poster img-fluid" alt="Tokyo Quiz" />
                        </figure>

                        <div class="card-body">

                            <h1 class="mt-0 mt-sm-0 mt-lg-3"> {{ $userdata->name }} - रोड टू टोक्यो 2020</h1>
                            <p>
                                1. <strong>टोक्यो ओलंपिक 2020 </strong> 23 जुलाई से 5 सितंबर, 2021 तक निर्धारित किया गया है और इन अभूतपूर्व समय में हमारे समर्थन को राष्ट्र की एक आवाज के रूप में दिखाने के लिए हमारे भारतीय एथलीटों को खुश करना महत्वपूर्ण है।</p>
                            <p>
                                2. इस संबंध में भारतीय खेल प्राधिकरण और भारतीय ओलंपिक संघ (आईओए) ने संयुक्त रूप से टोक्यो ओलंपिक 2020 में भारतीय एथलीटों की भागीदारी पर ध्यान देते हुए ओलंपिक के बारे में जागरूकता पैदा करने के लिए राष्ट्रव्यापी अभियान आयोजित करने का फैसला किया है। इस अभियान में ओलंपिक "रोड टू टोक्यो २०२०" पर प्रश्नोत्तरी शामिल है ।.
                            </p>

                            <h2>प्रश्नोत्तरी में निम्नलिखित प्रक्रिया होगी:</h2>
                            <p>
                                <strong>ऑनलाइन प्रश्नोत्तरी</strong>अंग्रेजी और हिंदी में आयोजित एक बहुविकल्पीय ऑनलाइन दौर होगा
<!--								23 जून 2021 से  22 जुलाई 2021 (एक महीना) -->
                            <ul>
                                <li>प्रश्नोत्तरी में कई विषयों से 10 प्रश्न (120 सेकंड) होंगे - इतिहास  ओलंपिक  खेल-कूद  और विषयों, एथलीटों की पिछली उपलब्धियां, विश्व रिकॉर्ड, वर्तमान और अतीत भारतीय एथलीटों।</li>
                                <li>प्रति व्यक्ति केवल एक प्रयास की अनुमति है</li>
                                <li>स्कोर में टाई के मामले में, सबसे तेजी से पूरा स्कोर माना जाएगा</li>
                                <li>हर रोज भाग्यशाली विजेताओं को भारतीय टीम/फैन जर्सी से सम्मानित किया जाएगा ।</li> 
                            </ul>

                            </p>
							
							<!--
                            <p>
                                Fit India Mission under Ministry of Youth Affairs and Sports, Government of India shall
                                coordinate
                                with the concerned Partner Organisations in providing guidelines of the “Road to Tokyo
                                2020”
                                Quiz.
                            </p>
                            <p class="pt-3">
                                <strong>Fit India Mission will provide with the following information by 15 June
                                    2021:</strong>
                            <ul>
                                <li>Design of the Banner to be placed on the Partner organisation’s website
                                    <ul>
                                        <li>Clicking on the Banner will open the Customised Quiz Platform</li>
                                    </ul>
                                </li>

                                <li>Customised Quiz Platform for Partner (link to be provided)
                                    <ul>
                                        <li>Participants will fill in their details</li>
                                        <li>Take the Quiz anytime between 05 AM, 23 June 2021 and 11 PM, 22 July 2021
                                        </li>
                                    </ul>

                                </li>
                            </ul>
                            </p>

                            <h2 class="mt-4">Role of the Partner Organisations</h2>
                            <p>
                                Partner Organisations to ensure wide publicity to <strong>“Road to Tokyo 2020”</strong>
                                Quiz
                                and encourage
                                relevant
                                groups, staff and families to register and participate. They will be responsible for
                                registering
                                participants for the quiz on the Customised Quiz Platform created by Fit India for the
                                Partner.
                            </p>
                            
							
							-->
							<p>
                               
							   हैप्पी क्विज़िंग !!
                            </p>
							
							
							<p class="mt-4 mb-0 pt-2">
                                <a class="btn btn-success mr-3" href="{{ route('quizformhn',$encrypted) }}">रोड टू टोक्यो प्रश्नोत्तरी
                                </a>
                                <a class="btn btn-primary" href="{{ route('roadtotokyowinner',$encrypted) }}">भाग्यशाली विजेता
                                </a>
                            </p>
							
							

                        </div>


                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div id="main-footer" class="mt-5 pt3">
                        <div class="footer_Flex">
                            <p>© 2021 भारतीय खेल प्राधिकरण। सभी अधिकार आरक्षित </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


 
</body>

</html>