<?php
namespace App\Helpers;

use Exception;
use App\Constants\HttpClientConstants;
use App\Models\Site;
use App\Models\SiteReport;
use App\Models\UrlHealth;
use App\Services\HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Class SiteReportHelper
 */
class SiteReportHelper
{
    /**
     * SiteReportHelper constructor.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @param Site[] $sites
     *
     * @return SiteReport[]
     */
    public function buildReportsFromSites($sites)
    {
        $reports = [];

        foreach($sites as $site)
        {
            $reports[] = $this->buildReportFromSite($site);
        }

        return $reports;
    }

    /**
     * @param Site $site
     *
     * @return SiteReport
     */
    public function buildReportFromSite($site)
    {
        $report = new SiteReport($site);

        foreach ($site->urls as $urlDetails)
        {
            $method = $urlDetails['method'];
            $url = $urlDetails['url'];
            $response = $this->sendSiteUrlRequest($method, $url);

            $status = new UrlHealth();
            $status->url = $url;
            $status->method = $method;
            $status->updateUrlStatusWithResponse($response);

            $report->addStatus($status);
        }

        $report->calculateStatus();

        return $report;
    }

    /**
     * @param string $method
     * @param string $url
     *
     * @return Response|ResponseInterface
     */
    protected function sendSiteUrlRequest($method, $url)
    {
        $headers = [];
        try {
            $response = $this->httpClient->sendRequest($method, $url);
        } catch (ClientException $e) {
            $status = $e->getCode();
            $body = $e->getMessage();
            return new Response($status, $headers, $body);
        } catch (ConnectException $e) {
            $status = HttpClientConstants::RESPONSE_INTERNAL_SERVER_ERROR;
            $body = $e->getMessage();
            return new Response($status, $headers, $body);
        } catch (Exception $e) {
            $exceptionName = get_class($e);
            $status = HttpClientConstants::RESPONSE_INTERNAL_SERVER_ERROR;
            $body = "Internal Service Error: $exceptionName";

            return new Response($status, $headers, $body);
        }

        return $response;
    }
}