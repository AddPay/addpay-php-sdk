<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\BaseProtocol;
use AddPay\Foundation\Objects\JSONObject;

use Zttp\Zttp;

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
        $response = Zttp::get("{$this->api->baseUrl}{$this->endpoint}");

        $this->resource = new JSONObject($response->json(), $this);

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
        $response = Zttp::post("{$this->api->baseUrl}{$this->endpoint}", $this->resource->resource);

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }
}
