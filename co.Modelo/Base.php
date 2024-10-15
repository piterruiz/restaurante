<?php 

class Base
{
	public $idBase;
	public $fecha;
	public $valor;
	function __construct($idBase,$fecha,$valor)
	{
		$this->idBase = $idBase;
		$this->fecha = $fecha;
		$this->valor = $valor;
	}
	public static function consultarTodos(){
		$listBase = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM base");
		$sql->execute();
		foreach ($sql->fetchAll() as $categoria) {
			$listBase[]=$categoria;
		}
		return $listBase;
	}
	public static function crear($valor,$fecha){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO base(fecha,valor) VALUES (?,?)");
		$sql->execute(array($fecha,$valor));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function editar($valor,$idBase){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE base set valor=? where idBase=?");
		$sql->execute(array($valor,$idBase));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function eliminar($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM base WHERE idBase=?");
		$sql->execute(array($id));
		if ($sql) {
			return true;
		}else{
			return false;
		}
	}
	public static function buscarFecha($fecha){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM base WHERE fecha BETWEEN ? and ?");
		$sql->execute(array($fecha." 00:00:00",$fecha." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFechaFiltro($fecha){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM base WHERE fecha LIKE ?");
		$sql->execute(array("%".$fecha."%"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFechas($fecha1,$fecha2){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM base WHERE fecha BETWEEN ? and ?");
		$sql->execute(array($fecha1." 00:00:00",$fecha2." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarId($id){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM base WHERE idBase=?");
		$sql->execute(array($id));
		$base=$sql->fetch();
		return new Base($base['idBase'],$base['fecha'],$base['valor']);
		
	}

}
?>