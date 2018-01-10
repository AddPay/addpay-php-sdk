<?php

namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\API\BaseApi;
use AddPay\Foundation\Objects\JSONObject;

use Zttp\Zttp;

class BaseProtocol
{
    /**
     * API Object class container
     *
     * @var BaseAPI
     */
    private $api;

    /**
     * Container for all headers to be submitted on each API request
     *
     * @var array
     */
    private $headers = array();

    /**
     * The resource container
     *
     * @var JSONObject
     */
    private $resource;

    /**
     * Parent endpoint of the BaseProtocol
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Query params container, reset on every request
     *
     * @var string
     */
    protected $queryParams = '?';

    /**
     * Construct the base protocol class.
     *
     * @param  BaseAPI $api The API object class
     *
     * @return void
     *
     */
    public function __construct(BaseAPI $api)
    {
        $this->api = $api;
        $this->resource = new JSONObject(array(), $this);

        $this->prepareAuthenticationHeader();
    }

    /**
     * Pre-allocates the authentication header to be submitted
     * with each API request.
     *
     * @return null
     *
     */
    private function prepareAuthenticationHeader()
    {
        $tokenDecoded = "{$this->api->config['open_api']['client_id']}:{$this->api->config['open_api']['client_secret']}";
        $tokenEncoded = base64_encode($tokenDecoded);
        $tokenTokened = "Token {$tokenEncoded}";

        $this->headers['Authorization'] = $tokenTokened;
    }

    /**
     * Submit request to API to find an object by its ID
     *
     * @param string $id The ID of the object
     *
     * @return JSONObject
     *
     */
    public function findById($id)
    {
        $response = Zttp::withHeaders($this->headers)->get("{$this->api->baseUrl}{$this->endpoint}/{$id}{$this->queryParams}");

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    /**
     * Alias of findById($id)
     *
     * @param string $id The ID of the object
     *
     * @return JSONObject
     *
     */
    public function find($id)
    {
        return $this->findById($id);
    }

    /**
     * Submit request to API to list all objects
     *
     * @return JSONObject
     *
     */
    public function list()
    {
        $response = Zttp::withHeaders($this->headers)->get("{$this->api->baseUrl}{$this->endpoint}{$this->queryParams}");

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    /**
     * Create new instance of object
     *
     * @return JSONObject
     *
     */
    public function new()
    {
        $this->resource = new JSONObject(array(), $this);

        return $this->resource;
    }

    /**
     * Submit request to API to store an object
     *
     * @return JSONObject
     *
     */
    public function store()
    {
        $response = Zttp::withHeaders($this->headers)->asFormParams()->post("{$this->api->baseUrl}{$this->endpoint}{$this->queryParams}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    /**
     * Alias of store()
     *
     * @return JSONObject
     *
     */
    public function create()
    {
        return $this->store();
    }


    /**
     * ASubmit request to API to update an object
     *
     * @return JSONObject
     *
     */
    public function update()
    {
        $id = $this->resource->resource['data']['id'] ?? $this->resource->resource['id'];

        $response = Zttp::withHeaders($this->headers)->asFormParams()->put("{$this->api->baseUrl}{$this->endpoint}/{$id}{$this->queryParams}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    /**
     * Submit request to API to delete an object
     *
     * @return JSONObject
     *
     */
    public function delete()
    {
        $id = $this->resource->resource['data']['id'] ?? $this->resource->resource['id'];

        $response = Zttp::withHeaders($this->headers)->asFormParams()->delete("{$this->api->baseUrl}{$this->endpoint}/{$id}{$this->queryParams}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        return $this->resource;
    }

    /**
     * Alias of delete()
     *
     * @return JSONObject
     *
     */
    public function cancel()
    {
        return $this->delete();
    }

    /**
     * Submit request to API to process an object
     *
     * @param  void  $callback An optional callback after the request been processed
     *
     * @return JSONObject
     *
     */
    public function process($callback = false)
    {
        $id = $this->resource->resource['data']['id'] ?? $this->resource->resource['id'];

        $response = Zttp::withHeaders($this->headers)->asFormParams()->patch("{$this->api->baseUrl}{$this->endpoint}/{$id}{$this->queryParams}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response->json(), $this);

        if ($callback !== false) {
            $result = $callback($this, $this->resource->resource);

            if (!is_null($result)) {
                return $result;
            }
        }

        return $this->resource;
    }

    /**
     * Function extension, call any undefined functions on the parent resource.
     *
     * @param  string $name
     * @param  mixed  $args
     *
     * @return JSONObject
     *
     * @throws Exception If the function does not exist on the parent resource.
     *
     */
    public function __call($name, $args)
    {
        if (substr($name, 0, 4) == 'with') {
            return $this->resource->{$name}(...$args);
        } else {
            throw new \Exception("No such function '{$name}'. Read the documentation.");
        }
    }
}
