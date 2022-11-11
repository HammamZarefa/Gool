<?php

namespace App\Console\Commands;

use App\Bet;
use App\Country;
use App\Helpers\AllSportsSoccerApi;
use App\Invoice;
use App\Match;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class UpdateMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateMatches:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command is used to fetch matches using country id daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $invoices = Invoice::where('status','Proccessing')->where('is_live','!=',1)->get();
        foreach ($invoices as $invoice) {
            $win = true;
            $proccessing = false;
            if(!$invoice->bets)
                continue;
            $bet_result = $this->getBetResult($invoice);
            print_r($invoice->bets);
            foreach ($invoice->bets as $bet)
            {
                if($bet->result==0)
                {
                    $win=false;
                    break;
                }
                elseif ($bet->result==0)
                {
                    $proccessing = true;
                    break;
                }
            }
            if ($win==false)
                $invoice->status='Lose';
            elseif ($win==true && $proccessing==false) {
                $invoice->status='Win';
                $invoice->save();
                $bet_user = User::findorfail($invoice->user_id);
                if ($bet_user) {
                    $bet_user->update([
                        'balance' => ($bet_user->balance + $invoice->possible_win)
                    ]);
                    $bet_user->save();
                }
            }
        }
        return;
    }

    public function getBetResult($invoice)
    {
        $to_be_updated = \App\Bet::where('invoice_id', $invoice->id)->where('result',0)->where('is_live','!=',1)->orderBy('country_name')->orderBy('match_date')->get();
        $flag = 1;
        foreach ($to_be_updated as $updatable) {
            $start_date = Carbon::parse(str_replace("/", '-', $updatable->match_date));
            if ($start_date->gt(Carbon::today()->toDate()))
                continue;
            $start_date = $start_date->toDateString();
            $country_key = \App\Country::where('country_name_ar', 'LIKE', '%' . $updatable->country_name . '%')->first();
            if (!$country_key)
                continue;
            $country_key = $country_key->country_key;
            $bet_result = $this->searchDatabase($updatable, $country_key);
            if ($bet_result == 0) {
                $this->updateDatabase($start_date, $country_key);
                $bet_result = $this->searchDatabase($updatable, $country_key);
            }

        }
    }

    public function updateDatabase($start_date, $country_key)
    {
        $football_api = new \App\Helpers\FootballSoccerApi();
        $all_matches = $football_api->fetchMatches($start_date, Carbon::today()->toDateString(), $country_key);
        foreach ($all_matches as $match) {
            if (strtolower(@$match->match_status) === 'finished') {
                $match = \App\Match::updateOrCreate([
                    'league_key' => $match->league_id,
                    'country_key' => $match->country_id,
                    'home_logo' => $match->team_home_badge,
                    'away_logo' => $match->team_away_badge,
                    'event_key' => $match->match_id,
                    'event_date' => $match->match_date,
                    'event_time' => $match->match_time,
                    'home_team' => $match->match_hometeam_name,
                    'away_team' => $match->match_awayteam_name,
                    'status' => $match->match_status,
//                        'event_half_time_result' => $match->event_halftime_result,
                    'event_final_result' => $match->match_hometeam_ft_score . '-' . $match->match_awayteam_ft_score,
                ]);
            }
        }
    }

    public function searchDatabase($updatable, $country_key)
    {
        $country_matches = \App\Match::where('country_key', $country_key)->where('event_date', $updatable->match_date)->get();
        $cash2bets_home_team = GoogleTranslate::trans($updatable->home_team, 'en', 'ar');
        $cash2bets_away_team = GoogleTranslate::trans($updatable->away_team, 'en', 'ar');
        $bets_value = GoogleTranslate::trans($updatable->bet_value, 'en', 'ar');
        foreach ($country_matches as $match) {
            if (Str::contains($match->home_team, 'U19') || Str::contains($match->home_team, 'U18') || Str::contains($match->home_team, 'U21'))
                continue;
            $all_sports_home_team = $match->home_team;
            $all_sports_away_team = $match->away_team;
            similar_text($all_sports_home_team, $cash2bets_home_team, $probability_HH);
            similar_text($all_sports_away_team, $cash2bets_away_team, $probability_WW);
            $results = str_replace(" ", "", $match->event_final_result);
            $results = explode("-", $results);
            if ($probability_HH >= 50 || $probability_WW >= 50) {
//                print_r($cash2bets_home_team . ' ' . $all_sports_home_team . ' - ' . $cash2bets_away_team . ' ' . $cash2bets_away_team .' ' .$match->event_final_result.'<br>');
//                        dd($bets_value .' '.$cash2bets_home_team.' -'.$cash2bets_away_team);

//                if ($updatable->bet_type == 'الرهان الرئيسي') {
                if ($bets_value === $cash2bets_home_team) {
                    $bet_result = ((int)$results[0] > (int)$results[1]) ? 1 : -1;
                } else if ($bets_value === $cash2bets_away_team) {
                    $bet_result = ((int)$results[1] > (int)$results[0]) ? 1 : -1;
                } else if ($bets_value == 'draw') {
                    $bet_result = ((int)$results[1] === (int)$results[0]) ? 1 : -1;
                } else $bet_result = 0;

//                }
//                else if ($updatable->bet_type=='فرصتين') {
//                if($bets_value==)
//                }
                $updatable->update([
                    'result' => $bet_result
                ]);
                $updatable->save();
                return $bet_result;
            }
        }
    }
}
