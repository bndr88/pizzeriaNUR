<?php

namespace Services\Pizzas\Preestablecidas;

use Models\Pizza;
use Services\Pizzas\PizzaFactory;

class PeperoniFactory extends PizzaFactory {
    public function crearPizza(array $ingredientes = [], float $precio = 0): Pizza {
        $pizza = new Pizza('Peperoni',['Peperoni', 'Queso'],55.0);
        return $pizza;
    }
}
