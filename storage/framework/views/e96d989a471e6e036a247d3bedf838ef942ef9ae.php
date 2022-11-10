<?php $__env->startSection('content'); ?>
    

    <!--   contact section start    -->
    <div class="contact-section">
        <div class="container">
            <!--  contact form and map start  -->
            <div class="contact-form-section smoke-bg py-5 px-3">
                <div class="row justify-content-center">
                    <div class="col-lg-8">


                        <form method="POST" action="">
                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-element">
                                        <label for="current_password" class="font-weight-bold text-white"><?php echo app('translator')->get('Current Password'); ?></label>
                                        <input type="password" name="current_password" placeholder="<?php echo app('translator')->get('Current Password'); ?>" >

                                        <?php if($errors->has('current_password')): ?>
                                            <span class="text-danger"><?php echo e(__($errors->first('current_password'))); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-element">
                                        <label for="password" class="font-weight-bold  text-white"><?php echo app('translator')->get('New Password'); ?></label>
                                        <input type="password" name="password" placeholder="<?php echo app('translator')->get('New Password'); ?>" >
                                        <?php if($errors->has('password')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-element">
                                        <label for="password_confirmation" class="font-weight-bold  text-white"><?php echo app('translator')->get('Re Password'); ?></label>
                                        <input type="password" name="password_confirmation" placeholder="<?php echo app('translator')->get('Re Password'); ?>" >
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="form-element">
                                        <button type="submit" class="btn btn-block"><span><?php echo app('translator')->get('Submit'); ?></span></button>
                                    </div>
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




<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/user/password.blade.php ENDPATH**/ ?>