<?php 

function verificarInfo($info) {

	$arrayErrores = [];

// NOMBRE

	if ((strlen($_POST["nombre"])) > 15) {
		$arrayErrores["nombre"] = "Nombre no valido";
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

// MAIL

	if ((strlen($_POST["email"])) == 0) {
		$arrayErrores["email"] = "Debe espicificar un mail";
	}

	else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
		$arrayErrores["email"] = "Mail no valido";
	}

// GENERO

	if (isset($_POST["sexo"]) == 0) {
		$arrayErrores["sexo"] = "Por favor seleccione un genero";
	}	

// CONTRASEÑA (FALTA HASH)

	if ((strlen($_POST["contrasena"])) > 15 || (strlen($_POST["contrasena"])) < 6) {
		$arrayErrores["contrasena"] = "Contraseña no valida";
	} 

	if (($_POST["contrasena"]) != ($_POST["ccontrasena"]) || ($_POST["contrasena"]) == 0) {
		$arrayErrores["ccontrasena"] = "Contraseña no valida";
	}

// TERMINOS

	if (isset($_POST["terminos"]) == 0) {
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
    "password" => $info["contrasena"],
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

	if (strlen($info["email"]) == 0) {
		$arrayDeErrores["email"] = "No se introdujo ningún mail";
	}

	elseif (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
		$arrayDeErrores["email"] = "Se introdujo un mail invalido";
	}

	elseif (traerPorEmail($_POST["email"]) == NULL) {
		$arrayDeErrores["email"] = "El usuario no existe";
	}

	else {
		$usuario = traerPorEmail($info["email"]);

    	if (($info["contrasena"]) != ($usuario["contrasena"])) {
      	$arrayDeErrores["contrasena"] = "La contraseña no verifica";
    	}   
    }

	return $arrayDeErrores;
}

// no entiendo los dos de abajo

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

?>