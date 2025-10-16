<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "conexion.php"; // Archivo de conexión a la base de datos

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}


$conexion = mysqli_connect("localhost", "root", "", "bd_pruepa");  
$conexion->set_charset("utf8");   

if (!$conexion){
    echo json_encode(['success' => false, 'message' => 'Error al conectar con la base de datos']);
    exit;
}
else {
    echo json_encode(['success' => true, 'message' => 'Conexión exitosa']);
}
?>