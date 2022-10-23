<?php

namespace App\Helpers;

class FootballSoccerApi extends FootballBaseApi
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
            $params['country_id'] = $country_id;

        return $this->fetchResponse(self::SPORT_NAME, 'get_events', $params);
    }
}
