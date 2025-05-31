<?php
// Mostrar errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Agregar Nuevo Técnico - TechCare</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="principal.php">TechCare</a>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menú</div>
                        <a class="nav-link" href="nuevo_equipo.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-microchip"></i></div>
                            Agregar Hardware
                        </a>
                        <a class="nav-link active" href="nuevo_tecnico.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                            Agregar Técnico
                        </a>
                        <a class="nav-link" href="solicitud_mantenimiento.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></i></div>
                        Generar Solicitud de Mantenimiento 
                        </a>
                        <a class="nav-link" href="ver_equipo.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-laptop"></i></div>
                            Ver Inventario
                        </a>
                        <a class="nav-link " href="ver_tecnicos.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Ver Técnicos
                        </a>
                         <a class="nav-link " href="ver_solicitudes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></div>
                            Solicitudes de Mantenimiento
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Agregar Nuevo Técnico</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i>
                            Formulario de Registro de Técnico
                        </div>
                        <div class="card-body">
                            <form action="guardar_tecnico.php" method="post">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="apellidop" class="form-label">Apellido Paterno:</label>
                                    <input type="text" id="apellidop" name="apellidop" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="apellidom" class="form-label">Apellido Materno:</label>
                                    <input type="text" id="apellidom" name="apellidom" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo Electrónico:</label>
                                    <input type="email" id="correo" name="correo" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Guardar Técnico</button>
                                <a href="ver_equipo.php" class="btn btn-secondary ms-2">Regresar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Proyecto TechCare &copy; 2025</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
