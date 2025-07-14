<?php $__env->startSection('title', 'Fit India Admin - All Users'); ?>
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
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
	<div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
		   <div class="card">
             <div class="card-header">
			  <div class="row">
			  <div class="col-md-2">
			  <?php if(($admins_role == '3')): ?>
			  <button class="btn btn-success btn-sm dwl" name="download" value="download"
			  onclick="window.location.href='user_export?uname=<?php echo e(request()->input('user_name')); ?>&st=<?php echo e($stateadmin); ?>&dst=<?php echo e(request()->input('district')); ?>&blk=<?php echo e(request()->input('block')); ?>&month=<?php echo e(request()->input('month')); ?>&role=<?php echo e(request()->input('role')); ?>&search=search';">
			  <i class="fa fa-download"></i> Download</button>
			  <?php else: ?>
			  <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='user_export?uname=<?php echo e(request()->input('user_name')); ?>&st=<?php echo e(request()->input('state')); ?>&dst=<?php echo e(request()->input('district')); ?>&blk=<?php echo e(request()->input('block')); ?>&month=<?php echo e(request()->input('month')); ?>&role=<?php echo e(request()->input('role')); ?>&search=search';">
			  <i class="fa fa-download"></i> Download</button>
			  <?php endif; ?>
			  </div>
			  <div class="col-md-10">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="<?php echo e(route('admin.users.index')); ?>">
                <div class="form-group rtside">
				<?php /*<!--<select class="custom-select custom-select mb-3" name="role"  style="width:130px" >
				 <option value="">Select Role</option>
			      @foreach($roles as $role)
                   <?php
                     if(!empty($_REQUEST['role'])&& $_REQUEST['role']==$role->slug){
                       $stselect='selected';
                     }else{
                       $stselect='';
                     }
                    ?>
					 <option data-name="{{ $role->id }}" <?=$stselect?> value="{{ $role->slug }}">{{ ucwords(strtolower($role->name)) }} </option>
					@endforeach
					</select>-->*/ ?>

					<select class="custom-select custom-select mb-3" name="role"  style="width:130px" >
                <?php
				 $mobile='<option value="">Select Role</option>';
				?>
				 <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php
                     if(!empty($_REQUEST['role'])&& $_REQUEST['role']==$role->slug){
                       $stselect='selected';
                     }else{
                       $stselect='';
                     }

					$mobile.='<option data-name='.$role->id.' '.$stselect.' value='.$role->slug.'>'.ucwords(strtolower($role->name)).'</option>';
				  ?>
				 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				 <?php
                   //$mobile.='<option value="-1">Web</option>';
                   $mobile.='<option value="Mobile" '.((!empty($_REQUEST['role'])&& $_REQUEST['role']=='Mobile') ? 'selected="selected"' : '').'>Mobile</option>';
                   echo $mobile;
                 ?>
				</select>



				   <?php if($admins_role != '3'): ?>
					<select class="custom-select custom-select mb-3" name="state" id="youth_state" style="width:130px" >
						<option value="">Select State</option>
					   <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php
                     if(!empty($_REQUEST['state'])&& $_REQUEST['state']==$state->name){
                       $stselect='selected';
                     }else{
                       $stselect='';
                     }
                    ?>
							<option data-name="<?php echo e($state->id); ?>" <?=$stselect?> value="<?php echo e($state->name); ?>"><?php echo e($state->name); ?></option>
					   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>


					<?php endif; ?>


					<select class="custom-select custom-select mb-3" name="district" id="youth_district" style="width:140px" >
						<option value="">Select District</option>
						<?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                     if(!empty($_REQUEST['district'])&& $_REQUEST['district']==$district->name){
                       $dstselect='selected';
                     }else{
                       $dstselect='';
                     }
                    ?>
					<option data-disname="<?php echo e($district->id); ?>" <?=$dstselect?>  value="<?php echo e($district->name); ?>"><?php echo e($district->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>

					<select class="custom-select custom-select mb-3" name="block" id="youth_block" style="width:130px" >
					  <option value="">Select Block</option>
						<?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
						   if(!empty($_REQUEST['block'])&& $_REQUEST['block']==$block->name){
							 $blkselect='selected';
						   }else{
							 $blkselect='';
						   }

						  $block_name=ucwords(strtolower($block->name));
						?>
							<option data-disname="<?php echo e($block->id); ?>"  <?=$blkselect?> value="<?php echo e($block->name); ?>"><?php echo e(ucwords(strtolower($block_name))); ?></option>
					   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>

					<!--<input type="month" id="month" name="month" class="form-control mb-3"  style="width:130px !important; margin-right:2px;">-->
					<input type="month" id="month" name="month" class="form-control mb-3"  style="padding:2px;width:170px !important; margin-right:2px;">

					<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
              </form>
            </div>
			</div>
			<div class="row mt-2">
			<div class="col-md-6">
			  <?php
			    //'count','admins_role','curcount','flag'
			    $curcount=(!empty($count)&& empty($curcount)&& empty($flag)) ? $curcount=$count : $curcount;
			  ?>
			  Total users <strong><?php echo e($curcount); ?>/<?php echo e($count); ?></strong>
			</div>

			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="<?php echo e(route('admin.users.index')); ?>">
                <div class="form-group rtside">
                  <?php
             if(!empty($_REQUEST['user_name'])&& $_REQUEST['user_name']!=''){

               $uname=$_REQUEST['user_name'];

             }
             else{

               $uname='';
             }
            ?>
				<!--<input type="search" name="user_name" <?//=$uname?> class="form-control" placeholder="user email/name/mobile "  value="<?//=$uname?>" width="200px">-->
			    <input type="search" name="user_name" <?=$uname?> class="form-control" placeholder="Name/Email/Phone" value="<?=$uname?>" width="200px">
				<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
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
					<th scope="col">#</th>
					<th scope="col">Name & Role</th>
					<th scope="col">Email & Phone</th>
					<th scope="col">State</th>
					<th scope="col">District/Block/City</th>
						<?php if(!in_array($admins_role, array(2,3))): ?>
					<th scope="col">Action</th>
						<?php endif; ?>
                  </tr>
              </thead>
              <tbody>
			  <?php if(count($user)>0): ?>
              <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
					<th scope="row"><?php echo e(($user->currentPage() - 1) * $user->perPage() + $loop->iteration); ?></th>
					<td>
					   <?php echo e($users->id); ?> <br><?php echo e($users->name); ?><br> <?php echo e($users->role); ?>

					    <br>
					<?php
                      if(empty($users->rolelabel)|| is_null($users->rolelabel)|| $users->rolelabel=== null){

						 echo "<p>
						      <span style='color:#000000'>".$users->gender."</span><br>
						      <span style='color:#28a745'><b>(Mobile)</b></span>
						   </p>";
                      }
                    ?>
					</td>
					<td><?php echo e($users->email); ?> <br> <?php echo e($users->phone); ?></td>
					<td> <?php if(!empty($users->state)): ?> <?php echo e(ucwords(strtolower($users->state))); ?> <?php endif; ?> </td>
					<td> <?php if(!empty($users->district)): ?> <?php echo e(ucwords(strtolower($users->district))); ?> <?php endif; ?> <br>
					 <?php if(!empty($users->block)): ?> <?php echo e(ucwords(strtolower($users->block))); ?> <?php endif; ?> <br>
					<?php echo e(ucwords(strtolower($users->city))); ?></td>
						<?php if(!in_array($admins_role, array(2,3))): ?>
					<td style="width:100px;display:contents !important;">&nbsp;&nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="<?php echo e(url('admin/edit-user', $users->id)); ?>">
					<i class="fas fa-pencil-alt"></i>&nbsp;</a>&nbsp;
					<button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')">
					<a style="display: inline !important;" class="btn btn-danger btn-xs"  href="<?php echo e(url('admin/user-destroy',[ 'id' => $users->id ])); ?>" >
					<i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</a></button>
					</td>
						<?php endif; ?>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  <?php endif; ?>
              </tbody>
          </table>
         </div>
       </div>
      </div>
      </div>
	  </div>
    <div class="d-flex justify-content-center">
       <?php echo e($user->appends(request()->input())->links()); ?>

     </div>

    </section>
    <!-- /.content -->
  </div>


<?php $__env->stopSection(); ?>















































<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/user/index.blade.php ENDPATH**/ ?>