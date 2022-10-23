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
    <div class="vehicles-area home-2">
        <div>
            <div class="section-title">
                <div class="modal fade" id="invoice-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Invoices Modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="final-print" data-bs-dismiss="invoice-modal">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction_wrapper float_left smoke_bg ">
                    <div class="container">
                        <div class="row">
                            <div id="live-container" class="live-container container-fluid mt-3">
                                <div class="d-flex flex-wrap">
                                    <div class="ms-lg-2 col-lg mt-sm-3 mt-lg-0 bg-primary col-sm-12 shadow rounded-3 d-flex flex-column matches-table pb-3" id="live-teams-section">
                                        <div class="text-center pt-3 bg-primary header border-bottom d-flex flex-column align-items-center">
                                            <h2 class="mb-3">Live Matches</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function fetchLiveMatches(){
                            request(`live-matches`,
                                function(result){
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
                                            table += `
                                    <div class="ms-lg-4 me-lg-4 row bg-secondary fw-bold p-3 d-flex align-items-center justify-content-center shadow-sm rounded-3 mb-1 live-match">
                                        <div class="col-1 text-white text-cener">${match['match_time']}</div>
                                        <div class="col-1 text-white text-cener">${match['match_score']}</div>
                                        <div class="col-4 d-flex align-items-center">
                                            <div class="col-8 text-center text-white">
                                                ${match['home_team_name']}
                                            </div>
                                            <div class="col-4 fw-bold text-white text-center">
                                                    ${match['home_team_win']}
                                            </div>
                                        </div>
                                        <div class="col-1 text-center draw text-white">
                                            ${match['draw']}
                                        </div>
                                        <div class="col-4 d-flex align-items-center opponent text-white">
                                            <div class="col-4 fw-bold text-center text-white">
                                                     ${match['away_team_win']}
                                            </div>
                                            <div class="col-8 text-center fw-bold text-white">
                                                    ${match['away_team_name']}
                                            </div>
                                        </div>
                                    </div>
                               `
                                        });

                                        $("#live-teams-section").append($(
                                            `<div class="container-lg container-sm-fluid pt-3 pb-3 border-bottom live-league">
                                    <div class="d-flex align-items-center">
                                        <span class="ps-4 col-1">
                                            <img src="${league_info['country_flag']}">
                                        </span>
                                        <h4 class="ps-sm-2 text-light pt-2 text-center">${league_info['country_name']}</h4>
                                    </div>
                                    <div class="container-lg container-sm-fluid pt-3">` + table +`</div>`
                                        ));
                                    });
                                }, false);
                        }
                        $(function(){
                            fetchLiveMatches();
                            setInterval(fetchLiveMatches, 5000);
                        });
                    </script>
                </div>
                {{--<div id="betting-container" class="main-container container-fluid mt-3">--}}
                    {{--<div class="d-flex flex-wrap" style='display: flex;'>--}}
                        {{--<div class="col-lg-2 col-sm-12 p-0 shadow bg-black rounded-3 left-panel pb-3 sports-bets">--}}
                            {{--<div class=" text-center pb-1 pt-3 bg-light header" style='background: linear-gradient(to bottom,#995656 15%,#680202 58%);'>--}}
                                {{--<h2 style='margin: 0;padding-bottom: 15px;color: white'>Sports Bets</h2>--}}
                            {{--</div>--}}
                            {{--<div class="" id="sports-menu" style='background: #060606'>--}}
                                {{--@foreach($sports as $sport)--}}
                                    {{--<div class="" id="{{$sport}}">--}}
                                        {{--<div  style='background: #060606' class=" pl-2 pr-2 align-items-center d-flex justify-content-between border-bottom clickable main-category sublist-header">--}}
                                            {{--<h5 class="text-white">{{$sport}}</h5>--}}
                                            {{--<span class="fw-bold text-white" id="teams-count-{{$sport}}"></span>--}}
                                        {{--</div>--}}
                                        {{--@foreach($countries as $country)--}}
                                            {{--@if($country->sport == $sport)--}}
                                                {{--<div class="container-sm-fluid clickable subcategory mb-2" id="sub-category-{{$country->sport}}" >--}}
                                                    {{--<div class="p-1 side-sprt d-flex justify-content-start align-items-center country" data-name="{{$country->icon}}" data-league="1" data-time="4" data-write="F"--}}
                                                         {{--onclick="getMatchesByCountry( '{{$country->icon}}','F',4,'1')">--}}
                                                        {{--<div class="ps-1">--}}
                                                            {{--<img src="https://cdn.o-betgaming.com/lflags/{{$country->icon}}" height="20px" width="20px">--}}
                                                        {{--</div>--}}
                                                        {{--<div class="text-center text-white ptg">--}}
                                                            {{--<a>{{$country->country}}</a>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="pe-1 fw-bold text-white d-none">--}}
                                                            {{--64--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="ms-lg-2 col-lg mt-sm-3 mt-lg-0 col-sm-12 shadow rounded-3 d-flex flex-column matches-table pb-3" id="teams-section">--}}
                            {{--<div class="text-center pt-3 header border-bottom d-flex flex-column align-items-center">--}}
                                {{--<h2 style="padding: 10px;margin: 0;" class="mb-3 text-light">Matches List</h2>--}}
                            {{--</div>--}}
                            {{--<div class="w-100 h-100 d-flex align-items-center justify-content-center" id="no-matches">--}}
                                {{--<h4 class="message">Select Country To Start</h4>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="ms-lg-2 col-lg-2 col-sm-12 mt-sm-2 mb-sm-3 mb-lg-0 mt-lg-0">--}}
                            {{--<div class="row shadow bg-light rounded-3 bets-table" style="display: flex;">--}}
                                {{--<div style="background: linear-gradient(to bottom,#995656 15%,#680202 58%);" class="container-lg container-sm-fluid text-center pb-1 pt-3 header border-bottom">--}}
                                    {{--<h2 style="margin: 0;padding-bottom: 15px;color: white;font-size: 23px;">BET SLIP</h2>--}}
                                    {{--<h6 class="p-1 text-center" data-currency="{{$basic->currency}}" id="user-balance">Balance: 0</h6>--}}
                                {{--</div>--}}
                                {{--<div class="alert alert-success" id="bet-status"></div>--}}
                                {{--<div class="" id="bets">--}}
                                {{--</div>--}}
                                {{--<div class="bet-container p-2 bg-white shadow-sm amount-container" id="bets-calculator" style="display: block;">--}}
                                    {{--<div class="fw-bold d-flex justify-content-between">--}}
                                        {{--<span>X  : </span>--}}
                                        {{--<span id="total-bet-rate">0</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="input-group input-group-sm mt-3">--}}
                                        {{--<span class="input-group-text" id="bet-amount">Amount</span>--}}
                                        {{--<input type="number" min="1" value="1" class="form-control" id="amount" placeholder="amount" aria-label="bet-amount" aria-describedby="bet-amount">--}}
                                    {{--</div>--}}
                                    {{--<div class="input-group input-group-sm mt-1">--}}
                                        {{--<span class="input-group-text" id="player-name">Player</span>--}}
                                        {{--<input type="text" class="form-control" placeholder="Player" aria-label="player-name" aria-describedby="player-name">--}}
                                    {{--</div>--}}
                                    {{--<div class="pt-2 fw-bold d-flex justify-content-between">--}}
                                        {{--<spam>Tot. Win</spam>--}}
                                        {{--<span id="total-win">0</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="pt-3 d-flex justify-content-center">--}}
                                        {{--<button class="btn btn-success" id="bet">Bet Now</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row shadow bg-light rounded-3">--}}
                                {{--<div style="background: linear-gradient(to bottom,#995656 15%,#680202 58%);" class="container-lg container-sm-fluid text-center pb-1 pt-3 header border-bottom bg-light">--}}
                                    {{--<h2>Daily Bets</h2>--}}
                                {{--</div>--}}
                                {{--<div class="bet-container p-2 bg-black shadow-sm tickets-container" id="tickets-container">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    let update = false;
                    let last_request = {};
                    let matches = {}
                    let last_country_data = {}

                    function makeBet(element, selection_name, bet_value){
                        const event_data = element.parent().data('event');
                        const event_id = event_data.event_id
                        let last_bet_value = '0';
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

                        $("#total-bet-rate").text((parseFloat(bet_value) + parseFloat($("#total-bet-rate").text()) - parseFloat(last_bet_value)).toFixed(3));
                        $("#total-win").text((parseFloat($("#total-bet-rate").text()) * parseFloat($("#amount").val())).toFixed(3))
                        $("#bets").append(bet_item);
                        bet_item.find('.cancel-bet').on('click', function(){
                            $("#total-bet-rate").text((parseFloat($("#total-bet-rate").text()) - parseFloat(bet_item.data('bet-value'))).toFixed(3))
                            $("#total-win").text((parseFloat($("#amount").val()) * parseFloat($("#total-bet-rate").text())).toFixed(3));
                            bet_item.remove();
                            if ($('.bet').length === 0)
                                $('#bets-calculator').hide();
                        })
                        $("#bets-calculator").show();
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

                    // function getMatchesByCountry(country_name='ALL', write=0, time=0, updater=false, country_real_name=""){
                    //     last_country_data = {
                    //         country_name: country_name,
                    //         write: write,
                    //         time:time,
                    //         real_name: country_real_name
                    //     };
                    //     request(`matches?country_name=${country_name}&write=${write}&time=${time}`,
                    //         function(result){
                    //             const response_data = (result);
                    //             matches = response_data;
                    //
                    //             $.each($('.league'), function(index, item){
                    //                 $(item).remove();
                    //             });
                    //
                    //             $.each($('.match'), function (index, item){
                    //                 $(item).remove();
                    //             });
                    //
                    //             if (Object.keys(response_data).length)
                    //                 $("#no-matches").hide();
                    //             else {
                    //                 $("#no-matches").show();
                    //                 $("#no-matches .message").text('No Matches Exist Today');
                    //             }
                    //
                    //             $.each(response_data, function(league_name, league_matches){
                    //                 const league_flag = league_matches['flag'];
                    //                 delete league_matches['flag'];
                    //                 let table = ``;
                    //                 $.each(league_matches, function(index, match){
                    //                     const event_data = JSON.stringify({country_name: last_country_data['real_name'], league_name:league_name, home_team: match['first_opponent']['name'], away_team: match['second_opponent']['name'], start_time: match['start_time'], start_date: match['day'], event_id: match['bet_info']['event_id']});
                    //                     table += `
                    //                 <div id="match-event-${match['bet_info']['event_id']}" class="row fw-bold border-bottom  d-flex align-items-center justify-content-center shadow-sm  match" data-event='${event_data}'>
                    //                     <div class="col-1 text-white">${match['day']}</div>
                    //                     <div class="col-1 text-white">${match['start_time']}</div>
                    //                     <div class="col-4 d-flex align-items-center opponent" data-selection-name="${match['first_opponent']['name']}" data-bet-value="${match['first_opponent']['strength']}">
                    //                         <div class="col-2">
                    //                             <img class="float-right" style="width: 25px; height: 25px;" src="${match['first_opponent']['flag']}">
                    //                         </div>
                    //                         <div class="col-8 text-center fw-bold text-white">
                    //                               ${match['first_opponent']['name']}
                    //                         </div>
                    //                         <div class="col-2 fw-bold text-white">
                    //                                 ${match['first_opponent']['strength']}
                    //                         </div>
                    //                     </div>
                    //                     <div class="col-1 text-center draw text-white" data-selection-name="draw" data-bet-value="${match['draw']}">
                    //                         ${match['draw']}
                    //                     </div>
                    //                     <div class="col-4 d-flex align-items-center opponent text-white" data-selection-name="${match['second_opponent']['name']}" data-bet-value="${match['second_opponent']['strength']}">
                    //                         <div class="col-2 fw-bold">
                    //                                  ${match['second_opponent']['strength']}
                    //                         </div>
                    //                         <div class="col-8 text-center fw-bold text-white">
                    //                                 ${match['second_opponent']['name']}
                    //                         </div>
                    //                         <div class="col-2">
                    //                             <img class="float-left" style="width: 25px; height: 25px;" src="${match['second_opponent']['flag']}">
                    //                         </div>
                    //                     </div>
                    //                     <div class="col-1 text-center bet-info text-white" data-event-id="${match['bet_info']['event_id']}">
                    //                         ${match['bet_info']['bet_value']}
                    //                     </div>
                    //                 </div>
                    //            `
                    //                 });
                    //
                    //                 $("#teams-section").append($(
                    //                     `<div class="pt-1 pb-1 league">
                    //                      <div class="d-flex align-items-center">
                    //                         <span class="">
                    //                             <img src="${league_flag}">
                    //                         </span>
                    //                         <h4 class="ps-sm-2  text-center text text-light">${league_name}</h4>
                    //                      </div>
                    //                      <div class="">` + table +`</div>`
                    //                 ));
                    //             });
                    //
                    //             $('.opponent').on('click', function (){
                    //                 const team_name = $(this).data('selection-name');
                    //                 const bet_value = $(this).data('bet-value');
                    //                 makeBet($(this), team_name, bet_value);
                    //             });
                    //             $('.bet-info').on('click', function(){
                    //                 const event_id = $(this).data('event-id');
                    //                 request(`event_info?event_id=${event_id}`, function(result){
                    //                     const response_data = (result);
                    //                     let modal_body = '';
                    //                     $.each(response_data, function(name, list){
                    //                         let rows = '';
                    //                         const event_data = $('#match-event-' + event_id).first().data('event');
                    //                         $.each(list, function (index, item){
                    //                             const home_team_data = {bet_value: item[0][1], team_name: event_data.home_team, event_id:event_id};
                    //                             const draw_data = {bet_value: item[1][1], team_name: 'draw', event_id:event_id};
                    //                             const away_team_data = {bet_value: item[2][1], team_name: event_data.away_team, event_id:event_id};
                    //                             const bet_item = $(`
                    //                                 <div class='row bg-white border-bottom rounded p-2 mb-1 shadow-sm bet' data-event-id='${event_id}' data-event='${JSON.stringify(event_data)}'>
                    //                                     <div class="col-4 text-center sub-opponent" data-opponent='${JSON.stringify(home_team_data)}'>
                    //                                         <span class="fw-bold float-left">${item[0][0] ? item[0][0] + ' : ' : ''}</span>
                    //                                         <span class="fw-bold float-right">${item[0][1]}</span>
                    //                                     </div>
                    //                                     <div class="col-4 text-center text-muted sub-opponent" data-opponent='${JSON.stringify(draw_data)}'>
                    //                                         <span class="fw-bold">${item[1][0] ? item[1][0] + ' : ' : ''}</span>
                    //                                         <span class="fw-bold">${item[1][1]}</span>
                    //                                     </div>
                    //                                     <div class="col-4 text-center sub-opponent" data-opponent='${JSON.stringify(away_team_data)}'>
                    //                                         <span class="fw-bold float-left">${item[2][0] ? item[2][0] + ' : ' : ''}</span>
                    //                                         <span class="fw-bold float-right">${item[2][1]}</span>
                    //                                     </div>
                    //                                 </div>`);
                    //                             rows += bet_item.get(0).outerHTML;
                    //                         });
                    //
                    //                         modal_body += `
                    //                                 <div class='container bg-light shadow-sm p-2 mt-2 rounded-3'>
                    //                                     <h4 class="text-muted text-center p-2 border-bottom">${name}</h4>
                    //                                     <div class="container mt-1 mb-1">
                    //                                         ${rows}
                    //                                     </div>
                    //                                 </div>
                    //                 `;
                    //                     });
                    //
                    //                     $(`<div class="modal" tabindex="-1">
                    //                           <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    //                             <div class="modal-content">
                    //                               <div class="modal-header">
                    //                                 <h5 class="modal-title">Match Statistics</h5>
                    //                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    //                               </div>
                    //                               <div class="modal-body">
                    //                                 ${modal_body}
                    //                               </div>
                    //                             </div>
                    //                           </div>
                    //                         </div>`).modal('show');
                    //
                    //                     $('.sub-opponent').on('click', function(){
                    //                         const data_opponent = $(this).data('opponent');
                    //                         if (data_opponent?.bet_value.toString().trim().length !== 0)
                    //                         makeBet($(this), data_opponent.team_name, data_opponent.bet_value);
                    //
                    //                     })
                    //                 })
                    //             })
                    //             $('#amount').on('change', function(){
                    //                 $("#total-win").text((parseFloat($("#total-bet-rate").text()) * parseFloat($(this).val())).toFixed(3))
                    //             });
                    //             update = true;
                    //         }, !updater);
                    // }

                    // function fetchCountriesMenu(response_data){
                    //     $.each(response_data, function(index, item){
                    //         $('#sports-menu').append($(`<div class="" id="${item}">
                    //                 <div style='background: #060606' class="pl-2 pr-2 align-items-center d-flex justify-content-between border-bottom clickable main-caory sublist-header">
                    //                      <h5 class="text-white">${item}</h5>
                    //                      <span class="fw-bold text-white" id="teams-count-${item.replace(' ', '_')}"></span>
                    //                 </div>
                    //                 <div class="container-sm-fluid clickable subcategory mb-2" id="sub-category-${item.replace(' ', '_')}">
                    //                 </div>
                    //             </div>`));
                    //
                    //         request(`countries?sport_name=${item}`, function(result){
                    //             const response_data = (result);
                    //             $('#teams-count-' + item.replace(' ', '_')).text(response_data[item.toLowerCase()]['teams_count']);
                    //             delete response_data[item.toLowerCase()]['teams_count'];
                    //             $.each(response_data[item.toLowerCase()], function(index, country){
                    //                 const country_item = $(`<div class="p-1 side-sprt d-flex justify-content-between align-items-center country" data-name="${country['name']}" data-league="${country['params']['league']}" data-time="${country['params']['time']}" data-write="${country['params']['write']}">
                    //                             <div class="ps-1">
                    //                                    <img src="${country['flag']}" height="20px" width="20px">
                    //                             </div>
                    //                             <div class="text-center text-white">
                    //                                 <a>${country['name']}</a>
                    //                             </div>
                    //                             <div class="pe-1 fw-bold text-white">
                    //                                 ${country['teams_count']}
                    //                             </div>
                    //                         </div>`);
                    //                 country_item.on('click', function(){
                    //                     getMatchesByCountry($(this).data('league'), $(this).data('write'), $(this).data('time'), false, country['name']);
                    //                 })
                    //                 $(`#sub-category-${item.replace(' ', '_')}`).append(country_item);
                    //             });
                    //         })
                    //     });
                    //     $('.subcategory:not(:first)').hide();
                    //     $('.main-category').on('click', function(){
                    //         const subcategories = $('.subcategory')
                    //         const subcategory = $(this).parent().find('.subcategory')?.first();
                    //         $.each(subcategories, function (index, item){
                    //             if (!$(item).is(subcategory))
                    //                 $(item).hide(100);
                    //         })
                    //         subcategory?.toggle(100);
                    //     });
                    // }

                      function getDailyBets(){
                        request('daily-tickets', function (result){
                            $('.ticket').remove();
                            $.each(result, function (index, ticket_result){
                                const ticket = $(`
                                    <div class="clickable row ticket d-flex mb-2" data-ticket-id="${ticket_result.invoice_id}">
                                        <div class="col text-white">${ticket_result.invoice_id}</div>
                                    </div>
                                `);
                                $("#tickets-container").append(ticket);
                                ticket.on('click', async function(){
                                    let paid_amount = 0.0;
                                    let return_amount = 0.0;
                                    $(this).attr('disabled', true);
                                    let user_data = {};
                                    await request('user', function(result){
                                        user_data = result;
                                    }, true);
                                    await request(`invoice?invoice_id=${ticket_result.invoice_id}`, function(result){
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
                                                    `;});

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
                                                <span class="text-dark fw-bolder">${ticket_result.invoice_id}</span>
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
                                });
                            });
                        });
                    }


                    $(function(){
                        $("#bet-status").hide();
                        $("#bets-calculator").hide();
                        $(".bets-table").hide();
                        request('user', function (result) {
                            const response_data = result;
                            $('#user-balance').text(`Balance: ${response_data.balance} {{$basic->currency}}`);
                            $(".bets-table").show();
                        });
                        // request('available_sports', function(result){
                        //     fetchCountriesMenu(result);
                        //     setInterval(function(){if (update && last_country_data['country_name'])
                        //         getMatchesByCountry(last_country_data['country_name'],
                        //             last_country_data['write'], last_country_data['time'], true)
                        //     }, 1000 * 60 * 10);
                        // });
                        @if(auth()->check())
                            getDailyBets();
                        @endif

                        $("#bet").on('click', function() {
                            const bets_items = $(".bet");
                            const bets = {
                                amount: $("#amount").val(),
                                total_bets: []
                            };


                            $.each(bets_items, function (index, item) {
                                bets.total_bets.push(
                                    $(item).data('event-info')
                                )
                            });

                            const fast_betting_alert = $("#bet-status");

                            request(`bet?items=${JSON.stringify(bets).replaceAll('\n', '')}`, function (result) {
                                bets_items.remove();
                                $("#bets-calculator").hide();
                                fast_betting_alert.removeClass('d-none');
                                fast_betting_alert.addClass('alert-success');
                                fast_betting_alert.removeClass('alert-danger');
                                fast_betting_alert.text(result.message);
                                fast_betting_alert.show();
                                fast_betting_alert.fadeOut(1000);
                                $('#user-balance').text(`Balance: ${result.balance} {{$basic->currency}}`);
                                getDailyBets();
                                $("#amount").val(1);
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

    {{--    <div class="modal modal-sport fade" id="sportModal" tabindex="-1" role="dialog" aria-labelledby="sportModalTitle"--}}
    {{--         aria-hidden="true">--}}

    {{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title modal-sport-confrontation text-white font-20"--}}
    {{--                        id="sportModalTitle">@lang('Prediction Now')</h5>--}}

    {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                        <span aria-hidden="true">&times;</span>--}}
    {{--                    </button>--}}
    {{--                </div>--}}

    {{--                <form action="{{route('prediction')}}" method="post">--}}
    {{--                    @csrf--}}
    {{--                    <div class="modal-body text-center">--}}
    {{--                        <p class="modal-sport-wager-title">--}}
    {{--                            <span class="modal-sport-wager"></span>--}}
    {{--                            <span class="modal-sport-wager-count"></span>--}}
    {{--                        </p>--}}

    {{--                        <p class="modal-sport-live">--}}
    {{--                            <span class="font-weight-bold">@lang('MINIMUM PREDICT AMOUNT') <span--}}
    {{--                                    class="minamo"></span> {{__($basic->currency)}}</span>--}}
    {{--                        </p>--}}
    {{--                        <div class="stepper-sport">--}}
    {{--                            <div class='ctrl'>--}}
    {{--                                <div class='ctrl__button ctrl__button--decrement'>&ndash;</div>--}}
    {{--                                <div class='ctrl__counter'>--}}
    {{--                                    <input name="invest_amount"--}}
    {{--                                           class='ctrl__counter-input form-input  invest_amount_min ronnie_bet get_amount_for_ratio'--}}
    {{--                                           maxlength='10' type='text' value='' min="" max=""--}}
    {{--                                           onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">--}}
    {{--                                </div>--}}
    {{--                                <div class='ctrl__button ctrl__button--increment'>+</div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}


    {{--                        <input type="hidden" value="" name="betoption_id" id="betoption_id">--}}
    {{--                        <input type="hidden" value="" name="match_id" id="match_id">--}}
    {{--                        <input type="hidden" value="" name="betquestion_id" id="questionid">--}}
    {{--                        <input class="ratio1" type="hidden" value="" id="ratioOne">--}}
    {{--                        <input class="ratio2" type="hidden" value="" id="ratioTwo">--}}
    {{--                        <input class="form-control input-lg ronnie_ratio" name="return_amount" type="hidden">--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <small>(@lang('IF YOU WIN'))</small>--}}
    {{--                        <p class="modal-sport-win">--}}
    {{--                            <span class="font-weight-bold">@lang('RETURN AMOUNT')</span>--}}
    {{--                            <span class="font-weight-bold"><span class="wining-rate"></span> {{$basic->currency}}</span>--}}
    {{--                        </p>--}}
    {{--                        <p class="text-danger">{{$basic->win_charge}}% @lang('Charge Apply From This Amount')--}}
    {{--                            (@lang('IF YOU WIN')) </p>--}}
    {{--                        <p class="text-success">@lang('Maximum') <span--}}
    {{--                                class="betlimit"></span>{{$basic->currency}} @lang('Predict in this Option')  </p>--}}

    {{--                        @if(Auth::user())--}}
    {{--                            <div class="form-element mt-2">--}}
    {{--                                <button type="submit"><span>@lang('Predict Now')</span>--}}
    {{--                                </button>--}}
    {{--                            </div>--}}
    {{--                        @else--}}
    {{--                            <div class="form-element mt-2">--}}
    {{--                                <a href="{{route('login')}}" class="cartbtn cart">@lang('Predict Now')--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                        @endif--}}
    {{--                    </div>--}}

    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@stop

@section('js')

    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                // getMatchesByCountry('fg_europe.png','F',4,'1');
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