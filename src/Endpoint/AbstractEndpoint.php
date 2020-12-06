<?php

namespace dhope0000\Snap\Endpoint;

use dhope0000\Snap\Client;
use dhope0000\Snap\HttpClient\Message\ResponseMediator;

abstract class AbstractEndpoint
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    abstract protected function getEndpoint();

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     GET parameters.
     * @param array  $requestHeaders Request Headers.
     *
     * @return array|string
     */
    protected function get($path, array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->get(
            $this->buildPath($path, $parameters)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a POST request with JSON-encoded data.
     *
     * @param string        $path           Request path.
     * @param array|string  $data           POST data to be JSON encoded.
     * @param array         $parameters     POST parameters.
     * @param array         $requestHeaders Request headers.
     */
    protected function post($path, $data = [], array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->post(
            $this->buildPath($path, $parameters),
            $this->createJsonBody($data)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded data.
     *
     * @param string        $path           Request path.
     * @param array|string  $data           POST data to be JSON encoded.
     * @param array         $parameters     POST parameters.
     * @param array         $requestHeaders Request headers.
     */
    protected function put($path, $data = [], array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->put(
            $this->buildPath($path, $parameters),
            $this->createJsonBody($data)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PATCH request with JSON-encoded data.
     *
     * @param string        $path           Request path.
     * @param array|string  $data           POST data to be JSON encoded.
     * @param array         $parameters     POST parameters.
     * @param array         $requestHeaders Request headers.
     */
    protected function patch($path, $data = [], array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->patch(
            $this->buildPath($path, $parameters),
            $this->createJsonBody($data)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with query parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     GET parameters.
     * @param array  $requestHeaders Request Headers.
     *
     * @return array|string
     */
    protected function delete($path, array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->delete(
            $this->buildPath($path, $parameters)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Create a JSON encoded version of an array.
     *
     * @param array|string $data Request data
     *
     * @return null|string
     */
    protected function createJsonBody($data)
    {
        if (is_array($data)) {
            return (count($data) === 0) ? null : json_encode($data, empty($data) ? JSON_FORCE_OBJECT : 0);
        } else {
            return $data;
        }
    }

    /**
     * Build URI with query parameters.
     *
     * @param string $path Request path.
     * @param array  $data Request data.
     *
     * @return string
     */
    protected function buildPath($path, array $parameters)
    {
        if (count($parameters) > 0) {
            $path .= '?'.http_build_query($parameters);
        }

        return $path;
    }
}
