
<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM productos WHERE id_productos = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Producto eliminado exitosamente.'); window.location.href = 'inventario.php';</script>";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
} else {
    echo "ID de producto no proporcionado.";
}
?>
