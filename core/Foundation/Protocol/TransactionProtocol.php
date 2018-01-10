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
    public function new($protocol = false)
    {
        return parent::new(array(), $this);
    }
}
