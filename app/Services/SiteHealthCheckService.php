<?php

namespace App\Services;


use GuzzleHttp\Client;

class SiteHealthCheckService
{

    public function __construct(HttpClient $client)
    {

    }

    public function runOwnedSiteReports()
    {
        $ownedSites = ['aaulyp', 'jonbrobinson'];

    }

    protected function getGuzzleClient()
    {

    }

}