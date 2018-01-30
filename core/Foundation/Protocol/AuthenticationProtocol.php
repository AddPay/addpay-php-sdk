<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\BaseProtocol;
use AddPay\Foundation\Objects\JSONObject;

class AuthenticationProtocol extends BaseProtocol
{
    /**
     * Extending endpoint of the BaseProtocol
     *
     * @var string
     */
    protected $endpoint = '/merchant/auth';

    /**
     * Submit request to API to get authentication status
     *
     * @return JSONObject
     *
     */
    public function status()
    {
        $response = $this->createRequest('GET', "");

        $this->resource = new JSONObject($response, $this);

        return $this->resource;
    }

    /**
     * Submit request to API to create authentication presence
     *
     * @return JSONObject
     *
     */
    public function submit()
    {
        $response = $this->createRequest('POST', "", $this->resource->resource);

        $this->resource = new JSONObject($response, $this);

        return $this->resource;
    }
}
