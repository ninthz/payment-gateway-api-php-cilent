<?php

namespace PaymentGatewayClient;


class PayPalCreditCard extends PaymentGatewayClient
{
    const RESOURCE = 'paypal';

    const METHOD = 'credit-card';

    public function create(array $data)
    {
        return $this->post(self::METHOD, $data);
    }

    public function find(int $id)
    {
        return $this->get(self::METHOD.'/'.$id);
    }

    public function list($resellerId = '')
    {
        if ($resellerId) {
            $resellerId = '?reseller-id='.$resellerId;
        }

        return $this->get(self::METHOD.$resellerId);
    }

    public function update(int $id, array $data)
    {
        return $this->put(self::METHOD.'/'.$id, $data);
    }

    public function remove(int $id)
    {
        return $this->delete(self::METHOD.'/'.$id);
    }

    public function payment($data)
    {
        return $this->post(self::METHOD.'/payment', $data);
    }
}