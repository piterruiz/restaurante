<?php
include_once("../co.Modelo/conexion.php");
include_once("../co.Modelo/Usuario.php");
include_once("../co.Modelo/Negocio.php");
include_once("../co.Modelo/Sede.php");
if (isset($_POST['iniciosesion'])) {
	$usuario=$_POST['usuario'];
	$clave=$_POST['clave'];

	$inicio= Usuario::buscarUsuario($usuario);
	
	if (!empty($inicio)) {
		if ($inicio['estado']==2) {
			print_r("BLOQUEO");
		}else{
			if (password_verify($clave, $inicio['clave'])) {

				$sede=Sede::listarNegocio($inicio['sede']);
				$json = json_encode($sede,JSON_UNESCAPED_UNICODE);
				print_r($json);
			}else{
				print_r("NO");
			}
			
		}

	}else{
		print_r("NO");
	}
}

?>