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

        $builder->setUrls();
        $actual = $builder->getSite()->urls;
        $this->assertCount(3, $actual);
        $this->assertEquals('//aaulyp.org', $actual[0]['url']);
        $this->assertEquals('GET', $actual[0]['method']);
        $this->assertCount(2, $actual[0]);
        $this->assertEquals('//aaulyp.org/events', $actual[1]['url']);
        $this->assertEquals('GET', $actual[1]['method']);
        $this->assertCount(2, $actual[1]);
        $this->assertEquals('//aaulyp.org/join', $actual[2]['url']);
        $this->assertEquals('GET', $actual[2]['method']);
        $this->assertCount(2, $actual[2]);
    }

    public function testBuildSite()
    {
        $builder = new AaulypSiteBuilder();
        $builder->setName();
        $builder->setDescription();
        $builder->setBaseUrl();
        $builder->setEndpoints();
        $builder->setUrls();

        $site = $builder->getSite();

        $this->assertEquals('Austin Area Urban League', $site->name);
        $this->assertEquals('aaulyp.org', $site->baseUrl);
        $this->assertCount(2, $site->endpoints);
        $this->assertCount(2, $site->endpoints[HttpClientConstants::METHOD_GET]);
        $this->assertContains("events", $site->endpoints[HttpClientConstants::METHOD_GET]);
        $this->assertContains("join", $site->endpoints[HttpClientConstants::METHOD_GET]);
        $this->assertEmpty($site->endpoints[HttpClientConstants::METHOD_POST]);
    }
}