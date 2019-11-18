<?php
	$dato = $_POST['cedula'];
	$objeto = json_decode(file_get_contents("cedula.json"));
	$objeto->dato = $dato;
	file_put_contents("cedula.json",json_encode($objeto));
?>