<?php

require_once __DIR__ . '/controllers/ServicioController.php';

echo "=== Test de ServicioController ===\n\n";

try {
    $controller = new ServicioController();
    $servicios = $controller->getAll();
    
    echo "Total de servicios encontrados: " . count($servicios) . "\n\n";
    
    foreach ($servicios as $servicio) {
        echo "ID: " . $servicio->getId() . "\n";
        echo "Nombre: " . $servicio->getNombre() . "\n";
        echo "Descripción: " . $servicio->getDescripcion() . "\n";
        echo "Precio: $" . number_format($servicio->getPrecioEstimado(), 2) . "\n";
        echo "---\n";
    }
    
    echo "\n✅ Test completado exitosamente!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
