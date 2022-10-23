<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('templates/css/deposit.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>

    </style>

    

    <div class="faq-section ">
        <div class="container">


            <div class="row">


                <div class="col-md-12 mb-4">

                    <div class="panel-body bg-white" >
                        <h4 class="title"><?php echo app('translator')->get('Make Deposit Request Via Payment Method'); ?></h4>

                        <div class="row">

                            <?php $__currentLoopData = $gatewayCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6 ">
                                    <label for="<?php echo e(str_slug($data->name)); ?>"
                                           class="method <?php echo e(str_slug($data->name)); ?> m-2">
                                        <div class="card-logos">
                                            <img src="<?php echo e(asset('images/gateways/'.$data->image)); ?>"
                                                 id="<?php echo e(str_slug($data->name)); ?>" class="w-40p"/>
                                        </div>

                                        <div class="radio-input">
                                            <input id="<?php echo e(str_slug($data->name)); ?>" type="radio"
                                                   data-id="<?php echo e($data->id); ?>"
                                                   data-min_amount="<?php echo e(round($data->min_amount,2)); ?>"
                                                   data-max_amount="<?php echo e(round($data->max_amount,2)); ?>"
                                                   data-percent_charge="<?php echo e(round($data->percent_charge,2)); ?>"
                                                   data-fixed_charge="<?php echo e(round($data->fixed_charge,2)); ?>"
                                                   name="payment">
                                            <?php echo app('translator')->get('Deposit Via'); ?> <?php echo e($data->name); ?>

                                        </div>
                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>


                        <div class="row ">


                            <div class="col-md-6 ">

                                    <div class="card-body my-5">

                                        <span class="deposit-limit text-danger"></span><br>
                                        <span class="deposit-charge  text-danger"></span>
                                        <div class="form-row align-items-center ">
                                            <div class="col-auto">
                                                <div class="md-form">
                                                    <label for="Amount" class="font-weight-bold"> <?php echo app('translator')->get('Enter Amount'); ?></label>
                                                    <input type="text" class="form-control amount mb-2" placeholder="0.00"
                                                           onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                                    <label class="sr-only" for="inlineFormInputMD">Amount</label>

                                                </div>
                                            </div>


                                            <div class="col-auto">
                                                <div class="md-form ">
                                                    <button type="button" class="btn btn-dark  mt-4 request-button">Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>

                            <div class="col-md-6 ">

                                <div class="card-body my-5 result-show">

                                </div>
                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>




<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/axios.min.js')); ?>"></script>

    <script>

        (function ($) {
            "use strict";

            $(document).ready(function () {

                var gatewayId = null;
                $('.deposit-limit').hide();
                $('.deposit-charge').hide();

                $('.method').on('click', function () {
                    $('.method').removeClass('blue-border');
                    $('.method').find('input[name="payment"]').prop('checked', false);
                    $(this).addClass('blue-border');
                    $(this).find('input[name="payment"]').prop('checked', true);

                    var gateway = $(this).find('input[name="payment"]').data();
                    gatewayId = gateway.id;
                    $('.result-show').hide();

                    $(".deposit-limit").text(`<?php echo app('translator')->get('Deposit Limit:'); ?> ${gateway.min_amount} - ${gateway.max_amount} <?php echo e($basic->currency); ?> `)
                    $('.deposit-charge').text(`<?php echo app('translator')->get('Deposit Charge:'); ?> ${gateway.fixed_charge} <?php echo e($basic->currency); ?> + ${gateway.percent_charge} % `)
                    $('.deposit-limit').show()
                    $('.deposit-charge').show()
                });

                $('.amount').on('keypress', function () {
                    $('.result-show').hide();
                });

                $('.request-button').on('click', function () {
                    axios({
                        method: 'post',
                        url: '<?php echo e(route('make-request')); ?>',
                        data: {
                            gateway_id: gatewayId,
                            amount: $('.amount').val()
                        }
                    }).then(function (response) {

                        // Error Part
                        if (response.data.errors && 0 < response.data.errors.length) {
                            response.data.errors.forEach(function (item, index) {
                                var content = {};
                                content.message = item;
                                content.title = 'Warning!';
                                content.icon = 'fa fa-bell';

                                $.notify(content, {
                                    type: 'danger',
                                    placement: {
                                        from: 'top',
                                        align: 'right'
                                    },
                                    showProgressbar: true,
                                    time: 1000,
                                    delay: 4000,
                                });
                            });
                        } else {
                            if (response.data.success == true) {
                                var logs = response.data.logs;
                                if(1000 >logs.method_code){
                                    var route = "<?php echo e(route('deposit-confirm')); ?>";
                                }else{
                                    var route = "<?php echo e(route('deposit.manual.confirm')); ?>";
                                }


                                var output = `
                                    <ul class="list-group font-weight-bold text-center">
                                        <li class="list-group-item ">Payment Method : ${logs.method}</li>
                                        <li class="list-group-item ">${logs.amount}</li>
                                        <li class="list-group-item">${logs.conversion_rate}</li>
                                        <li class="list-group-item">${logs.in}</li>
                                        <li class="list-group-item">${logs.charge}</li>
                                        <li class="list-group-item">${logs.payable}</li>
                                        <li class="list-group-item">
                                            <a href="${route}" class="btn btn-success">Pay Now</a>
                                        </li>
                                    </ul>`;

                                $('.result-show').html(output)
                            } else {
                                $('.result-show').html(null)
                            }
                            $('.result-show').show();
                        }
                    });
                });

            });

        })(jQuery);


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/user/deposit/money.blade.php ENDPATH**/ ?>