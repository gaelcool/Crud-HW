<?php
include 'conexion.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id-= $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
mysqli_query($conexion, "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos' WHERE id='$id'") or die ("Error al actualizar los datos");
mysqli_close($conexion);
echo '
    <script>
        alert("Datos actualizados exitosamente");
        window.location = "registrar.html";
    </script>

';
?>