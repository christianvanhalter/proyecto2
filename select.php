<?php

//DOCUMENTO CON: SENTENCIAS PREPARADAS (SÓLO APRENDISAJE):


/*PRIMERA FORMA PARA HACER SELECT*/
//CONSULTA PREPARADA SELECT
$id = 1;

$sel = $con->prepare("SELECT * FROM mitabla WHERE id = ? ");
$sel -> bind_param('i',$id);
$sel -> execute();
$res = $sel->get_result();

?>

<!--mostrar resultados en un while:-->
<table>
	<th>id estado</th>
	<th>nombre estado</th>
	
	<?php while ($f = $res->fetch_assoc()) { ?>
	<tr>
		<td><?php echo $f['id'] ?></td>
		<td><?php echo $f['estado'] ?></td>
		<th>Estado</th>
	</tr>
	<?php } 
	$sel->close(); //se cierra la consulta.
	$con->close(); //se cierra la conexión.
	?>
</table>



<?php
/*SEGUNDA FORMA PARA HACER SELECT*/
//CONSULTA PREPARADA SELECT
$id = 1;

$sel = $con->prepare("SELECT id,estado FROM mitabla WHERE id = ? ");
$sel -> bind_param('i',$id);
$sel -> execute();
$sel->bind_result($id,$estado); //se utiliza bind_result(); en vez de get_result();

?>

<!--mostrar resultados en un while:-->
<table>
	<th>id estado</th>
	<th>nombre estado</th>
	
	<?php while ($sel->fetch()) { ?>
	<tr>
		<td><?php echo $id['id'] ?></td> <!--Se accede a los valores por medio de las variables especificadas en bind_result()-->
		<td><?php echo $estado['estado'] ?></td>
		<th>Estado</th>
	</tr>
	<?php } 
	$sel->close(); //se cierra la consulta.
	$con->close(); //se cierra la conexión.
	?>
</table>

<?php  

//diferencias entre get_result y bind_result:

/*
- En bind_result:
	Se deben mandar a llamar todos los campos de la tabla que vayamos a utilizar en el SELECT.
	No se puede utilizar SELECT * FROM.

	Y deben ser especificados cada campo dentro del método bind_result();

- En get_result:
	Se puede utilizar un SELECT ALL (Select * from tabla)
	Y te pueden traer con el fetch_assoc()

	DESVENTAJA de get_result()
	- la instrucción get_result() requiere de una librería llamada mysqlnd, la cual es difícil encontrarla instalada en los HOSTING GRATUITOS O DE PAGO.
	Para utilizarla se podría utilizar un VPS (servidor virtual privado) o un SERVIDOR DEDICADO

	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	//IDEAL QUE NUESTRO PROYECTO A MEDIDA SEA ALOJADO EN UN VPS O UN SERVIDOR DEDICADO (PARA CLIENTES DE MEDIA EMBERGADURA O MÁS)
	de ser así, podemos utilizar el método 'get_result' en todo el proyecto.

	PERO SI EL PROYECTO ES PEQUEÑO Y LO QUIEREN PROBAR EN UN HOSTING GRATUITO:
	utilizen 'bind_result()'


	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	EL PROYECTO ACTUAL UTILIZARÁ: GET_RESULT
	PORQUE: LA SINTAXIS MÁS CÓMODA ES GET_RESULT Y LA MÁS COMÚN PARA TRABAJAR.

	PERO AL MOMENTO DE SUBIR A UN HOSTING SE DEBERÁ TRABAJAR CON 'bind_result()'

*/

?>