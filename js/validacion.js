			//script del método AJAX para el nick
			$('#nick').change(function(){
				$.post('ajax_validacion_nick.php',{
					nick:$('#nick').val(),

					beforeSend: function(){
						$('.validacion').html("Espere un momento por favor..");
					}

				}, function(respuesta){
					$('.validacion').html(respuesta);
				});
			});

			//oculta el botón de envío del formulario
			$('#btn_guardar').hide();

			//script para validar si las password son iguales
			$('#pass2').change(function(event){
				if ($('#pass1').val() == $('#pass2').val())
				{
					swal('Bien hecho...','Las contraseñas coinciden','success');
					$('#btn_guardar').show(); //muestra botón de envió si las password coinciden
				}
				else
				{
					swal('Oops...','Las contraseñas no coinciden','error');
					$('#btn_guardar').hide();
				}
			});


			//Desactivar el enter, para que no se envíe el formulario sin hacer click en el botón de 'Enviar'password
			$('.form').keypress(function(e)
				{
					if (e.which == 13)
					{
						return false;
					}
				});