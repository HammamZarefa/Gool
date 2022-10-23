<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--   contact section start    -->
    <div class="contact-section">
        <div class="container">
            <!--  contact form and map start  -->
            <div class="contact-form-section smoke-bg py-5 px-3">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <form action="<?php echo e(route('login')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <?php if(session()->has('status')): ?>
                                <div class="col-md-12">
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <span class="error"><?php echo e(session()->get('status')); ?></span>
                                        </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="form-element">
                                        <label for="username" class="font-weight-bold text-white"><?php echo app('translator')->get('Username'); ?></label>
                                        <input type="text" name="username" placeholder="<?php echo app('translator')->get('Username'); ?>" >
                                        <?php if($errors->has('username')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('username')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-element">
                                        <label for="password" class="font-weight-bold text-white"><?php echo app('translator')->get('Password'); ?></label>
                                        <input type="password" name="password" placeholder="<?php echo app('translator')->get('Password'); ?>" >
                                        <?php if($errors->has('password')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-element">
                                        <button type="submit" class="btn btn-block"><span><?php echo app('translator')->get('Sign In'); ?></span></button>
                                    </div>
                                    <a href="<?php echo e(route('password.request')); ?>"><?php echo app('translator')->get('Forget Password'); ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  contact form and map end  -->
        </div>
    </div>
    <!--   contact section end    -->
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/auth/login.blade.php ENDPATH**/ ?>