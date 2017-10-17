<?php

session_start();

$dsn = 'mysql:host=localhost;dbname=usuarios;charset=utf8mb4;port=3306';
$user ="root";
$pass = "root";

try {
  $db = new PDO($dsn, $user, $pass);
} catch (Exception $e) {
  echo "La conexion a la base de datos ha fallado: " . $e->getMessage();
}

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

// CONTRASEÑA 

	if ((strlen($_POST["contrasena"])) > 15 || (strlen($_POST["contrasena"])) < 6) {
		$arrayErrores["contrasena"] = "Contraseña no valida";
	}

	if (($_POST["contrasena"]) != ($_POST["ccontrasena"])) {

		//var_dump(($_POST["contrasena"]) == 0);
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
  global $db;

  $sql = "Insert into usuarios values (default,:Nombre,:Apellido,:Email,:Password,:Genero)";

  $query = $db->prepare($sql);

  $query->bindValue(":Nombre",$_POST["nombre"]);
  $query->bindValue(":Apellido",$_POST["apellido"]);
  $query->bindValue(":Email",$_POST["email"]);
  $query->bindValue(":Password",password_hash($_POST["contrasena"], PASSWORD_DEFAULT));
  $query->bindValue(":Genero",$_POST["sexo"]);

  $query->execute();

  $usuario["Usuario_id"] = $db->lastInsertId();

  return $usuario;

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


		$usuario = traerPorEmail($_POST["email"]);

		$e = (password_verify($_POST["contrasena"], $usuario["Password"]));

    	if (password_verify($_POST["contrasena"], $usuario["Password"]) == false) {
      	$arrayDeErrores["contrasena"] = "La contraseña no verifica";
    	}
    }

	return $arrayDeErrores;
}

// ntnd

function traerTodos() {
  global $db;

  $sql = "Select * from usuarios";

  $query = $db->prepare($sql);

  $query->execute();

  $arrayFinal = $query->fetchAll(PDO::FETCH_ASSOC);

  return $arrayFinal;
}


function traerPorEmail($email) {
  global $db;

  $sql = "Select * from usuarios where Email = :Email";

  $query = $db->prepare($sql);

  $query->bindValue(":Email", $email);

  $query->execute();

  $usuario = $query->fetch(PDO::FETCH_ASSOC);

  return $usuario;

}

function recordarUsuario($email) {
  setcookie("usuarioLogueado", $email, time() + 60*60*24*7);
}

?>
