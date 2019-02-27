<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//traemos c/u de las variables del formulario:
	$nombre = htmlentities($_POST['nombre']);
	$direccion = htmlentities($_POST['direccion']);
	$telefono = htmlentities($_POST['telefono']);
	$correo = htmlentities($_POST['email']);
	$id = htmlentities($_POST['id']);

	//CONSULTA PREPARADA:
	$up = $con->prepare("UPDATE clientes SET nombre=?, direccion=?, tel=?, correo=? WHERE id=? ");
	$up->bind_param('ssssi', $nombre, $direccion, $telefono, $correo, $id);

	//$ins = $con->prepare("INSERT INTO clientes VALUES(?,?,?,?,?,?) ");
	//$ins->bind_param("isssss",$id, $nombre, $direccion, $telefono, $correo, $asesor);

	//validación antes de que se ejecute la sentencia preparada INSERT.
	if ($up->execute()) 
	{
		header('Location:../extend/alerta.php?msj=Cliente actualizado&c=cli&p=in&t=success');
	}
	else
	{
		header('Location:../extend/alerta.php?msj=El cliente no pudo ser actualizado&c=cli&p=in&t=error');
	}

	$up->close();
	$con->close();
}
else
{
	header('Location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}

?>