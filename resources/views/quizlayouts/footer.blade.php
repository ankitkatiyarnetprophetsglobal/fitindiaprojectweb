@php $annouc = request()->route()->uri; @endphp
<!-- Footer -->
<footer class="footer @if(in_array($annouc, array('/','home'))) {{ 'home-footer' }} @endif" id="footer_ab" > 
        <div class="footer_flex-top">
           <div class="inner_footer">
             <ul class="f_link">
			 
			  <li><a href="{{ url('about') }}" >About Us</a></li>
			   <li><a href="{{ url('media') }}" >Media</a></li>
               <li><a href="{{ url('site-map') }}" >Site Map</a></li>
               <li><a href="{{ url('feedback') }}" >Feedback</a></li>
               <li><a href="{{ url('help') }}" >Help</a></li>
               <li><a href="#a" >WIM</a></li>
               <li><a href="{{ url('contact-us') }}" >Contact Us</a></li>
               <li><a href="{{ asset('wp-content/uploads/2021/01/Revised-Policy.pdf') }}" target="_blank">Privacy Policy</a></li>
             </ul>
			 <span class="national-portal"><a class="getlink" href="javascript:void(0);" data-link="https://www.india.gov.in/"><img src="{{ asset('resources/imgs/india-gov-in-logo.png')}}" alt="India.gov.in" title="National Portal of India"></a></span>

             <ul class="s_link s_linkFooter">
                <li>
                     <a class="font_f f_c" href="https://www.facebook.com/FitIndiaOff/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i><span>@FitIndiaOff</span></a>
                </li> 
                <li>
                <a class="font_f t_c" href="https://twitter.com/FitIndiaOff" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i><span>@FitIndiaOff</span></a>
                </li>
                <li>
                <a class="font_f y_c" href="https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>Fit India Movement</span></a>
                </li>
                <li>
                <a class="font_f i_c" href="https://www.instagram.com/fitindiaoff/ " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i><span>@FitIndiaOff</span></a>
                </li>
				<li>
                <a class="font_f c_c" href="{{ url('contact-us') }}" rel="noopener noreferrer"><i class="fa fa-phone" aria-hidden="true"></i><span>Contact Us</span></a>
                </li>
              
               
            </ul>

           </div>
           <!-- <div class="footer_link">
               
          </div>  -->

          <!-- <div class="footer_link">
              <ul>
                <li><div class="visitor">
                          <span class="social_area"> 
                            <span><a class="font_f f_c" href="https://www.facebook.com/FitIndiaOff/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a> </span>                   
                            <span><a class="font_f t_c" href="https://twitter.com/FitIndiaOff" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
                            <span><a class="font_f y_c" href="https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></span>
                            <span><a class="font_f i_c" href="https://www.instagram.com/fitindiaoff/ " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
                          </span>
                    </div>
                  </li>
              
               
            </ul>
          </div>-->
          </div>
          <div class="clear"></div>
        <div id="main-footer">
            <div class="footer_Flex">
                    
                      
                 <p>© 2021 Sports Authority of India. All rights reserved </p><!--| <span class="pvpol">
                  <a href="{{ asset('wp-content/uploads/2021/01/Revised-Policy.pdf') }}" target="_blank">Privacy Policy &nbsp;</a>
                </span>-->
                 <p>Last updated on 
				 @php echo date('F jS,Y', strtotime(App\Http\Controllers\GeneralController::updatedon())); @endphp   | No of Visitors: <span>
				 @php echo App\Http\Controllers\GeneralController::sitecounter(); @endphp
    
				</span></p> 
               
             
                  
                
  
              </div> 
                       
          </div>
		  
@if(in_array($annouc, array('/','home')))		  
    <div class="announcement-ticker">
		<div class="ticker-heading"><span>Announcements</span></div>
		<div class="ticker-txt ticker-wrap">
		  <marquee id="mymarquee" scrollamount="5">
			<span><a href="covid-19-info">Covid-19 Info - Click Here</a> </span> 
			<span class="mid-line"></span>
			@if(!empty($announcement))
			  @foreach($announcement as $ann)
				<span><a href="home" target="_blank">{{ $ann->title }}</a> </span>
				<span class="mid-line"></span> 
			  @endforeach
			@endif 
		  </marquee>
		</div>
	</div>
@endif
          

 

<script>

/*
------------------------------------------------------------
Function to activate form button to open the slider.
------------------------------------------------------------
*/
function open_panel() {
slideIt();
var a = document.getElementById("sidebar");
a.setAttribute("id", "sidebar1");
a.setAttribute("onclick", "close_panel()");
}
/*
------------------------------------------------------------
Function to slide the sidebar form (open form)
------------------------------------------------------------
*/
function slideIt() {
var slidingDiv = document.getElementById("slider");
var stopPosition = 95;
if (parseInt(slidingDiv.style.right) < stopPosition) {
slidingDiv.style.right = parseInt(slidingDiv.style.right) + 2 + "%";
setTimeout(slideIt, 1);
}
}
/*
------------------------------------------------------------
Function to activate form button to close the slider.
------------------------------------------------------------
*/
function close_panel() {
slideIn();
a = document.getElementById("sidebar1");
a.setAttribute("id", "sidebar");
a.setAttribute("onclick", "open_panel()");
}
/*
------------------------------------------------------------
Function to slide the sidebar form (slide in form)
------------------------------------------------------------
*/
function slideIn() {
var slidingDiv = document.getElementById("slider");
var stopPosition = 97;
if (parseInt(slidingDiv.style.right) > stopPosition) {
slidingDiv.style.right = parseInt(slidingDiv.style.right) - 2 + "%";
setTimeout(slideIn, 1);
}
}

var linkdata="";

function doModal() {
  
  // var linkdata = $(a).data('data-link');
  //   html =  '<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
  //   html += '<div class="modal-dialog">';
  
  //   html += '<div class="modal-content">';
  //   html += '<div class="modal-header">';

  //   html += '<h4>External site alert</h4>'
  //   html += '</div>';
  //   html += '<div class="modal-body">';
  //   html += 'This link shall take you to a webpage outside';
  //   html += ' ';
  //   html += '<strong id="textlink">'+ linkdata +'</strong>';;
  //   html += '. For any query regarding the contents of the linked page, please contact the webmaster of the concerned website.';
  //   html += '</div>';
  //   html += '<div class="modal-footer linkchange">';   
  //   html +='"><a class="btn btn-primary btn_custyes  "  href="'+ linkdata + '"  target="_blank"  onClick="goSite("'+ linkdata +'");" >Yes</a>';
  //   html += '<a class="btn  btn_custno" data-dismiss="modal">No</span></a>';
  //   html += '</div>';  
  //   html += '</div>'; 
  //   html += '</div>';  
  //   html += '</div>'; 

  //   $("#textlink").text(linkdata);  
   
  //   $('body').append(html);
  //   $("#dynamicModal").modal();
  //   $("#dynamicModal").modal('show');
    
}


// function goSite()
// {
//   $(".linkchange a").attr("href",linkdata);
// 	$("#dynamicModal").modal('hide');

// }





</script>

<script >

$(document).ready(function(){  

//   function gosite(){
//   $("#dynamicModal").modal('hide');
// }
// $(".linkchange a").click(function(){
//   alert("rkkafd")
// })


$('a').click(function() {
    var linkdata="";
   linkdata = $(this).attr('data-link');
   var html="";

    if($(this).hasClass( "getlink" )){
      html =  '<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
    html += '<div class="modal-dialog">';
  
    html += '<div class="modal-content">';
    html += '<div class="modal-header">';

    html += '<h4>External site alert</h4>'
    html += '</div>';
    html += '<div class="modal-body">';
    html += 'This link shall take you to a webpage outside';
    html += ' ';
    html += '<strong id="textlink">'+ linkdata +'</strong>';;
    html += '. For any query regarding the contents of the linked page, please contact the webmaster of the concerned website.';
    html += '</div>';  
    html += '<div class="modal-footer linkchange">';   
     html += '<a class="btn  btn_custno" data-dismiss="modal">No</span></a>';
    html +='<a class="btn btn-primary btn_custyes"  href="'+linkdata +'"  target="_blank"  >Yes</a>';
     html += '</div>';  // content
    html += '</div>';  // dialog
    html += '</div>';  // footer
    html += '</div>';  // modalWindow

    $("#textlink").text(linkdata);
    $(".linkchange a").prop('href',linkdata);
    $('body').append(html);
    $("#dynamicModal").modal();
    $("#dynamicModal").modal('show');
    $( ".btn_custyes" ).bind( "click", function() {
      $("#dynamicModal").modal('hide');
     // alert('rakdkfas')
     // alert( $( this ).text() );
    });
    }
      // else{
      //   alert("false")
      // }
 //document.getElementById('textlink').innerText =linkdata;

  ///alert(linkdata)
  

  //doModal(linkdata)var
  
    

    //alert("rak");
});




// function doModal(linkdata) {
//     html =  '<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
//     html += '<div class="modal-dialog">';
  
//     html += '<div class="modal-content">';
//     html += '<div class="modal-header">';

//     html += '<h4>External site alert</h4>'
//     html += '</div>';
//     html += '<div class="modal-body">';
//     html += 'This link shall take you to a webpage outside';
//     html += ' ';
//     html += '<strong>'+ linkdata +'</strong>';;
//     html += '. For any query regarding the contents of the linked page, please contact the webmaster of the concerned website.';
//     html += '</div>';
//     html += '<div class="modal-footer">';
//     html += '<a class="pop_btn_area" target="_blank" href="';
//     html += linkdata;
//     html +='"><span class="btn btn-primary btn_custyes  " onClick="goSite();" >Yes</span>';
//     html += '<span class="btn  btn_custno" data-dismiss="modal">No</span></a>';
//     html += '</div>';  
//     html += '</div>'; 
//     html += '</div>';  
//     html += '</div>';  
     
//     $('body').append(html);
//     $("#dynamicModal").modal();
//     $("#dynamicModal").modal('show');


   
// }
   $(".btn_custno").click(function(){
    $('body').remove(html);
   })


   function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);


})

</script>

</footer>



