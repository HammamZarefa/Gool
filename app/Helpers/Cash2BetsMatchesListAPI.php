<?php
namespace App\Helpers;

class Cash2BetsMatchesListAPI extends Cash2BetsBaseAPI{
    const API_URL = 'https://cashtobets24.com/onlinelistegeti2r.asp';

    public function __construct($time=0, $leagues='ALL', $limit=1, $write='undefined', $key='undefined'){
        parent::__construct(self::API_URL . "?zamantur={$time}&ligler={$leagues}&canlimit={$limit}&turu={$write}&anahtar={$key}");
    }


    public function fetchResults(): array{
        $document = new \DOMDocument();
        @$document->loadHtml( '<?xml encoding="utf-8" ?>'.$this->html );
        $xpath = new \DOMXPath($document);
        $results = [];
        $tables = $xpath->query("//div[@id='tmpMatches']");
        for ($i = 0; $i < count($tables); $i++){
            $table_title = trim($xpath->query('./div', $tables->item($i))->item(0)->nodeValue);
            $table_image = $xpath->query('./div/span/img', $tables->item($i))->item(0)->getAttribute('src');
            $table = $xpath->query('./table', $tables->item($i))->item(0);
            $table_data = ['flag' => $table_image];
            foreach ($xpath->query('./div/tr', $table) as $table_row){
                $table_row_data = [];
                foreach($xpath->query('./td', $table_row) as $index => $table_cell){
                    switch ($index){
                        case 0:
                            $table_row_data['day'] = trim($table_cell->nodeValue);
                            break;
                        case 1:
                            $table_row_data['start_time'] = trim($table_cell->nodeValue);
                            break;
                        case 2:
                            $opponent_info = $xpath->query('./div/span', $table_cell);
                            $table_row_data['first_opponent'] = [
                                'flag' =>  trim($xpath->query('./img', $opponent_info->item(0))->item(0)->getAttribute('src')),
                                'name' => trim($opponent_info->item(1)->nodeValue),
                                'strength' => trim($opponent_info->item(2)->nodeValue)
                            ];
                            break;
                        case 3:
                            $table_row_data['draw'] = trim($table_cell->nodeValue);
                            break;
                        case 4:
                            $opponent_info = $xpath->query('./div/span', $table_cell);
                            $table_row_data['second_opponent'] = [
                                'flag' =>  trim($xpath->query('./img', $opponent_info->item(1))->item(0)->getAttribute('src')),
                                'name' => trim($opponent_info->item(2)->nodeValue),
                                'strength' => trim($opponent_info->item(0)->nodeValue)
                            ];
                            break;
                        case 5:
                            $bet_info = $xpath->query('./div/a', $table_cell)->item(0);
                            if ($bet_info) {
                                $event_id = $bet_info->getAttribute('href');
                                $event_id = explode(';', $event_id)[1];
                                $event_id = explode('(', $event_id)[1];
                                $event_id = str_replace(')', '', $event_id);
                                $event_id = str_replace("'", '', $event_id);
                                $bet_info = $bet_info->nodeValue;
                            }else{
                                $event_id = '';
                                $bet_info = '';
                            }
                            $table_row_data['bet_info'] = [
                                'event_id' => $event_id,
                                'bet_value' => $bet_info
                            ];
                            break;
                    }
                }
                $table_data[] = $table_row_data;
            }
            $results[trim($table_title)] = $table_data;
        }
        return $results;

    }
}


if (php_sapi_name() === 'cli'){
    print_r((new Cash2BetsMatchesListAPI())->fetchResults());
}
