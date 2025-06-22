<?php
// guardar_factura.php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['customer_name'];
    $apellido = '';
    $cedula = $_POST['customer_phone'] ?? 'N/A';
    $direccion = $_POST['customer_address'] ?? '';
    $iva = $_POST['iva'];

    // 1. Insertar cliente
    $sql_cliente = "INSERT INTO clientes (nombre_cliente, apellido_cliente, cedula_cliente, direccion_cliente) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_cliente);
    $stmt->bind_param("ssss", $nombre, $apellido, $cedula, $direccion);
    $stmt->execute();
    $idcliente = $stmt->insert_id;

    // 2. Insertar factura
    $fecha = date('Y-m-d');
    $id_usuario = 1;
    $sql_factura = "INSERT INTO facturas (fecha_factura, id_usuario, idcliente) VALUES (?, ?, ?)";
    $stmt2 = $conn->prepare($sql_factura);
    $stmt2->bind_param("sii", $fecha, $id_usuario, $idcliente);
    $stmt2->execute();
    $idfactura = $stmt2->insert_id;

    // 3. Insertar múltiples productos en detalle_factura
    $productos = $_POST['productos'];
    $cantidades = $_POST['cantidades'];
    $precios = $_POST['precios'];
    $total = $_POST['total'];

    $sql_detalle = "INSERT INTO detalle_factura (idfactura, id_productos, cantidad, precio_unitario, total, iva) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt3 = $conn->prepare($sql_detalle);

    for ($i = 0; $i < count($productos); $i++) {
        $id_producto = $productos[$i];
        $cantidad = $cantidades[$i];
        $precio = $precios[$i];
        $total = $precio * $cantidad;

        $stmt3->bind_param("iiiddd", $idfactura, $id_producto, $cantidad, $precio, $total, $iva);
        $stmt3->execute();
    }

    echo "<div class='alert alert-success'>Factura registrada correctamente</div>";
    echo "<a href='ver_factura.php' id=$idfactura' class='btn btn-primary mt-3'>Ver Factura</a>";
} else {
}
