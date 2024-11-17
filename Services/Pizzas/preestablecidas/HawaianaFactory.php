<?php
namespace Services\Pizzas\Preestablecidas;

use Models\Pizza;
use Services\Pizzas\PizzaFactory;


class HawaianaFactory extends PizzaFactory {
    public function crearPizza(array $ingredientes = [], float $precio = 0): Pizza {
        $pizza = new Pizza('Hawaiana',['Piña', 'Jamón', 'Queso'],60.0);
        return $pizza;
    }
}



