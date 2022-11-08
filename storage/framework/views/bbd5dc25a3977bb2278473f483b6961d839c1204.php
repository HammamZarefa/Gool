
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e($page_title); ?> | <?php echo e($basic->sitename); ?></title>

    <link rel="shortcut icon" href="<?php echo e(asset('images/logo/favicon.png')); ?>">
    <!-- End layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/vendor.bundle.base.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/custom.css')); ?>">
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper content-wrapper-form d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="<?php echo e(asset('images/logo/footer-logo.png')); ?>">
                </div>

                <h4 class="text-center"><?php echo e($page_title); ?></h4>

                <?php echo $__env->make('errors.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(session('ok')): ?>
                  <div class="alert alert-success alert-dismissible" >
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <?php echo e(session('ok')); ?>

                  </div>
                <?php endif; ?>


                <?php if(session('alert')): ?>
                  <div class="alert alert-danger alert-dismissible" >
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <?php echo e(session('alert')); ?>

                  </div>
                <?php endif; ?>




               <?php echo $__env->yieldContent('content'); ?>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="<?php echo e(asset('admin/js/vendor.bundle.base.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/off-canvas.js')); ?>"></script>

    <script src="<?php echo e(asset('admin/js/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/hoverable-collapse.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/misc.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/custom.js')); ?>"></script>

    <?php echo $__env->make('partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('script'); ?>
    <!-- endinject -->
  </body>
</html>
<?php /**PATH D:\projects\Gool\resources\views/admin/form.blade.php ENDPATH**/ ?>