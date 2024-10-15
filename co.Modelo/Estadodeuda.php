<?php 
	class Estadodeuda{
		public $idEstado;
		public $nombre;
		public function __construct($idEstado,$nombre){
			$this->idEstado=$idEstado;
			$this->nombre=$nombre;
		}
		public static function consultarTodos(){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT * FROM estadodeuda");
			foreach ($sql->fetchAll() as $value) {
				$list[]=$value;
			}
			return $list;
		}
	}
 ?>