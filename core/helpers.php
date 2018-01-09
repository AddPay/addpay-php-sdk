<?php

if (!function_exists('runningAddPaySdkInBrowser')) {
    function runningAddPaySdkInBrowser()
    {
        return php_sapi_name() != 'cli';
    }
}

if (!function_exists('runningAddPaySdkInCommandLine')) {
    function runningAddPaySdkInCommandLine()
    {
        return php_sapi_name() == 'cli';
    }
}

if (!function_exists('printAddPaySDKLoaded')) {
    function printAddPaySDKLoaded()
    {
        echo "\n\n-------------------------------------------------------\n\n\033[0m";
        echo "\033[32m    AddPay PHP SDK Successfully initialized                   ";
        echo "\n\n\033[0m-------------------------------------------------------\n\n";
    }
}

if (!function_exists('printAddPaySDKDocPage')) {
    function printAddPaySDKDocPage()
    {
        require_once(__DIR__ . '/../examples/Assets/Documentation/tpl/DocumentTemplate.tpl');
    }
}
