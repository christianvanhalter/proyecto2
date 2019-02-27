<?php include '../extend/header.php';

?>

		
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<h1>Editar perfil</h1>
				</div>
				<div class="card-tabs">
					<ul class="tabs tabs-fixed-width">
						<li class="tab"><a href="#datos" class="active">Datos</a></li>
						<li class="tab"><a href="#pass">Contraseña</a></li>
					</ul>
				</div>
				<div class="card-content grey lighten-4">
					<div id="datos">
						<!--FORMULARIO CAMBIAR DATOS-->
						<form class="form" action="up_perfil.php" method="post" enctype="multipart/form-data">

									<!--Input Nombre (con pattern de letras de A a la Z permitiendo espacios-->
									<div class="input-field">
										<input type="text" name="nombre" title="Nombre del usuario" id="nombre" onblur="may(this.value, this.id)" required pattern="[A-Z/s ]+" value="<?php echo $_SESSION['nombre'] ?>">
										<label for="nombre">Nombre completo del usuario:</label>
									</div>

									<!--Input Email-->
									<div class="input-field">
										<input type="email" name="correo" title="Correo electrónico" id="correo" value="<?php echo $_SESSION['correo'] ?>">
										<label for="correo">Correo Electrónico</label>
									</div>

									<!--Botón de envió-->
									<button type="submit" class="btn black">Editar <i class="material-icons">send</i></button>
							</form>
					</div>
					<div id="pass">
						<!--FORMULARIO CAMBIAR PASSWORD-->
						<form class="form" action="up_pass.php" method="post" enctype="multipart/form-data">

							<!--Input Password 1-->
							<div class="input-field">
								<input type="password" name="pass1" title="CONTRASEÑA CON NÚMEROS, LETRAS MAYÚSCULAS Y MINÚSCULAS ENTRE 8 Y 15 CARACTERES" pattern="[A-Za-z0-9]{8,15}" id="pass1" required>
								<label for="pass1">Contraseña:</label>
							</div>

							<!--Input Password 2-->
							<div class="input-field">
								<input type="password" title="CONTRASEÑA CON NÚMEROS, LETRAS MAYÚSCULAS Y MINÚSCULAS ENTRE 8 Y 15 CARACTERES" pattern="[A-Za-z0-9]{8,15}" id="pass2" required>
								<label for="pass2">Verificar Contraseña:</label>
							</div>

							<!--Botón de envió-->
							<button type="submit" class="btn black" id="btn_guardar">Editar <i class="material-icons">send</i></button>
						</form>
					</div>
				</div>
  			</div>
		</div>
	</div>
		
	<?php include '../extend/scripts.php'; ?>
	<script src="../js/validacion.js"></script>
	</body>
</html>