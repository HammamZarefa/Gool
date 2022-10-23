@extends('user')

@section('css')
    <link rel="stylesheet" href="{{asset('public/templates/css/custom-table.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

@stop
@section('content')
    {{--<div class="modal fade" id="invoice-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-dialog-scrollable">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<h5 class="modal-title">Invoices Modal</h5>--}}
                    {{--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                {{--</div>--}}
                {{--<div class="modal-body" id="modal-body">--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-primary" id="final-print" data-bs-dismiss="invoice-modal">Print</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="faq-section shadow-bg ">
        <div class="container">
            <div class="row py-2">
                <div class="col-md-12">
                    <div class="table-custom">
                        <table class="table table-striped">
                            <thead >
                            <tr class="result-table-header">
                                <th scope="col">#@lang('Invoice ID')</th>
                                <th scope="col">@lang('Event')</th>
                                <th scope="col">@lang('Prediction')</th>
                                <th scope="col">@lang('Predict Amount')</th>
                                <th scope="col">@lang('Return Amount')</th>
                                <th scope="col">@lang('Result')</th>
                                <th scope="col">@lang('Time')</th>
                                <th scope="col">@lang('Print')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($logs as $k=>$data)
                                <tr class="result-table-tr result-row" data-invoice-id="{{$data->invoice_id}}" data-win="{{$data->result === 1}}">
                                    <td scope="row">{{$data->invoice_id}}</td>
                                    <td data-label="@lang('Event')">{{$data->home_team . " - " . $data->away_team ?? '---' }}</td>
                                    <td data-label="@lang('Team')">{{$data->bet_value ?? '-'}}</td>
                                    <td data-label="@lang('Predict Amount')" class=" font-weight-bold">{{$data->predict_amount}} {{__($basic->currency)}}</td>
                                    <td data-label="@lang('Return Amount')" class=" font-weight-bold">{{$data->return_amount}} {{ __($basic->currency) }}</td>
                                    <td data-label="@lang('Result')">
                                        @if($data->result  == 1)
                                            <label class="badge badge-success">@lang('Win')</label>
                                        @elseif($data->result  == -1)
                                            <label class="badge badge-danger">@lang('Lose')</label>
                                        @elseif($data->result  == 2)
                                            <label class="badge badge-primary">@lang('Refunded')</label>
                                        @else
                                            <label class="badge badge-warning">@lang('Processing')</label>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Time')">
                                        {{date('d M, Y h:i A',strtotime($data->created_at))}}
                                    </td>
                                    <td></td>
                                </tr>

                            @empty
                                <tr class="result-table-tr">
                                    <td colspan="8">@lang('No Data Found!')</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>

                    </div>

                    <div class="pagination-nav ">
                        {{$logs->links()}}
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
                            let currency = '{{App\GeneralSettings::first()->currency}}';
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

            {{--$("tr").mouseenter(function(){--}}
            {{--    const invoice_id = $(this).data('invoice-id');--}}
            {{--    const last_row = $(`tr[data-invoice-id='${invoice_id}']`).last();--}}
            {{--    const print_button = $(`<td id='print-${invoice_id}' class="d-flex justify-content-center align-items-center"><button class='btn btn-success text-dark'>Print</button></td>`);--}}
            {{--    if ($(`#print-${invoice_id}`).length === 0)--}}
            {{--        last_row.append(print_button);--}}
            {{--        print_button.on('click', async function(){--}}
            {{--        let paid_amount = 0.0;--}}
            {{--        let return_amount = 0.0;--}}

            {{--        $(this).attr('disabled', true);--}}
            {{--        let user_data = {};--}}
            {{--        await request('user', function(result){--}}
            {{--            user_data = result;--}}
            {{--        }, true);--}}
            {{--        await request(`invoice?invoice_id=${invoice_id}`, function(result){--}}
            {{--            const m = new Date();--}}
            {{--            let currency = '{{App\GeneralSettings::first()->currency}}';--}}
            {{--            let table_data = '';--}}
            {{--            $.each(result, function(index, bet){--}}
            {{--                paid_amount += parseFloat(bet.predict_amount);--}}
            {{--                return_amount += parseFloat(bet.return_amount);--}}
            {{--                table_data += `--}}
            {{--                 <div class="container mb-3">--}}
            {{--                    <div class="d-flex flex-column border border-2 border-dark p-2">--}}
            {{--                        <div class="d-flex w-100 justify-content-between">--}}
            {{--                            <span class="text-dark fw-bolder">${bet.league_name}</span>--}}
            {{--                            <span class="text-dark fw-bolder">${bet.match_date} ${bet.match_time}</span>--}}
            {{--                        </div>--}}
            {{--                        <div class="d-flex w-100 justify-content-between">--}}
            {{--                            <span class="text-dark fw-bolder">${bet.home_team} vs ${bet.away_team}</span>--}}
            {{--                        </div>--}}
            {{--                        <div class="d-flex w-100 justify-content-between">--}}
            {{--                            <span class="text-dark fw-bolder">main bet: ${bet.bet_value}</span>--}}
            {{--                            <span class="text-dark fw-bolder">${bet.return_amount}</span>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            `;--}}
            {{--            });--}}

            {{--            const dateString =--}}
            {{--                m.getUTCFullYear() + "/" +--}}
            {{--                ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" +--}}
            {{--                ("0" + m.getUTCDate()).slice(-2) + " " +--}}
            {{--                ("0" + m.getUTCHours()).slice(-2) + ":" +--}}
            {{--                ("0" + m.getUTCMinutes()).slice(-2) + ":" +--}}
            {{--                ("0" + m.getUTCSeconds()).slice(-2);--}}

            {{--            $("#invoice").remove();--}}
            {{--            $("#modal-body").append($(`--}}
            {{--            <div id="invoice">--}}
            {{--                <div class="container mb-3">--}}
            {{--                    <div class="d-flex flex-column border border-2 border-dark p-2 bg-light">--}}
            {{--                        <div class="d-flex w-100 justify-content-between">--}}
            {{--                            <span class="text-dark fw-bolder">اسم المستخدم:</span>--}}
            {{--                            <span class="text-dark fw-bolder">${user_data.id}</span>--}}
            {{--                        </div>--}}
            {{--                        <div class="d-flex w-100 justify-content-between">--}}
            {{--                            <span class="text-dark fw-bolder">معرف الكوبون:</span>--}}
            {{--                            <span class="text-dark fw-bolder">${invoice_id}</span>--}}
            {{--                        </div>--}}
            {{--                        <div class="d-flex w-100 justify-content-between">--}}
            {{--                            <span class="text-dark fw-bolder">تاريخ:</span>--}}
            {{--                            <span class="text-dark fw-bolder">${dateString}</span>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            {{--                ${table_data}--}}

            {{--                <div class="container mb-3">--}}
            {{--                    <div class="d-flex flex-column border border-2 border-dark p-2 bg-light">--}}
            {{--                        <div class="d-flex w-100 justify-content-between">--}}
            {{--                            <span class="text-dark fw-bolder"المبلغ:</span>--}}
            {{--                            <span class="text-dark fw-bolder">${paid_amount.toFixed(2)} ${currency}</span>--}}
            {{--                        </div>--}}
            {{--                        <div class="d-flex w-100 justify-content-between">--}}
            {{--                            <span class="text-dark fw-bolder">ارقام زوجيه:</span>--}}
            {{--                            <span class="text-dark fw-bolder">1620470</span>--}}
            {{--                        </div>--}}
            {{--                        <div class="d-flex w-100 justify-content-center">--}}
            {{--                            <span class="text-dark fw-bolder">${return_amount.toFixed(2)} ${currency}</span>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        `));--}}
            {{--            const modal = $('#invoice-modal');--}}
            {{--            modal.modal('show');--}}
            {{--        })--}}
            {{--        $("#final-print").on('click', function(){--}}
            {{--            w = window.open();--}}
            {{--            w.document.write(`--}}
            {{--            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>--}}
            {{--        `);--}}
            {{--            w.document.write(document.getElementById("invoice").innerHTML);--}}
            {{--            setTimeout(function(){--}}
            {{--                w.print()--}}
            {{--                w.close();--}}
            {{--            }, 100);--}}

            {{--        })--}}
            {{--        $(this).attr('disabled', false);--}}
            {{--    });--}}
            {{--});--}}

            // $("tr").mouseleave(function(){
            //     const invoice_id = $(this).data('invoice-id');
            //     $(`#print-${invoice_id}`).remove();
            // });
        });
    </script>

@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
