<?php
include '../conexion/conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//capturamos variables del formulario: perfil.php
	$nick = $_SESSION['nick'];
	$nombre = $con->real_escape_string(htmlentities($_POST['nombre']));
	$correo = $con->real_escape_string(htmlentities($_POST['correo']));

	$up = $con->query("UPDATE usuario SET nombre = '$nombre', correo = '$correo' WHERE nick = '$nick' ");
	//COMPROBAMOS QUE SE HAYA EJECUTADO EL STATEMENT $up:

	if ($up)
	{
		//si funcionó, actualizamos las variables de sesión con los nuevos valores:
		$_SESSION['nombre'] = $nombre;
		$_SESSION['correo'] = $correo;
		header('Location:../extend/alerta.php?msj=Datos actualizados&c=pe&p=perfil&t=success');
	}
	else
	{
		header('Location:../extend/alerta.php?msj=Datos no actualizados&c=pe&p=perfil&t=error');
	}

	$con->close();
}
else
{
	header('Location:../extend/alerta.php?msj=Utiliza el formulario&c=CARPETA&p=PAGINA&t=TIPO');
}
?>