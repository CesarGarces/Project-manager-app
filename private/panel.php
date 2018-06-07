<?php
error_reporting(0);
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

$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objPan = new Panel();
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();

$row_rol=mysql_fetch_array($img_roles);
$id_rol = $row_rol['id_rol'];

date_default_timezone_set('America/Bogota');
$fini=date('Y-m-01');
$fifin=date('Y-m-s');
$fecha=date('Y-m-d');

/*************** Parametros ***************/
//$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : null ;

$error = "";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Panel</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link href="../lib/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

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

                <li class="active">
                    <a href="panel.php"><i class="fa fa-desktop"></i> <span class="nav-label">Panel</span></a>
                </li>
                <li>
                    <a href="dashboard.php"><i class="fa fa-clock-o"></i> <span class="nav-label">Time Management</span></a>
                </li>
                <li>
                    <a href="mediciones.php"><i class="fa fa-tachometer"></i> <span class="nav-label">Customer Experience</span></a>
                </li>
				<li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Employee Experience</span></a>
                </li>
				<li>
                    <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Certificaciones IZO</span></a>
                </li>
            </ul>
        </div>
    </nav>

<div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> </a>
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
                <div class="col-lg-12" align="center">
					<table>
						<tr align="center" width="100%">
							<td align="center" width="100%">
								<br>
								<img align="center" src="../lib/img/ccx_logo.png" height="25%" >
							</td>
						</tr>
						<tr align="center" width="100%">
							<td>
								<h5> Seleccione el módulo de CCX que desea usar. </h5>
							</td>	
						</tr>
					</table>	
                </div>
            </div>
	<div class="wrapper wrapper-content animated fadeInRight">	
		<div class="row">
            <div class="col-lg-3">
				<a href="dashboard.php">
                <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-clock-o fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Ingresar </span>
                                <h3 class="font-bold">Time Management</h3>
                            </div>
                        </div>
                </div>
				</a>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-tachometer fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Ingresar </span>
                            <h3 class="font-bold">Customer Experience</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Próximamente </span>
                            <h3 class="font-bold">Emloyee Experience</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-graduation-cap fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Próximamente </span>
                            <h3 class="font-bold">Certificaciones IZO</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-6" align="left">
					<br>
					<div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Últimas noticias Cloud Customer Experience</h5>
                                </div>
                                <div class="ibox-content no-padding">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="#">@CCX</a> A partir de hoy hemos habilitado el módulo de Projects Management v.0.3 Beta, en el cual podrás registrar todas las actividades de tu día a día.</p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 24-11-2016</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="#">@CCX</a> Nuestro Panel ha cambiado para facilitar tu interacción con la plataforma. Si tienes algún comentario para hacerlo más fácil para tí. Haznoslo saber...!!!</p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 23-11-2016</small>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        
                </div>
				<div class="col-lg-6" align="center">
					<br>
					<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Comentarios y Sugerencias</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
							<h5>Si tienes algun comentario o sugerencia, envíanoslo por este medio y haremos todo lo posible por mejorarlo para ti.!!!</h5>
							<br>
                            <form class="form-horizontal">
                                <div class="form-group"><label class="col-lg-2 control-label">Tema</label>
                                    <div class="col-lg-10">
										<select class="form-control m-b" name="tema" required>
											<option  value="">Seleccione un Tema</option>
											<option  value="1">Projects Manager</option>
											<option  value="2">Customer Experience Management</option>
											<option  value="3">Employee Experience Management</option>
											<option  value="4">Cursos / Certificaciones IZO</option>
										</select>
										<span class="help-block m-b-none">Seleccione el tema sobre el cual nos quieres hablar.</span>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Comentario</label>

                                    <div class="col-lg-10">
										<textarea name="comentario" type="text" placeholder="Ingrese su comentario" class="form-control" rows="10"></textarea>
									</div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-info" type="submit">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>	
                </div>
            </div>
	
        <div class="footer">

            <div class="pull-right">

                CCX.

            </div>

            <div>

                <strong>Powered By</strong> Synergy Contact 2015-2017

           </div>

        </div>
	
	
</div>
</div>
                    

    <!-- Mainly scripts -->
    <script src="../lib/js/jquery-2.1.1.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="../lib/js/inspinia.js"></script>
    <script src="../lib/js/plugins/pace/pace.min.js"></script>


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

   <!-- JSKnob -->
   <script src="../lib/js/plugins/jsKnob/jquery.knob.js"></script>
	
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

    <script>
        $(document).ready(function() {

		$('#fecha_fin .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('#fecha_ini .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

		$(".dial").knob();
		
		});

    </script>



</body>



</html>
