<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$nick = $_SESSION['nick'];
	$foto = $_SESSION['foto'];

	//traer imagen:
	//Código de foto perfil:
	$extension = '';
	$ruta = 'foto_perfil'; //carpeta 'foto_perfil'
	//traemos el archivo que viene desde el formulario:
	$archivo = $_FILES['foto']['tmp_name'];
	$nombreArchivo = $_FILES['foto']['name'];
	$info = pathinfo($nombreArchivo);

	if ($archivo != '')
	{
		//si trae imagen:
		$extension = $info['extension'];
		if ($extension == "png" || $extension == "PNG" || $extension == "jpg" || $extension == "JPG") 
		{
			//unlink para eliminar foto actual:
			unlink('../usuarios/'.$foto);
			//variable ran, contendrá un número random, para crear un nuevo nombre de archivo.
			$rand = rand(000,999);

			//si cumple el formato, movemos el archivo a la carpeta que hemos creado:
			move_uploaded_file($archivo, '../usuarios/foto_perfil/'.$nick.$rand.'.'.$extension);
			$ruta = $ruta."/".$nick.$rand.'.'.$extension;

			//ACTUALIZAR VALOR DE FOTO EN LA TABLA (BD):
			$up = $con->query("UPDATE usuario SET foto='$ruta' WHERE nick='$nick' ");
			//COMPROBACIÓN DE SENTENCIA:
			if ($up)
			{
				//ACTUALIZAR VARIABLE DE SESIÓN que contiene la foto:
				$_SESSION['foto'] = $ruta;

				//si se actualizo:
				header('Location:../extend/alerta.php?msj=Foto de perfil actualizada&c=pe&p=in&t=success');
			}
			else
			{
				//si no se actualizo:
				header('Location:../extend/alerta.php?msj=La foto de perfil no pudo ser actualizada&c=pe&p=in&t=error');
			}
		}
		else
		{
			//si no cumple el formato, se envía alerta
			header('Location:../extend/alerta.php?msj=El formato no es valido&c=us&p=in&t=error');
			exit;
		}
	}
	else
	{
		//si no trae imagen, se envía alerta:
		header('Location:../extend/alerta.php?msj=No se detecto ninguna foto para actualizar&c=pe&p=in&t=error');
	}

	$con->close();
}
else
{
	header('location:../extend/alerta.php?msj=Utiliza el formulario&c=pe&p=in&t=error');
}

?>