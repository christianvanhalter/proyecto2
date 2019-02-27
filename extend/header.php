<?php 
include '../conexion/conexion.php';

//si no tenemos una sesión iniciada, entonces que nos saque.
if (!isset($_SESSION['nick'])) 
{
	header('location:../');
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie-edge">
		<!--Dependencias de Material Design-->
		<link rel="stylesheet" href="../css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!--Dependencias de Sweet Alert2-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">

		<style media="screen">
			
			.button-collpase
			{
				display: none;
			}

			header, main, footer
			{
      		padding-left: 300px;
    		}

    		@media only screen and (max-width : 992px)
    		{
      		header, main, footer
      		{
        			padding-left: 0;
      		}

      		.button-collpase
				{
					display: inherit;
				}
    		}
    		
		</style>
		<title>Proyecto</title>
	</head>
	<body class="grey lighten-3">
		<main>

		<?php 
		//Preguntamos por el tipo de usuario:

		if ($_SESSION['nivel'] == 'ADMINISTRADOR') 
		{
			include 'menu_admin.php';
		}
		else
		{
			include 'menu_asesor.php';
		}
		

		?>