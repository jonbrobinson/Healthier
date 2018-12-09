<?php
namespace App\Models;
use App\Builders\Sites\SiteBuilderAbstract;
use App\Constants\HttpClientConstants;

/**
 * Class Website Report Model
 */
class SiteReportModel extends SiteModel
{
    /**
     * @var string
     */
    public $healthy;

    /**
     * @var
     */
    public $date;

    /**
     * @var UrlHealthModel[]
     */
    public $urlStatuses;

    /**
     * @param SiteModel $site
     */
    public function populateSiteData($site)
    {
        $this->name = $site->name;
        $this->description = $site->description;
        $this->baseUrl = $site->baseUrl;
        $this->urls = $site->urls;
        $this->endpoints = $site->endpoints;
    }

    public function addStatus($status)
    {
        $this->urlStatuses[] = $status;
    }

    public function calculateStatus()
    {
        $statuses = $this->urlStatuses;
        $errorStatuses = [];

        foreach ($statuses as $status)
        {
            if (HttpClientConstants::RESPONSE_STATUS_OK != $status->code) {
                $errorStatuses[] = $status;
            }
        }

        $this->healthy = count($errorStatuses) > 0 ? false : true;
    }
}