<?php $__env->startSection('title', 'Fit India Schools | Fit India'); ?>
<?php $__env->startSection('content'); ?>
<?php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
?>

    <div class="video_sec">
        <video autoplay muted loop id="VideoId">
          <source src="<?php echo e(url('resources/imgs/home/share_story_video.mp4')); ?>" type="video/mp4">
        </video>
        <div class="ove_text">
          <h1><?php echo e(__('sentence.fit_india_school')); ?></h1> <!--Fit India Schools-->
          <p><?php echo e(__('sentence.join_the_Fit_India_School_movement_Increase_physical_education_and_physical_activity_for_your')); ?><br><?php echo e(__('sentence.students_and_in_your_school_and_make_a_fitter_healthier_and_happier_India')); ?>


		  <!--Join the Fit India School movement. Increase physical education and physical activity for your <br>students and in your school and make a fitter, healthier and happier India.-->
		  </p>
        </div>
    </div>

    <section id="<?php echo e($active_section_id); ?>">
        <div class="container" >
        <div class="row " >
            <div class="col-sm-12 col-md-8 col-lg-9" >
                <p><?php echo e(__('sentence.Honble_Prime_Minister_of_India_has_launched_the_Fit_India_Movement_on_29_Aug_2019_with_a_view_to_make_Physical_Fitness_a_way_of_life')); ?>

                   <?php echo e(__('sentence.Fit_India_Movement_aims_at_behavioural_changes_from_sedentary_lifestyle_to_physically_active_way_of_day_to_day_living')); ?>

                   <?php echo e(__('sentence.Fit_India_would_be_a_success_only_when_it_becomes_a_peoples_movement_We_have_to_play_the_role_of_a_catalyst')); ?>


				 <!--
				  Hon’ble Prime Minister of India has launched the Fit India Movement on 29 Aug 2019 with a view to make Physical Fitness a way of life.
				  Fit India Movement aims at behavioural changes – from sedentary lifestyle to physically active way of day-to-day living.
				  Fit India would be a success only when it becomes a people’s movement. We have to play the role of a catalyst.-->
				</p>
                <p><?php echo e(__('sentence.How_to_Live_ought_to_be_the_first_pillar_of_formal_education_This_involves_teaching_and_practicing_the_art_of_taking_care_of_ones_body_and_health_daily_Schools_have_to_be_the_first_formal_institution_after_home_where_physical_fitness_is_taught_and_practiced')); ?>

				 <!--‘How to Live’ ought to be the first pillar of formal education. This involves teaching and practicing the art of taking care of one’s body and health daily. Schools have to be the first formal institution after home where physical fitness is taught and practiced.-->
				</p>
                <p>
					<?php echo e(__('sentence.In_the_above_background_the_Fit_India_Mission_encourages_Schools_to_Organise_a')); ?>

					<strong><?php echo e(__('sentence.FitIndia_SchoolWeek')); ?></strong>
					<?php echo e(__('sentence.in_month_of_November_December_It_has_also_prepared_a_set_of')); ?>

					<strong><?php echo e(__('sentence.Fit_India_School_Certification')); ?></strong>
					<?php echo e(__('sentence.with_simple_and_easy_parameters')); ?>

					 <!--In the above background, the Fit India Mission encourages Schools to Organise a
					 <strong>Fit India School Week</strong> in month of November/December.
					 It has also prepared a set of <strong> Fit India School Certification
					 </strong>with simple and easy parameters.-->
				</p>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class=" et_pb_bg_layout_light">
                  <a  class="" href="fit-india-school-registration"><?php echo e(__('sentence.apply_For_Fit_India_School_Certification')); ?><!--Apply For Fit India <br> School Certification--><span style="margin-left:10px"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-1" role="img" xmlns="http://www.w3.org/2000/svg"  width="12px" height="15px" viewBox="0 0 320 512"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg></span></a>
                </div>
                
            </div>
        </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/fit-india-school.blade.php ENDPATH**/ ?>