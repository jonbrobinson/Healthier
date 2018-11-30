<?php

namespace Tests\Unit\Builders;

use App\Builders\Sites\JonbrobinsonSiteBuilder;
use App\Constants\HttpClientConstants;
use Tests\TestCase;


class JonbrobinsonBuilderTest extends TestCase
{

    public function testGetBaseUrl()
    {
        $builder = new JonbrobinsonSiteBuilder();

        $actual = $builder->getBaseUrl();
        $expected = "jonbrobinson.com";

        $this->assertEquals($expected, $actual);
    }

    public function testGetEndpoints()
    {
        $builder = new JonbrobinsonSiteBuilder();

        $actual = $builder->getEndpoints();

        $this->assertCount(2, $actual);
        $this->assertEmpty($actual[HttpClientConstants::METHOD_GET]);
        $this->assertEmpty($actual[HttpClientConstants::METHOD_POST]);
    }

    public function testBuildSiteUrls()
    {
        $builder = new JonbrobinsonSiteBuilder();

        $actual = $builder->buildSiteUrls();
        $this->assertCount(1, $actual);
        $this->assertContains('//jonbrobinson.com', $actual[HttpClientConstants::METHOD_GET]);
        $this->assertCount(1, $actual[HttpClientConstants::METHOD_GET]);
        $this->assertArrayNotHasKey(HttpClientConstants::METHOD_POST, $actual);
    }

    public function testMakeSite()
    {
        $builder = new JonbrobinsonSiteBuilder();
        $site = $builder->makeSite();

        $this->assertEquals('Jonbrobinson', $site->name);
        $this->assertEquals('jonbrobinson.com', $site->baseUrl);
        $this->assertCount(2, $site->endpoints);
    }
}