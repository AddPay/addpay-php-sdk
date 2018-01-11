<?php

namespace AddPay\Foundation\Protocol\API;

use AddPay\Foundation\Protocol\AuthenticationProtocol;

class PrivateAPI extends BaseAPI
{
    /**
     * The authentication protocol container.
     *
     * @var AuthenticationProtocol
     */
    private $authentication;

    /**
     * Basically a bootstrapper for the core API class,
     * ensures config integrity and throws an exception
     * if there are issues with the config.
     *
     * @return void
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->baseUrl = boolval($this->config['live']) === true ? 'https://www.addpay.co.za' : 'https://secure-test.addpay.co.za';

        $this->authentication = new AuthenticationProtocol($this);
    }

    /**
     * Returns the authentication protocol container
     *
     * @return AuthenticationProtocol
     *
     */
    public function authentication()
    {
        return $this->authentication;
    }
}
