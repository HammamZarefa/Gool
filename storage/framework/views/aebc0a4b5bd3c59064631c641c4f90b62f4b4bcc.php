<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-email "></i>
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
                                <a href="<?php echo e(route('sms-setting')); ?>" class="btn btn-sm btn-outline-success <?php if(Request::routeIs('sms-setting')): ?> active <?php endif; ?>">
                                   SMS Settings
                                </a>
                            </div>

                        </div>
                    </h4>

                    <?php echo $__env->make('errors.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <table class="table ">
                        <thead>
                        <tr>
                            <th> CODE </th>
                            <th> DESCRIPTION </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> <pre>[[name]]</pre> </td>
                            <td> Users Name. Will Pull From Database and Use in EMAIL text</td>
                        </tr>

                        <tr>
                            <td> <pre>[[message]]</pre> </td>
                            <td> Details Text From Script</td>
                        </tr>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">
                        Email Template
                    </h4>

                    <form role="form" method="POST" action="" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-body">
                            <div class="form-group">
                                <label>Email Sent Form</label>
                                <input type="email" name="esender" class="form-control input-lg" value="<?php echo e($temp->esender); ?>">
                            </div>

                            <div class="form-group">
                                <label>Email Message</label>
                                <textarea class="form-control" name="emessage" id="summernote" rows="10">
									<?php echo e($temp->emessage); ?>

								</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gradient-success btn-block">Update</button>
                        </div>
                    </form>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/sms-mail/mail.blade.php ENDPATH**/ ?>