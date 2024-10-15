<?php 

class Usuario
{
	public $idUsuario;
	public $nombre;
	public $usuario;
	public $clave;
	public $direccion;
	public $telefono;
	public $permiso;
	public $sede;
    public $estado;
	public function __construct($idUsuario,$nombre,$usuario,$clave,$direccion,$telefono,$permiso,$sede,$estado)
	{
		$this->idUsuario=$idUsuario;
		$this->nombre=$nombre;
		$this->usuario=$usuario;
		$this->clave=$clave;
		$this->telefono=$telefono;
		$this->direccion=$direccion;
		$this->permiso=$permiso;
		$this->sede=$sede;
        $this->estado=$estado;
	}
	public static function consultarTodos(){
        $listaUsuarios=[];
        $conexionBD=BD::crearInstancia();
        $sql=$conexionBD->query("SELECT * FROM usuario");

        foreach($sql->fetchAll() as $usuario){
            $listaUsuarios[]= $usuario;
        }
        return $listaUsuarios;
    }
    public static function consultarTodosInner($idUs){
        $listaUsuarios=[];

        $conexionBD=BD::crearInstancia();
        $sql=$conexionBD->prepare("SELECT u.idUsuario as idUsuario, u.nombre as nombre, u.usuario as usuario, u.clave as clave, u.telefono as telefono, u.direccion as direccion, p.idPermiso as idPermiso, p.nombre as nombrePermiso, n.idsede as idsede, n.nombre  as nombresede, u.estado as estado, e.nombre as nombreEstado FROM usuario as u INNER JOIN permiso as p on p.idPermiso=u.permiso INNER JOIN sede as n on n.idsede=u.sede INNER JOIN estado as e on e.idEstado=u.estado WHERE u.sede=?");

        $sql->execute(array($idUs));
        foreach($sql->fetchAll() as $usuario){
            $listaUsuarios[]=$usuario;
        }
            //print_r("desde el modelo".$listaUsuarios[0]->idUsuario);
        return $listaUsuarios;
    }

    public static function crear($nombre,$usuario,$clave,$direccion,$telefono,$permiso,$sede,$estado){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("INSERT INTO usuario(nombre,usuario,clave,direccion,telefono,permiso,sede,estado)VALUES(?,?,?,?,?,?,?,?)");
        $sql->execute(array($nombre,$usuario,$clave,$direccion,$telefono,$permiso,$sede,$estado));
        if ($sql) {
            return true;
        }else{
            return false;
        }


    }
    public static function borrar($id){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("DELETE FROM usuario WHERE idUsuario=?");
        $sql->execute(array($id));
    }
    public static function eliminarsede($id){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("DELETE FROM usuario WHERE sede=?");
        $sql->execute(array($id));
        return true;
    }
    public static function buscarId($id){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT * FROM usuario WHERE idUsuario=?");
        $sql->execute(array($id));
        $usuario=$sql->fetch();
        return new Usuario($usuario['idUsuario'],$usuario['nombre'],$usuario['usuario'],$usuario['clave'],$usuario['direccion'],$usuario['telefono'],$usuario['permiso'],$usuario['sede'],$usuario['estado']);
    }
    public static function buscarIdInner($id){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT u.idUsuario as idUsuario, u.nombre as nombre, u.usuario as usuario, u.clave as clave, u.telefono as telefono, u.direccion as direccion, p.idPermiso as idPermiso, p.nombre as nombrePermiso, n.idsede as idsede, n.nombre as nombesede,u.estado as estado, e.nombre as nombreEstado FROM usuario as u INNER JOIN permiso as p on p.idPermiso=u.permiso INNER JOIN sede as n on n.idsede=u.sede INNER JOIN estado as e on e.idEstado=u.estado WHERE u.idUsuario=?");
        $sql->execute(array($id));
        $usuario=$sql->fetch();
        //print_r("desde el modelo".$usuario);
        return $usuario;
    }
    public static function contarUsuario($sede){

        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT count(idUsuario) as total FROM usuario WHERE sede=?" );
        $sql->execute(array($sede));
        $usuario=$sql->fetch();
        
        
        return $usuario['total'];
    }
    public static function buscarFiltroInner($id,$sede){
        $listaUsuario=[];
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT u.idUsuario as idUsuario, u.nombre as nombre, u.usuario as usuario, u.clave as clave, u.telefono as telefono, u.direccion as direccion, p.idPermiso as idPermiso, p.nombre as nombrePermiso, n.idsede as idsede, n.nomnbre as nombesede,u.estado as estado, e.nombre as nombreEstado FROM usuario as u INNER JOIN permiso as p on p.idPermiso=u.permiso INNER JOIN sede as n on n.idsede=u.sede INNER JOIN estado as e on e.idEstado=u.estado  WHERE u.sede = ? and u.nombre LIKE ? OR u.clave LIKE ? OR u.telefono LIKE ? OR u.direccion LIKE ? OR p.nombre LIKE ? " );
        $sql->execute(array($sede,"%".$id."%","%".$id."%","%".$id."%","%".$id."%","%".$id."%"));
        foreach ($sql->fetchAll() as $usuario) {
            $listaUsuario[]=$usuario;
        }
        
        
        return $listaUsuario;
    }
    public static function modificar($idUsuario,$nombre,$usuario,$clave,$direccion,$telefono,$permiso,$sede,$estado){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("UPDATE usuario SET nombre=?, usuario=?, clave=?, direccion=?, telefono=?,  permiso=?, sede=?, estado=? WHERE idUsuario=?");
        $sql->execute(array($nombre,$usuario,$clave,$direccion,$telefono,$permiso,$sede,$estado,$idUsuario));
    }
    public static function inicioSesion($usuario1,$pass){
        try {
            $conexionBD=BD::crearInstancia();
            $sql= $conexionBD->prepare("SELECT * FROM usuario WHERE usuario=? and clave=?");
            $sql->execute(array($usuario1,$pass));
            $usuario=$sql->fetch();
            
            return new Usuario($usuario['idUsuario'],$usuario['nombre'],$usuario['usuario'],$usuario['clave'],$usuario['direccion'],$usuario['telefono'],$usuario['permiso'],$usuario['sede'],$usuario['estado']);
            //print_r("usuario Dao".$usuario);
            
        } catch (Exception $e) {
            return "<script>alert('try catch')</script>";
        }

    }
    public static function sesionExist($usuario,$pass){
        $conexionBD=BD::crearInstancia();
        $sql= $conexionBD->prepare("SELECT * FROM usuario WHERE usuario=? and clave=?");
        $sql->execute(array($usuario,$pass));
        
        if ($sql->rowCount()) {
            return true;
        }else{
            return false;
        }
    }
    public static function buscarUsuario($usuario){
    	$conexionBD=BD::crearInstancia();
    	$sql=$conexionBD->prepare("SELECT * FROM usuario WHERE usuario=?");
    	$sql->execute(array($usuario));
    	$usuarioId=$sql->fetch();
    	return $usuarioId;
    } 
}
?>