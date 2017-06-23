<?php

namespace PaymentGatewayClient;


class Transaction extends PaymentGatewayClient
{
    const RESOURCE = 'transaction';

    public function find($id)
    {
        return  $this->get($id);
    }
}