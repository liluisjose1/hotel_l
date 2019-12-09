<?php 
ob_start();
include("../config/conexion.php");

$cod_hab = $_POST["cod_hab"];

	/* Verificamos que el usuario que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM habitaciones WHERE codigo='$cod_hab'";
	$ejecutar_consulta = $conexion->query($consulta);
	$row = mysqli_fetch_array($ejecutar_consulta);
	echo json_encode($row);  
 ?>