//script del método AJAX para el nick
$('#estado').change(function(){
	$.post('ajax_muni.php',{
		estado:$('#estado').val(),

		beforeSend: function(){
			$('.res_estado').html("Espere un momento por favor..");
		}

	}, function(respuesta){
		$('.res_estado').html(respuesta); //.res_estado (es un div en 'alta_propiedades.php')
	});
});