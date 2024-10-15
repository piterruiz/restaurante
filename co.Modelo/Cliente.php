<?php 
class Cliente{
	public $idCliente;
	public $nit;
	public $nombre;
	public $direccion;
	public $telefono;
	public function __construct($idCliente,$nit,$nombre,$direccion,$telefono){
		$this->idCliente = $idCliente;
		$this->nit = $nit;
		$this->nombre = $nombre;
		$this->direccion = $direccion;
		$this->telefono = $telefono;
	}
	public static function consultarTodos(){
		$listCliente = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM cliente");
		foreach ($sql->fetchAll() as $cliente) {
			$listCliente[]=$cliente;
		}
		return $listCliente;
	}
	public static function consultarId($id){
		$listCliente = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM cliente WHERE idCliente=?");
		$sql->execute(array($id));
		$cliente=$sql->fetch();
		return new Cliente($cliente['idCliente'],$cliente['nit'],$cliente['nombre'],$cliente['direccion'],$cliente['telefono']);
		
	}
	public static function crear($nit,$nombre,$direccion,$telefono){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO cliente(nit,nombre,direccion,telefono)values(?,?,?,?)");
		$sql->execute(array($nit,$nombre,$direccion,$telefono));
		return true;
	}
	public static function editar($nit,$nombre,$direccion,$telefono,$id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE cliente SET nit=?, nombre=?, direccion=?, telefono=? WHERE idCliente=?");
		$sql->execute(array($nit,$nombre,$direccion,$telefono,$id));
		return true;
		
	}
	public static function buscarNombre($id){
		$listCliente = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM cliente WHERE nombre LIKE ? ");
		$sql->execute(array("%".$id."%"));

		foreach ($sql->fetchAll() as $cliente) {
			$listCliente[]=$cliente;
		}
		return $listCliente;
	}
	public static function eliminar($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM cliente WHERE idCliente=?");
		$sql->execute(array($id));
		return true;
	}
	public static function buscarNit($nit){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM cliente WHERE nit = ?");
		$sql->execute(array($nit));
		$cliente=$sql->fetch();
		return new Cliente($cliente['idCliente'],$cliente['nit'],$cliente['nombre'],$cliente['direccion'],$cliente['telefono']);
	}
	public static function buscarNom($nom){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM cliente WHERE nombre = ?");
		$sql->execute(array($nom));
		$cliente=$sql->fetch();
		return new Cliente($cliente['idCliente'],$cliente['nit'],$cliente['nombre'],$cliente['direccion'],$cliente['telefono']);
	}
	public static function buscarFiltro($buscar){
		$listCliente = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM cliente WHERE id LIKE ? and nit LIKE ? and nombre LIKE ?  ");
		$sql->execute(array("%".$buscar."%","%".$buscar."%","%".$buscar."%"));

		foreach ($sql->fetchAll() as $cliente) {
			$listCliente[]=$cliente;
		}
	}
}



?>