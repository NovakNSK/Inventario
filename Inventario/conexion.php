<?php
$host = "localhost";
$user = "root";
$password = ""; // tu contraseña de root
$dbname = "Inventario";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "¡Conexión exitosa!";
?>
