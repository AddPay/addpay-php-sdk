<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\BaseProtocol;

class TransactionProtocol extends BaseProtocol
{
    /**
     * Extending endpoint of the BaseProtocol
     *
     * @var string
     */
    protected $endpoint = '/v2/transactions';

    /**
     * Create new instance of an empty transaction object
     *
     * @return mixed
     *
     */
    public function instantiate($protocol = false)
    {
        return parent::instantiate(array(), $this);
    }
}
