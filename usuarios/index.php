		<?php include '../extend/header.php'; 

		//incluimos permiso.php
		include '../extend/permiso.php';
		
		?>
		<div class="row">
			<div class="col s12">
				<div class="card">
						<div class="card-content">
							<span class="card-title">Alta de usuarios</span>
							<form class="form" action="ins_usuarios.php" method="post" enctype="multipart/form-data">
								
								<!--Input Nick-->
								<div class="input-field">
									<input type="text" name="nick" required autofocus title="DEBE DE CONTENER ENTRE 8 Y 15 CARACTERES, SÓLO LETRAS" pattern="[A-Za-z]{8,15}" id="nick" onblur="may(this.value, this.id)">
									<label for="nick">Nick:</label>
								</div>

								<!--Validación de usuario en BD con AJAX (si existe el nick)-->
								<div class="validacion"></div>

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

									<!--esta etiqueta no es visible si no se inicializa en el archivo scripts.php-->
									<select name="nivel" required>
										<option value="" disabled selected>ELIGE UN NIVEL DE USUARIO</option>
										<option value="ADMINISTRADOR">ADMINISTRADOR</option>
										<option value="ASESOR">ASESOR</option>
									</select>
									
									<!--Input Nombre (con pattern de letras de A a la Z permitiendo espacios-->
									<div class="input-field">
										<input type="text" name="nombre" title="Nombre del usuario" id="nombre" onblur="may(this.value, this.id)" required pattern="[A-Z/s ]+">
										<label for="nombre">Nombre completo del usuario:</label>
									</div>

									<!--Input Email-->
									<div class="input-field">
										<input type="email" name="correo" title="Correo electrónico" id="correo">
										<label for="correo">Correo Electrónico</label>
									</div>

									<!--Input Foto[img]-->
									<div class="file-field input-field">
										<div class="btn">
											<span>Foto:</span>
											<input type="file" name="foto">
										</div>
										<div class="file-path-wrapper">
											<input class="file-path validate" type="text">
										</div>
									</div>

									<!--Botón de envió-->
									<button type="submit" class="btn black" id="btn_guardar">Guardar <i class="material-icons">send</i></button>
							</form>
						</div>
		 		</div>
			</div>
		</div>
		<!--FIN DEL FORMULARIO-->


		<!--BUSCADOR DE CONTENIDO DE NUESTRA TABLA USUARIOS-->
		<div class="row">
			<div class="col s12">
				<nav class="brown lighten-3">
					<div class="nav-wrapper">
						<div class="input-field">
							<!--autocomplete off= para que no recuerde nada de lo que ha buscado-->
							<input type="search" id="buscar" autocomplete="off">
							<label for="buscar"><i class="material-icons">search</i></label>
							<i class="material-icons">close</i>
						</div>
					</div>
				</nav>
			</div>
		</div>
		<!--FIN BUSCADOR DE CONTENIDO DE NUESTRA TABLA USUARIOS-->


		<!--MOSTRAR DATOS DESDE BD:-->
		<?php 
			$sel = $con->query("SELECT * FROM usuario"); 
			$row = mysqli_num_rows($sel);
		?>

		<div class="row">
			<div class="col s12">
				<div class="card">
						<div class="card-content">
							<span class="card-title">LISTADO DE USUARIOS (<?php echo $row ?>)</span>
							<table>
								<thead>
									<tr class="cabecera">
									<th>Nick</th>
									<th>Nombre</th>
									<th>Correo</th>
									<th>Nivel</th>
									<th></th><!--espacio para editar-->
									<th>Foto</th>
									<th>Bloqueo</th>
									<th>Eliminar</th><!--espacio para eliminar-->
									</tr>
								</thead>
								<?php while($f = $sel->fetch_assoc()){ ?>
									<tr>
										<td><?php echo $f['nick'] ?></td><!--['campo de BD']-->
										<td><?php echo $f['nombre'] ?></td><!--['campo de BD']-->
										<td><?php echo $f['correo'] ?></td><!--['campo de BD']-->
										<td>
											<!--Formulario campo nivel-->
											<form action="up_nivel.php" method="post">
												<input type="hidden" name="id" value="<?php echo $f['id'] ?>">

												<!--esta etiqueta no es visible si no se inicializa en el archivo scripts.php-->
												<select name="nivel" required>
													<option value="<?php echo $f['nivel'] ?>"><?php echo $f['nivel'] ?></option>
													<option value="ADMINISTRADOR">ADMINISTRADOR</option>
													<option value="ASESOR">ASESOR</option>
												</select>
										</td><!--['campo de BD']-->
										<td>
											<button type="submit" class="btn-floating"><i class="material-icons">repeat</i></button>
											</form>
										</td>
										<td><img src="<?php echo $f['foto'] ?>" width="50" class="circle"></td><!--['campo de BD']-->
										<td>
											<!--Preguntamos por si el usuario esta bloqueado(0) o activo(1)-->
											<?php if ($f['bloqueo'] == 1): ?>
												<a href="bloqueo_manual.php?us=<?php echo $f['id'] ?>&bl=<?php echo $f['bloqueo'] ?>"><?php echo $f['bloqueo'] ?><i class="material-icons green-text">lock_open</i></a>
											<?php else: ?>
												<a href="bloqueo_manual.php?us=<?php echo $f['id'] ?>&bl=<?php echo $f['bloqueo'] ?>"><?php echo $f['bloqueo'] ?><i class="material-icons red-text">lock_outline</i></a>
											<?php endif ?>
										</td><!--['campo de BD']-->
										<td>
											<!--Botón eliminar-->
											<a href="#" class="btn-floating red" onclick="swal({ title: 'Esta seguro que desea eliminar al usuario?', text: 'Al eliminarlo no podrá recuperarlo!', type: 'warning', showCancelButton: true,confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminarlo' }).then(function() {
												location.href='eliminar_usuario.php?id=<?php echo $f['id'] ?>'; })"><i class="material-icons">clear</i></a>
										</td><!--espacio para eliminar-->
									</tr>
								<?php } ?>
							</table>
						</div>
		 		</div>
			</div>
		</div>
		<!--FIN MOSTRAR DATOS DESDE BD:-->
		
		<?php include '../extend/scripts.php'; ?>
		<script src="../js/validacion.js"></script>
	</body>
</html>