<?php 
ob_start();
include("../config/conexion.php");

$id_cliente = $_POST["id_cliente"];
$cod_h = $_POST["hab"];
$pu = $_POST["pu"];
$dias= $_POST["dias"];
$date= $_POST["fecha_ingreso"];


			$consulta = "INSERT INTO `check_in`( `id_cliente`, `id_hab`, `p_dia`, `dias`, `fecha_ingreso`,`pagado`) VALUES('$id_cliente','$cod_h','$pu','$dias','$date','0')";
			
			$ejecutar_consulta = $conexion->query(($consulta));

			$sql_clientes= "UPDATE `clientes` SET `hospedado`='1' WHERE `id`='$id_cliente'";
			$ejecutar_consulta_cliente = $conexion->query(($sql_clientes));

			$sql_habitacion= "UPDATE `habitaciones` SET `ocupada`='0' WHERE `codigo`='$cod_h'";
			$ejecutar_consulta_habitacion = $conexion->query(($sql_habitacion));

			print($consulta);
			if($ejecutar_consulta && $ejecutar_consulta_cliente && $ejecutar_consulta_habitacion ){
				header("Location: ../check_in.php?error=no");
			}
			else{
					header("Localtion: ../check_in.php?error=si");
				}
 ?>