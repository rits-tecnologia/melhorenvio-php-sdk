<?php

namespace MelhorEnvio\Tests\Feature;

use MelhorEnvio\Tests\TestCase;

class ShipmentsTest extends TestCase
{
    public function testCalculateProducts()
    {
        $response = $this->melhorenvio->shipments()
            ->calculate([
                'from' => [
                    'postal_code' => '59082000',
                ],
                'to' => [
                    'postal_code' => '59148485',
                ],
                'options' => [
                    'receipt' => false,
                    'own_hand' => false,
                ],
                'services' => '1,2',
                'products' => [
                    [
                        'id' => 'x',
                        'width' => 11,
                        'height' => 17,
                        'length' => 11,
                        'weight' => 0.3,
                        'insurance_value' => 10.1,
                        'quantity' => 1,
                    ],
                    [
                        'id' => 'x',
                        'width' => 20,
                        'height' => 10,
                        'length' => 11,
                        'weight' => 0.5,
                        'insurance_value' => 20.1,
                        'quantity' => 2,
                    ],
                ],
            ]);

        $this->assertIsArray($response);
        $this->assertTrue(count($response) > 0);
    }

    public function testCalculatePackage()
    {
        $response = $this->melhorenvio->shipments()
            ->calculate([
                'from' => [
                    'postal_code' => '59082000',
                ],
                'to' => [
                    'postal_code' => '59148485',
                ],
                'options' => [
                    'insurance_value' => 1000.00,
                    'receipt' => false,
                    'own_hand' => false,
                ],
                'services' => '1,2,3,4,5',
                'package' => [
                    'height' => 12,
                    'width' => 10,
                    'length' => 10,
                    'weight' => 0.5,
                ],
            ]);

        $this->assertIsArray($response);
        $this->assertTrue(count($response) > 0);
    }

    public function testAddAndDeleteToCart()
    {
        $response = $this->melhorenvio->shipments()
            ->addCartItem([
                'service' => 3,
                'agency' => 100,
                'from' => [
                    'name' => 'Nome do remetente',
                    'phone' => '53984470102',
                    'email' => 'contato@melhorenvio.com.br',
                    'document' => '16571478358',
                    'company_document' => '89794131000100',
                    'state_register' => '123456',
                    'address' => 'Endereço do remetente',
                    'complement' => 'Complemento',
                    'number' => '1',
                    'district' => 'Bairro',
                    'city' => 'São Paulo',
                    'country_id' => 'BR',
                    'postal_code' => '01002001',
                    'note' => 'observação',
                ],
                'to' => [
                    'name' => 'Nome do destinatário',
                    'phone' => '53984470102',
                    'email' => 'contato@melhorenvio.com.br',
                    'document' => '25404918047',
                    'company_document' => '89794131000101',
                    'state_register' => '123456',
                    'address' => 'Endereço do destinatário',
                    'complement' => 'Complemento',
                    'number' => '2',
                    'district' => 'Bairro',
                    'city' => 'Porto Alegre',
                    'state_abbr' => 'RS',
                    'country_id' => 'BR',
                    'postal_code' => '90570020',
                    'note' => 'observação',
                ],
                'products' => [
                    [
                        'name' => 'Papel adesivo para etiquetas 1',
                        'quantity' => 3,
                        'unitary_value' => 1000,
                    ],
                    [
                        'name' => 'Papel adesivo para etiquetas 2',
                        'quantity' => 1,
                        'unitary_value' => 1000,
                    ],
                ],
                'volumes' => [
                    [
                        'height' => 43,
                        'width' => 60,
                        'length' => 70,
                        'weight' => 30,
                    ],
                    [
                        'height' => 30,
                        'width' => 40,
                        'length' => 50,
                        'weight' => 10,
                    ],
                ],
                'options' => [
                    'insurance_value' => 4000,
                    'receipt' => false,
                    'own_hand' => false,
                    'reverse' => false,
                    'non_commercial' => false,
                    'invoice' => [
                        'key' => '31190307586261000184550010000092481404848162',
                    ],
                ],
            ]);

        $id = $response['id'] ?? null;

        $this->assertIsArray($response);
        $this->assertNotNull($id);

        $response = $this->melhorenvio->shipments()->getCart();

        $this->assertIsArray($response);

        $response = $this->melhorenvio->shipments()->getCartItem($id);

        $id = $response['id'] ?? null;

        $this->assertIsArray($response);
        $this->assertNotNull($id);

        $response = $this->melhorenvio->shipments()->deleteCartItem($id);

        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function testCheckoutCartAndPrintLabels()
    {
        $response = $this->melhorenvio->shipments()
            ->addCartItem([
                'service' => 3,
                'agency' => 100,
                'from' => [
                    'name' => 'Nome do remetente',
                    'phone' => '53984470102',
                    'email' => 'contato@melhorenvio.com.br',
                    'document' => '16571478358',
                    'company_document' => '89794131000100',
                    'state_register' => '123456',
                    'address' => 'Endereço do remetente',
                    'complement' => 'Complemento',
                    'number' => '1',
                    'district' => 'Bairro',
                    'city' => 'São Paulo',
                    'country_id' => 'BR',
                    'postal_code' => '01002001',
                    'note' => 'observação',
                ],
                'to' => [
                    'name' => 'Nome do destinatário',
                    'phone' => '53984470102',
                    'email' => 'contato@melhorenvio.com.br',
                    'document' => '25404918047',
                    'company_document' => '89794131000101',
                    'state_register' => '123456',
                    'address' => 'Endereço do destinatário',
                    'complement' => 'Complemento',
                    'number' => '2',
                    'district' => 'Bairro',
                    'city' => 'Porto Alegre',
                    'state_abbr' => 'RS',
                    'country_id' => 'BR',
                    'postal_code' => '90570020',
                    'note' => 'observação',
                ],
                'products' => [
                    [
                        'name' => 'Papel adesivo para etiquetas 1',
                        'quantity' => 3,
                        'unitary_value' => 1000,
                    ],
                    [
                        'name' => 'Papel adesivo para etiquetas 2',
                        'quantity' => 1,
                        'unitary_value' => 1000,
                    ],
                ],
                'volumes' => [
                    [
                        'height' => 43,
                        'width' => 60,
                        'length' => 70,
                        'weight' => 30,
                    ],
                    [
                        'height' => 30,
                        'width' => 40,
                        'length' => 50,
                        'weight' => 10,
                    ],
                ],
                'options' => [
                    'insurance_value' => 4000,
                    'receipt' => false,
                    'own_hand' => false,
                    'reverse' => false,
                    'non_commercial' => false,
                    'invoice' => [
                        'key' => '31190307586261000184550010000092481404848162',
                    ],
                ],
            ]);

        $id = $response['id'] ?? null;

        $this->assertIsArray($response);
        $this->assertNotNull($id);

        $response = $this->melhorenvio->shipments()->checkoutCart([
            'orders' => [
                $id
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertNotNull($response['purchase'] ?? null);

        $response = $this->melhorenvio->shipments()->previewLabel([
            'orders' => [
                $id
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertNotNull($response['url'] ?? null);

        $response = $this->melhorenvio->shipments()->generateLabel([
            'orders' => [
                $id
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertNotNull($response[$id] ?? null);

        $response = $this->melhorenvio->shipments()->printLabel([
            'orders' => [
                $id
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertNotNull($response['url'] ?? null);

        $response = $this->melhorenvio->shipments()->allLabels();

        $this->assertIsArray($response);
        $this->assertNotNull($response['data'] ?? null);

        $response = $this->melhorenvio->shipments()->tracking([
            'orders' => [
                $id
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertNotNull($response[$id] ?? null);
        $this->assertNotNull($response[$id]['status'] ?? null);

        $response = $this->melhorenvio->shipments()->canCancelLabel([
            'orders' => [
                $id
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertNotNull($response[$id] ?? null);

        $response = $this->melhorenvio->shipments()->cancelLabel([
            'orders' => [
                $id
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }
}