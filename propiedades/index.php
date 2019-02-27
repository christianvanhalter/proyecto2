<?php include '../extend/header.php'; 

/*DEL BOTÓN DEL MENU DE ADMINISTRADOR NOS ENVÍAN UN PARAMETRO POR MÉTODO GET, 
QUE USAREMOS PARA MOSTRAR UNA LISTA FILTRADA DE LAS 'PROPIEDADES'
*/
$operacion = $con->real_escape_string(htmlentities($_GET['ope']));
?>

<br>
<!--Buscador-->
<div class="row">
	<div class="col s12">
		<nav class="brown lighten-3">
			<div class="nav-wrapper">
				<div class="input-field">
					<input type="search" id="buscar" autocomplete="off" >
					<label for="buscar"><i class="material-icons">search</i></label>
					<i class="material-icons">close</i>
				</div>
			</div>
		</nav>
	</div>
</div>



<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Propiedades</span>
        <table>
          <thead>
            <tr class="cabecera">
              <th>Vista</th>
              <th>Num</th>
              <th>Cliente</th>
              <th>Propiedad</th>
              <th>Precio</th>
              <th>Credito</th>
              <th>Asesor</th>
              <th>Tipo</th>
              <th>Operacion</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <?php
          $sel = $con->prepare("SELECT propiedad, consecutivo,nombre_cliente,calle_num,fraccionamiento,estado,municipio,precio,forma_pago,asesor,tipo_inmueble,operacion FROM inventario WHERE estatus = 'ACTIVO' AND operacion = ? ");
          $sel->bind_param('s', $operacion);
          $sel->execute();
          $res = $sel->get_result();
          while ($f =$res->fetch_assoc()) {?>
            <tr>
              <td class="borrar"><button data-target="modal1" onclick="enviar(this.value)" class="btn-floating" 
              	value="<?php echo $f['propiedad'] ?>" class="btn modal-trigger"><i class="material-icons">visibility</i></button></td>
              <td><?php echo $f['consecutivo'] ?></td>
              <td><?php echo $f['nombre_cliente'] ?></td>
              <td><?php echo $f['calle_num'].' '.$f['fraccionamiento'].' '.$f['estado'].' ,'.$f['municipio'] ?></td>
              <td><?php echo "$" . number_format($f['precio'], 2) ?></td>
              <td><?php echo $f['forma_pago'] ?></td>
              <td><?php echo $f['asesor'] ?></td>
              <td><?php echo $f['tipo_inmueble'] ?></td>
              <td><?php echo $f['operacion'] ?></td>
              <td>OPCIONES</td>
            </tr>
          <?php }
          $sel->close();
          $con->close();
           ?>
        </table>
      </div>
    </div>
  </div>
</div>

<!--ESTRUCTURA PARA VENTANA MODAL-->
<!-- Modal Structure -->
<div id="modal1" class="modal">
	<div class="modal-content">
		<h4>Información</h4>
		<div class="res_modal">
			<!--CLASS="res_modal" es para utilizar en AJAX-->
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>


<?php include '../extend/scripts.php'; ?>
<script>
	//script de inicialización ventana modal
    $('.modal').modal();

   //AJAX ventana modal:
   function enviar(valor){
	$.get('modal.php',{
		id:valor,

		beforeSend: function(){
			$('.res_modal').html("Espere un momento por favor..");
		}

	}, function(respuesta){
		$('.res_modal').html(respuesta); //.res_estado (es un div en 'alta_propiedades.php')
	});
}
</script>
</body>
</html>