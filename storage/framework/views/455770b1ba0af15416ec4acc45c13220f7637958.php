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
                                <th scope="col"><?php echo app('translator')->get('Trx'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Payment Method'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="result-table-tr">
                                    <td  data-label="<?php echo app('translator')->get('SL'); ?>"><?php echo e(++$k); ?></td>
                                    <td  data-label="#<?php echo app('translator')->get('Trx'); ?>"><?php echo e($data->trx); ?></td>
                                    <td  data-label="<?php echo app('translator')->get('Payment Method'); ?>"><?php echo e($data->myGatewayCurrency->name); ?></td>
                                    <td  data-label="<?php echo app('translator')->get('Amount'); ?>"><?php echo e(formatter_money($data->amount)); ?> <?php echo e(__($basic->currency)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                        <?php if($data->status == 2): ?>
                                            <label class="badge badge-warning"><i class="fa fa-spinner"></i> <?php echo app('translator')->get('Pending'); ?> </label>
                                        <?php elseif($data->status == 1): ?>
                                            <label class="badge badge-success"><i class="fa fa-check"></i> <?php echo app('translator')->get('Complete'); ?> </label>
                                        <?php elseif($data->status == -2): ?>
                                            <label class="badge badge-danger"><i class="fa fa-close"></i> <?php echo app('translator')->get('Rejected'); ?> </label>
                                        <?php endif; ?>
                                    </td>

                                    <td data-label="<?php echo app('translator')->get('Time'); ?>">
                                        <?php echo e(date('d M, Y h:i A',strtotime($data->created_at))); ?>

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

<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/user/deposit/log.blade.php ENDPATH**/ ?>