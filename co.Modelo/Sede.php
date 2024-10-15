<?php 
	
	class Sede
	{
		public $idSede;
		public $nombre;
		public $negocio;

		function __construct($idSede,$nombre,$negocio)
		{
			$this->idSede=$idSede;
			$this->nombre=$nombre;
			$this->negocio=$negocio;
		}
		public static function crear($nombre,$negocio){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("INSERT INTO sede (nombre,negocio)VALUES(?,?)");
			$sql->execute(array($nombre,$negocio));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public static function editar($idSede,$nombre,$negocio){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE sede SET nombre=?, negocio=? WHERE idSede = ?");
			$sql->execute(array($nombre,$negocio,$idSede));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public static function eliminar($idSede){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("DELETE FROM sede WHERE idSede=?");
			$sql->execute(array($idSede));
			if ($sql) {
				return true;
			}else{
				return false;
			}

		}
		public static function buscarId($idSede){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM sede WHERE idSede=?");
			$sql->execute(array($idSede));
			$sede=$sql->fetch();
			return new Sede($sede['idSede'],$sede['nombre'],$sede['negocio']);
		}
		public static function ListarTodos(){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT s.*,n.nombre as nombreNegocio FROM sede as s INNER JOIN negocio as n on n.idNegocio=s.negocio");
			$sql->execute();
			foreach ($sql->fetchAll() as $key => $value) {
				$list[]=$value;
			}
			return $list;
		}
		public static function listarNegocio($negocio){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT s.*,n.nombre as nombreNegocio FROM sede as s INNER JOIN negocio as n on n.idNegocio=s.negocio WHERE s.negocio=?");
			$sql->execute(array($negocio));
			foreach ($sql->fetchAll() as $key => $value) {
				$list[]=$value;
			}
			return $list;
		}
		public static function ultimo(){
			
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT max(idSede) as id from sede");
			$sql->execute();
			$sede=$sql->fetch();
			return $sede['id'];
		}
	}

 ?>