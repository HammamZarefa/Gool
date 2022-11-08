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
                                <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Bet Type'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Total Win'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Slip No.'); ?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="result-table-tr result-row" data-invoice-id="<?php echo e($data->id); ?>" id="<?php echo e($data->id); ?>" onclick="test(this.id)">
                                    <td scope="row"><?php echo e($data->id); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Date'); ?>"><?php echo e(date('d/m/Y',strtotime($data->date))); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Time'); ?>"><?php echo e(date('h:i a',strtotime($data->date))); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Bet Type'); ?>" class=" font-weight-bold"></td>
                                    <td data-label="<?php echo app('translator')->get('Amount'); ?>" class=" font-weight-bold"><?php echo e($data->amount); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Total Win'); ?>"></td>
                                    <td data-label="<?php echo app('translator')->get('Slip No.'); ?>"><?php echo e($data->coupon_id); ?></td>

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
<script>
function test(id){
    window.location.href = "/user/home/"+id;
}
</script>

<?php $__env->stopSection(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\Gool\resources\views/user/my-prediction.blade.php ENDPATH**/ ?>