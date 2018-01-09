<?php

require_once(__DIR__ . '/../core/AddPayOpenAPI.php');

// View the API documentation to see which fields are allowed to be updated.
$call = $api->transactions()
            ->withId('TRANSACTION_ID_HERE')
            ->withInitiatesAt('2050-01-01')
            ->withInstrumentType('CARD')
            ->withInstrumentNumber('4242424242424242')
            ->withInstrumentCvv('123')
            ->withInstrumentExpiryMonth('01')
            ->withInstrumentExpiryYear('2050')
            ->update();

if ($call->succeeds()) {

    // Read the documentation on what to do next.
    print_r($call->resource);

} else {
    $errorCode = $call->getErrorCode();
    $errorMsg  = $call->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
