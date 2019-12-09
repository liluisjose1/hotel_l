<?php 
ob_start();
include("../config/conexion.php");

$codigo_hab = $_POST["codigo_hab"];

$sql = "DELETE FROM `habitaciones` WHERE `codigo`='$codigo_hab'";
		$ejecutar_consulta = $conexion->query(($sql));
		print($sql);
			if($ejecutar_consulta){
				header("Location: ../h_registro.php?error=no_d");
			}
			else{
				header("Localtion: ../h_registro.php?error=si");
			}

 ?>