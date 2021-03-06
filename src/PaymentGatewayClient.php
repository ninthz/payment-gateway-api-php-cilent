<?php

namespace PaymentGatewayClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PaymentGatewayClient\Exceptions\HostHandshakeFailed;

class PaymentGatewayClient
{
    const TEST_MODE = 'apitest';
    const LIVE_MODE = 'api';

    protected $subdomain = 'api';

    protected $base_uri = 'idcdeposit.com';

    protected $version = 'v1';

    protected $certificatePath = false;

    protected $tcp = 'https';

    protected $client;

    protected $response;

    protected $credential;

    public function __construct()
    {
        if(function_exists('config'))
        {
            $mode = config('payment-gateway.mode');
            $this->base_uri = config('payment-gateway.base_uri');
            $this->subdomain = ( $mode == 'test' ? self::TEST_MODE : self::LIVE_MODE );
            $this->version = config('payment-gateway.version');

            $this->credential = new Credential(config('payment-gateway.'.$mode.'.app'), config('payment-gateway.'.$mode.'.key'));
            $this->certificatePath = config('payment-gateway.certificate');
            $this->tcp = config('payment-gateway.tcp');
        }

        $this->client = new Client();

        $this->response = new Response();
    }

    public function get($method = '')
    {
        $this->fire('GET', $method);

        return $this->response;
    }

    public function post($method = '', $data = [])
    {
        $this->fire('POST', $method, $data);

        return $this->response;
    }

    public function put($method = '', $data = [])
    {
        $this->fire('PUT', $method, $data);

        return $this->response;
    }

    public function delete($method = '')
    {
        $this->fire('DELETE', $method);

        return $this->response;
    }


    public function fire($httpMethod, $pathUri, $data = [])
    {
        $options = [
            'headers' => $this->credential->toHeaders(),
            'verify' => $this->getCertificatePath()
        ];

        if (!empty($data)) {

            $options['json'] = $data;

        }

        try {

            $response = $this->client->request($httpMethod, $this->packUri(static::RESOURCE.'/'.$pathUri), $options);

            $this->response->setResponse($response);

        } catch (RequestException $e) {

            if ($e->hasResponse()) {
                $this->response->setResponse($e->getResponse());
            } else {
                $handlerContext = $e->getHandlerContext();

                if ($handlerContext['errno'] == 6) {
                    throw new HostHandshakeFailed();
                }
            }
        }

    }

    /**
     * @param mixed|string $url
     */
    public function getUrl()
    {
        return $this->tcp.'://'.$this->subdomain.'.'.$this->base_uri.'/'.$this->version.'/';
    }

    private function packUri($pathUri)
    {
        return rtrim($this->getUrl().$pathUri, '/');
    }

    public function setTestapi(bool $testapi = true)
    {
        if ($testapi) {
            $this->subdomain = self::TEST_MODE;
        } else {
            $this->subdomain = self::LIVE_MODE;
        }
    }

    public function isTestapi()
    {
        return $this->subdomain == self::TEST_MODE;
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

    public function setBaseUri($base_uri)
    {
        $this->base_uri = $base_uri;
        return $this;
    }

    public function getBaseUri(): string
    {
        return $this->base_uri;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version)
    {
        $this->version = $version;
        return $this;
    }

    public function setCertificatePath($certificatePath)
    {
        $this->certificatePath = $certificatePath;
        return $this;
    }

    public function getCertificatePath()
    {
        return $this->certificatePath;
    }
}
