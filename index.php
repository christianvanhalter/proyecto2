<?php @session_start();
//código para destruir sesión
if (isset($_SESSION['nick'])) 
{
	header('location:inicio');
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie-edge">
		<!--Dependencias de Material Design-->
		<link rel="stylesheet" href="css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Proyecto</title>
	</head>
	<body class="grey lighten-2">
		<main>
			<!--CONTENEDOR DEL LOGO-->
			<div class="row">
				<div class="input-field col s12 center">
					<img src="img/logo.jpg" width="200" class="circle">
				</div>
			</div>




			<!--FORMULARIO DE LOGIN-->
			<div class="container">
				
				<div class="row">
					<div class="col s12">
						<div class="card z-depth-5">
								<div class="card-content">
									<span class="card-title"><center>Inicio de Sesión</center></span>
									<form action="login/index.php" method="post" autocomplete="off">
										
										<!--INPUT USUARIO-->
										<div class="input-field">
											<i class="material-icons prefix">perm_identity</i>
											<input type="text" name="usuario" id="usuario" required autofocus>
											<!--<input type="text" name="usuario" id="usuario" required pattern="[A-Za-z]{8,15}" autofocus>-->
											<label for="usuario">Usuario</label>
										</div>

										<!--INPUT CONTRASEÑA-->
										<div class="input-field">
											<i class="material-icons prefix">vpn_key</i>
											<input type="password" name="contra" id="contra" required>
											<!-- <input type="password" name="contra" id="contra" required pattern="[A-Za-z0-9]{8,15}" > -->
											<label for="contra">Contraseña</label>
										</div>

										<!--INPUT BOTÓN de ENVIO-->
										<div class="input-field center">
											<button type="submit" class="btn waves-effect waves-light">Acceder</button>
										</div>
									</form>
								</div>
				 		</div>
					</div>
				</div>
				
			</div>
		</main>

		<!--Dependencias de Jquery-->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"
  		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  		crossorigin="anonymous">
		</script>
		<!--Dependencias de Material Design-->
		<script src="js/materialize.min.js"></script>
	</body>
</html>