<?php

namespace Models;

class Orden {
    private array $detalles;
    private float $total;
   // private bool $deliveryGratis;

    public function __construct(array $detalles, float $total/*, bool $deliveryGratis*/) {
        $this->detalles = $detalles;
        $this->total = $total;
        //$this->deliveryGratis = $deliveryGratis;
    }

    public function getDetalles(): array {
        return $this->detalles;
    }

    public function getTotal(): float {
        return $this->total;
    }

    /*public function isDeliveryGratis(): bool {
        return $this->deliveryGratis;
    }*/
}
