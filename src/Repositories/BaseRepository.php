<?php

namespace MelhorEnvio\Repositories;

use MelhorEnvio\API\Client;

class BaseRepository
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}