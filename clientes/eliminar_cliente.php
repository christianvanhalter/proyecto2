<?php
include '../conexion/conexion.php';

//recibimos el id, del botón del formulario del index.php (clientes)
$id = htmlentities($_GET['id']);

$del = $con->prepare("DELETE FROM clientes WHERE id = ?");
$del->bind_param('i', $id);

//preguntamos si esta sentencia funcionó:
if ($del->execute()) 
{
	header('Location:../extend/alerta.php?msj=Cliente eliminado&c=cli&p=in&t=success');
}
else
{
	header('Location:../extend/alerta.php?msj=El cliente no pudo ser eliminado&c=cli&p=in&t=error');
}
$del->close();
$con->close();


?>