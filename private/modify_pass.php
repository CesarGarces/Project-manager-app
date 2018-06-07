<?php



require'../users/class/sessions.php';

$objses = new Sessions();

$objses->init();



$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;





if($user == ''){

    

   header('Location: ../index.php?error=2');

}



?>

<?php



require'../users/class/config.php';

require'../users/class/users.php';

require'../users/class/dbactions.php';



$objCon = new Connection();

$objCon->get_connected();

$objUse = new Users();

$img_users = $objUse->img_users();

$users_rol = $objUse->users_rol();


?>

<!DOCTYPE html>

<html>



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>IZO | Modificar Usuario</title>



    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">

    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">



    <link href="../lib/css/animate.css" rel="stylesheet">

    <link href="../lib/css/style.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="../favicon.ico">



</head>



<body>



<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">

        <div class="sidebar-collapse">

            <ul class="nav metismenu" id="side-menu">

                <li class="nav-header">

                    <div class="dropdown profile-element">

                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <?php

                                $numrows = mysql_num_rows($img_users);

                

                                 if($numrows > 0){

                    

                                   while($row=mysql_fetch_array($img_users)){

                                        $id_usuario = $row['id_usuario'];
                                        $id_rol = $row['id_rol'];
                                        $ape_usuario = $row['primer_apellido'];

                                       

                                 ?>                

                           <span>

                            <img alt="image" width="48" height="48" class="img-circle" src="<?php echo $row['imagen']; ?>">

                             </span>  

                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['user'];?></strong>

                             </span> <span class="text-muted text-xs block"><?php echo $row['nombre'];?> <b class="caret"></b></span> </span> </a>

                                                                              <?php

                                                                          }

                                                                      }

                                                                      ?>

                            <ul class="dropdown-menu animated fadeInRight m-t-xs">

                                <li><a href="log_out.php">Salir</a></li>

                            </ul>

                    </div>

                    <div class="logo-element">

                        <img src="../favicon.ico" width="25" height="25">
                        </div>
                    
                </li>

                <li class="active">
                    <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard </span></a>
                </li>
                <li>
                    <a href="seguimiento.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Seguimiento </span></a>
                </li>
				<li>
                    <a href="reporte_seguimiento.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Reportes </span></a>
                </li>
                <?php
				if($id_rol <= 6)
				{
				?>
                <li>
                    <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Configuraciones </span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
						<li><a href="configuraciones_maestras.php"><i class="fa fa-slideshare"></i> Maestros</span></a></li>   
						<li><a href="configuraciones_maestras2.php"><i class="fa fa-slideshare"></i> Proyectos</a></li>   
                    </ul>
                </li>
                <?php
				}				
				?>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">

      <div class="row border-bottom">

            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">

                <div class="navbar-header">

                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>                   

                </div>

                <ul class="nav navbar-top-links navbar-right">

                    <li>

                        <a href="log_out.php">

                            <i class="fa fa-sign-out"></i> Salir

                        </a>

                    </li>

                </ul>

            </nav>

          </div>

        <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2>Modificar Contraseña</h2>

                    <ol class="breadcrumb">


                        <li class="active">

                            <strong>Modificar Contraseña</strong>

                        </li>

                    </ol>

                </div>

        </div>

        <div class="wrapper wrapper-content  animated fadeInRight">           

            <div class="row">

              <div class="col-lg-12">

                <div class="ibox">

                  <div class="ibox-content"> <!--inbox-->                 

                    <div class="row"><!--inrow-->

                      <form role="form" action="modify_pass_exe.php" method="post" enctype="multipart/form-data" >

                                <input type="hidden"  name="id_usuario" value="<?php echo $id_usuario;?>">

                                  <div class="col-md-12">

                  <div class="control-group">

                      <label label-default="" class="control-label">Ingresar Nueva Contraseña *</label>

                      <div class="controls">

                          <input type="password" class="form-control"  title="clave" required name="pass">

                      </div>

                  </div>

                </div>            

                    </div><!--row-->


                <br>
                <div align="left"><input class="btn btn-primary" type="submit" value="Cambiar Contraseña" /></div>
                <br>
                <?php if($id_rol == 7){?>
                <div align="left"><a href="enc_index.php" class="btn btn-primary">Cancelar</a></div>
                <?php }else{?>
                <div align="left"><a href="panel.php" class="btn btn-primary">Cancelar</a></div>
                <?php } ?>
                
                </fieldset><!--/end payment form-->

            </div><!--panel-body-->

        </div>

     </div> <!--col-->
  

                                  </div><!--/panel-body-->

                                </div><!--/panel-heading-->
                      </form>

                    </div><!--/finrow-->

                  </div><!--/inbox-->

                </div><!--/content-->

              </div>

            </div>

          </div>
    

<!-- Mainly scripts -->

<script src="../lib/js/jquery-2.1.1.js"></script>

<script src="../lib/js/bootstrap.min.js"></script>

<script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>



<!-- Custom and plugin javascript -->

<script src="../lib/js/inspinia.js"></script>

<script src="../lib/js/plugins/pace/pace.min.js"></script>





</body>



</html>

