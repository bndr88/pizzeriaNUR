<?php

namespace Services\Promociones;

class PromocionDosPorUno implements PromocionInterface {
    public function aplicar(string $tipoPizza, int $cantidad, float $subtotal): float {
        $pares = intdiv($cantidad, 2); // Pizzas gratis por 2x1
        $pagadas = $cantidad - $pares;
        return $pagadas * ($subtotal / $cantidad);
    }

    public function getNombre(): string {
        return "2x1 en Pizzas";
    }

    public function aplicarDelivery(float $costoDelivery): float {
        return $costoDelivery; // Sin cambios en el delivery
    }
}


