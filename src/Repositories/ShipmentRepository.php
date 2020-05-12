<?php

namespace MelhorEnvio\Repositories;

class ShipmentRepository extends BaseRepository
{
    public function calculate(array $params): ?array
    {
        return $this->client->post('me/shipment/calculate', [
            'json' => $params
        ]);
    }

    public function getCart(): ?array
    {
        return $this->client->get('me/cart');
    }

    public function addCartItem(array $params): ?array
    {
        return $this->client->post('me/cart', [
            'json' => $params
        ]);
    }

    public function getCartItem(string $id): ?array
    {
        return $this->client->get("me/cart/$id");
    }

    public function deleteCartItem(string $id): ?array
    {
        return $this->client->delete("me/cart/$id");
    }

    public function checkoutCart(array $params)
    {
        return $this->client->post('me/shipment/checkout', [
            'json' => $params
        ]);
    }

    public function previewLabel(array $params)
    {
        return $this->client->post('me/shipment/preview', [
            'json' => $params
        ]);
    }

    public function generateLabel(array $params)
    {
        return $this->client->post('me/shipment/generate', [
            'json' => $params
        ]);
    }

    public function printLabel(array $params)
    {
        return $this->client->post('me/shipment/print', [
            'json' => $params
        ]);
    }

    public function allLabels(string $q = '')
    {
        return $this->client->get('me/orders', [
            'query' => [
                'q' => $q
            ]
        ]);
    }

    public function canCancelLabel(array $params)
    {
        return $this->client->get('me/shipment/cancellable', [
            'json' => $params
        ]);
    }

    public function cancelLabel(array $params)
    {
        return $this->client->post('me/shipment/cancel', [
            'json' => $params
        ]);
    }

    public function tracking(array $params)
    {
        return $this->client->post('me/shipment/tracking', [
            'json' => $params
        ]);
    }

}