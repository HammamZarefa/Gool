<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-image-album"></i>
              </span> <?php echo e($page_title); ?> </h3>


    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <form class="forms-sample" role="form" action="" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>



                                <div class="form-group row">
                                    <label for="blog_title" class="col-sm-3 col-form-label">Section title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="blog_title" value="<?php echo e($basic->blog_title); ?>"   class="form-control" id="blog_title" placeholder=" title">
                                        <?php if($errors->has('blog_title')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('blog_title')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="blog_subtitle" class="col-sm-3 col-form-label">Section Sub title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="blog_subtitle" value="<?php echo e($basic->blog_subtitle); ?>"   class="form-control" id="blog_subtitle" placeholder="Sub title">
                                        <?php if($errors->has('blog_subtitle')): ?>
                                            <p class="text-danger"><?php echo e($errors->first('blog_subtitle')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-gradient-success btn-block">Save </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title mb-5">
                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Basic">
                                <a href="<?php echo e(route('admin.blog.create')); ?>"
                                   class="btn btn-sm btn-outline-success   active ">
                                    <i class="mdi mdi-plus-circle"></i> Add New
                                </a>
                            </div>
                        </div>
                    </h4>

                    <?php echo $__env->make('errors.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>





                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td data-label="Image">
                                        <img src="<?php echo e(asset('images/blog/'.$data->image)); ?>" alt="<?php echo e($data->title); ?>"></td>
                                    <td data-label="Title"><?php echo e($data->title); ?></td>

                                    <td  data-label="Action">
                                        <a href="<?php echo e(route('admin.blog.edit',[$data->id])); ?>"
                                                class="btn btn-gradient-info btn-rounded btn-icon  pt-12">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-gradient-danger btn-rounded btn-icon edit_button"
                                                data-toggle="modal" data-target="#myModal"
                                                data-act="DELETE"
                                                data-id="<?php echo e($data->id); ?>">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>


    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="action_act"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="<?php echo e(route('admin.blog.delete')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">


                        <p>Are you want to delete?</p>

                        <input class="form-control action_id" type="hidden" name="id">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn  btn-gradient-danger">Delete</button>

                    <button type="button" class="btn btn-gradient-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>




<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            $(document).on("click", '.edit_button', function (e) {

                var id = $(this).data('id');
                var act = $(this).data('act');

                $(".action_id").val(id);
                $(".action_act").text(act);

            });
        });

    })(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/blog/index.blade.php ENDPATH**/ ?>