<?php
include 'conexion.php';

$id = $_POST['id_productos'];
$nombre = $_POST['nombre_producto'];
$precio = $_POST['precio_producto'];
$disponible = $_POST['disponiblidad_producto'];

$query = "UPDATE productos SET nombre_producto=?, precio_producto=?, disponiblidad_producto=? WHERE id_productos=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sdii", $nombre, $precio, $disponible, $id);
$stmt->execute();

header("Location: inventario.php?mensaje=Producto+editado+correctamente");
