@extends('admin.layout.master')
@section('import-css')
@stop
@section('css')

@stop
@section('content')

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
                    @include('errors.error')
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
                        @foreach($betting as $bet)
                            <tr @if($bet->result == 1) class="danger" @endif>
                                <td data-label="user">{{$bet->user->username}}</td>
                                <td data-label="Event">{{$bet->home_team.' - '.$bet->away_team}}</td>
                                <td data-label="Event">{{$bet->match_date .$bet->match_time}}</td>
                                <td data-label="End Time">{{$bet->predict_amount}}</td>
                                <td data-label="End Time">{{$bet->return_amount}}</td>
                                <td data-label="End Time">@if($bet->result==0) Proccessing @elseif($bet->result==1) Win @elseif($bet->result==-1) Lose @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>


@endsection




@section('script')


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
@stop
