<?php 
	/**
	 * 
	 */
	class Detallemesa
	{
		public $idDetmesa;
		public $cantidad;
		public $costo;
		public $descripcion;
		public $descuento;
		public $producto;
		public $subtotal;
		public $valor;
		public $orden;
		function __construct($idDetmesa,$cantidad,$costo,$descripcion,$descuento,$producto,$subtotal,$valor,$orden)
		{
			$this->idDetmesa = $idDetmesa;
			$this->cantidad = $cantidad;
			$this->costo = $costo;
			$this->descripcion = $descripcion;
			$this->descuento = $descuento;
			$this->producto = $producto;
			$this->subtotal = $subtotal;
			$this->valor = $valor;
			$this->orden = $orden;
		}
		public function buscarOrden($orden){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM detallemesa where orden=?");
			$sql->execute(array($orden));
			foreach ($sql->fetchAll as $key => $value) {
				$list[]=$value;
			}
			return $list;

		}
		public function crear($cantidad,$costo,$descripcion,$descuento,$producto,$subtotal,$valor,$orden){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("INSERT INTO detallemesa (cantidad,costo,descripcion,descuento,producto,subtotal,valor,orden)values(?,?,?,?,?,?,?,?)");
			$sql->execute(array($cantidad,$costo,$descripcion,$descuento,$producto,$subtotal,$valor,$orden));
			if ($sql) {
				return true;
			}else{
				return false:
			}
		}
		public function editar($cantidad,$valor,$subtotal,$orden){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE detallemesa SET cantidad = ?, valor = ?, subtotal = ? where orden = ?");
			$sql->execute(array($cantidad,$valor,$subtotal,$orden));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public function eliminar($idDetmesa){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("DELETE FROM detallemesa WHERE idDetmesa = ?");
			$sql->execute(array($idDetmesa));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
	}

 ?>