
<?php include 'conexion.php'; ?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Inventario de Productos</h2>
    <a href="agregar_producto.php" class="btn btn-primary mb-3">Agregar Producto</a>
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Disponibilidad</th>
                <th>Stock</th>
                <th>IVA/PORCENTAJE</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT p.id_productos, p.nombre_producto, c.categoria_producto, 
                             p.precio_producto, p.disponiblidad_producto, p.tipo_iva, p.stock, p.IVA
                      FROM productos p
                      JOIN categoria_producto c ON p.idcategoria = c.idcategoria_producto";
            $resultado = $conn->query($query);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id_productos']}</td>";
                    echo "<td>{$row['nombre_producto']}</td>";
                    echo "<td>{$row['categoria_producto']}</td>";
                    echo "<td>$ {$row['precio_producto']}</td>";
                    echo "<td>" . ($row['disponiblidad_producto'] ? 'Disponible' : 'No disponible') . "</td>";
                    echo "<td>{$row['stock']}</td>";
                    echo "<td>{$row['tipo_iva']} | {$row['IVA']}%</td>";
                    echo "<td>
                            <a href='inventario.php?edit_id={$row['id_productos']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='eliminar_producto.php?id={$row['id_productos']}' class='btn btn-danger btn-sm' onclick='return confirm(¿Estás seguro de eliminar este producto?)'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay productos en el inventario.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php if (isset($_GET['edit_id'])): 
    $id = $_GET['edit_id'];
    $query = "SELECT * FROM productos WHERE id_productos = $id";
    $producto = $conn->query($query)->fetch_assoc();
?>
<div class="modal d-block" tabindex="1">
  <div class="modal-dialog">
    <form method="post" action="actualizar_producto.php" class="modal-content p-4 bg-light">
        <h5 class="modal-title">Editar Producto</h5>
        <input type="hidden" name="id_productos" value="<?= $producto['id_productos'] ?>">
        <div class="form-group mb-2">
            <label>Nombre</label>
            <input name="nombre_producto" class="form-control" value="<?= $producto['nombre_producto'] ?>">
        </div>
        <div class="form-group mb-2">
            <label>Precio</label>
            <input name="precio_producto" class="form-control" value="<?= $producto['precio_producto'] ?>">
        </div>

        <div class="form-group mb-2">
            <label>stock</label>
            <input name="stock" class="form-control" value="<?= $producto['stock'] ?>">
        </div>

        <div class="form-group mb-2">
            <label>Disponibilidad</label>
            <select name="disponiblidad_producto" class="form-control">
                <option value="1" <?= $producto['disponiblidad_producto'] ? 'selected' : '' ?>>Disponible</option>
                <option value="0" <?= !$producto['disponiblidad_producto'] ? 'selected' : '' ?>>No Disponible</option>
            </select>
        </div>
        <div class="mt-3 text-end">
            <a href="inventario.php" class="btn btn-secondary">Cancelar</a>
            <a href="inventario.php"><button type="submit" class="btn btn-primary">Guardar Cambios</button></a>
            
        </div>
    </form>
  </div>
</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>



</body>
</html>
