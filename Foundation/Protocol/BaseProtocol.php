<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\API\BaseApi;
use AddPay\Foundation\Objects\JSONObject;

use Zttp\Zttp;

class BaseProtocol
{
    private $api;
    private $headers = array();
    private $resource;

    protected $endpoint;
    protected $queryParams = '?';

    public function __construct(BaseAPI $api)
    {
        $this->api = $api;
        $this->resource = new JSONObject(array(), $this);

        $this->prepareAuthenticationHeader();
    }

    private function prepareAuthenticationHeader()
    {
        $tokenDecoded = "{$this->api->config['open_api']['client_id']}:{$this->api->config['open_api']['client_secret']}";
        $tokenEncoded = base64_encode($tokenDecoded);
        $tokenTokened = "Token {$tokenEncoded}";

        $this->headers['Authorization'] = $tokenTokened;
    }

    public function findById($id)
    {
        $response = Zttp::withHeaders($this->headers)->get("{$this->api->baseUrl}{$this->endpoint}/{$id}{$this->queryParams}");

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    public function find($id)
    {
        return $this->findById($id);
    }

    public function list()
    {
        $response = Zttp::withHeaders($this->headers)->get("{$this->api->baseUrl}{$this->endpoint}{$this->queryParams}");

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    public function new()
    {
        $this->resource = new JSONObject(array(), $this);

        return $this->resource;
    }

    public function store()
    {
        $response = Zttp::withHeaders($this->headers)->asFormParams()->post("{$this->api->baseUrl}{$this->endpoint}{$this->queryParams}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    public function create()
    {
        return $this->store();
    }

    public function update()
    {
        $id = $this->resource->resource['data']['id'] ?? $this->resource->resource['id'];

        $response = Zttp::withHeaders($this->headers)->asFormParams()->put("{$this->api->baseUrl}{$this->endpoint}/{$id}{$this->queryParams}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    public function delete()
    {
        $id = $this->resource->resource['data']['id'] ?? $this->resource->resource['id'];

        $response = Zttp::withHeaders($this->headers)->asFormParams()->delete("{$this->api->baseUrl}{$this->endpoint}/{$id}{$this->queryParams}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    public function cancel()
    {
        return $this->delete();
    }

    public function process($callback = false)
    {
        $id = $this->resource->resource['data']['id'] ?? $this->resource->resource['id'];

        $response = Zttp::withHeaders($this->headers)->asFormParams()->patch("{$this->api->baseUrl}{$this->endpoint}/{$id}{$this->queryParams}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        //$this->resource = new JSONObject(array(), $this);

        if ($callback !== false) {
            $result = $callback($this, $this->resource->resource);

            if (!is_null($result)) {
                return $result;
            }
        }

        return $this->resource;
    }

    public function __call($name, $args)
    {
        if (substr($name, 0, 4) == 'with') {
            return $this->resource->{$name}(...$args);
        } else {
            throw new \Exception("No such function '{$name}'. Read the documentation.");
        }
    }
}
