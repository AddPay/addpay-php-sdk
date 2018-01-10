<?php

$httprequire_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->services()
            ->withType('transaction')
            ->withIntent('DONATION')
            ->list();

if ($http->succeeds()) {

    // Read the documentation on what to do next.
    print_r($http->resource);

} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
