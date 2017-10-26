<?php

include_once("db.php");

class Validator{
	public function verificarInfo($info, db $db) {
	$arrayErrores = [];

	foreach ($info as $key => $value) {
		$info[$key] = trim($value);
	}

// NOMBRE

	if ((strlen($info["nombre"])) > 15) {
		$arrayErrores["nombre"] = "Nombre no valido";
	}

	$regex = "/[0-9,]/";
	if (preg_match($regex, ($info["nombre"])) != NULL) {
		$arrayErrores["nombre"] = "El nombre solo puede contener caracteres alfabéticos";
	}

	elseif ((strlen($info["nombre"])) == 0) {
		$arrayErrores["nombre"] = "Nombre no valido";
	}

// APELLIDO

	if ((strlen($info["apellido"])) > 15) {
		$arrayErrores["apellido"] = "Apellido no valido";
	}

	elseif ((strlen($info["apellido"])) == 0) {
		$arrayErrores["apellido"] = "Apellido no valido";
	}

	elseif (ctype_alpha($info["apellido"]) == NULL) {
		$arrayErrores["apellido"] = "El apellido solo puede contener caracteres alfabéticos";
	}

// MAIL

	if ((strlen($info["email"])) == 0) {
		$arrayErrores["email"] = "Debe especificar un mail";
	}

	else if (filter_var($info["email"], FILTER_VALIDATE_EMAIL) == false) {
		$arrayErrores["email"] = "Mail no valido";
	}

	else if (($db->traerPorEmail($info["email"])) != NULL) {
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

	if (($info["sexo"]) == "off") {
		$arrayErrores["sexo"] = "Por favor seleccione un genero";
	}

// CONTRASEÑA 

	if ((strlen($info["contrasena"])) > 15 || (strlen($info["contrasena"])) < 6) {
		$arrayErrores["contrasena"] = "Contraseña no valida";
	}

	if (($info["contrasena"]) != ($info["ccontrasena"])) {

		//var_dump(($_POST["contrasena"]) == 0);
		$arrayErrores["ccontrasena"] = "Confirmacion no valida";
		$arrayErrores["contrasena"] = "Ingrese devuelta la contraseña";
	}

// TERMINOS

	if (($info["terminos"]) == "off") {
		$arrayErrores["terminos"] = "Debe aceptar los terminos";
	}

	return $arrayErrores;
}

public function validarInicio($info, db $db) {

	$arrayDeErrores = [];

// MAIL

	if (strlen($info["email"]) == 0) {
		$arrayDeErrores["email"] = "No se introdujo ningún mail";
	}

	elseif (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
		$arrayDeErrores["email"] = "Se introdujo un mail invalido";
	}

	elseif ($db->traerPorEmail($info["email"]) == NULL) {
		$arrayDeErrores["email"] = "El usuario no existe";
	}

// CONTRASEÑA Revisar chequeo de no contraseña

	$usuario = $db->traerPorEmail($info["email"]);
		if (strlen($info["contrasena"]) == 0) {
		$arrayDeErrores["contrasena"] = "No introdujo contraseña";
	}

	else {
		$usuario = $db->traerPorEmail($info["email"]);
    	if (password_verify($info["contrasena"], $usuario->getContraseña()) == false) {
      	$arrayDeErrores["contrasena"] = "La contraseña no verifica";
    	}
    }

	return $arrayDeErrores;
	}
}


?>