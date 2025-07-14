<?php $__env->startSection('title', 'Namo Fit India Club'); ?>
<?php $__env->startSection('content'); ?>
<?php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
?>
<div>  
  
  <a  href="register?role=bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi">
   <img src="<?php echo e(url('resources/imgs/website-banner-design-run.png')); ?>" alt="youthclub" class="img-fluid expand_img" />
  </a>
</div>      
 <section id="<?php echo e($active_section_id); ?>">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h1 class="et_pb_text_0">Namo Fit India Cycling Club</h1>  
        <a class="freedombtn3" href="<?php echo e(url('resources/pdf/how-to-register-for-namo-fit-india-cycling-club.pdf')); ?>" target="_blank">How To Register</a>
    </div>
</div>    

<div class="row">              
    <div class="col-md-12 mpr">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Background
                    </a>
                    </h4>
                </div>                          
                  <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                          <div class="table-responsive">
                            <ol>
                                <li>
                                    Cycling is one of the simplest and most effective ways to integrate fitness into your daily routine. 
                                    It helps build holistic strength by engaging every part of the body, while also boosting stamina and reducing stress. 
                                    This aligns perfectly with the message from our Hon'ble Prime Minister, "Fitness ki dose, aadha ghanta roz," 
                                    advocating for at least 30 minutes of exercise daily. 
                                    Cycling is also an ecofriendly and sustainable mode of transport 
                                    which is in line with the objective of Mission LiFE (Lifestyle for Environment- under the Ministry of Environment)
                                </li>
                                <li>
                                    In its endeavour to promote cycling as an economical and sustainable mode of transport, 
                                    the Fit India Mission invites cycling clubs across the country to register on the Fit India portal. 
                                    These clubs will be encouraged to foster and strengthen the cycling community nationwide.
                                </li>
                                <li>
                                    The administrator/ Head of cycling club or groups shall make an endeavour to ensure a minimum participation of 50 members. 
                                    This will help in creating a vibrant and supportive community, 
                                    where members can connect, share experiences, and participate in group activities that promote cycling as a way of life.
                                </li>
                                <li>
                                    The <b> Namo Fit India Cycling Club </b> will be as an ambassador for fitness, representing the mission’s vision and inspiring others to 
                                    join the movement for a healthier, more active India.
                                </li>
                            </ol>
                          </div> 
                      </div>
                  </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingsix">
                      <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                        Namo Fit India Cycling Club - Parameters
                      </a>
                      </h4>
                </div>
              <div id="collapsesix" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfive">
                  <div class="panel-body">
                      <div class="table-responsive">
                        <b>The following parameters will apply for cycling clubs or groups:</b>
                        <ul>
                            <li>
                                Each member of the cycling club should be aware of the importance of 
                                cycling and commit to participating in group cycling activities for at least 30-60 minutes daily, five days a week.
                            </li>
                            <li>
                                Each member of the cycling club should also commit to motivating one additional person every month to incorporate cycling into their daily routine.
                            </li>
                            <li>
                                The cycling club should organize or collaborate with local bodies and schools to host one community cycling event every quarter.
                            </li>
                            <li>
                                Actively promote the activities of Fit India in their localities.
                            </li>
                        </ul>
                      </div> 
                  </div>
                </div>
              </div>
    </div>
    <div class="row">              
        <section>
            <div class="container">
                <div class="row et_pb_row_2">
                    <div class="col-sm-12">
                        <div class="et_pb_bg_layout_light">
                        <a class="" href="register?role=bmFtby1maXQtaW5kaWEtY3ljbGluZy1jbHVi">Register For Namo Fit India Cycling Club<span style="margin-left:10px"><svg aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="chevron-right"
                                    class="svg-inline--fa fa-chevron-right fa-w-1" role="img"
                                    xmlns="http://www.w3.org/2000/svg" width="12px" height="15px"
                                    viewBox="0 0 320 512">
                                    <path fill="currentColor"
                                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                                    </path>
                                </svg></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- <div class="row">
      <div class="et_pb_button_btn_area">
      <a class="et_pb_button_btn" href="Fit-India-Movement-2019.pdf" target="_blank" data-icon="5">Fit India School Certification Circular</a>
    </div>
    </div> -->
    </div>
    </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/fit-india-namo-club.blade.php ENDPATH**/ ?>