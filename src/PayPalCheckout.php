<?php

namespace PaymentGatewayClient;

class PayPalCheckout extends PaymentGatewayClient
{
    const RESOURCE = 'paypal';

    const METHOD = 'checkout';

    function checkout($data)
    {
        return $this->post(self::METHOD, $data);
    }
}