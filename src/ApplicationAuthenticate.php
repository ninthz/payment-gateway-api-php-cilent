<?php

namespace PaymentGatewayClient;


class ApplicationAuthenticate extends PaymentGatewayClient
{
    const RESOURCE = 'auth';

    function auth()
    {
        return $this->post();
    }
}