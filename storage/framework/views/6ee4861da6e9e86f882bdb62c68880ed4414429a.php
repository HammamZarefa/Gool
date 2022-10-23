<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi  mdi-trophy-outline  "></i>
              </span> <?php echo e($page_title); ?> </h3>


    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">


                <div class="card-body">
                    <h4 class="card-title mb-5">
                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?php echo e(route('add.match')); ?>"
                                   class="btn btn-sm btn-outline-success <?php if(Request::routeIs('add.match')): ?> active <?php endif; ?>">
                                    <i class=" mdi mdi-plus "></i> Create Event
                                </a>
                            </div>
                        </div>


                    </h4>

                    <?php echo $__env->make('errors.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Tournament</th>
                            <th scope="col">Event Schedule</th>
                            <th scope="col">STATUS</th>
                            <th scope="col" class="w-18p">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$mac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-label="SL"><?php echo e(++$k); ?></td>
                                <td data-label="Name">
                                    <?php echo e($mac->name); ?><br>

                                    <?php if($mac->betInvests->sum('invest_amount') > 0): ?>
                                        <p class="text-danger">Predict Amount
                                            :<?php echo e(number_format($mac->betInvests->where('status','!=',2)->sum('invest_amount'),2)); ?> <?php echo e($basic->currency); ?></p>
                                    <?php endif; ?>
                                </td>

                                <td data-label="Tournament">
                                    <strong><?php echo e($mac->event->name); ?></strong>
                                </td>

                                <td data-label="Event Schedule">
                                    <?php echo e(date('d M y h:i A', strtotime($mac->start_date))); ?> <label class="badge  badge-gradient-info"> To </label>
                                    <?php echo e(date('d M y h:i A', strtotime($mac->end_date))); ?>

                                </td>


                                <td data-label="Status">
                                    <label class="badge  badge-gradient-<?php echo e($mac->status ==0 ? 'danger' : 'success'); ?>"><?php echo e($mac->status == 0 ? 'Deactive' : 'Active'); ?></label>
                                </td>
                                <td data-label="Action">
                                    <div class="template-demo d-flex  flex-nowrap">
                                        <a href="<?php echo e(route('edit.match', $mac->id )); ?>"
                                           class="btn btn-gradient-info btn-sm btn-rounded btn-icon pt-12 tooltip-styled"
                                           data-tooltip-content="Edit Event">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <?php
                                            $totalQuestions = $mac->questions()->count();
                                            $totalOptions = $mac->options()->count();
                                        ?>
                                        <a href="<?php echo e(route('view.question', $mac->id )); ?>"
                                           class="btn btn-gradient-primary btn-sm btn-rounded btn-icon text-decoration-none pt-12 tooltip-styled"
                                           data-tooltip-content=" Click To Add More Question">
                                            <?php if($totalQuestions < 10): ?>
                                            <?php echo  "<i class='mdi mdi-numeric-".$totalQuestions."-box'></i>"; ?>
                                            <?php else: ?>
                                                <span><?php echo e($totalQuestions); ?></span>
                                            <?php endif; ?>
                                        </a>


                                    </div>


                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>


                </div>
                <div class="card-footer">
                    <?php echo e($matches->links()); ?>

                </div>
            </div>
        </div>


    </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/event/index.blade.php ENDPATH**/ ?>