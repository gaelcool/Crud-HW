<?php
echo "<pre>POST Data: ";
print_r($_POST);
echo "</pre>";
include 'conexion.php';
// Get form data
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$correo = $_POST["correo"];
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];
$telefono = $_POST["telefono"];

// Check if user already exists
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '<script>
        alert("EL USUARIO YA ESTA REGISTRADO");
        window.history.go(-1);
    </script>';
    exit;
}

// Check if email already exists
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '<script>
        alert("EL CORREO YA ESTA REGISTRADO");
        window.history.go(-1);
    </script>';
    exit;
}

// Insert new user
$insertar = "INSERT INTO usuarios (nombre, apellidos, correo, usuario, clave, telefono) 
             VALUES ('$nombre', '$apellidos', '$correo', '$usuario', '$clave', '$telefono')";

$resultado = mysqli_query($conexion, $insertar);

if ($resultado) {
    echo '<script>
        alert("REGISTRO EXITOSO");
        window.location = "login.html";
    </script>';
} else {
    echo '<script>
        alert("ERROR AL REGISTRAR");
        window.history.go(-1);
    </script>';
}

mysqli_close($conexion);
?>