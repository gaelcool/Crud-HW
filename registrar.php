<?php
//
error_reporting(E_ALL);
ini_set('display_errors', 1);
//
include "conexion.php";
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];   
$telefono = $_POST['telefono'];

//only works if usuarios is made. Change order 
$insertar = "INSERT INTO usuarios(nombre, apellidos, correo, usuario, clave, telefono)
 VALUES ('$nombre', '$apellidos', '$correo', '$usuario', '$clave', '$telefono')";
 $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
 //verificar y avisar si el usuario ya existe
    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '
            <script>
                alert("Este usuario ya existe, intenta con otro diferente");
                window.history.go(-1);
            </script>';
        exit;
    }
    //verificar y avisar si el correo ya existe
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya está registrado, intenta con otro diferente");
                window.history.go(-1);
            </script>';
        exit;   
    }
//Insertar consulta a bd y definir si fue exitosa o no
$resultado = mysqli_query($conexion, $insertar);
    if(!$resultado){
        echo 'Error de conexion';
    } else {
        echo '
            <script>
                alert("Usuario registrado exitosamente");
                window.location = "registrar.html";
            </script>;
        ';
    }
mysqli_close($conexion);

?>

