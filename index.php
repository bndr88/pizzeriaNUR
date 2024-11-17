<?php

require_once __DIR__ . '/autoload.php';

use Controllers\OrdenController;
use Services\Pizzas\PizzaFactory;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/orden') {
    $data = json_decode(file_get_contents('php://input'), true);

    $ordenController = new OrdenController();
    try {
        $orden = $ordenController->registrarOrden($data['pizzas'],$data['dia']);
        $response = [
            'pizzas' => array_map(function($detalle) {
                $data = [
                    'nombre' => $detalle['pizza']->getNombre(),
                    'cantidad' => $detalle['cantidad']
                ];
                if (!empty($detalle['ingredientes'])) {
                    $data['ingredientes'] = $detalle['ingredientes'];
                }

                if (!empty($detalle['precio'])) {
                    $data['precio'] = $detalle['precio'];
                }

                return $data;
            }, $orden->getDetalles()),
            'total' => $orden->getTotal(),
        ];

        echo json_encode($response);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(['error' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/menu') {
    try {
        // Obtener el menú de pizzas preestablecidas.
        $menu = PizzaFactory::obtenerMenuPreestablecido();
        $response = [
            'menu' => array_map(fn($pizza) => [
                'nombre' => $pizza['nombre'],
                'ingredientes' => $pizza['ingredientes'],
                'precio' => $pizza['precio']
            ], $menu)
        ];
        echo json_encode($response);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Ruta no encontrada']);
}
