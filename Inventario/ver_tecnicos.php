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
    $estatus_filtro = isset($_GET['estatus']) ? $_GET['estatus'] : '';

    $sql = "SELECT id_tecnico, nombre, apellidop, apellidom, correo, estatus FROM Tecnico";
    if ($estatus_filtro === 'activo') {
        $sql .= " WHERE estatus = 1";
    } elseif ($estatus_filtro === 'inactivo') {
        $sql .= " WHERE estatus = 0";
    }

    $result = $conn->query($sql);
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Proyecto Techcare - Técnicos</title>
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
                        <h1 class="mt-4">Técnicos</h1>
                        

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Base de Datos Técnicos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <form method="GET" class="mb-3">
        <label for="estatus" class="form-label">Filtrar por Estatus:</label>
        <select id="estatus" name="estatus" class="form-select" style="max-width: 200px;">
            <option value="" <?php if ($estatus_filtro === '') echo 'selected'; ?>>-- Todos --</option>
            <option value="activo" <?php if ($estatus_filtro === 'activo') echo 'selected'; ?>>Activo</option>
            <option value="inactivo" <?php if ($estatus_filtro === 'inactivo') echo 'selected'; ?>>Inactivo</option>
        </select>
        <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
    </form>

                                    <thead>
                                        <tr>
                                            <th>ID Técnico</th>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Correo</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['id_tecnico']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['apellidop']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['apellidom']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
                                                echo "<td>" . ($row['estatus'] ? 'Activo' : 'Inactivo') . "</td>";
                                                echo "<td>
                                                        <a href='editar_tecnico.php?id_tecnico=" . urlencode($row['id_tecnico']) . "' class='btn btn-primary btn-sm'>Editar</a>
                                                    </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
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
