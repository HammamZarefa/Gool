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

                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <form class="forms-sample" role="form" action="" method="post"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>


                                <div class="form-group row">
                                    <div class="col-md-3 offset-md-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail w-215 h-215" data-trigger="fileinput">
                                                        <img class="w-215"
                                                             src="<?php echo e(asset('images/logo/logo.png')); ?>/"
                                                             alt="...">
                                                    </div>

                                                    <div class="fileinput-preview fileinput-exists thumbnail w-215 h-215"></div>
                                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                                class="fa fa-file-image-o"></i> Select logo</span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                                class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="logo" accept="image/*">
                                                </span>
                                                        <a href="#"
                                                           class="btn btn-danger fileinput-exists bold uppercase"
                                                           data-dismiss="fileinput"><i class="fa fa-trash"></i>
                                                            Remove</a>
                                                    </div>
                                                </div>

                                                <br>
                                                <code>Logo must be png, size 210 *60 px</code>

                                                <?php if($errors->has('logo')): ?>
                                                    <p class="text-danger"><?php echo e($errors->first('logo')); ?></p>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3 ">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail w-215 h-215" data-trigger="fileinput">
                                                        <img class="w-215"
                                                             src="<?php echo e(asset('images/logo/footer-logo.png')); ?>/"
                                                             alt="...">
                                                    </div>

                                                    <div class="fileinput-preview fileinput-exists thumbnail w-215 h-215"></div>
                                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                                class="fa fa-file-image-o"></i> Select footer logo</span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                                class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="footer-logo" accept="image/*">
                                                </span>
                                                        <a href="#"
                                                           class="btn btn-danger fileinput-exists bold uppercase"
                                                           data-dismiss="fileinput"><i class="fa fa-trash"></i>
                                                            Remove</a>
                                                    </div>
                                                </div>

                                                <br>
                                                <code>Logo must be png, size 210 *60 px</code>

                                                <?php if($errors->has('logo')): ?>
                                                    <p class="text-danger"><?php echo e($errors->first('logo')); ?></p>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail w-215 h-215" data-trigger="fileinput">
                                                        <img class="w-215 h-215"
                                                             src="<?php echo e(asset('images/logo/favicon.png')); ?>/"
                                                             alt="...">
                                                    </div>

                                                    <div class="fileinput-preview fileinput-exists thumbnail h-215 w-215"></div>
                                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                                class="fa fa-file-image-o"></i> Select favicon</span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                                class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="favicon" accept="image/*">
                                                </span>
                                                        <a href="#"
                                                           class="btn btn-danger fileinput-exists bold uppercase"
                                                           data-dismiss="fileinput"><i class="fa fa-trash"></i>
                                                            Remove</a>
                                                    </div>
                                                </div>

                                                <?php if($errors->has('favicon')): ?>
                                                    <p class="text-danger"><?php echo e($errors->first('favicon')); ?></p>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label">Site Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sitename" value="<?php echo e($basic->sitename); ?>"
                                               class="form-control" id="title" placeholder="Site Name">
                                        <?php if($errors->has('sitename')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('sitename')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="<?php echo e($basic->email); ?>" class="form-control"
                                               id="email" placeholder="Email Address">
                                        <?php if($errors->has('email')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('email')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Contact Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" value="<?php echo e($basic->phone); ?>" class="form-control"
                                               id="phone" placeholder="Contact Number">
                                        <?php if($errors->has('phone')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('phone')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Address </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" value="<?php echo e($basic->address); ?>"
                                               class="form-control" id="address" placeholder="Address">
                                        <?php if($errors->has('address')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('address')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="footer_about" class="col-sm-3 col-form-label">Footer About </label>
                                    <div class="col-sm-9">
                                        <textarea name="footer_about" id="footer_about" class="form-control"
                                                  rows="10"><?php echo e($basic->footer_about); ?></textarea>
                                        <?php if($errors->has('footer_about')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('footer_about')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="meta_keywords" class="col-sm-3 col-form-label">Meta keywords </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_keywords" value="<?php echo e($basic->meta_keywords); ?>"
                                               class="form-control" id="meta_keywords" placeholder="Meta Keywords">
                                        <?php if($errors->has('meta_keywords')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('meta_keywords')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="meta_description" class="col-sm-3 col-form-label">Meta
                                        Description </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_description" value="<?php echo e($basic->meta_description); ?>"
                                               class="form-control" id="meta_description"
                                               placeholder="Meta Description">
                                        <?php if($errors->has('meta_description')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('meta_description')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-gradient-success btn-block">Save</button>
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


<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/controls/create.blade.php ENDPATH**/ ?>