<?php 
ob_start();
include("../config/conexion.php");

$id = $_POST["id_checkin"];

	/* Verificamos que el usuario que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM `check_in` WHERE id='$id' ";
	$ejecutar_consulta = $conexion->query($consulta);
	$row = mysqli_fetch_array($ejecutar_consulta);
	echo json_encode($row);  
 ?>