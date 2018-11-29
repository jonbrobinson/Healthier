<?php

namespace App\Interfaces;

use App\Models\SiteModel;

interface SiteBuilderInterface
{
    /**
     * @return SiteModel
     */
    public function makeSite();

    /**
     * Get the name of a website
     *
     * @return string
     */
    public function getName();

    /**
     * Get the description of a website
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the base url of a website
     *
     * @return string
     */
    public function getBaseUrl();

    /**
     * Get the endpoints associated with a website to check
     *
     * @return array
     */
    public function getEndpoints();

}