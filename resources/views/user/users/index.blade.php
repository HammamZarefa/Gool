@extends('user')
@section('import-css')
@stop
{{--@section('css')--}}
    {{--<link rel="stylesheet" href="{{asset('public/templates/css/custom-table.css')}}">--}}
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>--}}
    {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>--}}
    {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>--}}

{{--@stop--}}
{{--@section('content')--}}
    {{--<div class=" shadow-bg ">--}}
        {{--<div class="container">--}}
            {{--<div class="row py-2">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="table-custom">--}}
                        {{--<table class="table table-striped">--}}
                            {{--<thead >--}}
                            {{--<tr class="result-table-header">--}}
                                {{--<th scope="col">#@lang('Username')</th>--}}
                                {{--<th scope="col">@lang('Full Name')</th>--}}
                                {{--<th scope="col">@lang('Balance')</th>--}}
                                {{--<th scope="col">@lang('Action')</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@forelse($users as $user)--}}
                                {{--<tr class="result-table-tr result-row" data-invoice-id="{{$user->id}}">--}}
                                    {{--<td data-label="@lang('Username')">{{$user->username }}</td>--}}
                                    {{--<td data-label="@lang('Full Name')">{{$user->first_name .' '.$user->last_name}}</td>--}}
                                    {{--<td data-label="@lang('Balance')" class=" font-weight-bold">{{$user->balance}} {{__($basic->currency)}}</td>--}}
                                    {{--<td data-label="@lang('Action')">--}}
                                        {{--@if($data->result  == 1)--}}
                                            {{--<label class="badge badge-success">@lang('Win')</label>--}}
                                        {{--@elseif($data->result  == -1)--}}
                                            {{--<label class="badge badge-danger">@lang('Lose')</label>--}}
                                        {{--@elseif($data->result  == 2)--}}
                                            {{--<label class="badge badge-primary">@lang('Refunded')</label>--}}
                                        {{--@else--}}
                                            {{--<label class="badge badge-warning">@lang('Processing')</label>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    {{--<td></td>--}}
                                {{--</tr>--}}
                            {{--@empty--}}
                                {{--<tr class="result-table-tr">--}}
                                    {{--<td colspan="8">@lang('No Data Found!')</td>--}}
                                {{--</tr>--}}
                            {{--@endforelse--}}

                            {{--</tbody>--}}
                        {{--</table>--}}

                    {{--</div>--}}

                    {{--<div class="pagination-nav ">--}}
                        {{--{{$logs->links()}}--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<script>--}}
        {{--const last_request = {};--}}
        {{--async function request(endpoint, callback, with_spinner=true, error_callback=null){--}}

            {{--if (with_spinner) {--}}
                {{--$('.loading-spinner').removeClass('d-none');--}}
                {{--$('.loading-spinner').addClass('d-flex');--}}
            {{--}--}}

            {{--const api = `/api/${endpoint}`;--}}

            {{--if (last_request[endpoint])--}}
                {{--last_request[endpoint].abort();--}}

            {{--last_request[endpoint] = $.ajax({--}}
                {{--url:api,--}}
                {{--success:function(result){--}}
                    {{--callback(result);--}}
                    {{--delete last_request[endpoint];--}}
                    {{--if (!Object.keys(last_request).length) {--}}
                        {{--$('.loading-spinner').addClass('d-none');--}}
                        {{--$('.loading-spinner').removeClass('d-flex');--}}
                    {{--}--}}
                {{--},--}}
                {{--error: function(request, status, error){--}}
                    {{--if (typeof error_callback === 'function')--}}
                        {{--error_callback(request, status, error);--}}
                    {{--delete last_request[endpoint];--}}
                    {{--if (!Object.keys(last_request).length) {--}}
                        {{--$('.loading-spinner').addClass('d-none');--}}
                        {{--$('.loading-spinner').removeClass('d-flex');--}}
                    {{--}--}}
                {{--}--}}
            {{--})--}}

            {{--await last_request[endpoint];--}}
        {{--}--}}

        {{--$(function (){--}}
            {{--$(".result-row").hide();--}}
            {{--let invoice_id = [];--}}
            {{--$('.result-row').each(function(index, item){--}}
                {{--item = $(item);--}}

                {{--if (index === 0) {--}}
                    {{--item.show();--}}
                    {{--return;--}}
                {{--}--}}

                {{--if (!invoice_id.includes(item.data('invoice-id'))) {--}}
                    {{--item.find('td').last().remove();--}}
                    {{--const print_button = $(`<td id='print-${item.data('invoice-id')}' class="d-flex justify-content-center align-items-center h-100"><button class='btn btn-success text-dark'>Print</button></td>`);--}}
                    {{--item.append(print_button);--}}
                    {{--item.show();--}}
                    {{--invoice_id.push(item.data('invoice-id'));--}}
                    {{--const rows = $(`tr[data-invoice-id="${item.data('invoice-id')}"]`);--}}

                    {{--print_button.on('click', async function(){--}}
                        {{--let paid_amount = 0.0;--}}
                        {{--let return_amount = 0.0;--}}
                        {{--$(this).attr('disabled', true);--}}
                        {{--let user_data = {};--}}
                        {{--await request('user', function(result){--}}
                            {{--user_data = result;--}}
                        {{--}, true);--}}
                        {{--await request(`invoice?invoice_id=${item.data('invoice-id')}`, function(result){--}}
                            {{--const m = new Date();--}}
                            {{--let currency = '{{App\GeneralSettings::first()->currency}}';--}}
                            {{--let table_data = '';--}}
                            {{--$.each(result, function(index, bet){--}}
                                {{--paid_amount += parseFloat(bet.predict_amount);--}}
                                {{--return_amount += parseFloat(bet.return_amount);--}}
                                {{--table_data += `--}}
                             {{--<div class="container mb-3">--}}
                                {{--<div class="d-flex flex-column border border-2 border-dark p-2">--}}
                                    {{--<div class="d-flex w-100 justify-content-between">--}}
                                        {{--<span class="text-dark fw-bolder">${bet.league_name}</span>--}}
                                        {{--<span class="text-dark fw-bolder">${bet.match_date} ${bet.match_time}</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="d-flex w-100 justify-content-between">--}}
                                        {{--<span class="text-dark fw-bolder">${bet.home_team} vs ${bet.away_team}</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="d-flex w-100 justify-content-between">--}}
                                        {{--<span class="text-dark fw-bolder">main bet: ${bet.bet_value}</span>--}}
                                        {{--<span class="text-dark fw-bolder">${bet.return_amount}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--`;--}}
                            {{--});--}}

                            {{--const dateString =--}}
                                {{--m.getUTCFullYear() + "/" +--}}
                                {{--("0" + (m.getUTCMonth()+1)).slice(-2) + "/" +--}}
                                {{--("0" + m.getUTCDate()).slice(-2) + " " +--}}
                                {{--("0" + m.getUTCHours()).slice(-2) + ":" +--}}
                                {{--("0" + m.getUTCMinutes()).slice(-2) + ":" +--}}
                                {{--("0" + m.getUTCSeconds()).slice(-2);--}}

                            {{--$("#invoice").remove();--}}
                            {{--$("#modal-body").append($(`--}}
                                {{--<div id="invoice">--}}
                                    {{--<div class="container mb-3">--}}
                                        {{--<div class="d-flex flex-column border border-2 border-dark p-2 bg-light">--}}
                                            {{--<div class="d-flex w-100 justify-content-between">--}}
                                                {{--<span class="text-dark fw-bolder">اسم المستخدم:</span>--}}
                                                {{--<span class="text-dark fw-bolder">${user_data.id}</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="d-flex w-100 justify-content-between">--}}
                                                {{--<span class="text-dark fw-bolder">معرف الكوبون:</span>--}}
                                                {{--<span class="text-dark fw-bolder">${item.data('invoice-id')}</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="d-flex w-100 justify-content-between">--}}
                                                {{--<span class="text-dark fw-bolder">تاريخ:</span>--}}
                                                {{--<span class="text-dark fw-bolder">${dateString}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--${table_data}--}}

                                    {{--<div class="container mb-3">--}}
                                        {{--<div class="d-flex flex-column border border-2 border-dark p-2 bg-light">--}}
                                            {{--<div class="d-flex w-100 justify-content-between">--}}
                                                {{--<span class="text-dark fw-bolder"المبلغ:</span>--}}
                                                {{--<span class="text-dark fw-bolder">${paid_amount.toFixed(2)} ${currency}</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="d-flex w-100 justify-content-between">--}}
                                                {{--<span class="text-dark fw-bolder">ارقام زوجيه:</span>--}}
                                                {{--<span class="text-dark fw-bolder">1620470</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="d-flex w-100 justify-content-center">--}}
                                                {{--<span class="text-dark fw-bolder">${return_amount.toFixed(2)} ${currency}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                    {{--`));--}}
                            {{--const modal = $('#invoice-modal');--}}
                            {{--modal.modal('show');--}}
                        {{--});--}}
                        {{--$("#final-print").on('click', function(){--}}
                            {{--w = window.open();--}}
                            {{--w.document.write(`--}}
                        {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>--}}
                    {{--`);--}}
                            {{--w.document.write(document.getElementById("invoice").innerHTML);--}}
                            {{--setTimeout(function(){--}}
                                {{--w.print()--}}
                                {{--w.close();--}}
                            {{--}, 100);--}}

                        {{--})--}}
                        {{--$(this).attr('disabled', false);--}}
                    {{--});--}}

                    {{--rows.mouseenter(function(){--}}
                        {{--rows.addClass('bg-warning');--}}
                        {{--rows.show();--}}

                    {{--});--}}

                    {{--rows.mouseleave(function(){--}}
                        {{--rows.removeClass('bg-warning');--}}
                        {{--rows.hide();--}}
                        {{--item.show();--}}
                    {{--});--}}
                {{--}--}}
            {{--});--}}

            {{--// $.each($('tr'), function(item, index){--}}
            {{--//     console.log(item.data('invoice-id'));--}}
            {{--// });--}}

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

            {{--// $("tr").mouseleave(function(){--}}
            {{--//     const invoice_id = $(this).data('invoice-id');--}}
            {{--//     $(`#print-${invoice_id}`).remove();--}}
            {{--// });--}}
        {{--});--}}
    {{--</script>--}}
@section('content')

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-account-multiple-outline"></i>
              </span>  Users </h3>
    </div>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="input-group-append">
                        <a class="kmenu"  href="{{route('user.users.create')}}" style="background:#1dcfb4 "> Create New</a>
                    </div>
                    <h4 class="card-title mb-5">
                        <div class="row justify-content-end">
                            <div class="col-4">
                                <form action="{{route('search.users')}}" method="get">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" value="{{@$search}}" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-gradient-success" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </h4>



                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td data-label="Name">{{$user->name}}</td>
                                <td data-label="Username"> <strong>{{$user->username}} </strong></td>
                                <td data-label="Mobile">{{$user->phone}}</td>
                                <td data-label="Balance">{{$user->balance}} {{$basic->currency}}</td>
                                <td data-label="Status">
                                    @if($user->status == 1)
                                        <label class="badge badge-gradient-success">Active</label>
                                    @else
                                        <label class="badge badge-gradient-danger">Blocked</label>
                                    @endif
                                </td>
                                <td  data-label="Details">
                                    <a href="{{route('user.users.edit', $user->id)}}"
                                       data-tooltip-content="User Details"
                                       class="btn btn-gradient-success btn-sm btn-rounded btn-icon pt-12 tooltip-styled">

                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>





                </div>
                {{--<div class="card-footer">--}}
                    {{--{{$users->appends(['search'=>@$search])->links()}}--}}
                {{--</div>--}}
            </div>
        </div>


    </div>




@endsection





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
