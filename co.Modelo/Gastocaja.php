<?php 

class Gastocaja
{
	public $idGasto;
	public $descripcion;
	public $fecha;
	public $valor;
	public $usuario;
	public function __construct($idGasto,$descripcion,$fecha,$valor,$usuario)
	{
			$this->idGasto=$idGasto;
			$this->descripcion=$descripcion;
			$this->fecha=$fecha;
			$this->valor=$valor;
			$this->usuario=$usuario;
	}
	public static function consultarTodos(){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM gastocaja");
		$sql->execute();
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarId($id){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM gastocaja where idGasto=?");
		$sql->execute(array($id));
		$caja=$sql->fetch();
		return new Gastocaja($caja['idGasto'],$caja['descripcion'],$caja['fecha'],$caja['valor'],$caja['usuario']);
	}
	public static function crear($descripcion,$valor,$usuario){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO gastocaja(descripcion,fecha,valor,usuario)values (?,now(),?,?)");
		$sql->execute(array($descripcion,$valor,$usuario));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function editar($descripcion,$fecha,$valor,$usuario,$idGasto){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE gastocaja set descripcion=?, fecha=?, valor=?, usuario=? where idGasto=?");
		$sql->execute(array($descripcion, $fecha, $valor, $usuario,$idGasto));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function editarValor($valor,$idGasto){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE gastocaja set valor=? where idGasto=?");
		$sql->execute(array($valor,$idGasto));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function eliminar($idGasto){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM gastocaja WHERE idGasto=?");
		$sql->execute(array($idGasto));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function buscarFecha($fecha){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM gastocaja WHERE fecha LIKE ?");
		$sql->execute(array("%".$fecha."%"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
}

?>