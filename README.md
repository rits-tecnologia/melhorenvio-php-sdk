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

```
