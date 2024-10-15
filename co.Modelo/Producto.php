<?php 
	/**
	 * 
	 */
	class Producto
	{
		public $idProducto;
		public $codigo;
		public $nombre;
		public $valorCompra;
		public $valorVenta;
		public $mayoreo;
		public $cantidad;
		public $stok;
		public $imagen;
		public $categoria;
		public function __construct($idProducto,$codigo,$nombre,$valorCompra,$valorVenta,$mayoreo,$cantidad,$stok,$imagen,$categoria)
		{
			$this->idProducto=$idProducto;
			$this->codigo=$codigo;
			$this->nombre=$nombre;
			$this->valorCompra=$valorCompra;
			$this->valorVenta=$valorVenta;
			$this->mayoreo=$mayoreo;
			$this->cantidad=$cantidad;
			$this->stok=$stok;
			$this->imagen=$imagen;
			$this->categoria=$categoria;
		}
		public static function consultarTodos()
		{
			$listProducto=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT * FROM producto order BY codigo" );
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
			$sql=$conexionBD->query("SELECT p.idProducto as id, p.codigo as codigo, p.nombre as nombre, p.valorCompra as valorCompra, p.valorVenta as valorVenta,p.mayoreo as mayoreo, p.cantidad as cantidad, p.stok as stok, p.imagen as imagen, c.idCategoria as categoria, c.nombre as nombreCategoria FROM producto as p INNER JOIN categoria as c on c.idCategoria = p.categoria order BY nombre");
			foreach ($sql->fetchAll() as $producto) {
				$listProducto[]= $producto;
			}
			return $listProducto;

		}
		public static function consultarTodosInnerStok()
		{
			$listProducto=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT p.idProducto as id, p.codigo as codigo, p.nombre as nombre, p.valorCompra as valorCompra, p.valorVenta as valorVenta,p.mayoreo as mayoreo, p.cantidad as cantidad, p.stok as stok, p.imagen as imagen, c.idCategoria as categoria, c.nombre as nombreCategoria FROM producto as p INNER JOIN categoria as c on c.idCategoria = p.categoria where p.cantidad<=p.stok order BY codigo");
			foreach ($sql->fetchAll() as $producto) {
				$listProducto[]= $producto;
			}
			return $listProducto;

		}
		public static function contarProducto(){

			$conexionBD=BD::crearInstancia();
			$sql= $conexionBD->prepare("SELECT count(idProducto) as total FROM producto" );
			$sql->execute();
			$producto=$sql->fetch();


			return $producto['total'];
		}
		public static function buscarId($id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM producto WHERE idProducto=?");
			$sql->execute(array($id));
			$producto= $sql->fetch();
			return new Producto($producto['idProducto'],$producto['codigo'],$producto['nombre'],$producto['valorCompra'],$producto['valorVenta'],$producto['mayoreo'],$producto['cantidad'],$producto['stok'],$producto['imagen'],$producto['categoria']);
		}
		public static function buscarCodigo($id)
		{
			//print_r("Codigo Modelo = ".$id);

			$conexionBD=BD::crearInstancia();
			$conexionBD->query("SET NAMES 'utf8'");
			$sql=$conexionBD->prepare("SELECT * FROM producto WHERE codigo=? ");

			$sql->execute(array($id));
			$producto=$sql->fetch();
			/*foreach ($sql->fetchAll() as $key => $value) {
				print_r($value['codigo']);
			}*/
			return new Producto($producto['idProducto'],$producto['codigo'],$producto['nombre'],$producto['valorCompra'],$producto['valorVenta'],$producto['mayoreo'],$producto['cantidad'],$producto['stok'],$producto['imagen'],$producto['categoria']);
		}
		public static function crear($codigo,$nombre,$valorCompra,$valorVenta,$mayoreo,$cantidad,$stok,$imagen,$categoria)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("INSERT INTO producto(codigo,nombre,valorCompra,valorVenta,mayoreo,cantidad,stok,imagen,categoria)values(?,?,?,?,?,?,?,?,?)");
			$sql->execute(array($codigo,$nombre,$valorCompra,$valorVenta,$mayoreo,$cantidad,$stok,$imagen,$categoria));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public static function editar($codigo,$nombre,$valorCompra,$valorVenta,$mayoreo,$cantidad,$stok,$imagen,$categoria,$id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE producto set codigo=?,nombre=?,valorCompra=?,valorVenta=?,mayoreo=?,cantidad=?,stok=?,imagen=?,categoria=? WHERE idProducto=?");
			$sql->execute(array($codigo,$nombre,$valorCompra,$valorVenta,$mayoreo,$cantidad,$stok,$imagen,$categoria,$id));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public static function editarSinimagen($codigo,$nombre,$valorCompra,$valorVenta,$mayoreo,$cantidad,$stok,$categoria,$id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE producto set codigo=?,nombre=?,valorCompra=?,valorVenta=?,mayoreo=?,cantidad=?,stok=?,categoria=? WHERE idProducto=?");
			$sql->execute(array($codigo,$nombre,$valorCompra,$valorVenta,$mayoreo,$cantidad,$stok,$categoria,$id));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public static function modificar($cantidad,$id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE producto set cantidad=? WHERE idProducto=?");
			$sql->execute(array($cantidad,$id));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public static function editarCantidad($cantidad,$id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE producto set cantidad=cantidad-? WHERE idProducto=?");
			$sql->execute(array($cantidad,$id));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		public static function eliminar($id){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("DELETE FROM producto WHERE idProducto=?");
			$sql->execute(array($id));
			if ($sql) {
				return true;
			}else{
				return false;
			}
			
		}
		public static function stok()
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT count(idProducto) as id FROM producto WHERE cantidad<=stok");
			$sql->execute();
			$producto= $sql->fetch();
			return $producto['id'];
		}
		public static function buscarNombre($nombre){
			$listaProducto=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT p.idProducto as id, p.codigo as codigo, p.nombre as nombre, p.valorCompra as valorCompra, p.valorVenta as valorVenta,p.mayoreo as mayoreo, p.cantidad as cantidad, p.stok as stok, p.imagen as imagen, c.idCategoria as categoria, c.nombre as nombreCategoria FROM producto as p INNER JOIN categoria as c on c.idCategoria = p.categoria  WHERE p.nombre LIKE ? OR p.codigo LIKE ? OR c.nombre LIKE ?");
			$sql->execute(array("%".$nombre."%","%".$nombre."%","%".$nombre."%"));
			foreach ($sql->fetchAll() as $value) {
				$listaProducto[]=$value;
			}
			return $listaProducto;

		}
		public static function buscarNewCodigo($codigo){
			$listaProducto=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM producto where codigo=? ");
			$sql->execute(array($codigo));
			$producto=$sql->fetch();
			return $producto;

		}
		public static function buscarNewNombre($nombre){
			$listaProducto=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM producto where nombre=? ");
			$sql->execute(array($nombre));
			$producto=$sql->fetch();
			return $producto;

		}

	}

?>