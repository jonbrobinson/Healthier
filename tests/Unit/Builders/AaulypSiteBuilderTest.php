<?php

namespace Tests\Unit\Builders;

use App\Models\Builders\Sites\AaulypSiteBuilder;
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

        $this->assertCount(2, $actual);
        $this->assertContains("events", $actual);
        $this->assertContains("join", $actual);
    }

    public function testMakeSite()
    {
        $builder = new AaulypSiteBuilder();
        $site = $builder->makeSite();

        $this->assertEquals('Austin Area Urban League', $site->name);
        $this->assertEquals('aaulyp.org', $site->baseUrl);
        $this->assertCount(2, $site->endpoints);
        $this->assertContains("events", $site->endpoints);
        $this->assertContains("join", $site->endpoints);
    }
}