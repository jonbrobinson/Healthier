<?php

namespace App\Builders\Sites;

use App\Constants\HttpClientConstants;

class AaulypSiteBuilder extends SiteBuilderAbstract
{

    public function __construct()
    {
        $this->setName("Austin Area Urban League");
        $this->setDescription("A website for the Austin Area Urban League");
    }

    /**
     * Get the base url of a website
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return "aaulyp.org";
    }

    /**
     * Get the endpoints associated with a website to check
     *
     * @return array
     */
    public function getEndpoints()
    {
        return [
            HttpClientConstants::METHOD_GET =>[
                "events",
                "join"
            ],
            HttpClientConstants::METHOD_POST => []
        ];
    }
}