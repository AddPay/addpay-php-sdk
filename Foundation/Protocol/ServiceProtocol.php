<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\BaseProtocol;

class ServiceProtocol extends BaseProtocol
{
    protected $endpoint = '/v2/services';

    public function withIntent($intent)
    {
        $this->queryParams .= "intent=*{$intent}*&";

        return $this;
    }

    public function withType($type)
    {
        $this->queryParams .= "type={$type}&";

        return $this;
    }
}
