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
| index.php
| ----------------------
| Entry point file to bootstrap the relevant API classes for use when
| testing examples in a web server environment.
|
*/

require_once(__DIR__ . '/../core/bootstrap.php');

if (runningAddPaySdkInCommandLine()) {
    printAddPaySDKLoaded();
}

if (runningAddPaySdkInBrowser()) {
    printAddPaySDKDocPage();
}
