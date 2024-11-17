<?php

namespace Services\Pizzas;

use Services\Pizzas\Preestablecidas\HawaianaFactory;
use Services\Pizzas\Preestablecidas\JamonFactory;
use Services\Pizzas\Preestablecidas\PeperoniFactory;
//use Services\Pizzas\Pizza;
use Models\Pizza;

abstract class PizzaFactory {
    /**
     * Método abstracto para crear una pizza.
     */
    abstract public function crearPizza(array $ingredientes, float $precio): Pizza;

    /**
     * Método para obtener el menú de pizzas preestablecidas.
     *
     * @return array
     */
    public static function obtenerMenuPreestablecido(): array {
        // Crear instancias de las fábricas de pizzas preestablecidas
        $hawaiana = (new HawaianaFactory())->crearPizza();
        $jamon = (new JamonFactory())->crearPizza();
        $peperoni = (new PeperoniFactory())->crearPizza();

        // Retornar el menú como un array
        return [
            [
                'nombre' => $hawaiana->getNombre(),
                'ingredientes' => $hawaiana->getIngredientes(),
                'precio' => $hawaiana->getPrecio()
            ],
            [
                'nombre' => $jamon->getNombre(),
                'ingredientes' => $jamon->getIngredientes(),
                'precio' => $jamon->getPrecio()
            ],
            [
                'nombre' => $peperoni->getNombre(),
                'ingredientes' => $peperoni->getIngredientes(),
                'precio' => $peperoni->getPrecio()
            ],
        ];
    }

    /**
     * Método para crear una fábrica según el tipo de pizza.
     *
     * @param string $tipo Tipo de pizza solicitado.
     * @return PizzaFactoryMethod Fábrica correspondiente al tipo de pizza.
     * @throws \Exception Si el tipo de pizza no es válido.
     */
    public static function crearFabrica(string $tipo, array $ingredientes = [], float $precio = 0): PizzaFactory {
        switch (strtolower($tipo)) {
            case 'hawaiana':
                return new HawaianaFactory();
            case 'jamón':
                return new JamonFactory();
            case 'peperoni':
                return new PeperoniFactory();
            case 'personalizada':
                return new PersonalizadaFactory($ingredientes, $precio);
            default:
                throw new \Exception("El tipo de pizza '$tipo' no es válido.");
        }
    }
}

