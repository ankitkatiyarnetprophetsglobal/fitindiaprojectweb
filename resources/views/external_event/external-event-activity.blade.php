<!doctype html>
<html lang="en">
  <head>   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >

    <title>External-Event-Activity</title>
    <style>
      .dayHead{

       position: relative;
       display: inline-block;
      
        /* color: #ff9934 !important; */
        color: rgb(32, 32, 32) ;
      }
      
      .dayHead span{
        display: block;
    position: relative;
    height: 3px;
    width: 60%;
    background-color: #ff9934;
    bottom: -7px;
    /* margin: 0 auto; */
    /* text-align: start; */
    float: right;
      }
      .clear{
        clear:both;
      }
      input[type="checkbox"] {
    height: 25px;
    width: 25px;
}
.card_cus{
  border-radius: 0;

    border-left: 3px solid #ff9934;
    border-top-right-radius:5px;
    border-bottom-right-radius:5px;
    padding:10px;
     margin-bottom:15px;
}
.even{
  background-color: #f7f7f7;
}
.date_div{width: 20%;;}
.row_head h2{font-size: 20px;}
.row_head{display: flex;
justify-content: space-between;align-items: center;}
/* .row_head{padding:10px;} */
.row_head div{border-right: 1px solid #ff9934;

}
.row_head div:last-child{
 border-right: 0px solid #ff9934;
}
.row_head div{padding:10px 20px;text-align: center;width:33.33%}
.row_head p{margin:0;}
.row_head h2{
  margin:0;
}

@media only screen and (max-width: 767px) {
  .dayHead{font-size:24px;}
  .dayHead span{
    
    height: 3px;
    
  }
  .row_head div {
    padding: 1px 5px;
    text-align: center;
    width: 33.33%;
    height: 70px;
}
  .row_head h2{
    font-size:20px;
  }
  .row_head{
    border: 1px solid #cdcccc;
    background: #f2f2f2;
  }
  .flex-sm-column_cust{
    flex-direction: column;
    margin-bottom: 30px!important;
  }
  .mr_margin{margin-top:0!important;}
  /* .ins_btn{margin-top:20px;} */

  .dayHead span {
   
    height: 3px;
    width: 60%;

    bottom: -7px;
    margin: 0 auto;
    /* text-align: start; */
    float: none;
}
.row_head{padding:3px;} 
.row_head h2{font-size:14px;}
.input_cus{width: 50%!important;
}
  
}
.s_font{font-size: 14px;}

@media only screen and (max-width: 380px) {
    .date_for{width: 170px;}
    .s_font{ font-size: .7rem;}

}
@media only screen and (max-width: 360px) {
  .row_head{padding:3px;} 
  .row_head p{font-size:10px;}
.row_head h2{font-size:12px;}
.row_head div{height: 75px;}
.dayHead {font-size: 20px;}
.s_font{ font-size: .7rem;}

}

@media only screen and (max-width: 320px){
.form-control {
    font-size: .7rem;
}
.s_font{ font-size: .7rem;}

}
    </style>
  </head>
  <body>

    <div class="container">
     

      <div class="row mt-5">
        <div class="col-sm-12 col-md-12 text-center  ">
         @if(session()->has('success'))
            <div class="alert alert-success">
               {{ session()->get('success') }}
           </div>     
         @endif
       </div>
        <div class="col-sm-12 col-md-12 text-center mb-4  ">
          <div class="d-flex justify-content-between align-items-center">
          <h1 class="dayHead">Daywise Suryanamaskar  </h1>
          <div class="text-right">            
            <a href="external-event-info" class="btn btn-primary ins_btn" style="padding:4px;"> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
              width="25" height="25"
              viewBox="0 0 50 50"
              style=" fill:#ffffff;"><path d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 25 11 A 3 3 0 0 0 22 14 A 3 3 0 0 0 25 17 A 3 3 0 0 0 28 14 A 3 3 0 0 0 25 11 z M 21 21 L 21 23 L 22 23 L 23 23 L 23 36 L 22 36 L 21 36 L 21 38 L 22 38 L 23 38 L 27 38 L 28 38 L 29 38 L 29 36 L 28 36 L 27 36 L 27 21 L 26 21 L 22 21 L 21 21 z"></path></svg></a>    
          </div> 
          </div>   
        </div>
        </div>
        <!-- <div class="clear"></div> -->
        <?php if($ex_reg_data->registration_type != 'individual'){ ?>
        <div class="row mt-5 mb-2 mr_margin">
          <div class="col-sm-12 col-md-12 row_head">  
            <div>
              <p>Organisation Name</p>
              <h2><?=@$ex_reg_data->org_name?></h2>
            </div> 
            <div>
              <p> Number of participant</p>
              <h2><?=@$ex_reg_data->num_of_participant?></h2>
            </div> 
            <div>
              <p>State/District </p>
              <h2><?=@$ex_reg_data->state_name?></h2>
            </div>        
          
          </div>
        </div>
      <?php } ?>
        
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <?php if($ex_reg_data->registration_type != 'individual'){ ?>
            <h6>*Enter count value per participant</h6>
          <?php } ?>
          <div>
            <form action="{{route('external-activity-store')}}" method="POST">
              @csrf
              <input type="hidden" name="event_reg_id" value="<?=$ex_reg_data->id?>">
              <input type="hidden" name="user_id" value="<?=$_REQUEST['Fit_id']?>">
            <div class="row">
           <div class="col-sm-12 col-md-12 mt-2 mb-3">
            <button class="btn btn-primary ">Update </button>
           </div>
         </div>
            <table class="table table-bordered">
              <thead class="thead-light">
                <tr>
              
                  <th scope="col" class="text-center date_for">Date</th>                 
                  <th scope="col" class="text-center">Count</th>
                </tr>
              </thead>
              <tbody>
                
                <?php
                //echo count($Ex_event);
                $activity = $ex_activity;
                $diff =  strtotime($Ex_event->end_date) - strtotime($Ex_event->start_date);
                $datediff = floor($diff/(60*60*24)) + 1;
                
                $i=0;
                $event_start_date = date('d-m-Y',strtotime($Ex_event->start_date));
                $event_start_date = @$ex_activity[0]->event_activity_date?@$ex_activity[0]->event_activity_date:$event_start_date;
                while($i <= $datediff)
                {

                   $current_date = date('Y-m-d');
                 // $evt_date = date('Y-m-d', strtotime("+$i days", strtotime($Ex_event->start_date)));
                //  $evt_date = date('Y-m-d', strtotime("-$i days", strtotime($current_date.'-1 day')));
                //  $evt_date_new = date('d-m-Y', strtotime("-$i days", strtotime($current_date.'-1 day')));
                 $evt_date = date('Y-m-d', strtotime("-$i days", strtotime($current_date)));
                 $evt_date_new = date('d-m-Y', strtotime("-$i days", strtotime($current_date)));


                  if($evt_date >= $Ex_event->start_date){  //echo $Ex_event->start_date."=".$evt_date."<br>"; 
                   if(!empty(@$ex_activity[0]->event_activity_date)){
                      if($event_start_date < $evt_date_new){
                      ?>
                      <tr>             
                          <td class="d-flex align-items-center">   
                            <input false="false" name="event_check[]" type="checkbox" class="mr-1 event_check" ref="<?=$evt_date_new?>">
                            <input type="text" name="date[]" class="form-control " id="date" value="<?=$evt_date_new?>" readonly >
                          </td>                 
                          <td>
                            <div class="d-flex justify-content-around align-items-center">
                               <?php if($ex_reg_data->registration_type != 'individual'){ ?>
                              <div class="mr-2"><span  class="s_font" style='padding:8px;background: #e9ecef;'><?=@$ex_reg_data->num_of_participant?></span>&nbsp;<span class="s_font">X</span></div>
                            <?php } ?>
                              
                              <input type="number" name="nm_count[]" id="count-<?=$evt_date_new?>" class="form-control"  min="0" max="99" placeholder="0">
                            </div>
                          </td>
                      </tr>  

                 <?php } }else{

                  if($event_start_date <= $evt_date_new){
                      ?>
                      <tr>             
                          <td class="d-flex align-items-center">   
                            <input false="false" name="event_check[]" type="checkbox" class="mr-1 event_check" ref="<?=$evt_date_new?>">
                            <input type="text" name="date[]" class="form-control " id="date" value="<?=$evt_date_new?>" readonly >
                          </td>                 
                          <td>
                            <div class="d-flex justify-content-around align-items-center">
                               <?php if($ex_reg_data->registration_type != 'individual'){ ?>
                              <div class="mr-2"><span  class="s_font" style='padding:8px;background: #e9ecef;'><?=@$ex_reg_data->num_of_participant?></span>&nbsp;<span class="s_font">X</span></div>
                            <?php } ?>
                              
                              <input type="number" name="nm_count[]" id="count-<?=$evt_date_new?>" class="form-control"  min="0" max="99" placeholder="0">
                            </div>
                          </td>
                      </tr>  

                 <?php }

                 }
                 
                 } 
                  $i++;
                }
                if(!$ex_activity->isEmpty()){
                  $j=1;
                  foreach($ex_activity as $activity_val){
                  ?>
                  <tr>             
                    <td class="d-flex align-items-center">   
                      <input false="false" <?php if(!empty($activity_val->nm_count)){ echo "checked";} ?> name="event_check[]" type="checkbox" class="mr-1 event_check" ref="<?=$activity_val->event_activity_date?>">
                      <input type="text" name="date[]" class="form-control " id="date" value="<?=$activity_val->event_activity_date?>" readonly >
                    </td>                 
                    <td>
                      <div class="d-flex justify-content-around align-items-center">
                         <?php if($ex_reg_data->registration_type != 'individual'){ ?>
                        <div class="mr-2"><span  class="s_font" style='padding:8px;background: #e9ecef;'><?=@$ex_reg_data->num_of_participant?></span>&nbsp;<span class="s_font" >X</span></div>
                      <?php } ?>
                        
                        <input type="number" name="nm_count[]" id="count-<?=$activity_val->event_activity_date?>" class="form-control"  min="0" max="99" value="<?=@$activity_val->nm_count?>">
                      </div>
                    </td>
                  </tr>  
                  <?php 
                  $j++;
                  }

                }
                ?>
                
              </tbody>
            </table>
            <button class="btn btn-primary ">Update </button>
          </form>
        </div>
          </div>
        </div>
       
  
   
      <div class="row mt-3 mb-5">
        <div class="col-sm-12 col-md-12" >   
          <div class="d-flex  justify-content-center">    
        
            <!-- <button class="btn btn-primary ">Update </button> -->
        
          </div>          

        </div>
      </div>
    </div>
 
   



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
   
  </body>

<script>
$(document).ready(function(){
 // $('.event_check').
  $('[name="event_check[]"]').change(function()
      {
        var ref = $(this).attr('ref');
        if ($(this).is(':checked')) {
           // Do something...

           $('#count-'+ref).val('13');

           //alert('You can rock now...');
        }else{
            $('#count-'+ref).val('0');
        }
      });

});

</script>


</html>