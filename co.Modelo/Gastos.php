<?php 

class Gastos
{
	public $idGasto;
	public $fecha;
	public $nombre;
	public $valor;
	public $usuario;

	public function __construct($idGasto,$fecha,$nombre,$valor,$usuario)
	{
		$this->idGasto=$idGasto;
		$this->fecha=$fecha;
		$this->nombre=$nombre;
		$this->valor=$valor;
		$this->usuario=$usuario;
	}
	public function consultarTodos()
	{
		$listGastos=[];
		$conexionBD=BD::crearInstancia();
		$sql= $conexionBD->query("SELECT g.idGasto as idGasto,g.fecha as fecha,g.nombre as nombre,g.valor as valor,g.usuario as user,u.nombre as nombreUsuario,m.nombre as nombreModopago FROM gastos as g inner join usuario as u on g.usuario=u.idUsuario inner join modopago as m on m.idModopago=g.modopago  order by g.fecha desc");
		foreach ($sql->fetchAll() as $gastos) {
			$listGastos[]=$gastos;
		}
		return $listGastos;
	}

	public function consultarUsuario($id,$fecha){
		$listGasto=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM gastos WHERE usuario=? AND fecha BETWEEN ? and ?");
		$sql->execute(array($id,$fecha.' 00:00:00',$fecha.' 23:59:59'));
		foreach ($sql->fetchAll() as $valor) {
			$listGasto[]=$valor;
		}
		return $listGasto;
	}
	public function consultarUsuarioInner($id,$fech){
		$listGasto=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT g.idGasto as idGasto,g.fecha as fecha,g.nombre as nombre,g.valor as valor,g.usuario as user,u.nombre as nombreUsuario,m.nombre as nombreModopago FROM gastos as g inner join usuario as u on g.usuario=u.idUsuario inner join modopago as m on m.idModopago=g.modopago   WHERE g.usuario = ? and g.fecha BETWEEN ? and ? order by fecha desc");
		$sql->execute(array($id,$fech." 00:00:00",$fech." 23:59:59"));
		foreach ($sql->fetchAll() as $valor) {
			$listGasto[]=$valor;
		}
		return $listGasto;
	}
	public function consultarUsuarioInnerFiltro($nombre,$id,$fech){
		$listGasto=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT g.idGasto as idGasto,g.fecha as fecha,g.nombre as nombre,g.valor as valor,g.usuario as user,u.nombre as nombreUsuario,m.nombre as nombreModopago FROM gastos as g inner join usuario as u on g.usuario=u.idUsuario inner join modopago as m on m.idModopago=g.modopago  WHERE g.nombre LIKE ? and g.usuario = ? and g.fecha BETWEEN ? and ? order by fecha desc");
		$sql->execute(array("%".$nombre."%",$id,$fech." 00:00:00",$fech." 23:59:59"));
		foreach ($sql->fetchAll() as $valor) {
			$listGasto[]=$valor;
		}
		return $listGasto;
	}
	public function crear($nombre,$valor,$usuario,$modopago)
	{
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO gastos(fecha,nombre,valor,modopago,usuario)values(now(),?,?,?,?)");
		$sql->execute(array($nombre,$valor,$modopago,$usuario));
		if ($sql) {
			return true;
		}else{
			return false;
		}
		
	}
	public function editar($nombre,$valor,$id)
	{
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE gastos set nombre=?, valor=? WHERE idGasto=?");
		$sql->execute(array($nombre,$valor,$id));
		if ($sql) {
			return true;
		}else{
			return false;
		}
		
	}
	public function eliminar($id)
	{
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM gastos WHERE idGasto=?");
		$sql->execute(array($id));
		if ($sql) {
			return true;
		}else{
			return false;
		}
		
	}
	public static function buscarId($id)
	{
		$listGastos=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM gastos WHERE idGasto=?");
		$sql->execute(array($id));
		$gastos=$sql->fetch();
		return new Gastos($gastos['idGasto'],$gastos['fecha'],$gastos['nombre'],$gastos['valor'],$gastos['modopago'],$gastos['usuario']);
	}
	public static function buscarFecha($fecha)
	{
		$listGastos=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM gastos WHERE fecha=?");
		$sql->execute(array($fecha));
		$gastos=$sql->fetch();
		return new Gastos($gastos['idGasto'],$gastos['fecha'],$gastos['nombre'],$gastos['valor'],$gastos['modopago'],$gastos['usuario']);
	}
	public static function buscarRangoFecha($fecha1,$fecha2)
	{
		$listGastos=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM gastos WHERE fecha BETWEEN ? and ?");
		$sql->execute(array($fecha1." 00:00:00",$fecha2." 23:59:59"));
		$gastos=$sql->fetch();
		return new Gastos($gastos['idGasto'],$gastos['fecha'],$gastos['nombre'],$gastos['valor'],$gastos['modopago'],$gastos['usuario']);
	}
	public static function buscarRangoFechaInner($fecha1,$fecha2)
	{
		$listGastos=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT g.idGasto as idGasto,g.nombre as nombre, g.fecha as fecha,g.valor as valor,g.usuario as usuario,u.nombre as nombreUsuario, m.nombre as nombreModopago FROM gastos as g INNER JOIN usuario as u on u.idUsuario=g.usuario inner join modopago as m on m.idModopago=g.modopago WHERE g.fecha BETWEEN ? and ?");
		$sql->execute(array($fecha1." 00:00:00",$fecha2." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$listGastos[]=$value;
		}
		return $listGastos;
	}
	public static function buscarRangoFechaInnerUsuario($fecha1,$fecha2,$usuario)
	{
		$listGastos=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT g.idGasto as idGasto,g.nombre as nombre, g.fecha as fecha,g.valor as valor,g.usuario as usuario,u.nombre as nombreUsuario, m.nombre as nombreModopago  FROM gastos as g INNER JOIN usuario as u on u.idUsuario=g.usuario inner join modopago as m on m.idModopago=g.modopago WHERE g.usuario=? and g.fecha BETWEEN ? and ?");
		$sql->execute(array($usuario,$fecha1." 00:00:00",$fecha2." 23:59:59"));
		foreach ($sql->fetchAll() as $key => $value) {
			$listGastos[]=$value;
		}
		return $listGastos;
	}
	public static function buscarUsuario($id,$fech)
	{
			//print_r("".$fech);
		
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT SUM(valor) as id FROM gastos WHERE usuario = ".$id." and fecha BETWEEN '".$fech." 00:00:00' and '".$fech." 23:59:59'");
		$sql->execute();
		$maximo=$sql->fetch();
			//print_r("MOdelo".$maximo['id']);
		return $maximo['id'];
	}
	public static function buscarUsuarioFech($id,$fech)
	{
			//print_r("".$fech);
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT SUM(valor) as id FROM gastos WHERE usuario = ".$id." and fecha BETWEEN '".$fech." 00:00:00' and '".$fech." 23:59:59'");
		$sql->execute();
		$gasto=$sql->fetch();
		return $gasto['id'];
		
	}
	public static function buscarUsuarioFechas($id,$fech,$fech2)
	{
			//print_r("".$fech);
		$list=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM gastos WHERE usuario = ".$id." and fecha BETWEEN '".$fech." 00:00:00' and '".$fech2." 23:59:59'");
		$sql->execute();
		foreach ($sql->fetchAll() as $key => $value) {
			$list[]=$value;
		}
		return $list;	
		
		
	}
	public static function consultarFechas($fecha1,$fecha2)
	{
			//print_r("".$fech);
		$listGasto=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT g.idGasto as idGasto,g.fecha as fecha, g.nombre as nombre,g.valor as valor,g.usuario as usuario, u.nombre as nombreUsuario,m.nombre as nombreModopago FROM gastos as g INNER JOIN usuario as u on u.idUsuario=g.usuario inner join modopago as m on m.idModopago=g.modopago WHERE g.fecha BETWEEN '".$fecha1." 00:00:00' and '".$fecha2." 23:59:59'");
		$sql->execute();
		foreach ($sql->fetchAll() as $key => $value) {
			$listGasto[]=$value;
			
		}
		
		return $listGasto;
	}
	public static function buscarUsuarioFechaInnerFiltro($mensaje){
		$listGasto=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT g.idGasto as idGasto,g.fecha as fecha, g.nombre as nombre,g.valor as valor,g.usuario as usuario, u.nombre as nombreUsuario, m.nombre as nombreModopago FROM gastos as g INNER JOIN usuario as u on u.idUsuario=g.usuario inner join modopago as m on m.idModopago=g.modopago WHERE g.fecha LIKE ? OR u.nombre LIKE ? OR g.nombre LIKE ? OR m.nombre LIKE ?");
		$sql->execute(array("%".$mensaje."%","%".$mensaje."%","%".$mensaje."%","%".$mensaje."%"));
		foreach ($sql->fetchAll() as $key => $value) {
			$listGasto[]=$value;
			
		}
		
		return $listGasto;
		
	}
}

?>