<?php

namespace Services\Promociones;

class PromocionEnvioGratis implements PromocionInterface {
    public function aplicar(string $tipoPizza, int $cantidad, float $subtotal): float {
        return $subtotal; // Sin cambios en el subtotal de las pizzas
    }

    public function getNombre(): string {
        return "Delivery Gratis";
    }

    public function aplicarDelivery(float $costoDelivery): float {
        return 0; // Delivery gratis
    }
}


