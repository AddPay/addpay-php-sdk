<?php
require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new PublicAPI();

$currencies = $api->currencies()->get();

if ($currencies->succeeds()) {
  var_dump($currencies->all());
} else {
  $errorCode = $http->getErrorCode();
  $errorMsg  = $http->getErrorMessage();

  echo "Error '{$errorCode}' with message '{$errorMsg}'";

  var_dump($http->resource);
}
