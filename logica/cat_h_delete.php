<?php 
ob_start();
include("../config/conexion.php");

$id = $_GET["id_cat"];

$sql = "DELETE FROM `cat_habitaciones` WHERE `id`='$id'";
		$ejecutar_consulta = $conexion->query(($sql));
		print($sql);
			if($ejecutar_consulta){
				header("Location: ../h_cat.php?error=no_d");
			}
			else{
				header("Localtion: ../h_cat.php?error=si_");
			}

 ?>