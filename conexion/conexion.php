<?php @session_start();
//myqli('ruta','user','password','BD')
$con = new mysqli('localhost','root', '','inmobiliaria');
//PARA MOSTRAR LAS TILDES &iacute de la BD:
$con -> set_charset("utf8");

?>