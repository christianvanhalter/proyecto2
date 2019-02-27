<?php  

include '../conexion/conexion.php';

//preguntamos si se están enviando las variables por método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	//traer variables:
	$user = $con->real_escape_string(htmlentities($_POST['usuario']));
	$pass = $con->real_escape_string(htmlentities($_POST['contra']));


	//VALIDACIÓN de usuario y password:
	$candado = ' ';
//strpos = busca caracteres: 1er parametro = la cadena | 2do parametro = el caracter que queremos buscar. Devuelve el número(int) donde se encuentra el caracter encontrado.
	$str_u = strpos($user,$candado);
	$str_p = strpos($pass,$candado);

	//VALIDA USER:
	//is_int (si es entero)
	if (is_int($str_u)) 
	{
		$user = '';
	}
	else
	{
		$usuario = $user;
	}

	//VALIDA PASSWORD:
	if (is_int($str_p)) 
	{
		$pass = '';
	}
	else
	{
		//se vuelve a encriptar
		$pass2 = sha1($pass);
	}

	//si vienen con espacios las variables de $user y $pass:
	if ($user == null && $pass == null)
	{
		header('Location:../extend/alerta.php?msj=El formato no es correcto&c=salir&p=salir&t=error');
	}
	else
	{
		//CONSULTA PARA TRAER USUARIOS DE BD: ESTANDO CON BLOQUEO =1, es decir, autorizados
		$sel = $con->query("SELECT nick, nombre, nivel, correo, foto, pass FROM usuario WHERE nick = '$usuario' AND pass = '$pass2' AND bloqueo = 1 ");

		$row = mysqli_num_rows($sel);
		if ($row == 1)
		{
			if ($var = $sel->fetch_assoc()) 
			{
			//traemos variables de BD
				$nick = $var['nick'];
				$contra = $var['pass'];
				$nivel = $var['nivel'];
				$correo = $var['correo'];
				$foto = $var['foto'];
				$nombre = $var['nombre'];
			}

			//DANDO DE ALTA EL USUARIO (concediendole acceso a home):
			if ($nick == $usuario && $contra == $pass2 && $nivel == 'ADMINISTRADOR') 
			{
				//crear variables de sesión:
				$_SESSION['nick'] = $nick;
				$_SESSION['nombre'] = $nombre;
				$_SESSION['nivel'] = $nivel;
				$_SESSION['correo'] = $correo;
				$_SESSION['foto'] = $foto;

				header('Location:../extend/alerta.php?msj=Bienvenido&c=home&p=home&t=success');
			}
			elseif ($nick == $usuario && $contra == $pass2 && $nivel == 'ASESOR') 
			{
				//sino, nos lleva a la vista del ASESOR
				//crear variables de sesión:
				$_SESSION['nick'] = $nick;
				$_SESSION['nombre'] = $nombre;
				$_SESSION['nivel'] = $nivel;
				$_SESSION['correo'] = $correo;
				$_SESSION['foto'] = $foto;

				header('Location:../extend/alerta.php?msj=Bienvenido&c=home&p=home&t=success');
			}
			else
			{
				header('Location:../extend/alerta.php?msj=No tienes el permiso para entrar&c=salir&p=salir&t=error');
			}
		}
		else
		{
			//en caso de que la consulta SQL no hubiese arrojado nada:
			header('Location:../extend/alerta.php?msj=Nombre de usuario o Contraseña incorrectos&c=salir&p=salir&t=error');
		}
	}

}
else
{
	header('Location:../extend/alerta.php?msj=Utiliza el formulario&c=salirs&p=salir&t=error');
}

?>