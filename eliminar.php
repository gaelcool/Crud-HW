<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conexion.php';

$id = $_POST['id'];
mysqli_query($conexion, "DELETE FROM usuarios WHERE id='$id'") or die ("Error al eliminar los datos"); //Its interesting how it uses the same syntax as update
mysqli_close($conexion);
echo 'Eliminado exitosamente';

?>