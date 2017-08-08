<?php

namespace PaymentGatewayClient;

class PayPalBillingAgreement extends PaymentGatewayClient
{
    const RESOURCE = 'paypal';

    const METHOD = 'billing-agreement';

    function set($data)
    {
        return $this->post(self::METHOD.'/set', $data);
    }

    function create($data)
    {
        $data = array_merge($data);
        return $this->post(self::METHOD.'/create', $data);
    }

    function doReferenceTransaction($data)
    {
        $data = array_merge($data);
        return $this->post(self::METHOD.'/charge', $data);
    }
}
