<?php

require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->transactions()
            ->withId('TRANSACTION_ID_HERE')
            ->process();

if ($http->succeeds()) {
    var_dump$http->all());
} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}
