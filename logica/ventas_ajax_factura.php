<?php 
ob_start();
include("../config/conexion.php");

$fecha_desde = $_POST["fecha_desde"];
$fecha_hasta = $_POST["fecha_hasta"];
$tipo = $_POST["tipo"];

	/* Verificamos que el usuario que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM `facturas` WHERE `fecha` BETWEEN  '$fecha_desde' AND '$fecha_hasta' AND `tipo_factura`='$tipo' ";
	$myArray = array();
	if ($result =$conexion->query($consulta))
	{
		 while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
	    }
	    echo json_encode($myArray);
	}
 ?>