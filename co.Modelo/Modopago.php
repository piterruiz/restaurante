<?php 
	/**
	 * 
	 */
	class ModoPago
	{
		public $idModopago;
		public $nombre;

		public function __construct($idModopago,$nombre)
		{
			$this->idModopago = $idModopago;
			$this->nombre = $nombre;
		}
		public static function consultarTodos()
		{
			$listModopago= [];
			$conexionBD=BD::crearInstancia();
			$sql= $conexionBD->query("SELECT * FROM modopago");
			foreach ($sql->fetchAll() as $modopago) {
				$listModopago[]=$modopago;
			}
			return $listModopago;
		} 
		public static function buscarId($id)
		{
			$conexionBD=BD::crearInstancia();
			$sql= $conexionBD->prepare("SELECT * FROM modopago WHERE idModopago=?");
			$sql->execute(array($id));
			$modopago=$sql->fetch();
			return new Modopago($modopago['idModopago'],$modopago['nombre']);
		}
	}
 ?>