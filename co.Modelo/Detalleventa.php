<?php 
class Detalleventa{
	public $idDetventa;
	public $descripcion;
	public $cantidad;
	public $descuento;
	public $subtotal;
	public $producto;
	public $venta;
	public $costo;
	public $valor;
	public function __construct($idDetventa,$descripcion,$cantidad,$descuento,$subtotal,$producto,$venta,$costo,$valor){
		$this->idDetventa = $idDetventa;
		$this->descripcion = $descripcion;
		$this->cantidad = $cantidad;
		$this->descuento = $descuento;
		$this->subtotal = $subtotal;
		$this->producto = $producto;
		$this->venta = $venta;
		$this->costo = $costo;
		$this->valor = $valor;
	}
	public static function consultarTodos(){
		$listDetalle = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM detalleventa");
		foreach ($sql->fetchAll() as $detalle) {
			$listDetalle[]=$detalle;
		}
		return $listDetalle;
	}
	public static function consultarId($id){
		$listDetalle = [];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM detalleventa WHERE idDetventa=?");
		$sql->execute(array($id));
		$detalle=$sql->fetch();
		return new Detalleventa(['idDetventa'],$detalle['descripcion'],$detalle['cantidad'],$detalle['descuento'],$detalle['subtotal'],$detalle['producto'],$detalle['venta'],$detalle['costo'],$detalle['valor']);
		
	}
	public static function crear($descripcion,$cantidad,$descuento,$subtotal,$producto,$venta,$costo,$valor){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO detalleventa(descripcion,cantidad,descuento,subtotal,producto,venta,costo,valor)values(?,?,?,?,?,?,?,?)");
		$sql->execute(array($descripcion,$cantidad,$descuento,$subtotal,$producto,$venta,$costo,$valor));
		return true;
	}
	public static function editar($descripcion,$cantidad,$descuento,$subtotal,$producto,$venta,$costo,$valor,$id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE detalleventa SET descripcion=?, cantidad=?, descuento, subtotal=?, producto=?, venta=?, costo=?, valor=? WHERE idDetventa=?");
		$sql->execute(array($descripcion,$cantidad,$descuento,$subtotal,$producto,$venta,$costo,$valor,$id));
		//$cliente=$sql->fetch();
		return true;
		
	}
	public static function editarCostoValor($costo,$valor,$id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE detalleventa SET costo=?, valor=? WHERE idDetventa=?");
		$sql->execute(array($costo,$valor,$id));
		//$cliente=$sql->fetch();
		return true;
		
	}
	public static function eliminar($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM detalleventa WHERE idDetventa=?");
		$sql->execute(array($id));
		return true;
	}
	public static function buscarVenta($venta){
		$listDetalle=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM detalleventa WHERE venta = ?");
		$sql->execute(array($venta));
		foreach ($sql->fetchAll() as $detalle) {
			$listDetalle[]=$detalle;
		}
		return $listDetalle;
	}
	public static function buscarFechasInner($usuario,$fecha1,$fecha2){
		$listDetalle=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT dt.idDetventa as id,dt.cantidad as cantidad,dt.descripcion as descripcion,,dt.descuento as descuento,dt.subtotal as subtotal,dt.producto as producto,dt.venta as venta,p.nombre as nombreProducto,
			dt.costo as valorCompra,dt.valor as valorVenta,p.cantidad as cantidadActual,
			v.fecha as fecha,v.usuario as usuario,u.nombre as nombreUsuario,u.negocio as negocio,n.nomnbre as nombreNegocio,m.nombre as nombreModopago FROM detalleventa as dt INNER JOIN 
			producto as p ON p.idProducto=dt.producto INNER JOIN venta as v ON v.idVenta=dt.venta INNER JOIN
			usuario as u ON u.idUsuario=v.usuario INNER JOIN modopago as m on m.idModopago=v.modopago INNER JOIN negocio as n on n.idNegocio=u.negocio WHERE v.usuario=? and v.fecha BETWEEN ? and ? ");
		$sql->execute(array($usuario,$fecha1." 00:00:00",$fecha2." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$listDetalle[]=$value;
		}
		return $listDetalle;
	}
	public static function buscarFechasInnerTodos($fecha1,$fecha2){
		$listDetalle=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT dt.idDetventa as id,dt.cantidad as cantidad, dt.descripcion as descripcion,dt.descuento as descuento,dt.subtotal as subtotal,dt.producto as producto,dt.venta as venta,p.nombre as nombreProducto,
			dt.costo as valorCompra,dt.venta as valorVenta,dt.valor as valor,v.modopago as modopago,m.nombre as nombreModopago,p.cantidad as cantidadActual,
			v.fecha as fecha,v.usuario as usuario,u.nombre as nombreUsuario,u.negocio as negocio,n.nomnbre as nombreNegocio FROM detalleventa as dt INNER JOIN 
			producto as p ON p.idProducto=dt.producto INNER JOIN venta as v ON v.idVenta=dt.venta INNER JOIN
			usuario as u ON u.idUsuario=v.usuario INNER JOIN modopago as m on m.idModopago=v.modopago INNER JOIN negocio as n on n.idNegocio=u.negocio WHERE v.fecha BETWEEN ? and ? ");
		$sql->execute(array($fecha1." 00:00:00",$fecha2." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$listDetalle[]=$value;
		}
		return $listDetalle;
	}
	public static function buscarVentaInner($venta){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetventa as idDetventa, d.cantidad as cantidad,d.descripcion as descripcion, d.subtotal as subtotal, d.producto as producto, p.nombre as nombreProducto, d.venta as venta,d.costo as costo, d.valor as valor FROM detalleventa as d INNER JOIN producto as p ON p.idProducto=d.producto INNER JOIN venta as v on v.idVenta=d.venta where d.venta=?");
		$sql->execute(array($venta));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarProducto($id){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM Detalleventa where producto=?");
		$sql->execute(array($id));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;	
		}
		return $list;

	}
	public static function productoMasVendido($fecha1, $fecha2){
		$conexionBD=BD::crearInstancia();
		$sql = $conexionBD->prepare("
			SELECT p.nombre as nombreProducto, SUM(dv.cantidad) as cantidadVendida
			FROM detalleventa as dv
			INNER JOIN producto as p ON p.idProducto = dv.producto
			INNER JOIN venta as v ON v.idVenta = dv.venta
			WHERE v.fecha BETWEEN ? AND ?
			GROUP BY p.nombre
			ORDER BY cantidadVendida DESC
			LIMIT 1
			");
		$sql->execute(array($fecha1." 00:00:00", $fecha2." 23:59:59"));
		return $sql->fetch();
	}
	public static function productoMenosVendido($fecha1, $fecha2) {
		$conexionBD = BD::crearInstancia();
		$sql = $conexionBD->prepare("
			SELECT dt.producto, p.nombre as nombreProducto, SUM(dt.cantidad) as totalVendido 
			FROM detalleventa dt 
			INNER JOIN producto p ON dt.producto = p.idProducto 
			INNER JOIN venta v ON dt.venta = v.idVenta 
			WHERE v.fecha BETWEEN ? AND ? 
			GROUP BY dt.producto 
			ORDER BY totalVendido ASC 
			LIMIT 1
			");

		$sql->execute(array($fecha1 . " 00:00:00", $fecha2 . " 23:59:59"));
		$producto = $sql->fetch();

		return $producto;
	}
	public static function buscarProductoFechas($idProducto, $fecha1, $fecha2) {
		
		$conexionBD = BD::crearInstancia();
		
    // Preparar la consulta SQL
		$sql = $conexionBD->prepare("
			SELECT dt.producto, p.nombre AS nombreProducto, SUM(dt.cantidad) AS totalVendido 
			FROM detalleventa dt 
			INNER JOIN producto p ON dt.producto = p.idProducto 
			INNER JOIN venta v ON dt.venta = v.idVenta 
			WHERE v.fecha BETWEEN ? AND ? 
			AND dt.producto = ?
			GROUP BY dt.producto, p.nombre
			");

    // Ejecutar la consulta
		$sql->execute(array($fecha1 . " 00:00:00", $fecha2 . " 23:59:59", $idProducto));

    // Obtener los resultados
		$detalles = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Imprimir los detalles para ver qué valores exactos se están obteniendo
		

    // Devolver los resultados
		return $detalles;
	}

	public static function buscarPorFechasProducto($fecha1, $fecha2) {
		$listDetalle = [];
		$conexionBD = BD::crearInstancia();

    // Preparar la consulta SQL
		$sql = $conexionBD->prepare("
			SELECT dt.producto, p.nombre as nombreProducto, 
			SUM(dt.cantidad) as totalVendido, 
			SUM(dt.subtotal) as totalIngresos 
			FROM detalleventa dt 
			INNER JOIN producto p ON dt.producto = p.idProducto 
			INNER JOIN venta v ON dt.venta = v.idVenta 
			WHERE v.fecha BETWEEN ? AND ? 
			GROUP BY dt.producto
			");

    // Ejecutar la consulta, pasando los parámetros de fecha
		$sql->execute(array($fecha1 . " 00:00:00", $fecha2 . " 23:59:59"));

    // Obtener todos los resultados en un array asociativo
		$listDetalle = $sql->fetchAll(PDO::FETCH_ASSOC);



    // Retornar los resultados
		return $listDetalle;
	}
}

?>