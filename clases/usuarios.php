<?php

class Usuario {
	private $usuario_id;
	private $nombre; 
	private $apellido;
	private $email;
	private $password;
	private $genero;

	public function __contruct($usuario_id = null, $nombre, $apellido, $email, $password, $genero) {

		if($usuario_id==null){
			$this->password = password_hash($password, PASSWORD_DEFAULT);

		}else{
			$this->password = $password;
		}

		$this->usuario_id = $usuario_id;
	    $this->nombre = $nombre;
	    $this->apellido = $apellido;
	    $this->email = $email;
	    $this->password = $password;
	    $this->genero = $genero;
	}

	public function getUsuario_id(){
		return $this->usuario_id;
	}

	public function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}


	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre) {
		$this->nombre =$nombre;
	}


	public function getApellido(){
		return $this->apellido;
	}

	public function setApellido($apellido) {
		$this->apellido = $apellido;
	}


	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}


	public function getGenero(){
		return $this->genero;
	}

	public function setGenero($genero) {
		$this->genero = $genero;
	}

	public function guardarFoto() {
		$archivo = $_FILES["foto-perfil"]["tmp_name"];

		$nombreDeLaFoto = $_FILES["foto-perfil"]["name"];
		$extension = pathinfo($nombreDeLaFoto, PATHINFO_EXTENSION);

		$nombre = dirname(__FILE__) . "/img/" . $this->email . "extension";

		move_uploaded_file($archivo, $nombre);
	}

}

?>
