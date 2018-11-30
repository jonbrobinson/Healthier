<?php

namespace App\Services;


use GuzzleHttp\Client;

class SiteHealthCheckService
{
    public function __construct()
    {
        $this->httpClient = $this->getGuzzleClient();
    }

    protected function getGuzzleClient()
    {
        $httpClient = new Client();

        return $httpClient;
    }

}