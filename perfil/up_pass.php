<?php
include '../conexion/conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//capturamos variables del formulario: perfil.php
	$nick = $_SESSION['nick'];
	$pass = $con->real_escape_string(htmlentities($_POST['pass1']));
	$pass = sha1($pass);

	$up = $con->query("UPDATE usuario SET pass = '$pass' WHERE nick = '$nick' ");
	//COMPROBAMOS QUE SE HAYA EJECUTADO EL STATEMENT $up:

	if ($up)
	{
		//si funcionó, actualizamos las variables de sesión con los nuevos valores:
		header('Location:../extend/alerta.php?msj=Password actualizada&c=pe&p=perfil&t=success');
	}
	else
	{
		header('Location:../extend/alerta.php?msj=La password no pudo ser actualizada&c=pe&p=perfil&t=error');
	}


	$con->close();
}
else
{
	header('Location:../extend/alerta.php?msj=Utiliza el formulario&c=CARPETA&p=PAGINA&t=TIPO');
}

?>