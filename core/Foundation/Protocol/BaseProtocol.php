<?php
namespace AddPay\Foundation\Protocol;

use AddPay\Foundation\Protocol\API\BaseApi;
use AddPay\Foundation\Objects\JSONObject;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Logger\Logger;

class BaseProtocol
{
    /**
     * API Object class container
     *
     * @var BaseAPI
     */
    public $api;

    /**
     * Container for all headers to be submitted on each API request
     *
     * @var array
     */
    public $headers = array();

    /**
     * The resource container
     *
     * @var JSONObject
     */
    public $resource;

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
     * Console logger
     *
     * @var mixed
     */
    public $logConsole;

    /**
     * File logger
     *
     * @var mixed
     */
    public $logFile;

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
        $this->logConsole = new Logger('SDK-' . date('Y-m-d') . '.log');
        $this->logFile    = new Logger('SDK-' . date('Y-m-d') . '.log');

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
     * Create HTTP request wrapped around GuzzleHttp client and return result.
     *
     * @return JSONObject
     *
     */
    public function createRequest($method, $url, $body = array())
    {
        $httpRequest = new Client();

        if ($this->api->config['logging_enabled']) {
            $requestId = md5(time());

            $logBody = json_encode($body);
            $logHeaders = json_encode($this->headers);

            $this->logFile->info("[{$requestId}] HTTP Request Hostname: {$this->api->baseUrl}");
            $this->logFile->info("[{$requestId}] HTTP Request Endpoint: {$this->endpoint}{$url}{$this->queryParams}");
            $this->logFile->info("[{$requestId}] HTTP Request Headers: {$logHeaders}");
            $this->logFile->info("[{$requestId}] HTTP Method: {$method}");
            $this->logFile->info("[{$requestId}] HTTP Request Body: {$logBody}");
        }

        try {
            $httpResponse = $httpRequest->request(
              $method,
              "{$this->api->baseUrl}{$this->endpoint}{$url}{$this->queryParams}",
              array(
                'headers' => $this->headers,
                'json'    => $body
              )
          );

            $httpResponse = json_decode($httpResponse->getBody()->getContents(), true);
        } catch (ClientException $e) {
            $httpResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
        } catch (RequestException $e) {
            $httpResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        if ($this->api->config['logging_enabled']) {
            $logBody = json_encode($httpResponse);

            $this->logFile->info("[{$requestId}] HTTP Response Body: {$logBody}");
        }

        return $httpResponse;
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
        $response = $this->createRequest('GET', "/{$id}");

        $this->queryParams = '?';

        $this->resource = new JSONObject($response, $this);

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
    public function get()
    {
        $response = $this->createRequest('GET', "");

        $this->queryParams = '?';

        $this->resource = new JSONObject($response, $this);

        return $this->resource;
    }

    /**
     * Create new instance of object
     *
     * @return JSONObject
     *
     */
    public function instantiate()
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
        $response = $this->createRequest('POST', "", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response, $this);

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
        $id = isset($this->resource->resource['data']['id']) ? $this->resource->resource['data']['id'] : $this->resource->resource['id'];

        $response = $this->createRequest('PUT', "/{$id}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response, $this);

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
        $id = isset($this->resource->resource['data']['id']) ? $this->resource->resource['data']['id'] : $this->resource->resource['id'];

        $response = $this->createRequest('DELETE', "/{$id}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response, $this);

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
        $id = isset($this->resource->resource['data']['id']) ? $this->resource->resource['data']['id'] : $this->resource->resource['id'];

        $response = $this->createRequest('PATCH', "/{$id}", $this->resource->resource);

        $this->queryParams = '?';

        $this->resource = new JSONObject($response, $this);

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
