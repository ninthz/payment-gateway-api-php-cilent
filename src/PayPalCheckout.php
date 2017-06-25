<?php

namespace PaymentGatewayClient;

class PayPalCheckout extends PaymentGatewayClient
{
    const RESOURCE = 'paypal';

    const METHOD = 'checkout';

    function setCheckout($data)
    {
        return $this->post(self::METHOD.'/set', $data);
    }

    function doCheckout($data)
    {
        $data = array_merge($data, ['approval' => true]);
        return $this->post(self::METHOD.'/do', $data);
    }

    function cancelCheckout($data)
    {
        $data = array_merge($data, ['approval' => false]);
        return $this->post(self::METHOD.'/do', $data);
    }
}