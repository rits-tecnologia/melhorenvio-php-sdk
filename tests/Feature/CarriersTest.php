<?php

namespace MelhorEnvio\Tests\Feature;

use MelhorEnvio\Tests\TestCase;

class CarriersTest extends TestCase
{
    public function testCompanies()
    {
        $response = $this->melhorenvio->carriers()
            ->allCompanies();

        $this->assertIsArray($response);
        $this->assertTrue(count($response) > 0);

        $response = $this->melhorenvio->carriers()
            ->findCompany(1);

        $this->assertIsArray($response);
        $this->assertEquals($response[0]['id'] ?? null, 1);
    }

    public function testServices()
    {
        $response = $this->melhorenvio->carriers()
            ->allServices();

        $this->assertIsArray($response);
        $this->assertTrue(count($response) > 0);

        $response = $this->melhorenvio->carriers()
            ->findService(1);

        $this->assertIsArray($response);
        $this->assertEquals($response['id'] ?? null, 1);
    }

    public function testAgencies()
    {
        $response = $this->melhorenvio->carriers()
            ->allAgencies([
                'city' => 'Natal'
            ]);

        $this->assertIsArray($response);
        $this->assertTrue(count($response) > 0);

        $response = $this->melhorenvio->carriers()
            ->findAgency(1);

        $this->assertIsArray($response);
        $this->assertEquals($response['id'] ?? null, 1);
    }
}