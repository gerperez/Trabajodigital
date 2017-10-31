<?php

include_once("usuarios.php");

abstract class db {
	public abstract function traerTodos();
	public abstract function traerPorEmail($email);
	public abstract function guardarUsuario(Usuario $usuario);
}

?>
