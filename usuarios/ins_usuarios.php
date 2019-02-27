<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//traemos variables desde el formulario de ingreso de nuevos USUARIOS [USUARIOS/INDEX.PHP]
	//traemos las variables desde el formulario: htmlentities = anti ataque javascript
	$nick = $con->real_escape_string(htmlentities($_POST['nick']));
	$pass1 = $con->real_escape_string(htmlentities($_POST['pass1']));
	$nivel = $con->real_escape_string(htmlentities($_POST['nivel']));
	$nombre = $con->real_escape_string(htmlentities($_POST['nombre']));
	$correo = $con->real_escape_string(htmlentities($_POST['correo']));

	//VALIDACIONES DE PHP para el formulario de registro de usuario
	//validación para campo obligatorio
	if (empty($nick) || empty($pass1) || empty($nivel) || empty($nombre)) 
	{
		header('Location:../extend/alerta.php?msj=Hay un campo sin especificar&c=us&p=in&t=error');
		exit; //sale del código.
	}


	//validación para verificar si sólo se ingresaron letras:
	if (!ctype_alpha($nick))
	{
		header('Location:../extend/alerta.php?msj=El nick no contiene sólo letras&c=us&p=in&t=error');
		exit;
	}
	if (!ctype_alpha($nivel))
	{
		header('Location:../extend/alerta.php?msj=El nivel no contiene sólo letras&c=us&p=in&t=error');
		exit;
	}


	//Comprobación del campo NOMBRE: que contenga las letras de $caracteres (que incluye el espacio)
	$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ ";
	for ($i=0; $i < strlen($nombre); $i++) 
	{ 
		$buscar = substr($nombre,$i,1);
		//comprobar si estan utilizando los caracteres permitidos
		if (strpos($caracteres,$buscar) === false) 
		{
			header('Location:../extend/alerta.php?msj=El nombre no contiene sólo letras&c=us&p=in&t=error');
			exit;
		}
	}


	//Validación del nick y contraseña
	$usuario = strlen($nick);
	$contra = strlen($pass1);

	//si usuario es menor o usuario es mayor a 15 (no cumple con nuestro formulario)
	if ($usuario < 8 || $usuario > 15) 
	{
		header('Location:../extend/alerta.php?msj=El nick no debe contener entre 8 y 15 caracteres&c=us&p=in&t=error');
		exit;
	}
	if ($contra < 8 || $contra > 15) 
	{
		header('Location:../extend/alerta.php?msj=Las contraseña no debe contener entre 8 y 15 caracteres&c=us&p=in&t=error');
		exit;
	}

	//VALIDACIÓN DE CORREO ELECTRÓNICO:
	if (!empty($correo))
	{
		if (!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
			header('Location:../extend/alerta.php?msj=El email no es valido&c=us&p=in&t=error');
		exit;
		}
	}


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
			//si cumple el formato, movemos el archivo a la carpeta que hemos creado:
			move_uploaded_file($archivo, 'foto_perfil/'.$nick.'.'.$extension);
			$ruta = $ruta."/".$nick.'.'.$extension;
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
		//si no trae imagen, usará una por defecto
		$ruta = "foto_perfil/perfil.jpg";
	}

	//ENCRIPTAMOS LA PASSWORD ANTES DEL INSERT:
	$pass1 = sha1($pass1);
	//INGRESAR LOS DATOS DEL FORMULARIO YA VALIDADOS A LA BD:
	$ins = $con->query("INSERT INTO usuario VALUES('','$nick','$pass1','$nombre', '$correo', '$nivel', 1, '$ruta') ");

	if ($ins) 
	{
		header('Location:../extend/alerta.php?msj=El usuario se ha registrado&c=us&p=in&t=success');
	}
	else
	{
		header('Location:../extend/alerta.php?msj=El usuario no pudo ser registrado&c=us&p=in&t=error');
			exit;
	}
	//ceramos la conexión:
	$con->close();

}else
{
	header('Location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}

?>