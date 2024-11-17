<?php

namespace Controllers;

use Models\Orden;
use Services\Pizzas\PizzaFactory;
use Services\Promociones\PromocionContext;

class OrdenController {
    public function registrarOrden(array $detallesDePizzas, string $dia): Orden {
        $detalles = [];
        $subtotal = 0;
        $total =0;

        foreach ($detallesDePizzas as $detalle) {
            $tipo = $detalle['tipo'];
            $cantidad = $detalle['cantidad'] ?? 1;
            $ingredientes = $detalle['ingredientes'] ?? [];
            $precio = $detalle['precio'] ?? 50.0; // Precio predeterminado para pizzas personalizadas.

            $factory = PizzaFactory::crearFabrica($tipo,$ingredientes,$precio );

            $pizza = $factory->crearPizza();
            if (!$pizza) {
                throw new \Exception("El tipo de pizza '{$tipo}' no es válido.");
            }

            if ($tipo == 'personalizada') {
                $detalles[] = [
                    'pizza' => $pizza,
                    'cantidad' => $cantidad,
                    'ingredientes' => $ingredientes,
                    'precio' => $precio
                ];                
            }else {
                $detalles[] = [
                    'pizza' => $pizza,
                    'cantidad' => $cantidad
                ];
            }

            $subtotal += $pizza->getPrecio() * $cantidad;
        }

        // Aplicar promociones
        $promocionContext = new PromocionContext();
        $promocionContext->setPromocionPorDia($dia); //toma la fecha del servidor y verifica si aplica o no una promoción
        $subtotalConPromocion = $promocionContext->aplicarPromocion($tipo, $cantidad, $subtotal);

        $costoDelivery = 10;
        $costoDeliveryConPromocion = $promocionContext->aplicarPromocionDelivery($costoDelivery);
        
        $total = $total + $subtotalConPromocion + $costoDeliveryConPromocion;

        $ordenProcesada = new Orden($detalles, $total);
        // Guardar la orden (simulado)
        $this->guardarOrden($ordenProcesada);

        return $ordenProcesada;
    }

    private function guardarOrden(Orden $orden): void {
        // Simulación de almacenamiento en un archivo
        $orden = [
            'pizzas' => array_map(function($detalle) {
                $data = [
                    'nombre' => $detalle['pizza']->getNombre(),
                    'cantidad' => $detalle['cantidad'],
                ];

                // Solo agregar 'ingredientes' si hay datos en $detalle['ingredientes']
                if (!empty($detalle['ingredientes'])) {
                    $data['ingredientes'] = $detalle['ingredientes'];
                }

                return $data;
            }, $orden->getDetalles()),
            'total' => $orden->getTotal(),
            //'deliveryGratis' => $orden->isDeliveryGratis(),
        ];

        $archivo = __DIR__ . '/../storage/ordenes.json';
        $ordenes = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
        $ordenes[] = $orden;
        file_put_contents($archivo, json_encode($ordenes, JSON_PRETTY_PRINT));
    }
}
