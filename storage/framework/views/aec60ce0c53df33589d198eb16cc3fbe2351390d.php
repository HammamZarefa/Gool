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
                        Login Logs
                    </h4>


                          <table class="table ">
                              <thead>
                              <tr>
                                  <th scope="col">User</th>
                                  <th scope="col">IP</th>
                                  <th scope="col">Location</th>
                                  <th scope="col">Browser</th>
                                  <th scope="col">Operating System</th>
                                  <th scope="col">country</th>
                                  <th scope="col">Time</th>
                              </tr>
                              </thead>
                              <tbody>

                              <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                      <td data-label="Username"><a href="<?php echo e(route('user.single',$log->user->id)); ?>"><?php echo e($log->user->name); ?></a></td>
                                      <td data-label="User IP"><?php echo e($log->user_ip); ?></td>
                                      <td data-label="User Location"><?php echo e($log->location); ?></td>
                                      <td data-label="Browser"><?php echo e($log->browser); ?></td>
                                      <td data-label="OS"><?php echo e($log->os); ?></td>
                                      <td data-label="country"><?php echo e($log->country); ?></td>
                                      <td data-label="Time"><?php echo e($log->created_at->diffForHumans()); ?></td>
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


<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\Gool\resources\views/admin/users/login-logs.blade.php ENDPATH**/ ?>