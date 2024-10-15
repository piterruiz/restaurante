<?php 
    session_start();
    //echo $_SESSION['apellidos'];
    /*if (!$_SESSION['idUsuario']) {
        header("Location:./../../Vista/UsuarioSecundario/InicioSesion.php");
    }*/
    $controlador='usuario';
     $accion='inicio';
    if(isset($_GET['controlador']) && isset($_GET['accion'])){
        if(($_GET['controlador']!="") && ($_GET['accion']!="")){
            $controlador=$_GET['controlador'];
            $accion=$_GET['accion'];
        }
        
        

       //validar que llegan datos
       /* print_r($controlador);
        print_r($accion);*/

        
    }
    require_once("template.php");
    
 ?>