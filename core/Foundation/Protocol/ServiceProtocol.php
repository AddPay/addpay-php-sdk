<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\BaseProtocol;

class ServiceProtocol extends BaseProtocol
{
    /**
     * Extending endpoint of the BaseProtocol
     *
     * @var string
     */
    protected $endpoint = '/v2/services';

    /**
     * Special primary function to set query parameters specifically
     * for the services endpoint in order to return only services that
     * consist of the specified INTNT.
     *
     * @return mixed
     *
     */
    public function withIntent($intent)
    {
        $this->queryParams .= "intent=*{$intent}*&";

        return $this;
    }

    /**
     * Special primary function to set query parameters specifically
     * for the services endpoint in order to return only services that
     * consist of the specified TYPE.
     *
     * @return mixed
     *
     */
    public function withType($type)
    {
        $this->queryParams .= "type={$type}&";

        return $this;
    }
}
