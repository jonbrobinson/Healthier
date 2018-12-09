<?php
namespace App\Helpers;

use Exception;
use App\Constants\HttpClientConstants;
use App\Models\SiteModel;
use App\Models\SiteReportModel;
use App\Models\UrlHealthModel;
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
     * @param string $method
     * @param string $url
     *
     * @return Response|ResponseInterface
     */
    public function sendSiteUrlRequest($method, $url)
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

    /**
     * @param SiteModel $site
     *
     * @return SiteReportModel
     */
    public function buildReportFromSite($site)
    {
        $report = new SiteReportModel();
        $report->populateSiteData($site);

        foreach ($site->urls as $urlDetails)
        {
            $method = $urlDetails['method'];
            $url = $urlDetails['url'];
            $response = $this->sendSiteUrlRequest($method, $url);

            $status = new UrlHealthModel();
            $status->url = $url;
            $status->method = $method;
            $status->updateUrlStatusWithResponse($response);

            $report->addStatus($status);
        }

        $report->calculateStatus();

        return $report;
    }
}