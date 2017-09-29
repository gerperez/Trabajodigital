<?php 

session_start();

function verificarInfo($info) {

	$arrayErrores = [];

// NOMBRE

	if ((strlen($_POST["nombre"])) > 15) {
		$arrayErrores["nombre"] = "Nombre no valido";
	} 

	$regex = "/[0-9,]/";
	if (preg_match($regex, ($_POST["nombre"])) != NULL) {
		$arrayErrores["nombre"] = "El nombre solo puede contener caracteres alfabéticos";
	}

	elseif ((strlen($_POST["nombre"])) == 0) {
		$arrayErrores["nombre"] = "Nombre no valido";
	}

// APELLIDO

	if ((strlen($_POST["apellido"])) > 15) {
		$arrayErrores["apellido"] = "Apellido no valido";
	}

	elseif ((strlen($_POST["apellido"])) == 0) {
		$arrayErrores["apellido"] = "Apellido no valido";
	}

	elseif (ctype_alpha($_POST["apellido"]) == NULL) {
		$arrayErrores["apellido"] = "El apellido solo puede contener caracteres alfabéticos";
	}

// MAIL

	if ((strlen($_POST["email"])) == 0) {
		$arrayErrores["email"] = "Debe especificar un mail";
	}

	else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
		$arrayErrores["email"] = "Mail no valido";
	}

	else if ((traerPorEmail($_POST["email"])) != NULL) {
    $arrayErrores["email"] = "El mail ya existe";
 	}


// FOTO DE PERFIL

  $errorDeLaFoto = $_FILES["foto-perfil"]["error"];
  $nombreDeLaFoto = $_FILES["foto-perfil"]["name"];
  $extension = pathinfo($nombreDeLaFoto, PATHINFO_EXTENSION);

  if ($errorDeLaFoto != UPLOAD_ERR_OK) {
    $arrayDeErrores["foto-perfil"] = "Hubo un error al cargar la foto";
  }
  else if ($extension != "jpg" && $extension != "jpeg" && $extension != "png" && $extension != "gif") {
    $arrayDeErrores["foto-perfil"] = "Lo que subiste no era una imagen";
  }	

// GENERO

	if (($_POST["sexo"]) == "off") {
		$arrayErrores["sexo"] = "Por favor seleccione un genero";
	}	

// CONTRASEÑA (FALTA HASH)

	if ((strlen($_POST["contrasena"])) > 15 || (strlen($_POST["contrasena"])) < 6) {
		$arrayErrores["contrasena"] = "Contraseña no valida";
	} 

	if (($_POST["contrasena"]) != ($_POST["ccontrasena"]) || ($_POST["contrasena"]) == 0) {
		$arrayErrores["ccontrasena"] = "Confirmacion no valida";
		$arrayErrores["contrasena"] = "Ingrese devuelta la contraseña";
	}

// TERMINOS

	if (($_POST["terminos"]) == "off") {
		$arrayErrores["terminos"] = "Debe aceptar los terminos";
	}

	return ($arrayErrores);
}

// REGISTRO

function armarUsuario($info) {
  return [
    "nombre" => $info["nombre"],
    "apellido" => $info["apellido"],
    "email" => $info["email"],
    "password" => password_hash($info["contrasena"], PASSWORD_DEFAULT),
    "genero" => $info["sexo"]

  ];
}	

function guardarUsuario($usuario) {
  $usuarioJSON = json_encode($usuario);
  file_put_contents("usuarios.json", $usuarioJSON . PHP_EOL, FILE_APPEND);
}

// LOGUEO

function loguear($email) {
  $_SESSION["usuarioIniciado"] = $email;
}

function yaEstaLogueado() {
	if (isset($_SESSION["usuarioIniciado"])) {
		return true;
	} else {
		return false;
	}
}

//function usuarioIniciado()

function validarInicio($info) {

	$arrayDeErrores = [];

// MAIL

	if (strlen($info["email"]) == 0) {
		$arrayDeErrores["email"] = "No se introdujo ningún mail";
	}

	elseif (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
		$arrayDeErrores["email"] = "Se introdujo un mail invalido";
	}

	elseif (traerPorEmail($_POST["email"]) == NULL) {
		$arrayDeErrores["email"] = "El usuario no existe";
	}

// CONTRASEÑA

	if (strlen($info["contrasena"]) == 0) {
		$arrayDeErrores["contrasena"] = "No introdujo contraseña";
	}

	else {
		$usuario = traerPorEmail($info["email"]);

    	if (password_verify($info["contrasena"], $usuario["password"]) == false) {
      	$arrayDeErrores["contrasena"] = "La contraseña no verifica";
    	}   
    }

	return $arrayDeErrores;
}

// ntnd

function traerTodosLosUsuarios() {
  $archivo = file_get_contents("usuarios.json");
  $array = explode(PHP_EOL, $archivo);
  array_pop($array);


  $arrayFinal = [];
  foreach ($array as $usuario) {
    $arrayFinal[] = json_decode($usuario, true);
  }

  return $arrayFinal;
}


function traerPorEmail($email) {
  $todos = traerTodosLosUsuarios();

  foreach ($todos as $usuario) {
    if ($usuario["email"] == $email) {
      return $usuario;
    }
  }
  return NULL;
}

function recordarUsuario($email) {
  setcookie("usuarioLogueado", $email, time() + 60*60*24*7);
}

?>