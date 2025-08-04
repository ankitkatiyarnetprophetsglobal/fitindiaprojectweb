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

    <title>vivo PKL Fit India School Week 2022 Quiz</title>
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

   {{-- <div class="top_header">
    <div class="container-fluid">
        <div class="row ">
           <div class="col-12">
          <div class="d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown button
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
          </div>
           </div>
    </div>
   </div> --}}
    
<!--      <a class="dropdown-item" href="http://103.65.20.170/fitind/lang/en">English</a>
                          <a class="dropdown-item" href="http://103.65.20.170/fitind/lang/hn">Hindi</a>
                          <a class="dropdown-item" href="http://103.65.20.170/fitind/lang/ml">Malyalam</a>
                          <a class="dropdown-item" href="http://103.65.20.170/fitind/lang/kn">Kannada</a>
                            <a class="dropdown-item" href="http://103.65.20.170/fitind/lang/bg">Bengali</a>
                               <a class="dropdown-item" href="http://103.65.20.170/fitind/lang/tl">Telugu</a> -->
                              {{-- <div style="background-color: blue; color:#ffffff; padding:10px; ">
                                <a class="" style="display:flex; justify-content:end; color:#ffffff;" href="{{ route('schoolQuizLogOut') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                <div style="border-radius:3px; background-color:red; color:white; padding:5px 12px;"> {{ __('Logout') }}</div>
                             </a>
                              </div>

                                    <form id="logout-form" action="{{ route('schoolQuizLogOut') }}" method="POST" class="d-none">
                                        @csrf
                                    </form> --}}




    <main class="qz-bx mt-2 pt-4 pb-3">
        <div class="container">
            <div class="row">
		
                <div class="col-md-8 offset-md-2">
                <div class="quiz-lang text-right">
                     <span>
                  
                </div>
				   
				   
                    <div class="card">
                        <figure class="mb-0"><img src="{{ asset('resources/imgs/school_quiz/new_pkl_dashboard.jpg') }}" class="main-poster img-fluid" alt="Tokyo Quiz" />
                        </figure>

                        <div class="card-body" style="text-align: justify">
                            {{-- <h1 class="mt-0 mt-sm-0 mt-lg-3 text-center" style="text-decoration: underline;">School Name - {{ $userdata->name }}</h1> --}}
                            <h1 class="mt-0 mt-sm-0 mt-lg-3">{{ __('vivo PKL Fit India School Week 2022 Quiz')}}</h1>
                            <p>Fit India in collaboration with vivo Pro Kabaddi League (PKL) is organizing a nationwide quiz contest from 5th December to 12th December 2022.</p>
                            

                            <h2>The Quiz will have the following process:</h2>
                            <p style="margin-left: 20px;">
                                <strong>Online Quiz:</strong>To be a multiple-choice online round conducted in English
								<!--,
                                from 23 June
                                2021
                                to 22 July 2021 (One Month) -->
                            <ul>
                                <li>{{ __('The Quiz will have 5 questions (60 seconds) from multiple themes of vivo Pro Kabbadi League (PKL) and Kabaddi- Athletes, Records, Teams, Rules etc')}}</li>
                                <li>{{ __('All school students (Indian citizens) can participate in the quiz.')}}</li>
                                <li>{{ __('Only one attempt per student is allowed.')}}</li>
                                <li>{{ __('In case of tie in scores, the fastest completed score will be considered. In case of further tie, a draw of lots will be employed')}}</li>
                                <li>{{ __('5 lucky winners will be announced at the end of contest ')}}</li> 
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
                               
							   {{ __('Happy Quizzing!!') }} 
                            </p>
							
							<p class="mt-4 mb-0 pt-2">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-auto">
                                        <a class="btn btn-success mr-3" href="{{ route('schoolQuizform') }}">{{__('sentence.start_quiz_button_text')}}
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


    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script> -->
</body>

</html>