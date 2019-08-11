<?php

namespace App\Builders\Sites;

use App\Constants\HttpClientConstants;

class KatinaAndTedSiteBuilder extends SiteBuilderAbstract
{
    /**
     * Get the base url of a website
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return "katinaandted.com";
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

    public function setName()
    {
        $this->site->name = "Katina and Ted";
    }

    public function setDescription()
    {
        $this->site->description = "A website for Katina and Ted Wedding";
    }
}