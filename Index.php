<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Resources/css/index.css">
    <link rel="stylesheet" href="Resources/Sweetalert2/sweetalert2.min.css">
    <link rel="shortcut icon"  href="Resources/img/service.ico"/>
    <title>Restaurante</title>
</head>
<body>
    <div class="container">

        <div class="caja1">

            <img src="Resources/Img/login.png" class="logo1">
            <label for="" class="text1">Login</label>
        </div>
        <div class="caja2">

            <div class="form">
                <label for="">Usuario:</label>
                <input autocomplete="off" class="form-control" name="usuario" id="usuario" type="text" placeholder="Ingrese elusuario">
                <label for="">Contraseña</label>
                <input class="form-control" name="clave"  id="clave" onkeypress="handleKeyPress(event)" type="password" placeholder="Clave">
                <a class="btn btn-success"  onclick="validar()" >Aceptar</a>
            </div>
            
        </div>

    </div>
</body>
</html>
<script src="Resources/js/jquery3.7.1.js"></script>
<script src="Resources/Sweetalert2/sweetalert2.all.min.js"></script>
<script src="Resources/js/login.js"></script>