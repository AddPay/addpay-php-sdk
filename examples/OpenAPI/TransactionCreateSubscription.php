<?php

require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->transactions()
             ->instantiate()
             ->withReference('MyRef')
             ->withDescription('This is my transaction')
             ->withCustomerFirstname('CustomerFirstname')
             ->withCustomerLastname('CustomerLastname')
             ->withCustomerEmail('customer@example.org')
             ->withCustomerMobile('000000000')
             ->withServiceIntent('SUBSCRIPTION')
             ->withContractType('ELASTIC')
             ->withContractCount('2')
             ->withContractMaxAmount('2.50')
             ->withContractInterval('MONTH')
             ->withServiceKey('DIRECTPAY')
             ->withAmountValue('1.50')
             ->withAmountCurrencyCode('USD')
             ->create();

if ($http->succeeds()) {
    dd($http->all());
} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
