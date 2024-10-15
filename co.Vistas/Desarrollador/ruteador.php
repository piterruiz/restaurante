<?php
    //echo $controlador;
    //echo $accion;

    include_once("../../co.Controlador/controlador_".$controlador.".php");
    $objControlador="Controlador".ucfirst($controlador);
    $controlador = new $objControlador();
    $controlador->$accion();
?>