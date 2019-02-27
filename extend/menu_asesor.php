	<nav class="black">
		<!--Botón que muestra el sidenav-->
		<a href="" data-activates="menu" class="button-collpase"><i class="material-icons">menu</i></a>
	</nav>
	<!--id="menu" servirá para desplegarlo-->
	<ul id="menu" class="side-nav fixed">
		<li>
			<!--Desplegamos información del usuario-->
			<div class="userView">
				<div class="background">
					<img src="https://picsum.photos/g/400/300" alt="">
				</div>
				<!--foto de perfil-->
				<a href="../perfil/index.php"><img src="../usuarios/<?php echo $_SESSION['foto'] ?>" class="circle" alt=""></a>
				<a href="../perfil/perfil.php" class="white-text"><?php echo $_SESSION['nombre'] ?></a>
				<a href="#" class="white-text"><?php echo $_SESSION['correo'] ?></a>
			</div>
		</li>
		<!--Parte del menu-->

		<!--Link INICIO-->
		<li><a href="../inicio"><i class="material-icons">home</i>INICIO</a></li>
		<li><div class="divider"></div></li>
		
		<!--Link CLIENTES-->
		<li><a href="../clientes"><i class="material-icons">contact_phone</i>CLIENTES</a></li>
		<li><div class="divider"></div></li>

		<!--Link Dropdown a PROPIEDADES-->
		<!-- Dropdown Trigger -->
      <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">work</i>PROPIEDADES<i class="material-icons right">arrow_drop_down</i></a></li>
		<li><div class="divider"></div></li>

		<!--Link SALIR[cerrar sesión]-->
		<li><a href="../login/salir.php"><i class="material-icons">power_settings_new</i>SALIR</a></li>
		<li><div class="divider"></div></li>
	</ul>
	<!-- Dropdown Structure -->
	<ul id="dropdown1" class="dropdown-content">
  		<li><a href="../propiedades/index.php?ope=VENTA">VENTA</a></li>
	</ul>	