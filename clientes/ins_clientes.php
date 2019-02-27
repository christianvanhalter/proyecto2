<?php

include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//traemos c/u de las variables del formulario:
	$nombre = htmlentities($_POST['nombre']);
	$direccion = htmlentities($_POST['direccion']);
	$telefono = htmlentities($_POST['telefono']);
	$correo = htmlentities($_POST['email']);
	$asesor = $_SESSION['nombre']; //aquí guardamos el nombre del 'asesor' sería quién esta actualmente logeado en el sistema.
	$id = ''; //viene la variable id vacía por lo de la nueva consulta que se utilizará.

	//CONSULTA PREPARADA:
	$ins = $con->prepare("INSERT INTO clientes VALUES(?,?,?,?,?,?) ");
	$ins->bind_param("isssss",$id, $nombre, $direccion, $telefono, $correo, $asesor);

	//validación antes de que se ejecute la sentencia preparada INSERT.
	if ($ins->execute()) 
	{
		header('Location:../extend/alerta.php?msj=Cliente registrado&c=cli&p=in&t=success');
	}
	else
	{
		header('Location:../extend/alerta.php?msj=El cliente no pudo ser registrado&c=cli&p=in&t=error');
	}

	$ins->close();
	$con->close();
}
else
{
	header('Location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}

?>