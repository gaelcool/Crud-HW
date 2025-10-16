<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

include "conexion.php"; // Archivo de conexión a la base de datos

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Sanitize input
$nombre    = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$correo    = trim($_POST['correo'] ?? '');
$usuario   = trim($_POST['usuario'] ?? '');
$clave     = $_POST['clave'] ?? '';
$telefono  = trim($_POST['telefono'] ?? '');

// Validate required fields
if (empty($nombre) || empty($apellidos) || empty($correo) || empty($usuario) || empty($clave) || empty($telefono)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos']);
    exit;
}

// Validate email
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Formato de correo inválido']);
    exit;
}

// Validate password length
if (strlen($clave) < 8) {
    echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres']);
    exit;
}

// Validate phone
if (!preg_match('/^[0-9]{10,15}$/', $telefono)) {
    echo json_encode(['success' => false, 'message' => 'Formato de teléfono inválido']);
    exit;
}

// Check if username exists
$stmt = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE usuario = ?");
mysqli_stmt_bind_param($stmt, "s", $usuario);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    echo json_encode(['success' => false, 'message' => 'Este usuario ya existe']);
    exit;
}
mysqli_stmt_close($stmt);

// Check if email exists
$stmt = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE correo = ?");
mysqli_stmt_bind_param($stmt, "s", $correo);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    echo json_encode(['success' => false, 'message' => 'Este correo ya está registrado']);
    exit;
}
mysqli_stmt_close($stmt);

// Hash password
$clave_hash = password_hash($clave, PASSWORD_DEFAULT);

// Insert new user
$stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (nombre, apellidos, correo, usuario, clave, telefono) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellidos, $correo, $usuario, $clave_hash, $telefono);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario']);
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
