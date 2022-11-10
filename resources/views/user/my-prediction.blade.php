@extends('user')

@section('css')
    <link rel="stylesheet" href="{{asset('public/templates/css/custom-table.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

@stop
@section('content')
    <style>
        table {
            display: table;
            border-collapse: separate;
            box-sizing: border-box;
            text-indent: initial;
            border-spacing: 2px;
            border-color: grey;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        td {
            display: table-cell;
            vertical-align: inherit;
        }

        .invoice-tr:hover {
            background: #FFEB3B;
            cursor: pointer;
        }

        table, th, td {
            border: 1px solid black;
        }

        .filterform {
            background: #004c17;
            margin-top: 10px;
        }

        label {
            padding-left: 10px;
            color: white;
        }
    </style>
    <div class="filterform">
        <form action="{{route('invoice.search')}}" method="post">
            @csrf
            <label style="padding-left: 10px; color:white;">Date :</label>
            <input type="date" id="fromdate" name="from" value="2018-07-22"> /
            <input type="date" id="todate" name="to" value="{{Now()->format('Y-m-d')}}">
            <label style="padding-left: 10px; color:white;" width="29%">User :
                <span style="padding-left: 10px;">
                    <select name="user" size="1" class="hinput2" style="font-weight: 600;  font-size: 14px;height: 25px;">
                        <option value="{{auth()->id()}}">My Account</option>
                        @foreach($users as $users)
                            <option value="{{$users->id}}">{{$users->username}}</option>
                        @endforeach
                    </select>
                </span>
            </label>
            <label style="padding-left: 10px; color:white;" width="45%" align="left">Filter :
                <select name="filter" size="1" class="hinput2" style="font-weight: 600;  font-size: 14px;height: 25px;">
                    <option value="All">All Bets</option>
                    <option value="Proccessing">Bets that can be paid</option>
                    <option value="Win">Only winning bets</option>
                    <option value="Lose">Only lost bets</option>
                    <option value="Proccessing">Only open bets</option>
                </select>
            </label>
            <br>
            <label>Ticket No:</label>
            <input type="text" id="ticket"
                   style="border-style:solid; border-width:0; width: 120px; height:20px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; font-size: 14px; font-weight: 600;"
                   name="ticket">
            <button type="submit" style="font-weight: 600; font-size: 14px; height: 25px;width: 100px;">List</button>
        </form>
    </div>
    <div class=" shadow-bg ">
        <div class="container">
            <div class="row py-2">
                <div class="col-md-12">
                    <div class="table-custom">
                        <table class="table">
                            <thead>
                            <tr class="result-table-header"
                                style="font-family: sans-serif; font-weight: 600; color: white; background:#191919 ">
                                {{--<th scope="col">#@lang('Invoice ID')</th>--}}
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
                                <tr class="invoice-tr" data-invoice-id="{{$data->id}}" id="{{$data->id}}"
                                    onclick="test(this.id)" {{$data->status!="Lose" ? 'style=color:#069e32' : 'style=color:#e60202'}}>
                                    {{--<td scope="row">{{$data->id}}</td>--}}
                                    <td data-label="@lang('Date')">{{date('d/m/Y',strtotime($data->date))}}</td>
                                    <td>{{date('h:i a',strtotime($data->date))}}</td>
                                    <td data-label="@lang('Bet Type')" class=" font-weight-bold">bet({{count($data->bets->where('result','!=',0))}}/{{count($data->bets)}})</td>
                                    <td data-label="@lang('Amount')" class=" font-weight-bold">{{$data->amount}}</td>
                                    <td data-label="@lang('Total Win')">{{$data->status!="Lose" ? $data->possible_win : "-"}}</td>
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
                        {{--{{@$logs->links()}}--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function test(id) {
            window.location.href = "/user/invoicebets/" + id;
        }
    </script>

@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
