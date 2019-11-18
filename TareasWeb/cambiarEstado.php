<?php
  include 'tarea.php';
  $cedula = json_decode(file_get_contents("cedula.json"))->dato;



function cambiarEstado1($cedula,$nomTarea){
        $arr_tareas = cambiarEstado2($cedula,$nomTarea);
        $path = "archivosJson/";
        $json_string = json_encode($arr_tareas);
        $file = $path.$cedula.".json";
        file_put_contents($file, $json_string);
  }

  function cambiarEstado2($cedula,$nomTarea){
        $path = "archivosJson/";
        $file = $path.$cedula.".json";
        $json = file_get_contents($file);
        $array;
        $tareas = json_decode($json, true);

        for($i=0; $i<=1; $i++){
           if ($tareas[$i]['nombre'] == $nomTarea) {
                 if ($tareas[$i]['estado'] == '0') {
                       $tareas[$i]['estado'] = "1";
                 }else{
                       $tareas[$i]['estado'] = "0";
                 }
           }
           $m = Tarea::crearTarea($tareas[$i]);
           $array[$i]=$m;
        }
        return $array;
  }

?>