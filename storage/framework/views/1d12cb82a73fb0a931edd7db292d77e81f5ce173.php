<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Admin Login</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('resources/css/style.css')); ?>" rel="stylesheet">

    <link rel="icon" href="<?php echo e(asset('resources/images/fit-fav.ico')); ?>" sizes="32x32" />
    <link rel="icon" href="<?php echo e(asset('resources/images/fit-fav.ico')); ?>" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(asset('resources/images/fit-fav.ico')); ?>" />
    <meta name="msapplication-TileImage" content="<?php echo e(asset('resources/images/fit-fav.ico')); ?>" />

</head>
<style>
html, body {
    /* overflow: hidden; */
}
.adminLogo{ margin:0 auto; width: 90%; text-align: center;}
.adminLogo .fit-logo {text-align: center; margin-top:0; }
.adminLogo h4{padding-top:30px;margin:0; font-size:20px;}
.frm-details {margin-bottom:15px;}
.check_Flex{display: flex; position: relative; padding-left: 20px;}
#frontadmin .form-check-input { position: absolute; margin-left: 0; left: 0 !important; width: auto !important;}
.fit-logo img { width: 60%; }
#frontadmin .login-row {margin-bottom:15px;}
.frm-details {padding: 60px 6% 30px 6%; margin-top: 30px;}
.adm-lgn-sec { padding:40px 0; }
.frm-details {padding: 54px 6% 20px 6%; margin-top: 20px;}
.fit-logo img { width: 45%;}
.adminLogo h1 {
    padding-top: 20px;
    margin: 0;
    font-size: 16px;
}
.frm-details h2 {
    font-size: 18px;
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    padding: 10px 15px;
    background: #e3e5ec;
    border-bottom: 2px solid #d6d8e0;
}
#capcha-page-cont {
    margin-top: 10px;
    padding: 15px 0;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
#pagecaptcha-cont {
    float: left;
    width: 40%;
    margin: 6px 0;
}
.captchaimg  {
    float: left;
}
.captchaimg img {
    float: left;
    width: 100px;
}
.captcha-reset-btn {
    float: left;
    margin: 3px 10px 0px 10px;
    cursor: pointer;
    width: auto;
}
.captcha-txtbx {
    float: right;
    width: 34%;
}
.back-home-pg {
	border:1px solid #f60;
	background:#f60;
	color:#fff;
	padding: 6px 10px;
	font-size:12px;
	text-transform: uppercase;
    border-radius: 100px;
    position: absolute;
    left: 30%;
    right: 30%;
    text-align: center;
	margin-top:15px;
}

/* .button-kic {
    display: block;
    width: 140px;
    height: 40px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    line-height: 25px;
} */
.my-bottm-btn a , .my-bottm-btn input{
    width: auto !important;
    /* min-width: 120px !important; */
        background-color: #02349a !important;
        padding: 10px !important;
        padding-left: 15px !important;
        padding-bottom: 10px !important;
        padding-right: 15px !important;
        padding-top: 10px !important;
        padding: 10px 20px 10px 20px !important;
        display:inline !important;
        border: 1px solid #02349a !important;
        border-radius: 5px !important;
        color: #fff !important;
        box-shadow: none !important;
        font-size: 14px !important;
        font-weight: normal !important;
        height: 140px !important;
}

</style>

<body>


<section class="container-fluid">

	<!-- Top Header Bar -->
    <div id="top-header">
        <div class="top-header_Flex">
            <div class="top_head_item">
                &nbsp;
            </div>
          <div class="log_reg">
            <div class="log_reg log_status">


                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <?php if(Route::has('login')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('admin.login')); ?>"><?php echo e(__('Login')); ?></a>
                                </li>
                            <?php endif; ?>


                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="<?php echo e(route('dashboard')); ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?>

                                </a>

                                <div class="dropdown-menu dropdown-menu-right top-bar-li" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>" >
                                        <?php echo e(__('My Account')); ?>

                                    </a>

                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>

            </div>
          </div>
        </div>
    </div>
	<!-- Top Header Bar end-->


    <!-- Header -->

	<!-- Header end -->

    <!-- Content section -->

	<!-- Content section end-->



</section>


<section class="adm-lgn-sec">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">
        <div  class="adminLogo">
        <a href="https://fitindia.gov.in/" class="fit-logo">
                <img src="<?php echo e(asset('resources/imgs/fit-india_logo.png')); ?>" alt="Fit India">
              </a>
              <h1>Welcome to Fit India Admin Portal</h1>
       </div>
  </div>
  </div>
    <div class="row">
      <div class="col-12 signup_frm">
         <div class="frontlogin">
            <form action="<?php echo e(route('admin.postlogin')); ?>" method="POST" id="frontadmin" novalidate="novalidate">
				<?php echo csrf_field(); ?>


                <?php if(session('status')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('msg')); ?>

                            </div>
                <?php endif; ?>

               <div class="frm-details">
                 <h2><?php echo e(__('Login')); ?></h2>

                 <div class="login-row">
                    <label for="username">Email / Username</label>
					<input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="off" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                 </div>

                 <div class="login-row">
					<label for="password">Password</label>
					<input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="off">

                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>



				<div class="login-row">

                                <div class="check_Flex">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>

                </div>
				<div class="login-row">
                     <div class="um-field" id="capcha-page-cont">
					   <label for="captcha">Please Enter the Captcha Text</label><br>
					   <div id="pagecaptcha-cont">
							<div class="captchaimg">
								<span><?php echo captcha_img(); ?></span>
							</div>
						</div>
					   <div class="captcha-reset-btn">
						 <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
					   </div>

					   <div class="captcha-txtbx">
						   <input type="text" id="captcha" name="captcha" class="form-control <?php $__errorArgs = ['captcha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required  placeholder="Captcha">
							<?php $__errorArgs = ['captcha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
								<span class="invalid-feedback" role="alert" >
									<strong><?php echo e($message); ?></strong>
								</span>
							<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
					   </div>

					   <div style="clear:both;"></div>
				   </div>
                 </div>
                    <div class=" row align-items-center justify-content-md-between justify-content-center">
                        <div class="col-md-auto col-auto mb-2 my-bottm-btn">
                            <input class="mt-0 " style=" padding: 10px 20px 10px 20px !important; height:40px !important;"  type="submit" value="LOGIN">
                        </div>
                        <div  class="col-md-auto col-auto mb-2 my-bottm-btn">
                            <a class="" style="display:inline-block !important; height: 40px !important;"  href="https://account.kheloindia.gov.in/#/login?appId=1rLVbeYW5u">KIC Login</a>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
               </div>
               </form>

         </div>
      </div>
    </div>

  </div>
 <a href="https://fitindia.gov.in/" class="back-home-pg">< back to Home</a>

</section>
<div style="padding-top:50px;"></div>

<script>

jQuery('#reload').click(function () {
    jQuery.ajax({
    type: 'GET',
    url: "<?php echo e(route('reloadCaptcha')); ?>",
    success: function (data) {
		jQuery(".captchaimg span").html(data.captcha);
    }
    });
});
</script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\fitindiaweb_gitnew\resources\views/admin/login.blade.php ENDPATH**/ ?>