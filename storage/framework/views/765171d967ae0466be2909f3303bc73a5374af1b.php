<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('templates/css/custom.css')); ?>">
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
        @media    screen and (max-width: 568px) {
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
        @media    screen and (max-width: 768px) {
            .matches-table{
                zoom: 0.5;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="vehicles-area home-2">
        <div>
            <div class="section-title">
                <div class="modal fade" id="invoice-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo app('translator')->get('Invoices Modal'); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="bet-btn" id="final-print" data-bs-dismiss="invoice-modal"><?php echo app('translator')->get('Print'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction_wrapper float_left smoke_bg ">
                    <div class="row p-3">
                        <div id="live-container" class="col-lg-10" >
                            <div class="d-flex flex-wrap">
                                <div class="ms-lg-2 col-lg mt-sm-3 mt-lg-0 col-sm-12 shadow rounded-3 d-flex flex-column matches-table p-0" id="live-teams-section" >
                                    <div class="d-flex align-items-center header" style="background: linear-gradient(to bottom,#567499 15%,#023a68 58%);padding: 10px;">
                                        <img src="<?php echo e(asset('templates/img/live.png')); ?>" alt="">
                                        <h2 style="margin: 0;font-size: 14px;padding: 0;margin:0 10px">Live Matches</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="row shadow bg-light rounded-3 bets-table" style="display: flex;">
                                <div style="background: linear-gradient(to bottom,#214b80 0%,#02223c 100%);" class=" d-flex align-items-center container-lg container-sm-fluid text-center header border-bottom pt-1 pb-1">
                                    <img src="<?php echo e(asset('templates/img/kupon.png')); ?>" alt="">
                                    <h2 style="margin: 0!important;padding: 5px 0;padding-inline-start: 5px;color: white;font-size: 15px;text-align: start;"><?php echo app('translator')->get('BET SLIP'); ?></h2>

                                <!-- <h6 class="p-1 text-center" data-currency="<?php echo e($basic->currency); ?>" id="user-balance"><?php echo app('translator')->get('Balance'); ?>: 0</h6> -->
                                </div>
                                <div style="background-color: #701010;">
                                    <div class="d-flex align-items-center mb-1 mt-1">
                                        <div class="d-flex align-items-center mr-1" style="text-align: center; height: 35px;" width="140"><input type="text" name="rkodu" id="rkodu" style="border-style:solid; border-width:1px; font-size: 10pt; font-family: Arial; color: #003300; font-weight: bold; text-align:center; padding-left:2px; padding-right:2px; padding-top:1px; padding-bottom:1px; width:140px;background-color: #e8e8b3;height: 30px;"></div>
                                        <div style="text-align: center;" width="60"><input type="button" value="ADD" id="B4" name="B4" style="font-family: Arial; font-size: 10pt;width: 50px;;height: 30px; background-color: #a90404; font-weight: 600;color:white;"></div>
                                    </div>
                                </div>
                                <div class="alert alert-success" id="bet-status"></div>
                                <div class="" id="bets">
                                </div>
                                <div class="text-white bet-container p-2 bg-white shadow-sm amount-container" id="bets-calculator" style="display: block;">
                                    <div class="fw-bold d-flex justify-content-between">
                                        <span class="text-white">X  : </span>
                                        <span class="text-white" id="total-bet-rate">0</span>
                                    </div>
                                    <div class="input-group input-group-sm mt-3">
                                        <span class="input-group-text" id="bet-amount"><?php echo app('translator')->get('Amount'); ?></span>
                                        <input type="number" min="1" value="1" class="form-control" id="amount" placeholder="amount" aria-label="bet-amount" aria-describedby="bet-amount">
                                    </div>
                                    <div class="input-group input-group-sm mt-1">
                                        <span class="input-group-text" id="player-name"><?php echo app('translator')->get('Player'); ?></span>
                                        <input type="text" class="form-control" placeholder="Player" aria-label="player-name" aria-describedby="player-name">
                                    </div>
                                    <div class="pt-2 fw-bold d-flex justify-content-between">
                                        <spam><?php echo app('translator')->get('Total Win'); ?></spam>
                                        <span class="text-white" id="total-win">0</span>
                                    </div>
                                    <div class="pt-3 d-flex justify-content-center">
                                        <button class="bet-btn" id="bet"><?php echo app('translator')->get('Bet Now'); ?></button>
                                    </div>
                                </div>
                                <div class="p-0 bg-black DailyBetsCard" style="display:none">
                                    <div class="cacel-bet">
                                        <span class="spn-bet">تفاصيل الرهانات</span>
                                        <img src="<?php echo e(asset('images/kapat.png')); ?>" alt="">
                                    </div>
                                    <div id="invoice-details">
                                        <div class="row p-2">
                                            <span class="col-6 text-white text-start">معرف الرهان :</span>
                                            <span class="col-6 text-white text-start" id="coupon_id"></span>
                                            <span class="col-6 text-white text-start">المبلغ :</span>
                                            <span class="col-6 text-white text-start" id="amount"></span>
                                            <span class="col-6 text-white text-start">أرباح المحتملة :</span>
                                            <span class="col-6 text-white text-start" id="possible_win"></span>
                                        </div>
                                        <div class="row p-2 bet-details">
                                            
                                            
                                            
                                            
                                            
                                            
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($invoices): ?>
                                <div class="row shadow bg-light rounded-3">
                                    <div style="background: linear-gradient(to bottom,#214b80 0%,#02223c 100%);" class=" d-flex align-items-center container-lg container-sm-fluid text-center header border-bottom pt-1 pb-1">
                                        <img src="<?php echo e(asset('templates/img/kupon.png')); ?>" alt="">
                                        <h2 style="margin: 0!important;padding: 5px 0;padding-inline-start: 5px;color: white;font-size: 15px;text-align: start;"><?php echo app('translator')->get('Daily Bets'); ?></h2>
                                    </div>
                                    <div class="bg-black shadow-sm tickets-container p-0" id="tickets-container">
                                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="p-2 d-flex justify-content-between align-items-center bet-tick" data-id="<?php echo e($invoice->id); ?>">
                                                <span class="text-white"><?php echo e(date('H:i', strtotime($invoice->date))); ?></span>
                                                <span class="text-white"><?php echo e($invoice->amount); ?></span>
                                                <span <?php echo e($invoice->status=='Lose' ? 'style=color:#ff6666':'style=color:#66ff50'); ?>><?php echo e($invoice->status); ?></span>
                                                <img src="<?php echo e(asset('templates/img/arrowt.gif')); ?>" alt="">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
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
                                            const event_data = JSON.stringify({country_name: last_country_data['real_name'], league_name:league_info, home_team: match['home_team_name'], away_team: match['away_team_name'], event_id: match['home_team_name']});
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
                                        <div class="col-1 text-center draw text-dark fw-bold p-2" style="background: #e2e2e2;border-right:1px solid #000;border-left:1px solid #000;"  data-selection-name="draw" data-bet-value="${match['draw']}">
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
                                        <div class="col-1">
                                        <img src="https://cdn.o-betgaming.com/lflags/plus.png" alt="" style="width: 35px;">
                                        </div>
                                    </div>
                               `
                                        });
                                        $('.opponent').on('click', function (){
                                            const team_name = $(this).data('selection-name');
                                            const bet_value = $(this).data('bet-value');
                                            makeBet($(this), team_name, bet_value);
                                        });
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
                    let last_country_data = {}
                    function makeBet(element, selection_name, bet_value){
                        const event_data = element.parent().data('event');
                        const event_id = '55'
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
                                                            <img src='<?php echo e(asset('images/kapat.png')); ?>' />
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
                            $('#user-balance').text(`Balance: ${response_data.balance} <?php echo e($basic->currency); ?>`);
                            $(".bets-table").show();
                        });
                        // request('available_sports', function(result){
                        //     fetchCountriesMenu(result);
                        //     setInterval(function(){if (update && last_country_data['country_name'])
                        //         getMatchesByCountry(last_country_data['country_name'],
                        //             last_country_data['write'], last_country_data['time'], true)
                        //     }, 1000 * 60 * 10);
                        // });
                        <?php if(auth()->check()): ?>
                        getDailyBets();
                        <?php endif; ?>
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
                                $('#user-balance').text(`Balance: ${result.balance} <?php echo e($basic->currency); ?>`);
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

    <div class="modal modal-sport fade" id="sportModal" tabindex="-1" role="dialog" aria-labelledby="sportModalTitle"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-sport-confrontation text-white font-20"
                        id="sportModalTitle"><?php echo app('translator')->get('Prediction Now'); ?></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?php echo e(route('prediction')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body text-center">
                        <p class="modal-sport-wager-title">
                            <span class="modal-sport-wager"></span>
                            <span class="modal-sport-wager-count"></span>
                        </p>

                        <p class="modal-sport-live">
                                <span class="font-weight-bold"><?php echo app('translator')->get('MINIMUM PREDICT AMOUNT'); ?> <span
                                            class="minamo"></span> <?php echo e(__($basic->currency)); ?></span>
                        </p>
                        <div class="stepper-sport">
                            <div class='ctrl'>
                                <div class='ctrl__button ctrl__button--decrement'>&ndash;</div>
                                <div class='ctrl__counter'>
                                    <input name="invest_amount"
                                           class='ctrl__counter-input form-input  invest_amount_min ronnie_bet get_amount_for_ratio'
                                           maxlength='10' type='text' value='' min="" max=""
                                           onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                </div>
                                <div class='ctrl__button ctrl__button--increment'>+</div>
                            </div>
                        </div>


                        <input type="hidden" value="" name="betoption_id" id="betoption_id">
                        <input type="hidden" value="" name="match_id" id="match_id">
                        <input type="hidden" value="" name="betquestion_id" id="questionid">
                        <input class="ratio1" type="hidden" value="" id="ratioOne">
                        <input class="ratio2" type="hidden" value="" id="ratioTwo">
                        <input class="form-control input-lg ronnie_ratio" name="return_amount" type="hidden">
                    </div>
                    <div class="modal-footer">
                        <small>(<?php echo app('translator')->get('IF YOU WIN'); ?>)</small>
                        <p class="modal-sport-win">
                            <span class="font-weight-bold"><?php echo app('translator')->get('RETURN AMOUNT'); ?></span>
                            <span class="font-weight-bold"><span class="wining-rate"></span> <?php echo e($basic->currency); ?></span>
                        </p>
                        <p class="text-danger"><?php echo e($basic->win_charge); ?>% <?php echo app('translator')->get('Charge Apply From This Amount'); ?>
                            (<?php echo app('translator')->get('IF YOU WIN'); ?>) </p>
                        <p class="text-success"><?php echo app('translator')->get('Maximum'); ?> <span
                                    class="betlimit"></span><?php echo e($basic->currency); ?> <?php echo app('translator')->get('Predict in this Option'); ?>  </p>

                        <?php if(Auth::user()): ?>
                            <div class="form-element mt-2">
                                <button type="submit"><span><?php echo app('translator')->get('Predict Now'); ?></span>
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="form-element mt-2">
                                <a href="<?php echo e(route('login')); ?>" class="cartbtn cart"><?php echo app('translator')->get('Predict Now'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

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
<?php $__env->stopSection(); ?>



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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/ui/livesport.blade.php ENDPATH**/ ?>