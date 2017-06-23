<?php

require_once('bootstrap.php');

use PaymentGatewayClient\Transaction;

$app = getenv('APP');
$key = getenv('KEY');

$base_uri = getenv('BASE_URI');
$version = getenv('VERSION');

$transaction = new Transaction();

$transaction->setBaseUri($base_uri);
$transaction->getVersion($version);
$transaction->setTestapi();

$transaction->setCredential($app, $key);

try {
    $response = $transaction->find(2);

    if ($response->isSuccuss()) {
        print_success_result($response);
    } else {
        print_failure_result($response);
    }

} catch (\PaymentGatewayClient\Exceptions\HostHandshakeFailed $e) {
    echo $e->getMessage();
}