<?php
require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->transactions()->find('TRANSACTION_ID_HERE');

if ($http->succeeds()) {

    // For now we will just spit out the entire object then exit
    // (dd() exists the app after printing data)
    dd($http->all());

    // To get a specific field object that doesnt exist:
    dd($http->getAnythingYouLike());

    // To get some actual fields:
    dd($http->getId());
    dd($http->getReference());
    dd($http->getStatus());
    dd($http->getStatusReason());
    dd($http->getAmount());
    // etc, etc, etc

    // To get a nested object value, for example the
    // Transaction Amount Currency Name:
    dd($http->getTransactionAmountCurrencyName());

    // Or and entire object with its subfields, the call_to_action object
    dd($http->getCallToAction());

    // To simply dump the entire transaction object:
    dd($http->all());

} else {

    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Error '{$errorCode}' with message '{$errorMsg}'";

    dd($http->resource);

}
