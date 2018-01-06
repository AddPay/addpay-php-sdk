<?php

namespace AddPay\Foundation\Protocol\API;

use AddPay\Foundation\Protocol\ServiceProtocol;
use AddPay\Foundation\Protocol\TransactionProtocol;

class OpenAPI extends BaseAPI
{
    private $services;
    private $transactions;

    public function __construct()
    {
        parent::__construct();

        $this->services = new ServiceProtocol($this);
        $this->transactions = new TransactionProtocol($this);
    }

    public function services()
    {
        return $this->services;
    }

    public function transactions()
    {
        return $this->transactions;
    }
}
