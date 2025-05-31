<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Inventario";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id_tecnico'])) {
    $id_tecnico = $_GET['id_tecnico'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellidop = $_POST['apellidop'];
        $apellidom = $_POST['apellidom'];
        $correo = $_POST['correo'];
        $estatus = isset($_POST['estatus']) ? 1 : 0;

        $sql = "UPDATE Tecnico SET 
                    nombre = ?, 
                    apellidop = ?, 
                    apellidom = ?, 
                    correo = ?, 
                    estatus = ?
                WHERE id_tecnico = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $nombre, $apellidop, $apellidom, $correo, $estatus, $id_tecnico);

        if ($stmt->execute()) {
            echo "<script>alert('Técnico actualizado correctamente'); window.location.href = 'ver_tecnicos.php';</script>";
            exit;
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    }

    $sql = "SELECT nombre, apellidop, apellidom, correo, estatus FROM Tecnico WHERE id_tecnico = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_tecnico);
    $stmt->execute();
    $result = $stmt->get_result();
    $tecnico = $result->fetch_assoc();

    if (!$tecnico) {
        echo "Técnico no encontrado.";
        exit;
    }
} else {
    echo "ID de técnico no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Proyecto Techcare - Editar Técnico</title>
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
                        <a class="nav-link active" href="ver_tecnicos.php">
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
                    <h1 class="mt-4">Editar Técnico</h1>
                    

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user-edit me-1"></i>
                            Formulario de Edición
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($tecnico['nombre']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="apellidop" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apellidop" name="apellidop" value="<?= htmlspecialchars($tecnico['apellidop']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="apellidom" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="apellidom" name="apellidom" value="<?= htmlspecialchars($tecnico['apellidom']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo" value="<?= htmlspecialchars($tecnico['correo']) ?>" required>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="estatus" name="estatus" <?= $tecnico['estatus'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="estatus">Activo</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <a href="ver_tecnicos.php" class="btn btn-secondary">Cancelar</a>
                            </form>
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
