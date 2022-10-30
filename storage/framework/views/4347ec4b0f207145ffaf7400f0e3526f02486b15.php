<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-account-multiple-outline"></i>
              </span>  <?php echo e($page_title); ?> </h3>


    </div>

    <div class="row">

        <?php echo $__env->make('admin.users.user-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">



                <div class="card-body">
                    <h4 class="card-title mb-5">
                        Transaction
                    </h4>


                          <table class="table ">
                              <thead>
                              <tr>
                                  <th scope="col">SL</th>
                                  <th scope="col">Details</th>
                                  <th scope="col">Amount</th>
                                  <th scope="col">Remaining Balance</th>
                                  <th scope="col">Time</th>
                              </tr>
                              </thead>
                              <tbody>

                              <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                      <td data-label="SL">
                                          <?php echo e(++$k); ?>

                                      </td>
                                      <td data-label="Details"><p><?php echo $data->title ?></p></td>
                                      <td data-label="Amount">

                                          <?php if($data->type == '+'): ?> <strong class="text-success"> +  <?php echo e($data->amount); ?> <?php echo e($basic->currency); ?></strong>
                                          <?php elseif($data->type == '-'): ?> <strong class="text-danger"> -  <?php echo e($data->amount); ?> <?php echo e($basic->currency); ?></strong>
                                          <?php elseif($data->type == '*'): ?> <strong class="text-info"> -  <?php echo e($data->amount); ?> <?php echo e($basic->currency); ?></strong>
                                          <?php endif; ?>
                                      </td>
                                      <td data-label="Remaining Balance">

                                             <strong><?php echo e($data->main_amo); ?> <?php echo e($basic->currency); ?></strong></td>
                                      <td data-label="Time"><?php echo e(date('d M, Y h:i A',strtotime($data->created_at))); ?> </td>
                                  </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              </tbody>
                          </table>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/users/transaction.blade.php ENDPATH**/ ?>