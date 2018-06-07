<?php

require'../users/class/sessions.php';
$objses = new Sessions();
$objses->init();

$objses->destroy();


?>

<html><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | 404 Error</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Página no encontrada</h3>

        <div class="error-desc">
            Lo sentimos , pero la página que busca ha sido encontrado note . Intente comprobar la dirección URL para el error , a continuación, pulsa el botón de regenerar de su buscador o probar encontrado algo más en nuestra app.
            
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../lib/js/jquery-2.1.1.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>




</body></html>