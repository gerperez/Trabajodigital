<?php
	require_once("funciones.php");

	if (yaEstaLogueado()) {
	$usuario = traerPorEmail($_SESSION["usuarioIniciado"]);
	$usuario = $usuario["Nombre"] . " " . $usuario["Apellido"];
	}
?>

<html><head>
		<meta charset="utf-8">
		<title>Pagina Inicio Cliente</title>
		<link rel="stylesheet" type="text/css" href="./css/cliente.css">
		<meta name="viewport" content="initial-scale=1">
	</head>
	<body>
			<div class="opciones">	
				<div class="servicio">
				<a href="#">Servicio al consumidor</a></div>
				<div style="float: right">
				<nav class="main.nav">
						<ul>
							<?php
							if (yaEstaLogueado() == false) {
								?>
							<li><a href="iniciosesion.php">Iniciar sesión</a></li>
							<li><a href="registro.php">Regístrese</a></li>
							<?php
							} 
							?>
							<li><a href="#">Contacto</a></li>
							<?php if (yaEstaLogueado()) { ?>
							<li>Usuario <b><?=$usuario?></b></li>
							<li style="text-decoration: none"><a href="logout.php">Salir</a></li>
							<?php
							} ?>
						</ul>
				</nav></div>
			</div>
			<br style="clear: both">
			<div class="top-bar">
				<header class="main-header">
					<center>
						<img src="./images/titulo.png"></center>
				</header>
				<div>
					<center>
					<ul>
					<p><a href="#">Mujer</a></p>
					<p><a href="#">Hombre</a></p>
					<p><a href="#" style="color: white">Sale</a></p>
					<p><u><input type="text" name="busqueda" placeholder="Buscá tu producto..."></u><img style="width: 20px; position: relative; right: 10px; top: 4px" src="./images/busq.png">
					</p>
					<p><a href="#">Tu carrito<img style="width: 20px; position: relative; left: 5px; top: 4px" src="./images/carrito.svg"></a></p></ul>
					</center>
				</div>
			</div>		
<br>
<center>
			<div class="container">		
				
				<section class="products">
					<article class="estilos">
						
						<img src="./images/chi2.jpeg">
						<h2></h2>
						<p>
						</p>
						<a href="#">Ver mas de este estilo</a>
						<br><br>
					</article>
					<article class="estilos">
						
						<img src="./images/boy2.jpeg">
						<h2></h2>
						<p>
						</p>
						<a href="#">Ver mas de este estilo</a>
						<br><br>
					</article>
					<article class="estilos">
						
						<img src="./images/chi1.jpeg">
						<h2></h2>
						<p>
						</p>
						<a href="#">Ver mas de este estilo</a>
						<br><br>
					</article>
					<article class="estilos">
						<img src="./images/boy1.jpeg">
						<h2></h2>
						<p>
						</p>
						<a href="#">Ver mas de este estilo</a>
						<br><br>
					</article>
					<article class="estilos">
						<img src="./images/chi3.jpeg">
						<h2></h2>
						<p>
						</p>
						<a href="#">Ver mas de este estilo</a>
						<br><br>
					</article>
					<article class="estilos">
						<img src="./images/boy3.jpeg">
						<h2></h2>
						<p>
						</p>
						<a href="#">Ver mas de este estilo</a>
						<br><br>
					</article>
				</section>
				<br>
				<footer class="main-footer" style="position: initial">
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
	

</body></html>