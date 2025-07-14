<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <title> FIT INDIA Healthy Mill-Eating Hindustan Contest</title>
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
    .accordion-title:before {
    float: right !important;
    font-family: FontAwesome;
    content:"\f068";
    padding-right: 5px;position: absolute;
    right: -10px;
    top: 50%;
    transform: translateY(-50%);
}
.card-link.accordion-title{position: relative;padding-right: 20px;}
.accordion-title.collapsed:before {
    float: right !important;
    content:"\f067";position: absolute;
    right: -10px;
    top: 50%;
    transform: translateY(-50%);
}
.card-link.accordion-title{display: block;color: inherit;
    font-weight: bold;}
	#accordion .card{margin-bottom: 10px;}
    </style>
	
</head>

<body>

    <main class="qz-bx mt-2 pt-4 pb-3">
        <div class="container">
            <div class="row">
		
                <div class="col-md-8 offset-md-2">
                <div class="quiz-lang text-right">
                     <span>
                  
                </div>
				   
				   
                    <div class="card">
                        @if(Session::has('message'))
                      <p class="alert alert-info">{{ Session::get('message') }}</p>
                       @endif
                        <!-- <figure class="mb-0"><img src="{{ asset('resources/imgs/school_quiz/new_pkl_dashboard.jpg') }}" class="main-poster img-fluid" alt="Tokyo Quiz" /> -->
                        <figure class="mb-0"><img src="{{ asset('resources/imgs/school_quiz/mobile_app_banner_miiltes.jpg') }}" class="main-poster img-fluid" alt="Tokyo Quiz" />
                        </figure>

                        <div class="card-body" style="text-align: justify">
                            {{-- <h1 class="mt-0 mt-sm-0 mt-lg-3 text-center" style="text-decoration: underline;">School Name - {{ $userdata->name }}</h1> --}}
                            <h1 class="mt-0 mt-sm-0 mt-lg-3"> Fit India Healthy Mill-Eating Hindustan Quiz Contest </h1>
                            <p>Fit India in partnership with Munch Fit is organizing a nationwide quiz contest from 25th January to 31st January 2023.</p>
                            <h3>The contest will have the following process:</h3>
                            <p style="margin-left: 20px;">

                                <strong>Online Quiz:</strong> To be a multiple-choice online quiz conducted in English -
                                
                                <ul style="list-style-type:circle;">
                                    <li>The Quiz will have one question on topics covering Millets & its associated benefits and Munch Fit</li>
                                    <li>Indian citizens can participate in the quiz.</li>
                                    <li>Two questions will appear daily on the Fit India Mobile App on two time slots (Question 1 will appear from 12 AM to 12 PM and Question 2 will appear from 12 PM to 12 AM).</li>
                                    <li>Only one attempt per question is allowed.</li>
                                    <li>In case of tie, the fastest completed score will be considered. In case of further tie, a draw of lots will be employed.</li>
                                    <li>One lucky winner per question will be announced.</li>
                                    <li>One lucky winner per question will be announced who will receive gift hamper.</li>
                                </ul>
                            </p>
                            <!-- <div class="card">
                                <div class="card-header">
                                  <a class="card-link accordion-title" data-toggle="collapse" href="#collapseOne">
                                      
                                  </a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                  <div class="card-body">
                                 
                                  </div>
                                </div>
                              </div> -->
                            <div id="accordion">

                                
                                <div class="card">
                                    <div class="card-header">
                                      <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseTwo">
                                        Terms & Conditions – Fit India Healthy Mill-Eating Hindustan Contest -
                                      </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                      <div class="card-body">
                                        <p style="margin-left: 20px;">
                                            <!-- <strong>Online Quiz:</strong> To be a multiple-choice online quiz conducted in English - -->
                                            
                                            <ul style="list-style-type:circle;">
                                                <li>The daily quiz contest is being organised by the Fit India Mission, Ministry of Youth Affairs & Sports (MYAS), Government of India in collaboration with Munch Fit. Access to the quiz contest will only be through the Fit India Mobile App.</li>
                                                <li>The following terms and conditions henceforth shall be governed by Indian laws and the judgements of the Indian judicial system.</li>
                                                <li>The contest is applicable to all Indian citizens.</li>
                                                <li>Entry to contest will be open from 25th January 2023 to 31st January 2023.</li>
                                                <li>Two questions will appear daily on the Fit India Mobile App on two time slots (Question 1 will appear from 12 AM to 12 PM and Question 2 will appear from 12 PM to 12 AM).</li>
                                                <li>Entries once submitted cannot be withdrawn.</li>
                                                <li>Questions contained will be based on publicly available information on Millets and their associated benefits and Munch Fit.</li>
                                                <li>Questions will be asked with multiple options and the user must select only one correct option.</li>
                                                <li>By submitting their details and participating in the contest, participants will give consent to the MYAS to use this information as required to facilitate the conduct of the contest, which may include confirmation of participant details, announcement of winners, and disbursement of awards etc.</li>
                                                <li>Multiple entries from the participant for same question will not be accepted and considered.</li>
                                                <li>In case of a tie i.e., multiple participants with same score, the lucky winner selection will be done in the following manner.
                                                    <ul  style="list-style-type:circle;">
                                                        <li>The fastest completed score will be considered.</li>
                                                        <li>Random selection by draw of lots, in case a lucky winner is still not determined.</li>
                                                    </ul>
                                                </li>
                                                <li>In the event of unforeseen circumstances, organisers reserve the right to amend the terms and conditions of the contest at any time or cancel the competition as considered fit.</li>
                                                <li>The organisers reserve the rights to disqualify participants, refuse entry, or discard entries, if such instances or participation are detrimental to the competition, or additionally, any entry will be considered void if the information submitted is illegible, incomplete, false, or erroneous.</li>
                                                <li>Organizers will not accept any responsibility for entries that are lost, late, incomplete or have not been transmitted due to internet or computer errors or any other error beyond the organizer’s reasonable control. Please note proof of submission of the entry is not proof of receipt of the same.</li>
                                                <li>The participants shall abide by all the terms and conditions of the contest, including any amendments or further updates.</li>
                                                <li>Organiser’s decision on the contest shall be final and binding and no correspondence will be entered regarding the same. By entering the contest, the participant accepts and agrees to be bound by the above-mentioned terms and conditions.</li>
                                            </ul>
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header">
                                      <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseThree">
                                        About Munch Fit:
                                      </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                      <div class="card-body">
                                        <p style="margin-left: 20px;">
                                            Munch Fit is a brand of tasty, healthy, crunchy and tasty Millet based extruded snacks. The product is made with predominantly Ragi, Jowar and Bajra as the primary ingredients (70% of the composition) and is not only Gluten free but also Diabetic friendly. It is a preservative free and nutritious snack with no trans fats, no artificial flavors, no added MSG and is suitable for all age groups. Munch Fit products are unique as they are amongst the very few brands doing 
                                            roasted extruded snacks in the Millets sector.
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            
                            <h3>Happy Quizzing!!</h3>


							<p class="mt-4 mb-0 pt-2">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-auto">
                                        <a class="btn btn-success mr-3" href="{{ url('iym-quiz-questions?Fit_id='.$encrypted.'&m=true') }}">{{__('sentence.start_quiz_button_text')}}
                                        </a>    
                                    </div></div> 
                                {{-- <a class="btn btn-primary" href="{{ route('roadtotokyowinner',$encrypted) }}">{{__('sentence.lucky_winnter_text')}}
                                </a> --}}
                            </p>

                        </div>


                    </div>
					
                </div>
				{{-- @else
				<div class="col-md-8 offset-md-2" style="text-align:center">
					You are not Authorised to access page.
				</div>
				
@endif --}}
            </div>



            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div id="main-footer" class="mt-5 pt3">
                        <div class="footer_Flex">
                            <p>© 2021 Sports Authority of India. All rights reserved </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</body>

</html>