<?php
include 'conexion.php';

if (!isset($_GET['id'])) {
    die("ID de factura no proporcionado.");
}

$idfactura = intval($_GET['id']);

// Obtener datos de la factura
$sql = "SELECT f.idfactura, f.fecha_factura, c.nombre_cliente, c.cedula_cliente
        FROM facturas f
        JOIN clientes c ON f.idcliente = c.idcliente
        WHERE f.idfactura = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idfactura);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Factura no encontrada.");
}

$factura = $result->fetch_assoc();

// Obtener productos
$sql_detalles = "SELECT df.cantidad, df.precio_unitario, df.total, p.nombre_producto
                 FROM detalle_factura df
                 JOIN productos p ON df.id_productos = p.id_productos
                 WHERE df.idfactura = ?";
$stmt2 = $conn->prepare($sql_detalles);
$stmt2->bind_param("i", $idfactura);
$stmt2->execute();
$productos = $stmt2->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #<?= $idfactura ?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Factura #<?= $idfactura ?></h2>
    <p><strong>Cliente:</strong> <?= $factura['nombre_cliente'] ?> - <?= $factura['cedula_cliente'] ?></p>
    
    <p><strong>Fecha:</strong> <?= $factura['fecha_factura'] ?></p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $total_general = 0;
        while ($row = $productos->fetch_assoc()):
            $total_general += $row['total'];
        ?>
            <tr>
                <td><?= $row['nombre_producto'] ?></td>
                <td><?= $row['cantidad'] ?></td>
                <td>$<?= number_format($row['precio_unitario'], 2) ?></td>
                <td>$<?= number_format($row['total'], 2) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <h4 class="text-end">Total Factura: $<?= number_format($total_general, 2) ?></h4>
    <a href="todas_facturas.php" class="btn btn-primary">Ver todas las facturas</a>
    <a href="todas_facturas.php" class="btn btn-secondary">Volver</a>
</body>
</html>
