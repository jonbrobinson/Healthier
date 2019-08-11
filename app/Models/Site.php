<?php
namespace App\Models;
use App\Builders\Sites\SiteBuilderAbstract;

/**
 * Class Website Model
 */
class Site
{
    public $name;

    public $description;

    public $baseUrl;

    public $endpoints;

    public $urls;
}