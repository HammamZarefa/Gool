<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/templates/css/custom-table.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
        
            
                
                    
                    
                
                
                
                
                    
                
            
        
    
    <div class="faq-section shadow-bg ">
        <div class="container">
            <div class="row py-2">
                <div class="col-md-12">
                    <div class="table-custom">
                        <table class="table table-striped">
                            <thead >
                            <tr class="result-table-header">
                                <th scope="col">#<?php echo app('translator')->get('Invoice ID'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Event'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Prediction'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Predict Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Return Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Result'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Print'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="result-table-tr result-row" data-invoice-id="<?php echo e($data->invoice_id); ?>" data-win="<?php echo e($data->result === 1); ?>">
                                    <td scope="row"><?php echo e($data->invoice_id); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Event'); ?>"><?php echo e($data->home_team . " - " . $data->away_team ?? '---'); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Team'); ?>"><?php echo e($data->bet_value ?? '-'); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Predict Amount'); ?>" class=" font-weight-bold"><?php echo e($data->predict_amount); ?> <?php echo e(__($basic->currency)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Return Amount'); ?>" class=" font-weight-bold"><?php echo e($data->return_amount); ?> <?php echo e(__($basic->currency)); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Result'); ?>">
                                        <?php if($data->result  == 1): ?>
                                            <label class="badge badge-success"><?php echo app('translator')->get('Win'); ?></label>
                                        <?php elseif($data->result  == -1): ?>
                                            <label class="badge badge-danger"><?php echo app('translator')->get('Lose'); ?></label>
                                        <?php elseif($data->result  == 2): ?>
                                            <label class="badge badge-primary"><?php echo app('translator')->get('Refunded'); ?></label>
                                        <?php else: ?>
                                            <label class="badge badge-warning"><?php echo app('translator')->get('Processing'); ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Time'); ?>">
                                        <?php echo e(date('d M, Y h:i A',strtotime($data->created_at))); ?>

                                    </td>
                                    <td></td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr class="result-table-tr">
                                    <td colspan="8"><?php echo app('translator')->get('No Data Found!'); ?></td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\Gool\resources\views/user/my-bet.blade.php ENDPATH**/ ?>