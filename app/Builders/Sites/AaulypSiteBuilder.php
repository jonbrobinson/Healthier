<?php

namespace App\Builders\Sites;

use App\Constants\HttpClientConstants;

class AaulypSiteBuilder extends SiteBuilderAbstract
{
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

    public function setName()
    {
        $this->site->name = "Austin Area Urban League";
    }

    public function setDescription()
    {
        $this->site->description = "A website for the Austin Area Urban League";
    }
}