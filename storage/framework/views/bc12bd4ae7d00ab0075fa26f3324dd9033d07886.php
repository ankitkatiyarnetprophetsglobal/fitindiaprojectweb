
<?php $__env->startSection('title', 'Fit India Admin-Edit Event Archive'); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
		    <a class="" href="<?php echo e(route('admin.eventarchive.index')); ?>"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>            
            <h1></h1>
          </div>
		</div>
		
		<div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.eventarchive.index')); ?>">Event Archive</li></a>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Event Archive</h3>
              </div>              
              <form method="POST" action="<?php echo e(route('admin.eventarchive.update',$archive->id)); ?>" enctype="multipart/form-data">
			    <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="card-body">
                <?php if(session('status')): ?>
				 <div class="alert alert-success">
					<?php echo e(session('msg')); ?>

				 </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul> 
                    </div>
                <?php endif; ?> 
				
				<div class="form-row">
					<div class="col col-md-6">
					  <label for="title"> Name <span style="color: red">*</span></label>
					  <input type="text" name="title" class="form-control" id="title" value="<?php echo e($archive->title); ?>" placeholder="Name">
					</div>
					<div class="col col-md-6">					 
					  <label for=""> Poster Image <span style="color: red">*</span></label>
					  <input type="file" id="image" name="image" class="form-control"/>
						<?php if($archive->poster_image!=''){ ?>
						 <img src="<?php echo e($archive->poster_image); ?>" width="70" height="50">
						<?php } ?>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col col-md-6">
					  <label for="title"> Start Date <span style="color: red">*</span></label>
					  <input type="date" name="start_date" value="<?php echo e($archive->start_date); ?>" style="width:250px;" class="form-control" id="start_date" placeholder="Start Date">
					</div>
					
					<div class="col col-md-6">
					  <label for="title"> End Date <span style="color: red">*</span></label>
					  <input type="date" name="end_date" value="<?php echo e($archive->end_date); ?>" style="width:250px;" class="form-control" id="link" placeholder="End Date">
					</div>
				</div>				
				<?php
				 //dd($archiverole);				
				?>				
				<div class="form-row">
					<div class="col col-md-6">
					 <label for="title"> Role <span style="color: red">*</span></label>				  
					  <select class="form-control" name="role[]" id="role" multiple autocomplete="role" autofocus>
						<?php                                 								  
						 if(!empty($roles)){								
						   foreach($roles as $scls){						                               								
						?>								   
					    <option value="<?php echo e($scls->id); ?>" <?php if(in_array($scls->id, $archiverole)){ echo "selected='selected'";} ?>><?php echo e(preg_replace('/&amp;[^(\x20-\x7F)\x0A\x0D]*/','',ucfirst(strtolower($scls->name)))); ?></option>
						<?php } } ?>							
					  </select>
					</div>
					
					<div class="col col-md-6">
					 <label for="title"> Link <span style="color: red">*</span></label>
					  <input type="text" name="link" class="form-control" value="<?php echo e($archive->link); ?>" id="link" placeholder="URL">
					</div>				
				</div>	
				
				<div class="form-row">
					<div class="col col-md-6">
					  <label for="title"> Language <span style="color: red">*</span></label> 
					  <select class="form-control" name="language" id="language" >
					     <option value=""><?php echo e('Select'); ?></option>
						 <?php if(!empty($language)): ?>
							<?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>						
							 <option <?php if(isset($archive->language)){ if($archive->language ==  $lan->name){ echo "selected='selected'";}} ?> value="<?php echo e($lan->name); ?>"  <?php if(old('language') == $lan->name): ?> <?php echo e('selected'); ?> <?php endif; ?> ><?php echo e(ucwords(strtolower($lan->name))); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						 <?php endif; ?>	
					  </select>		
					</div>
					
					<div class="col col-md-6">
					  <label>Status</label><br>					  
					  <input type="radio" name="status" value="Active" <?=(!empty($archive->status)&&($archive->status =='Active')? "checked" : "" );?>> Active  <input type="radio" name="status" <?=(!empty($archive->status)&&($archive->status =='Inactive') ? "checked" : "" );?> value="Inactive"> Inactive 
					</div>
				 </div>				 
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>	  
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/eventarchive/edit.blade.php ENDPATH**/ ?>