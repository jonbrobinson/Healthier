<?php

namespace App\Builders\Sites;

use App\Constants\HttpClientConstants;

class JonbrobinsonSiteBuilder extends SiteBuilderAbstract
{

    public function __construct()
    {
        $this->setName("Jonbrobinson");
        $this->setDescription("A website for Jonathan Robinson");
    }

    /**
     * Get the base url of a website
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return "jonbrobinson.com";
    }

    /**
     * Get the endpoints associated with a website to check
     *
     * @return array
     */
    public function getEndpoints()
    {
        return [
            HttpClientConstants::METHOD_GET =>[],
            HttpClientConstants::METHOD_POST => []
        ];
    }
}