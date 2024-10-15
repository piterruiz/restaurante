<?php 

	/**
	 * 
	 */
	class Negocio
	{
		public $idNegocio;
		public $nit;
		public $nombre;
		public $direccion;
		public $telefono;
		public $correo;
		public $logo;
		
		public function __construct($idNegocio,$nit,$nombre,$direccion,$telefono,$correo,$logo)
		{
			$this->idNegocio = $idNegocio;
			$this->nit = $nit;
			$this->nombre = $nombre;
			$this->direccion = $direccion;
			$this->telefono = $telefono;
			$this->correo=$correo;
			$this->logo = $logo;
		}
		public static function consultarTodos(){
			$listNegocio=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT * FROM negocio");
			foreach ($sql->fetchAll() as $negocio) {
				$listNegocio[] = $negocio;
			}
			//print_r($listNegocio);
			return $listNegocio;
			
		}
		public static function consultarTodosPaginas($paginas) {
			$listNegocio = [];
			$conexionBD = BD::crearInstancia();

    // Prepare the SQL statement with placeholders
			$sql = $conexionBD->prepare("SELECT * FROM negocio LIMIT ?, 3");

    // Ensure $paginas is an integer and bind it correctly
			$sql->bindValue(1, (int)$paginas, PDO::PARAM_INT);

    // Execute the prepared statement
			$sql->execute();

    // Fetch the results
			foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $negocio) {
				$listNegocio[] = $negocio;
			}

			return $listNegocio;
		}

		public static function crear($nit,$nombre,$direccion,$telefono,$correo,$logo){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("INSERT INTO negocio(nit,nombre,direccion,telefono,correo,logo)VALUES(?,?,?,?,?,?)");
			$sql->execute(array($nit,$nombre,$direccion,$telefono,$correo,$logo));
			return true;
		}
		public static function editar($nit,$nombre,$direccion,$telefono,$correo,$logo,$id){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("UPDATE negocio SET nit=?, nombre=?, direccion=?, telefono=?, ,correo=? logo=? WHERE idNegocio=?");
			$sql->execute(array($nit,$nombre,$direccion,$telefono,$correo,$logo,$id));
			return true;
		}
		public static function eliminar($id){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("DELETE FROM negocio WHERE idNegocio=?");
			$sql->execute(array($id));
			return true;
		}
		public static function buscarId($id){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM negocio WHERE idNegocio=?");
			$sql->execute(array($id));
			$negocio=$sql->fetch();
			
			return new Negocio($negocio['idNegocio'],$negocio['nit'],$negocio['nombre'],$negocio['direccion'],$negocio['telefono'],$negocio['correo'],$negocio['logo']);
		}
		public static function buscarFiltro($id){
			$listNegocio=[];
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->prepare("SELECT * FROM negocio WHERE idNegocio LIKE ? OR nombre LIKE ?");
			$sql->execute(array("'%".$id."%'","'%".$id."%'"));
			foreach ($sql->fetchAll() as $negocio) {
				$listNegocio[] = $negocio;
			}
		}
		public static function ultimo(){
			$conexionBD=BD::crearInstancia();
			$sql=$conexionBD->query("SELECT MAX(idNegocio) as id FROM negocio");
			$negocio= $sql->fetch();
			//print_r($negocio);
			return $negocio['id'];
		}
	}
?>