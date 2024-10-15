<?php 
class Equipo 
{
	public $idEquipo;
	public $tipo;
	public $marca;
	public $modelo;
	public $color;
	public $serial1;
	public $serial2;
	public $venta;
	public function __construct($idEquipo,$tipo,$marca,$modelo,$color,$serial1,$serial2,$venta)
	{
		$this->idEquipo=$idEquipo;
		$this->tipo=$tipo;
		$this->marca=$marca;
		$this->modelo=$modelo;
		$this->color=$color;
		$this->serial1=$serial1;
		$this->serial2=$serial2;
		$this->venta=$venta;

	}
	public static function consultarTodos(){
		$listEquipo=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM equipo");
		foreach ($sql->fetchAll() as $equipo) {
			$listEstado[]=$equipo;
		}
		return $listEquipo;
	}
	public static function buscarId($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM equipo WHERE idEquipo=?");
		$sql->execute(array($id));
		$equipo=$sql->fetch();
		return new Equipo($equipo['idEquipo'],$equipo['tipo'],$equipo['marca'],$equipo['modelo'],$equipo['color'],$equipo['serial1'],$equipo['serial2'],$equipo['venta']);

	}
	public static function buscarVenta($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM equipo WHERE venta=?");
		$sql->execute(array($id));
		$equipo=$sql->fetch();
		return new Equipo($equipo['idEquipo'],$equipo['tipo'],$equipo['marca'],$equipo['modelo'],$equipo['color'],$equipo['serial1'],$equipo['serial2'],$equipo['venta']);

	}
	public static function crear($tipo,$marca,$modelo,$color,$serial1,$serial2,$venta){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("INSERT INTO equipo (tipo,marca,modelo,color,serial1,serial2,venta)VALUES (?,?,?,?,?,?,?)");
		$sql->execute(array($tipo,$marca,$modelo,$color,$serial1,$serial2,$venta));
		if (empty($sql)) {
			return true;
		}else{
			return false;
		}
	}
	public static function editar($tipo,$marca,$modelo,$color,$serial1,$serial2,$venta,$idEquipo){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("UPDATE equipo set tipo=?, marca=?, modelo=?, color=?, serial1=?, serial2=?, venta=? WHERE idEquipo=?");
		$sql->execute(array($tipo,$marca,$modelo,$color,$serial1,$serial2,$venta,$idEquipo));
		if (empty($sql)) {
			return true;
		}else{
			return false;
		}
	}
	public static function eliminar($idEquipo){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("DELETE FROM equipo WHERE idEquipo=?");
		$sql->execute(array($idEquipo));
		if (empty($sql)) {
			return true;
		}else{
			return false;
		}
	}
}


?>