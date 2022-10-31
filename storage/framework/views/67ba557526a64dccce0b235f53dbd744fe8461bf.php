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
                        Money Transfer ( Send )

                    </h4>


                          <table class="table ">
                              <thead>
                              <tr>
                                  <th scope="col"><?php echo app('translator')->get('SL'); ?></th>
                                  <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                                  <th scope="col"> <?php echo app('translator')->get('Amount'); ?></th>
                                  <th scope="col"> <?php echo app('translator')->get('Charge'); ?></th>
                                  <th scope="col"><?php echo app('translator')->get('Time'); ?></th>
                              </tr>
                              </thead>
                              <tbody>

                              <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr class="result-table-tr">
                                      <td data-label="<?php echo app('translator')->get('SL'); ?>"><?php echo e(++$k); ?></td>
                                      <td data-label="<?php echo app('translator')->get('Username'); ?>">
                                          <a href="<?php echo e(route('user.single',$data->transferTo->id)); ?>">
                                              <?php echo e($data->transferTo->username); ?>

                                          </a>
                                      </td>
                                      <td data-label="<?php echo app('translator')->get('Amount'); ?>"><?php echo e(number_format($data->amount,2)); ?> <?php echo e($basic->currency); ?></td>
                                      <td data-label="<?php echo app('translator')->get('Charge'); ?>"><?php echo e(number_format($data->charge,2)); ?> <?php echo e($basic->currency); ?></td>
                                      <td data-label="<?php echo app('translator')->get('Time'); ?>"><?php echo e(date('d M Y h:i A',strtotime($data->created_at))); ?></td>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/users/transfer-send.blade.php ENDPATH**/ ?>