<?php

require_once(__DIR__ . '/../core/AddPayOpenAPI.php');

$call = $api->transactions()
            ->withId('TRANSACTION_ID_HERE')
            ->process();

if ($call->succeeds()) {

    // You have the choice to use your own payment page here,
    // or use AddPay's hosted payment page. Read the docs, it
    // explains everything you need to know.
    print_r($call->resource);

} else {
    $errorCode = $call->getErrorCode();
    $errorMsg  = $call->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
