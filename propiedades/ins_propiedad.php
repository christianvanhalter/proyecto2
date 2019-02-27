<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	//RECORRER VARIABLES DE UN FORMULARIO DE INGRESO DE PROPIEDAD CON UN FOREACH:
	foreach ($_POST as $campo => $valor) 
	{
		$variable= "$" . $campo . "='" . htmlentities($valor) . "';"; 
		//esto es igual a lo siguiente:
		//$nombre = htmlentities($_POST['nombre']);
		//PARA QUE ESTE FOREACH FUNCIONE, NECESITAMOS DEL SIGUIENTE MÉTODO (eval)
		//QUE HACE QUE TRANSFORME ESTE CÓDIGO CONCATENADO EN TEXTO VALIDO PARA PHP
		eval($variable);
	}
	//SELECTOR DE ESTADO POR EL AJAX DE ESTADOS EN EL FORMULARIO:
	$sel = $con->prepare("SELECT estado FROM estados WHERE idestados = ? ");
	$sel->bind_param('i', $estado);
	$sel->execute();
	$res = $sel->get_result();

	if ($f = $res->fetch_assoc()) 
	{
		$nombre_estado = $f['estado']; //$nombre_estado= VA EN EL INSERT DE NUEVO ESTADO EN LA BD
	}

	//OTROS DATOS QUE ENVIAMOS A LA BD:
	$id = sha1(rand(00000, 99999)); //un número random para las propiedades, porque su PK es un VARCHAR
	$consecutivo = ''; //numero para ordenar las propiedades
	$foto_principal = "casas/foto_principal.png";
	$mapa = $calle_num . " " . $fraccionamiento . " " . $nombre_estado . ", " . $municipio; //concatenación para googlemap
	$marcado = '';
	$estatus = 'ACTIVO'; //para dar de baja o eliminar la Propiedad

	//INSERT DE PROPIEDADES CON LOS DATOS ANTERIORES ADEMÁS DE LOS QUE VINIERON POR FORMULARIO EN METODO POST
	$ins = $con->prepare("INSERT INTO inventario VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
	$ins->bind_param("siisssdssiiiisiiisssssssssss", $id,$consecutivo,$id_cliente,$nombre_estado,$municipio,$nombre_cliente,$precio,$fraccionamiento,$calle_num,$numero_int,$m2t,$banos,$plantas,$caracteristicas,$m2c,$recamaras,$cocheras,$observaciones,$forma_pago,$asesor,$tipo_inmueble,$fecha_registro,$comentario_web,$operacion,$foto_principal,$mapa,$marcado,$estatus);

	//IF para comprobar que funcione nuestra consulta:
	if ($ins->execute()) 
	{
		header('location:../extend/alerta.php?msj=Guardo Propiedad&c=prop&p=in&t=success');
	}
	else
	{
		header('location:../extend/alerta.php?msj=No guardo Propiedad&c=cli&p=in&t=error');
	}

	//$ins->execute(); ARN
	//$ins->close();





	$con->close();
}
else
{
	//Protección para que no intenten entrar por la URL
	header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}
?>