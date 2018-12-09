<?php

namespace App\Factories;

use App\Builders\Sites\SiteBuilderAbstract;

class SiteBuilderFactory
{
    /**
     * @param $name
     *
     * @return SiteBuilderAbstract
     */
    public function getSiteBuilder($name)
    {
        $qualifiedClassName = $this->getQualifiedClassName($name);

        $builder = new $qualifiedClassName();

        return $builder;
    }

    protected function getQualifiedClassName($name)
    {
        $builderNamespace = 'App\Builders\Sites';
        $className = $name.'SiteBuilder';

        return $builderNamespace.'\\'.$className;
    }
}