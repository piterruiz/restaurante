<?php 

class Cajamayor
{
	public $idCaja;
	public $descripcion;
	public $fecha;
	public $valor;
	public $usuario;
	public function __construct($idCaja,$descripcion,$fecha,$valor,$usuario)
	{
			$this->idCaja=$idCaja;
			$this->descripcion=$descripcion;
			$this->fecha=$fecha;
			$this->valor=$valor;
			$this->usuario=$usuario;
	}
	public static function consultarTodos(){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM cajamayor");
		$sql->execute();
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarId($id){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM cajamayor where idCaja=?");
		$sql->execute(array($id));
		$caja=$sql->fetch();
		return new Cajamayor($caja['idCaja'],$caja['descripcion'],$caja['fecha'],$caja['valor'],$caja['usuario']);
	}
	public static function crear($descripcion,$valor,$usuario){
		print_r($usuario);
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO cajamayor(descripcion,fecha,valor,usuario)values (?,now(),?,?)");
		$sql->execute(array($descripcion,$valor,$usuario));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function editar($descripcion,$fecha,$valor,$usuario,$idCaja){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE cajamayor set descripcion=?, fecha=?, valor=?, usuario=? where idCaja=?");
		$sql->execute(array($descripcion, $fecha, $valor, $usuario,$idCaja));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function editarValor($valor,$idCaja){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE cajamayor set valor=? where idCaja=?");
		$sql->execute(array($valor,$idCaja));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function eliminar($idCaja){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM cajamayor WHERE idCaja=?");
		$sql->execute(array($idCaja));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function buscarFecha($fecha){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM cajamayor WHERE fecha LIKE ?");
		$sql->execute(array("%".$fecha."%"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
}

?>