<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
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
                  <div class="float-right">
                    <?php echo $__env->make('admin.settings.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                  </h4>

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                              <form class="forms-sample" role="form" action="<?php echo e(route('admin.profile')); ?>" method="post" enctype="multipart/form-data">
                              <?php echo csrf_field(); ?>



                                <div class="form-group row">
                                  <label for="name" class="col-sm-3 col-form-label">Profile Picture</label>
                                  <div class="col-sm-9">
                                  <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <?php if($admin->image == null): ?>
                                            <div class="fileinput-new thumbnail w-215 h-215"  data-trigger="fileinput">
                                                <img class="w-215" src="<?php echo e(asset('images/user/user-default.jpg')); ?>/" alt="...">
                                            </div>
                                        <?php else: ?>
                                            <div class="fileinput-new thumbnail w-215 h-215" data-trigger="fileinput">
                                                <img class="w-215" src="<?php echo e(asset('images/user/')); ?>/<?php echo e($admin->image); ?>" alt="...">
                                            </div>
                                        <?php endif; ?>

                                        <div class="fileinput-preview fileinput-exists thumbnail w-215 h-215"></div>
                                        <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                            <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                        </div>
                                    </div>

                                    <?php if($errors->has('image')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('image')); ?></p>
                                    <?php endif; ?>

                                  </div>
                                </div>


                                <div class="form-group row">
                                  <label for="name" class="col-sm-3 col-form-label">Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="name" value="<?php echo e($admin->name); ?>"   class="form-control" id="name" placeholder="Your Name">
                                    <?php if($errors->has('name')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('name')); ?></p>
                                    <?php endif; ?>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="username" class="col-sm-3 col-form-label">Username</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="username" value="<?php echo e($admin->username); ?>" class="form-control" id="username" placeholder="username">
                                    <?php if($errors->has('username')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('username')); ?></p>
                                    <?php endif; ?>
                                  </div>
                                </div>


                                <div class="form-group row">
                                  <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="email" value="<?php echo e($admin->email); ?>" class="form-control" id="email" placeholder="E-mail Address">
                                    <?php if($errors->has('email')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('email')); ?></p>
                                    <?php endif; ?>
                                  </div>
                                </div>


                                <div class="form-group row">
                                  <label for="mobile" class="col-sm-3 col-form-label">Mobile Number</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="mobile" value="<?php echo e($admin->mobile); ?>" class="form-control" id="mobile" placeholder="Mobile number">
                                  </div>
                                </div>



                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                      <button type="submit" class="btn btn-gradient-success btn-block">Update Profile</button>
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
<script src="<?php echo e(asset('admin/js/bootstrap-fileinput.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/settings/profile.blade.php ENDPATH**/ ?>