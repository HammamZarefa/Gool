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
                        Withdraw Log
                    </h4>


                          <table class="table ">
                              <thead>
                              <tr>
                                  <th scope="col">Username</th>
                                  <th scope="col">#TRX</th>
                                  <th scope="col">Gateway</th>
                                  <th scope="col">Amount</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Date</th>
                              </tr>
                              </thead>
                              <tbody>

                              <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                      <td data-label="Username">
                                          <a href="<?php echo e(route('user.single', $data->user->id)); ?>">
                                              <?php echo e($data->user->username); ?>

                                          </a>
                                      </td>

                                      <td data-label="#Trx"><?php echo e($data->transaction_id); ?></td>
                                      <td data-label="Gateway"><?php echo e($data->method->name); ?></td>
                                      <td data-label="Amount"><strong><?php echo e(number_format($data->amount, 2)); ?> <?php echo e($basic->currency); ?></strong></td>
                                      <td data-label="Status">
                                          <?php if($data->status == 2): ?>
                                              <span class="badge badge-gradient-success"> Completed </span>
                                          <?php elseif($data->status == -2): ?>
                                              <span class="badge badge-gradient-danger"> Refunded </span>
                                          <?php elseif($data->status == 1): ?>
                                              <span class="badge badge-gradient-warning"> Pending </span>

                                          <?php endif; ?>
                                      </td>

                                      <td data-label="Date">
                                          <?php echo e(date('d M,Y h:i A',strtotime($data->updated_at))); ?>

                                      </td>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/users/withdraw-log.blade.php ENDPATH**/ ?>