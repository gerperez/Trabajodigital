<?php

	require_once("funciones.php");
	if (yaEstaLogueado()) {
		header("Location: main.php");
	} 

	//validar

	//si ta todo ok set session

	//redirigir a home

	if ($_POST) {

  	$arrayErrores = validarInicio($_POST);

  	var_dump($arrayErrores);exit;

  	//Si es valido, loguear
  	if (count($arrayErrores) == 0) {
    loguear($_POST["email"]);
    if (isset($_POST["recordame"])) {
      recordarUsuario($_POST["email"]);
    }
    header("Location:main.php");
  	} else var_dump($arrayErrores);
  	var_dump($usuario);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pagina Inicio Cliente</title>
		<link rel="stylesheet" type="text/css" href="./css/cliente.css">
		<meta name="viewport" content="initial-scale=1">
	</head>
	<body>
			<div class="opciones">	
				<div style="float: left; margin-left: 18px; margin-top: 16px" >
				<a href="#">Servicio al consumidor</a></div>
				<div style="float: right">
				<nav class="main.nav">
						<ul>
							<li><a href="main.php">Home</a></li>
							<li><a href="iniciosesion.php">Iniciar sesión</a></li>
							<li><a href="registro.php">Regístrese</a></li>
							<li><a href="#">Contacto</a></li>
						</ul>
				</nav></div>
			</div>
			<br style="clear: both">
			<div class="top-bar" >
				<header class="main-header">
					<center>
						<img src="./images/titulo.png"></center>
				</header>
			</div>		
<br>
<center>
		<form action="iniciosesion.php" class="registro" method="POST">
		<div class="rounded">	
  			Mail:<br>
  			<input type="text" name="email" value=""><br><br>
  			Contraseña:<br>
  			<input type="password" name="contrasena" value=""><br>
  			<h6><a>Olvido su contraseña?</a></h6>
  		</div>	
  			<input type="submit" value="Iniciar sesión">
		</form>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
				<footer class= "main-footer">
						<ul>
							<li><a href="main.html">Home</a></li>
							<li><a href="#">Quienes somos</a></li>
							<li><a href="#">Contacto</a></li>
							<li>Seguinos en las redes!</li>
							<img src="./images/fb.png">
							<img src="./images/pi.png">
							<img src="./images/tw.png">
							<img src="./images/in.png">
							<img src="./images/you.png">
							<img src="./images/tu.png">
						</ul>
				</footer>
			</div></center>
	</body>
</html>