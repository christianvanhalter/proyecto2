<?php @session_start(); 

//array de todas las sesiones que hayan, esto limpiará todas las variables.
$_SESSION = array();
session_destroy();
header("location:../");

?>