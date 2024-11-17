<?php

spl_autoload_register(function ($class) {
    // Convertir el namespace en la ruta del archivo
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    // Verificar si el archivo existe
    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception("No se pudo cargar la clase: $class. Archivo no encontrado: $file");
    }
});
