<?php
 include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Factura</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">Nueva Factura</h2>

    <form method="POST" action="guarda_factura.php
">
        <div class="card mb-4">
            <div class="card-header">Información del Cliente</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="customer_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cédula</label>
                    <input type="text" name="customer_phone" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="customer_address" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">IVA</label>
                    <select name="iva" class="form-select">
                        <option value="0">0%</option>
                        <option value="8">8%</option>
                        <option value="16">16%</option>
                        <option value="19" selected>19%</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Productos</h5>
                <button type="button" class="btn btn-success" onclick="agregarProducto()">
                    <i class="fas fa-plus"></i> Agregar Producto
                </button>
            </div>
            <div class="card-body" id="productosContainer">
                <div class="row g-3 producto-grupo">
                    <div class="col-md-4">
                        <label class="form-label">Producto</label>
                        <select name="productos[]" class="form-select producto-select" onchange="actualizarPrecio(this)" required>
                            <?php
                            
                            $res = $conn->query("SELECT id_productos, nombre_producto, precio_producto FROM productos");
                            while ($p = $res->fetch_assoc()):
                            ?>
                                <option value="<?= $p['id_productos'] ?>" data-precio="<?= $p['precio_producto'] ?>">
                                    <?= $p['nombre_producto'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Precio por unidad</label>
                        <input type="number" name="precios[]" class="form-control" step="0.01" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="cantidades[]" class="form-control" value="1" min="1" required>
                    </div>
                   
                    
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger w-100" onclick="eliminarProducto(this)">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="index.php" class="btn btn-secondary me-2">Volver</a>
            <button type="submit" class="btn btn-primary">Guardar Factura</button>
        </div>
    </form>
</div>

<script>
        function agregarProducto() {
            const contenedor = document.getElementById('productosContainer');
            const productoOriginal = document.querySelector('.producto-grupo');
            const nuevoProducto = productoOriginal.cloneNode(true);
            // Limpia valores
            nuevoProducto.querySelectorAll('input, select').forEach(el => el.value = el.type === 'number' ? 1 : '');
            contenedor.appendChild(nuevoProducto);
        }

        function eliminarProducto(btn) {
            const contenedor = document.getElementById('productosContainer');
            if (contenedor.children.length > 1) {
                btn.closest('.producto-grupo').remove();
            }
        }
    </script>

<script src="https://kit.fontawesome.com/a2d9d6cfd3.js" crossorigin="anonymous"></script>
<script>
function actualizarPrecio(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const precio = selectedOption.getAttribute('data-precio');

    // Buscar el input de precio dentro del mismo grupo
    const precioInput = selectElement.closest('.producto-grupo').querySelector('input[name="precios[]"]');
    if (precioInput) {
        precioInput.value = precio;
    }
}
</script>

</body>
</html>
