<?php
// db.php - Conexión a la base de datos
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$db = 'Inventario';  // Asegúrate que la base de datos se llama así
$user = 'root';
$pass = '';  // Tu contraseña real de MySQL

$conn = new mysqli($host, $user, $pass, $db);

// Validar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
