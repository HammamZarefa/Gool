<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-account-circle "></i>
              </span> <?php echo e($page_title); ?> </h3>
    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title mb-5">
                        <?php echo e($page_title); ?>

                    </h4>
                    <form class="forms-sample" role="form" action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row ">
                            <div class="col">
                                <div class="form-group">
                                    <label for="currency" class="font-weight-bold">Site Currency</label>
                                    <input type="text" name="currency" value="<?php echo e($basic->currency); ?>" class="form-control" id="currency" placeholder="Currency" required>
                                    <?php if($errors->has('currency')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('currency')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="currency_sym" class="font-weight-bold"> Currency Symbol</label>
                                    <input type="text" name="currency_sym" value="<?php echo e($basic->currency_sym); ?>" class="form-control" id="currency_sym" placeholder="Currency Symbol" required>
                                    <?php if($errors->has('currency_sym')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('currency_sym')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="decimal" class="font-weight-bold"> After Decimal </label>

                                    <div class="input-group">
                                        <input type="text" name="decimal" value="<?php echo e($basic->decimal); ?>" class="form-control" id="decimal" placeholder="After Decimal" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-gradient-success text-white "><?php echo e(number_format(0,$basic->decimal)); ?></span>
                                        </div>
                                    </div>
                                    <?php if($errors->has('decimal')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('decimal')); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>



                        </div>


                        <div class="row mt-3">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="win_charge" class="font-weight-bold"> Prediction Winning Charge</label>

                                    <div class="input-group">
                                        <input type="text" name="win_charge" value="<?php echo e($basic->win_charge); ?>" class="form-control" id="win_charge" placeholder="Winning Charge" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-gradient-success text-white ">%</span>
                                        </div>
                                    </div>
                                    <?php if($errors->has('win_charge')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('win_charge')); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="transfer_charge" class="font-weight-bold"> Balance Transfer Charge</label>
                                    <div class="input-group">
                                        <input type="text" name="transfer_charge" value="<?php echo e($basic->transfer_charge); ?>" class="form-control" id="transfer_charge" placeholder="Transfer Charge" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-gradient-success text-white ">%</span>
                                        </div>
                                    </div>
                                    <?php if($errors->has('transfer_charge')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('transfer_charge')); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="min_transfer" class="font-weight-bold"> Minimum Amount Transfer</label>

                                    <div class="input-group">
                                        <input type="text" name="min_transfer" value="<?php echo e($basic->min_transfer); ?>" class="form-control" id="min_transfer" placeholder="Minimum Transfer" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-gradient-success text-white "><?php echo e($basic->currency); ?></span>
                                        </div>
                                    </div>
                                    <?php if($errors->has('min_transfer')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('min_transfer')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="max_transfer" class="font-weight-bold"> Maximum Amount Transfer</label>

                                    <div class="input-group">
                                        <input type="text" name="max_transfer" value="<?php echo e($basic->max_transfer); ?>" class="form-control" id="max_transfer" placeholder="Maximum Transfer" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-gradient-success text-white "><?php echo e($basic->currency); ?></span>
                                        </div>
                                    </div>
                                    <?php if($errors->has('max_transfer')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('max_transfer')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>



                        </div>

                        <div class="row mt-3">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="status" class="font-weight-bold">Withdraw System</label>
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="withdraw_status" class="form-check-input" <?php if($basic->withdraw_status == 1): ?> checked <?php endif; ?>>  Enabled <i class="input-helper"></i><i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="registration" class="font-weight-bold">User Registration</label>
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="registration" class="form-check-input" <?php if($basic->registration == 1): ?> checked <?php endif; ?>>  Enabled <i class="input-helper"></i><i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="email_verification" class="font-weight-bold">Email Verification</label>
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="email_verification" class="form-check-input" <?php if($basic->email_verification == 1): ?> checked <?php endif; ?>>  Enabled <i class="input-helper"></i><i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="email_notification" class="font-weight-bold">Email Notification</label>
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="email_notification" class="form-check-input" <?php if($basic->email_notification == 1): ?> checked <?php endif; ?>>  Enabled <i class="input-helper"></i><i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sms_verification" class="font-weight-bold">SMS Verification</label>
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="sms_verification" class="form-check-input" <?php if($basic->sms_verification == 1): ?> checked <?php endif; ?>>  Enabled <i class="input-helper"></i><i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sms_notification" class="font-weight-bold">SMS Notification</label>
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="sms_notification" class="form-check-input" <?php if($basic->sms_notification == 1): ?> checked <?php endif; ?>>  Enabled <i class="input-helper"></i><i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>



                        </div>


                        <div class="form-group row mt-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-gradient-success btn-block">Update</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/controls/settings.blade.php ENDPATH**/ ?>