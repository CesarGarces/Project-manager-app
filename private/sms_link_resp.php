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
$asesor = isset($_REQUEST['agencia']) ? $_REQUEST['agencia'] : null ;
$segmento = isset($_REQUEST['region']) ? $_REQUEST['region'] : null ;
$aliado = isset($_REQUEST['area']) ? $_REQUEST['area'] : null ;
$tecnologia = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : null ;

$error = "";

/*************** Filtros ***************/
$filtro_asesor = mysql_query("SELECT nom_asesor FROM enc_monitoreo");
$filtro_segmento = mysql_query("SELECT segmento_llamada FROM enc_monitoreo");
$filtro_aliado = mysql_query("SELECT aliado FROM enc_monitoreo");
$filtro_tecnologia = mysql_query("SELECT tecnologia FROM enc_monitoreo");
                                

/* AQUI SE CALCULA TODO LO QUE SE VA A MOSTRAR EN EL PANEL
$total_monitoreo = $objPan->total_monitoreo($fini,$fifin);
$monitoreos = mysql_fetch_array($total_monitoreo);
$tot_monitoreo = $monitoreos['tot_monitoreo'];


$tmo = $objPan->tmo($fini,$fifin);
$tot_tmo = mysql_fetch_array($tmo);
$tot_hora_tmo = $tot_tmo['total_tmo'];

$tme = $objPan->tme($fini,$fifin);
$tot_tme = mysql_fetch_array($tme);
$tot_hora_tme = $tot_tme['total_tme'];
*/
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

	<!-- Bootstrap Tour -->
    <link href="../lib/css/plugins/bootstrapTour/bootstrap-tour.min.css" rel="stylesheet">
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

                <li>
                    <a href="panel.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Panel</span></a>
                </li>
                <li>
                    <a href="mediciones.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Mediciones</span></a>
                </li>
                <li>
                    <a><i class="fa fa-arrow-circle-o-right"></i> <span class="nav-label">Datos</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="client_list.php">Clientes</a></li>
                        <li><a href="segmento_list.php">Segmentos</a></li>
                        <li><a href="canal_list.php">Canales</a></li>
                        <li><a href="estudio_list.php">Estudios</a></li>
                        <li><a href="Indicador_list.php">Indicadores</a></li>
                        <li><a href="upload_indicador.php">Subir datos</a></li>
                    </ul>
                </li>
				<?php
				if($id_rol <= 6)
				{
				?>
                <li>
                    <a><i class="fa fa-cog"></i> <span class="nav-label">Ajustes</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="user_list.php">Usuarios</a></li>
                        <li><a href="rol_list.php">Roles</a></li>
                        <!--<li><a href="lineas_list.php">Lineas</a></li>-->
                        <!--<li><a href="permisos_list.php">Permisos</a></li>-->
                        <!--<li><a href="asigpermisos_list.php">Asignar Permisos</a></li>-->
                        <!--<li><a href="modulos_list.php">Modulos</a></li>-->
                        <!--<li><a href="secciones_list.php">Secciones</a></li>-->
                    </ul>
                </li>
				<li class="active">
                    <a><i class="fa fa-mobile-phone"></i> <span class="nav-label">SMS Link</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="sms_link_reglas.php">Reglas</a></li>
						<li><a href="sms_link_enc.php">Encuestas</a></li>
                        <li class="active"><a href="sms_link_resp.php">Respuestas</a></li>
                        <!--<li><a href="permisos_list.php">Permisos</a></li>-->
                        <!--<li><a href="asigpermisos_list.php">Asignar Permisos</a></li>-->
                        <!--<li><a href="modulos_list.php">Modulos</a></li>-->
                        <!--<li><a href="secciones_list.php">Secciones</a></li>-->
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
                <div class="col-lg-10">
                    <h2>Creación de Respuestas</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Respuestas</a>
                        </li>
                        <li class="active">
                            <strong>Personaliza tus respuestas</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Introducción
                                        </div>
                                        <div class="panel-body">
                                            <p>Hola... Si eres nuevo aqui, te encantará dar un Tour que te enseñará como puedes crear fácilmente una serie de respuestas personalizadas para tu encuesta. Espero que lo disfrutes.</p>
											<a href="#" class="btn btn-primary startTour"><i class="fa fa-play"></i> Iniciar Tour</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            Selección de Reglas de Negocio
                                        </div>
                                        <div class="panel-body" id="step1">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-success" id="step2">
                                        <div class="panel-heading">
                                            Selección de Medición 
                                        </div>
                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <i class="fa fa-info-circle"></i> Info Panel
                                        </div>
                                        <div class="panel-body" id="step3">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-warning">
                                        <div class="panel-heading">
                                            <i class="fa fa-warning"></i> Warning Panel
                                        </div>
                                        <div class="panel-body" id="step4">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                             Danger Panel with Footer
                                        </div>
                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                        </div>
                                        <div class="panel-footer">
                                            Panel Footer
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

    <!-- Bootstrap Tour -->
    <script src="../lib/js/plugins/bootstrapTour/bootstrap-tour.min.js"></script>
	
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

		
		// Instance the tour
        var tour = new Tour({
            steps: [{

                    element: "#step1",
                    title: "Creación de Reglas",
                    content: "Introduce new users to your product by walking them through it step by step.",
                    placement: "top"
                },
                {
                    element: "#step2",
                    title: "Selecciona una Medición",
                    content: "Content of my step",
                    placement: "top",
                    backdrop: true,
                    backdropContainer: '#wrapper',
                    onShown: function (tour){
                        $('body').addClass('tour-open')
                    },
                    onHidden: function (tour){
                        $('body').removeClass('tour-close')
                    }
                },
                {
                    element: "#step3",
                    title: "Define tus estilos",
                    content: "Introduce new users to your product by walking them through it step by step.",
                    placement: "bottom"
                },
                {
                    element: "#step4",
                    title: "Creala...!!!",
                    content: "Introduce new users to your product by walking them through it step by step.",
                    placement: "top"
                }
            ]});

        // Initialize the tour
        tour.init();

        $('.startTour').click(function(){
            tour.restart();

            // Start the tour
            // tour.start();
        })
		
		});

    </script>



</body>



</html>
