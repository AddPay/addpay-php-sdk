<?php
require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new PublicAPI();

$countries = $api->countries()->get();

if ($countries->succeeds()) {
    var_dump($countries->all());
} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Error '{$errorCode}' with message '{$errorMsg}'";

    var_dump($http->resource);
}
