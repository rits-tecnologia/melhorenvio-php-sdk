<?php

namespace MelhorEnvio\API;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    const ENVIRONMENT_PRODUCTION = 'production';
    const ENVIRONMENT_SANDBOX = 'sandbox';

    const API_ENDPOINT_PRODUCTION = 'https://melhorenvio.com.br/api/v2/';
    const API_ENDPOINT_SANDBOX = 'https://sandbox.melhorenvio.com.br/api/v2/';

    private $client;
    private $environment;
    private $token;

    public function __construct(string $token, $environment = 'sandbox')
    {
        $this->token = $token;
        $this->environment = $environment;
        $this->client = new GuzzleClient([
            'base_uri' => $environment == self::ENVIRONMENT_SANDBOX ? self::API_ENDPOINT_SANDBOX : self::API_ENDPOINT_PRODUCTION,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function __call($method, $args)
    {
        if (count($args) < 1) {
            throw new \InvalidArgumentException(
                'Magic request methods require a URI and optional options array'
            );
        }

        $uri = $args[0];

        $options = $args[1] ?? [];

        return $this->request($method, $uri, $options);
    }

    public function request($method, $uri, $options)
    {
        $method = strtoupper($method);

        $response = $this->client->request($method, $uri, $options);

        $jsonResponse = json_decode($response->getBody(), true);
        if (empty($jsonResponse)) {
            return [];
        }

        return $jsonResponse;
    }
}
