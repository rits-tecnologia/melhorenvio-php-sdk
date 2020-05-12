# Melhor Envio PHP SDK

This package provides PHP SDK to the Melhor Envio API (https://docs.menv.io).

## Installation

Install this package with composer.

```sh
composer require rits-tecnologia/melhorenvio-php-sdk
```

## Usage

```php
$melhorenvio = new MelhorEnvio(env('MELHORENVIO_TOKEN'));

// repositories
$melhorenvio->shipments();
$melhorenvio->carriers();
```

### Examples

```php
$response = $melhorenvio->shipments()->calculate([
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
```
