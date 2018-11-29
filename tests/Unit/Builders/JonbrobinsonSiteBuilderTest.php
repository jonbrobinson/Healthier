<?php

namespace Tests\Unit\Builders;

use App\Models\Builders\Sites\JonbrobinsonSiteBuilder;
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
        
        $this->assertEmpty($actual);
    }

    public function testMakeSite()
    {
        $builder = new JonbrobinsonSiteBuilder();
        $site = $builder->makeSite();

        $this->assertEquals('Jonbrobinson', $site->name);
        $this->assertEquals('jonbrobinson.com', $site->baseUrl);
        $this->assertEmpty($site->endpoints);
    }
}