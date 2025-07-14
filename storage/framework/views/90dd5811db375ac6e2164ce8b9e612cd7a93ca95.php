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
            <h1>Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Posts</li>
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
          <div class="col-md-2">
              <?php if(Auth::user()->role_id != 9): ?>
                <a href="<?php echo e(route('admin.socadmin-create-write')); ?>">
                  <input type="submit" value="Create New Admin" class="btn btn-sm btn-success float-left">
                </a>
              <?php endif; ?>
              <div class="card-tools float-sm-left">No of Posts: <strong><?php echo e($distributionpermissions_count ?? ''); ?></strong></div><br>
              
            </div>
                <div class="col-md-10">
                    <form class="form-inline my-2 my-lg-0 rtside " method="GET" action="<?php echo e(route('admin.posts.index')); ?>">
                        <div class="form-group rtside">
                        
                        
                        
                            
                            
                            
                            
                            
                            
                        
                        
                        </div>
                    </form>
                </div>
          </div>
        </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

          <table class="table table-striped projects">
              <thead >
                  <tr class="thead-dark">
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="15%">Fit india id</th>
                    <th scope="col" width="15%">Name</th>
                    <th scope="col" width="15%">Email</th>
                    <th scope="col" width="15%">Phone</th>
                    <th scope="col" width="25%">Action</th>
                    
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>

                <?php $__currentLoopData = $distributionpermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                  <tr>
                    <th scope="row"><?php echo e(++$i); ?></th>
                    <td><?php echo e(ucwords($post->fid)); ?></td>
                    <td><?php echo e(ucwords($post->name)); ?></td>
                    <td><?php echo e(ucwords($post->email)); ?></td>
                    <td><?php echo e(ucwords($post->phone)); ?></td>
                     <td style="width:120px;display:inline-flex !important;">
                      
                      <?php if(Auth::user()->role_id == 10): ?>
                        &nbsp;&nbsp;
                            
                          
                            <a style="display: inline !important;"class="btn btn-danger btn-xs" class="btn btn-info btn-xs" href="<?php echo e(route('admin.destroysocadminid',$post->main_id)); ?>" title="View" onclick="return confirm('Do you want to delete?')">
                                <i class="fa fa-trash"  aria-hidden="true"></i>
                            </a>
                      <?php endif; ?>
                     </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
          </table>
          <div class="d-flex justify-content-center">
           <?php echo e($distributionpermissions->links()); ?>

         </div>
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>

  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/socevents/socadminwrite.blade.php ENDPATH**/ ?>