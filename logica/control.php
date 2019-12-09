<?php
	include("../config/conexion.php");

	$usuario = $_POST["user_txt"];
	$password = $_POST["password_txt"];
	$consulta = "SELECT usuario,activo FROM usuario WHERE usuario='$usuario' AND password=SHA1('$password')";
	
	$ejecutar_consultau = $conexion->query($consulta);
	$user = mysqli_fetch_row($ejecutar_consultau);


	$ejecutar_consulta = $conexion->query($consulta);

	$regs = $ejecutar_consulta->num_rows;
	
	if($regs!=0 && $user[1]==1)
	{
		session_start();

		$_SESSION["autentificado"]=true;
		$_SESSION["usuario"]=$_POST["user_txt"];
		setcookie("sesion",$_SESSION["autentificado"],time()+3600,"/");
		header("Location: ../home.php");
	}
	else if ($user[1]==0) {
		# code...
		header("Location: ../index.php?error=a");
	}

	else
	{
		header("Location: ../index.php?error=si");
	}
?>