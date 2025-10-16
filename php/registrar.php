<?php
include 'conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$telefono = $_POST['telefono'];


// Server-side safety net
if (empty($nombre) || empty($apellidos) || empty($correo) || empty($usuario) || empty($clave) || empty($telefono)) {
echo "<script>alert('Por favor completa todos los campos'); window.history.back();</script>";
exit;
}


if (!preg_match('/^[A-ZÁÉÍÓÚÑ ]+$/', $nombre)) {
echo "<script>alert('El nombre debe estar en mayúsculas'); window.history.back();</script>";
exit;
}


// Continue inserting data

$stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (nombre, apellidos, correo, usuario, clave, telefono) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellidos, $correo, $usuario, $clave_hash, $telefono);


if (mysqli_query($conexion, $query)) {
echo "<script>alert('¡Registro exitoso!'); window.location.href='../login.html';</script>";
} else {
echo "<script>alert('Error al registrar. Inténtalo de nuevo.'); window.history.back();</script>";
}
}
?>