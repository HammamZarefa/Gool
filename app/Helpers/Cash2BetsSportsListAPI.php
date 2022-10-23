<?php

namespace App\Helpers;

class Cash2BetsSportsListAPI extends Cash2BetsBaseAPI{
    const API_URL = 'https://cashtobets24.com/default.asp?lng=en';
    private $sport_name;

    public function __construct($sport='ALL', $lang='en'){
        parent::__construct(self::API_URL);
        $this->sport_name = trim(strtolower($sport));
    }
    
    public function fetchResults(): array{
        $xpath = parent::fetchResults();
        $results = [];
        $sports_list = $xpath->query('./ul/li[@class="has-sub"]', $xpath->query('//div[@id="cssmenu"]')->item(1));
        foreach($sports_list as $sport_list){
            $sport_name = trim(strtolower($xpath->query('./a/span/table/tr/td', $sport_list)->item(0)->nodeValue));
            if ($sport_name != $this->sport_name && $this->sport_name !== 'all')
                continue;

            $sport_countries = $xpath->query('./ul/li', $sport_list);
            $sport_countries_output = [];
            $count = 0;
            foreach($sport_countries as  $sport_country){
                $sport_country_output = [];
                $country = $xpath->query('./table/tr/td', $sport_country);
                foreach($country as $index => $country_data){
                    switch ($index){
                        case 0:
                            $flag = $xpath->query('./a/span/img', $country_data)->item(0)->getAttribute('src');
                            $sport_country_output['flag'] = trim($flag);
                            break;
                        case 1:
                            $name = $xpath->query('./a', $country_data)->item(0);
                            $country_name = trim($name->nodeValue);
                            if ($country_name === 'European')
                                $country_name = 'Europe';
                            else if ($country_name === 'Britain')
                                $country_name = 'England';
                            $sport_country_output['name'] = $country_name;
                            $country_params = $name->getAttribute('onclick');
                            $country_params = explode(';', $country_params)[1];
                            $country_params = explode('(', $country_params)[1];
                            $country_params = explode(',', $country_params);
                            $country_params = [
                                'time' => trim(str_replace("'", '', $country_params[0])),
                                'league' => trim(str_replace("'", '', $country_params[1])),
                                'limit' => 1,
                                'write' => trim(str_replace("'", '', $country_params[3])),
                            ];
                            $sport_country_output['params'] = $country_params;
                            break;
                        case 2:
                            $sport_country_output['teams_count'] = trim($country_data->nodeValue);
                            $count += (int) $sport_country_output['teams_count'];
                            break;
                    }
                }
                $sport_countries_output[] = $sport_country_output;
            }
            $results[$sport_name] = $sport_countries_output;
            $results[$sport_name]['teams_count'] = $count;
        }
        return $results;
    }
}
