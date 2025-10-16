<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receive input
    $nombre = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $clave = trim($_POST['clave'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    // Basic check
    if (empty($nombre) || empty($apellidos) || empty($correo) || empty($usuario) || empty($clave) || empty($telefono)) {
        echo "<script>alert('Por favor completa todos los campos'); window.history.back();</script>";
        exit;
    }

    // Check for duplicates
    $check = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ? OR correo = ?");
    $check->bind_param('ss', $usuario, $correo);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('El usuario o correo ya existe'); window.history.back();</script>";
        $check->close();
        $conexion->close();
        exit;
    }
    $check->close();

    // Insert new user
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, correo, usuario, clave, telefono) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $nombre, $apellidos, $correo, $usuario, $clave, $telefono);

    if ($stmt->execute()) {
        echo "<script>alert('¡Registro exitoso!'); window.location.href='../login.html';</script>";
    } else {
        echo "<script>alert('Error al registrar. Inténtalo de nuevo.'); window.history.back();</script>";
    }

    $stmt->close();
    $conexion->close();
}
?>
