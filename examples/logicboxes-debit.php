<?php

require_once('bootstrap.php');

use PaymentGatewayClient\LogicBoxesDebit;

$app = getenv('APP');
$key = getenv('KEY');
$uri = getenv('URI');

$logicBoxesDebit = new LogicBoxesDebit();

$logicBoxesDebit->setCredential($app, $key);

$logicBoxesDebit->setUrl($uri);

$data = [
    'currency' => 'USD',
    'amount' => 5.00,
    'description' => 'Test debit the money',
    'reseller_id' => getenv('LB_RESELLER_ID'),
    'username' => getenv('LB_USERNAME'),
    'password' => getenv('LB_PASSWORD'),
];

$response = $logicBoxesDebit->debit($data);

if ($response->isSuccess()) {
    print_success_result($response);
} else {
    print_failure_result($response);
}