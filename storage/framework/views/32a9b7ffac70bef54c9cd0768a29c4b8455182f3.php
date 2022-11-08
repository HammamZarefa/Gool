<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('templates/css/custom-table.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    

    <div class="shadow-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-custom">
                        <table class="table table-striped">
                            <thead >
                            <tr class="result-table-header">
                                <th scope="col">#<?php echo app('translator')->get('SL'); ?></th>
                                <th scope="col" class="w-50"><?php echo app('translator')->get('Details'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Charge'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Remaining Balance'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr class="result-table-tr">
                                    <td data-label="#<?php echo app('translator')->get('SL'); ?>"><?php echo e(++$k); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Details'); ?>"><?php echo $data->title ?></td>
                                    <td data-label="<?php echo app('translator')->get('Amount'); ?>">
                                      <span class="font-weight-bold <?php if($data->type == '+'): ?> text-success <?php elseif($data->type == '-'): ?>  text-danger <?php elseif($data->type == '*'): ?> text-primary <?php endif; ?> ">
                                          <?php if($data->type == '+'): ?>+<?php elseif($data->type == '-'): ?>-<?php elseif($data->type == '*'): ?>+<?php endif; ?>
                                          <?php echo e($data->amount); ?> <?php echo e(__($basic->currency)); ?></span>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Charge'); ?>"><span class="font-weight-bold "><?php echo e($data->charge); ?> <?php echo e(__($basic->currency)); ?></span></td>
                                    <td data-label="<?php echo app('translator')->get('Remaining Balance'); ?>"><span class="font-weight-bold "><?php echo e($data->main_amo); ?> <?php echo e(__($basic->currency)); ?></span></td>


                                    <td data-label="<?php echo app('translator')->get('Time'); ?>">
                                        <?php echo e(date('d-m-y h:i A',strtotime($data->created_at))); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr class="result-table-tr">
                                        <td colspan="6"><?php echo app('translator')->get('No Data Found!'); ?></td>
                                    </tr>
                                <?php endif; ?>


                            </tbody>
                        </table>

                    </div>

                    <div class="pagination-nav ">
                        <?php echo e($logs->links()); ?>

                    </div>

                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\Gool\resources\views/user/transaction-log.blade.php ENDPATH**/ ?>