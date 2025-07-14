 <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">Home</a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

     
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?php echo e(route('admin.changepassword')); ?>"  >  <?php echo e(__('Change Password')); ?> </a>
	   </li>
      <li class="nav-item">
		
		
			<div class="list-group">
				<a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); 
					 document.getElementById('logout-form').submit();">
					<?php echo e(__('Logout')); ?>

				</a>
			</div>

          <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" class="d-none">
             <?php echo csrf_field(); ?>
          </form>

      </li>
    </ul>
  </nav>
  <!-- /.navbar --><?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/layouts/header.blade.php ENDPATH**/ ?>