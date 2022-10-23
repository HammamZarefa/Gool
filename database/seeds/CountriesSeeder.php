<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_sports_api = new \App\Helpers\AllSportsSoccerApi();
        foreach($all_sports_api->countries()['result'] as $country){
            \App\Country::updateOrCreate([
               'country_key' => $country->country_key,
               'country_name' => $country->country_name,
               'country_logo' => $country->country_logo
            ]);
        }
    }
}
