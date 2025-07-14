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
                <a href="<?php echo e(route('admin.posts.create')); ?>">
                  <input type="submit" value="Create New Posts" class="btn btn-sm btn-success float-left">
                </a>
              <?php endif; ?>
              <div class="card-tools float-sm-left">No of Posts: <strong><?php echo e($post_count); ?></strong></div><br>
            </div>
                <div class="col-md-10">
                    <form class="form-inline my-2 my-lg-0 rtside " method="GET" action="<?php echo e(route('admin.posts.index')); ?>">
                        <div class="form-group rtside">
                        
                        <select class="custom-select custom-select mb-3" name="postcategory" id="category" style="width:180px" >
                        <option value="">Select Category</option>
                            <?php $__currentLoopData = $post_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option data-name="<?php echo e($post_cat->id); ?>" value="<?php echo e($post_cat->id); ?>"
                            <?php if(!empty($_GET['postcategory'])): ?>
                            <?php //if($post_cat->id == $_GET['postcategory']){ echo 'selected'; } ?>
                                <?php if($post_cat->id == $postcategory){ echo 'selected'; } ?>
                                
                            <?php endif; ?>
                            ><?php echo e($post_cat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button type="search" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
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
                    <th scope="col" width="15%">Title</th>
                    <th scope="col" width="15%">Category</th>
                    <th scope="col" width="20%">Description</th>
                    <th scope="col" width="20%">Language</th>
                    <th scope="col" width="15%">Post Type</th>
                    <th scope="col" width="40px">Image</th>
                    <th scope="col" width="15%">Status</th>
                    <?php if(Auth::user()->role_id == 9): ?>
                      <th scope="col" width="25%">Comment Count</th>
                    <?php endif; ?>
                    <th scope="col" width="25%">Action</th>
                    
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>

                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                  <tr>
                    <th scope="row"><?php echo e(++$i); ?></th>

                    <td><?php echo e(ucwords($post->title)); ?></td>
                    <td>
                      <?php $__currentLoopData = $post->post_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e(ucwords($val->name)); ?>

                        <br/>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    
                    <td>
                      <?php
                        echo mb_strimwidth($post->description, 0, 50, "...");
                        //echo wordwrap($post->description, 8, "\n", false);
                      ?>
                    </td>
                    <td><?php echo e($post['getPostwiselanguage'][0]['name'] ?? ''); ?></td>
                    <td>
                      <?php if($post->post_category_wise == 'post_article'): ?>
                            Article
                      <?php elseif($post->post_category_wise == 'video'): ?>
                            Video
                      <?php else: ?>
                            Article
                      <?php endif; ?>
                    </td>
                    <td>
                        <img src= "<?php echo e($post->image); ?>" width="70px">
                    </td>
                    <td>
                        <?php if($post->published == 0): ?>
                          Pending
                        <?php elseif($post->published == 1): ?>
                          Waiting for approval
                        <?php elseif($post->published == 2): ?>
                          Approved
                        <?php elseif($post->published == 3): ?>
                          Rejected
                        <?php else: ?>
                          No Status
                        <?php endif; ?>
                    </td>
                    <?php if(Auth::user()->role_id == 9): ?>
                      <td><?php echo e($post->get_postwisecommentcount_count ?? ''); ?></td>
                    <?php endif; ?>
                     <td style="width:120px;display:inline-flex !important;">
                      <a class="btn btn-info btn-xs" href="<?php echo e(route('admin.posts.show',$post->id)); ?>" title="View">
                        <i class="fa fa-eye"  aria-hidden="true"></i>
                      </a>
                      <?php if(Auth::user()->role_id != 9): ?>
                        
                        &nbsp;&nbsp;
                          <?php if($post->published == 0 || $post->published == 3): ?>
                            <a style="display: inline !important;" class="btn btn-info btn-xs" href="<?php echo e(route('admin.posts.edit',$post->id)); ?>" title="Edit">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            &nbsp;&nbsp;
                          <?php endif; ?>
                        <?php if(Auth::user()->role_id == 8): ?>
                          <?php if($post->published == 0 || $post->published == 3): ?>
                            <a style="display: inline !important;" class="btn btn-info btn-xs" title="Send to Approval" href="<?php echo e(route('admin.SendToApproval',[$post->id])); ?>">
                              <svg title="Send to Approval" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                              
                              
                              
                            </a>
                            &nbsp;&nbsp;
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if($post->published == 0 || $post->published == 3): ?>
                          <form action="<?php echo e(route('admin.posts.destroy',$post->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit" title="Delete">
                              <i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete?')" ></i>&nbsp;
                            </button>
                          </form>
                        <?php endif; ?>
                      <?php endif; ?>
                        <?php if(Auth::user()->role_id == 9): ?>
                          <?php if($post->published == 1): ?>
                            
                            &nbsp;&nbsp;
                            <a style="display: inline !important;" class="btn btn-info btn-xs" href="<?php echo e(route('admin.ReadyToPublish',$post->id)); ?>">
                              Ready To Publish
                              
                            </a>
                            &nbsp;&nbsp;
                            <a style="display: inline !important;" class="btn btn-info btn-xs" href="<?php echo e(route('admin.Rejected',[$post->id])); ?>">
                              Rejected
                              
                            </a>
                            &nbsp;&nbsp;
                          <?php endif; ?>
                        <?php endif; ?>
                     </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
          </table>
          <div class="d-flex justify-content-center">
           <?php echo e($posts->links()); ?>

         </div>
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>

  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>