<?php

// Evitar los warnings the variables no definidas!!!

$err = isset($_GET['error']) ? $_GET['error'] : null ;



?>

<!DOCTYPE html>

<html>



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>IZO | Login</title>



    <link href="lib/css/bootstrap.min.css" rel="stylesheet">

    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="lib/css/animate.css" rel="stylesheet">

    <link href="lib/css/style.css" rel="stylesheet">

    <link href="lib/css/custom.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="favicon.ico">



</head>



<div class="smenu animated bounceIn"> 

<body class="gray-bg">



    <div class="middle-box text-center loginscreen ">

        

        <div class="form login-form" >

       

        <div>

            <div>



                <img src="lib/img/logo.png" width="150" height="110">



            </div>

            <p>

            </p>

            

            <h3>Bienvenido a IZO Board</h3>

            <p>

            </p>

            <p>Ingrese con su cuenta local.</p>

            <form class="m-t" role="form" action="users/session_init.php">

                <div class="form-group">

                    <input type="text" class="form-control" name="login" placeholder="Username" required="">

                </div>

                <div class="form-group">

                    <input type="password" class="form-control" name="password" placeholder="Password" required="">

                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Ingresar</button>

                <?php

      

            if($err == 1){

                ?>

            <div class="alert alert-danger alert-dismissable" role="alert"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Usuario o clave incorrecta</div>

            <?php



            }

        

            ?>

            <?php

      

            if($err == 2){

                ?>

            <div class="alert alert-warning alert-dismissable" role="alert"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Debe registrarse para iniciar sesion</div>

            <?php



            }

        

            ?>

                

            </form>

            </div>

        </div>

    </div>

</div>

</div>



<div class="footer">

            <div class="pull-right">

                IZO Corp.

            </div>

            <div>

                <strong>Copyright</strong> IZO Corp &copy; 2015-2016

            </div>

        </div>



    </div>

</div>

<div>

    <img src="lib/img/izo.png" style="position: absolute; margin: 0px; padding: 0px; border: none; width: 100%; height: 800px; max-width: none; z-index: -999999; left: 0px; top: -97.73645680819914px;" class="deleteable">

   

</div>

    <!-- Mainly scripts -->

    <script src="lib/js/jquery-2.1.1.js"></script>

    <script src="lib/js/bootstrap.min.js"></script>



</body>



</html>

