<?php

namespace App\Helpers;

class Cash2BetsEventStatisticsAPI extends Cash2BetsBaseAPI{
    const API_URL = 'https://cashtobets24.com/altbahisfiyatlari.asp';

    public function __construct($event_id){
        parent::__construct(self::API_URL . "?kodu={$event_id}");
    }
    public function fetchResults(): array{
        $xpath = parent::fetchResults();
        $main_table = $xpath->query('//table')->item(0);
        $results = [];
        $last_table_head = null;
        foreach($xpath->query('./tr', $main_table) as $table_row){
            $table_head = $xpath->query('./td[@class="ubaslik"]', $table_row);
            if ($table_head->length) {
                $last_table_head = trim($table_head->item(0)->nodeValue);
            }
            else{
                $row_data = [];
                foreach ($xpath->query('./table/tr/td', $xpath->query('td', $table_row)->item(0)) as $index => $sub_table_cell){
                    $spans = $xpath->query('./div/span', $sub_table_cell);
                    $row_data[$index] = [
                        0 => @str_replace(':', '', trim($spans->item(0)->nodeValue)),
                        1 => @trim($spans->item(1)->nodeValue)
                    ];
                }
                if ($row_data)
                    $results[$last_table_head][] = $row_data;
            }
        }
        return $results;
    }
}
