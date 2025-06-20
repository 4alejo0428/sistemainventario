<?php 
// Obtener categorías
$categorias = $conn->query("SELECT idcategoria_producto, categoria_producto FROM categoria_producto");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $disponibilidad = isset($_POST['disponibilidad']) ? 1 : 0;
    $tipo_iva = $_POST['tipo_iva'];
    $stock = $_POST['stock'];
    $IVA = $_POST['IVA'];

    $sql = "INSERT INTO productos (nombre_producto, precio_producto, idcategoria, disponiblidad_producto, tipo_iva, stock, IVA) 
            VALUES ('$nombre', '$precio', '$categoria', '$disponibilidad', '$tipo_iva', $stock,'$IVA')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Producto agregado exitosamente.";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
}

?>