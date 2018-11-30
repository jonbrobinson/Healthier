<?php

namespace App\Builders\Sites;

use App\Constants\HttpClientConstants;
use App\Interfaces\SiteBuilderInterface;
use App\Models\SiteModel;

abstract class SiteBuilderAbstract implements SiteBuilderInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string;
     */
    protected $description;

    /**
     * Get the base url of a website
     *
     * @return string
     */
    abstract public function getBaseUrl();

    /**
     * Get the endpoints associated with a website to check
     *
     * @return array
     */
    abstract public function getEndpoints();

    /**
     * @return SiteModel
     */
    public function makeSite()
    {
        $site = new SiteModel();
        $site->populateFromSiteBuilder($this);

        return $site;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function buildSiteUrls()
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
                $urls[$method][] = '//'.$baseUrl;
            }

            foreach($endpointGroups[$method] as $endpoint)
            {
                $url = '//'.$baseUrl.'/'.$endpoint;

                $urls[$method][] = $url;
            }
        }

        return $urls;
    }

    /**
     * @param $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $description
     */
    protected function setDescription($description)
    {
        $this->description = $description;
    }
}