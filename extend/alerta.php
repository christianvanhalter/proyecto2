<?php  
include '../conexion/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<!--Dependencias de Sweet Alert2-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
	<title>Proyecto</title>
</head>
<body>
<?php
$mensaje = htmlentities($_GET['msj']);
$c = htmlentities($_GET['c']);
$p = htmlentities($_GET['p']);
$t = htmlentities($_GET['t']);

switch ($c)
{
	case 'us':
		$carpeta = '../usuarios/';
		break;

	case 'home':
		$carpeta = '../inicio/';
		break;

	case 'salir':
		$carpeta = '../';
		break;

	case 'pe':
		$carpeta = '../perfil/';
		break;

	case 'cli':
		$carpeta = '../clientes/';
		break;

	case 'prop':
		$carpeta = '../propiedades/';
		break;
}

switch ($p)
{
	case 'in':
		$pagina = 'index.php';
		break;

	case 'home':
		$pagina = 'index.php';
		break;

	case 'salir':
		$pagina = '';
		break;

	case 'perfil':
		$pagina = 'perfil.php';
		break;
}
$dir = $carpeta.$pagina;

//si tipo es igual a error
if ($t == "error") 
{
	$titulo = "Oppss...";
}
else
{
	$titulo = "Buen trabajo!";
}
?>

	<!--Dependencias de Jquery-->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
  	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  	crossorigin="anonymous">
	</script>
  	<!--Dependencias de Sweet Alert-->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js"></script>
	<script>
		swal({
			title: '<?php echo $titulo ?>',
			text: "<?php echo $mensaje ?>",
			type: '<?php echo $t ?>',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ok'
		}).then(function()
		{
			location.href='<?php echo $dir ?>';
		});

		//código para que redireccione independiente de si uso el botón ok, tecla esc o click fuera del cuadro de alerta.
		//AL CLICK
		$(document).click(function()
		{
			location.href='<?php echo $dir ?>';
		});

		//tecla ESC
		$(document).keyup(function(e)
		{
			if (e.which == 27)
			{
				location.href='<?php echo $dir ?>';
			}
		});
	</script>

</body>
</html>