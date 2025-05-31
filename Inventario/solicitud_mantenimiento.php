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

// Obtener lista de equipos activos para el select
$sqlEquipos = "SELECT id_equipo, tipo_dispositivo, numero_serie FROM Inventario_Hardware WHERE estatus = 1";
$resultEquipos = $conn->query($sqlEquipos);
$equipos = [];
if ($resultEquipos->num_rows > 0) {
    while ($row = $resultEquipos->fetch_assoc()) {
        $equipos[] = $row;
    }
}

// Obtener lista de técnicos para el select
$sqlTecnicos = "SELECT id_tecnico, nombre, apellidop, apellidom FROM Tecnico WHERE estatus = 1";
$resultTecnicos = $conn->query($sqlTecnicos);
$tecnicos = [];
if ($resultTecnicos->num_rows > 0) {
    while ($row = $resultTecnicos->fetch_assoc()) {
        $tecnicos[] = $row;
    }
}

// Procesar formulario al enviarlo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_equipo = $_POST['id_equipo'];
    $tipo_mantenimiento = $_POST['tipo_mantenimiento'];
    $descripcion = $_POST['descripcion'];
    $prioridad = $_POST['prioridad'];
    $id_tecnico = $_POST['id_tecnico'];
    $fecha_programada = $_POST['fecha_programada'];

    $sqlInsert = "INSERT INTO Solicitudes_Mantenimiento 
        (id_equipo, tipo_mantenimiento, descripcion, prioridad, id_tecnico, fecha_programada) 
        VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sqlInsert);
    $stmt->bind_param("isssis", $id_equipo, $tipo_mantenimiento, $descripcion, $prioridad, $id_tecnico, $fecha_programada);

    if ($stmt->execute()) {
        echo "<script>alert('Generar Solicitud de Mantenimiento de Mantenimiento creada correctamente'); window.location.href = 'ver_solicitudes.php';</script>";
        exit;
    } else {
        echo "Error al registrar solicitud: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Generar Solicitud de Mantenimiento de Mantenimiento- TechCare</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed bg-light">
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
                        <a class="nav-link active" href="solicitud_mantenimiento.php">
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
                <div class="container-fluid px-4 py-4">
                    <h1 class="mt-4">Generar Solicitud de Mantenimiento </h1>
                    <form method="post" class="bg-white p-4 rounded shadow-sm">
                        <div class="mb-3">
                            <label class="form-label">Equipo</label>
                            <select name="id_equipo" class="form-select" required>
                                <option value="">Seleccione un equipo</option>
                                <?php foreach($equipos as $equipo): ?>
                                    <option value="<?= $equipo['id_equipo'] ?>">
                                        <?= htmlspecialchars($equipo['tipo_dispositivo'] . ' - ' . $equipo['numero_serie']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo de Mantenimiento</label>
                            <select name="tipo_mantenimiento" class="form-select" required>
                                <option value="">Seleccione tipo</option>
                                <option value="Preventivo">Preventivo</option>
                                <option value="Correctivo">Correctivo</option>
                                <option value="Predictivo">Predictivo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prioridad</label>
                            <select name="prioridad" class="form-select" required>
                                <option value="">Seleccione prioridad</option>
                                <option value="Baja">Baja</option>
                                <option value="Media">Media</option>
                                <option value="Alta">Alta</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Técnico asignado</label>
                            <select name="id_tecnico" class="form-select" required>
                                <option value="">Seleccione un técnico</option>
                                <?php foreach($tecnicos as $tecnico): ?>
                                    <option value="<?= $tecnico['id_tecnico'] ?>">
                                        <?= $tecnico['id_tecnico'] ?> - 
                                        <?= htmlspecialchars($tecnico['nombre'] . ' ' . $tecnico['apellidop'] . ' ' . $tecnico['apellidom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha Programada</label>
                            <input type="date" name="fecha_programada" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                        <a href="ver_solicitudes.php" class="btn btn-secondary">Cancelar</a>
                    </form>
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
