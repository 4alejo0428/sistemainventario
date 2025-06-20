<?php
include 'conexion.php';

$id = $_POST['id_productos'];
$nombre = $_POST['nombre_producto'];
$precio = $_POST['precio_producto'];
$stock = $_POST['stock'];
$disponible = $_POST['disponiblidad_producto'];

$sql = "UPDATE productos SET nombre_producto='$nombre', precio_producto=$precio, stock=$stock ,disponiblidad_producto=$disponible WHERE id_productos=$id";
if ($conn->query($sql) === TRUE) {
    echo "<a href='inventario.php'></a>";
} else {
    echo "Error: " . $conn->error;
}
include 'inventario.php';
?>
