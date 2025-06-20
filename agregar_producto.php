<?php
include 'conexion.php';
include 'includes/obtener_categorias.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> 
<div class="container mt-5">
    <h2 class="mb-4">Agregar Producto al Inventario</h2>

    <?php if (isset($mensaje)): ?>
        <div class="alert alert-info"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria" class="form-select" required>
                <option value="">Selecciona una categoría</option>
                <?php while ($row = $categorias->fetch_assoc()): ?>
                    <option value="<?= $row['idcategoria_producto'] ?>"><?= $row['categoria_producto'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de IVA</label>
            <select name="tipo_iva" class="form-select" required>
                <option value="gravado">Gravado</option>
                <option value="exento">Exento</option>
                <option value="excluido">Excluido</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">IVA</label>
            <select name="IVA" class="form-select" required>
                <option value="19">19%</option>
                <option value="0">0%</option>
                <option value="2">2%</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" step="0.01" name="stock" class="form-control" required>
        </div>


        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="disponibilidad" id="disponibilidad" checked>
            <label class="form-check-label" for="disponibilidad">Disponible</label>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Producto</button><br>
        <a href="index.php" class="btn btn-secondary">Volver</a>

    </form>
</div>
</body>
</html>
