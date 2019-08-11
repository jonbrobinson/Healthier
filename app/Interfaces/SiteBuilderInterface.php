<?php

namespace App\Interfaces;

use App\Models\Site;

interface SiteBuilderInterface
{
    /**
     * @return Site
     */
    public function getSite();

    /**
     * @return string
     */
    public function getBaseUrl();

    /**
     * @return array
     */
    public function getEndpoints();

    /**
     * @return void
     */
    public function setName();

    /**
     * @return void
     */
    public function setDescription();

    /**
     * @return void
     */
    public function setBaseUrl();

    /**
     * @return void
     */
    public function setEndpoints();

    /**
     * @return void
     */
    public function setUrls();
}