<?php

require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->transactions()
            ->withId('TRANSACTION_ID_HERE')
            ->process();

if ($http->succeeds()) {

    // You have the choice to use your own payment page here,
    // or use AddPay's hosted payment page. Read the docs, it
    // explains everything you need to know.
    print_r($http->resource);

} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
