<?php
include("conexion.php");

// FILTROS
$estado_filtro = isset($_GET['estado']) ? $_GET['estado'] : '';
$prioridad_filtro = isset($_GET['prioridad']) ? $_GET['prioridad'] : '';

// ACTUALIZAR ESTADO
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finalizar_id']) && isset($_POST['estado_actual'])) {
    $id = $_POST['finalizar_id'];
    $estado_actual = $_POST['estado_actual'];
    $nuevo_estado = ($estado_actual === 'Finalizado') ? 'Pendiente' : 'Finalizado';

    $update_sql = "UPDATE Solicitudes_Mantenimiento SET estado = '$nuevo_estado' WHERE id_solicitud = $id";
    $conn->query($update_sql);
}

// CONSTRUIR CONSULTA
$sql = "SELECT sm.*, ih.tipo_dispositivo, ih.numero_serie, t.nombre AS tecnico_nombre, t.apellidop AS tecnico_apellido FROM Solicitudes_Mantenimiento sm
        LEFT JOIN Inventario_Hardware ih ON sm.id_equipo = ih.id_equipo
        LEFT JOIN Tecnico t ON sm.id_tecnico = t.id_tecnico
        WHERE 1=1";

if (!empty($estado_filtro)) {
    $sql .= " AND sm.estado = '$estado_filtro'";
}

if (!empty($prioridad_filtro)) {
    $sql .= " AND sm.prioridad = '$prioridad_filtro'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Proyecto Techcare - Solicitudes de Mantenimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        .form-label {
            font-weight: 600;
        }
        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        table.dataTable thead th {
            background-color: #0d6efd !important;
            color: white !important;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="principal.php">TechCare</a>
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

    <!-- Sidebar + Content -->
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
                            <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></div>
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
                        <a class="nav-link active" href="ver_solicitudes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></div>
                            Solicitudes de Mantenimiento
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main class="container-fluid px-4 py-4">
                <h1 class="mt-4 mb-3">Solicitudes de Mantenimiento</h1>

                <!-- FILTROS -->
                <form method="GET" class="row g-3 align-items-end mb-4">
                    <div class="col-md-3">
                        <label for="estado" class="form-label">Filtrar por Estado:</label>
                        <select id="estado" name="estado" class="form-select">
                            <option value="" <?php if ($estado_filtro === '') echo 'selected'; ?>>-- Todos --</option>
                            <option value="Pendiente" <?php if ($estado_filtro === 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                            <option value="Finalizado" <?php if ($estado_filtro === 'Finalizado') echo 'selected'; ?>>Finalizado</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="prioridad" class="form-label">Filtrar por Prioridad:</label>
                        <select id="prioridad" name="prioridad" class="form-select">
                            <option value="" <?php if ($prioridad_filtro === '') echo 'selected'; ?>>-- Todas --</option>
                            <option value="Alta" <?php if ($prioridad_filtro === 'Alta') echo 'selected'; ?>>Alta</option>
                            <option value="Media" <?php if ($prioridad_filtro === 'Media') echo 'selected'; ?>>Media</option>
                            <option value="Baja" <?php if ($prioridad_filtro === 'Baja') echo 'selected'; ?>>Baja</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </form>

                <!-- TABLA -->
                <table id="solicitudesTable" class="table table-striped table-bordered shadow-sm bg-white">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Equipo</th>
                            <th>Serie</th>
                            <th>Tipo de Mantenimiento</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Técnico</th>
                            <th>Fecha Solicitud</th>
                            <th>Finalizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <th scope="row"><?php echo $row["id_solicitud"]; ?></th>
                                    <td><?php echo htmlspecialchars($row["tipo_dispositivo"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["numero_serie"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["tipo_mantenimiento"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["prioridad"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["estado"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["tecnico_nombre"] . ' ' . $row["tecnico_apellido"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["fecha_solicitud"]); ?></td>
                                    <td class="text-center">
                                        <form method="POST" style="margin:0;">
                                            <input type="hidden" name="finalizar_id" value="<?php echo $row["id_solicitud"]; ?>">
                                            <input type="hidden" name="estado_actual" value="<?php echo $row["estado"]; ?>">
                                            <input type="checkbox" onchange="this.form.submit()" <?php echo ($row["estado"] === 'Finalizado') ? 'checked' : ''; ?> title="Marcar para cambiar estado">
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="9" class="text-center">No hay solicitudes.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Proyecto Techcare &copy; <?php echo date("Y"); ?></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.min.js"></script>
    <script>
        // Inicializar DataTable
        window.onload = function () {
            const dataTable = new simpleDatatables.DataTable("#solicitudesTable", {
                searchable: true,
                fixedHeight: true,
                perPageSelect: true,
                perPage: 10
            });
        };
    </script>
</body>
</html>
