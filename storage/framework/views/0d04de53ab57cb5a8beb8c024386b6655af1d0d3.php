
<?php $__env->startSection('title', 'Fit India Admin - All Event Archive'); ?>
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
            <h1>Event Archive</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Event Archive</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <?php if($message = Session::get('msg')): ?>
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
                    <div class="col-md-2">
                         <a href="<?php echo e(route('admin.eventarchive.create')); ?>"> <input type="submit" value="Create New Event Archive" class="btn btn-success btn-sm float-right"> </a>
						 <div class="card-tools float-sm-left">Event Archive: <strong><?php echo e($eventarchive_count); ?></strong></div><br>
                  </div>
                  <div class="col-md-2">
                  </div>
                </div> 
              </div>
         
          <div class="card-body table-responsive p-0">              
           <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Event Archive</th>
                    <th scope="col">Group</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                <?php $__currentLoopData = $eventarchive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <th scope="row"><?php echo e(++$i); ?></th>
                    <td><?php echo e($archive->title); ?></td>                      
                    <td>
					  <?php
                         $group=array();					  
					     if($archiverole){
							 foreach($archiverole as $val){                               
							  if($val->archive_id==$archive->id){
								array_push($group,$val->name);								 
							  } 								 
							 }							 
						 }
						 
						echo implode(', ',$group);	
					  ?>					
					</td>
                    <td>
					    <?php if($archive->poster_image!=''){ ?>
						 <img src="<?php echo e($archive->poster_image); ?>" width="100" height="75">
						<?php } ?>
					</td>
                    <td><?php echo e($archive->status); ?></td>                     
                    <td style="width:120px;display:inline-flex !important;">  
					  &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="<?php echo e(route('admin.eventarchive.edit',$archive->id)); ?>"> <i class="fas fa-pencil-alt"></i></a>
					  &nbsp;&nbsp;
					  <form action="<?php echo e(route('admin.eventarchive.destroy',$archive->id)); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<?php echo method_field('DELETE'); ?>
					   <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
					   </form>      
                    </td>
                    <td></td>
                  </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
          </table>
         </div>
        </div>
        </div>
      </div>
      </div>
    </section>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/eventarchive/index.blade.php ENDPATH**/ ?>