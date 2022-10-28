<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->group(function(){
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::get('/bet','InvoiceController@store')->name('invoice');

    Route::get('/invoice', function(){
        return response()->json(\App\Bet::where('invoice_id', request()->get('invoice_id'))->get());
    });
});


Route::middleware(['cors'])->group(function(){
    Route::get('/available_sports', function(){
        // if (request()->get('lang', 'en') === 'ar')
            return response()->json(['كرة القدم', 'كرة السلة', 'كرة الطائرة', 'تنس', 'رياضات اخرى']);
        // return response()->json(['SOCCER', 'BASKETBALL', 'VOLLEYBALL', 'TENNIS', 'OTHER SPORTS']);
    });

    Route::get('/countries', function(){
        $sport_name = request()->get('sport_name', 'ALL');
        $wrapper = new App\Helpers\Cash2BetsSportsListAPI($sport_name, 'ar');
        $countries = $wrapper->fetchResults();
        $results = [strtolower($sport_name) => [
            'teams_count' => 0
        ]];
        foreach($countries[strtolower($sport_name)] as $country){
            if (is_array($country)) {
                $results[strtolower($sport_name)][] = $country;
                $results[strtolower($sport_name)]['teams_count'] += $country['teams_count'];
            }
        }

        return response()->json($results);
    });

    Route::get('/matches', function(){
        $time = request()->get('time', 0);
        $country_name = request()->get('country_name', 'ALL');
        $write = request()->get('write', 0);
        $key = request()->get('key', '');
        $wrapper = new App\Helpers\Cash2BetsMatchesListAPI($time, $country_name, 1, $write, $key);
        return response()->json($wrapper->fetchResults());
    });

    Route::get('/event_info', function(){
        $event_id = request()->get('event_id', null);
        if ($event_id){
            $wrapper = new App\Helpers\Cash2BetsEventStatisticsAPI($event_id);
            return response()->json($wrapper->fetchResults());
        }
        return response()->json([]);
    });

    Route::get("/live-matches", function () {
        return response()->json((new \App\Helpers\Cash2BetsLive())->fetchResults());
    });

    Route::get('/daily-tickets', function(){
        return response()->json(\App\Bet::where('user_id', \request()->user()->id)->whereDate('created_at', \Carbon\Carbon::today()->toDateString())->groupBy('invoice_id')->get()->toArray());
    });
});
