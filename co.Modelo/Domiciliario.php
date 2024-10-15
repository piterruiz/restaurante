<?php 
class Domiciliario{
	public $idDomiciliario;
	public $nombre;
	public $telefono;
	public $direccion;
	public function __construct($idDomiciliario,$nombre,$telefono,$direccion){
		$this->idDomiciliario = $idDomiciliario;
		$this->nombre = $nombre;
		$this->telefono = $telefono;
		$this->direccion = $direccion;

	}
	public static function consultarTodos(){
		$listDomiciliario=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM domiciliario");
		foreach ($sql->fetchAll() as $domiciliario) {
			$listDomiciliario = $domiciliario;
		}
	}
	public static function crear($nombre,$telefono,$direccion){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO domiiliario(nombre,telefono,direccion)VALUES(?,?,?)");
		$sql->execute(array($nombre,$telefono,$direccion));
		return true;
	}
	public static function editar($nombre,$telefono,$direccion,$id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE domiciliario SET $nombre=?, $telefono=?, $direccion=?, $telefono=? WHERE idDocumento=?");
		$sql->execute(array($nombre,$telefono,$direccion,$id));
		return true;
	}
	public static function eliminar($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM domiciliario WHERE idDomiciliario=?");
		$sql->execute(array($id));
		return true;
	}
	public static function buscarId($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM domiciliario WHERE idDomiciliario=?");
		$sql->execute(array($id));
		$domiciliario=$sql->fetch();
		return new Domiciliario($domiciliario['idDomiciliario'],$domiciliario['nombre'],$domiciliario['telefono'],$domiciliario['direccion']);
	}
	public static function buscarFiltro($id){
		$listDomiciliario=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM domiciliario WHERE idDomiciliario LIKE ? OR nombre LIKE ?");
		$sql->execute(array("%".$id."%".,"%".$id."%".));
		foreach ($sql->fetchAll() as $domiciliario) {
			$listDomiciliario = $domiciliario;
		}
	}
}

?>