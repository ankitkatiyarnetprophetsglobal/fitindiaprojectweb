<?php $__env->startSection('title', 'Fit India Cycling Drive'); ?>
<?php $__env->startSection('content'); ?>
<?php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
?>
<div class="banner">
  <div class="row">
      <div class="col-12">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              
              <div class="carousel-inner">
                  <div class="carousel-item mer_banner active">
                    <a href="coiregistration">
                      
                      <img src="<?php echo e($websitebanner ?? 'https://fitindia.gov.in/resources/imgs/soc-11052025.png'); ?>" class="d-block w-100" alt="Fit India Cycling Drive" title="Fit India Cycling Drive">
                      <div class="some-absolute-div bannerPos1">
                          <div class="centered-in-absolute">
                                  <?php echo csrf_field(); ?>
                                  <div class="text-center">
                                      <input type="hidden" name="banner_type" value="week_1">
                                  </div>
                          </div>
                      </div>
                    </a>
                  </div>
                  <div class="carousel-item mer_banner">
                    <a href="coiregistration">
                      <img src="<?php echo e(asset('resources/imgs/fit-india-cyclothon-two.png')); ?>" class="d-block w-100" alt="Fit India Cycling Drive" title="Fit India Cycling Drive">
                      <div class="some-absolute-div bannerPos1">
                          <div class="centered-in-absolute">
                                <?php echo csrf_field(); ?>
                                <div class="text-center">
                                    <input type="hidden" name="banner_type" value="week_1">
                                </div>
                          </div>
                      </div>
                    </a>
                  </div>
                  
              </div>

              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
              </a>
          </div>
      </div>
  </div>

</div>

 <section id="<?php echo e($active_section_id); ?>">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h1 class="et_pb_text_0">Fit India Cycling Drive</h1>
        
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
                                <li class="mb-2">
                                  Cycling is one of the most accessible and effective ways to incorporate fitness into daily routines, offering benefits such as enhanced stamina, stress reduction, and improved cardiovascular health.
                                </li>
                                <li class="mb-2">
                                  In alignment with the Hon'ble Prime Minister's mantra, "Fitness ki dose, aadha ghanta roz," cycling also serves as an eco-friendly solution to mitigate pollution, contributing to a "Green, Fit India."
                                </li>
                                <li class="mb-2">
                                  Building on the success of initiatives like the Fit India Cycling Drive, which saw participation from over 1.5 crore citizens, the Ministry of Youth Affairs and Sports is pleased to launch of "Fit India Cycling Drive - Making Cycling Sunday's a Janbhagidari Movement" to further embed cycling into the nation's lifestyle.
                                </li>
                                <li class="mb-2">
                                  The inaugural event will be led by the Hon’ble MYAS on 17th December 2024, with a cycling rally starting from Major Dhyan Chand National Stadium along Raisina Road to Kartavya Path.
                                </li>
                                <li class="mb-2">
                                  The Fit India Cycling Drive - Cycling Sunday's reflects the core mission of the Fit India Movement—fostering health, fitness, and sustainability. By inspiring millions across the nation to pedal towards a fitter future, it successfully bridges individual wellness with collective environmental responsibility.
                                </li>
                            </ol>
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
                        
                        
                        <a class="" href="coiregistration">Register For Fit India Cycling Drive<span style="margin-left:10px"><svg aria-hidden="true"
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/cyclothon2024.blade.php ENDPATH**/ ?>