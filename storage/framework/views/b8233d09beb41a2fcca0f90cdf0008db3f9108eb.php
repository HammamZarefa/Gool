<?php $__env->startSection('content'); ?>
    

    <!--   contact section start    -->
    <div class="faq-section">
        <div class="container">
            <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <form action="<?php echo e(route('money.transfer')); ?>" method="post" class=" smoke-bg p-5">
                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <div class="col-md-12">
                                    <h4 class="text-center text-white"><?php echo app('translator')->get('Fill up below the instruction'); ?></h4>
                                    <h6 class="text-center text-info"><?php echo app('translator')->get('Limit'); ?> : <?php echo e($basic->min_transfer); ?> -<?php echo e($basic->max_transfer); ?> <?php echo e($basic->currency); ?></h6>
                                    <h6 class="text-center text-info"><?php echo app('translator')->get('Charge'); ?> : <?php echo e($basic->transfer_charge); ?> %</h6>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-element">
                                        <label for="email" class="font-weight-bold text-white"><?php echo app('translator')->get('Email Address'); ?></label>
                                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->get('Email Address'); ?>" >

                                        <?php if($errors->has('email')): ?>
                                            <span class="text-danger"><?php echo e(__($errors->first('email'))); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-element">
                                        <label for="amount" class="font-weight-bold text-white"><?php echo app('translator')->get('Amount'); ?></label>
                                        <input type="text" name="amount" placeholder="0.00" value="<?php echo e(old('amount')); ?>"
                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                        <?php if($errors->has('amount')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('amount')); ?></span>
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
                                    <div class="form-element mt-3">
                                        <button type="submit" class="btn btn-block"><span><?php echo app('translator')->get('Submit'); ?></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
    <!--   contact section end    -->
<?php $__env->stopSection(); ?>




<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/user/money-transfer.blade.php ENDPATH**/ ?>