<?php 
	/**
	 * 
	 */
	class Mesas
	{
		public $idMesa;
		public $nombre;
		public $estado;
		public function __construct($idMesa,$nombre,$estado)
		{
			$this->idMesa = $idMesa;
			$this->nombre = $nombre;
			$this->estado = $estado;
		}
		public static function consultarTodos()
		{
			$listMesas=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT * FROM mesas");
			foreach ($sql->fetchAll() as $mesas) {
				$listMesas[]=$mesas;
			}
			return $listMesas;
		}
		public function crear($nombre)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("INSERT INTO mesas(nombre)values('?')");
			$sql->execute($nombre);
			if ($sql) {
				return true;
			}else{
				return false;
			}
			
		}
		public function editar($nombre,$id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE mesas set nombre=? WHERE idMesa=?");
			$sql->execute($nombre,$id);
			if ($sql) {
				return true;
			}else{
				return false;
			}
			
		}
		public function eliminar($id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("DELETE FROM mesas WHERE idMesa=?");
			$sql->execute($id);
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public static function buscarId($id)
		{
			$listGastos=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM mesas WHERE idMesa=?");
			$sql->execute(array($id));
			$mesas=$sql->fetch();
			return new Mesas($mesas['idMesa'],$mesas['nombre']);
		}
		
	}
 ?>