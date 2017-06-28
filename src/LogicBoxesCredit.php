<?php

namespace PaymentGatewayClient;

class LogicBoxesCredit extends PaymentGatewayClient
{
    const RESOURCE = 'lb';

    const METHOD = 'credit';

    function credit($data)
    {
        return $this->post(self::METHOD, $data);
    }
}