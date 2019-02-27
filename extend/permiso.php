<?php
if ($_SESSION['nivel'] != 'ADMINISTRADOR')
{
	//si no eres administrador, te bloqueará el sistema al ingresar a un módulo (usuarios) de admin sin ser admin
	header("location:bloqueo.php");
}

?>