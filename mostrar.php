<?php
include ('conexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
<head>
<title>MOSTRAR DATOS</title>
<style>
.tabla{
    width: 90%;
    margin-left:5%;
    margin-right:5%;
}
.tabla2 {
font-family: Arial, Helvetica, sans-serif;
border-collapse: collapse;
width: 90%;
}

.tabla2 td, .tabla2 th {
border: 1px solid #753663;
padding: 8px;
}
</style>
</head>
<body>

<center><h1 > LISTA DE USUARIOS</h1>
<table class="tabla2">
<tr>
<td>ID</td>
<td>NOMBRE</td>
<td>APELLIDO</td>
<td>CORREO</td>
<td>USUARIO</td>
<td>CLAVE</td>
<td>TELEFONO</td>
</tr>

<?php
$sql="SELECT * FROM usuarios ";
$result=mysqli_query($conexion,$sql);
while ( $mostrar=mysqli_fetch_assoc($result)) {
?>


<tr>
<td><?php echo $mostrar["id"]; ?> </td>
<td><?php echo $mostrar["nombre"];?></td>
<td><?php echo $mostrar["apellidos"];?></td>
<td><?php echo $mostrar["correo"];?></td>
<td><?php echo $mostrar["usuario"];?></td>
<td><?php echo $mostrar["clave"];?></td>
<td><?php echo $mostrar["telefono"];?></td>
</tr>
<?php
}

mysqli_free_result($result);?>


</table></center><br><br>
<input type="button" value="Regresar" onclick="window.location.href='inicio.html'"/>
</body>
</html>