<!-- index.php -->
<?php
    include 'conexion.php';
    include 'includes/operacionesindex.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>inicio</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<header><?php include 'includes/header.php'; ?></header>
<body>

    <main class="container my-5">
            <div class="text-center" style="gap:10px">
                <div class="d-grid gap-5 d-md-flex justify-content-center">
                    <a href="inventario.php" class="btn btn-outline-primary">
                        <i class="fas fa-eye me-1"></i> Ver Inventario
                    </a>
                    <a href="agregar_producto.php" class="btn btn-outline-success">
                        <i class="fas fa-plus me-1"></i> Agregar Producto
                    </a>
                    <a href="crear_factura.php" class="btn btn-outline-warning">
                        <i class="fas fa-file-plus me-1"></i> Nueva Factura
                    </a>
                    <a href="todas_facturas.php" class="btn btn-outline-info">
                        <i class="fas fa-list me-1"></i> Ver Facturas
                    </a>
                </div><br>
            </div>
        <div class="mb-5">
            <h2 class="text-center mb-4">Panel de Control</h2>
            <!-- Estadísticas del Inventario -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-box fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Total Productos</h5>
                                <p class="card-text " style="text-align: center;"><?php echo $totalProductos; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-dollar-sign fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Valor Total</h5>
                                <p class="card-text">$<?php echo number_format($valorTotal, 2); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-dark bg-warning h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Stock Bajo</h5>
                                <p class="card-text"><?php echo $stockBajo; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-times-circle fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Sin Stock</h5>
                                <p class="card-text"><?php echo $sinStock ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas de Facturas -->
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card text-bg-secondary h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-file-invoice fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Total Facturas</h5>
                                <p class="card-text"> <?php echo $totalFacturas ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-success h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-check-circle fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Pagadas</h5>
                                <p class="card-text"> <?php echo $facturasPagadas ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-info h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-clock fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Pendientes</h5>
                                <p class="card-text"> <?php echo $facturasPendientes ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-dark h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-chart-line fa-2x me-3"></i>
                            <div>
                                <h5 class="card-title">Ingresos Mes</h5>
                                <p class="card-text"> <?php echo $ingresosMes ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>