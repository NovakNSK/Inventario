<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Proyecto Techcare - Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="principal.php">TechCare</a>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Opciones</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
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
                        <a class="nav-link" href="nuevo_tecnico.php">
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
                        <a class="nav-link" href="ver_tecnicos.php">
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
                    <h1 class="mt-4">Bienvenido a TechCare</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2>¡Hola!</h2>
                            <p>Bienvenido al sistema de gestión de inventario y técnicos. Aquí podrás administrar fácilmente el hardware y el personal técnico de tu organización.</p>
                            <p>Utiliza el menú lateral para navegar entre las diferentes secciones del sistema.</p>
                            <hr>
                            <p class="text-muted">Si tienes alguna duda, no dudes en consultar con el administrador del sistema.</p>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Proyecto Techcare &copy; 2025</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
