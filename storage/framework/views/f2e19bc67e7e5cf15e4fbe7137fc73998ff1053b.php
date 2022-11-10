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

        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">
                        New Profile Settings
                    </h4>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form class="forms-sample" role="form" action="<?php echo e(route('user.store')); ?>"
                                  method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="first_name" value=""
                                               class="form-control" id="first_name" placeholder="First Name">
                                        <?php if($errors->has('first_name')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('first_name')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" value=""
                                               class="form-control" id="last_name" placeholder="Last Name">
                                        <?php if($errors->has('last_name')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('last_name')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="username" value=""
                                               class="form-control" id="username" placeholder="Username">
                                        <?php if($errors->has('username')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('username')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="" class="form-control"
                                               id="email" placeholder="Email Address">
                                        <?php if($errors->has('email')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('email')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                                        <?php if($errors->has('new_password')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('new_password')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                                        <?php if($errors->has('password_confirmation')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('password_confirmation')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="balance" class="col-sm-3 col-form-label">Balance</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="balance" class="form-control" value="<?php echo e(old('balance')); ?>" id="balance" placeholder="Balance">
                                        <?php if($errors->has('balance')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('balance')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-3 col-form-label">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" value="" class="form-control"
                                               id="mobile" placeholder="Mobile number">
                                        <?php if($errors->has('phone')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('phone')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" value=""
                                               class="form-control" id="address" placeholder="Address">
                                        <?php if($errors->has('address')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('address')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="city" value="" class="form-control"
                                               id="city" placeholder="City">
                                        <?php if($errors->has('city')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('city')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zip_code" class="col-sm-3 col-form-label">Zip</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="zip_code" value=""
                                               class="form-control" id="zip_code" placeholder="Zip code">
                                        <?php if($errors->has('zip_code')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('zip_code')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zip_code" class="col-sm-3 col-form-label">Country</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="country" value=""
                                               class="form-control" id="country" placeholder="Country">
                                        <?php if($errors->has('country')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('country')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Can add users</label>
                                    <div class="col-sm-9">
                                        <select name="is_admin" id="is_admin" class="form-control">
                                            <option selected disabled>choose one</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <?php if($errors->has('status')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('is_admin')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-gradient-success btn-block">Create
                                        </button>
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



<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/users/create.blade.php ENDPATH**/ ?>