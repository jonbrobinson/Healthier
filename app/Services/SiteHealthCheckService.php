<?php

namespace App\Services;

use App\Factories\SiteBuilderFactory;
use App\Helpers\SiteReportHelper;
use App\Models\SiteReportModel;

class SiteHealthCheckService
{
    public $reportHelper;
    public $siteBuilderFactory;

    public function __construct(SiteBuilderFactory $siteBuilderFactory, SiteReportHelper $reportHelper)
    {
        $this->siteBuilderFactory = $siteBuilderFactory;
        $this->reportHelper = $reportHelper;
    }

    /**
     * @return SiteReportModel[]
     */
    public function runOwnedSiteReports()
    {
        $reports = [];
        $ownedSites = ['Aaulyp', 'Jonbrobinson'];

        foreach ($ownedSites as $site)
        {
            $builder = $this->siteBuilderFactory->getSiteBuilder($site);

            $site = $builder->makeSite();

            $report = $this->reportHelper->buildReportFromSite($site);

            $reports[] = $report;
        }

        return $reports;
    }

}