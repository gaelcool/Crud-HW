<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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