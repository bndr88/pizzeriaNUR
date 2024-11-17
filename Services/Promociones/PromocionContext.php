<?php

namespace Services\Promociones;

use Services\Promociones\PromocionInterface;
use Services\Promociones\PromocionDosPorUno;
use Services\Promociones\PromocionEnvioGratis;

class PromocionContext {
    private ?PromocionInterface $promocionActual = null;

    public function setPromocionPorDia(string $diaSemana): void {
        switch (strtolower($diaSemana)) {
            case 'mar': 
            case 'mie': 
                $this->promocionActual = new PromocionDosPorUno();
                break;
            case 'jue': 
                $this->promocionActual = new PromocionEnvioGratis();
                break;
            default:
                $this->promocionActual = null; // Sin promoción
                break;
        }
    }

    public function aplicarPromocion(string $tipoPizza, int $cantidad, float $subtotal): float {
        if ($this->promocionActual) {
            return $this->promocionActual->aplicar($tipoPizza, $cantidad, $subtotal);
        }
        return $subtotal; // Sin cambios si no hay promoción
    }

    public function aplicarPromocionDelivery(float $costoDelivery): float {
        if ($this->promocionActual) {
            return $this->promocionActual->aplicarDelivery($costoDelivery);
        }
        return $costoDelivery; // Sin cambios si no hay promoción
    }

    public function getNombrePromocion(): ?string {
        return $this->promocionActual ? $this->promocionActual->getNombre() : null;
    }
}
