<?php

namespace App\Builders\Sites;

use App\Constants\HttpClientConstants;
use App\Interfaces\SiteBuilderInterface;
use App\Models\Site;

abstract class SiteBuilderAbstract implements SiteBuilderInterface
{
    /**
     * @var Site
     */
    protected $site;

    /**
     * @return string
     */
    abstract public function getBaseUrl();

    /**
     * @return array
     */
    abstract public function getEndpoints();

    /**
     * @return void
     */
    abstract public function setName();

    /**
     * @return void
     */
    abstract public function setDescription();

    public function __construct()
    {
        $this->reset();
    }

    /**
     * @return void
     */
    public function reset()
    {
        $this->site = new Site();
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    public function setBaseUrl()
    {
        $this->site->baseUrl = $this->getBaseUrl();
    }

    public function setEndpoints()
    {
        $this->site->endpoints = $this->getEndpoints();
    }

    public function setUrls()
    {
        $this->site->urls = $this->buildSiteUrls();
    }

    /**
     * @return array
     */
    protected function buildSiteUrls()
    {
        $baseUrl = $this->getBaseUrl();
        $endpointGroups = $this->getEndpoints();

        $methodTypes = [
            HttpClientConstants::METHOD_GET,
            HttpClientConstants::METHOD_POST
        ];

        $urls = [];
        foreach($methodTypes as $method)
        {
            if ($method == HttpClientConstants::METHOD_GET) {
                $url['method'] = $method;
                $url['url'] = '//'.$baseUrl;
                $urls[] = $url;
            }

            foreach($endpointGroups[$method] as $endpoint)
            {
                $url['method'] = $method;
                $url['url'] = '//'.$baseUrl.'/'.$endpoint;
                $urls[] = $url;
            }
        }

        return $urls;
    }
}