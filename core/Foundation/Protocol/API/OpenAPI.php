<?php

namespace AddPay\Foundation\Protocol\API;

use AddPay\Foundation\Protocol\ServiceProtocol;
use AddPay\Foundation\Protocol\TransactionProtocol;

class OpenAPI extends BaseAPI
{
    /**
     * The service protocol container.
     *
     * @var ServiceProtocol
     */
    private $services;

    /**
     * The transaction protocol container.
     *
     * @var TransactionProtocol
     */
    private $transactions;

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

        $this->baseUrl = boolval($this->config['live']) === true ? 'https://secure.addpay.co.za' : 'https://secure-test.addpay.co.za';

        $this->services = new ServiceProtocol($this);
        $this->transactions = new TransactionProtocol($this);
    }

    /**
     * Returns the service protocol container
     *
     * @return ServiceProtocol
     *
     */
    public function services()
    {
        return $this->services;
    }

    /**
     * Returns the transaction protocol container
     *
     * @return TransactionProtocol
     *
     */
    public function transactions()
    {
        return $this->transactions;
    }
}
