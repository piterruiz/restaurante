<?php 
include_once("../../co.Modelo/conexion.php");
include_once("../../co.Modelo/Negocio.php");
include_once("../../co.Modelo/Sede.php");
include_once("../../co.Modelo/Usuario.php");

class ControladorEmpresa
{
	public function inicio(){

		//$id=$_GET['id'];
		
		//$inicio=Usuario::inicioSesion($usuario,$clave);
		
		$_SESSION['pagina']=1;
		include_once("empresa.php");

	}
	public function crear() {
		if ($_POST) {
			$nit = $_POST['nit'];
			$nombre = $_POST['nombre'];
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$correo = $_POST['correo'];
			$contador1 = 0;

			if (isset($_FILES['archivo']) && is_array($_FILES['archivo']['tmp_name'])) {
				foreach ($_FILES['archivo']['tmp_name'] as $key => $tmp_name) {
					$filename = $_FILES['archivo']['name'][$key];
					$temporal = $_FILES['archivo']['tmp_name'][$key];
					$contador1++;

					$directorio = "../../archivos/" . $nombre . "/";
					if (!file_exists($directorio)) {
						mkdir($directorio, 0777);
					}

					$tipoDocumento = pathinfo($filename, PATHINFO_EXTENSION);
					$ruta = $directorio . $nombre . '.' . $tipoDocumento;

					if (move_uploaded_file($temporal, $ruta)) {
						$sql_datos = Negocio::crear($nit, $nombre, $direccion, $telefono, $correo, $ruta);
						if ($sql_datos) {
							$ultimoNegocio = Negocio::ultimo();
							$sede = Sede::crear("SEDE A", $ultimoNegocio);
							$ultimaSede = Sede::ultimo();
							Usuario::crear($nombre, $correo, '$2y$10$dXShYI5Oi1OXWkdZscwzWO9CGVkklOeVjQU5z7tkiYg9miRFuABqm', $telefono, $direccion, 2, $ultimaSede, 1);
							header("Location:./../../co.Vistas/Desarrollador/inicio.php?controlador=empresa&accion=inicio");
						} else {
							header("Location:./../../co.Vistas/Desarrollador/inicio.php?controlador=empresa&accion=inicio");
						}
					} else {
						echo "Ha ocurrido un error al mover el archivo.";
					}
				}
			} else {
				echo "No files uploaded.";
			}
		}
		include_once("empresa.php");
	}
}

?>