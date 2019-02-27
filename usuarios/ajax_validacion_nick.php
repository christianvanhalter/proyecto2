<?php
include '../conexion/conexion.php';

//real_escape_string = evita el sql inyection en nuestras consultas.
$nick = $con->real_escape_string($_POST['nick']);

$sel = $con->query("SELECT id FROM usuario WHERE nick = '$nick' ");
$row = mysqli_num_rows($sel); //contará el número de filas que traerá la consulta.

if ($row != 0) 
{
	echo "<label style='color:red;'>El nombre de usuario ya existe</label>";
}
else{
	echo "<label style='color:green;'>El nombre de usuario esta disponible</label>";
}
//cerrar conexión a BD
$con->close();

?>