<?php
/**
 * Created by PhpStorm.
 * User: nuttasaktawon
 * Date: 6/21/2017 AD
 * Time: 4:04 PM
 */

namespace PaymentGatewayClient;


class Credential
{
    protected $app;

    protected $key;

    function __construct($app = '', $key = '')
    {
        $this->app = $app;
        $this->key = $key;
    }

    /**
     * @param mixed $app
     * @return ApplicationAuthenticate
     */
    public function setApp($app)
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
    
    public function toHeaders()
    {
        return [
            'PG-ACCESS-APP' => $this->app,
            'PG-ACCESS-SIGN' => hash('sha256', $this->app.$this->key)
        ];
    }
}