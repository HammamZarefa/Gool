<?php $__env->startSection('import-css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-trophy-outline"></i>
              </span> Bet List</h3>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php echo $__env->make('errors.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Match Teams</th>
                            <th scope="col">Match Date</th>
                            <th scope="col">Predict Amount</th>
                            <th scope="col">Return Amount</th>
                            <th scope="col">Result</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $betting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr <?php if($bet->result == 1): ?> class="danger" <?php endif; ?>>
                                <td data-label="user"><?php echo e($bet->user->username); ?></td>
                                <td data-label="Event"><?php echo e($bet->home_team.' - '.$bet->away_team); ?></td>
                                <td data-label="Event"><?php echo e($bet->match_date .$bet->match_time); ?></td>
                                <td data-label="End Time"><?php echo e($bet->predict_amount); ?></td>
                                <td data-label="End Time"><?php echo e($bet->return_amount); ?></td>
                                <td data-label="End Time"><?php if($bet->result==0): ?> Proccessing <?php elseif($bet->result==1): ?> Win <?php elseif($bet->result==-1): ?> Lose <?php endif; ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>




<?php $__env->startSection('script'); ?>


    <script>
        (function ($) {
            "use strict";

            if ($("#timepicker-example").length) {
                $('#timepicker-example').datetimepicker({
                    format: 'LT'
                });
            }
            if ($("#datepicker-popup").length) {
                $('#datepicker-popup').datepicker({
                    enableOnReadonly: true,
                    todayHighlight: true,
                });
            }

            if ($("#timepicker-example2").length) {
                $('#timepicker-example2').datetimepicker({
                    format: 'LT'
                });
            }
            if ($("#datepicker-popup2").length) {
                $('#datepicker-popup2').datepicker({
                    enableOnReadonly: true,
                    todayHighlight: true,
                });
            }

            if ($(".datepicker-autoclose").length) {
                $('.datepicker-autoclose').datepicker({
                    autoclose: true
                });
            }

            $(document).ready(function () {
                $(document).on("click", '.edit_ques', function (e) {
                    var name = $(this).data('name');
                    var end_time = $(this).data('datetime');
                    var enddate = $(this).data('enddate');

                    var status = $(this).data('status');
                    var id = $(this).data('id');
                    var mid = $(this).data('mid');
                    var act = $(this).data('act');
                    var match_end_date = $(this).data('matchenddate');

                    $(".edit_id").val(id);
                    $(".edit_question").val(name);
                    $(".edit_time").val(end_time);
                    $(".edit_date").val(enddate);
                    $(".edit_match_id").val(mid);
                    $(".match_end_date").text(match_end_date);
                    $(".edit_status").val(status).attr('selected', 'selected');
                    $(".modal_act").text(act);

                });

                $(document).on("click", '.refund_bet', function (e) {
                    var id = $(this).data('id');
                    var mid = $(this).data('mid');
                    var act = $(this).data('act');

                    $(".r_id").val(id);
                    $(".r_match_id").val(mid);
                    $(".modal_act").text(act);

                });
            });

        })(jQuery);


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/admin/result/bet-list.blade.php ENDPATH**/ ?>