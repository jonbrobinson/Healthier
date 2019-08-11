<?php

namespace App\Services;

use App\Builders\Sites\AaulypSiteBuilder;
use App\Builders\Sites\JonbrobinsonSiteBuilder;
use App\Directors\SitesDirector;
use App\Helpers\SiteReportHelper;
use App\Interfaces\SiteBuilderInterface;
use App\Models\Site;
use App\Models\SiteReport;

class SiteHealthCheckService
{
    public $reportHelper;

    public function __construct(SiteReportHelper $reportHelper)
    {
        $this->reportHelper = $reportHelper;
    }

    /**
     * @return SiteReport[]
     */
    public function runOwnedSiteReports()
    {
        $ownedSitesBuilders = [new AaulypSiteBuilder(), new JonbrobinsonSiteBuilder()];

        $sites = $this->buildSitesFromSiteBuilders($ownedSitesBuilders);

        $reports = $this->reportHelper->buildReportsFromSites($sites);

        return $reports;
    }

    /**
     * @param SiteBuilderInterface[] $builders
     *
     * @return Site[]
     */
    public function buildSitesFromSiteBuilders($builders)
    {
        $director = new SitesDirector();
        $sites = [];

        foreach ($builders as $siteBuilder)
        {
            $director->setBuilder($siteBuilder);
            $sites[] = $director->buildSite();
        }

        return $sites;
    }

}