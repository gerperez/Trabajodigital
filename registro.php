<?php
	require_once("soporte.php");

if($auth->yaEstaLogueado()) {
	header("Location:main.php");
}
	$arrayDeErrores = [];
  $nombreDefault = "";
  $apellidoDefault = "";
  $emailDefault = "";
  $terminosDefault = "";
  $sexoDefault = "";


if ($_POST) {
		$arrayDeErrores = $validator->verificarInfo($_POST, $db);

    	if (count($arrayDeErrores) == 0) {
        	$usuario = new Usuario(null, $_POST["nombre"], $_POST["apellido"], $_POST["email"], $_POST["contrasena"], $_POST["sexo"]);

        	$usuario = $db->guardarUsuario($usuario);

					$usuario->guardarFoto();
				  /*$archivo = $_FILES["foto-perfil"]["tmp_name"];

          $nombreDeLaFoto = $_FILES["foto-perfil"]["name"];
          $extension = pathinfo($nombreDeLaFoto, PATHINFO_EXTENSION);

          $nombre = dirname(__FILE__) . "/imgUsers/" . $_POST["email"] . ".$extension";

          move_uploaded_file($archivo, $nombre);
          loguear($_POST["email"]);
        	header("Location: main.php");exit;
      }*/

			header("Location:main.php");exit;
		}
		$emailDefault = $_POST["email"];
		$usernameDefault = $_POST["nombre"];
	}
	    /*if (isset($arrayDeErrores["nombre"]) == null){
      $nombreDefault = ($_POST["nombre"]);
      }
      if (isset($arrayDeErrores["apellido"]) == null){
      $apellidoDefault = ($_POST["apellido"]);
      }
      if (isset($arrayDeErrores["email"]) == null){
      $emailDefault = ($_POST["email"]);
      }
      if ($_POST["terminos"] != "off") {
      $terminosDefault = "checked";
      }
}*/

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
		<form action="registro.php" class="registro" method="post" enctype="multipart/form-data">
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
        <div class="form-group">
          <label for="">Foto de Perfil (Opcional):</label>
          <br>

          <?php if (isset($arrayErrores["foto-perfil"])) : ?>
            <input class="form-control error" type="file" name="foto-perfil">
          <?php else: ?>
            <input class="form-control" type="file" name="foto-perfil">
          <?php endif; ?>
        </div>
  			<br>
  			<div>
  			Sexo:<br>
        <input type="hidden" name="sexo" value="off">
  			Masculino<input type="radio" name="sexo" value="masculino"
        <?php if ($_POST) {
          if ($_POST["sexo"] == "masculino") {
            echo "checked";
          }
        }
        ?>
        >
  			Femenino<input type="radio" name="sexo" value="femenino"
        <?php if ($_POST) {
          if ($_POST["sexo"] == "femenino") {
            echo "checked";
          }
        }
        ?>
        >
        Otro<input type="radio" name="sexo" value="otro"
        <?php if ($_POST) {
          if ($_POST["sexo"] == "otro") {
            echo "checked";
          }
        }
        ?>
        >
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
        <input type="hidden" name="terminos" value="off">
  			<input type="checkbox" name="terminos" <?php echo $terminosDefault?>></h6>
  			<?php if (isset($arrayDeErrores["terminos"])) : ?>
            <span style="color:red; position: relative; bottom: 23px;">
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
