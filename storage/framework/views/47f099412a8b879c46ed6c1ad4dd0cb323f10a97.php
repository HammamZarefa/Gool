<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-account-multiple-outline"></i>
              </span> <?php echo e($page_title); ?> </h3>


    </div>

    <div class="row">

        <?php echo $__env->make('admin.users.user-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">


                <div class="card-body">
                    <h4 class="card-title mb-5">
                        Manage Balance
                    </h4>

                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form class="forms-sample" role="form" action="<?php echo e(route('user.balance.update',[$user->id])); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>




                                <div class="form-group row">
                                    <label for="operation" class="col-sm-3 col-form-label">Operation</label>
                                    <div class="col-sm-9">

                                        <select name="operation" id="operation" class="form-control">
                                            <option value="on">  Add Balance</option>
                                            <option value="off">Subtract Balance</option>
                                        </select>
                                        <?php if($errors->has('operation')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('operation')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>





                                <div class="form-group row">
                                    <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="amount" class="form-control" value="<?php echo e(old('amount')); ?>" id="amount" placeholder="Amount">
                                        <?php if($errors->has('amount')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('amount')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="message" class="col-sm-3 col-form-label">Message </label>
                                    <div class="col-sm-9">
                                        <textarea name="message" id="message" rows="5" class="form-control" placeholder="Message"><?php echo e(old('message')); ?></textarea>
                                        <?php if($errors->has('message')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('message')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-gradient-success btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('import-js'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/users/balance.blade.php ENDPATH**/ ?>