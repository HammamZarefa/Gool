<?php

namespace App\Helpers;


abstract class FootballBaseApi
{
    private const API_KEY = "f9954800a04b9505e2b8f56de89c51954fe55f22d8a7571a61a4776f556314f0";
    private const BASE_API_URL = "https://apiv3.apifootball.com/";

    protected function fetchResponse($sport, $method, $params = [])
    {
        $endpoint = self::BASE_API_URL . "?action={$method}&APIkey=" . self::API_KEY . "&" . http_build_query($params);
        $curl_options = array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
        );
        $curl = curl_init();
        curl_setopt_array($curl, $curl_options);
        $result = (array)json_decode(curl_exec($curl));

        return $result ?? [];
    }


}
