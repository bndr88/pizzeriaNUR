<?php

namespace Services\Promociones;

interface PromocionInterface {
    public function aplicar(string $tipoPizza, int $cantidad, float $subtotal): float;
    public function getNombre(): string;

    /**
     * Método opcional para aplicar promociones relacionadas con el delivery.
     * Por defecto, devuelve el costo original del delivery.
     *
     * @param float $costoDelivery Costo inicial del delivery.
     * @return float Costo ajustado del delivery.
     */
    public function aplicarDelivery(float $costoDelivery): float;
}

