<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e($page_title); ?> | <?php echo e($basic->sitename); ?></title>

    <link rel="shortcut icon" href="<?php echo e(asset('images/logo/favicon.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/file.min.css')); ?>">
    <?php echo $__env->yieldContent('import-css'); ?>
    <?php echo $__env->yieldContent('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/custom.css')); ?>">
  </head>
  <body>

    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('images/logo/logo.png')); ?>" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('images/logo/logo.png')); ?>" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">

                  <?php if(Auth::guard('admin')->user()->image == null): ?>

                  <img src="<?php echo e(asset('images/user/user-default.jpg')); ?>" alt="profile">
                  <?php else: ?>
                  <img src="<?php echo e(asset('images/user/')); ?>/<?php echo e(Auth::guard('admin')->user()->image); ?>" alt="profile">
                  <?php endif; ?>

                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo e(Auth::guard('admin')->user()->username); ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">
                  <i class="mdi mdi-cached mr-2 text-success"></i> Settings </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>


          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
       <?php echo $__env->make('admin.layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

          <?php echo $__env->yieldContent('content'); ?>

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo e(date('Y')); ?> <strong><?php echo e($basic->sitename); ?></strong>. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>


    <script src="<?php echo e(asset('admin/js/file.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('import-js'); ?>

    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('script'); ?>
    <?php echo $__env->yieldPushContent('js'); ?>

  </body>
</html>
<?php /**PATH D:\projects\Gool\resources\views/admin/layout/master.blade.php ENDPATH**/ ?>