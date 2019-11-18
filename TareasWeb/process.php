<?php
   include 'tarea.php';

	$tarea = $_POST['tarea'];
	$cedula = json_decode(file_get_contents("cedula.json"))->dato;
   
   if($tarea !== ''){
       AgregarTarea($cedula,$tarea);
   }

	function AgregarTarea($cedula,$tarea){
   	$arr_tareas = cargarDatosActuales($cedula);
      $fecha = date('d')."-".(date('m')-1)."-".date('Y');
   	$tar = new Tarea($tarea,$fecha,'1');
      $arr_tareas[]=$tar;
   	$path = "archivosJson/";
   	$json_string = json_encode($arr_tareas);
   	$file = $path.$cedula.".json";
   	file_put_contents($file, $json_string);
   }

	function cargarDatosActuales($cedula){
		$path = "archivosJson/";
   	$file = $path.$cedula.".json";
   	$json = file_get_contents($file);
   	$tareas = json_decode($json, true);
   	return $tareas;
   }

?>