<?php

include "config.php";

if($_POST){
	$name=$_POST['nombre'];
	$pais=$_POST['pais'];
	$email=$_POST['correo'];
	$password=$_POST['contras'];
	//$perfil=$_POST['perfil'];

	$chequeo = "SELECT * FROM alumnos WHERE correo = '$email'";
	$result = mysqli_query($conn, $chequeo);

	if(mysqli_num_rows($result) > 0){
		echo "<center>";
		echo "<h2 class='text-light'>Usuario existente</h2><br><br><a class='btn btn-warning' href='../../admin/registro_alum.php'>volver</a>";
		echo "</center>";
	}else{
		$sql="INSERT INTO `alumnos`(`nombre`, `correo`, `contras`, `pais`) VALUES ('".$name."','".$email."','".$password."','".$pais."')";

		$query = mysqli_query($conn,$sql);
		if($query)
		{
			session_start();
			$_SESSION['nombre'] = $name;
			header('Location: ../../admin/bienvenidoal.php');
		}
		else
		{
			echo "Algo salió mal";
		}
	}	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
	<link rel="shortcut icon" href="../img/logo_azul_wat.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Administración</title>
</head>
<body>
	<div class="blue"></div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>