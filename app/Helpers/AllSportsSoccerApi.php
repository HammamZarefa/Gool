<?php

namespace App\Helpers;

class AllSportsSoccerApi extends AllSportsBaseApi
{
    const SPORT_NAME = "football";

    public function countries(): array
    {
        return $this->fetchResponse(self::SPORT_NAME, 'Countries');
    }

    public function leagues(){
        return $this->fetchResponse(self::SPORT_NAME, 'Leagues');
    }

    public function fetchMatches($from=null, $to=null, $country_id=null){
        $params = [];
        $params['from'] = $from ? $from : strftime("%Y-%m-%d");
        $params['to'] = $to ? $to : strftime("%Y-%m-%d");


        if ($country_id)
            $params['countryId'] = $country_id;

        return $this->fetchResponse(self::SPORT_NAME, 'Fixtures', $params);
    }
}
