<?php

namespace Services\Pizzas;

interface PizzaInterface {
    public function getNombre(): string;
    public function getIngredientes(): array;
    public function getPrecio(): float;
}
