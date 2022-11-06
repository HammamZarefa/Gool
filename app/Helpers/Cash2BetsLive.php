<?php

namespace App\Helpers;

class Cash2BetsLive extends Cash2BetsBaseAPI{
    const API_URL = 'https://cashtobets24.com/canliorta2.asp';

    public function __construct(){
        parent::__construct(self::API_URL);
    }
    public function fetchResults(): array
    {
        $xpath = parent::fetchResults();
        $results = [];
        $sport_names = $xpath->query("//div[@class='headerBox']");
        foreach ($sport_names as $sport_name) {
            $sportName = $xpath->query("./span", $sport_name)->item(0)->nodeValue;
            if ($sportName !== 'FUTBOL')
                continue;
            $name = $sport_name->getAttribute('title');
            $flag = $xpath->query('./span/img', $sport_name)->item(0)->getAttribute('src');
            $matches = [];
            $next_element = $xpath->query("following-sibling::*[1]", $sport_name)->item(0);

            while ($next_element) {
                if ($next_element->tagName !== 'table')
                    break;

                $match_data = $xpath->query('./tr[@class="listLineBoxO"]', $next_element);
                $invalid_team = false;

                if (count($match_data) == 2) {
                    $match_data = $match_data->item(1);
                }else {
                    $match_data = $match_data->item(0);
                    $invalid_team = true;
                }
                $match = [];
                foreach ($xpath->query('./td', $match_data) as $index => $data_column) {
                    if($xpath->query("./tr",$next_element)->item(3))
                    $match['match_id']=substr($xpath->query("./tr",$next_element)->item(3)->getAttribute('id'),2);
                    switch ($index) {
                        case 0:
                            $match['match_time'] = $data_column->nodeValue;
                            break;
                        case 1:
                            $match['match_score'] = explode('(', $data_column->nodeValue)[0];
                            break;
                        case 2:
                            $match['home_team_name'] =  $xpath->query("./div/span[@style='float:left']", $data_column)->item(0)->nodeValue;
                            $match['home_team_win'] = $xpath->query("./div/span[@style='float:right']", $data_column)->item(0)->nodeValue;
                            $match['home_team_name'] = $match['home_team_name'] ?: '---';
                            $match['home_team_win'] = $match['home_team_win'] ?: '---';
                            break;
                        case 3:
                            $match['draw'] = $data_column->nodeValue;
                            $match['draw'] = $match['draw'] ?: '---';
                            break;
                        case 4:
                            $match['away_team_name'] = $xpath->query("./div/span[@style='float:right']", $data_column)->item(0)->nodeValue;
                            $match['away_team_win'] = $xpath->query("./div/span[@style='float:left']", $data_column)->item(0)->nodeValue;
                            $match['away_team_name'] = $match['away_team_name'] ?: '---';
                            $match['away_team_win'] = $match['away_team_win'] ?: '---';
                            break;
                    }
                }
                if (count($match) >= 7)
                    $matches[] = $match;
                $next_element = $xpath->query("following-sibling::*[1]", $next_element)->item(0);
            }

            $results[] = [
                'country_name' => $name,
                'country_flag' => $flag,
                'matches' => $matches,
            ];

        }
        return $results;
    }
}


//if (php_sapi_name() === 'cli'){
//    print_r((new Cash2BetsLive())->fetchResults());
//}
