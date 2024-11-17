<?php

namespace Controllers;

use Services\Pizzas\PizzaFactoryMethod;

class MenuController {
    /**
     * Obtiene el menú de pizzas preestablecidas.
     *
     * @return array
     */
    public function obtenerMenu(): array {
        return PizzaFactoryMethod::obtenerMenuPreestablecido();
    }
}

