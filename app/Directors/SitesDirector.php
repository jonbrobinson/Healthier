<?php

namespace App\Directors;

use App\Interfaces\SiteBuilderInterface;
use App\Models\Site;

class SitesDirector
{
    /**
     * @var SiteBuilderInterface
     */
    private $builder;

    public function setBuilder(SiteBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return Site
     */
    public function buildSite()
    {
        $this->builder->setName();
        $this->builder->setDescription();
        $this->builder->setBaseUrl();
        $this->builder->setEndpoints();
        $this->builder->setUrls();

        return $this->builder->getSite();
    }

}