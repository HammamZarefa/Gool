<div class="modal fade" id="invoice-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                {{--<h5 class="modal-title">@lang('Invoices Modal')</h5>--}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="bet-btn" id="final-print"
                        data-bs-dismiss="invoice-modal">@lang('Print')</button>
            </div>
            <div class="modal-body" id="modal-body">
            </div>

        </div>
    </div>
</div>


<div class="ms-lg-2 col-lg-2 col-sm-12 mt-sm-2 mb-sm-3 mb-lg-0 mt-lg-0">
    <div class="row shadow bg-light rounded-3 bets-table" style="display: flex;">
        <div style="background: linear-gradient(to bottom,#214b80 0%,#02223c 100%);"
             class=" d-flex align-items-center container-lg container-sm-fluid text-center header border-bottom pt-1 pb-1">
            <img src="{{asset('templates/img/kupon.png')}}" alt="">
            <h2 style="margin: 0!important;padding: 5px 0;padding-inline-start: 5px;color: white;font-size: 15px;text-align: start;">@lang('BET SLIP')</h2>
        </div>
        <div style="background-color: #701010;">

            <span id="cancelall" class="text-white" style="font-size: 10pt;width: 150px;height: 25px; background-color: #0a2d4f; color:white;display: none;" onclick="cancelAll()" >Cancel All
                <span id="betscount" style="color: white;"></span></span>

            <div class="d-flex align-items-center mb-1 mt-1">
                <div class="d-flex align-items-center mr-1" style="text-align: center; height: 35px;" width="140"><input
                            type="text" name="rkodu" id="rkodu"
                            style="border-style:solid; border-width:1px; font-size: 10pt; font-family: Arial; color: #003300; font-weight: bold; text-align:center; padding-left:2px; padding-right:2px; padding-top:1px; padding-bottom:1px; width:140px;background-color: #e8e8b3;height: 30px;">
                </div>
                <div style="text-align: center;" width="60">
                    <input type="button" value="ADD" id="B4" name="B4" style="font-family: Arial; font-size: 10pt;width: 50px;;height: 30px; background-color: #a90404; font-weight: 600;color:white;">
                </div>
            </div>
        </div>
        <div class="alert alert-success" id="bet-status"></div>
        <div class="" id="bets">
        </div>
        <div class="text-white bet-container p-2 bg-white shadow-sm amount-container" id="bets-calculator"
             style="display: block;">
            <div class="fw-bold d-flex justify-content-between">
                <span class="text-white">X  : </span>
                <span class="text-white" id="total-bet-rate">1</span>
            </div>
            <div class="input-group input-group-sm mt-3">
                <span class="input-group-text" id="bet-amount">@lang('Amount')</span>
                <input type="number" min="1" value="1" class="form-control" id="amount" placeholder="amount"
                       aria-label="bet-amount" aria-describedby="bet-amount">
            </div>
            <div class="input-group input-group-sm mt-1">
                <span class="input-group-text" id="player-name">@lang('Player')</span>
                <input type="text" class="form-control" placeholder="Player" aria-label="player-name"
                       aria-describedby="player-name">
            </div>
            <div class="pt-2 fw-bold d-flex justify-content-between">
                <spam>@lang('Total Win')</spam>
                <span class="text-white" id="total-win">0</span>
            </div>
            <div class="pt-3 d-flex justify-content-center">
                <button class="bet-btn" id="bet" @guest disabled @endguest> @lang('Bet Now')</button>
            </div>
        </div>
        <div class="p-0 bg-black DailyBetsCard" style="display:none">
            <div class="cacel-bet">
                <span class="spn-bet">تفاصيل الرهانات</span>
                <img src="{{asset('images/kapat.png')}}" alt="">
            </div>
            <div id="invoice-details">
                <div class="row p-2" id="betid">
                    <span class="col-6 text-white text-start">معرف الرهان :</span>
                    <span class="col-6 text-white text-start" id="coupon_id"></span>
                    <span class="col-6 text-white text-start">المبلغ :</span>
                    <span class="col-6 text-white text-start" id="betamount"></span>
                    <span class="col-6 text-white text-start">أرباح المحتملة :</span>
                    <span class="col-6 text-white text-start" id="possible_win"></span>
                </div>
                <div class="row p-2 bet-details" style="margin-left: 10px; margin-right: -10px">
                    {{--<span class="col-6 text-white text-start">07-17 16:30</span>--}}
                    {{--<span class="col-6 text-white text-end"><img src="{{asset('templates/img/livek.png')}}" alt=""></span>--}}
                    {{--<span class="col-12 text-white text-start">موزامبيق-السنغال</span>--}}
                    {{--<span class="col-12 text-white text-start">أكثر/ اقل من 0.5 في شوط الأول </span>--}}
                    {{--<span class="col-6 text-white text-start">اعلى</span>--}}
                    {{--<span class="col-6 text-white text-end">00 </span>--}}
                    {{--<button class="bet-btn" style="width: 90%;margin: auto;">@lang('Print')</button>--}}

                </div>
            </div>
        </div>
    </div>
    @if($invoices)
        <div class="row shadow bg-light rounded-3">
            <div style="background: linear-gradient(to bottom,#214b80 0%,#02223c 100%);"
                 class=" d-flex align-items-center container-lg container-sm-fluid text-center header border-bottom pt-1 pb-1">
                <img src="{{asset('templates/img/kupon.png')}}" alt="">
                <h2 style="margin: 0!important;padding: 5px 0;padding-inline-start: 5px;color: white;font-size: 15px;text-align: start;">@lang('Daily Bets')</h2>
            </div>
            <div class="bg-black shadow-sm tickets-container p-0" id="tickets-container">
                @foreach($invoices as $invoice)
                    <div class="p-2 d-flex justify-content-between align-items-center bet-tick"
                         data-id="{{$invoice->id}}" style="height: 25px;">
                        <span class="text-white">{{date('H:i', strtotime($invoice->date))}}</span>
                        <span class="text-white">{{$invoice->amount}}</span>
                        <span {{$invoice->status=='Lose' ? 'style=color:#ff6666':($invoice->status=='Win' ?'style=color:#66ff50' : 'style=color:#ffc30c')}}>{{trans($invoice->status)}}</span>
                        <img src="{{asset('templates/img/arrowt.gif')}}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
    @auth
    $('#tickets-container .bet-tick').on('click', function () {
        const id = $(this).data('id');
        request(`invoiceshow?invoice_id=${id}`, function (result) {
            const response_data = (result);
            $("#coupon_id").html(response_data.coupon_id);
            if (response_data.status == 'Win')
                $("#betid").css("background", "#060");
            $("#betamount").html(response_data.amount);
            if (response_data.status == 'Lose')
                $("#possible_win").html('0,00');
            else
                $("#possible_win").html(response_data.possible_win);
            $(".divmatch").remove();
            $("#btnnn").remove();
            $.each(response_data.bets, function (item, betting) {
                var divmatch = ` <div class="row p-2 divmatch"  ${betting.result == 1 ? 'style="background:#437343; "' : 'style="background:#563535;"'}>
                            <span class="col-6 text-white text-start">${betting.match_date} ${betting.match_time}</span>
                            <span class="col-6 text-white text-end"><img src="{{asset('templates/img/livek.png')}}" alt=""></span>
                            <span class="col-12 text-white text-start">${betting.home_team} - ${betting.away_team}</span>
                            <span class="col-12 text-white text-start">${betting.bet_type} </span>
                            <span class="col-6 text-white text-start">${betting.bet_value}</span>
                            <span class="col-6 text-white text-end">${betting.return_amount} </span>
                            </div>`
                $(".bet-details").append($(divmatch));
            })
            $(".bet-details").append($(
                ` <button onclick="myFunction10(${id})" id="btnnn" class="bet-btn" style="width: 90%;margin: auto;">@lang('Print')</button>`
            ));

        });
        $(".DailyBetsCard").show();
    });
    @endauth
    $('.cacel-bet').on('click', function () {
        $(".DailyBetsCard").hide();
    });

    @auth
    function myFunction10(id) {
        request(`invoiceshow?invoice_id=${id}`, function (result) {
            const m = new Date();
            let paid_amount = result.amount;
            let return_amount = result.possible_win;
            let odds = result.odds;
            let table_data = '';
            $.each(result.bets, function (index, bet) {
                // paid_amount += parseFloat(bet.predict_amount);
                // return_amount *= parseFloat(bet.return_amount);
                table_data += `
                                                         <div class="container mb-3">
                                                            <div class="d-flex flex-column border border-2 border-dark p-2">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <span class="text-white fw-bolder">${bet.league_name}</span>
                                                                    <span class="text-white fw-bolder">${bet.match_date} ${bet.match_time}</span>
                                                                </div>
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <span class="text-white fw-bolder">${bet.home_team} vs ${bet.away_team}</span>
                                                                </div>
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <span class="text-white fw-bolder">${bet.bet_type}: ${bet.bet_value}</span>
                                                                    <span class="text-white fw-bolder">${bet.return_amount}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    `;
            });
            const dateString =
                m.getUTCFullYear() + "/" +
                ("0" + (m.getUTCMonth() + 1)).slice(-2) + "/" +
                ("0" + m.getUTCDate()).slice(-2) + " " +
                ("0" + m.getUTCHours()).slice(-2) + ":" +
                ("0" + m.getUTCMinutes()).slice(-2) + ":" +
                ("0" + m.getUTCSeconds()).slice(-2);
            $("#modal-body").append($(`
                                <div id="invoice">
                                    <div class="container mb-3">
                                        <div class="d-flex flex-column border border-2 border-dark p-2">
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-white fw-bolder">اسم المستخدم:</span>
                                                <span class="text-white fw-bolder">{{auth()->user()->username}}</span>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-white fw-bolder">معرف الكوبون:</span>
                                                <span class="text-white fw-bolder">${result.coupon_id}</span>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-white fw-bolder">تاريخ:</span>
                                                <span class="text-white fw-bolder">${result.date}</span>
                                            </div>
                                        </div>
                                    </div>
                                    ${table_data}
                                    <div class="container mb-3">
                                        <div class="d-flex flex-column border border-2 border-dark p-2">
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-white fw-bolder">المبلغ:</span>
                                                <span class="text-white fw-bolder">${paid_amount} </span>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <span class="text-white fw-bolder">ارقام زوجيه:</span>
                                                <span class="text-white fw-bolder">${odds}</span>
                                            </div>
                                            <div class="d-flex w-100 justify-content-center">
                                                <span class="text-white fw-bolder">${return_amount}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    `))
            const modal = $('#invoice-modal');
            modal.modal('show');
            $('.DailyBetsCard').hide();
        });
        $("#final-print").on('click', function () {
            w = window.open();
            w.document.write(`
                                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
                                        `);
            w.document.write(document.getElementById("invoice").innerHTML);
            setTimeout(function () {
                w.print()
                w.close();
            }, 100);

        });
    }
    @endauth
function cancelAll() {
        $(".bet").remove();
        $("#total-bet-rate").text(1);
        $("#bets-calculator").hide();
        $("#cancelall").hide();
        [$(".check")].forEach(sub => sub.removeClass('check'));
    }
</script>