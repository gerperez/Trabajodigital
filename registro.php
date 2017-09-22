<?php
	require_once("funciones.php");

  $nombreDefault = "";
  $apellidoDefault = "";
  $emailDefault = "";

	if ($_POST) {
		$arrayDeErrores = verificarInfo($_POST);

    	if (count($arrayDeErrores) == 0) {
        	$usuario = armarUsuario($_POST);

        	guardarUsuario($usuario);

        	header("Location: main.php");exit;
    	} else var_dump($arrayDeErrores);

	$nombreDefault = $_POST["nombre"];
	$apellidoDefault = $_POST["apellido"];
	$emailDefault = $_POST["email"];
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
		<form action="registro.php" class="registro" method="post">
		<div class="rounded">	
			<div>
  			Nombre:<br>
  			<input type="text" name="nombre" value="<?=$nombreDefault?>">
  			<br>
  			<?php if (isset($arrayDeErrores["nombre"])) : ?>
            <span style="color:red;">
              <?=$arrayDeErrores["nombre"]?>
            </span>
          	<?php endif; ?>
  			</div>
  			<br>
  			<div>
  			Apellido:<br>
  			<input type="text" name="apellido" value="<?=$apellidoDefault?>">
  			<br>
  			<?php if (isset($arrayDeErrores["apellido"])) : ?>
            <span style="color:red;">
              <?=$arrayDeErrores["apellido"]?>
            </span>
          	<?php endif; ?>
  			</div>
  			<br>
  			<div>
  			Mail:<br>
  			<input type="text" name="email" value="<?=$emailDefault?>">
  			<br>
  			<?php if (isset($arrayDeErrores["email"])) : ?>
            <span style="color:red;">
              <?=$arrayDeErrores["email"]?>
            </span>
          	<?php endif; ?>
  			</div>
  			<br>
  			<div>
  			Sexo:<br><br>
  			Masculino<input type="radio" name="sexo" value="">
  			Femenino<input type="radio" name="sexo" value="">
  			<br>
  			<?php if (isset($arrayDeErrores["sexo"])) : ?>
            <span style="color:red;">
              <?=$arrayDeErrores["sexo"]?>
            </span>
          	<?php endif; ?>
  			</div>
  			<br>
  			<div>
  			Contraseña:<br>
  			<input type="password" name="contrasena" value="">
  			<br>
  			<?php if (isset($arrayDeErrores["contrasena"])) : ?>
            <span style="color:red;">
              <?=$arrayDeErrores["contrasena"]?>
            </span>
          	<?php endif; ?>
  			</div>
  			<br><br>
  			<div>
  			Confirmar contraseña:<br>
  			<input type="password" name="ccontrasena" value="">
  			<br>
  			<?php if (isset($arrayDeErrores["ccontrasena"])) : ?>
            <span style="color:red;">
              <?=$arrayDeErrores["ccontrasena"]?>
            </span>
          	<?php endif; ?>
  			</div>
  			<br>
  			<div>
  			<h6>Acepta los terminos y condiciones?
  			<input type="checkbox" name="terminos"></h6>
  			<?php if (isset($arrayDeErrores["terminos"])) : ?>
            <span style="color:red;">
              <?=$arrayDeErrores["terminos"]?>
            </span>
          	<?php endif; ?>
  			</div>
  		</div>	
  			<input type="submit" value="Crear cuenta">
		</form>
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
