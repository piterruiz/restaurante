<?php 

class Detallecredito
{
	public $idDetalle;
	public $fecha;
	public $abono;
	public $idCredito;
	public $modopago; 
	public function __construct($idDetalle,$fecha,$abono,$idCredito,$modopago)
	{
		$this->idDetalle=$idDetalle;
		$this->fecha=$fecha;
		$this->abono=$abono;
		$this->idCredito=$idCredito;
		$this->modopago=$modopago;
	}
	public static function consultarTodos(){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN modopagocredito as m on m.idModopago=d.modopago");
		$sql->execute();
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function crear($abono,$idCredito,$modopago){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO detallecredito (fecha,abono,idCredito,modopago)values(now(),?,?,?)");
		$sql->execute(array($abono,$idCredito,$modopago));
		if (!$sql) {
			return false;
		}else{
			return true;
		}
	}
	public static function editar($idDetalle,$abono,$idCredito,$modopago){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE detallecredito set fecha=now(),abono=?,idCredito=?,modopago=? where idDetalle=?");
		$sql->execute(array($abono,$idCredito,$modopago,$idDetalle));
		if (!$sql) {
			return false;
		}else{
			return true;
		}
	}
	public static function eliminar($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM detallecredito where idDetalle=?");
		$sql->execute(array($id));
		if (!$sql) {
			return false;
		}else{
			return true;
		}
	}

	public static function buscarId($id){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN modopagocredito as m on m.idModopago=d.modopago where idDetalle=?");
		$sql->execute(array($id));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarCredito($id){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN modopagocredito as m on m.idModopago=d.modopago where c.idCredito=?");
		$sql->execute(array($id));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarCreditoInner($id){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,v.total as total,cl.nombre as nombre,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN venta as v on v.idVenta=c.idVenta INNER JOIN modopagocredito as m on m.idModopago=d.modopago INNER JOIN cliente as cl ON cl.idCliente=v.cliente where c.idCredito=?");
		$sql->execute(array($id));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFecha($fecha){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,v.total as total,cl.nombre as nombre,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN venta as v on v.idVenta=c.idVenta INNER JOIN modopagocredito as m on m.idModopago=d.modopago INNER JOIN cliente as cl ON cl.idCliente=v.cliente where d.fecha BETWEEN ? and ?");
		$sql->execute(array($fecha." 00:00:00",$fecha." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function fechas($fecha1,$fecha2){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM detallecredito  where fecha BETWEEN ? and ?");
		$sql->execute(array($fecha1."-01 00:00:00",$fecha2."-01 00:00:00"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function rangoFechas($fecha1,$fecha2){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM detallecredito  where fecha BETWEEN ? and ?");
		$sql->execute(array($fecha1." 00:00:00",$fecha2." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFechaCredito($fecha,$usuario){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,v.total as total,cl.nombre as nombre,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN venta as v on v.idVenta=c.idVenta INNER JOIN modopagocredito as m on m.idModopago=d.modopago INNER JOIN cliente as cl ON cl.idCliente=v.cliente where v.usuario = ? and d.fecha BETWEEN ? and ?");
		$sql->execute(array($usuario,$fecha." 00:00:00",$fecha." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFechaCreditoId($fecha,$usuario,$credito){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,v.total as total,cl.nombre as nombre,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN venta as v on v.idVenta=c.idVenta INNER JOIN modopagocredito as m on m.idModopago=d.modopago INNER JOIN cliente as cl ON cl.idCliente=v.cliente where v.usuario = ? and d.idCredito=? and d.fecha BETWEEN ? and ?");
		$sql->execute(array($usuario,$credito,$fecha." 00:00:00",$fecha." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFechaUsuario($usuario,$fecha){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT sum(d.abono) as abono FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN venta as v on v.idVenta=c.idVenta INNER JOIN modopagocredito as m on m.idModopago=d.modopago INNER JOIN cliente as cl ON cl.idCliente=v.cliente INNER JOIN usuario as u on u.idUsuario=v.usuario where u.idUsuario=? and d.fecha BETWEEN ? and ?");
		$sql->execute(array($usuario,$fecha." 00:00:00",$fecha." 23:59:59"));
		$total=$sql->fetch();
		return $total;
	}
	public static function buscarFechaUsuarioList($usuario,$fecha){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,v.total as total,cl.nombre as nombre,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN venta as v on v.idVenta=c.idVenta INNER JOIN modopagocredito as m on m.idModopago=d.modopago INNER JOIN cliente as cl ON cl.idCliente=v.cliente INNER JOIN usuario as u on u.idUsuario=v.usuario where u.idUsuario=? and d.fecha BETWEEN ? and ?");
		$sql->execute(array($usuario,$fecha." 00:00:00",$fecha." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFechaUsuarioListFechas($usuario,$fecha,$fecha2){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,v.total as total,cl.nombre as nombre,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN venta as v on v.idVenta=c.idVenta INNER JOIN modopagocredito as m on m.idModopago=d.modopago INNER JOIN cliente as cl ON cl.idCliente=v.cliente INNER JOIN usuario as u on u.idUsuario=v.usuario where u.idUsuario=? and d.fecha BETWEEN ? and ?");
		$sql->execute(array($usuario,$fecha." 00:00:00",$fecha2." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFechaTodosListFechas($fecha,$fecha2){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,v.total as total,cl.nombre as nombre,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN venta as v on v.idVenta=c.idVenta INNER JOIN modopagocredito as m on m.idModopago=d.modopago INNER JOIN cliente as cl ON cl.idCliente=v.cliente INNER JOIN usuario as u on u.idUsuario=v.usuario where d.fecha BETWEEN ? and ?");
		$sql->execute(array($fecha." 00:00:00",$fecha2." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
	public static function buscarFiltroInner($nombre){
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare('SELECT d.idDetalle as idDetalle,d.fecha as fecha,d.abono as abono,d.idCredito as credito, c.idVenta as venta,m.idModopago as modopago,m.nombre as nombreModopago FROM detallecredito as d INNER JOIN credito as c on c.idCredito=d.idCredito INNER JOIN modopagocredito as m on m.idModopago=d.modopago WHERE d.fecha LIKE ? OR m.nombre LIKE ?');
		$sql->execute(array("%".$nombre."%","%".$nombre."%"));
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;
	}
}

?>