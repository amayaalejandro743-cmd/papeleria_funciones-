<?php
// Integrante: Alejandro Alberto Amaya Gutierrez 

function calcularSubtotal($precio, $cantidad) {
    return $precio * $cantidad;
}

function contarUnidades($productos) {
    $total = 0;
    foreach ($productos as $producto) {
        $total += $producto["stock"];
    }
    return $total;
}

function calcularValorInventario($productos) {
    $valorTotal = 0;
    foreach ($productos as $producto) {
        $valorTotal += $producto["precio"] * $producto["stock"];
    }
    return $valorTotal;
}

function buscarProducto($productos, $codigo) {
    if (isset($productos[$codigo])) {
        return $productos[$codigo];
    }
    return null;
}

$productos = [
    101 => ["nombre" => "Lápiz",    "precio" => 1500, "stock" => 10],
    102 => ["nombre" => "Cuaderno", "precio" => 8000, "stock" => 6],
    103 => ["nombre" => "Borrador", "precio" => 1000, "stock" => 8],
    104 => ["nombre" => "Marcador", "precio" => 3500, "stock" => 4],
    105 => ["nombre" => "Regla",    "precio" => 2500, "stock" => 5]
];

do {
    echo "\n--- PAPELERÍA ADSO ---\n";
    echo "1. Buscar producto y calcular subtotal\n";
    echo "2. Ver resumen del inventario\n";
    echo "3. Probar inventario vacío\n";
    echo "4. Salir\n";

    $opcion = readline("Elige una opción: ");

    if ($opcion == "1") {
        foreach ($productos as $codigo => $producto) {
            echo "Código: $codigo | Producto: " . $producto["nombre"] . " | Precio: $" . $producto["precio"] . " | Stock: " . $producto["stock"] . "\n";
        }
        $codigo = (int) readline("Ingresa el código del producto: ");
        $encontrado = buscarProducto($productos, $codigo);

        if ($encontrado !== null) {
            echo "Producto: " . $encontrado["nombre"] . " | Precio: $" . $encontrado["precio"] . " | Stock: " . $encontrado["stock"] . "\n";
            // si lo busco lo compro
            $cantidad = (int) readline("Ingresa la cantidad: ");
            $subtotal = calcularSubtotal($encontrado["precio"], $cantidad);
            echo "Subtotal: $" . $subtotal . "\n";
        } else {
            echo "Producto no encontrado\n";
        }
    } elseif ($opcion == "2") {
        echo "Unidades totales: " . contarUnidades($productos) . "\n";
        echo "Valor del inventario: $" . calcularValorInventario($productos) . "\n";
    } elseif ($opcion == "3") {
        echo "Unidades (vacío): " . contarUnidades([]) . "\n";
        echo "Valor del inventario (vacío): $" . calcularValorInventario([]) . "\n";
    } elseif ($opcion != "4") {
        echo "Opción no válida\n";
    }

} while ($opcion != "4");