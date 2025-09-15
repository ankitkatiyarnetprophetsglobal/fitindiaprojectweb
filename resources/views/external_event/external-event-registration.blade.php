

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" href="{{ asset('resources/css/newcss/bootstrap.min.css') }}">

    <title>External-Event-Activity</title>
    <style>
      .card_cus{
  border-radius: 0;

    border-left: 3px solid #ff9934;
    border-top-right-radius:5px;
    border-bottom-right-radius:5px;
    padding:10px;
     margin-bottom:15px;
     display: flex;
    flex-direction: revert;
    width: 200px;
    align-items: center;
}
.card_cus input{
  margin-right:10px;
}
.ex_flex{
  display: flex;
  justify-content: center;
  align-items: center;
}
.error{
  color: Red;
}
.resImg{
max-width: 100%;
height: auto;;
}
    </style>
  </head>
  <body>
    <div class="fuild-container">
      <img src={{ asset('resources/imgs/event_home/75_suryanamaskar.png') }} class="resImg"/>

    </div>

<div class="container">
<div class="row">
 <div class="col-md-12 col-lg-12 mt-4 ">
   <h4 class=" mb-3 text-center">Welcome to 75 crore Suryanamaskar initiative</h4>
   <p class=" mb-2">Register as:</p>
 </div>
</div>
<div class="row">
  <div class="col-md-12 col-lg-12  ">
    <div class="ex_flex">
   <div  class="card card_cus "><input type="radio" name="r1" value="individual"><label class="mb-0 mr-2"> Individual</label></div>
   <div  class="card card_cus"><input type="radio" name="r1" value="organization"> <label class="mb-0 mr-2"> Organization</label></div>

   </div>
   </div>
   </div>
   <div class="row">
   <div class="col-sm-12 col-lg-8   offset-md-2 ">
    <form action="{{route('external-event-add')}}" method="POST" id="extevt_registratoin" name="extevt_registratoin" style="display:none;">
    @csrf


  <input type="hidden" name="reg_type" value="organization">
    <input type="hidden" name="user_id" value="<?=$_REQUEST['Fit_id'];?>">

  <div class="form-group">
    <label for="exampleInputEmail1"> Organization Name</label>
    <input type="text" name="org_name" class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1"> Number of Participants</label>
    <input type="number" min="0" name="num_of_participant"  class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1"> State</label>
    <select name="state" class="form-control">
      <option value="">select state</option>
      @if(!empty($state))
        @foreach($state as $state_val)
      <option value="{{$state_val->id}}">{{$state_val->name}}</option>
        @endforeach
      @endif
     <!--  <option value="2">Maharastra</option> -->
    </select>
  </div>
  <!-- Organization Name:- <input type="text" name="org_name" ><br>
    Number of Participant:- <input type="number" min="0" name="num_of_participant" ><br>
    State:- <br> -->
<div class='text-center'>
    <input type="submit" name="submit" value="submit" class="btn btn-primary mt-2 ">
</div>
</form>
</div>
</div>
<div class="row">
  <div class="col-md-12 col-lg-12 mt-5 text-center">
<form action="{{route('external-event-add')}}" method="POST" id="extevt_registratoin_ind" style="display:none;">
    @csrf
    <input type="hidden" name="reg_type" value="individual">
    <input type="hidden" name="user_id" value="<?=$_REQUEST['Fit_id'];?>">
    <input type="submit" name="submit" value="continue" class="btn btn-primary">
</form>


</div>
</div>
</div>

</div>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
<script src="{{ asset('resources/js/newjs/jquery.min.js')}}"></script>
 <script src='resources/js/jquery.validate.min.js'></script>
<script type="text/javascript" src="resources/js/additional-methods.js"></script>

</body>

<script>
$(function() {
    $.validator.addMethod("lettersonly", function(value, element)
    {
      //return this.optional(element) || /^[a-z," "]+$/i.test(value);
      return this.optional(element) || /^[a-zA-Z0-9_@./#&+,:\s/-]+$/i.test(value);
    }, "Letters and spaces only please");
    $("form[name='extevt_registratoin']").validate({
            rules: {
                org_name:{
                    required:true,
                    lettersonly:true
                },
                num_of_participant:{
                  required:true
                },
                state: {
                    required:true
                }

            },
            messages: {
                org_name:{
                    required:"Please enter your name",
                    lettersonly:"Please enter character only"
                },
                state: {
                    required: "Please enter your email"
                }
            },
            submitHandler: function(form){
                form.submit();
            }
        });
});





$(document).ready(function(){
  $('input[type=radio][name=r1]').change(function() {
      if (this.value == 'organization') {
          $('#extevt_registratoin').show();
          $('#extevt_registratoin_ind').hide();
      }
      else if (this.value == 'individual') {
          $('#extevt_registratoin').hide();
          $('#extevt_registratoin_ind').show();
      }
  });
})


</script>
</html>


