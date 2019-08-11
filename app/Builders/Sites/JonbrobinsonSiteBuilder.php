<?php

namespace App\Builders\Sites;

use App\Constants\HttpClientConstants;

class JonbrobinsonSiteBuilder extends SiteBuilderAbstract
{
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
            HttpClientConstants::METHOD_GET =>[
                "posts"
            ],
            HttpClientConstants::METHOD_POST => []
        ];
    }

    public function setName()
    {
        $this->site->name = "Jonbrobinson";
    }

    public function setDescription()
    {
        $this->site->description = "A website for Jonathan Robinson";
    }
}