<?php
require_once(__DIR__ . '/../../core/bootstrap.php');

$api = new OpenAPI();

$http = $api->transactions()->find('TRANSACTION_ID_HERE');

if ($http->succeeds()) {

    // For now we will just spit out the entire object then exit
    // (var_dump) exists the app after printing data)
    var_dump$http->all());

    // To get a specific field object:
    //var_dump$http->getAnythingYouLike());

    // Examples (REFER TO THE API DOCUMENTATION FOR A LIST OF AVAILABLE FIELDS):
    //var_dump$http->getId());
    //var_dump$http->getReference());
    //var_dump$http->getStatus());
    //var_dump$http->getStatusReason());
    //var_dump$http->getAmount());

    // To get a nested object value, for example the Amount Currency Name:
    //var_dump$http->getAmountCurrencyName());

    // Or and entire object with its subfields, for example the Customer
    //var_dump$http->getCustomer());

    // To simply dump the entire transaction object:
    //var_dump$http->all());

} else {

    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Error '{$errorCode}' with message '{$errorMsg}'";

    var_dump$http->resource);

}
