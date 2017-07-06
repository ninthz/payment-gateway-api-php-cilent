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

    public function find($id)
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

    public function update($id, array $data)
    {
        return $this->put(self::METHOD.'/'.$id, $data);
    }

    public function remove($id)
    {
        return $this->delete(self::METHOD.'/'.$id);
    }

    public function payment($data)
    {
        return $this->post(self::METHOD.'/payment', $data);
    }

    public function paymentWithoutSavedCard(array $data)
    {
        return $this->post(self::METHOD.'/payment-without-saved-card', $data);
    }
}
