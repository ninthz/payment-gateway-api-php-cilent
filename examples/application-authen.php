<?php

require_once('bootstrap.php');

use PaymentGatewayClient\ApplicationAuthenticate;

$app = getenv('APP');
$key = getenv('KEY');
$base_uri = getenv('BASE_URI');
$version = getenv('VERSION');

$applicationAuthenticate = new ApplicationAuthenticate();

$applicationAuthenticate->setBaseUri($base_uri);
$applicationAuthenticate->getVersion($version);
$applicationAuthenticate->setTestapi();

$applicationAuthenticate->setCredential($app, $key);

$response = $applicationAuthenticate->auth();


if ($response->isSuccuss()) {
    print_success_result($response);
} else {
    print_failure_result($response);
}