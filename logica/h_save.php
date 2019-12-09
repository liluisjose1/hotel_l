<?php 
ob_start();
include("../config/conexion.php");

$codigo = $_POST["cod_hab"];
$descripcion = $_POST["descripcion"];
$tipo = $_POST["tipo"];
$n_personas= $_POST["n_personas"];
$activo= $_POST["activo"];
$date = Date("Y-m-d");


	/* Verificamos que el usuario que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM habitaciones WHERE codigo='$codigo'";
	$ejecutar_consulta = $conexion->query($consulta);
	$num_regs = $ejecutar_consulta->num_rows;

	/*Si no hay registros, el usuario no existe. */
	if($num_regs==0){

			/* Si coinciden, guardamos la información en nuestra base de datos. */
			$consulta = "INSERT INTO  `habitaciones`(`codigo`, `descripcion`, `tipo`, `n_personas`,`estado`,`fecha`,`ocupada`) VALUES ('$codigo','$descripcion','$tipo','$n_personas','$activo','$date','1')";
			print($consulta);
			$ejecutar_consulta = $conexion->query(($consulta));
			
			/* Si se ejecutó la consulta, redirigimos al archivo del formulario con una clave de que se ejecutó correctamente. */
			if($ejecutar_consulta){
				header("Location: ../h_registro.php?error=no");
			}
		
	}
	/* Si existen registros, indicamos que el usuario a crear ya existe. */
	else{
			header("Localtion: ../h_registro.php?error=si");
		}
 ?>