<?php
require'../users/class/sessions.php';
$objses = new Sessions();
$objses->init();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
   header('Location: ../index.php?error=2');
}

require'../users/class/config.php';
require'../users/class/users.php';
require'../users/class/dbactions.php';
require'../users/class/panel.php';
require'../users/class/encuestas.php';

$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objEnc = new Encuesta();
$img_users = $objUse->img_users();


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Encuestas</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link href="../lib/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="../lib/css/sweetalert.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="../lib/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="../lib/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!-- c3 Charts -->
    <link href="../lib/css/plugins/c3/c3.min.css" rel="stylesheet">

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
                                        $nombre_usuario = $row['primer_nombre'];
                                        $ape_usuario = $row['primer_apellido'];
                                ?>

               <span>
                    <img alt="image" width="48" height="48" class="img-circle" src="<?php echo $row['imagen'];?>">
                </span>
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['user'];?></strong>

                </span> <span class="text-muted text-xs block"><?php echo $row['nombre'];?> <b class="caret"></b></span> </span> </a>

                <?php
                    }

                }
                ?>

                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="modify_pass.php">Cambiar Contraseña</a></li>
                                <li><a href="log_out.php">Salir</a></li>
                            </ul>
                    </div>

                    <div class="logo-element">

                       <img src="../favicon.ico" width="25" height="25">
                    </div>
                </li>              
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

                    <h2>Encuestas</h2>

                    <ol class="breadcrumb">

                        <li>

                            <a href="panel.php">Inicio</a>

                        </li>

                        

                        <li class="active">

                            <strong>Encuestas</strong>

                        </li>

                    </ol>

                </div>

            </div>

    <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="ibox">            
                    <form role="form" method="post" >

                        <div class="col-sm-12">

                          <div class="panel panel-default">

                           <div class="panel-heading"><h3 class="panel-title">Encuesta Cultura de Servicio</h3>

                           </div>

                             <div class="panel-body">

                                <fieldset>

                                  <div class="row">

                                   <div class="col-md-6">

                                     <div class="control-group">

                                        <label label-default="" class="control-label">Seleccione Siniestro *</label>

                                          <div class="controls">
                                           

                                             <select class="form-control required m-b valid" name="siniestro" required >

                                                <option value="">Seleccione</option>
                                                <option value="Siniestro Inicial">Siniestro Inicial</option>
                                                <option value="Siniestro Final">Siniestro Final</option>
                                        
                                              </select>

                                          </div>

                                      </div>
                                      
                                    </div><!--col-->
                                    <div class="col-md-6">

                                     <div class="control-group">

                                        <label label-default="" class="control-label">Id IZO *</label>

                                          <div class="controls">
                                           

                                             

                                                <input type="text" class="form-control" required name="id_izo" value="">
                                        
                                             

                                          </div>

                                      </div>
                                                                                          
                                    </div><!--col-->
                                      
                                  </div><!--row-->

                                  <input type="submit" class="btn btn-primary" onclick = "this.form.action = 'enc_siniestros_estado.php'" value="Entrar" />
                                  
                                 </fieldset><!--/end form-->

                              </div><!--panel-body-->

                            </div><!--panel-default-->

                          </div> <!--col-->                                                  
                    </form>            
      </div>

    <!-- Mainly scripts -->
    <script src="../lib/js/jquery-2.1.1.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="../lib/js/inspinia.js"></script>
    <script src="../lib/js/plugins/pace/pace.min.js"></script>

    <script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../lib/js/plugins/flot/jquery.flot.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="../lib/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../lib/js/demo/peity-demo.js"></script>

   <!-- Data picker -->
   <script src="../lib/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="../lib/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="../lib/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- GITTER -->
    <script src="../lib/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="../lib/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../lib/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="../lib/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="../lib/js/plugins/toastr/toastr.min.js"></script>

    <!-- d3 and c3 charts -->
    <script src="../lib/js/plugins/d3/d3.min.js"></script>
    <script src="../lib/js/plugins/c3/c3.min.js"></script>

</body>

</html>
