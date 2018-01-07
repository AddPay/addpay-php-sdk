<?php

require_once(__DIR__ . '/../core/AddPayOpenAPI.php');

/*
|--------------------------------------------------------------------------
| AddPay PHP Package
|--------------------------------------------------------------------------
|
| Read the API documentation at https://www.addpay.co.za/developers for more
| information on how this method works and the parameters it accepts.
|
| @Author: Stephen Lake <stephen@closurecode.com>
|
| With regard to support of this package, no questions that have already been
| answered in the API documentation will be answered from me. Please ensure
| you have thoroughly read through the entire document before raising concerns.
|
| If you believe there is a problem with this package, please use the ISSUES
| feature and create a new issue on the GitHub (pronounced with a G, not a J)
| page here: https://github.com/stephenlake/addpay-php/issues
|
| Thanks!
|
*/

$call = $api->transactions()
            ->new()
            ->withReference('SOMEREF')
            ->withDescription('This is my transaction')
            ->withCustomerFirstname('CustomerFirstname')
            ->withCustomerLastname('CustomerLastname')
            ->withCustomerEmail('customer@example.org')
            ->withCustomerMobile('000000000')
            ->withServiceIntent('SALE')
            ->withServiceKey('DIRECTPAY')
            ->withAmountValue('1.50')
            ->withAmountCurrencyCode('USD')
            ->create();

if ($call->succeeds()) {

    // Read the documentation on what to do next.
    print_r($call->resource);

} else {
    $errorCode = $call->getErrorCode();
    $errorMsg  = $call->getErrorMessage();

    echo "Dang it! Error '{$errorCode}' with message '{$errorMsg}'.";
}