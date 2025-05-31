<?php
// Mostrar errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Inventario";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario (usando filter_input para mayor seguridad)
$nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING));
$apellidop = trim(filter_input(INPUT_POST, 'apellidop', FILTER_SANITIZE_STRING));
$apellidom = trim(filter_input(INPUT_POST, 'apellidom', FILTER_SANITIZE_STRING));
$correo = trim(filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL));

if (!$nombre || !$apellidop || !$correo) {
    die("Por favor, complete los campos requeridos correctamente.");
}

// Preparar la consulta para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO Tecnico (nombre, apellidop, apellidom, correo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $apellidop, $apellidom, $correo);

if ($stmt->execute()) {
    // Éxito: redirigir o mostrar mensaje
    header("Location: ver_tecnicos.php?msg=guardado");
    exit();
} else {
    if ($conn->errno === 1062) { // Código error para duplicado (correo único)
        echo "Error: El correo electrónico ya está registrado.";
    } else {
        echo "Error al guardar el técnico: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>
