<?php

require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->transactions()
            ->new()
            ->withReference('MyRef')
            ->withDescription('This is my transaction')
            ->withCustomerFirstname('CustomerFirstname')
            ->withCustomerLastname('CustomerLastname')
            ->withCustomerEmail('customer@example.org')
            ->withCustomerMobile('000000000')
            ->withServiceIntent('DONATION')
            ->withServiceKey('DIRECTPAY')
            ->create();

if ($http->succeeds()) {

    // Read the documentation on what to do next.
    print_r($http->resource);

} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
