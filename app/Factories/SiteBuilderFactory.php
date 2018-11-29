<?php

namespace App\Factories;

class SiteBuilderFactory
{
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