<?php $__env->startSection('load-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/bootstrap-fileinput.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    

    <!--   contact section start    -->
    <div class="contact-section ">
        <div class="container">
            <!--  contact form and map start  -->
            <div class="contact-form-section">
                <div class="row justify-content-center">
                    <div class="col-lg-12">

                        <div class=" smoke-bg p-5 px-3">

                        <form method="POST" action="" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row ">

                                <div class="col-sm-3">
                                    <div class="form-element">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <?php if(Auth::user()->image == null): ?>
                                                <div class="fileinput-new thumbnail w-215 h-215"data-trigger="fileinput">
                                                    <img class="w-215"
                                                         src="<?php echo e(asset('images/user/user-default.jpg')); ?>/"
                                                         alt="...">
                                                </div>
                                            <?php else: ?>
                                                <div class="fileinput-new thumbnail w-215 h-215" data-trigger="fileinput">
                                                    <img class="w-215"
                                                         src="<?php echo e(asset('images/user/')); ?>/<?php echo e(Auth::user()->image); ?>"
                                                         alt="...">
                                                </div>
                                            <?php endif; ?>

                                            <div class="fileinput-preview fileinput-exists thumbnail w-215 h-215"></div>
                                            <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                                class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                                class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                                                   data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                            </div>
                                        </div>

                                        <?php if($errors->has('image')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('image')); ?></p>
                                        <?php endif; ?>
                                    </div>

                                </div>

                                <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-6">
                                           <div class="form-element">
                                               <label for="first_name" class="font-weight-bold  text-white"><?php echo app('translator')->get('First Name'); ?></label>
                                               <input type="text" name="first_name" placeholder="<?php echo app('translator')->get('First Name'); ?>" value="<?php echo e($user->first_name); ?>">
                                               <?php if($errors->has('first_name')): ?>
                                                   <span class="text-danger"><?php echo e(__($errors->first('first_name'))); ?></span>
                                               <?php endif; ?>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-element">
                                               <label for="last_name" class="font-weight-bold  text-white"><?php echo app('translator')->get('Last Name'); ?></label>
                                               <input type="text" name="last_name" placeholder="<?php echo app('translator')->get('Last Name'); ?>" value="<?php echo e($user->last_name); ?>">
                                               <?php if($errors->has('last_name')): ?>
                                                   <span class="text-danger"><?php echo e(__($errors->first('last_name'))); ?></span>
                                               <?php endif; ?>
                                           </div>
                                       </div>

                                       <div class="col-md-6">
                                           <div class="form-element">
                                               <label for="username" class="font-weight-bold  text-white"><?php echo app('translator')->get('Username'); ?></label>
                                               <input type="text" name="username" placeholder="<?php echo app('translator')->get('Username'); ?>" value="<?php echo e($user->username); ?>">
                                               <?php if($errors->has('username')): ?>
                                                   <span class="text-danger"><?php echo e(__($errors->first('username'))); ?></span>
                                               <?php endif; ?>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-element">
                                               <label for="city" class="font-weight-bold  text-white"><?php echo app('translator')->get('City'); ?></label>
                                               <input type="text" name="city" placeholder="<?php echo app('translator')->get('City'); ?>" value="<?php echo e($user->city); ?>">
                                               <?php if($errors->has('city')): ?>
                                                   <span class="text-danger"><?php echo e(__($errors->first('city'))); ?></span>
                                               <?php endif; ?>
                                           </div>
                                       </div>

                                       <div class="col-md-6">
                                           <div class="form-element">
                                               <label for="zip_code" class="font-weight-bold  text-white"><?php echo app('translator')->get('Zip Code'); ?></label>
                                               <input type="text" name="zip_code" placeholder="<?php echo app('translator')->get('Zip Code'); ?>" value="<?php echo e($user->zip_code); ?>">
                                               <?php if($errors->has('zip_code')): ?>
                                                   <span class="text-danger"><?php echo e(__($errors->first('zip_code'))); ?></span>
                                               <?php endif; ?>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-element">
                                               <label for="address" class="font-weight-bold  text-white"><?php echo app('translator')->get('Address'); ?></label>
                                               <input type="text" name="address" placeholder="<?php echo app('translator')->get('Address'); ?>"
                                                      value="<?php echo e($user->address); ?>">
                                               <?php if($errors->has('address')): ?>
                                                   <span class="text-danger"><?php echo e(__($errors->first('address'))); ?></span>
                                               <?php endif; ?>
                                           </div>
                                       </div>


                                   </div>
                                </div>


                            </div>


                            <div class="row mt-4">

                                <div class="col-md-12">
                                    <div class="form-element">
                                        <button type="submit" class="btn btn-block"><span><?php echo app('translator')->get('Submit'); ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--  contact form and map end  -->
        </div>
    </div>
    <!--   contact section end    -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('load-js'); ?>
    <script src="<?php echo e(asset('admin/js/bootstrap-fileinput.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/user/profile.blade.php ENDPATH**/ ?>