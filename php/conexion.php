<!-- Fundamental variable definition and bd connection -->
 <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = mysqli_connect("localhost", "root","","bd_pruepa");  
$conexion->set_charset("utf8");   
if (!$conexion){
    echo "Error al conectar con la base de datos";
}
else {

    echo "Conexion exitosa";
}

?>
