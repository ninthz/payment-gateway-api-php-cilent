<?php

function print_success_result($response)
{
    echo "Success!".PHP_EOL;
    print_r($response->toJson());
}

function print_failure_result($response)
{
    echo "Failure!".PHP_EOL;
    echo "Status code:".$response->getStatusCode().PHP_EOL;
    echo $response->getErrorMessage().PHP_EOL;
}

