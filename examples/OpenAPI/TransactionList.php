<?php
require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->transactions()
            ->withPageNumber(1) // Page number
            ->withPageLimit(10) // Results per page - Max: 50 Min: 1
            ->withinDateRange('2018-01-09', '2050-01-01') // Return transactions within date range
            ->get();

if ($http->succeeds()) {
    // Get the results
    var_dump($http->all());

    // You may want to keep track of the page number, in that case
    var_dump($http->resource);
    // prints out the entire payload including the meta data

} else {
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Error '{$errorCode}' with message '{$errorMsg}'";

    var_dump($http->resource);
}
