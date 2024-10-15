<?php 
include_once("../../co.Modelo/Permiso.php");
include_once("../../co.Modelo/conexion.php");
include_once("../../co.Modelo/Usuario.php");

BD::crearInstancia();

class ControladorUsuario{

	public function iniciocajero(){

		//$id=$_GET['id'];
		
		//$inicio=Usuario::inicioSesion($usuario,$clave);
		

		include_once("entrada.php");

	}
	public function iniciodesarrollo(){

		//$id=$_GET['id'];
		
		//$inicio=Usuario::inicioSesion($usuario,$clave);
		
		
		include_once("entrada.php");

	}
	public function inicioadmin(){

		//$id=$_GET['id'];
		
		//$inicio=Usuario::inicioSesion($usuario,$clave);
		
		
		include_once("entrada.php");

	}
	public function iniciomesero(){

		//$id=$_GET['id'];
		
		//$inicio=Usuario::inicioSesion($usuario,$clave);
		
		
		include_once("entrada.php");

	}
	public function iniciomensajero(){

		//$id=$_GET['id'];
		
		//$inicio=Usuario::inicioSesion($usuario,$clave);
		
		
		include_once("entrada.php");

	}
	public function cerrarSesion(){
		session_unset();
		session_destroy();
		header("Location:./../../index.php");
	}
	public function usuario(){
		$usuario=Usuario::consultarTodosInner($_SESSION['usuario']['negocio']);
		
		include_once("usuarios.php");
	}
	public function eliminar(){
		$id=$_POST['id'];
		Usuario::borrar($id);
		header('Location:./../Administrador/inicio.php?controlador=usuario&accion=usuario&dive=l3');
	}
	public function crear(){
		$permiso=Permiso::consultarSinDesarrollador();
		if ($_POST) {
			$nombre=$_POST['nombre'];
			$usuario=$_POST['usuario'];
			$clave=$_POST['clave'];
			$direccion=$_POST['direccion'];
			$telefono=$_POST['telefono'];
			$permiso1=$_POST['permiso'];
			$negocio=$_SESSION['usuario']['negocio'];
			$estado=$_POST['estado'];
			$passFuerte=password_hash($clave,PASSWORD_DEFAULT);
			$usuarioCreado=Usuario::crear($nombre,$usuario,$passFuerte,$direccion,$telefono,$permiso1,$negocio,$estado);
			if ($usuarioCreado) {
				header('Location:./../Administrador/inicio.php?controlador=usuario&accion=usuario&dive=l3');
			}else{
				echo "<script>Swal.fire({type: 'error',title: 'ERROR',text: 'No se pudo crear!',footer: '<a></a>'})</script>";
			}
		}
		include_once("crearusuario.php");
	}
}
?>