<?php
namespace App\Models;
use App\Builders\Sites\SiteBuilderAbstract;
use App\Constants\HttpClientConstants;

/**
 * Class Website Report Model
 */
class SiteReport
{
    /**
     * @var Site
     */
    private $site;

    /**
     * @var string
     */
    public $healthy;

    /**
     * @var
     */
    public $date;

    /**
     * @var UrlHealth[]
     */
    public $urlStatuses;

    /**
     * @param Site $site
     */
    public function __construct($site)
    {
        $this->site = $site;
    }

    public function getSite()
    {
        return $this->site;
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