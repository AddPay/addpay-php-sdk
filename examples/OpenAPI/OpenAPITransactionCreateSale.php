<?php

require_once(__DIR__ . '/../core/AddPayOpenAPI.php');

$call = $api->transactions()
            ->new()
            ->withReference('SOMEREF')
            ->withDescription('This is my transaction')
            ->withCustomerFirstname('CustomerFirstname')
            ->withCustomerLastname('CustomerLastname')
            ->withCustomerEmail('customer@example.org')
            ->withCustomerMobile('000000000')
            ->withServiceIntent('SALE')
            ->withServiceKey('DIRECTPAY')
            ->withAmountValue('1.50')
            ->withAmountCurrencyCode('USD')
            ->create();

if ($call->succeeds()) {

    // Read the documentation on what to do next.
    print_r($call->resource);

} else {
    $errorCode = $call->getErrorCode();
    $errorMsg  = $call->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
