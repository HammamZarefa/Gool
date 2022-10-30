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
    <script>
        const last_request = {};
        async function request(endpoint, callback, with_spinner=true, error_callback=null){

            if (with_spinner) {
                $('.loading-spinner').removeClass('d-none');
                $('.loading-spinner').addClass('d-flex');
            }

            const api = `/api/${endpoint}`;

            if (last_request[endpoint])
                last_request[endpoint].abort();

            last_request[endpoint] = $.ajax({
                url:api,
                success:function(result){
                    callback(result);
                    delete last_request[endpoint];
                    if (!Object.keys(last_request).length) {
                        $('.loading-spinner').addClass('d-none');
                        $('.loading-spinner').removeClass('d-flex');
                    }
                },
                error: function(request, status, error){
                    if (typeof error_callback === 'function')
                        error_callback(request, status, error);
                    delete last_request[endpoint];
                    if (!Object.keys(last_request).length) {
                        $('.loading-spinner').addClass('d-none');
                        $('.loading-spinner').removeClass('d-flex');
                    }
                }
            })

            await last_request[endpoint];
        }

        $(function (){
            $(".result-row").hide();
            let invoice_id = [];
            $('.result-row').each(function(index, item){
                item = $(item);

                if (index === 0) {
                    item.show();
                    return;
                }

                if (!invoice_id.includes(item.data('invoice-id'))) {
                    item.find('td').last().remove();
                    const print_button = $(`<td id='print-${item.data('invoice-id')}' class="d-flex justify-content-center align-items-center h-100"><button class='btn btn-success text-dark'>Print</button></td>`);
                    item.append(print_button);
                    item.show();
                    invoice_id.push(item.data('invoice-id'));
                    const rows = $(`tr[data-invoice-id="${item.data('invoice-id')}"]`);

                    print_button.on('click', async function(){
                        let paid_amount = 0.0;
                        let return_amount = 0.0;
                        $(this).attr('disabled', true);
                        let user_data = {};
                        await request('user', function(result){
                            user_data = result;
                        }, true);
                        await request(`invoice?invoice_id=${item.data('invoice-id')}`, function(result){
                            const m = new Date();
                            let currency = '<?php echo e(App\GeneralSettings::first()->currency); ?>';
                            let table_data = '';
                            $.each(result, function(index, bet){
                                paid_amount += parseFloat(bet.predict_amount);
                                return_amount += parseFloat(bet.return_amount);
                                table_data += `
                             <div class="container mb-3">
                                <div class="d-flex flex-column border border-2 border-dark p-2">
                                    <div class="d-flex w-100 justify-content-between">
                                        <span class="text-dark fw-bolder">${bet.league_name}</span>
                                        <span class="text-dark fw-bolder">${bet.match_date} ${bet.match_time}</span>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <span class="text-dark fw-bolder">${bet.home_team} vs ${bet.away_team}</span>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <span class="text-dark fw-bolder">main bet: ${bet.bet_value}</span>
                                        <span class="text-dark fw-bolder">${bet.return_amount}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                            });

                            const dateString =
                                m.getUTCFullYear() + "/" +
                                ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" +
                                ("0" + m.getUTCDate()).slice(-2) + " " +
                                ("0" + m.getUTCHours()).slice(-2) + ":" +
                                ("0" + m.getUTCMinutes()).slice(-2) + ":" +
                                ("0" + m.getUTCSeconds()).slice(-2);

                            $("#invoice").remove();
                            $("#modal-body").append($(`
                                <div id="invoice">
                                    <div class="container mb-3">
                                        <div class="d-flex flex-column border border-2 border-dark p-2 bg-light">
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-dark fw-bolder">اسم المستخدم:</span>
                                                <span class="text-dark fw-bolder">${user_data.id}</span>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-dark fw-bolder">معرف الكوبون:</span>
                                                <span class="text-dark fw-bolder">${item.data('invoice-id')}</span>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-dark fw-bolder">تاريخ:</span>
                                                <span class="text-dark fw-bolder">${dateString}</span>
                                            </div>
                                        </div>
                                    </div>

                                    ${table_data}

                                    <div class="container mb-3">
                                        <div class="d-flex flex-column border border-2 border-dark p-2 bg-light">
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-dark fw-bolder"المبلغ:</span>
                                                <span class="text-dark fw-bolder">${paid_amount.toFixed(2)} ${currency}</span>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-dark fw-bolder">ارقام زوجيه:</span>
                                                <span class="text-dark fw-bolder">1620470</span>
                                            </div>
                                            <div class="d-flex w-100 justify-content-center">
                                                <span class="text-dark fw-bolder">${return_amount.toFixed(2)} ${currency}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    `));
                            const modal = $('#invoice-modal');
                            modal.modal('show');
                        });
                        $("#final-print").on('click', function(){
                            w = window.open();
                            w.document.write(`
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
                    `);
                            w.document.write(document.getElementById("invoice").innerHTML);
                            setTimeout(function(){
                                w.print()
                                w.close();
                            }, 100);

                        })
                        $(this).attr('disabled', false);
                    });

                    rows.mouseenter(function(){
                        rows.addClass('bg-warning');
                        rows.show();

                    });

                    rows.mouseleave(function(){
                        rows.removeClass('bg-warning');
                        rows.hide();
                        item.show();
                    });
                }
            });

            // $.each($('tr'), function(item, index){
            //     console.log(item.data('invoice-id'));
            // });

            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            

            // $("tr").mouseleave(function(){
            //     const invoice_id = $(this).data('invoice-id');
            //     $(`#print-${invoice_id}`).remove();
            // });
        });
    </script>

<?php $__env->stopSection(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Gool\resources\views/user/my-prediction.blade.php ENDPATH**/ ?>