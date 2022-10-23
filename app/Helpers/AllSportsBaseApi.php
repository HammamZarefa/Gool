<?php

namespace App\Helpers;


abstract class AllSportsBaseApi
{
    private const API_KEY = "61b8c53bb40b816d2c07bef68ab3a7de16f08181cdece676b255ec23661e5c21";
    private const BASE_API_URL = "https://apiv2.allsportsapi.com/";

    protected function fetchResponse($sport, $method, $params = [])
    {
        $endpoint = self::BASE_API_URL . $sport . "/?met={$method}&APIkey=" . self::API_KEY . "&" . http_build_query($params);
        $curl_options = array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
        );
        $curl = curl_init();
        curl_setopt_array($curl, $curl_options);
        $result = (array)json_decode(curl_exec($curl));
        return $result['result'] ?? [];
    }


}
