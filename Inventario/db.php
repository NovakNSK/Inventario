<?php
// db.php - Conexión a la base de datos
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "Plus1010"; 
$dbname = "Inventario";

$conn = new mysqli($host, $user, $password, $dbname);

// Validar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
