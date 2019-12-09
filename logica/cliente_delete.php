<?php 
ob_start();
include("../config/conexion.php");

$cliente_id = $_POST["id_user"];

$sql = "DELETE FROM `clientes` WHERE `id`='$cliente_id'";
		$ejecutar_consulta = $conexion->query(($sql));
		print($sql);
			if($ejecutar_consulta){
				header("Location: ../cliente_registro.php?error=no_d");
			}
			else{
				header("Localtion: ../cliente_registro.php?error=si");
			}

 ?>