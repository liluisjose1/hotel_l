<?php 
ob_start();
include("../config/conexion.php");

$codigo = $_POST["cod_hab"];
$descripcion = $_POST["descripcion"];
$tipo = $_POST["tipo"];
$n_personas= $_POST["n_personas"];
$activo= $_POST["activo"];



			/* Si coinciden, guardamos la información en nuestra base de datos. */
			$consulta = "UPDATE `habitaciones` SET `descripcion`='$descripcion',`tipo`='$tipo',`n_personas`='$n_personas',`estado`='$activo' WHERE codigo='$codigo'";
			print($consulta);
			$ejecutar_consulta = $conexion->query(($consulta));
			
			/* Si se ejecutó la consulta, redirigimos al archivo del formulario con una clave de que se ejecutó correctamente. */
			if($ejecutar_consulta){
				header("Location: ../h_registro.php?error=no");
			}
		
	/* Si existen registros, indicamos que el usuario a crear ya existe. */
	else{
			header("Localtion: ../h_registro.php?error=si");
		}
 ?>