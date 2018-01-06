<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\BaseProtocol;

class TransactionProtocol extends BaseProtocol
{
    protected $endpoint = '/v2/transactions';

    public function new($protocol = false)
    {
        return parent::new(array(), $this);
    }

    public function statusIs($status)
    {
        return $status == ($this->resource->resource['status'] ?? '');
    }

    public function getStatusReason()
    {
        return $this->resource->resource['status_reason'] ?? null;
    }
}
