<?php

require_once(__DIR__ . '/AddPayOpenAPI.php');
require_once(__DIR__ . '/AddPayPrivateAPI.php');
require_once(__DIR__ . '/AddPayPublicAPI.php');

$openAPI = new AddPayOpenAPI();


// $serviceList = $openAPI->services()
//                        ->withType('transaction')
//                        ->withIntent('SALE')
//                        ->list();
//
// if ($serviceList->succeeds()) {
//     print_r($serviceList);
// } else {
//     print_r($serviceList);
// }


// Creating a transaction
// $transaction = $openAPI->transactions()
//                        ->new()
//                        ->withReference('MyRef')
//                        ->withDescription('This is my transaction')
//                        ->withCustomerFirstname('CustomerFirstname')
//                        ->withCustomerLastname('CustomerLastname')
//                        ->withCustomerEmail('customer@email.address')
//                        ->withCustomerMobile('0810249767')
//                        ->withServiceIntent('SUBSCRIPTION')
//                        ->withContractType('ELASTIC')
//                        ->withContractCount('2')
//                        ->withContractMaxAmount('2.50')
//                        ->withContractInterval('DAY')
//                        ->withServiceKey('DIRECTPAY')
//                        ->withAmountValue('1.50')
//                        ->withAmountCurrencyCode('ZAR')
//                        ->store(); // Or ->create();

// Retreiving a transaction
// $transaction = $openAPI->transactions()->find('3095d976-2220-4dd2-bd6a-23bf8b48b774');

// $transaction = $openAPI->transactions()
//                        ->withId('3095d976-2220-4dd2-bd6a-23bf8b48b774')
//                        ->withServiceKey('IVICORP')
//                        ->update();

// Processing a transasction
$transaction = $openAPI->transactions()
                       ->withId('3095d976-2220-4dd2-bd6a-23bf8b48b774')
                       ->onFailure(function($transaction, $response) {

                       })
                       ->onSuccess(function($transaction, $response) {

                       })
                       ->process();

// Cancelling a transasction
// $transaction = $openAPI->transactions()
//                        ->withId('3095d976-2220-4dd2-bd6a-23bf8b48b774')
//                        ->cancel();

print_r($transaction->resource);
