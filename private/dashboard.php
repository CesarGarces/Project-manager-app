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
$sql_dehoy = mysql_query("SELECT COUNT(1) FROM pjc_seguimiento_actividades WHERE DATE(fecha_diligencia) = CURDATE() AND id_empleado = $fetch_empleado[4]");
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
	
	<script>
	var inicio=0;
	var timeout=0;
 
	function empezarDetener(elemento)
	{
		if(timeout==0)
		{
			// empezar el cronometro
 
			elemento.value="Detener";
			document.getElementById("btprimary").classList.remove('btn-primary');
			document.getElementById("btprimary").classList.add('btn-danger');
						
			// Obtenemos el valor actual
			inicio=vuelta=new Date().getTime();
 
			// iniciamos el proceso
			funcionando();
		}else{
			//Vemos cuando terminó
			var actual = new Date().getTime();
			
			document.getElementById("btprimary").classList.remove('btn-danger');
			document.getElementById("btprimary").classList.add('btn-primary');
						
			// Actualizamos los valores de horas en el formulario y la fecha
			document.getElementById("hini").value = inicio;
			document.getElementById("hfin").value = actual;
			// detemer el cronometro
			elemento.value="Comenzar";
			clearTimeout(timeout);
			timeout=0;
			
			// Enviamos el formulario
			document.getElementById("expressForm").submit();
		}
	}
 
	function funcionando()
	{
		// obteneos la fecha actual
		var actual = new Date().getTime();
 
		// obtenemos la diferencia entre la fecha actual y la de inicio
		var diff=new Date(actual-inicio);
 
		// mostramos la diferencia entre la fecha actual y la inicial
		var result=LeadingZero(diff.getUTCHours())+":"+LeadingZero(diff.getUTCMinutes())+":"+LeadingZero(diff.getUTCSeconds());
		document.getElementById('crono').innerHTML = result;
 
		// Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
		timeout=setTimeout("funcionando()",1000);
	}
 
	/* Funcion que pone un 0 delante de un valor si es necesario */
	function LeadingZero(Time) {
		return (Time < 10) ? "0" + Time : + Time;
	}
	</script>
 
	<style>
	.crono_wrapper {text-align:center;width:200px;}
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
                <div class="col-md-4">
					<div class="col-md-12">
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ingreso Express</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right" align="center">
                                <div class="ibox-content profile-content">
									
									<form id="expressForm" action="seguimiento_exe.php" method="post">
									<div class="form-group">
										<input type="text" name="hini" id="hini" hidden>
										<input type="text" name="hfin" id="hfin" hidden>
										<div class="col-sm-12">
											<div class="row">
												<select class="form-control m-b" name="proyecto" required>
													<option value="0">Seleccione Proyecto</option>
                                                    
                                                  <?php  while($fetch_proyecto = mysql_fetch_array($lista_proyecto)){ ?>
                                                    
                                                       <option value="<?php echo $fetch_proyecto[0]; ?>"><?php echo $fetch_proyecto[1]; ?></option>  
                                                                                                    
                                                   <?php } ?>
                                                    
												</select>
                                            </div>
												
										</div>
									</div>
									
									<div class="form-group">
                                        <div class="col-sm-6">
											<div class="row">
												<select class="form-control m-b" id="tipoactividad" name="tipoactividad" required onchange="cargarActividades();">
													<option value="0">Tipo de Actividad</option>
													<?php  
                                                    
                                                    while($fetch_actividad = mysql_fetch_array($tipo_actividad)){ ?>
                                                    
                                                       <option value="<?php echo $fetch_actividad[0]; ?>"><?php echo $fetch_actividad[1]; ?></option>  
                                                                                                    
                                                   <?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<select class="form-control m-b" name="actividad" required id="selectActividad">
													<option value="0">Actividad</option>
												</select>
											</div>
										</div>
									</div>
									<input type="text" name="express" id="express" hidden value="0">
									<div class="crono_wrapper">
										<a ><input name="btprimary" type="button" id="btprimary" onclick="empezarDetener(this);" value="Comenzar" type="button" class="btn btn-primary"></a>
										<h2 id='crono'>00:00:00</h2>
									</div>
									</form>
								</div>
							</div>
                        </div>
						</div>
					</div>	
					<div class="col-md-12">
						<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Perfil</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right" align="center">
                                <img width="200px" alt="image" class="img-responsive" src="<?php echo $fetch_usuario[2];?>">
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong><?php echo $fetch_usuario[1]; ?></strong></h4>
                                <p><i class="fa fa-map-marker"></i> IZO <?php echo $fetch_empleado[0]; ?></p>
                                <h5>
                                    Sobre mi:
                                </h5>
                                <p>
                                    <b>Cargo:</b> <?php echo $fetch_empleado[2]; ?>
									<br>
									<b>Departamento:</b> <?php echo $fetch_empleado[3]; ?>
									<br>
									<b>Antiguedad:</b> <?php echo $fetch_empleado[1]; ?> Meses.
                                </p>
                                <div class="row m-t-lg">
                                    <div class="col-md-4" align="center">
                                        <span class="bar">1,2,5,1,2,4,3,0,7,1</span>
                                        <h5><strong><?php echo $fetch_semanal[0]; ?></strong> Actividades esta Semana</h5>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <span class="line">3,5,9,6,5,9,7,4,5,5</span>
                                        <h5><strong><?php echo $fetch_proyectos[0]; ?></strong> Proyectos Activos</h5>
                                    </div>
                                    <div class="col-md-4" align="center">
                                        <span class="bar">1,2,5,1,2,4,3,0,7,1</span>
                                        <h5><strong><?php echo $fetch_dehoy[0]; ?></strong> Actividades Registradas Hoy</h5>
                                    </div>
                                </div>
                                <div class="user-button">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="seguimiento.php"><button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil-square-o"></i> Diligenciar Formato</button></a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="reporte_seguimiento.php"><button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-tasks"></i> Mis Seguimientos</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
                    </div>
				</div>	
                <div class="col-md-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title"> 
                            <h5>Actividades Recientes</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
									<?php
									while($fetch_notificaciones = mysql_fetch_array($sql_notificaciones))
									{
									$sql_notify_crea = mysql_query("SELECT CONCAT(uc.primer_nombre,' ',uc.primer_apellido) nombre_crea, uc.imagen FROM sys_empleados ec, sys_usuarios uc, sys_notificaciones n WHERE n.id_empleado_crea = ec.id_empleado AND ec.id_usuario = uc.id_usuario AND n.id_empleado_crea = ".$fetch_notificaciones['id_empleado_crea']);
									$fetch_notify_crea = mysql_fetch_row($sql_notify_crea);		
									
									$estado_not = mysql_query("SELECT COUNT(1) FROM sys_notificaciones WHERE id_proyecto IS NULL OR id_proyecto = 0 AND id_notificacion = ".$fetch_notificaciones['id_notificacion']);
									
									$fetch_estado_not = mysql_fetch_row($estado_not);
									?>		
                                    <div class="feed-element">
                                        <a href="#" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?php echo $fetch_notify_crea[1]; ?>">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"><?php if($fetch_estado_not[0] == 0){ echo "Completa"; } else{ echo "Incompleta"; }?></small>
                                            <strong><?php echo $fetch_notificaciones["observacion"]; ?>. <br>
                                            <small class="text-muted"><?php echo $fetch_notificaciones["fecha"]; ?></small>
                                            <?php if($fetch_notificaciones["detalle"] != ''){ ?> 
											<div class="well">
                                                <?php echo $fetch_notificaciones["detalle"]; ?>
                                            </div> <?php } ?>
                                            <!--<div class="actions" align="right">
                                                <a class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a>
                                            </div>-->
                                        </div>
                                    </div>
									<?php
									}
									?>
                                </div>

                                <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                <strong>Powered By</strong> Synergy Contact.
            </div>
            <div>
                <strong>Copyright</strong> IZO &copy; 2015-2017
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
