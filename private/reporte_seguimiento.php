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
$id_user = $row_rol['id_usuario'];

date_default_timezone_set('America/Bogota');
$fini=date('Y-m-01');
$fifin=date('Y-m-s');
$fecha=date('Y-m-d');

if(isset($_REQUEST['fecha']))
{
	$fecha_busqueda = $_REQUEST['fecha'];
}
else
{
	$fecha_busqueda = $fecha;
}

/*************** Parametros ***************/
$asesor = isset($_REQUEST['agencia']) ? $_REQUEST['agencia'] : null ;
$segmento = isset($_REQUEST['region']) ? $_REQUEST['region'] : null ;
$aliado = isset($_REQUEST['area']) ? $_REQUEST['area'] : null ;
$tecnologia = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : null ;

$error = "";

$lista_proyecto = mysql_query("SELECT p.id_proyecto, p.nombre FROM sys_empleados e, sys_usuarios u, sys_proyectos p, sys_empleado_perfil_proyectos ep where ep.id_proyecto = p.id_proyecto AND ep.id_empleado = e.id_empleado AND e.id_usuario = u.id_usuario AND ep.estado = 'Activado' AND u.id_usuario = ".$id_user );
$tipo_actividad = mysql_query("SELECT id_tipo_actividad, nombre FROM sys_tipo_actividades");

//Datos del Usuario
$sql_usuario = mysql_query("SELECT id_usuario, CONCAT(primer_nombre,' ',primer_apellido,' ',segundo_apellido) as nombres, imagen FROM sys_usuarios WHERE login = '".$user."'");
$fetch_usuario = mysql_fetch_row($sql_usuario);

//Datos del Empleado
$sql_empleado = mysql_query("SELECT p.nombre, (TIMESTAMPDIFF(MONTH,e.fecha_ingreso,CURDATE())) tiempo, c.nombre cargo, d.nombre dependencia, id_empleado FROM sys_empleados e, sys_paises p, sys_cargos c, sys_dependencias d WHERE p.id_pais = e.id_pais AND e.id_cargo = c.id_cargo AND c.id_dependencia = d.id_dependencia AND e.id_usuario = $fetch_usuario[0]");
$fetch_empleado = mysql_fetch_row($sql_empleado);

//Proyectos Activos
$sql_proyectos = mysql_query("SELECT COUNT(1) FROM sys_empleado_perfil_proyectos WHERE id_empleado = $fetch_empleado[4]");
$fetch_proyectos = mysql_fetch_row($sql_proyectos);

//Datos de la semana
$sql_semanal = mysql_query("SELECT COUNT(1) FROM pjc_seguimiento_actividades WHERE CURDATE() BETWEEN DATE_SUB(CURDATE(), INTERVAL DAYOFWEEK(CURDATE())-1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY) AND id_empleado = $fetch_empleado[4]");
$fetch_semanal = mysql_fetch_row($sql_semanal);

//Registros de hoy
$sql_dehoy = mysql_query("SELECT COUNT(1) FROM pjc_seguimiento_actividades WHERE fecha_diligencia = CURDATE() AND id_empleado = $fetch_empleado[4]");
$fetch_dehoy = mysql_fetch_row($sql_dehoy);

//Notificaciones
$sql_notificaciones = mysql_query("SELECT n.id_notificacion, n.id_empleado_crea, u.imagen, n.observacion, n.fecha, n.detalle FROM sys_notificaciones n, sys_usuarios u, sys_empleados e WHERE n.id_empleado_crea = e.id_empleado AND e.id_usuario = u.id_usuario AND n.id_empleado = $fetch_empleado[4] ORDER BY n.id_notificacion DESC LIMIT 10");

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
	<style>
/* Tooltip container */
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
 
    /* Position the tooltip text - see examples below! */
    position: absolute;
    z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>
</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

					<span>
						<img alt="image" width="48" height="48" class="img-circle" src="<?php echo $fetch_usuario[2];?>">
					</span>
					</span> <span class="text-muted text-xs block"><?php echo $_SESSION['user'];?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a href="dashboard.php">Perfil</a></li>
                                <li><a href="modify_pass.php">Cambiar Contraseña</a></li>
                                <li><a href="log_out.php">Salir</a></li>
                            </ul>
                    </div>

                    <div class="logo-element">

                       <img src="../favicon.ico" width="25" height="25">
                    </div>
                </li>

                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard </span></a>
                </li>
                <li>
                    <a href="seguimiento.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Seguimiento </span></a>
                </li>
				<li class="active">
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
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Bienvenid@ <?php echo $fetch_usuario[1];?>.</span>
                </li>
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
								<img align="center" src="../lib/img/ccx_logo.png" height="20%" >
							</td>
						</tr>
					</table>	
                </div>
            </div>		
            		
		<div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-12">
					<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Filtros del Reporte</h5>
                        </div>
							<div class="ibox-content col-md-12">
							<form id="expressForm" action="reporte_seguimiento.php" method="post">
							<div class="form-group">
								<div class="col-md-6">
									<h5 class="col-sm-2 control-label">Fecha</h5>
									<div class="row">
										<div class="form-group"  id="data_2">
											<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input required type="text" class="form-control" name="fecha" value="<?php echo $fecha_busqueda; ?>">
											</div>
										</div>		
									</div>
								</div>
								<div class="col-md-6">
									<a><input name="envio" type="submit" value="Buscar" type="button" class="btn btn-primary btn-sm btn-block"></a>
								</div>
							</div>
							</form>	
							</div>
					</div>	
                <div class="col-md-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title"> 
                            <h5>Actividades Registradas</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                        <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Reporte Bancos</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
						<th>Hora Fin</th>
                        <th>Proyecto</th>
                        <th>Actividad</th>
                        <th>Detalle</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>	
                    <?php
                    $sql_seguimientos = mysql_query("SELECT s.id_seguimiento_actividad, s.fecha_actividad, s.hora_ini, s.hora_fin, s.detalle, s.id_proyecto, s.id_actividad, SUBTIME(s.hora_fin, s.hora_ini) diferencia FROM pjc_seguimiento_actividades s WHERE  id_empleado = $fetch_empleado[4] AND fecha_actividad = '".$fecha_busqueda."' ORDER BY s.hora_ini ASC");
					$contador = 0;
                    while($list=mysql_fetch_array($sql_seguimientos))
					{
						
?> 									
                                  <tr>
                                      <td>
                                          <?php echo $list["fecha_actividad"];?>
                                      </td> 
                                      <td>
                                          <?php echo substr($list["hora_ini"],0,8);?>
                                      </td>
                                      <td>
                                          <?php echo substr($list["hora_fin"],0,8);?>
                                      </td>
                                      <td>
                                          <?php 
										  $nom_proyecto = mysql_query("SELECT nombre FROM sys_proyectos WHERE id_proyecto = ".$list['id_proyecto']."");
										  $fetch_nom_proyecto = mysql_fetch_row($nom_proyecto);
										  echo $fetch_nom_proyecto[0];?>
                                      </td>
									<td>
                                          <?php 
										  $nom_actividad = mysql_query("SELECT nombre FROM sys_actividades WHERE id_sys_actividades = ".$list['id_actividad']."");
										  $fetch_nom_actividad = mysql_fetch_row($nom_actividad);
										  echo $fetch_nom_actividad[0]; ?>
                                      </td>
									<td>
                                          <?php echo $list["detalle"];?>
                                      </td>
									<td>
                                    <table width="100%"><tr><td><?php if($fetch_nom_proyecto[0] == '' || is_null($fetch_nom_proyecto[0]) || is_null($fetch_nom_actividad[0]) || $fetch_nom_actividad[0] == ''){ ?><i class="fa fa-warning fa-1x" style="color:#DF0101;"> </i><?php } else { ?><i class="fa fa-check-circle-o fa-1x" style="color:#1EB340;"> </i><?php } ?></td><td>&nbsp;</td><td><a href="seguimiento.php?modf=<?php echo $list['id_seguimiento_actividad']; ?>"><i class="fa fa-edit fa-1x" style="color:#D7DF01;"></i></a></td></tr></table>
									
                                      </td>										
                                  </tr>
                                  <?php
                                }
            
                ?>
                    
                    </tfoot>
                    </table>
					<br>
					<?php
					$sql_contador = mysql_query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME(s.hora_fin, s.hora_ini)))) horas FROM pjc_seguimiento_actividades s WHERE id_empleado = $fetch_empleado[4] AND fecha_actividad = '".$fecha_busqueda."' ORDER BY s.hora_ini ASC");
					$fetch_contador = mysql_fetch_row($sql_contador);
					?>
					
					<h2 align="right"><?php echo $fetch_contador[0]; ?></h2>
                        </div>
                    </div>
                </div>   
</div>
                </div>
                        </div>
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

		$('#data_2 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			

		$(".dial").knob();
		
		});
		
		function cargarActividades()
		{
			var tipo = document.getElementById('tipoactividad').value;
			
			$("#selectActividad").load("seguimiento_act.php",{ param:tipo }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#selectActividad").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
		}
		
    </script>
</body>
</html>