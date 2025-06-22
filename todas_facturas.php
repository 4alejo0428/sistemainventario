<?php
include 'conexion.php';

$sql = "SELECT f.idfactura, f.fecha_factura, c.nombre_cliente
        FROM facturas f
        JOIN clientes c ON f.idcliente = c.idcliente
        ORDER BY f.idfactura DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Todas las Facturas</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Listado de Facturas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['idfactura'] ?></td>
                <td><?= $row['fecha_factura'] ?></td>
                <td><?= $row['nombre_cliente'] ?></td>
                <td>
                    <a href="ver_factura.php?id=<?= $row['idfactura'] ?>" class="btn btn-sm btn-outline-primary">
                        Ver Detalles
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
