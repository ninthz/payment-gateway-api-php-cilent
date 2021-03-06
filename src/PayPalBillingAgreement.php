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
        return $this->post(self::METHOD.'/create', $data);
    }

    function doReferenceTransaction($data)
    {
        return $this->post(self::METHOD.'/charge', $data);
    }

    function details($token)
    {
        return $this->get(self::METHOD.'/'.$token);
    }

    function cancel($billingAgreementId)
    {
        return $this->delete(self::METHOD.'/'.$billingAgreementId);
    }
}
