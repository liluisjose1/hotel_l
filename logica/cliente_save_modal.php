<?php 
ob_start();
include("../config/conexion.php");

$hab = $_POST["hab"];
$nombre = $_POST["nombre"];
$doc = $_POST["doc"];
$tel = $_POST["tel"];
$date = Date("Y-m-d");


	/* Verificamos que el usuario que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM clientes WHERE doc='$doc'";
	$ejecutar_consulta = $conexion->query($consulta);
	$num_regs = $ejecutar_consulta->num_rows;

	/*Si no hay registros, el usuario no existe. */
	if($num_regs==0){

			/* Si coinciden, guardamos la información en nuestra base de datos. */
			$consulta = "INSERT INTO  `clientes`( `nombre`, `doc`, `tel`,`estado`,`fecha`,`hospedado`) VALUES ('$nombre','$doc','$tel','1','$date','0')";
			print($consulta);
			$ejecutar_consulta = $conexion->query(($consulta));
			
			/* Si se ejecutó la consulta, redirigimos al archivo del formulario con una clave de que se ejecutó correctamente. */
			if($ejecutar_consulta){
				header("Location: ../chekin_save.php?id_h=$hab");
			}
		
	}
	/* Si existen registros, indicamos que el usuario a crear ya existe. */
	else{
			header("Localtion: ../chekin_save.php?id_h=$hab");
		}
 ?>