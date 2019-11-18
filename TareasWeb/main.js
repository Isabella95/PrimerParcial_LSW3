$(document).ready(function(){
	$('#btnAgregar').click(function(e){
		var texto = $('#nuevaTarea').serialize();
		$.ajax({
			url: 'process.php',
			type: 'POST',
			data: texto,
			success: function(response){
				alert(texto);
			}
		});
	})
});