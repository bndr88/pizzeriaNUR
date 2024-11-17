<?php

namespace Services\Pizzas;

use Models\Pizza;
use Services\Pizzas\PizzaFactory;

class PersonalizadaFactory extends PizzaFactory {
    public function crearPizza(array $ingredientes = [], float $precio ): Pizza {
        $pizza = new Pizza('Personalizada',$ingredientes ,50.0);
        return $pizza;
    }
}

