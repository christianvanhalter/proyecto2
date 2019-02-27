<?php
include'../conexion/conexion.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));

$del = $con->query("DELETE FROM usuario WHERE id='$id' ");

//comprobamos si nuestro delete funcionó:
if ($del)
{
	header('location:../extend/alerta.php?msj=Usuario eliminado&c=us&p=in&t=success');
}
else
{
	header('location:../extend/alerta.php?msj=El nivel del usuario no pudo ser eliminado&c=us&p=in&t=error');
}

$con->close();
?>