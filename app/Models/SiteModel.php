<?php
namespace App\Models;
use App\Builders\Sites\SiteBuilderAbstract;

/**
 * Class Website Model
 */
class SiteModel
{
    public $name;

    public $description;

    public $baseUrl;

    public $endpoints;

    public $urls;

    public function populateFromSiteBuilder(SiteBuilderAbstract $builder)
    {
        $this->name = $builder->getName();
        $this->description = $builder->getDescription();
        $this->baseUrl = $builder->getBaseUrl();
        $this->endpoints = $builder->getEndpoints();
        $this->urls = $builder->buildSiteUrls();
    }
}