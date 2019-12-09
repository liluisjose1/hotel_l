<?php 
include("../config/conexion.php");
$id_hotel = $_POST['id_hotel'];

$nombre= $_POST["nombre_h"];
$tel= $_POST["tel"];
$direccion= $_POST["direccion"];

$imagen =$_FILES["archivo"]["name"];
$ruta = $_FILES["archivo"]["tmp_name"];
$destino="../assets/images/".$imagen;
$ruta_final="assets/images/".$imagen;



$sql_e = "SELECT * FROM `configuracion`";
$ejecutar_consulta_e = $conexion->query($sql_e);
$num_regs = $ejecutar_consulta_e->num_rows;

print($num_regs);
if ($num_regs==0) {
	$consulta = "INSERT INTO `configuracion`(`id`, `nombre`, `ruta_img`, `tel`, `direccion`) VALUES ('1','$nombre','$ruta_final','$tel','$direccion')";
	print($consulta);
	$ejecutar_consulta2 = $conexion->query(($consulta));
	if($ejecutar_consulta2){
		copy($ruta,$destino);
		header("Location: ../config.php?error=no");
	}
	 else{
	 	header("Localtion: ../config.php?error=si");
	}

}
else{
	$sql1 = "UPDATE `configuracion` SET `nombre`='$nombre',`ruta_img`='$ruta_final',`tel`='$tel',`direccion`='$direccion' WHERE `id`='$id_hotel'";
	$ejecutar_consulta1 = $conexion->query(($sql1));
	
	if($ejecutar_consulta1){
	header("Location: ../config.php?error=no");
	copy($ruta,$destino);
	 }
	 else{
	 	header("Localtion: ../config.php?error=si");
	 }
}
 ?>