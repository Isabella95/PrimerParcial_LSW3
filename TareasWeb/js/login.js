$(document).ready(function() {
	$('#btnEnviar').click(function(){
		var texto = $('#formulario').serialize();
		$.ajax({
			url: 'procesarDatos.php',
			type: 'POST',
			data: texto,
			success: function(response){
				alert("Dato almacenado");
			}
		});
	})
});

