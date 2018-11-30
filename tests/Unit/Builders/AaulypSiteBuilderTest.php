<?php

namespace Tests\Unit\Builders;

use App\Builders\Sites\AaulypSiteBuilder;
use App\Constants\HttpClientConstants;
use Tests\TestCase;


class AaulypSiteBuilderTest extends TestCase
{

    public function testGetBaseUrl()
    {
        $builder = new AaulypSiteBuilder();

        $actual = $builder->getBaseUrl();
        $expected = "aaulyp.org";

        $this->assertEquals($expected, $actual);
    }

    public function testGetEndpoints()
    {
        $builder = new AaulypSiteBuilder();

        $actual = $builder->getEndpoints();

        $this->assertCount(2, $actual[HttpClientConstants::METHOD_GET]);
        $this->assertContains("events", $actual[HttpClientConstants::METHOD_GET]);
        $this->assertContains("join", $actual[HttpClientConstants::METHOD_GET]);
        $this->assertEmpty($actual[HttpClientConstants::METHOD_POST]);
    }

    public function testBuildSiteUrls()
    {
        $builder = new AaulypSiteBuilder();

        $actual = $builder->buildSiteUrls();
        $this->assertCount(1, $actual);
        $this->assertContains('//aaulyp.org', $actual[HttpClientConstants::METHOD_GET]);
        $this->assertContains('//aaulyp.org/events', $actual[HttpClientConstants::METHOD_GET]);
        $this->assertContains('//aaulyp.org/join', $actual[HttpClientConstants::METHOD_GET]);
        $this->assertCount(3, $actual[HttpClientConstants::METHOD_GET]);
        $this->assertArrayNotHasKey(HttpClientConstants::METHOD_POST, $actual);
    }

    public function testMakeSite()
    {
        $builder = new AaulypSiteBuilder();
        $site = $builder->makeSite();

        $this->assertEquals('Austin Area Urban League', $site->name);
        $this->assertEquals('aaulyp.org', $site->baseUrl);
        $this->assertCount(2, $site->endpoints);
        $this->assertCount(2, $site->endpoints[HttpClientConstants::METHOD_GET]);
        $this->assertContains("events", $site->endpoints[HttpClientConstants::METHOD_GET]);
        $this->assertContains("join", $site->endpoints[HttpClientConstants::METHOD_GET]);
        $this->assertEmpty($site->endpoints[HttpClientConstants::METHOD_POST]);
    }
}