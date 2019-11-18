<?php
   include 'tarea.php';
   
   $cedula = json_decode(file_get_contents("cedula.json"))->dato;

   if(buscarArchivoJson($cedula)==FALSE){
   		crearArchivoJson($cedula);
   } 

   function traerTareas($cedula){
   	 $array;
   	 if(buscarArchivoJson($cedula)==TRUE){
   	 	$json = file_get_contents('./archivosJson/'.$cedula.'.json');
   	 	$j=0;
   	 	$tareas = json_decode($json,true);
      $c = count($tareas);
   	 	for($i=0; $i<$c; $i++){
   			$m = Tarea::crearTarea($tareas[$i]);
   			$array[$j]=$m;
   			$j++;
   		}
   	 }
   	return $array;
   }


   function mostrarTareas($cedula){
   		$array = traerTareas($cedula);
   		$style = "text-success";
   		?>
        <div name="container">
        <table id="tabla" class="table-bordered bg-white border-dark" align="center"><tbody>
      <?php
   		echo '<thead>';
   		echo '<tr  align="center">';
        echo '<td style="font-size:4.5em" class="text-info"><b>Check</b></td>';
        echo '<td style="font-size:4.5em" class="text-info"><b>Nombre</b></td>';
        echo '<td style="font-size:4.5em" class="text-info"><b>Fecha de Creacion</b></td>';
        echo'</tr>';
        echo'</thead>';
  		$j=0;
  		while($j<count($array)){
  			if($array[$j]->getEstado()==0){
  				?>
  				<tr class='<?php $style ?>' style="font-size:4.5em">
  				<?php
  					  echo '<td><label id="celda"><input id="check" type="checkbox" value="" checked></label></td>';
  				    echo '<td><label id="celda"><del class="text-muted">'.$array[$j]->getNombre().'</del></label></td>';
  				    echo '<td><label id="celda"><del class="text-muted">'.$array[$j]->getFechaCreacion().'</del></label></td>';
  			    ?></tr><?php
  			}else{
  				?>
  				<tr class='<?php $style ?>' style="font-size:4.5em" onclick="this.add.Class='tachado' <?php $v=0;?>">
  				<?php 
  					echo '<td><label id="celda"><input id="check" type="checkbox" value=""></label></td>';
  					echo '<td><label id="celda" class="text-dark">'.$array[$j]->getNombre().'</label></td>';
  					echo '<td><label id="celda" class="text-dark">'.$array[$j]->getFechaCreacion().'</label></td>';
  				?></tr><?php
  		     }
  			$j++;
  		}
  		?></tbody></div><?php
   }

   function crearTareaPorDefecto(){
   		$json = file_get_contents("tareas.json");
   		$array;

   		$tareas = json_decode($json, true);

   		for($i=0; $i<=1; $i++){
   			$m = Tarea::crearTarea($tareas[$i]);
   			$array[$i]=$m;
   		}
   		return $array;
   }

   function crearArchivoJson($cedula){
   		  $arr_tareas = crearTareaPorDefecto();
   	    $path = "archivosJson/";
   	    $json_string = json_encode($arr_tareas);
   	    $file = $path.$cedula.".json";
   	    file_put_contents($file, $json_string);
   }

   function buscarArchivoJson($cedula){
   		$flag = FALSE;
   		$host = $_SERVER["HTTP_HOST"];
   		$path = '../TareasWeb/archivosJson';


   		$files = array_diff(scandir($path), array('.','..'));

   		foreach($files as $filed){
   			$data = explode(".",$filed);

   			if(!empty($data[1])){
   				$filename = $data[0];
   				$extension = $data[1];

   				if($extension == 'json'){
   					if($cedula == $filename){
   						$flag = true;
   						break;
   					}
   				} 
   			}
   		}
   	return $flag;
   }

?>


<!DOCTYPE html>
<html>
<head>
	<title>Tareas</title>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $('#btnAgregar').click(function(e){
    var texto = $('#nuevaTarea').serialize();
    var fecha = new Date();
    $.ajax({
      url: 'process.php',
      type: 'POST',
      data: texto,
      success: function(response){
        alert(texto);
        var dato = $('#nuevaTarea').serialize();
        var fila = '<tr><td id="celda" style="font-size:4.5em" class="text-info"><label><input id="check" type="checkbox" value=""></label></td><td style="font-size:4.5em" class="text-info"><label id="celda">'+dato+'</label></td><td style="font-size:4.5em" class="text-info"><label id="celda">'+fecha.getDate()+'-'+(fecha.getMonth()+1)+'-'+fecha.getFullYear()+'</label></td></tr>';
        $('#tabla').append(fila);
      }
    });
  })
});
</script>

 <style> 
  .tachado{
    text-decoration: line-through;
  }
 </style>
</head>
<body>
	<nav class="navbar bg-info ml-auto">
	<h2 class="text-light" id="userid" name="userid" type="text">Tu codigo: <?php echo $cedula;?></h1>
	<h2 class="text-light font-weight-bold">¡Bienvenido a tu Agenda Personal!</h2>;
	  <div class="form-inline">
	  	 <button type="submit" class="btn-lg btn-light font-weight-bold my-2 my-sm-0"><a href="index.html" class="text-dark">Cerrar Sesion</a></button>
	  </div>
    </nav>
    <div class="jumbotron bg-white">
	<h1 class="text-info font-weight-bold" style="font-size: 4em"> Lista de Tareas </h1>
</div>

	<form class="form-group" id="nuevaTarea" name="nuevaTarea" method="post" align="center">
    <p>
        <label class="text-center mr-sm-2"><h4>Tarea:</h4></label>
        <input type="text" class="form-control-lg font-weight-bold  mr-sm-2"  id="tarea" name="tarea">
        <button type="button" class="btn-lg btn-info text-light font-weight-bold mr-sm-2"
        id="btnAgregar" name="btnAgregar">
          Agregar
        </button>
    </p>
				
		</form>

	<div class="jumbotron-fluid text-center m-lg-5 mr-5 bg-faded">
		<?php
			   mostrarTareas($cedula);
		?>
	</div>
</body>
</html>