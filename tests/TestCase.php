<?php

namespace MelhorEnvio\Tests;

use MelhorEnvio\MelhorEnvio;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Symfony\Component\Dotenv\Dotenv;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var MelhorEnvio
     */
    protected $melhorenvio;

    public function setUp(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../.env');

        $this->melhorenvio = new MelhorEnvio($_ENV['MELHORENVIO_TOKEN']);
    }
}
