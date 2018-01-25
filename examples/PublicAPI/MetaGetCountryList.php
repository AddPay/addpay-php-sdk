<?php
require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new PublicAPI();

$countries = $api->countries()->get();

if ($countries->succeeds()) {
    dd($countries->all());
} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Error '{$errorCode}' with message '{$errorMsg}'";

    dd($http->resource);
}
