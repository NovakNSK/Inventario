<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

$tipo = $_POST['tipo'];
$serie = $_POST['serie'];
$caracteristicas = $_POST['caracteristicas'];
$ubicacion = $_POST['ubicacion'];
$estado = $_POST['estado'];

$sql = "INSERT INTO Inventario_Hardware (tipo_dispositivo, numero_serie, caracteristicas, ubicacion, estado)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en la preparación: " . $conn->error);
}

$stmt->bind_param("sssss", $tipo, $serie, $caracteristicas, $ubicacion, $estado);
if (!$stmt->execute()) {
    die("Error al ejecutar: " . $stmt->error);
}

header("Location: ver_equipo.php");
exit;
?>
