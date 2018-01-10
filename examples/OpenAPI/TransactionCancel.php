<?php

require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

// View the API documentation to see which fields are allowed to be updated.
$http = $api->transactions()
            ->withId('TRANSACTION_ID_HERE')
            ->cancel();

if ($http->succeeds()) {
    dd($http->all());
} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
