<?php
require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->transactions()->find('TRANSACTION_ID_HERE');

if ($http->succeeds()) {

    // For now we will just spit out the entire object then exit
    // (dd() exists the app after printing data)
    dd($http->all());

    // To get a specific field object:
    //dd($http->getAnythingYouLike());

    // Examples (REFER TO THE API DOCUMENTATION FOR A LIST OF AVAILABLE FIELDS):
    //dd($http->getId());
    //dd($http->getReference());
    //dd($http->getStatus());
    //dd($http->getStatusReason());
    //dd($http->getAmount());

    // To get a nested object value, for example the Amount Currency Name:
    //dd($http->getAmountCurrencyName());

    // Or and entire object with its subfields, for example the Customer
    //dd($http->getCustomer());

    // To simply dump the entire transaction object:
    //dd($http->all());

} else {

    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Error '{$errorCode}' with message '{$errorMsg}'";

    dd($http->resource);

}
