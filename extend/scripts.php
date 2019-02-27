	</main>
	<!--Dependencias de Jquery-->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
  	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  	crossorigin="anonymous">
	</script>
	<!--Dependencias de Material Design-->
	<script src="../js/materialize.min.js"></script>
  	<!--Dependencias de Sweet Alert-->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js"></script>
	<!--Script de SideNav-->
	<script>
		//SCRIPT PARA FILTRAR BUSCADOR:
		$('#buscar').keyup(function(event)
		{
			//La busqueda será sensible a mayúsculas y minúsculas
			//RegExp = nueva expresión regular
			var contenido = new RegExp($(this).val(), 'i'); //i = comodin
			$('tr').hide();
			$('tr').filter(function(){
				return contenido.test($(this).text());
			}).show();
			//código que fixea las cabeceras desaparecidas en la busqueda
			$('.cabecera').attr('style','');
		});


		//inicializaciones:
		$('.button-collpase').sideNav();
		$('select').material_select();
		//inicialización de datapicker de materialize:
		$('.datepicker').pickadate({
			format: 'yyyy-m-d',
   		selectMonths: true, // Creates a dropdown to control month
    		selectYears: 15 // Creates a dropdown of 15 years to control year,
  		});


		//función para formularios de registro, que transforma los caracteres a mayúsculas obligatoriamente.
		function may(obj, id)
		{
			obj = obj.toUpperCase();
			document.getElementById(id).value = obj;
		}

	</script>
	
