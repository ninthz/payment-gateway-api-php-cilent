<?php

namespace PaymentGatewayClient;

class LogicBoxesDebit extends PaymentGatewayClient
{
    const RESOURCE = 'lb';

    const METHOD = 'debit';

    function debit($data)
    {
        return $this->post(self::METHOD, $data);
    }
}