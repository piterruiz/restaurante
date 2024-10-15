<?php 
	/**
	 * 
	 */
	class Productosalterados
	{
		public $id; 
		public $nombre;
		public $cantidadAnterior; 
		public $cantidadAgregada; 
		public $fecha; 
		public $totalExistencia;
		public $usuario;

		public function __construct($id,$nombre,$cantidadAnterior,$cantidadAgregada,$fecha,$totalExistencia,$usuario)
		{
			$this->id=$id;
			$this->nombre=$nombre;
			$this->cantidadAnterior=$cantidadAnterior;
			$this->cantidadAgregada=$cantidadAgregada;
			$this->fecha=$fecha;
			$this->usuario=$usuario;
			$this->totalExistencia=$totalExistencia;
		}
		public static function consultarTodos()
		{
			$listProducto=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT * FROM productosalterados order BY fecha desc" );
			foreach ($sql->fetchAll() as $producto) {
				$listProducto[]= $producto;
			}
			//print_r($producto);
			return $listProducto;

		}
		public static function consultarTodosInner()
		{
			$listProducto=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT p.id as id, p.nombre as nombre, p.cantidadAnterior as cantidadAnterior, p.cantidadAgregada as cantidadAgregada, p.fecha as fecha,p.totalExistencia as totalExistencia, p.usuario as usuario, u.nombre as nombreUsuario FROM productosalterados as p INNER JOIN usuario as u on u.idUsuario = p.usuario order BY p.fecha desc");
			foreach ($sql->fetchAll() as $producto) {
				$listProducto[]= $producto;
			}
			return $listProducto;

		}
		public static function consultarNombreInner($nombre)
		{
			$listProducto=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT p.id as id, p.nombre as nombre, p.cantidadAnterior as cantidadAnterior, p.cantidadAgregada as cantidadAgregada, p.fecha as fecha,p.totalExistencia as totalExistencia, p.usuario as usuario, u.nombre as nombreUsuario FROM productosalterados as p INNER JOIN usuario as u on u.idUsuario = p.usuario Where p.nombre=? order BY p.fecha desc");
			$sql->execute(array($nombre));
			foreach ($sql->fetchAll() as $producto) {
				$listProducto[]= $producto;
			}
			return $listProducto;

		}
		
		
		public static function crear($nombre,$cantidadAnterior,$cantidadAgregada,$totalExistencia,$usuario)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("INSERT INTO productosalterados(nombre,cantidadAnterior,cantidadAgregada,fecha,totalExistencia,usuario)values(?,?,?,now(),?,?)");
			$sql->execute(array($nombre,$cantidadAnterior,$cantidadAgregada,$totalExistencia,$usuario));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}

	}

?>