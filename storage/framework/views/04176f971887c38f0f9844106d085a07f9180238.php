<?php $__env->startSection('title', 'Fit India Admin-All Posts'); ?>

<?php $__env->startSection('content'); ?>
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Upload Event Schedule</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Upload Event Schedule</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>

    <!-- Main content -->
    <section class="content">
     <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        
                            <?php if(Auth::user()->role_id != 9): ?>
                                
                            <?php endif; ?>
                        
                        
                        


                        <ul style="list-style: none">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li style="color:red;"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <div class="col-md-12">
                        <form method="POST" action="<?php echo e(route('admin.socevents.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <a class="mb-2 text-right d-block" href="<?php echo e(url('wp-content/uploads/excel/example.xlsx/')); ?>">Click here to download sample excel file</a>
                            <div class="form-group mb-4">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <button class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

            </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

          <table class="table table-striped projects">
              <thead>

              </thead>
              <tbody>
              <?php $i=0; ?>
                <?php if(isset($main_array) && count($main_array) > 0): ?>
                    <tr class="thead-dark">
                        <th colspan="5" style="text-align: center;">Blank error</th>
                    </tr>
                    <tr class="thead-dark">
                        
                        <th scope="col" width="15%">Event Venue</th>
                        <th scope="col" width="15%">Cycle Count</th>
                        <th scope="col" width="20%">T Shirt Count</th>
                        <th scope="col" width="20%">Meal Count</th>
                        <th scope="col" width="20%">Event Date(YYYY-MM-DD)</th>
                        
                        
                        
                    </tr>
                    <tr>
                        <?php $__currentLoopData = $main_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cycle_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <?php $__currentLoopData = $cycle_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cycle_array_values => $value_cycle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $value_cycle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_cycle_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p style="color:red;">
                                            <?php echo e($error_cycle_value ?? ''); ?><br />
                                        </p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                <?php endif; ?>

              <thead>
                  
                    
                    
                    
                  
              </thead>
              <?php $i=0; ?>
                <?php if(isset($main_array_error) && count($main_array_error) > 0): ?>
                    <tr class="thead-dark">
                        <th colspan="5" style="text-align: center;">Error in text</th>
                    </tr>
                    <tr class="thead-dark">
                        
                        <th scope="col" width="15%">Event Venue</th>
                        <th scope="col" width="15%">Cycle Count</th>
                        <th scope="col" width="20%">T Shirt Count</th>
                        <th scope="col" width="20%">Meal Count</th>
                        <th scope="col" width="20%">Event Date(YYYY-MM-DD)</th>
                        
                        
                        
                    </tr>
                    <tr>
                        <td></td>
                        <?php $__currentLoopData = $main_array_error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <td>
                                <?php $__currentLoopData = $error_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_array_values => $value_error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $value_error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_error_cycle_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p style="color:red;">
                                            <?php echo e($all_error_cycle_value ?? ''); ?><br />
                                        </p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                <?php endif; ?>

                

              </tbody>
          </table>
          <div class="d-flex justify-content-center">

         </div>
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>

  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/socevents/index.blade.php ENDPATH**/ ?>