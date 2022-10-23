<?php

use App\Country;
use App\Helpers\AllSportsSoccerApi;
use App\Match;
use Illuminate\Database\Seeder;

class MatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Country::all() as $country){
            $matches = (new AllSportsSoccerApi())->fetchMatches(null, null, $country->country_key);
            $matches = $matches['result'] ?? [];
            foreach($matches as $match){
                Match::updateOrCreate([
                    'league_key' => $match->league_key,
                    'country_key' => $match->event_country_key,
                    'home_logo' => $match->home_team_logo,
                    'away_logo' => $match->away_team_logo,
                    'event_key' => $match->event_key,
                    'event_date' => $match->event_date,
                    'event_time' => $match->event_time,
                    'home_team' => $match->event_home_team,
                    'away_team' => $match->event_away_team,
                    'event_half_time_result' => $match->event_halftime_result,
                    'event_final_result' => $match->event_final_result,
                    'status' => $match->event_status
                ]);
            }
        }
    }
}
