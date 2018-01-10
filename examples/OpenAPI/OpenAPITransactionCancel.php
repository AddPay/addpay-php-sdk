<?php

$httprequire_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

// View the API documentation to see which fields are allowed to be updated.
$http = $api->transactions()
            ->withId('TRANSACTION_ID_HERE')
            ->cancel();

if ($http->succeeds()) {

    // Read the documentation on what to do next.
    print_r($http->resource);

} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
