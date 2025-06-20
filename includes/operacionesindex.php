<?php  
include 'conexion.php';

// Total de productos
$totalProductos = $conn->query("SELECT COUNT(*) FROM productos")->fetch_row()[0];

// Valor total del inventario
$valorTotal = $conn->query("SELECT SUM(precio_producto * stock) FROM productos")->fetch_row()[0];

// Stock bajo (por ejemplo <= 5)
$stockBajo = $conn->query("SELECT COUNT(*) FROM productos WHERE stock <= 5 AND stock > 0")->fetch_row()[0];

// Sin stock
$sinStock = $conn->query("SELECT COUNT(*) FROM productos WHERE stock = 0")->fetch_row()[0];

// Total facturas
$totalFacturas = $conn->query("SELECT COUNT(*) FROM facturas")->fetch_row()[0];

// Facturas pagadas
$facturasPagadas = $conn->query("SELECT COUNT(*) FROM detalle_factura WHERE estado_factura = 'pagada'")->fetch_row()[0];

// Facturas pendientes
$facturasPendientes = $conn->query("SELECT COUNT(*) FROM detalle_factura WHERE estado_factura = 'pendiente'")->fetch_row()[0];

// Ingresos del mes actual
$ingresosMes = $conn->query("SELECT SUM(total) FROM detalle_factura WHERE MONTH(CURDATE()) = MONTH(NOW())")->fetch_row()[0];
?>