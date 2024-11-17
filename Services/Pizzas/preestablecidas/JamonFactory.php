<?php

namespace Services\Pizzas\Preestablecidas;

use Models\Pizza;
use Services\Pizzas\PizzaFactory;

class JamonFactory extends PizzaFactory {
    public function crearPizza(array $ingredientes = [], float $precio = 0): Pizza {
        $pizza = new Pizza('Jamón',['Jamón', 'Queso'],50.0);
        return $pizza;
    }
}
