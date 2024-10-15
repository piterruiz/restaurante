<?php 
include_once("../co.Modelo/conexion.php");
include_once("../co.Modelo/Usuario.php");
BD::crearInstancia();
session_start();
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$sede=$_POST['sede'];
//$inicio=Usuario::buscarUsuario($usuario);
//print_r($sede);
$inicio= Usuario::buscarUsuario($usuario);

if (!empty($inicio)) {
	if ($inicio['estado']==2) {
		header("Location:./../index.php?ps=bloqueo");
	}else{
		if (($inicio['permiso']==1)&&(password_verify($clave, $inicio['clave']))&&($inicio['sede']==$sede)){
			@$_SESSION['usuario']['idUsuario'] = $inicio['idUsuario'];
			@$_SESSION['usuario']['nombre'] = $inicio['nombre'];
			@$_SESSION['usuario']['usuario'] = $inicio['usuario'];
			@$_SESSION['usuario']['clave'] = $clave;
			@$_SESSION['usuario']['direccion'] = @$inicio['direccion'];

			@$_SESSION['usuario']['telefono'] = @$inicio['telefono'];
			@$_SESSION['usuario']['permiso'] = @$inicio['permiso'];
			@$_SESSION['usuario']['sede'] = @$inicio['sede'];
			@$_SESSION['usuario']['estado'] = @$inicio['estado'];

			header("Location: ./../co.Vistas/Desarrollador/inicio.php?controlador=usuario&accion=iniciodesarrollo");
		}else if(($inicio['permiso']==2)&&(password_verify($clave, $inicio['clave']))&&($inicio['sede']==$sede)){
			@$_SESSION['usuario']['idUsuario'] = $inicio['idUsuario'];
			@$_SESSION['usuario']['nombre'] = $inicio['nombre'];
			@$_SESSION['usuario']['usuario'] = $inicio['usuario'];
			@$_SESSION['usuario']['clave'] = $clave;
			@$_SESSION['usuario']['direccion'] = @$inicio['direccion'];

			@$_SESSION['usuario']['telefono'] = @$inicio['telefono'];
			@$_SESSION['usuario']['permiso'] = @$inicio['permiso'];
			@$_SESSION['usuario']['sede'] = @$inicio['sede'];
			@$_SESSION['usuario']['estado'] = @$inicio['estado'];
			
			header("Location: ./../co.Vistas/Administrador/inicio.php?controlador=usuario&accion=inicioadmin&dive={$inicio['sede']}");
		}else if(($inicio['permiso']==3)&&(password_verify($clave, $inicio['clave']))&&($inicio['sede']==$sede)){
			@$_SESSION['usuario']['idUsuario'] = $inicio['idUsuario'];
			@$_SESSION['usuario']['nombre'] = $inicio['nombre'];
			@$_SESSION['usuario']['usuario'] = $inicio['usuario'];
			@$_SESSION['usuario']['clave'] = $clave;
			@$_SESSION['usuario']['direccion'] = @$inicio['direccion'];

			@$_SESSION['usuario']['telefono'] = @$inicio['telefono'];
			@$_SESSION['usuario']['permiso'] = @$inicio['permiso'];
			@$_SESSION['usuario']['sede'] = @$inicio['sede'];
			@$_SESSION['usuario']['estado'] = @$inicio['estado'];

			print_r("CAJERO");
			header("Location: ./../co.Vistas/Cajero/inicio.php?controlador=usuario&accion=iniciocajero&dive={$inicio['sede']}");
		}else{	
			//header("Location:./../index.php?ps=login");
		}
	}
	
}else{
	//header("Location:./../index.php?ps=login1");
}
//include_once('../index.php');

?>