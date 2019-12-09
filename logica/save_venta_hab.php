<?php 
ob_start();
include("../config/conexion.php");

$id_cliente = $_POST["id_cliente1"];
$fecha_ingreso = $_POST["fecha_ingreso"];

$fecha = date("Y-m-d");

$query_checkin="SELECT * FROM `check_in` WHERE id_cliente='$id_cliente' AND fecha_ingreso='$fecha_ingreso' ";
print($query_checkin);
$ejecutar_consulta_chekin = $conexion->query(($query_checkin));

while($reg3 = $ejecutar_consulta_chekin->fetch_assoc()){
	$id_hab =$reg3["id_hab"];
	$p_dia  =$reg3["p_dia"];
	$dias   =$reg3["dias"];
	//IVA
	//$iva    = ($p_dia*$dias)*0.13;
	//$total  = ($p_dia*$dias)*1.13;
	
	$total  = ($p_dia*$dias)*1.00;
			//Query con IVA	
			//$consulta = "INSERT INTO `ventas_hab`(`id_cliente`, `id_hab`, `p_dia`, `dias`, `iva`, `total`, `fecha`) VALUES ('$id_cliente','$id_hab','$p_dia','$dias','$iva','$total','$fecha')";
			$consulta = "INSERT INTO `ventas_hab`(`id_cliente`, `id_hab`, `p_dia`, `dias`, `total`, `fecha`) VALUES ('$id_cliente','$id_hab','$p_dia','$dias','$total','$fecha')";
			
			$ejecutar_consulta = $conexion->query(($consulta));

			$sql_clientes= "UPDATE `clientes` SET `hospedado`='0' WHERE `id`='$id_cliente'";
			$ejecutar_consulta_cliente = $conexion->query(($sql_clientes));

			$sql_habitacion= "UPDATE `habitaciones` SET `ocupada`='1' WHERE `codigo`='$id_hab'";
			$ejecutar_consulta_habitacion = $conexion->query(($sql_habitacion));

			$sql_checkin= "UPDATE `check_in` SET `pagado`='1' WHERE `id_cliente`='$id_cliente' AND `fecha_ingreso`='$fecha_ingreso'";
			$ejecutar_consulta_chek = $conexion->query(($sql_checkin));

			print($consulta);
			if($ejecutar_consulta && $ejecutar_consulta_cliente && $ejecutar_consulta_habitacion && $ejecutar_consulta_chek ){
				header("Location: ../check_out.php?error=no");
			}
			else{
				header("Localtion: ../check_out.php?error=si");
			}

}
 ?>