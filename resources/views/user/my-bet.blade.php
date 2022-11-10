@extends('user')

@section('css')
    <link rel="stylesheet" href="{{asset('public/templates/css/custom-table.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .filterform {
            background: #004c17;
            margin-top: 10px;
        }
        .betstable tr td{
            border: 1px solid black;
        }
    </style>
@stop
@section('content')
    <div class="filterform">
        <form action="{{route('invoice.search')}}" method="post">
            @csrf
            <label style="padding-left: 10px; color:white;">Date :</label>
            <input type="date" id="fromdate" name="from" value="2018-07-22"> /
            <input type="date" id="todate" name="to" value="{{Now()->format('Y-m-d')}}">
            <label style="padding-left: 10px; color:white;" width="29%">User :
                <span style="padding-left: 10px;">
                    <select name="user" size="1" class="hinput2"
                            style="font-weight: 600;  font-size: 14px;height: 25px;">
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
            <label style="padding-left: 10px; color:white;" width="29%">Ticket No:</label>
            <input type="text" id="ticket"
                   style="border-style:solid; border-width:0; width: 120px; height:20px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; font-size: 14px; font-weight: 600;"
                   name="ticket">
            <button type="submit" style="font-weight: 600; font-size: 14px; height: 25px;width: 100px;">List</button>
        </form>
    </div>
    {{--<div class=" shadow-bg ">--}}
        {{--<div class="container">--}}
            {{--<div class="row py-2">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="table-custom">--}}
                        {{--<table class="table table-striped">--}}
                            {{--<thead>--}}
                            {{--<tr class="result-table-header">--}}
                                {{--<th scope="col">#@lang('Invoice ID')</th>--}}
                                {{--<th scope="col">@lang('Event')</th>--}}
                                {{--<th scope="col">@lang('Prediction')</th>--}}
                                {{--<th scope="col">@lang('Predict Amount')</th>--}}
                                {{--<th scope="col">@lang('Return Amount')</th>--}}
                                {{--<th scope="col">@lang('Result')</th>--}}
                                {{--<th scope="col">@lang('Time')</th>--}}
                                {{--<th scope="col">@lang('Print')</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@forelse($logs as $k=>$data)--}}
                                {{--<tr class="result-table-tr result-row" data-invoice-id="{{$data->invoice_id}}"--}}
                                    {{--data-win="{{$data->result === 1}}">--}}
                                    {{--<td scope="row">{{$data->invoice_id}}</td>--}}
                                    {{--<td data-label="@lang('Event')">{{$data->home_team . " - " . $data->away_team ?? '---' }}</td>--}}
                                    {{--<td data-label="@lang('Team')">{{$data->bet_value ?? '-'}}</td>--}}
                                    {{--<td data-label="@lang('Predict Amount')"--}}
                                        {{--class=" font-weight-bold">{{$data->predict_amount}} {{__($basic->currency)}}</td>--}}
                                    {{--<td data-label="@lang('Return Amount')"--}}
                                        {{--class=" font-weight-bold">{{$data->return_amount}} {{ __($basic->currency) }}</td>--}}
                                    {{--<td data-label="@lang('Result')">--}}
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
                                    {{--<td data-label="@lang('Time')">--}}
                                        {{--{{date('d M, Y h:i A',strtotime($data->created_at))}}--}}
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
    <body bgcolor="#1D1D1D" style="margin: 0;">
    <div align="center">
        <table width="100%" id="table13" cellspacing="1" cellpadding="0"
               style="background-color: white;border-width: 0px;font-family: sans-serif; font-size: medium; font-weight: 600; font-size: 14px;">
            <tbody>
            <tr>
                <td>
                    <div align="center">
                        <table cellpadding="0" width="100%">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="100%" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td height="30" colspan="4">
                                                <table border="1" width="100%">
                                                    <tbody>
                                                    <tr>
                                                        <td width="78" height="40" align="center"
                                                            style="background-color: #ffc30c;"><a
                                                                    href="javascript:history.back();"><img border="0" src="{{asset('images/back2.png')}}"></a>
                                                        </td>
                                                        <td align="center" style="background-color: #ffc30c;">BETS DETAILS</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30" width="25%">&nbsp;&nbsp;Bet ID :</td>
                                            <td width="27%">&nbsp;{{$invoice->coupon_id}}</td>
                                            <td width="16%">&nbsp;Tot. Rate :</td>
                                            <td width="32%">&nbsp;{{$invoice->odds}}</td>
                                        </tr>
                                        <tr>
                                            <td height="30" width="25%">&nbsp;&nbsp;Amount :</td>
                                            <td width="27%">&nbsp;{{$invoice->amount}}&nbsp;</td>
                                            <td width="16%">&nbsp;Status :</td>
                                            <td width="32%">{{$invoice->status}}</td>
                                        </tr>
                                        <tr>
                                            <td height="30" width="25%">&nbsp;&nbsp;Tot. Win :</td>
                                            <td width="27%">&nbsp;{{$invoice->possible_win}}&nbsp;</td>
                                            <td width="16%">&nbsp;Player :</td>
                                            <td width="32%">{{$invoice->user->username}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width="100%" border="1" cellspacing="0" cellpadding="0" class="betstable">
                            <tbody>
                            <tr style="border-left-color: white; border-right-color: white;">
                                <td width="60" height="30" align="left">&nbsp;Code</td>
                                <td width="100" align="left">&nbsp;Date/Time</td>
                                <td width="320" align="left">&nbsp;Match</td>
                                <td width="260" align="center">Bet</td>
                                <td width="60" align="center">Rate</td>
                                <td>&nbsp;Detail</td>
                            </tr>
                            @foreach($logs as $log)
                            <tr style="border-left-color: white; border-right-color: white; {{$log->result!=-1 ? 'color: #0220bf;' : 'color: #da0202;'}}">
                                <td height="30" align="left">&nbsp;CM{{$log->id}}</td>
                                <td align="left">&nbsp;&nbsp;/&nbsp;</td>
                                <td align="left">&nbsp;{{$log->home_team}}&nbsp;-&nbsp;{{$log->away_team}}&nbsp;&nbsp;</td>
                                <td align="center">&nbsp;{{$log->bet_value}}</td>
                                <td align="center">&nbsp;{{$log->return_amount}}</td>
                                <td>&nbsp;{{$log->bet_type}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <table border="1" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="right" width="10">&nbsp;</td>
                                <td height="35" align="center"
                                    style="font-family:'Lucida Sans Unicode', 'Lucida Grande';  background: linear-gradient(to bottom, #edb70d 0%, #f9c30b 3%, #ffc80c 6%, #ffe20c 35%, #ffec0c 56%, #ffe40e 71%, #fedf0b 76%, #fed70d 82%, #fec70b 100%); cursor:pointer; padding: 5px;; font-size: 13px; width: 130px; border-left-style: none;"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:window.open('kuponyazdir2.asp?kuponno=1601548','','width=500,height=600')">
                                    PRINT
                                </td>
                                <td align="right"
                                    style="font-family:'Lucida Sans Unicode', 'Lucida Grande'; cursor:pointer; padding: 5px;; font-size: 14px; border-right-style: none;">
                                    Betting Time : {{$invoice->date}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="dwindow" style="position:absolute;background-color:#FFFFFF;cursor:hand;left:0px;top:0px;display:none;"
         onclick="if (!window.__cfRLUnblockHandlers) return false; closeit()">
        <div align="right" style="background-color:#252525;width:100%;height:25px">
            <img src="error.gif" onclick="if (!window.__cfRLUnblockHandlers) return false; closeit()" align="middle">
        </div>
        <div id="dwindowcontent" style="height:100%">
            <iframe id="cframe" src="" width="100%" height="100%" name="test" border="0" frameborder="0"></iframe>
        </div>
    </div>
    <div id="testdiv1"
         style="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></div>
    </body>

@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
