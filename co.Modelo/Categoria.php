<?php 
class Categoria{
	public $idCategoria;
	public $nombre;
	public $imagen;

	public function __construct($idCategoria,$nombre,$imagen){
		$this->idCategoria = $idCategoria;
		$this->nombre = $nombre;
		$this->imagen=$imagen;
	}
	public static function consultarTodos(){
		$listCategoria = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM categoria limit 200");
		foreach ($sql->fetchAll() as $categoria) {
			$listCategoria[]=$categoria;
		}
		return $listCategoria;
	}

	public static function consultarId($id){
		$listCategoria = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM categoria WHERE idCategoria=?");
		$sql->execute(array($id));
		$categoria=$sql->fetch();
		return new Categoria($categoria['idCategoria'],$categoria['nombre'],$categoria['imagen']);
		
	}
	public static function crear($nombre){
		$conexionBD=BD::crearInstancia();
		$sql= $conexionBD->prepare("INSERT INTO categoria(nombre)VALUES(?)");
		$sql->execute(array($nombre));

		return true;
	}
	public static function modificar($nom,$id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE categoria SET nombre=? WHERE idCategoria=?");
		$sql->execute(array($nom,$id));
		return true;
	}
	public static function buscarNombre($nom){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare('SELECT * FROM categoria WHERE nombre =?');
		$sql->execute(array($nom));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	} 
	public static function eliminar($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM categoria WHERE idCategoria=?");
		$sql->execute(array($id));
		return true;
	}
	public static function buscarFiltro($nom){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare('SELECT * FROM categoria WHERE nombre LIKE ?');
		$sql->execute(array("%".$nom."%"));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}

}

?>