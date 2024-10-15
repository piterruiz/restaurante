<?php if (!$_SESSION) {
    header("Location:./../../index.php");
}else if($_SESSION['usuario']['permiso']!=1) {
    header("Location:./../../index.php");
}?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../Resources/Sweetalert2/sweetalert2.min.css"/>
          
    <link rel="stylesheet" type="text/css" href="../../Resources/css/nav.css"/>
    <link rel="stylesheet" type="text/css" href="../../Resources/css/fonts.css"/>
    <link rel="shortcut icon"  href="../../Resources/img/service.ico"/>
    <link rel="stylesheet" href="../../Resources/bootstrap/css/bootstrap.min.css"/>
    <title>POS VENTA</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
</head>
<body>
	<header class="navbar">
        <nav id="nav">
            <img src="../../Resources/Img/logo.png" alt="">
            <ul>
                <li><a class="icon-home " title="Ventas" href="?controlador=usuario&accion=iniciocajero"><label for=""> Inicio</label> </a></li>
                <li><a class="icon-library " href="?controlador=empresa&accion=inicio"><label for=""> Empresas</label> </a></li>
                <li><a class="icon-user-tie " href="?controlador=clientes&accion=inicio"><label for=""> Clientes</label> </a></li>
                <li><a class="icon-clipboard " href=""><label for=""> C X C</label> </a></li>
                <li><a class="icon-coin-dollar " href=""><label for=""> Cierre</label> </a></li>
                <li><a class="icon-stack " href=""><label for=""> Productos</label> </a></li>
                <li><a class="icon-quotes-right " href=""><label for=""> Categorias</label> </a></li>
                <li><a class="icon-users " href=""><label for=""> Usuarios</label> </a></li>
                <li><a class="icon-rocket " href=""><label for=""> Ventas</label> </a></li>
                <li><a class="icon-folder-minus " href=""><label for=""> Gastos</label> </a></li>
                <li><a class="icon-pie-chart " href=""><label for=""> Reportes</label> </a></li>
                <li><a class="icon-user " href=""><label for=""> Perfil</label> </a></li>
                <li><a class="icon-switch " href="?controlador=usuario&accion=cerrarsesion"><label for=""> Cierre Sesion</label> </a></li>
            </ul>
        </nav>
        <div class="menu" id="menu" onclick="main()">
            <img src="../../Resources/img/menu-bar.png" alt="" >
            
        </div>
    </header>
    
    
    <div id="idForm">

        <?php include_once("ruteador.php");?>
        

    </div>
    <script src="../../Resources/Sweetalert2/sweetalert2.all.min.js"></script>
    
    <script  src="../../Resources/js/jquery3.7.1.js"></script>
    <script src="../../Resources/bootstrap/js/bootstrap.js"></script>
    <script  src="../../Resources/js/nav.js"></script>
    <script>
        
    </script>

</body>
</html>