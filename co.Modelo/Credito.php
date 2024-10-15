<?php 
class Credito{
	public $idCredito;
	public $fecha;
	public $idVenta;
	public $abono;
	public $estado;

	public function __construct($idCredito,$fecha,$idVenta,$abono,$estado){
		$this->idCredito=$idCredito;
		$this->fecha=$fecha;
		$this->idVenta=$idVenta;
		$this->abono=$abono;
		$this->estado=$estado;
	}
	
	public static function consultarTodos(){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT c.idCredito as idCredito,c.fecha as fecha,c.idVenta as venta,c.abono as abono, c.estado as estado,e.nombre as nombreEstado,v.total as totalVenta,cl.nombre as nombreCliente FROM credito as c INNER JOIN venta as v ON v.idVenta=c.idVenta INNER JOIN estadodeuda as e ON e.idEstado=c.estado INNER JOIN cliente as cl ON cl.idCliente = v.cliente order by c.fecha desc");
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function crear($idVenta,$abono){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO credito(fecha,idVenta,abono,estado)values(now(),?,?,1)");
		$sql->execute(array($idVenta,$abono));
		if (!$sql) {
			return false;
		}else{
			return true;
		}

	}
	public static function editar($idCredito,$idVenta,$abono,$estado){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE credito SET fecha=now(), idVenta=?, abono=?, estado=? WHERE idCredito=? ");
		$sql->execute(array($idVenta,$abono,$estado,$idCredito));
		if (!$sql) {
			return false;
		}else{
			return true;
		}

	}
	public static function eliminar($idCredito){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM credito WHERE idCredito=? ");
		$sql->execute(array($idCredito));
		if (!$sql) {
			return false;
		}else{
			return true;
		}

	}
	public static function buscarId($idCredito){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.idCredito as idCredito,c.fecha as fecha,c.idVenta as venta,c.abono as abono, c.estado as estado,e.nombre as nombreEstado,v.total as totalVenta,cl.nombre as nombreCliente FROM credito as c INNER JOIN venta as v ON v.idVenta=c.idVenta INNER JOIN estadodeuda as e ON e.idEstado=c.estado INNER JOIN cliente as cl ON cl.idCliente = v.cliente WHERE idCredito=? ");
		$sql->execute(array($idCredito));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFecha($fecha){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.idCredito as idCredito,c.fecha as fecha,c.idVenta as venta,c.abono as abono, c.estado as estado,e.nombre as nombreEstado,v.total as totalVenta,cl.nombre as nombreCliente FROM credito as c INNER JOIN venta as v ON v.idVenta=c.idVenta INNER JOIN estadodeuda as e ON e.idEstado=c.estado INNER JOIN cliente as cl ON cl.idCliente = v.cliente WHERE c.fecha BETWEEN ? and ? ");
		$sql->execute(array($fecha.' 00:00:00',$fecha.' 23:59:59'));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarRangoFechas($fecha,$fecha2){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.idCredito as idCredito,c.fecha as fecha,c.idVenta as venta,c.abono as abono, c.estado as estado,e.nombre as nombreEstado,v.total as totalVenta,cl.nombre as nombreCliente FROM credito as c INNER JOIN venta as v ON v.idVenta=c.idVenta INNER JOIN estadodeuda as e ON e.idEstado=c.estado INNER JOIN cliente as cl ON cl.idCliente = v.cliente WHERE c.fecha BETWEEN ? and ? order by c.fecha desc  ");
		$sql->execute(array($fecha.' 00:00:00',$fecha2.' 23:59:59)'));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarNombre($nombre){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.idCredito as idCredito,c.fecha as fecha,c.idVenta as venta,c.abono as abono, c.estado as estado,e.nombre as nombreEstado,v.total as totalVenta,cl.nombre as nombreCliente FROM credito as c INNER JOIN venta as v ON v.idVenta=c.idVenta INNER JOIN estadodeuda as e ON e.idEstado=c.estado INNER JOIN cliente as cl ON cl.idCliente = v.cliente WHERE cl.nombre LIKE ? order by c.fecha desc");
		$sql->execute(array("%".$nombre."%"));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarVenta($venta){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT c.idCredito as idCredito,c.fecha as fecha,c.idVenta as venta,c.abono as abono, c.estado as estado,e.nombre as nombreEstado,v.total as totalVenta,cl.nombre as nombreCliente FROM credito as c INNER JOIN venta as v ON v.idVenta=c.idVenta INNER JOIN estadodeuda as e ON e.idEstado=c.estado INNER JOIN cliente as cl ON cl.idCliente = v.cliente WHERE v.idVenta=? order by c.fecha desc");
		$sql->execute(array($venta));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarVentaID($venta){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM credito  WHERE idVenta=?");
		$sql->execute(array($venta));
		foreach ($sql->fetchAll() as $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function maximoId(){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT MAX(idCredito) as id from credito");
		$sql->execute();
		$max=$sql->fetch();
		return $max;
	}

}
?>