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
                    <?php elseif(($admins_role == '10')): ?>
                        <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='user_export?rolesoc=nemoclubdata&search=search';">
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

					
                    <?php
                    // $mobile='<option value="">Select Role</option>';
                    ?>
                    
                    <?php
                        // if(!empty($_REQUEST['role'])&& $_REQUEST['role']==$role->slug){
                        // $stselect='selected';
                        // }else{
                        // $stselect='';
                        // }

                        // $mobile.='<option data-name='.$role->id.' '.$stselect.' value='.$role->slug.'>'.ucwords(strtolower($role->name)).'</option>';
                    ?>
                    
				 <?php
                   //$mobile.='<option value="-1">Web</option>';
                //    $mobile.='<option value="Mobile" '.((!empty($_REQUEST['role'])&& $_REQUEST['role']=='Mobile') ? 'selected="selected"' : '').'>Mobile</option>';
                //    echo $mobile;
                 ?>
				



				   


					

					

					<!--<input type="month" id="month" name="month" class="form-control mb-3"  style="width:130px !important; margin-right:2px;">-->
					

					
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
					<th scope="col">Event Participation</th>
                    
                    <th scope="col">Kit Status</th>
                    
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
                        <td><?php echo e($users->event_participation ?? ''); ?></td>
					
					<td style="width:100px;display:contents !important;">
                        
                        <br/>
                        <br/>
                        <?php if($users->kit_dispatch == 1): ?>
                            <span class="badge badge-pill badge-success">Dispatched</span>
                        <?php else: ?>
                            <p id="amb-<?php echo e($users->id); ?>"><span class="badge badge-pill badge-secondary">Pending</span></p>
                        <?php endif; ?>
                        <?php if($users->kit_dispatch == 0): ?>
                            <select class="status_change" id="<?php echo e($users->id); ?>" >
                                <option value="">Please select</option>
                                <option value="0">Pending</option>
                                <option value="1">Dispatched</option>
                            </select>​
                        <?php endif; ?>
                        
					
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function(){
      jQuery('.status_change').change(function(){
      var status = jQuery(this).val();
      var amb_id = jQuery(this).attr('id');
    //   let result = confirm("Are you sure you want to dispatch the kit for this user?");
      let result = confirm("Are you sure?");
      if (result) {
            // alert("You clicked OK");
            var rejection_value = '';
        if(status == '1'){
            jQuery.ajax({
                                type:"POST",
                                url:"<?php echo e(url('/admin/nemoclub-dispatch-status/')); ?>",
                                data : {'amb_id' :amb_id,'status':status,'rejection_value':rejection_value,'_token': '<?php echo e(csrf_token()); ?>'},
                            beforeSend: function() {
                                jQuery('#amb-'+amb_id).html('<img width="35" with="35" src="<?php echo e(url("/wp-content/uploads/2021/01/loader.gif")); ?>">');
                            },
                        success:function(res){
                            // console.log("res",res.success.msg);
                            // return false;
                            // var response_obj = JSON.parse(res);
                            if(res.success.msg == 'Approved'){
                                jQuery('#'+amb_id).remove();
                                jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-success">Dispatched</span>');
                            }
                            location.reload();
                            // else if(response_obj.status=='2'){
                            //     jQuery('#'+amb_id).remove();
                            //     jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-danger">Rejected</span>');
                            // }else{
                            //     jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-secondary">Pending</span>');
                            // }
                        }
                    });
                }
            // proceed with delete or other action
        } else {
            location.reload();
            // alert("You clicked Cancel");
            // abort the action
        }
    // return false;
    //   $('input[name=amb_ids]').val(amb_id);

    // else{
    //   if(status == '2'){
    //       $('#myModal').modal('show');
    //     }
    //   }
    });
   });
</script>














































<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/socevents/nemoclubdata.blade.php ENDPATH**/ ?>