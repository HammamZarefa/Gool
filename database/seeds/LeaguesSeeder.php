<?php

use Illuminate\Database\Seeder;

class LeaguesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_sports_api = new \App\Helpers\AllSportsSoccerApi();
        foreach($all_sports_api->leagues()['result'] as $league){
            \App\League::updateOrCreate([
                'country_key' => $league->country_key,
                'league_key' => $league->league_key,
                'league_logo' => $league->league_logo,
                'league_name' => $league->league_name,
            ]);
        }
    }
}
