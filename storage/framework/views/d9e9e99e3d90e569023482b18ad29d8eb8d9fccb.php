<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-trophy-outline"></i>
              </span> <?php echo e($page_title); ?> </h3>


    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">


                <div class="card-body">


                    <?php echo $__env->make('errors.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Event</th>
                            <th scope="col">Tournament</th>
                            <th scope="col" class="w-15p">Total Predict Amount</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">Closed Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$mac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-label="SL"><?php echo e(++$k); ?></td>
                                <td data-label="Event"><?php echo e($mac->name); ?></td>
                                <td data-label="Tournament">
                                    <strong><?php echo e(($mac->event) ? $mac->event->name : 'N/A'); ?></strong>
                                </td>


                                <td data-label="Total Predict Amount">
                                    <strong><?php echo e($mac->totalBetInvests()); ?> <?php echo e($basic->currency); ?></strong>
                                </td>

                                <td data-label="STATUS">

                                    <label class="badge badge-gradient-<?php echo e($mac->status ==2 ? 'danger' : 'success'); ?>"><?php echo e($mac->status == 2 ? 'Closed' : 'Active'); ?></label>
                                </td>

                                <td data-label="Closed Time">
                                    <?php echo e(Carbon\carbon::parse($mac->end_date)->format('d M Y H:i A')); ?>

                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>





                </div>
                <div class="card-footer">
                    <?php echo $matches->links(); ?>

                </div>
            </div>
        </div>


    </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/event/closed-event.blade.php ENDPATH**/ ?>