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


                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?php echo e(route('admin.blog')); ?>"
                                   class="btn btn-sm btn-outline-success <?php if(Request::routeIs('admin.blog')): ?> active <?php endif; ?>">
                                    <i class=" mdi mdi-text "></i> All Blog
                                </a>
                            </div>

                        </div>
                    </h4>

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form class="forms-sample" role="form" action="" method="post"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>


                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label"> Image</label>
                                    <div class="col-sm-10">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail w-215 h-215" data-trigger="fileinput">
                                                <img class="w-215" src="<?php echo e(asset('images/user/default.jpg')); ?>/"
                                                     alt="...">
                                            </div>


                                            <div class="fileinput-preview fileinput-exists thumbnail w-215"></div>
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


                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control"
                                               id="title" placeholder="Title">
                                        <?php if($errors->has('title')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('title')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Details</label>
                                    <div class="col-sm-10">

                                        <textarea name="details" id="summernote" rows="20"><?php echo e(old('details')); ?></textarea>
                                        <?php if($errors->has('details')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('details')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
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



<?php $__env->startSection('script'); ?>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $('#summernote').summernote({
                    placeholder: 'Write Something...',
                    tabsize: 2,
                    height: 400
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/blog/create.blade.php ENDPATH**/ ?>