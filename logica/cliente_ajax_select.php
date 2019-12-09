<?php 
ob_start();
include("../config/conexion.php");

$id_cliente = $_POST["id_cliente"];
$fecha_ingreso = $_POST["fecha_ingreso"];

	/* Verificamos que el usuario que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM `check_in` WHERE id_cliente='$id_cliente' AND fecha_ingreso='$fecha_ingreso' ";
	$ejecutar_consulta = $conexion->query($consulta);
	$row = mysqli_fetch_array($ejecutar_consulta);
	echo json_encode($row);  
 ?>