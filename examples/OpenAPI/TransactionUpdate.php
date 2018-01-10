<?php

require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

// View the API documentation to see which fields are allowed to be updated.
$http = $api->transactions()
            ->withId('TRANSACTION_ID_HERE')
            ->withInitiatesAt('2050-01-01')
            ->withInstrumentType('CARD')
            ->withInstrumentNumber('4242424242424242')
            ->withInstrumentCvv('123')
            ->withInstrumentExpiryMonth('01')
            ->withInstrumentExpiryYear('2050')
            ->update();

if ($http->succeeds()) {
    dd($http->all());
} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
