<?php
namespace App\Models;
use App\Constants\HttpClientConstants;

/**
 * Class UrlHealthModel
 */
class UrlHealth
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var int
     */
    public $code;

    /**
     * var string
     */
    public $message;

    /**
     * @var string
     */
    public $method;

    /**
     * @var bool
     */
    protected $error = false;

    /**
     * @param mixed $bool
     */
    public function setError($bool)
    {
        $this->error = filter_var($bool, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return UrlHealth
     */
    public function updateUrlStatusWithResponse($response)
    {
        $this->code = $response->getStatusCode();
        $this->message = $response->getBody()->getContents();

        if (HttpClientConstants::RESPONSE_STATUS_OK != $this->code) {
            $this->setError(true);
        }

        return $this;
    }
}