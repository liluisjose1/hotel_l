<?php 
ob_start();
include("../config/conexion.php");


$nombre = $_POST["nombre"];
//$date = Date("Y-m-d");


	/* Verificamos que el nombre que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM cat_habitaciones WHERE nombre='$nombre'";
	$ejecutar_consulta = $conexion->query($consulta);
	$num_regs = $ejecutar_consulta->num_rows;

	/*Si no hay registros, el nombre no existe. */
	if($num_regs==0){

			/* Si coinciden, guardamos la información en nuestra base de datos. */
			$consulta = "INSERT INTO  `cat_habitaciones`(`nombre`) VALUES ('$nombre')";
			$ejecutar_consulta = $conexion->query(($consulta));
			
			/* Si se ejecutó la consulta, redirigimos al archivo del formulario con una clave de que se ejecutó correctamente. */
			if($ejecutar_consulta){
				header("Location: ../h_cat.php?error=no");
			}
		
	}
	/* Si existen registros, indicamos que el nombre a crear ya existe. */
	else{
			header("Localtion: ../h_cat.php?error=si");
		}
 ?>