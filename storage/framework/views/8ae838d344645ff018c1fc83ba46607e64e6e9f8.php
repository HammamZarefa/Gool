<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">
                       Update <?php echo e($user->username); ?>

                    </h4>
                    <h4 class="card-title mb-5">
                        Current Balance <?php echo e($user->balance); ?>

                    </h4>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form class="forms-sample" role="form" action="<?php echo e(route('user.users.update',$user->id)); ?>" method="post"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="first_name" value="<?php echo e($user->first_name); ?>" class="form-control"
                                               id="first_name" placeholder="First Name">
                                        <?php if($errors->has('first_name')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('first_name')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" value="<?php echo e($user->last_name); ?>" class="form-control" id="last_name"
                                               placeholder="Last Name">
                                        <?php if($errors->has('last_name')): ?>
                                            <p class="text-danger"></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                    
                                    
                                        
                                               
                                        
                                            
                                        
                                    
                                
                                
                                    
                                    
                                        
                                               
                                        
                                            
                                        
                                    
                                
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Add Balance</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="added_balance" value="0" class="form-control" id="balance"
                                               placeholder="balance">
                                        <?php if($errors->has('balance')): ?>
                                            <p class="text-danger"></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="<?php echo e($user->email); ?>" class="form-control" id="email"
                                               placeholder="Email Address">
                                        <?php if($errors->has('email')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('email')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-3 col-form-label">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" value="<?php echo e($user->phone); ?>" class="form-control" id="mobile"
                                               placeholder="Mobile number">
                                        <?php if($errors->has('phone')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('phone')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1" <?php echo e($user->ststus==1 ? 'selected' : ''); ?>  >Active</option>
                                            <option value="0" <?php echo e($user->ststus==0 ? 'selected' : ''); ?> >Blocked</option>
                                        </select>
                                        <?php if($errors->has('status')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('status')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-gradient-success btn-block">Update
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



<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/user/users/edit.blade.php ENDPATH**/ ?>