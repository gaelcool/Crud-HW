<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = mysqli_connect("localhost", "root", "", "bd_pruepa");  
$conexion->set_charset("utf8");   
/* 
<!-- Remember, this is the most basic operation that must be ran to connect to the db, must have db started --> */
if (!$conexion) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
}
else {
    echo "Conexión exitosa a la base de datos.";
}   
?>
