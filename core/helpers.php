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
            echo "\033[32mRun an example script with:\033[0m php OepnAPI/ScriptNameHere.php (Example: php OpenAPI/ServiceListSale.php)\n\n";
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

if (!function_exists('openApi')) {
    function openApi($config = null)
    {
        return new AddPay\Foundation\Protocol\API\OpenAPI($config);
    }
}

if (!function_exists('publicApi')) {
    function publicApi($config = null)
    {
        return new AddPay\Foundation\Protocol\PublicAPI($config);
    }
}

if (!function_exists('setHeader')) {
    function setHeader($code)
    {
        SDKUtils::setHeader($code);
    }
}

if (!function_exists('getWebhookSecurityHeader')) {
    function getWebhookSecurityHeader()
    {
        return SDKUtils::getWebhookSecurityHeader();
    }
}

if (!function_exists('webhookSecurityHeaderMatches')) {
    function webhookSecurityHeaderMatches($str)
    {
        return SDKUtils::webhookSecurityHeaderMatches($str);
    }
}

if (!function_Exists('getallheaders')) {
    function getallheaders()
    {
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

class SDKUtils
{
    public static function setHeader($code)
    {
        $codes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => 'Switch Proxy',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            425 => 'Unordered Collection',
            426 => 'Upgrade Required',
            449 => 'Retry With',
            450 => 'Blocked by Windows Parental Controls',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            509 => 'Bandwidth Limit Exceeded',
            510 => 'Not Extended'
        );

        if (!isset($codes[$code])) {
            $codes[$code] = "";
        }

        header("HTTP/1.1 {$code} {$codes[$code]}");
    }

    public function getWebhookSecurityHeader()
    {
        $headers = getallheaders();

        return isset($headers['X-ADDPAY-KEY']) ? $headers['X-ADDPAY-KEY'] : '';
    }

    public static function webhookSecurityHeaderMatches($str)
    {
        return self::getWebhookSecurityHeader() == $str;
    }
}
