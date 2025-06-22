<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos del cliente
    $nombre = $_POST['customer_name'] ?? '';
    $apellido = ''; // opcional
    $cedula = $_POST['customer_phone'] ?? '';
    $direccion = $_POST['customer_address'] ?? '';
    $iva = $_POST['iva'] ?? 0;

    // Insertar cliente
    $sql_cliente = "INSERT INTO clientes (nombre_cliente, apellido_cliente, cedula_cliente) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_cliente);
    $stmt->bind_param("sss", $nombre, $apellido, $cedula);
    $stmt->execute();
    $idcliente = $stmt->insert_id;

    // Insertar factura
    $fecha = date('Y-m-d');
    $sql_factura = "INSERT INTO facturas (fecha_factura, idcliente) VALUES (?, ? )";
    $stmt2 = $conn->prepare($sql_factura);
    $stmt2->bind_param("si", $fecha, $idcliente);
    $stmt2->execute();
    $idfactura = $stmt2->insert_id;

    // Insertar los productos de la factura
    $productos = $_POST['productos'];
    $cantidades = $_POST['cantidades'];
    $precios = $_POST['precios'];

    for ($i = 0; $i < count($productos); $i++) {
        $id_producto = $productos[$i];
        $cantidad = $cantidades[$i];
        $precio_unitario = $precios[$i];
        $subtotal = $cantidad * $precio_unitario;
        $impuesto = ($subtotal * $iva) / 100;
        $total = $subtotal + $impuesto;

        $sql_detalle = "INSERT INTO detalle_factura (idfactura, id_productos, cantidad, precio_unitario, total, iva) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt3 = $conn->prepare($sql_detalle);
        $stmt3->bind_param("iiiddd", $idfactura, $id_producto, $cantidad, $precio_unitario, $total, $iva);
        $stmt3->execute();
    }

    echo "<div class='alert alert-success'>✅ Factura registrada correctamente.</div>";
    include 'crear_factura.php';
    echo "<a href='ver_factura.php?id=$idfactura' class='btn btn-primary mt-3'>Ver Factura</a>";

} else {
}
?>
