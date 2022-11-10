@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{asset('templates/css/custom.css')}}">
         <style>
        a{
            text-decoration: none;
        }
        .clickable{
            cursor: pointer;
        }
        .float-right{
            float: right;
        }
        .float-left{
            float: left;
        }
        /* .left-panel {
             max-height: 90vh;
             overflow-y: auto;
         }*/
        .left-panel .header{
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .left-panel .sublist-header{
            position: sticky;
            top: 100px;
            z-index: 100;
        }
        /* .matches-table{
             max-height: 90vh;
             overflow-y: auto;
         }*/
        .matches-table .header{
            position: sticky;
            top: 0;
            z-index: 100;
        }
        /*    alaa mhna new edit       */
        /*        .bets-table{
                    max-height: 90vh;
                    overflow-y: auto;
                }
        */
        .bets-table .header{
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .loading-spinner{
            position: absolute;
            top: 0;
            height: 100%;
            width: 100%;
            left: 0;
            z-index: 99999;
        }
        .input-group-text{
            min-width: 100px;
        }
        .opponent, .bet-info, .sub-opponent{
            cursor: pointer;
        }
        .opponent:hover, .draw:hover{
            color: black;
        }
        .main-container h2, .live-container h2{
            margin-bottom: 0.25rem !important;
        }
        .main-container span, .live-container span{
            font-size: 12px;!important;
            /*color: #fff !important;*/
        }
        .main-container h2::after, .live-container h2::after{
            display: none !important;
        }
        @media  screen and (max-width: 568px) {
            .left-panel .sublist-header{
                top: 50px;
            }
            .mt-sm-3{
                margin-top: 1rem;
            }
            .mt-sm-2{
                margin-top: 0.75rem;
            }
            .matches-table{
                zoom: 0.3;
            }
            .ps-sm-2{
                padding-left: 1.5rem;
            }
            .float-right{
                float: unset !important;
            }
            .float-left{
                float: unset !important;
            }
        }
        .font-sm{
            font-size: 14px;
        }
        .match, .live-match{
            overflow: auto;
        }
        .bg-primary{
            background-color: #151b29 !important;
        }
        @media  screen and (max-width: 768px) {
            .matches-table{
                zoom: 0.5;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
@stop
@section('content')
    <div class="home-2">
        <div>
            <div class="section-title">
                <div class="modal fade" id="invoice-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('Invoices Modal')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="bet-btn" id="final-print" data-bs-dismiss="invoice-modal">@lang('Print')</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float_left smoke_bg ">
                    <div class="row p-3">
                        <div id="live-container" class="col-lg-10" style="width: 82%">
                            <div class="d-flex flex-wrap">
                                <div class="ms-lg-2 col-lg mt-sm-3 mt-lg-0 col-sm-12 shadow rounded-3 d-flex flex-column matches-table p-0" id="live-teams-section" >
                                    <div class="d-flex align-items-center header" style="background: linear-gradient(to bottom,#567499 15%,#023a68 58%);padding: 10px;">
                                        <img src="{{asset('templates/img/live.png')}}" alt="">
                                        <h2 style="margin: 0;font-size: 14px;padding: 0;margin:0 10px">Live Matches</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('partials.right_panel')
                    </div>
                    <script>

                        function fetchLiveMatches(){
                            request(`live-matches`, function(result){
                                    const response_data = (result);
                                    matches = response_data;
                                    $.each($('.live-league'), function(index, item){
                                        $(item).remove();
                                    });
                                    $.each($('.live-match'), function (index, item){
                                        $(item).remove();
                                    });
                                    $.each(response_data, function(league_index, league_info){
                                        let table = ``;
                                        $.each(league_info['matches'], function(index, match){
                                            const event_data = JSON.stringify({country_name: league_info['country_name'], league_name:league_info, home_team: match['home_team_name'], away_team: match['away_team_name'], event_id: match['match_id']});
                                            table += `
                                    <div class="row live-match mb-1" style="background: linear-gradient(to bottom,#034379 1%,#012b4f 27%,#00223e 64%);" data-event='${event_data}'>
                                        <div class="col-1 text-white p-2" >${match['match_time']}</div>
                                        <div class="col-1 text-white p-2" style="background: #000000;">${match['match_score']}</div>
                                        <div class="col-4 d-flex align-items-center opponent" style="background: #e2e2e2;" data-selection-name="${match['home_team_name']}" data-bet-value="${match['home_team_win']}">
                                            <div class="col-8 text-center text-dark">
                                                ${match['home_team_name']}
                                            </div>
                                            <div class="col-4 fw-bold text-dark text-end">
                                                    ${match['home_team_win']}
                                            </div>
                                        </div>
                                        <div class="col-1 text-center draw text-dark fw-bold p-2 opponent" style="background: #e2e2e2;border-right:1px solid #000;border-left:1px solid #000;"  data-selection-name="draw" data-bet-value="${match['draw']}">
                                            ${match['draw']}
                                        </div>
                                        <div class="col-4 d-flex align-items-center text-dark opponent" style="background: #e2e2e2;" data-selection-name="${match['away_team_name']}" data-bet-value="${match['away_team_win']}">
                                            <div class="col-4 fw-bold text-start text-dark">
                                                     ${match['away_team_win']}
                                            </div>
                                            <div class="col-8 text-center fw-bold text-dark">
                                                    ${match['away_team_name']}
                                            </div>
                                        </div>
                                        <div class="col-1 bet-info" data-event-id="${match['match_id']}">
                                        <img src="https://cdn.o-betgaming.com/lflags/plus.png" alt="" style="width: 35px;">
                                        </div>
                                    </div>
                               `
                                        });
                                        $('.opponent').on('click', function (){
                                            const team_name = $(this).data('selection-name');
                                            const bet_value = $(this).data('bet-value');
                                            if(bet_value != '---')
                                            makeBet($(this), team_name, bet_value);
                                        });

                                        $('.bet-info').on('click', function(){
                                            const event_id = $(this).data('event-id');
                                            request(`event_live?event_id=${event_id}`, function(result){
                                                const response_data = (result);
                                                let modal_body = '';
                                                $.each(response_data, function(name, list){
                                                    let rows = '';
                                                    const event_data = $('#match-event-' + event_id).first().data('event');
                                                    $.each(list, function (index, item){
                                                        const home_team_data = {bet_value: item[0][1], team_name: item[0][0] ? item[0][0] + ' : ' : '', event_id:event_id, val_name:name};
                                                        const draw_data = {bet_value: item[1][1], team_name: item[1][0] ? item[1][0] + ' : ' : '', event_id:event_id, val_name:name};
                                                        const away_team_data = {bet_value: item[2][1], team_name: item[2][0] ? item[2][0] + ' : ' : '', event_id:event_id, val_name:name};
                                                        const bet_item = $(`
                                                    <div class='row bg-white border-bottom rounded p-2 mb-1 shadow-sm bet'
                                                    data-event-id='${event_id}'
                                                    data-event='${JSON.stringify(event_data)}'>
                                                        <div class="col-4 text-center sub-opponent" data-opponent='${JSON.stringify(home_team_data)}' style="background: rgb(250,248,248);">
                                                            <span class="fw-bold float-left">${item[0][0] ? item[0][0] + ' : ' : ''}</span>
                                                            <span class="fw-bold float-right">${item[0][1]}</span>
                                                        </div>
                                                        <div class="col-4 text-center text-muted sub-opponent " data-opponent='${JSON.stringify(draw_data)}' style="background: rgb(207,207,207);">
                                                            <span class="fw-bold">${item[1][0] ? item[1][0] + ' : ' : ''}</span>
                                                            <span class="fw-bold">${item[1][1]}</span>
                                                        </div>
                                                        <div class="col-4 text-center sub-opponent" data-opponent='${JSON.stringify(away_team_data)}' style="background: rgb(250,248,248);">
                                                            <span class="fw-bold float-left">${item[2][0] ? item[2][0] + ' : ' : ''} </span>
                                                            <span class="fw-bold float-right">${item[2][1]}</span>
                                                        </div>
                                                    </div>`);
                                                        rows += bet_item.get(0).outerHTML;
                                                    });
                                                    modal_body += `
                                                    <div class='container bg-light shadow-sm p-2 mt-2 rounded-3'>
                                                        <h4 class="text-muted text-center p-2 border-bottom opponent" style="background: #049a09;color:#fff!important;">${name}</h4>
                                                        <div class="container mt-1 mb-1">
                                                            ${rows}
                                                        </div>
                                                    </div>
                                    `;
                                                });
                                                $(`<div class="modal" tabindex="-1">
                                              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                <div class="modal-content" style="background: #fff!important;">
                                                  <div class="modal-header">
                                                    <!--<h5 class="modal-title">Match Statistics</h5>-->
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body" id="modal-${event_id}">
                                                    ${modal_body}
                                                  </div>
                                                </div>
                                              </div>
                                            </div>`).modal('show');
                                                $('.sub-opponent').on('click', function(){
                                                    $('#betscount').text(' ('+$(".bet").length+')')
                                                    const data_opponent = $(this).data('opponent');
                                                    if (data_opponent?.bet_value.toString().trim().length !== 0)
                                                    if($(this).hasClass('check')) {
                                                        $(this).removeClass('check');
                                                        const betting=$("#bet-" + data_opponent.event_id)
                                                        $("#amount").val('1');
                                                        $("#total-bet-rate").text((parseFloat($("#total-bet-rate").text()) / parseFloat(data_opponent.bet_value)).toFixed(3))
                                                        $("#total-win").text((parseFloat($("#amount").val()) * parseFloat($("#total-bet-rate").text())).toFixed(3));
                                                        betting.remove();
                                                        if ($('.bet').length === 0)
                                                            $('#bets-calculator').hide();
                                                    }
                                                    else
                                                        makeBet($(this), data_opponent.team_name, data_opponent.bet_value, data_opponent.val_name);
                                                })
                                            })
                                        })

                                        $("#live-teams-section").append($(
                                            `<div class="pb-3 border-bottom live-league">
                                            <div class="d-flex" style="background: linear-gradient(to bottom,#034379 1%,#012b4f 27%,#00223e 64%);border-bottom:3px solid #000">
                                       <div style="background: linear-gradient(to bottom, #4c8206 0%, #4a7d07 10%, #3d630c 39%, #3a600b 48%, #3f680a 68%, #4b8107 100%);" class="d-flex align-items-center"> <span class="col-1">
                                            <img style="width:20px" src="https://cdn.o-betgaming.com/lflags/soccer_ball.png">
                                        </span>
                                        <h4 class="col-8 fs-16">FUTBOL</h4></div>
                                        <div class="d-flex align-items-center">
                                        <span class="col-1">
                                            <img src="${league_info['country_flag']}">
                                        </span>
                                        <h4 class="col-8 fs-16">${league_info['country_name']}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="col-1">
                                            <img src="${league_info['country_flag']}">
                                        </span>
                                        <h4 class="m-1">${league_info['country_name']}</h4>
                                    </div>
                                    <div class="container-lg container-sm-fluid">` + table +`</div>`
                                        ));
                                    });
                                });
                            $('#amount').on('change', function(){
                                $("#total-win").text((parseFloat($("#total-bet-rate").text()) * parseFloat($(this).val())).toFixed(3))
                            });
                        }
                        $(function(){
                            fetchLiveMatches();
                            // setInterval(fetchLiveMatches, 5000);
                        });

                    </script>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    let update = false;
                    let last_request = {};
                    let matches = {}
                    function makeBet(element, selection_name, bet_value){
                        const event_data = element.parent().data('event');
                        console.log(event_data);
                        const event_id = event_data.event_id
                        let last_bet_value = '1';
                        const last_bet = $("#bet-" + event_id);
                        if (last_bet.length){
                            last_bet_value = last_bet.data('event-info').bet_value;
                            last_bet.remove();
                        }
                        event_data.selection_name = selection_name;
                        event_data.bet_value = bet_value;
                        const event_json = JSON.stringify(event_data);
                        const bet_item = $(`<div class="border-bottom bet" id="bet-${event_id}" data-event-info='${event_json}'>
                                                    <div class="cacel-bet cancel-bet">
                                                        <span class="spn-bet" data-event-id="${event_id}"> Cancel Bet</span>
                                                        <span class="spn-bet2" data-event-id="">
                                                            <img src='{{asset('images/kapat.png')}}' />
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-5 fw-bold font-sm text-center">
                                                            ${event_data.home_team}
                                                        </div>
                                                        <div class="col-2 text-center fw-bold font-sm">
                                                            -
                                                        </div>
                                                        <div class="col-5 fw-bold text-center font-sm">
                                                            ${event_data.away_team}
                                                        </div>
                                                    </div>
                                                    <div class="fw-bold pt-2 gr-mac">MAC BAHISI</div>
                                                    <div class="fw-bold pt-2 d-flex justify-content-between">
                                                        <span id="bet-team-${event_id}">${selection_name}</span>
                                                        <span id="bet-strength-${event_id}">${bet_value}</span>
                                                    </div>
                                                </div>`);
                        $("#total-bet-rate").text((parseFloat(bet_value) * parseFloat($("#total-bet-rate").text()) / parseFloat(last_bet_value)).toFixed(3));
                        $("#total-win").text((parseFloat($("#total-bet-rate").text()) * parseFloat($("#amount").val())).toFixed(3))
                        $("#bets").append(bet_item);
                        bet_item.find('.cancel-bet').on('click', function(){
                            $("#match-event-" + event_data.event_id +" .check").removeClass('check');
                            $("#amount").val('1');
                            $("#total-bet-rate").text((parseFloat($("#total-bet-rate").text()) / parseFloat(bet_value)).toFixed(3))
                            $("#total-win").text((parseFloat($("#amount").val()) * parseFloat($("#total-bet-rate").text())).toFixed(3));
                            bet_item.remove();
                            $('#betscount').text(' ('+$(".bet").length+')')
                            if ($('.bet').length === 0){
                                $('#bets-calculator').hide();
                                $('#cancelall').hide();}
                        })
                        $("#bets-calculator").show();
                        $('#cancelall').show();
                        $('#betscount').text(' ('+$(".bet").length+')')
                    }
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
                    {{--function getDailyBets(){--}}
                        {{--request('daily-tickets', function (result){--}}
                            {{--$('.ticket').remove();--}}
                            {{--$.each(result, function (index, ticket_result){--}}
                                {{--const ticket = $(`--}}
                                    {{--<div class="clickable row ticket d-flex mb-2" data-ticket-id="${ticket_result.invoice_id}">--}}
                                        {{--<div class="col text-white">${ticket_result.invoice_id}</div>--}}
                                    {{--</div>--}}
                                {{--`);--}}
                                {{--$("#tickets-container").append(ticket);--}}
                                {{--ticket.on('click', async function(){--}}
                                    {{--let paid_amount = 0.0;--}}
                                    {{--let return_amount = 0.0;--}}
                                    {{--$(this).attr('disabled', true);--}}
                                    {{--let user_data = {};--}}
                                    {{--await request('user', function(result){--}}
                                        {{--user_data = result;--}}
                                    {{--}, true);--}}
                                    {{--await request(`invoice?invoice_id=${ticket_result.invoice_id}`, function(result){--}}
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
                                                    {{--`;});--}}
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
                                                {{--<span class="text-dark fw-bolder">${ticket_result.invoice_id}</span>--}}
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
                                {{--});--}}
                            {{--});--}}
                        {{--});--}}
                    {{--}--}}
                    $(function(){
                        $("#bet-status").hide();
                        $("#bets-calculator").hide();
                        $(".bets-table").hide();
                        request('user', function (result) {
                            const response_data = result;
                            $('#user-balance').text(`Balance: ${response_data.balance} {{$basic->currency}}`);
                            $(".bets-table").show();
                        });

                        $("#bet").on('click', function() {
                            const bets_items = $(".bet");
                            const bets = {
                                amount: $("#amount").val(),
                                total_bets: [],
                                x:$("#total-bet-rate").text(),
                            };
                            $.each(bets_items, function (index, item) {
                                bets.total_bets.push(
                                    $(item).data('event-info')
                                )
                            });
                            const fast_betting_alert = $("#bet-status");
                            request(`livebet?items=${JSON.stringify(bets).replaceAll('\n', '')}`, function (result) {
                                bets_items.remove();
                                $("#bets-calculator").hide();
                                fast_betting_alert.removeClass('d-none');
                                fast_betting_alert.addClass('alert-success');
                                fast_betting_alert.removeClass('alert-danger');
                                fast_betting_alert.text(result.message);
                                fast_betting_alert.show();
                                fast_betting_alert.fadeOut(1000);
                                $('#user-balance').text(`Balance: ${result.balance}`);
                                // getDailyBets();
                                $("#amount").val(1);
                                location.reload();
                            }, false, function (request, status, error) {
                                fast_betting_alert.removeClass('d-none');
                                fast_betting_alert.addClass('alert-danger');
                                fast_betting_alert.removeClass('alert-success');
                                fast_betting_alert.text(request.responseJSON.message);
                                fast_betting_alert.show();
                                fast_betting_alert.fadeOut(1000);
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@stop

{{--<div align="center">--}}


    {{--<table border="0" width="100%" cellspacing="0" cellpadding="0" height="50">--}}
        {{--<tbody><tr>--}}
            {{--<td style="background-color:#000" align="center">--}}
                {{--<iframe style="margin-top:10px;" src="https://href.li/?https://www.cyprussportingclubs.com/sports/tracker.jsp?lang=tr&amp;id=36479673" frameborder="0" width="100%" height="450" scrolling="no"></iframe>--}}
            {{--</td>--}}
        {{--</tr>--}}
        {{--</tbody></table>--}}




    {{--<table border="0" width="100%" cellspacing="0" cellpadding="0">--}}
        {{--<tbody><tr>--}}
            {{--<td valign="top">--}}

            {{--</td>--}}
        {{--</tr>--}}


        {{--<tr>--}}
            {{--<td valign="bottom">--}}
                {{--<table border="0" width="100%" cellspacing="0" cellpadding="0">--}}

                    {{--<tbody><tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">MAÇ BAHİSİ</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504',1);" style="height: 25px; cursor: pointer; padding-top: 5px; background-image: url(&quot;images/canlialtiR.png&quot;);"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">Al Nasr SC (KUW) :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.30</span></div></td>--}}
                                    {{--<td width="20%" align="center" background="images/canlialti2R.png"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialti2R.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504',0);" style="height:25px; cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-right:5px; text-align:right; height:25px; display: inline-block">X :</span><span style="padding-left:5px; height:25px; text-align:left;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.10</span></div></td>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504',2);" style="height: 25px; cursor: pointer; padding-top: 5px; background-image: url(&quot;images/canlialtiR.png&quot;);"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">Al Tadhamon :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">4.40</span></div></td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">TOPLAM GOL ALT/ÜST 0.5</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A05',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">0.5&nbsp;ALT&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.70</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20" align="center" background="images/canlialti2R.png"><div style="height:25px; width:20px; cursor:pointer; padding-top:5px"></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A05',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">0.5&nbsp;ÜST&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.38</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">TOPLAM GOL ALT/ÜST 1.5</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A15',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">1.5&nbsp;ALT&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.39</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20" align="center" background="images/canlialti2R.png"><div style="height:25px; width:20px; cursor:pointer; padding-top:5px"></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A15',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">1.5&nbsp;ÜST&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.65</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">TOPLAM GOL ALT/ÜST 2.5</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A25',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">2.5&nbsp;ALT&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.09</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20" align="center" background="images/canlialti2R.png"><div style="height:25px; width:20px; cursor:pointer; padding-top:5px"></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A25',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">2.5&nbsp;ÜST&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">6.50</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">TOPLAM GOL ALT/ÜST 3.5</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A35',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">3.5&nbsp;ALT&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.01</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20" align="center" background="images/canlialti2R.png"><div style="height:25px; width:20px; cursor:pointer; padding-top:5px"></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A35',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">3.5&nbsp;ÜST&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">17.00</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">TOPLAM GOL ALT/ÜST 4.5</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A45',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">4.5&nbsp;ALT&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.00</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20" align="center" background="images/canlialti2R.png"><div style="height:25px; width:20px; cursor:pointer; padding-top:5px"></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A45',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">4.5&nbsp;ÜST&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">20.00</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">TOPLAM GOL ALT/ÜST 5.5</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A55',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">5.5&nbsp;ALT&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.00</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20" align="center" background="images/canlialti2R.png"><div style="height:25px; width:20px; cursor:pointer; padding-top:5px"></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504A55',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">5.5&nbsp;ÜST&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">20.00</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">ÇİFTE ŞANS</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}

                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504C',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">1-X :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.17</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20%" align="center" background="images/canlialti2R.png">--}}
                                        {{--<div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialti2R.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504C',0);" style="height:25px; cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-right:5px; text-align:right; height:25px; display: inline-block">1-2 :</span><span style="padding-left:5px; height:25px; text-align:left;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.62</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504C',2);" style="height: 25px; cursor: pointer; padding-top: 5px; background-image: url(&quot;images/canlialtiR.png&quot;);"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">X-2 :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.50</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">MAÇIN GERİ KALANINI KİM KAZANIR</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}

                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504GK00',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">Al Nasr SC (KUW) :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.30</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20%" align="center" background="images/canlialti2R.png">--}}
                                        {{--<div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialti2R.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504GK00',0);" style="height:25px; cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-right:5px; text-align:right; height:25px; display: inline-block">X :</span><span style="padding-left:5px; height:25px; text-align:left;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.10</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504GK00',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">Al Tadhamon:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">4.40</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">1. GOLÜ KİM ATAR</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504GS1',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">Al Nasr SC (KUW) :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.05</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20%" align="center" background="images/canlialti2R.png">--}}
                                        {{--<div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialti2R.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504GS1',0);" style="height:25px; cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-right:5px; text-align:center; width:110px; height:25px; display: inline-block">1.&nbsp;GOL OLMAZ&nbsp;:</span><span style="padding-left:5px width:130px; height:25px; text-align:left;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.70</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504GS1',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">Al Tadhamon :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">3.40</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">HANDIKAP 0-1</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504H01',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">Al Nasr SC (KUW) :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">6.25</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20%" align="center" background="images/canlialti2R.png">--}}
                                        {{--<div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialti2R.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504H01',0);" style="height:25px; cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-right:5px; text-align:right; height:25px; display: inline-block">X :</span><span style="padding-left:5px; height:25px; text-align:left;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">3.20</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="40%" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504H01',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; float:left; height:25px; display: inline-block">Al Tadhamon :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.50</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">KARŞILIKLI GOL OLUR</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504HIT',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">EVET :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">4.33</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20" align="center" background="images/canlialti2R.png"><div style="height:25px; width:20px; cursor:pointer; padding-top:5px"></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504HIT',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">HAYIR :</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.17</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;color: #fff; font-weight: 900;background-color: #049a09;padding-left:10px;">TOPLAM GOL TEK/CIFT</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td align="left" height="25" width="100%" style="background-image:url(images/canlialtiR.png);">--}}
                            {{--<table width="100%" border="0" cellspacing="0" cellpadding="0">--}}
                                {{--<tbody><tr>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504TC0',1);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">TEK&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">2.05</span></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="20" align="center" background="images/canlialti2R.png"><div style="height:25px; width:20px; cursor:pointer; padding-top:5px"></div>--}}
                                    {{--</td>--}}
                                    {{--<td width="370" height="25"><div onmouseover="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiK.png)';" onmouseout="if (!window.__cfRLUnblockHandlers) return false; this.style.backgroundImage = 'url(images/canlialtiR.png)';" onclick="if (!window.__cfRLUnblockHandlers) return false; parent.oddsClick('C504TC0',2);" style="height:25px;  cursor:pointer; padding-top:5px"><span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color: #000; font-weight:600; padding-left:10px; text-align:left; width:310px; height:25px; display: inline-block">ÇİFT&nbsp;:</span><span style="padding-right:10px; float:right; height:25px; text-align:right;font-family:'Lucida Sans Unicode', 'Lucida Grande';font-size:13px; color: #000000; font-weight: 600; display: inline-block">1.65</span></div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody></table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td colspan="5" height="5px"></td>--}}
                    {{--</tr>--}}
                    {{--</tbody></table>--}}
            {{--</td>--}}
        {{--</tr>--}}
        {{--</tbody></table>--}}
{{--</div>--}}
@section('js')
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('click', '.bet_button', function () {
                    var id = $(this).data('id');
                    var minamo = $(this).data('minamo');
                    var macthid = $(this).data('macthid');
                    var ratioone = $(this).data('ratioone');
                    var ratiotwo = $(this).data('ratiotwo');
                    var questionid = $(this).data('questionid');
                    var betlimit = $(this).data('betlimit');
                    $('#betoption_id').val(id);
                    $("#match_id").val(macthid);
                    $("#ratioOne").val(ratioone);
                    $("#ratioTwo").val(ratiotwo);
                    $("#questionid").val(questionid);
                    $(".get_amount_for_ratio").val(minamo);
                    $('.minamo').text(minamo);
                    $('.betlimit').text(betlimit);
                    $('.ctrl__counter-input').attr('value', minamo)
                    $('.ctrl__counter-input').attr('min', minamo)
                    $('.ctrl__counter-num').text(minamo)
                    $('.ctrl__counter-input').attr('max', betlimit)
                    var amount = $('.get_amount_for_ratio').val();
                    var ratio1 = $('.ratio1').val();
                    var ratio2 = $('.ratio2').val();
                    var finalRation = parseFloat((amount * ratio2) / ratio1).toFixed(2);
                    $('.ronnie_ratio').val(finalRation);
                    $('.wining-rate').text(finalRation);
                });
                $(document).on('keyup change click', '.get_amount_for_ratio', function () {
                    var amount = $('.get_amount_for_ratio').val();
                    var ratio1 = $('.ratio1').val();
                    var ratio2 = $('.ratio2').val();
                    var finalRation = parseFloat((amount * ratio2) / ratio1).toFixed(2);
                    $('.ronnie_ratio').val(finalRation);
                    $('.wining-rate').text(finalRation);
                });
            });
        })(jQuery);
    </script>
@stop

{{--<link rel="alternate" hreflang="en" href="https://gool10bets">--}}
{{--<link rel="alternate" hreflang="ar" href="https://gool10bets">--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
<script>
Weglot.initialize({
api_key: 'wg_00cb8f77c0699f8adc14dfbfa51436741'
});
</script>