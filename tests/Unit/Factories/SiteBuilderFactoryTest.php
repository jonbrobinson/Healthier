<?php

namespace Test\Unit\Factories;

use App\Builders\Sites\JonbrobinsonSiteBuilder;
use App\Factories\SiteBuilderFactory;
use App\Builders\Sites\AaulypSiteBuilder;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;


class SiteBuilderFactoryTest extends TestCase
{

    /**
     *
     */
    public function testGetAaulypBuilder_Success()
    {
        $factory = new SiteBuilderFactory();

        $builder = $factory->getSiteBuilder("Aaulyp");

        $this->assertInstanceOf(AaulypSiteBuilder::class, $builder);
    }

    /**
     *
     */
    public function testGetJonbrobinsonBuilder_Success()
    {
        $factory = new SiteBuilderFactory();

        $builder = $factory->getSiteBuilder("Jonbrobinson");

        $this->assertInstanceOf(JonbrobinsonSiteBuilder::class, $builder);
    }

    /**
     * @expectedException Error
     */
    public function testGetBuilder_ThrowsError()
    {
        $factory = new SiteBuilderFactory();

        $factory->getSiteBuilder("NonExistentSiteBuilders");
    }
}