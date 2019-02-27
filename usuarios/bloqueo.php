<?php

//código de UPDATE que actualiza el estado de la cuenta: a bloqueada
include '../conexion/conexion.php';
$user = $_SESSION['nick'];

$up = $con->query("UPDATE usuario SET bloqueo=0 WHERE nick='$user' ");

if ($up) 
{
	//si la variable up nos da verdadero (se ejecuta la sentencia)
	$_SESSION = array();
	session_destroy();
	header('location:../extend/alerta.php?msj=USO INDEBIDO DEL SISTEMA&c=salir&p=salir&t=error');
}


?>