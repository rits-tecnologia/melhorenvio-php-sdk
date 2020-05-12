<?php

namespace MelhorEnvio;

use MelhorEnvio\API\Client;
use MelhorEnvio\Repositories\CarrierRepository;
use MelhorEnvio\Repositories\ShipmentRepository;

class MelhorEnvio {

    /**
     * @var Client
     */
    protected $client;

    public function __construct(string $token)
    {
        $this->client = new Client($token);
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function shipments(): ShipmentRepository
    {
        return new ShipmentRepository($this->client);
    }

    public function carriers(): CarrierRepository
    {
        return new CarrierRepository($this->client);
    }
}