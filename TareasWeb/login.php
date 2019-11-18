<?php
	include 'tarea.php';

   if(buscarArchivoJson($_POST["cedula"])==FALSE){
         crearArchivoJson($_POST["cedula"]);
         echo 'Creamos nuevas tareas para este usuario';
   }else{
      echo 'Este usuario ya tiene tareas';
   }

   function crearTareaPorDefecto(){
         $json = file_get_contents('tareas.json'); 
   		$array;

   		$tareas = json_decode($json, true);

   		for($i=0; $i<=1; $i++){
   			$m = Tarea::crearTarea($tareas[$i]);
   			$array[$i]=$m;
   		}
         $tar = new Tarea('Sunguiar','18/09/2019','0');
         $j = 2;
         $array[$j]=$tar;
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
   		$path = '../AgendaWeb/archivosJson';


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