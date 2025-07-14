
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <title>Fit-India</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('style.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
    .tick_result_img{
    margin-top: 25px;
    height: 50px;
    margin-bottom: 25px;
    /* background-color: white; */
}
.result-box{
    margin-top: 10px;
    /*  */
    /* border-radius: 10px; */
}
.inner-result-box{
    background-color: #dedede;
    padding: 15px;
    border-radius: 10px;
}
.result-box table{
    /* text-align: center; */
}
.result-box td{
    width: 150px;
    font-weight: 700;
}
.result-box th{
    /* width: 80px; */
    font-weight: 400;
}

#roll{
    #text-transform: uppercase;
}
</style>

<body>
  <!-- INPUT BAR -->
  <form action="" method="POST">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
    @csrf
    {{-- <div class="quiz-result">
        <div class="container">
            <div class="row my-3">
                <div class="col">
                    <input type="text"  value="" id="roll" class="form-control" placeholder="Enter Roll Number" maxlength="8">
                    </div>

                    
                    <div class="col-auto">
                    <a href="#" class="text-decoration-none"><button type="submit" id="submit"
                            class="btn btn-primary">View</button></a>
                </div>
                
            </div>
        </div>
    </div> --}}
    <div class="quiz-result">
        <div class="container">
            <div class="row mt-2 align-items-center justify-content-center ">
                <div class="col-12">
                    <div class="result-box  d-block mx-auto ">
                        
                       <div class="inner-result-box"  >
                        <h3 class="text-center" id="error_result">
                            Results to be announced soon.
                        </h3>
                      
                     
                       </div>
                        
                    </div>
                </div>
            </div>
           </div>
    </div>
</form>
    <!-- ConGRATULATIONS BLOCK -->
    <div id="show_champion_result">
</div>


    <!-- <div class="quiz-result ">
        <div class="container">
           oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1');"
           <div class="container">
            <div class="row mt-2 align-items-center justify-content-center ">
                <div class="col-12 p-0">
                    <div class="result-box  d-block mx-auto ">
                        
                       <div class="inner-result-box">
                        <h3 class="text-center">
                            Congratulations! You have been shortlisted for the next round.
                        </h3>
                        <img src="assets/Right.svg" class="d-block mx-auto tick_result_img" alt="">
                        <div class="table-responsive">
                            <table class="table" style="border: 0px solid transparent;">
                                <tr>
                                    <th>
                                        Roll No.
                                    </th>
                                    <td>
                                        1234567
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>Akshay</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>Male</td>
                                </tr>
                                <tr>
                                    <th>School</th>
                                    <td>LFP school</td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td>Muzzafarnagar</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>UP</td>
                                </tr>
                                <tr>
                                    <th>State/UT Rank</th>
                                    <td>00093</td>
                                </tr>

                            </table>
                        </div>
                       </div>
                        
                    </div>
                </div>
            </div>
           </div>
           
        </div>
    </div> -->


    <!-- NEXT TIME BLOCK -->
    <!-- <div class="quiz-result">
        <div class="container">
            <div class="row mt-2 align-items-center justify-content-center ">
                <div class="col-12">
                    <div class="result-box  d-block mx-auto ">
                        
                       <div class="inner-result-box"  style="min-height: 300px;">
                        <img src="assets/Cross.svg" class="d-block mx-auto tick_result_img my-5" alt="">
                        <h3 class="text-center">
                            Appreciate your participation. Better luck next time!
                        </h3>
                      
                     
                       </div>
                        
                    </div>
                </div>
            </div>
           </div> 
    </div>-->




   
<script type="text/javascript"> 

$(document).ready(function(){
    $('#submit').on('click',function enterroll(e){
                  e.preventDefault();
             var roll_value=$('#roll').val();
                  console.log(roll_value);

                  var fd = new FormData();
                  fd.append('roll_no',roll_value);

                  $.ajaxSetup({
                           headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                     }
                          });

                          $.ajax({
                url:"{{url('get-user-result-value')}}",
                type:'POST',
                data: fd,
                contentType: false,
                processData: false,
                success:function(data){
                    console.log((data.result));
                    $("#find_roll").hide();
                  
       if(data.result!=='Not Found'){ 
              

var output =`<div class='quiz-result'>
        <div class="container">
           
           <div class="container">
            <div class="row mt-2 align-items-center justify-content-center ">
                <div class="col-12 p-0">
                    <div class="result-box  d-block mx-auto ">
                        
                       <div class="inner-result-box">
					   <img src="{{asset('resources/imgs/quiz_result/Right.svg')}}" class="d-block mx-auto tick_result_img" alt="">
                        <h3 class="text-center">
                            Congratulations! You have been shortlisted for the next round.
                        </h3>
                        
                        <div class="table-responsive">
                            <table class="table" style="border: 0px solid transparent;">
                                <tr>
                                    <th>
                                        Roll No.
                                    </th>
                                    <td>
                                        ${data[0].roll_no}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>${data[0].candidate_name}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>${data[0].gender}</td>
                                </tr>
                                
                                <tr>
                                    <th>School</th>
                                    <td>${data[0].school_name}</td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td>${data[0].district}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>${data[0].state}</td>
                                </tr>
                                <tr>
                                    <th>State/UT Rank</th>
                                    <td>${data[0].rank_new}</td>
                                </tr>

                            </table>
                        </div>
                       </div>
                        
                    </div>
                </div>
            </div>
           </div>
           
        </div>
    </div>`;
console.log(output);
$("#show_champion_result").show();
document.getElementById("show_champion_result").innerHTML=output;

       }else{
var output=` <div class="quiz-result">
        <div class="container">
            <div class="row mt-2 align-items-center justify-content-center ">
                <div class="col-12">
                    <div class="result-box  d-block mx-auto ">
                        
                       <div class="inner-result-box"  style="min-height: 300px;">
                        <img src="{{asset('resources/imgs/quiz_result/Cross.svg')}}" class="d-block mx-auto tick_result_img my-5" alt="">
                        <h3 class="text-center">
                            Appreciate your participation. Better luck next time!
                        </h3>
                      
                     
                       </div>
                        
                    </div>
                </div>
            </div>
           </div>
    </div>`;
    document.getElementById("show_champion_result").innerHTML=output;
	$("#show_champion_result").show();

       }
                          
                },

                error: function(message){
            var errorResult=message.responseJSON.errors.roll_no[0];
var errorOutput=`<div class="container">
            <div class="row mt-2 align-items-center justify-content-center ">
                <div class="col-12">
                    <div class="result-box  d-block mx-auto ">
                        
                       <div class="inner-result-box"  >
                        <h3 class="text-center" id="error_result" style="color:black;">
                        ${errorResult}
                        </h3>
                      
                     
                       </div>
                        
                    </div>
                </div>
            </div>
           </div>
    </div>`;
        $("#show_champion_result").hide();
        
    document.getElementById("find_roll").innerHTML=errorOutput;
    $("#find_roll").show();










        }





                });
            })









    })



       

</script>

</body>

</html>