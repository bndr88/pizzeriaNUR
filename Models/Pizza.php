<?php

namespace Models;

use Services\Pizzas\PizzaInterface;

class Pizza implements PizzaInterface {
    protected string $nombre;
    protected array $ingredientes;
    protected float $precio;

    public function __construct(String $tipo, array $ingredientes = [], float $precio =0) {
        $this->nombre = $tipo;
        $this->ingredientes = $ingredientes;
        $this->precio = $precio;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getIngredientes(): array {
        return $this->ingredientes;
    }

    public function getPrecio(): float {
        return $this->precio;
    }
}
