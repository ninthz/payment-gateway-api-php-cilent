<?php

namespace PaymentGatewayClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class PaymentGatewayClient
{
    /* Base url */
    protected $url = 'http://api.payment-gateway.netearth.net/v1/';

    protected $client;

    protected $response;

    protected $credential;

    public function __construct()
    {
        if(function_exists('config'))
        {
            $mode = config('payment-gateway.mode');
            $this->url = 'http://' .
                ( $mode == 'test' ? 'test-api' : 'live') . '.' .
                config('payment-gateway.base_uri') . '/' .
                config('payment-gateway.version') . '/';

            $this->credential = new Credential(config('payment-gateway.'.$mode.'.app'), config('payment-gateway.'.$mode.'.key'));
        }

        $this->client = new Client(['base_uri' => $this->getUrl()]);

        $this->response = new Response();
    }

    public function get($method)
    {
        $this->fire('GET', static::RESOURCE.'/'.$method);

        return $this->response;
    }

    public function post($method, $data)
    {
        $this->fire('POST', static::RESOURCE.'/'.$method, $data);

        return $this->response;
    }

    public function fire($httpMethod, $pathUri, $data = [])
    {
        $options = [
            'headers' => $this->credential->toHeaders()
        ];

        if (!empty($data)) {

            $options['json'] = $data;

        }

        try {

            $response = $this->client->request($httpMethod, $pathUri, $options);

            $this->response->setResponse($response);

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->response->setResponse($e->getResponse());
            }
        }

    }

    /**
     * @return mixed|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed|string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
        $this->client = new Client(['base_uri' => $this->getUrl()]);
        return $this;
    }

    public function getCredential()
    {
        return $this->credential;
    }

    public function setCredential($app, $key)
    {
        $this->credential = new Credential($app, $key);
        return $this;
    }
}