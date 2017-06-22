<?php
/**
 * Created by PhpStorm.
 * User: nuttasaktawon
 * Date: 6/22/2017 AD
 * Time: 12:46 AM
 */

namespace PaymentGatewayClient;

use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;

class Response
{
    protected $response;

    function toJson()
    {
        return json_decode($this->response->getBody());
    }

    function toArray()
    {
        return json_decode($this->response->getBody(), true);
    }

    function isSuccuss()
    {
        return $this->response->getStatusCode() == 200;
    }

    /**
     * @param mixed $response
     * @return Response
     */
    public function setResponse(GuzzleHttpResponse $response)
    {
        $this->response = $response;
        return $this;
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    public function getErrorMessage()
    {
        return $this->toJson()->message;
    }
}