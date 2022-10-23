<?php
namespace App\Helpers;

abstract class Cash2BetsBaseAPI{
    const WEBSITE_URL = "https://cashtobets24.com/default.asp?lng=ar";
    protected $html;
    protected $request;

    public function __construct($sport_api){
        $php_session_id = $this->getPhpSessionID();
        $this->request = curl_init($sport_api);
        curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->request, CURLOPT_HTTPHEADER, [
            'cookie: ' . $php_session_id,
            'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36',
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'accept-language: en-US;q=0.8,en;q=0.7'
        ]);
        $this->html = curl_exec($this->request);
    }

    public function getPhpSessionID(){
        $ch = curl_init(self::WEBSITE_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36',
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'accept-language: ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7'
        ]);
        $response = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $re = '/(ASPSESSIONID.*=.*);/m';
        preg_match_all($re, $header, $matches, PREG_SET_ORDER, 0);
        return $matches[0][1];
    }

    protected function fetchResults(){
        $document = new \DOMDocument();
        @$document->loadHtml('<?xml encoding="utf-8" ?>'. $this->html );
        return new \DOMXPath($document);
    }
}
