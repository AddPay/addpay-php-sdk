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
          $openSslLoaded = extension_loaded('openssl');
          $curlLoaded = extension_loaded('curl');

          $openSslLoadedString = $openSslLoaded ? "\033[32mYes\033[0m" : "\033[31mNo\033[0m";
          $curlLoadedString = $curlLoaded ? "\033[32mYes\033[0m" : "\033[31mNo\033[0m";

          $canContinue = ($openSslLoaded && $curlLoaded);

          echo "\n\n-------------------------------------------------------\n\n\033[0m";
          echo "\033[32m    AddPay PHP SDK Initialized                   ";
          echo "\n\n\033[0m-------------------------------------------------------\n\n";
          echo "Operating System: \033[36m" . php_uname() . "\033[0m\n\n";
          echo "OpenSSL Extension Loaded: {$openSslLoadedString}\n";
          echo "cURL Extension Loaded: {$curlLoadedString}\n";
          echo "\n";

          if (!$canContinue) {
             echo "\033[31mCannot continue without required modules loaded\033[0m\n\n";
             exit;
          } else {
            echo "\033[32mRun an example scripts with:\033[0m php examples/ScriptNameHere.php\n\n";
          }
    }
}

if (!function_exists('printAddPaySDKDocPage')) {
    function printAddPaySDKDocPage()
    {
        require_once(__DIR__ . '/../examples/Assets/Documentation/tpl/DocumentTemplate.tpl');
    }
}

if (!function_exists('startsWith')) {
    function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}

if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return $length === 0 ||
    (substr($haystack, -$length) === $needle);
    }
}
