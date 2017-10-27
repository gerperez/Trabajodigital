<?php

include_once("db.php");
include_once("usuarios.php");

class dbMYSQL extends db {
	private $conn;

	public function __contruct() {
	$dsn = 'mysql:host=localhost;dbname=usuarios;charset=utf8mb4;port=3306';
	$user ="root";
	$pass = "root";

	try {
  		$this->conn = new PDO($dsn, $user, $pass);
  	} catch(Exception $e) {
  	echo "La conexion a la base de datos ha fallado: " . $e->getMessage();
	}

} public function guardarUsuario(Usuario $usuario) {
  $sql = "Insert into usuarios values (default,:Nombre,:Apellido,:Email,:Password,:Genero)";

  $query = $this->conn->prepare($sql);

  $query->bindValue(":Nombre", $usuario->getNombre());
  $query->bindValue(":Apellido", $usuario->getApellido());
  $query->bindValue(":Email", $usuario->getEmail());
  $query->bindValue(":Password", password_hash($usuario->getPassword()));
  $query->bindValue(":Genero",$usuario->getGenero());

  $query->execute();

  $usuario->setId($this->conn->lastInsertId());

  return $usuario;
}

function traerTodos() {
  $sql = "Select * from usuarios";

  $query = $this->conn->prepare($sql);

  $query->execute();

  $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

  $arrayFinal = [];

  foreach ($resultados as $usuario) {
  	$arrayFinal[] = new Usuario($usuario["Nombre"], $usuario["Apellido"], $usuario["Email"], $usuario["Password"], $usuario["Genero"]);
  }
  return $arrayFinal;
}

function traerPorEmail($email) {
  	$sql = "Select * from usuarios where Email = :Email";

  	$query = $this->conn->prepare($sql);

  	$query->bindValue(":Email", $email);

  	$query->execute();

  	$usuario = $query->fetch(PDO::FETCH_ASSOC);

  	if($usuario) {
  		$usuario = new Usuario($usuario["Nombre"], $usuario["Apellido"], $usuario["Email"], $usuario["Password"], $usuario["Genero"]);
  	}

  	return $usuario;

	}
}


?>
