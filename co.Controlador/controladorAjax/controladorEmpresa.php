<?php
include_once("../../co.Modelo/conexion.php");
include_once("../../co.Modelo/Negocio.php");
session_start();
if (isset($_POST['empresas'])) {
	$paginas = 0;
	$negocio = Negocio::consultarTodosPaginas($paginas);
	$html = "";
	if (empty($negocio)) {
		$html .= "<tr><td></td><td></td><td>NO EXISTEN DATOS</td><td></td><td></td><td></td></tr> ";
	} else {
		$contador = 1;
		foreach ($negocio as $key => $value) {
			$cont = $contador % 2;
			if ($cont == 0) {
				$html .= "<tr id='tr1'>";
				$html .= "<td>" . $value['nit'] . "</td>";
				$html .= "<td>" . $value['nombre'] . "</td>";
				$html .= "<td>" . $value['direccion'] . "</td>";
				$html .= "<td>" . $value['telefono'] . "</td>";
				$html .= "<td>" . $value['correo'] . "</td>";
				$html .= "<td><img src='" . $value['logo'] . "'></td>";
				$html .= "<td><a title='Editar' class='btn btn-warning icon-pencil'><a title='Eliminar' class='btn btn-danger icon-cross'></td>";
				$html .= "</tr>";
			} else {
				$html .= "<tr id='tr2'>";
				$html .= "<td>" . $value['nit'] . "</td>";
				$html .= "<td>" . $value['nombre'] . "</td>";
				$html .= "<td>" . $value['direccion'] . "</td>";
				$html .= "<td>" . $value['telefono'] . "</td>";
				$html .= "<td>" . $value['correo'] . "</td>";
				$html .= "<td><img src='" . $value['logo'] . "'></td>";
				$html .= "<td><a title='Editar' class='btn btn-warning icon-pencil'><a title='Eliminar' class='btn btn-danger icon-cross'></td>";
				$html .= "</tr>";
			}
			$contador++;
		}
	}

	print_r($html);
}
if (isset($_POST['paginacion'])) {
	$negocio = Negocio::consultarTodos();
	$html = "";
	if (empty($negocio)) {
	} else {
		$registros = 1;
		foreach ($negocio as $key => $value) {

			$registros++;
		}
		$total = $registros / 3;
		$paginas = round($total);
		$html .= '<li class="page-item" >
		<a class="page-link" href="#" aria-label="Previous">
		<span aria-hidden="true">&laquo;</span>
		</a>
		</li>';
		for ($i = 0; $i < $paginas; $i++) {
			$temp = $i + 1;
			if ($_SESSION['pagina'] == $temp) {
				$html .= '<li class="page-item active" ><a class="page-link"  onclick="pasarpagina(' . $temp . ')">' . $temp . '</a></li>';
			} else {
				$html .= '<li class="page-item"><a class="page-link"  onclick="pasarpagina(' . $temp . ')">' . $temp . '</a></li>';
			}
		}
		$html .= '<li class="page-item">
		<a class="page-link" href="#" aria-label="Next">
		<span aria-hidden="true">&raquo;</span>
		</a>
		</li>';
	}


	print_r($html);
}
if (isset($_POST['empresaspagina'])) {
	$_SESSION['pagina']=$_POST['p'];
	$r=3;
	$negocio1 = Negocio::consultarTodos();
	$registros = 1;
	foreach ($negocio1 as $key => $value) {
		$registros++;
	}
	$total = $registros / $r;
	$paginas = round($total);
	$registro=0;
	for($i=0;$i<$paginas;$i++){
		if(($i+1)==$_SESSION['pagina']){
			$registro=(($_SESSION['pagina']*$r)-$r);
		}
	}
	
	$negocio = Negocio::consultarTodosPaginas($registro);
	$html = "";
	if (empty($negocio)) {
		$html .= "<tr><td></td><td></td><td>NO EXISTEN DATOS</td><td></td><td></td><td></td></tr> ";
	} else {
		$contador = 1;
		foreach ($negocio as $key => $value) {
			$cont = $contador % 2;
			if ($cont == 0) {
				$html .= "<tr id='tr1'>";
				$html .= "<td>" . $value['nit'] . "</td>";
				$html .= "<td>" . $value['nombre'] . "</td>";
				$html .= "<td>" . $value['direccion'] . "</td>";
				$html .= "<td>" . $value['telefono'] . "</td>";
				$html .= "<td>" . $value['correo'] . "</td>";
				$html .= "<td><img src='" . $value['logo'] . "'></td>";
				$html .= "<td><a title='Editar' class='btn btn-warning icon-pencil'><a title='Eliminar' class='btn btn-danger icon-cross'></td>";
				$html .= "</tr>";
			} else {
				$html .= "<tr id='tr2'>";
				$html .= "<td>" . $value['nit'] . "</td>";
				$html .= "<td>" . $value['nombre'] . "</td>";
				$html .= "<td>" . $value['direccion'] . "</td>";
				$html .= "<td>" . $value['telefono'] . "</td>";
				$html .= "<td>" . $value['correo'] . "</td>";
				$html .= "<td><img src='" . $value['logo'] . "'></td>";
				$html .= "<td><a title='Editar' class='btn btn-warning icon-pencil'><a title='Eliminar' class='btn btn-danger icon-cross'></td>";
				$html .= "</tr>";
			}
			$contador++;
		}
	}

	print_r($html);
}
if (isset($_POST['paginacionpagina'])) {
	$p=$_POST['t'];
	$_SESSION['pagina']=$p;
	$negocio = Negocio::consultarTodos();
	$html = "";
	$r=3;
	if (empty($negocio)) {
	} else {
		$registros = 1;
		foreach ($negocio as $key => $value) {

			$registros++;
		}
		$total = $registros / $r;
		$paginas = round($total);
		$html .= '<li class="page-item" >
		<a class="page-link" href="#" aria-label="Previous">
		<span aria-hidden="true">&laquo;</span>
		</a>
		</li>';
		for ($i = 0; $i < $paginas; $i++) {
			$temp = $i + 1;

			if ($_SESSION['pagina'] == $temp) {
				
				$html .= '<li class="page-item active" ><a class="page-link"  onclick="pasarpagina(' . $temp . ')">' . $temp . '</a></li>';
			} else {
				$html .= '<li class="page-item"><a class="page-link"  onclick="pasarpagina(' . $temp . ')">' . $temp . '</a></li>';
			}
		}
		$html .= '<li class="page-item">
		<a class="page-link" href="#" aria-label="Next">
		<span aria-hidden="true">&raquo;</span>
		</a>
		</li>';
		
	}


	print_r($html);
}
