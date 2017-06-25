<?php

require_once('bootstrap.php');

use PaymentGatewayClient\PayPalCheckout;

$app = getenv('APP');
$key = getenv('KEY');
$uri = getenv('URI');

$paypalCheckout = new PayPalCheckout();

$paypalCheckout->setCredential($app, $key);

$paypalCheckout->setUrl($uri);

$data = [
    'currency' => 'USD',
    'amount' => 5.00,
    'url' => [
        'approval' => 'http://test-api.payment-gateway.netearth.local/v1',
        'cancel' => 'http://www.paypal.com'
    ]
];

$response = $paypalCheckout->setCheckout($data);

if ($response->isSuccuss()) {
    print_success_result($response);
} else {
    print_failure_result($response);
}