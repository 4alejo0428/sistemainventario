
<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
$sql = "UPDATE productos SET estado = 0 WHERE id_productos = $id";
    if ($conn->query($sql) === TRUE) {
        include 'inventario.php';
        echo "<script>alert('Producto eliminado exitosamente.'); window.location.href = 'inventario.php';</script>";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
} else {
    echo "ID de producto no proporcionado.";
}
?>
