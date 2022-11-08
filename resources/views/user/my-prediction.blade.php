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
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Time')</th>
                                <th scope="col">@lang('Bet Type')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Total Win')</th>
                                <th scope="col">@lang('Slip No.')</th>
{{--                                <th scope="col">@lang('Print')</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($logs as $k=>$data)
                                <tr class="result-table-tr result-row" data-invoice-id="{{$data->id}}" id="{{$data->id}}" onclick="test(this.id)">
                                    <td scope="row">{{$data->id}}</td>
                                    <td data-label="@lang('Date')">{{date('d/m/Y',strtotime($data->date))}}</td>
                                    <td data-label="@lang('Time')">{{date('h:i a',strtotime($data->date))}}</td>
                                    <td data-label="@lang('Bet Type')" class=" font-weight-bold"></td>
                                    <td data-label="@lang('Amount')" class=" font-weight-bold">{{$data->amount}}</td>
                                    <td data-label="@lang('Total Win')"></td>
                                    <td data-label="@lang('Slip No.')">{{$data->coupon_id}}</td>
{{--                                    <td></td>--}}
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
function test(id){
    window.location.href = "/user/home/"+id;
}
</script>

@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
