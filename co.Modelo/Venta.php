<?php 
	/**
	 * 
	 */
	class Venta
	{
		public $idVenta;
		public $fecha;
		public $total;
		public $pagacon;
		public $cambio;
		public $descuento;
		public $usuario;
		public $cliente;
		public $mesa;
		public $domiciliario;
		public $modopago;
		public $estadopedido;
		public function __construct($idVenta,$fecha,$total,$pagacon,$cambio,$descuento,$usuario,$cliente,$mesa,$domiciliario,$modopago,$estadopedido)
		{
			$this->idVenta=$idVenta;
			$this->fecha=$fecha;
			$this->total=$total;
			$this->pagacon=$pagacon;
			$this->cambio=$cambio;
			$this->descuento=$descuento;
			$this->usuario=$usuario;
			$this->cliente=$cliente;
			$this->mesa=$mesa;
			$this->domiciliario=$domiciliario;
			$this->modopago=$modopago;
			$this->estadopedido=$estadopedido;
		}
		public static function crear($total,$pagacon,$cambio,$descuento,$usuario,$cliente,$mesa,$domiciliario,$modopago,$estadopedido)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("INSERT INTO venta(fecha,total,pagacon,cambio,descuento,usuario,cliente,mesa,domiciliario,modopago,estadopedido)values(now(),?,?,?,?,?,?,?,?,?,?)");
			$sql->execute(array($total,$pagacon,$cambio,$descuento,$usuario,$cliente,$mesa,$domiciliario,$modopago,$estadopedido));
			if ($sql) {
				return true;

			}else{
				return false;
			}
		}
		public static function consultarTodos(){
			$listaVenta=[];
			$conexionBD= BD::crearInstancia();
			$sql=$conexionBD->prepare("SELCET * FROM venta");
			foreach ($sql->fetchAll() as $valor) {
				$listaVenta[]=$valor;
			}
			return $listaVenta;
		}
		public static function editar($total,$pagacon,$cambio,$descuento,$usuario,$cliente,$mesa,$domiciliario,$modopago,$estadopedido,$id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE venta set total=?, pagacon=?, cambio=?, descuento=?,usuario=?,cliente=?,mesa=?,domiciliario=?,modopago=?,estadopedido=? WHERE idVenta=?");
			$sql->execute(array($total,$pagacon,$cambio,$descuento,$usuario,$cliente,$mesa,$domiciliario,$modopago,$estadopedido,$id));
			if ($sql) {
				return true;

			}else{
				return false;
			}
		}
		public static function eliminar($id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("DELETE FROM venta WHERE idVenta=?");
			$sql->execute(array($id));
			if ($sql) {
				return true;
			}else{
				return false;
			}
		}
		
		public static function buscarId($id)
		{
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM venta WHERE idVenta=?");
			$sql->execute(array($id));
			$venta=$sql->fetch();
			return new Venta($venta['idVenta'],$venta['fecha'],$venta['total'],$venta['pagacon'],$venta['cambio'],$venta['descuento'],$venta['usuario'],$venta['cliente'],$venta['mesa'],$venta['domiciliario'],$venta['modopago'],$venta['estadopedido']);
		}
		public static function buscarIdInner($id)
		{
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT v.idVenta as idVenta,v.fecha as fecha,v.total as total,v.usuario as usuario,u.nombre as nombreUsuario,v.cliente as cliente,cl.nombre as nombreCliente,v.modopago as modopago,m.nombre as nombreModopago from venta as v INNER JOIN usuario as u ON u.idUsuario=v.usuario INNER JOIN cliente as cl on cl.idCliente =v.cliente INNER JOIN modopago as m on m.idModopago=v.modopago where v.idVenta=? order by v.fecha desc");
			$sql->execute(array($id));
			foreach ($sql->fetchAll() as $key => $value) {
				$list[]=$value;
			}
			return $list;
		}
		public static function buscarUsuario($id,$fech)
		{
			//print_r("".$fech);
			$listVenta=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT SUM(total) as id FROM venta WHERE usuario = ".$id." and fecha BETWEEN '".$fech." 00:00:00' and '".$fech." 23:59:59'");
			$sql->execute();
			$maximo=$sql->fetch();
			//print_r("MOdelo".$maximo['id']);
			return $maximo['id'];
		}
		public static function buscarUsuarioFecha($id,$fech)
		{
			//print_r("".$fech);
			$listVenta=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM venta WHERE usuario = ".$id." and fecha BETWEEN '".$fech." 00:00:00' and '".$fech." 23:59:59'");
			$sql->execute();
			foreach ($sql->fetchAll() as $key => $value) {
				$listVenta[]=$value;
				
			}
			
			return $listVenta;
		}
		public static function ventaDia($fech)
		{
			//print_r("".$fech);
			$listVenta=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM venta WHERE fecha BETWEEN '".$fech." 00:00:00' and '".$fech." 23:59:59'");
			$sql->execute();
			foreach ($sql->fetchAll() as $key => $value) {
				$listVenta[]=$value;
			}
			
			return $listVenta;
		}
		public static function buscarUsuarioFechas($id,$fech,$fech2)
		{
			//print_r("".$fech);
			$listVenta=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM venta WHERE usuario = ".$id." and fecha BETWEEN '".$fech." 00:00:00' and '".$fech2." 23:59:59'");
			$sql->execute();
			foreach ($sql->fetchAll() as $key => $value) {
				$listVenta[]=$value;
				
			}
			
			return $listVenta;
		}

		public static function maxId(){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT MAX(idVenta) as idVenta FROM venta");
			$venta=$sql->fetch();
			//print_r("venta modelo ".$venta);
			return $venta['idVenta'];
		}
		public static function consultarFechas($fecha1,$fecha2)
		{
			//print_r("".$fech);
			$listVenta=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT v.idVenta,v.fecha as fecha, v.total as total,v.usuario as usuario,u.nombre as nombre,v.modopago as modopago,m.nombre as nombreModopago FROM venta as v INNER JOIN usuario as u on u.idUsuario=v.usuario INNER JOIN modopago as m on v.modopago=m.idModopago WHERE fecha BETWEEN '".$fecha1." 00:00:00' and '".$fecha2." 23:59:59'");
			$sql->execute();
			foreach ($sql->fetchAll() as $key => $value) {
				$listVenta[]=$value;
				
			}
			
			return $listVenta;
		}
		public static function totalFechas($fecha1,$fecha2)
		{
			//print_r("".$fech);
			$listVenta=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT SUM(total) as total FROM venta WHERE fecha BETWEEN '".$fecha1."-01 00:00:00' and '".$fecha2."-01 00:00:00'");
			$sql->execute();
			$total=$sql->fetch();
			
			return $total['total'];
		}
		public static function fechas($fecha1,$fecha2)
		{
			//print_r("".$fech);
			$listVenta=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM venta WHERE fecha BETWEEN '".$fecha1."-01 00:00:00' and '".$fecha2."-01 00:00:00'");
			$sql->execute();
			foreach ($sql->fetchAll() as $key => $value) {
				$listVenta[]=$value;
			};
			
			return $listVenta;
		}
		public static function buscarTodosInner(){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT v.idVenta as idVenta,v.fecha as fecha,v.total as total,v.usuario as usuario,u.nombre as nombreUsuario,v.cliente as cliente,cl.nombre as nombreCliente,v.modopago as modopago,m.nombre as nombreModopago from venta as v INNER JOIN usuario as u ON u.idUsuario=v.usuario INNER JOIN cliente as cl on cl.idCliente =v.cliente INNER JOIN modopago as m on m.idModopago=v.modopago order by v.fecha desc");
			$sql->execute();
			foreach ($sql->fetchAll() as $key => $value) {
				$list[]=$value;
			}
			return $list;
		}
		public static function buscarFiltroInner($filtro){
			$list=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT v.idVenta as idVenta,v.fecha as fecha,v.total as total,v.usuario as usuario,u.nombre as nombreUsuario,v.cliente as cliente,cl.nombre as nombreCliente,v.modopago as modopago,m.nombre as nombreModopago from venta as v INNER JOIN usuario as u ON u.idUsuario=v.usuario INNER JOIN cliente as cl on cl.idCliente =v.cliente INNER JOIN modopago as m on m.idModopago=v.modopago WHERE v.fecha LIKE ? OR cl.nombre LIKE ? OR u.nombre LIKE ? OR m.nombre LIKE ? ");
			$sql->execute(array("%".$filtro."%","%".$filtro."%","%".$filtro."%","%".$filtro."%"));
			foreach ($sql->fetchAll() as $key => $value) {
				$list[]=$value;
			}
			return $list;
		}

	}
?>