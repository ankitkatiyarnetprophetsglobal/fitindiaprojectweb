<?php $__env->startSection('title', 'Fit India Photo Stream | Fit India'); ?>
<?php $__env->startSection('content'); ?>
<style>
    .my-ui-pro .freedombtn1{
        margin: 0;
    }
    .my-ui-pro .freedombtn3{
        margin: 0;
    }
    .my-ui-pro .my-ui-div{
        display: flex;
        align-items: center;
        justify-content: center;
        /* padding-top: 120px; */
    }
    table, th, td {
    border: 2px solid #131313;
    /* border-collapse: collapse; */
    }
</style>
<?php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
?>
<section id="<?php echo e($active_section_id); ?>">
  <div class="container">
        
        


                <div class="table-responsive ">
                    <table class="table table-bordered  my-ui-pro">
                        <thead>
                        <tr>
                            
                            <th  style="background-color: #1378f3; color:#ffffff; min-height:44px;" colspan="5">
                                <h6 class="mb-0" style="font-weight: 700 !important;">Sunday on cycle registration data</h6>
                            </th>
                            
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    
                                    <div class="my-ui-div"><a class="freedombtn1" href="javascript:void(0);">Total count:- <?php echo e($total_count_cyclothon ?? ''); ?></div></a>
                                </td>
                                <td>
                                    <div class="my-ui-div"><a class="freedombtn3" href="javascript:void(0);">Individual count:- <?php echo e($total_individual ?? ''); ?></div></a>
                                </td>
                                
                                <td>
                                    
                                    <div class="my-ui-div"><a class="freedombtn3 freedombtn4" style="background-color:#f2101b;" href="javascript:void(0);" data-target="#merchandisId">Namo club count:- <?php echo e($clubcountNamoSOC ?? ''); ?></div></a>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>

                </div>

                


        </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/cyclothon-registration-rolewise.blade.php ENDPATH**/ ?>