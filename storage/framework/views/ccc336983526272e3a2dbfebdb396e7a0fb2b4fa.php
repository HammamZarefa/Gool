<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php

    $page_title = '404';
    ?>

    <?php echo $__env->make('partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="error-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-txt">
                    <div class="oops">
                        <img src="<?php echo e(asset('templates/img/oops.png')); ?>" alt="">
                    </div>
                    <h2><?php echo app('translator')->get('Page Not Found'); ?></h2>
                    <a href="<?php echo e(url('/')); ?>" class="go-home-btn"><?php echo app('translator')->get('Back Home'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/errors/404.blade.php ENDPATH**/ ?>