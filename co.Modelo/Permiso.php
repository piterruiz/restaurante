<?php 
	/**
	 * 
	 */
	class Permiso
	{
		public $idPermiso;
		public $nombre;
		
		public function __construct($idPermiso,$nombre)
		{
			$this->idPermiso= $idPermiso;
			$this->nombre= $nombre;
		}
		public static function consultarTodos()
		{
			$listPermiso=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT * FROM permiso");
			foreach ($sql->fetchAll() as $permiso) {
				$listPermiso[]=$permiso;
			}
			return $listPermiso;
		}
		
		public static function buscarId($id)
		{
			$conexionBD=BD::crearInstancia();
			$sql= $conexionBD->prepare("SELECT * FROM permiso WHERE idPermiso=?");
			$sql->execute(arrasy($id));
			$permiso=$sql->fetch();
			return new Permiso($permiso['idPermiso'],$permiso['nombre']);
		}
	}
 ?>