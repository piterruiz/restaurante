<?php 
	/**
	 * 
	 */
	class Orden
	{
		public $idOrden;
		public $mesa;
		public $domiciliario;
		public $estadoPedido;
		function __construct($idOrden,$mesa,$domiciliario,$estadoPedido)
		{
			$this->idOrden = $idOrden;
			$this->mesa = $mesa;
			$this->domiciliario = $domiciliario;
			$this->estadoPedido = $estadoPedido;
		}
		public function consultarTodos(){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql = $conexionBD->query("SELECT * FROM orden");
			$sql->execute();
			foreach ($sql->fetchAll() as $key => $value) {
				$list[]=$value;
			}
			return $list[];
		}
		public function crear($mesa,$domiciliario,$estadoPedido){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("INSERT INTO orden (mesa,domiciliario,estadoPedido)values(?,?,?)");
			$sql->execute(array($mesa,$domiciliario,$estadoPedido));
			if ($sql) {
				return true;
			}else{
				return false:
			}

		}
		public function editarMesa($mesa,$idOrden){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE orden SET mesa = ? where idOrden = ?");
			$sql->execute(array($mesa,$idOrden));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public function editarEstado($estado,$idOrden){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE orden SET estadoPedido = ? where idOrden = ?");
			$sql->execute(array($estado,$idOrden));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		} 
		public function eliminar($idOrden){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("DELETE FROM orden where idOrden = ?");
			$sql->execute(array($idOrden));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public function buscarMesa($mesa){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM orden Where mesa=?");
			$sql->execute(array($mesa));
			foreach ($sql->fetchAll() as $key => $value) {
				$list[]=$value;
			}
			return $list;
		}
		public function buscarEstado($estado){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM orden Where estadoPedido=?");
			$sql->execute(array($estado));
			foreach ($sql->fetchAll() as $key => $value) {
				$list[]=$value;
			}
			return $list;
		}
	}
 ?>