<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('templates/css/custom.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="vehicles-area home-2">
        <div>
            <div class="section-title">
                <div id="betting-container" class="main-container mt-3" >
                    <div class="d-flex flex-wrap" style='display: flex;'>
                       <?php echo $__env->make('partials.left_panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="ms-lg-2 col-lg mt-sm-3 mt-lg-0 col-sm-12 shadow rounded-3 d-flex flex-column matches-table pb-3" id="teams-section">
                            <div id="date-match-list" class="text-center header d-flex align-items-center" style="background: linear-gradient(to bottom,#567499 15%,#023a68 58%); height: 50px;">
                                <div class="date-match" style="order: 8;">
                                    <div>All</div>
                                    <div class="curr-date" style="opacity: 0;">All</div>
                                </div>
                            </div>
                            <div class="search-bar" style="padding-top: 10px;padding-left: 6px;background: black;">
                                <img src="<?php echo e(asset('images/search_icon.png')); ?>" width="24" height="24" style="cursor:pointer;float:left" onclick=(Search())>
                                <input type="text" id="search-box" style="border-style:none; border-width:0; font-size:10pt;color: #000; font-family:Verdana; height:26px; width:200px; margin-left:10px;border-radius: 5px; float: left;" placeholder="<?php echo app('translator')->get('Search'); ?>" name="search-box">
                            </div>
                        </div>
                      <?php echo $__env->make('partials.right_panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                
                
            </div>

            <script>
                var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                var d = new Date();
                var a = new Date(d);
                var weekdaySlice = weekday.slice(0,a.getDay());
                var weekdaySlice2 = weekday.slice(a.getDay(),weekday.length);
                var weekdayNow = weekdaySlice2.concat(weekdaySlice);
                for (var i = 0; i < 7; i++) {
                    var day = new Date();
                    var days = i - day.getDay() + 4;
                    var nextDay = new Date(day.setDate(day.getDate() + days));
                    var nextWeek = nextDay.getDate();
                    let month = nextDay.getMonth()+1;
                    if(i == 0){
                        $("#date-match-list").append($(
                            `
                                        <div class="active date-match" style="height: 53px;">
                                            <div>Today</div>
                                            <div class="curr-date">${month}/${nextWeek}</div>
                                        </div>
                                        `
                        ));
                    }
                    else{
                        $("#date-match-list").append($(
                            `
                                        <div class="date-match">
                                            <div>${weekdayNow[i]}</div>
                                            <div class="curr-date" data-index="${i}">${month}/${nextWeek}</div>
                                        </div>
                                        `
                        ));
                    }
                }
                $('#date-match-list .date-match').on('click', function(){
                    $("#date-match-list .date-match").removeClass('active');
                    $(this).addClass('active');
                    $(".date-match").attr("data-index")
                    getMatchesByCountry('ALL',$(this).find('.curr-date').attr('data-index'),$(this).find('.curr-date').attr('data-index'))
                    $(`.date-match`).each(function() {
                        if($( this ).attr('data-index') != $(this).find('.curr-date').attr('data-index')){
                            $( this ).addClass( "hide" );
                        }
                    });
                });
                let update = false;
                let last_request = {};
                let matches = {}
                let last_country_data = {}
                function makeBet(element, selection_name, bet_value,val_name){
                    const event_data = element.parent().data('event');
                    const event_id = event_data.event_id
                    let last_bet_value = 1;
                    const last_bet = $("#bet-" + event_id);
                    if (last_bet.length){
                        [element.siblings()].forEach(sib => sib.removeClass('check'));
                        last_bet_value = last_bet.data('event-info').bet_value;
                        last_bet.remove();
                        $("#modal-"+ event_id +" .check").removeClass('check');
                    }
                    if(element.hasClass('check'))
                    {
                        element.removeClass('check');
                    }
                    else {
                        element.addClass('check');
                    }
                    event_data.selection_name = selection_name;
                    event_data.bet_value = bet_value;
                    event_data.val_name = val_name;
                    $("#amount").val('1');
                    const event_json = JSON.stringify(event_data);
                    const bet_item = $(`<div class="border-bottom bet" id="bet-${event_id}" data-event-info='${event_json}'>
                                                    <div class="d-flex align-items-center pt-1">
                                                        <div class="col-10 font-sm text-start p-1">
                                                            ${event_data.home_team}
                                                            -
                                                            ${event_data.away_team}
                                                        </div>
                                                        <div class="col-2">
                                                        <div class="cancel-bet">
                                                            <span data-event-id="${event_id}">
                                                                <img src='<?php echo e(asset('images/kapat.png')); ?>' />
                                                            </span>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-2 text-white text-start">${val_name != undefined ? val_name:'MAC BAHISI'}</div>
                                                    <div class="p-2 d-flex justify-content-between">
                                                        <span class="text-white" id="bet-team-${event_id}">${selection_name}</span>
                                                        <span class="text-white" id="bet-strength-${event_id}">${bet_value}</span>
                                                    </div>
                                                </div>`);
                    $total=
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

                // function updateTickets() {
                //     request(`matches?country_name=${country_name}&write=${write}&time=${time}`,
                //         function(result) {
                //             const response_data = (result);
                //         });
                // }

                function getMatchesByCountry(country_name='ALL', write=0, time=0, updater=false, country_real_name=""){
                    last_country_data = {
                        country_name: country_name,
                        write: write,
                        time:time,
                        real_name: country_real_name
                    };
                    request(`matches?country_name=${country_name}&write=${write}&time=${time}`,
                        function(result){
                            const response_data = (result);
                            matches = response_data;
                            $.each($('.league'), function(index, item){
                                $(item).remove();
                            });
                            $.each($('.match'), function (index, item){
                                $(item).remove();
                            });
                            if (Object.keys(response_data).length)
                                $("#no-matches").hide();
                            else {
                                $("#no-matches").show();
                                $("#no-matches .message").text('No Matches Exist Today');
                            }
                            $.each(response_data, function(league_name, league_matches){
                                const league_flag = league_matches['flag'];
                                delete league_matches['flag'];
                                let table = ``;
                                $.each(league_matches, function(index, match){
                                    const event_data = JSON.stringify({country_name: league_flag, league_name:league_name, home_team: match['first_opponent']['name'], away_team: match['second_opponent']['name'], start_time: match['start_time'], start_date: match['day'], event_id: match['bet_info']['event_id']});
                                    table += `
                                    <div id="match-event-${match['bet_info']['event_id']}" class="row fw-bold d-flex align-items-center justify-content-center shadow-sm  match" data-date='${match['day']}' data-event='${event_data}'>
                                        <div class="col-1 text-white">${match['day']}</div>
                                        <div class="col-1 text-white">${match['start_time']}</div>
                                        <div  class="pt-1 pb-1 col-4 d-flex align-items-center opponent bg-white" data-selection-name="${match['first_opponent']['name']}" data-bet-value="${match['first_opponent']['strength']}">
                                            <div class="col-2">
                                                <img class="float-right" style="width: 25px; height: 25px;" src="${match['first_opponent']['flag']}">
                                            </div>
                                            <div class="col-8 text-center fw-bold text-dark p-0">
                                                  ${match['first_opponent']['name']}
                                            </div>
                                            <div class="col-2 fw-bold text-dark">
                                                    ${match['first_opponent']['strength']}
                                            </div>
                                        </div>
                                        <div style='height: 33px;' class="border-right border-left border-dark col-1 text-center draw text-dark bg-white opponent" data-selection-name="draw" data-bet-value="${match['draw']}">
                                            ${match['draw']}
                                        </div>
                                        <div  class="pt-1 pb-1 col-4 d-flex align-items-center opponent text-dark bg-white" data-selection-name="${match['second_opponent']['name']}" data-bet-value="${match['second_opponent']['strength']}">
                                            <div class="col-2 fw-bold">
                                                     ${match['second_opponent']['strength']}
                                            </div>
                                            <div class="col-8 text-center fw-bold text-dark p-0">
                                                    ${match['second_opponent']['name']}
                                            </div>
                                            <div class="col-2">
                                                <img class="float-left" style="width: 25px; height: 25px;" src="${match['second_opponent']['flag']}">
                                            </div>
                                        </div>
                                        <div class="col-1 text-center bet-info text-white" data-event-id="${match['bet_info']['event_id']}">
                                            ${match['bet_info']['bet_value']}
                                        </div>
                                    </div>
                               `
                                });
                                $("#teams-section").append($(
                                    `<div class="pt-1 pb-1 league">
                                         <div class="d-flex align-items-center">
                                            <span class="">
                                                <img src="${league_flag}">
                                            </span>
                                            <h4 class="ps-sm-2  text-center text text-light" style="font-size: 16px">${league_name}</h4>
                                         </div>
                                         <div class="">` + table +`</div>`
                                ));
                            });
                            var sel2 = $(this).find('.curr-date').html();
                            $('.opponent').on('click', function (){
                                $('#betscount').text(' ('+$(".bet").length+')')
                                const team_name = $(this).data('selection-name');
                                const bet_value = $(this).data('bet-value');
                                if($(this).hasClass('check')) {
                                    $(this).removeClass('check');
                                    const betting=$("#bet-" + $(this).parent().data('event').event_id)
                                    $("#amount").val('1');
                                    $("#total-bet-rate").text((parseFloat($("#total-bet-rate").text()) / parseFloat(bet_value)).toFixed(3))
                                    $("#total-win").text((parseFloat($("#amount").val()) * parseFloat($("#total-bet-rate").text())).toFixed(3));
                                    betting.remove();
                                    if ($('.bet').length === 0)
                                        $('#bets-calculator').hide();
                                }
                                else {
                                    makeBet($(this), team_name, bet_value);
                                }

                            });
                            $('.bet-info').on('click', function(){
                                const event_id = $(this).data('event-id');
                                request(`event_info?event_id=${event_id}`, function(result){
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
                                                        <div class="col-4 text-center sub-opponent"
                                                        data-opponent='${JSON.stringify(home_team_data)}'>
                                                            <span class="fw-bold float-left">${item[0][0] ? item[0][0] + ' : ' : ''}</span>
                                                            <span class="fw-bold float-right">${item[0][1]}</span>
                                                        </div>
                                                        <div class="col-4 text-center text-muted sub-opponent" data-opponent='${JSON.stringify(draw_data)}'>
                                                            <span class="fw-bold">${item[1][0] ? item[1][0] + ' : ' : ''}</span>
                                                            <span class="fw-bold">${item[1][1]}</span>
                                                        </div>
                                                        <div class="col-4 text-center sub-opponent" data-opponent='${JSON.stringify(away_team_data)}'>
                                                            <span class="fw-bold float-left">${item[2][0] ? item[2][0] + ' : ' : ''} </span>
                                                            <span class="fw-bold float-right">${item[2][1]}</span>
                                                        </div>
                                                    </div>`);
                                            rows += bet_item.get(0).outerHTML;
                                        });
                                        modal_body += `
                                                    <div class='container bg-light shadow-sm p-2 mt-2 rounded-3'>
                                                        <h4 class="text-muted text-center p-2 border-bottom opponent">${name}</h4>
                                                        <div class="container mt-1 mb-1">
                                                            ${rows}
                                                        </div>
                                                    </div>
                                    `;
                                    });
                                    $(`<div class="modal" tabindex="-1">
                                              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title">Match Statistics</h5>
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
                            $('#amount').on('change', function(){
                                $("#total-win").text((parseFloat($("#total-bet-rate").text()) * parseFloat($(this).val())).toFixed(3))
                            });
                            update = true;
                        }, !updater);
                }

                $(function(){
                    $("#bet-status").hide();
                    $("#bets-calculator").hide();
                    $(".bets-table").show();
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
                    $("#bet").on('click', function() {
                        const bets_items = $(".bet");
                        const bets = {
                            amount: $("#amount").val(),
                            total_bets: [],
                            x:$("#total-bet-rate").text()
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
                            $('#user-balance').text(`Balance: ${result.balance}`);
                            // getDailyBets();
                            $("#amount").val(1);
                            [$(".check")].forEach(sub => sub.removeClass('check'));
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                getMatchesByCountry();

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

        function Search() {
            filter=$("#search-box").val();
            count = 0;
            // Loop through the comment list
            $('.opponent').each(function() {
                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(filter) < 0) {
                    $(this).parent().attr('style','display:none !important');  // MY CHANGE

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).parent().show(); // MY CHANGE
                    count++;
                }
                    // console.log($('.league').children(':visible').length  )
                    //   if($('.league').children(':visible').length < 1) {
                    //       $(this).attr('style','display:none !important');
                    //   }

            });

            // var input, filter, ul, li, a, i, txtValue;
            // input = document.getElementById("myInput");
            // filter = input.value.toUpperCase();
            // ul = document.getElementById("myUL");
            // li = ul.getElementsByTagName("li");
            // for (i = 0; i < li.length; i++) {
            //     a = li[i].getElementsByTagName("a")[0];
            //     txtValue = a.textContent || a.innerText;
            //     if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //         li[i].style.display = "";
            //     } else {
            //         li[i].style.display = "none";
            //     }
            // }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\gool10bet\resources\views/ui/home1.blade.php ENDPATH**/ ?>