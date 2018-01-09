<?php
/*
|--------------------------------------------------------------------------
| AddPay PHP SDK
| by Stephen Lake
|--------------------------------------------------------------------------
|
| Please read about the helper functions and magic methods defined in the
| package readme to prevent any confusion:
|
| https://github.com/stephenlake/AddPay-PHP-SDK/blob/master/README.md
|
| DisectTransaction.php
| ----------------------
| Demonstrate the disecting of a transaction and any fields contained within
| the transaction object. Please refer to the API documentation for a full
| list of transaction fields and what may be disected using this code.
|
*/
require_once(__DIR__ . '/../core/OpenAPI.php');

$api = new AddPayOpenAPI();

// Fetch the transaction from the API.
//
// This is an actual API call, do not call this multiple times
// after it has already been retrieved just to get a new field.
//
$http = $api->transactions()->find('TRANSACTION_ID_HERE');

// The HTTP response is stored in the $calls->resource attribute;
dd($http->resource);

if ($http->succeeds()) {

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

    // This represents a validation error, meaning the input provided
    // in the API request was invalid, missing fields, incorrect or
    // just not allowed to be processed. The error code will most likely
    // always be 422 - Unprocessible Entity, but you need to read the API
    // documentation to be aware of the full list of error codes. We are
    // not going to create secondary documentation here.
    $errorCode = $http->getErrorCode();
    $errorMsg  = $http->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'";

}
