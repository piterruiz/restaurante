<?php 
class Estado 
{
	public $idEstado;
	public $nombre;
	public function __construct($idEstado,$nombre)
	{
		$this->idEstado=$idEstado;
		$this->nombre=$nombre;
	}
	public static function consultarTodos(){
		$listEstado=[];
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->query("SELECT * FROM estado");
		foreach ($sql->fetchAll() as $estado) {
			$listEstado[]=$estado;
		}
		return $listEstado;
	}
	public static function buscarId($id){
		$conexionBD=BD::crearInstancia();
		$sql=$conexionBD->prepare("SELECT * FROM estado WHERE idEstado=?");
		$sql->execute(array($id));
		$estado=$sql->fetch();
		return new Estado($estado['idEstado'],$estado['nombre']);
	}
}


?>