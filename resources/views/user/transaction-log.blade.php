@extends('user')

@section('css')
    <link rel="stylesheet" href="{{asset('templates/css/custom-table.css')}}">
    <style>
        .filterform {
            background: #004c17;
            margin-top: 10px;
        }
        td{
            color:#fff;
        }
        .trx:hover{
            background: red;
        }
    </style>
@stop
@section('content')
    <div class="filterform">
        <form action="{{route('transaction.search')}}" method="post">
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
            <button type="submit" style="font-weight: 600; font-size: 14px; height: 32px;width: 100px;">List</button>
        </form>
    </div>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tbody><tr>
            <td  height="25" bgcolor="#252525" align="center" style="color:#FFFF99">Transaction</td>
            <td  height="25" bgcolor="#252525" align="center" style="color:#FFFF99">&nbsp;&nbsp;&nbsp;&nbsp;Date</font></td>
            <td  height="25" bgcolor="#252525" align="center" style="color:#FFFF99">&nbsp;&nbsp;&nbsp;&nbsp;Time</font></td>
            <td  height="25" bgcolor="#252525" align="center" style="color:#FFFF99">Out&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td  height="25" bgcolor="#252525" align="center" style="color:#FFFF99">In</td>
            <td  height="25" bgcolor="#252525" align="left" style="color:#FFFF99">Balance</td>
            <td  height="25" bgcolor="#252525"  style="color:#FFFF99">Details</td>
        </tr>
        @foreach($logs as $log)
        <tr bgcolor="{{$log->income==0 ?'#7D7D7D' :'#484848'}}" class="trx" >
            <td  height="20" align="center" style="color:#D7D7D7" >{{$log->trx}}</td>
            <td  height="20" align="center" style="color:#D7D7D7" >{{date('Y.m.d',strtotime($log->date))}}</td>
            <td  height="20" align="center">{{date('H:i:s',strtotime($log->date))}}</td>
            <td  height="20" align="center"><b>{{$log->outcome}}</b></td>
            <td  height="20" align="center"><b>{{$log->income}}</b></td>
            <td  height="20" align="left"><b>{{$log->balance}}</b></td>
            <td   height="20" >{{$log->details}}</td>
        </tr>
        @endforeach
         <tr>
             <td width="8%"></td>
            <td width="8%">&nbsp;</td>
            <td width="10%">&nbsp;</td>
            <td width="12%">&nbsp;</td>
            <td width="14%">&nbsp;</td>
            <td width="15%">&nbsp;</td>
            <td width="20%">&nbsp;</td>

        </tr>
        </tbody
    </table>
@stop
