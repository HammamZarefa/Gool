<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
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

        .left-panel {
            max-height: 95vh;
            overflow-y: auto;
        }

        .left-panel .header{
            position: sticky;
            top: 0;
        }

        .left-panel .sublist-header{
            position: sticky;
            top: 50px;
        }

        .matches-table{
            max-height: 95vh;
            overflow-y: auto;
        }

        .matches-table .header{
            position: sticky;
            top: 0;
        }

        .bets-table{
            max-height: 50vh;
            overflow-y: auto;
        }

        .bets-table .header{
            position: sticky;
            top: 0;
        }

        .loading-spinner{
            position: absolute;
            top: 0;
            height: 100vh;
            width: 100vw;
            left: 0;
            z-index: 9999;
        }

        .first-opponent, .second-opponent, .draw, .bet-info{
            cursor: pointer;
        }

        .first-opponent:hover, .second-opponent:hover, .draw:hover{
            color: dimgray;
        }

    </style>
</head>
<body>
<div class="loading-spinner bg-white d-flex justify-content-center align-items-center">
    <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="main-container container-fluid mt-3">
    <div class="d-flex flex-wrap">
        <div class="col-lg-2 col-sm-12 shadow bg-light rounded-3 left-panel">
            <div class="container-lg container-sm-fluid text-center pb-3 bg-light header">
                <h2>Sports Bets</h2>
            </div>
            <div class="container-lg container-sm-fluid" id="sports-menu">
            </div>
        </div>
        <div class="ms-lg-2 col-lg-8 mt-sm-2 mt-lg-0 col-sm-12 shadow bg-light rounded-3 d-flex flex-column matches-table" id="teams-section">
            <div class="text-center pt-3 bg-light header border-bottom d-flex flex-column align-items-center">
                <h2 class="mb-3">Matches List</h2>
                <!--                    <div class="form-floating mb-3 w-50">-->
                <!--                        <input type="text" class="form-control" id="search" placeholder="Search By Team Name" min="0">-->
                <!--                        <label for="fast-bet">Search By Team Name</label>-->
                <!--                    </div>-->
            </div>
        </div>
        <div class="ms-lg-2 col-lg col-sm-12 mt-sm-2 mb-sm-2 mb-lg-0 mt-lg-0 shadow bg-light rounded-3 bets-table">
            <div class="container-lg container-sm-fluid text-center pt-3 header border-bottom">
                <h2>BET SLIP</h2>
                <div class="container-lg container-sm-fluid">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="fast-bet" placeholder="Fast Betting" min="0">
                        <label for="fast-bet">Fast Betting</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let last_request = {};
    async function request(endpoint, callback, with_spinner=true){
        const api = `/api/${endpoint}`;

        if (with_spinner) {
            $('.loading-spinner').removeClass('d-none');
            $('.loading-spinner').addClass('d-flex');
        }

        if (last_request[endpoint])
            last_request[endpoint].abort();

        last_request[endpoint] = $.ajax({
            url:api,
            success:callback
        })
        await last_request[endpoint];

        if (with_spinner) {
            $('.loading-spinner').addClass('d-none');
            $('.loading-spinner').removeClass('d-flex');
        }
    }

    $(function(){
        let last_country_data = {}
        let last_search = "";
        let matches = {}

        function getMatchesByCountry(country_name='ALL', write=0, time=0, updater=false){
            last_country_data = {
                country_name: country_name,
                write: write,
                time:time
            };

            request(`matches?country_name=${country_name}&write=${write}&time=${time}`,
                function(result){
                    const response_data = (result);
                    matches = response_data;

                    $.each($('.league'), function(index, item){
                        $(item).remove();
                    });

                    $.each(response_data, function(league_name, league_matches){
                        const league_flag = league_matches['flag'];
                        delete league_matches['flag'];
                        let table = ``;
                        $.each(league_matches, function(index, match){
                            table += `
                                    <div class="ms-4 me-4 row bg-white fw-bold p-3 border-bottom d-flex align-items-center justify-content-center shadow-sm rounded-3 mb-1 match">
                                        <div class="col-1">${match['day']}</div>
                                        <div class="col-1">${match['start_time']}</div>
                                        <div class="col-4 d-flex align-items-center first-opponent">
                                            <div class="col-2">
                                                <img class="float-right" style="width: 25px; height: 25px;" src="${match['first_opponent']['flag']}">
                                            </div>
                                            <div class="col-8 text-center">
                                                <span class="fw-bold oppenent-name">
                                                    ${match['first_opponent']['name']}
                                                </span>
                                            </div>
                                            <div class="col-2">
                                                <span class="fw-bold">
                                                    ${match['first_opponent']['strength']}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-1 text-center draw">
                                            ${match['draw']}
                                        </div>
                                        <div class="col-4 d-flex align-items-center second-opponent">
                                            <div class="col-2">
                                                <span class="fw-bold opponent-name">
                                                    ${match['second_opponent']['strength']}
                                                </span>
                                            </div>
                                            <div class="col-8 text-center">
                                                <span class="fw-bold">
                                                    ${match['second_opponent']['name']}
                                                </span>
                                            </div>
                                            <div class="col-2">
                                                <img class="float-left" style="width: 25px; height: 25px;" src="${match['second_opponent']['flag']}">
                                            </div>
                                        </div>
                                        <div class="col-1 text-center bet-info" data-event-id="${match['bet_info']['event_id']}">
                                            ${match['bet_info']['bet_value']}
                                        </div>
                                    </div>
                               `
                        });
                        $("#teams-section").append($(
                            `<div class="container-lg container-sm-fluid pt-3 pb-3 border-bottom league">
                                    <div class="d-flex align-items-center">
                                        <span class="ps-4 col-1">
                                            <img src="${league_flag}">
                                        </span>
                                        <h4 class="text-muted pt-2 text-center">${league_name}</h4>
                                    </div>
                                    <div class="container-lg container-sm-fluid pt-3">` + table +
                            `</div>
                               </div>`
                        ));
                    });

                    //
                    // $("#search").on('change', function(){
                    //     last_search = $(this).text
                    //     $('.match').each(function(index, item){
                    //         if (last_search.length){
                    //
                    //         }
                    //     });
                    // });

                    $('.bet-info').on('click', function(){
                        request(`event_info?event_id=${$(this).data('event-id')}`, function(result){
                            const response_data = (result);
                            let modal_body = '';
                            $.each(response_data, function(name, list){
                                let rows = '';

                                $.each(list, function (index, item){
                                    rows += `<div class='row bg-white border-bottom rounded p-2 mb-1 shadow-sm'>
                                                    <div class="col-4 text-center">
                                                        <span class="fw-bold float-left">${item[0][0] ? item[0][0] + ' : ' : ''}</span>
                                                        <span class="fw-bold float-right">${item[0][1]}</span>
                                                    </div>
                                                    <div class="col-4 text-center text-muted">
                                                        <span class="fw-bold">${item[1][0] ? item[1][0] + ' : ' : ''}</span>
                                                        <span class="fw-bold">${item[1][1]}</span>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <span class="fw-bold float-left">${item[2][0] ? item[2][0] + ' : ' : ''}</span>
                                                        <span class="fw-bold float-right">${item[2][1]}</span>
                                                    </div>
                                                </div>`;
                                })
                                modal_body += `
                                                    <div class='container bg-light shadow-sm p-2 mt-2 rounded-3'>
                                                        <h4 class="text-muted text-center p-2 border-bottom">${name}</h4>
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
                                          <div class="modal-body">
                                            ${modal_body}
                                          </div>
                                        </div>
                                      </div>
                                    </div>`).modal('show');
                        })
                    })
                }, !updater)
        }
        getMatchesByCountry();
        request('available_sports', function(result){
            const response_data = (result);
            $.each(response_data, function(index, item){
                $('#sports-menu').append(
                    $(`<div class="container-lg container-sm-fluid" id="${item}">
                                    <div class="d-flex border-bottom clickable main-category sublist-header bg-light">
                                         <h4 class="col-10">${item}</h4>
                                         <span class="col-2 text-center" id="teams-count-${item.replace(' ', '_')}">
                                         </span>
                                    </div>
                                    <div class="container-lg container-sm-fluid clickable subcategory mb-2" id="sub-category-${item.replace(' ', '_')}">
                                    </div>
                                </div>`));
                request(`countries?sport_name=${item}`, function(result){
                    const response_data = (result);
                    $('#teams-count-' + item.replace(' ', '_')).text(response_data[item.toLowerCase()]['teams_count']);
                    delete response_data[item.toLowerCase()]['teams_count'];
                    $.each(response_data[item.toLowerCase()], function(index, country){
                        const country_item = $(`<div class="d-flex align-items-center border-bottom country" data-league="${country['params']['league']}" data-time="${country['params']['time']}" data-write="${country['params']['write']}">
                                                <div class="col-2 ps-1">
                                                    <span>
                                                        <img src="${country['flag']}" height="20px" width="20px">
                                                    </span>
                                                </div>
                                                <div class="col-8 text-center">
                                                    <a href="#">${country['name']}</a>
                                                </div>
                                                <div class="col-2 pe-1">
                                                    <span class="text-muted float-end">${country['teams_count']}</span>
                                                </div>
                                            </div>`);
                        country_item.on('click', function(){
                            getMatchesByCountry($(this).data('league'), $(this).data('write'), $(this).data('time'));
                        })
                        $(`#sub-category-${item.replace(' ', '_')}`).append(country_item);
                    });
                })
            });
            $('.subcategory:not(:first)').hide();
            $('.main-category').on('click', function(){
                const subcategories = $('.subcategory')
                const subcategory = $(this).parent().find('.subcategory')?.first();
                $.each(subcategories, function (index, item){
                    if (!$(item).is(subcategory))
                        $(item).hide(100);
                })
                subcategory?.toggle(100);
            });

        });

        setInterval(function(){getMatchesByCountry(last_country_data['country_name'],
            last_country_data['write'], last_country_data['time'], true)}, 10000);
    });
</script>
</body>
</html>