<?php

namespace AddPay\Foundation\Protocol\API;

use Configula\Config;
use Exception;

class BaseAPI
{
    public $config;
    public $baseUrl;

    public function __construct()
    {
        $this->config = new Config(__DIR__ . '/../../../../config/');

        $this->validateConfig();

        $this->baseUrl = boolval($this->config['live']) === true ? 'https://secure.addpay.co.za' : 'https://secure-test.addpay.co.za';
    }

    private function validateConfig()
    {
        if (isset($this->config['open_api'])) {
            if (!isset($this->config['open_api']['client_id']) || !isset($this->config['open_api']['client_secret']) || !isset($this->config['open_api']['public_key'])) {
                throw new Exception("Your configuration file is not setup correctly. Read the documentation.");
            }
        } else {
            throw new Exception("The configuration field 'open_api' is missing. Read the documentation.");
        }

        if (isset($this->config['private_api'])) {
            if (!isset($this->config['private_api']['username']) || !isset($this->config['private_api']['password'])) {
                throw new Exception("Your configuration file is not setup correctly. Read the documentation.");
            }
        } else {
            throw new Exception("The configuration field 'private_api' is missing. Read the documentation.");
        }
    }
}
