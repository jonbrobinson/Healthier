<?php

namespace App\Http\Controllers;

use App\Services\SiteHealthCheckService;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    protected $siteHealthCheckService;

    public function __construct(SiteHealthCheckService $healthCheckService)
    {
        $this->siteHealthCheckService = $healthCheckService;
    }

    public function index()
    {
        $reports = $this->siteHealthCheckService->runOwnedSiteReports();

        return view('pages/siteReports', compact('reports'));
    }
}
