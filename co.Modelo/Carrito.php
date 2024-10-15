<?php 
class Carrito{
	public $id;
	public $descripcion;
	public $cantidad;
	public $subtotal;
	public $producto;
	public $venta;
	public function __construct($id,$descripcion,$cantidad,$subtotal,$producto,$venta){
		$this->id = $id;
		$this->descripcion = $descripcion;
		$this->cantidad = $cantidad;
		$this->subtotal = $subtotal;
		$this->producto = $producto;
		$this->venta = $venta;
	}
	
	public static function crear($id,$descripcion,$cantidad,$subtotal,$producto,$venta){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO carrito values(?,?,?,?,?,?)");
		$sql->execute(array($id,$descripcion,$cantidad,$subtotal,$producto,$venta));
		return true;
	}
	public static function validar($id){
		$listDetalle = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.id as id, c.descripcion as descripcion, c.cantidad as cantidad, c.subtotal as subtotal,c.producto as producto,
			p.nombre as nombre, p.valorVenta as valor, c.venta as venta FROM carrito as c inner join producto as p on p.idProducto=c.producto WHERE id=?");
		$sql->execute(array($id));

		if ($sql->num_rows > 0) {
			return true;
		}else{
			return false;
		}
	}
	public static function conteo(){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("select count(*) as contador from carrito");
		$id=$sql->fetch();
		return $id['contador'];

	}
	public static function consultarTodosInner(){
		$listDetalle = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT c.id as id,c.descripcion as descripccion,c.cantidad as cantidad,c.subtotal as subtotal,c.producto as producto,p.nombre as nombre,p.valorVenta as valor FROM carrito inner join producto as p on p.idProducto=c.producto ");
		foreach ($sql->fetchAll() as $detalle) {
			$listDetalle[]=$detalle;
		}
		return $listDetalle;
	}
	public static function consultarId($id){
		$listDetalle = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.id as id, c.descripcion as descripcion, c.cantidad as cantidad, c.subtotal as subtotal,c.producto as producto,
			p.nombre as nombre, p.valorVenta as valor, c.venta as venta FROM carrito as c inner join producto as p on p.idProducto=c.producto WHERE id=?");
		$sql->execute(array($id));
		$detalle=$sql->fetch();
		return new Carrito(['id'],$detalle['descripcion'],$detalle['cantidad'],$detalle['subtotal'],$detalle['producto'],$detalle['venta']);

	}
	public static function editar($descripcion,$cantidad,$subtotal,$producto,$venta,$id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE carrito SET descripcion=?, cantidad=?, subtotal=?, producto=?,venta=? WHERE id=?");
		$sql->execute(array($descripcion,$cantidad,$subtotal,$producto,$venta,$id));
		$cliente=$sql->fetch();
		return true;

	}
	public static function eliminar($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM carrito WHERE id=?");
		$sql->execute(array($id));
		return true;
	}
	public static function buscarVenta($venta){
		$listDetalle=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.id as id, c.descripcion as descripcion, c.cantidad as cantidad, c.subtotal as subtotal,c.producto as producto,
			p.nombre as nombre, p.valorVenta as valor, c.venta as venta FROM carrito as c inner join producto as p on p.idProducto=c.producto 
			where venta = ?");
		$sql->execute(array($venta));
		foreach ($sql->fetchAll() as $detalle) {
			$listDetalle[]=$detalle;
		}
		
		return $listDetalle;
	}
	public static function buscarProductoVenta($venta,$producto){
		$listDetalle=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.id as id, c.descripcion as descripcion, c.cantidad as cantidad, c.subtotal as subtotal,c.producto as producto,
			p.nombre as nombre, p.valorVenta as valor, c.venta as venta FROM carrito as c inner join producto as p on p.idProducto=c.producto WHERE venta = ? and producto = ?");
		$sql->execute(array($venta,$producto));
		foreach ($sql->fetchAll() as $detalle) {
			$listDetalle[]=$detalle;
		}
		return $listDetalle;
	}
}

?>