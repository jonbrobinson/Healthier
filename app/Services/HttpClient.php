<?php

namespace App\Services;

use GuzzleHttp\Client;

class HttpClient
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = $this->getGuzzleClient();
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest($method, $url, $options = [])
    {
        return $this->httpClient->request($method, $url, $options);
    }

    protected function getGuzzleClient()
    {
        $httpClient = new Client();

        return $httpClient;
    }
}