<?php

include_once("db.php");
class Auth {
	public function __construct() {
		session_start();

		if(!$this->yaEstaLogueado() && isset($_COOKIE["usuarioIniciado"])) {
			this->loguear($_COOKIE["usuarioIniciado"]);
		}
	}

	public function loguear($email) {
		$_SESSION["usuarioIniciado"] = $emil;
	}

	public function yaEstaLogueado() {
		if(isset($_SESSION["usuarioIniciado"])) {
			return true;
		}else{
			return false;
		}
	}
	public function usuarioIniciado(db $db) {
		if ($this->yaEstaLogueado()) {
		return $db->traerPorEmail($_SESSION["usuarioIniciado"]);
		}else {
			return NULL;
		}
	}
	public function recordarUsuario($email) {
  		setcookie("usuarioLogueado", $email, time() + 60*60*24*7);
	}

	public function logout() {
		session_destroy();
		setcookie("usuarioLogueado", "", -1);
	}
}

?>
