<?php if (!$_SESSION) {
    header("Location:./../../index.php");
}else if($_SESSION['usuario']['permiso']!=3) {
    header("Location:./../../index.php");
}?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../../Resources/sweetalert/css/sweetalert2.css"/>
        <link rel="stylesheet" href="../../Resources/css/font.css"/>      
        <link rel="stylesheet" href="../../Resources/css/inicio.css"/>
        <link rel="stylesheet" type="text/css" href="../../Resources/css/nav.css"/>
        <link rel="stylesheet" type="text/css" href="../../Resources/css/fonts.css"/>
        <link rel="shortcut icon"  style="border-radius: 15px;"  href="../../Resources/img/logotipo.ico"/>
    <link rel="stylesheet" href="../../Resources/bootstrap/css/bootstrap.min.css"/>
    <title>POS VENTA</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
</head>
<body>
	<header class="navbar">
        <nav>
            <img src="../../Resources/Img/logo.png" alt="">
            <ul>
                <li><a class="icon-home " title="Ventas" href="?controlador=usuario&accion=iniciocajero&dive=l2"><label for=""> Ventas</label> </a></li>
                <li><a class="icon-users " href="?controlador=clientes&accion=inicio&dive=l2"><label for=""> Clientes</label> </a></li>
                <li><a class="icon-clipboard " href=""><label for=""> C X C</label> </a></li>
                <li><a class="icon-stack " href=""><label for=""> Productos</label> </a></li>
                <li><a class="icon-coin-dollar " href=""><label for=""> Cierre</label> </a></li>
                <li><a class="icon-user " href=""><label for=""> Perfil</label> </a></li>
                <li><a class="icon-switch " href="?controlador=usuario&accion=cerrarsesion"><label for=""> Cierre Sesion</label> </a></li>
            </ul>
        </nav>
    </header>
    
    <div id="idForm">
             <?php include_once("ruteador.php");?>
        

    </div>
    <script src="../../Resources/sweetalert/js/sweetalert2.js"></script>
    
    <script  src="../../Resources/js/jquery-latest.js"></script>
    <script src="../../Resources/bootstrap/js/bootstrap.js"></script>
    <script  src="../../Resources/js/menu.js"></script>
    <script>
        window.onload = color();
        function color() {

            var a = document.getElementsByClassName("<?php echo $_GET['dive'] ?>");
            a[0].style.backgroundColor = "#75150B";
        }
    </script>
	
</body>
</html>