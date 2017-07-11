<?php

require_once('bootstrap.php');

use PaymentGatewayClient\ApplicationAuthenticate;

$app = getenv('APP');
$key = getenv('KEY');

$applicationAuthenticate = new ApplicationAuthenticate();

$applicationAuthenticate->setTestapi();

$applicationAuthenticate->setCredential($app, $key);

try {
    $response = $applicationAuthenticate->auth();

    if ($response->isSuccuss()) {
        print_success_result($response);
    } else {
        print_failure_result($response);
    }

} catch (\PaymentGatewayClient\Exceptions\HostHandshakeFailed $e) {
    echo $e->getMessage();
}
