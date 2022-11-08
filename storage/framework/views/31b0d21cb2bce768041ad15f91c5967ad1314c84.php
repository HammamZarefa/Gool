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
                        Prediction Log
                    </h4>


                    <div class="table">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('SL'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Event'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Question'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Threat'); ?></th>
                                <th scope="col"> <?php echo app('translator')->get('Predict Amount'); ?></th>
                                <th scope="col"> <?php echo app('translator')->get('Return Amount'); ?></th>
                                <th scope="col"> <?php echo app('translator')->get('Available Balance'); ?></th>
                                <th scope="col"> <?php echo app('translator')->get('Ratio'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Predict Time'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Result Time'); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="result-table-tr">
                                    <td data-label="<?php echo app('translator')->get('SL'); ?>"><?php echo e(++$k); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Match'); ?>"><?php echo e($data->match->name); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Question'); ?>"><?php echo e($data->ques->question); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Threat'); ?>"><?php echo e($data->betoption->option_name); ?> </td>
                                    <td data-label="<?php echo app('translator')->get('Predict Amount'); ?>"><?php echo e($data->invest_amount); ?> <?php echo e(__($basic->currency)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Return Amount'); ?>"><?php echo e($data->return_amount); ?> <?php echo e(__($basic->currency)); ?>

                                        <br>
                                        <?php if($data->status  == 1): ?>  <span class="badge badge-danger">(<?php echo app('translator')->get('Charge'); ?>
                                            : <?php echo e($data->charge); ?>  <?php echo e(__($basic->currency)); ?>)  </span> <?php endif; ?></td>
                                    <td data-label="<?php echo app('translator')->get('Available Balance'); ?>">
                                        <?php if($data->remaining_balance != null): ?>
                                            <?php echo e(round($data->remaining_balance,2)); ?> <?php echo e(__($basic->currency)); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Ratio'); ?>"><?php echo e($data->ratio); ?></td>

                                    <td data-label="<?php echo app('translator')->get('Status'); ?>">

                                        <?php if($data->status  == 1): ?>
                                            <label class="badge badge-gradient-success"><?php echo app('translator')->get('Win'); ?></label>
                                        <?php elseif($data->status  == -1): ?>
                                            <label class="badge badge-gradient-danger"><?php echo app('translator')->get('Lose'); ?></label>
                                        <?php elseif($data->status  == 2): ?>
                                            <label class="badge badge-gradient-primary"><?php echo app('translator')->get('Refunded'); ?></label>
                                        <?php else: ?>
                                            <label class="badge badge-gradient-warning"><?php echo app('translator')->get('Processing'); ?></label>
                                        <?php endif; ?>
                                    </td>

                                    <td data-label="<?php echo app('translator')->get('Predict Time'); ?>">
                                        <?php echo e(date('h:i A',strtotime($data->created_at))); ?>

                                    </td>

                                    <td data-label="<?php echo app('translator')->get('Result Time'); ?>">
                                        <?php if($data->status  == 0): ?>
                                            <label class="badge badge-gradient-warning"><?php echo app('translator')->get('Processing'); ?></label>
                                        <?php else: ?>
                                            <?php echo e(date('d M Y h:i A',strtotime($data->updated_at))); ?>

                                        <?php endif; ?>

                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="card-footer">
                    <?php echo e($logs->links()); ?>

                </div>
            </div>
        </div>


    </div>







<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\Gool\resources\views/admin/users/predictions.blade.php ENDPATH**/ ?>