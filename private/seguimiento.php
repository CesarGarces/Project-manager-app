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


$error = "";

if(isset($_REQUEST['modf']))
{
	$sql_seguimiento = mysql_query("SELECT * FROM pjc_seguimiento_actividades WHERE id_seguimiento_actividad = ".$_REQUEST['modf']);
	$fetch_seguimiento = mysql_fetch_row($sql_seguimiento);
	
	$id_seg = $fetch_seguimiento[0];
	$id_emp = $fetch_seguimiento[1];
	$id_pro = $fetch_seguimiento[2];
	$id_act = $fetch_seguimiento[3];
	$det = $fetch_seguimiento[4];
	$fec_act = $fetch_seguimiento[5];
	$hora_i = $fetch_seguimiento[6];
	$hora_f = $fetch_seguimiento[7];
	$fec_dil = $fetch_seguimiento[8];
	
	$modf = $_REQUEST['modf'];
}
else
{
	$id_seg = "";
	$id_emp = "";
	$id_pro = "";
	$id_act = "";
	$det = "";
	$fec_act = "";
	$hora_i = "";
	$hora_f = "";
	$fec_dil = "";
	
	$modf = 0;
}

$emp_query = mysql_query("SELECT id_empleado FROM sys_empleados WHERE id_usuario = ".$id_user);
$fetch_emp = mysql_fetch_row($emp_query);

$empleado = $fetch_emp[0];

$creado = isset($_REQUEST['creado']) ? $_REQUEST['creado'] : null ;
$lista_proyecto = mysql_query("SELECT p.id_proyecto, p.nombre FROM sys_empleados e, sys_usuarios u, sys_proyectos p, sys_empleado_perfil_proyectos ep where ep.id_proyecto = p.id_proyecto AND ep.id_empleado = e.id_empleado AND e.id_usuario = u.id_usuario AND ep.estado = 'Activado' AND u.id_usuario = ".$id_user." ORDER BY p.nombre ASC");
$lista_proyecto2 = mysql_query("SELECT p.id_proyecto, p.nombre FROM sys_empleados e, sys_usuarios u, sys_proyectos p, sys_empleado_perfil_proyectos ep where ep.id_proyecto = p.id_proyecto AND ep.id_empleado = e.id_empleado AND e.id_usuario = u.id_usuario AND ep.estado = 'Activado' AND u.id_usuario = ".$id_user." ORDER BY p.nombre ASC" );
$tipo_actividad = mysql_query("SELECT id_tipo_actividad, nombre FROM sys_tipo_actividades");

//Validamos si hay datos por Guardar y/o Modificar
if(isset($_REQUEST['action']) && isset($_REQUEST['form']))
{
    if($_REQUEST['form'] == "asignacion")
    {
        if($_REQUEST['action'] == "mode")
        {
            $query_update_cargos = mysql_query("UPDATE sys_empleado_perfil_proyectos SET estado = 'Desactivado' WHERE id_empleado_perfil_proyecto = ".$_REQUEST['asignacion']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            $query_insert_cargos = mysql_query("INSERT INTO sys_empleado_perfil_proyectos(id_empleado_perfil_proyecto, id_empleado, id_perfil, id_proyecto, fecha_asignacion, estado, id_tipo_duracion, cantidad_duracion) VALUES (NULL, '".$_REQUEST['empleado']."','".$_REQUEST['perfil']."','".$_REQUEST['proyecto']."', now(), 'Activado', '".$_REQUEST['duracion']."', '".$_REQUEST['cant_duracion']."' )");
			//Empleado
			$sql_emp = mysql_query("SELECT id_empleado, id_proyecto FROM sys_empleado_perfil_proyectos WHERE id_empleado_perfil_proyecto = ".$_REQUEST['asignacion']);
			$fetch_emp = mysql_fetch_row($sql_emp);
			
			//Proyecto
			$proyecto_sel = mysql_query("SELECT nombre FROM sys_proyectos WHERE id_proyecto = ".$fetch_emp[1]."");
			$fetch_proyecto_Sel = mysql_fetch_row($proyecto_sel);
			$proyecto = $fetch_proyecto_Sel[0];
			
			//Usuario
			$usr_query = mysql_query("SELECT CONCAT(primer_nombre,' ',primer_apellido) nombre FROM sys_usuarios WHERE id_usuario = $id_user");
			$fetch_usr = mysql_fetch_row($usr_query);
			$nombreUsuario = $fetch_usr[0];
			
			//Insert de la notificación para el panel	
			$sql_notificacion = mysql_query("INSERT INTO sys_notificaciones VALUES(NULL,".$fetch_emp[0].",".$fetch_emp[1].",'<b>".$nombreUsuario."</b> te ha asignado al proyecto <b>".$proyecto."</b>','".$_POST['detalle']."',now(),".$empleado.")");	
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "des")
        {
            $query_insert_cargos = mysql_query("UPDATE sys_empleado_perfil_proyectos SET estado = 'Desactivado' WHERE id_empleado_perfil_proyecto = ".$_REQUEST['asignacion']);
			//Empleado
			$sql_emp = mysql_query("SELECT id_empleado, id_proyecto FROM sys_empleado_perfil_proyectos WHERE id_empleado_perfil_proyecto = ".$_REQUEST['asignacion']);
			$fetch_emp = mysql_fetch_row($sql_emp);
			
			//Proyecto
			$proyecto_sel = mysql_query("SELECT nombre FROM sys_proyectos WHERE id_proyecto = ".$fetch_emp[1]."");
			$fetch_proyecto_Sel = mysql_fetch_row($proyecto_sel);
			$proyecto = $fetch_proyecto_Sel[0];
			
			//Usuario
			$usr_query = mysql_query("SELECT CONCAT(primer_nombre,' ',primer_apellido) nombre FROM sys_usuarios WHERE id_usuario = $id_user");
			$fetch_usr = mysql_fetch_row($usr_query);
			$nombreUsuario = $fetch_usr[0];
			
			//Insert de la notificación para el panel	
			$sql_notificacion = mysql_query("INSERT INTO sys_notificaciones VALUES(NULL,".$fetch_emp[0].",".$fetch_emp[1].",'<b>".$nombreUsuario."</b> te ha desactivado en el proyecto <b>".$proyecto."</b>','".$_POST['detalle']."',now(),".$empleado.")");	
			$msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "act")
        {
            $query_insert_cargos = mysql_query("UPDATE sys_empleado_perfil_proyectos SET estado = 'Activado' WHERE id_empleado_perfil_proyecto = ".$_REQUEST['asignacion']);
			//Empleado
			$sql_emp = mysql_query("SELECT id_empleado, id_proyecto FROM sys_empleado_perfil_proyectos WHERE id_empleado_perfil_proyecto = ".$_REQUEST['asignacion']);
			$fetch_emp = mysql_fetch_row($sql_emp);
			
			//Proyecto
			$proyecto_sel = mysql_query("SELECT nombre FROM sys_proyectos WHERE id_proyecto = ".$fetch_emp[1]."");
			$fetch_proyecto_Sel = mysql_fetch_row($proyecto_sel);
			$proyecto = $fetch_proyecto_Sel[0];
			
			//Usuario
			$usr_query = mysql_query("SELECT CONCAT(primer_nombre,' ',primer_apellido) nombre FROM sys_usuarios WHERE id_usuario = $id_user");
			$fetch_usr = mysql_fetch_row($usr_query);
			$nombreUsuario = $fetch_usr[0];
			
			//Insert de la notificación para el panel	
			$sql_notificacion = mysql_query("INSERT INTO sys_notificaciones VALUES(NULL,".$fetch_emp[0].",".$fetch_emp[1].",'<b>".$nombreUsuario."</b> te ha activado en el proyecto <b>".$proyecto."</b>','".$_POST['detalle']."',now(),".$empleado.")");	
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }  
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Panel</title>

	

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>

<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
	
	
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link href="../lib/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="../lib/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    
	
	<link rel="stylesheet" type="text/css" href="../lib/css/plugins/datetime-picker/bootstrap-datetimepicker.min.css" />
	
    <!-- Toastr style -->
    <link href="../lib/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="../lib/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!-- c3 Charts -->
    <link href="../lib/css/plugins/c3/c3.min.css" rel="stylesheet">
	
	
    <link rel="icon" type="image/x-icon" href="../favicon.ico">



    <link rel="stylesheet" href="css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="css/jquery.fileupload.css">
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>
	
	<style type="text/css">
      .demo { position: relative; }
      .demo i {
        position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;
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
                <li class="active">
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
                    <span class="m-r-sm text-muted welcome-message">Bienvenid@ .</span>
                </li>
                <!--<li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>-->
                <!--<li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>-->


                <li>
                    <a href="log_out.php">
                        <i class="fa fa-sign-out"></i> Salir
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10" align="center">
					<table>
						<tr align="center" width="100%">
							<td align="center" width="100%">
								<br>
								<a href="panel.php" ><img align="center" src="../lib/img/ccx_logo.png" height="20%" ></a>
							</td>
						</tr>
					</table>	
                </div>
            </div>		
            		
		<div class="wrapper wrapper-content">
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                    <h5>Formulario de Seguimiento <small>Seleccione una opción.</small></h5>
                    </div>
                        <div class="ibox-content">

                            <div class="row">
								<div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-3"> <i class="fa fa-laptop"></i> Individual</a></li>
                            <!--<li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-desktop"></i> Fechas</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-database"></i> Proyecto</a></li>-->
							<li class=""><a data-toggle="tab" href="#tab-6"><i class="fa fa-database"></i> Carga de Archivos</a></li>
                            <?php
							if($id_rol <= 6)
							{
							?>
							<li class=""><a data-toggle="tab" href="#tab-7"><i class="fa fa-file-o"></i> Asignación de Proyectos</a></li>
							<?php
							}
							?>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-3" class="tab-pane active">
                                <div class="panel-body">
                                    <strong>Ingrese el Seguimiento Diario</strong>

                                    <p>En el siguiente formulario diligencia la actividad que deseas registrar en tu seguimiento. Es simple.</p>
								<?php if($modf == 0){ ?>
								<form id="form" action="seguimiento_exe.php" method="post"> 
								<?php } else { ?>
								<form id="form" action="seguimiento_exe.php?modf=<?php echo $modf; ?>" method="post"> 
								<?php } ?>
                                    <input type="hidden" class="form-control" name="id_empleado" value="<?php echo $empleado; ?>" >
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<h5 class="col-sm-2 control-label">Proyecto</h5>
										<div class="col-sm-10">
											<div class="row">
												<select required class="form-control m-b" name="proyecto">
													<option value="">Seleccione Proyecto</option>
                                                    
                                                  <?php  while($fetch_proyecto = mysql_fetch_array($lista_proyecto)){ 
												  
														if($fetch_proyecto[0] == $id_pro)
														{
												  ?>
														<option selected value="<?php echo $fetch_proyecto[0]; ?>"><?php echo $fetch_proyecto[1]; ?></option>  	
													<?php
												  }	else {	
													?>	
														<option value="<?php echo $fetch_proyecto[0]; ?>"><?php echo $fetch_proyecto[1]; ?></option>  
                                                                                                    
												  <?php }} ?>
                                                    
                                             </select>
                                            </div>
												
											</div>
										</div>
									
									<div class="form-group">
										<h5 class="col-sm-2 control-label">Actividad</h5>
                                        <div class="col-sm-5">
											<div class="row">
												<select class="form-control m-b" id="tipoactividad" name="tipoactividad" required onchange="cargarActividades(<?php echo $id_act; ?>);">
													<option value="">Seleccione el Tipo de Actividad</option>
													<?php  
                                                    
                                                    while($fetch_actividad = mysql_fetch_array($tipo_actividad)){ 
													$sql_tipo_actividad = mysql_query("SELECT ta.id_tipo_actividad FROM sys_actividades a, sys_tipo_actividades ta WHERE a.id_tipo_actividad = ta.id_tipo_actividad AND a.id_sys_actividades = ".$id_act);
													$fetch_tipo_actividad = mysql_fetch_row($sql_tipo_actividad);
													if($fetch_actividad[0] == $fetch_tipo_actividad[0])
														{
													?>
														<option selected value="<?php echo $fetch_actividad[0]; ?>"><?php echo $fetch_actividad[1]; ?></option>  
														<?php } else { ?>
                                                       <option value="<?php echo $fetch_actividad[0]; ?>"><?php echo $fetch_actividad[1]; ?></option>  
                                                                                                    
													<?php } } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="row">
												<select required class="form-control m-b" name="actividad" id="selectActividad">
													<option value="">Seleccione la Actividad</option>
												</select>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<h5 class="col-sm-2 control-label">Fecha</h5>
										<div class="col-sm-2">
											<div class="row">
												<div class="form-group"  id="data_2">
												
												<div class="input-group date">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input required type="text" class="form-control" name="fecha" value="<?php echo $fec_act; ?>">
												</div>
												</div>		
											</div>
										</div>
                                        <h5 class="col-sm-2 control-label">Hora Inicial</h5>
										<div class='col-sm-2'>
											<div class="row">
												<div class="input-group clockpicker" data-autoclose="true">
                                                    <input required type="time" class="form-control" name="hini" step="1" value="<?php echo $hora_i; ?>" >
													<span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
											</div>	
										</div>

                                        <h5 class="col-sm-2 control-label">Hora Final</h5>
                                        <div class='col-sm-2'>
                                            <div class="row">
                                                <div class="input-group clockpicker2" data-autoclose="true">
                                                    <input required type="time" class="form-control" name="hfin" step="1" value="<?php echo $hora_f; ?>" >
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
											</div>
                                        </div>
									</div>
                                    <div class="form-group col-sm-12">
										<h5>Detalle de la Actividad</h5>
										<textarea required name="detalle" class="form-control noresize" id="encCss" noresize ><?php echo $det; ?></textarea>	
									</div>
									<br>
									<div class="form-group col-sm-12">
										<div class="hr-line-dashed"></div>
									</div>	
									<br>
									<div class='col-sm-12'>
										
                                 
										
                                    
										<div class='col-sm-12' align="center">
                                        <?php 
                                        $cant = mysql_num_rows($lista_proyecto);
                                        if($cant <= 0){ ?>
                                        <button type="button" class="btn btn-w-m btn-default">Guardar Actividad</button>
                                        <?php } else { 
										if($modf != 0){
										?>
										<button type="submit" class="btn btn-w-m btn-primary">Actualizar Actividad</button>
										<?php } else { ?>
                                        <button type="submit" class="btn btn-w-m btn-primary">Guardar Actividad</button>
                                        <?php } } ?>

											
										</div>
																					
									</div>
									</form>
                                </div>
                            </div>
                            <div id="tab-7" class="tab-pane">
                                <div class="panel-body">
                                    

                                    




                                            <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Asignación de Proyectos</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite Asignar Proyectos.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="addAsignacion(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Asignacion" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a>
                            </td>
                            </tr>
                        </table>
                    </br>
                        <?php
                        $sql_actividades = mysql_query("SELECT ep.id_empleado_perfil_proyecto, 
e.id_usuario, 
CONCAT(u.primer_nombre,' ',u.primer_apellido) nom_empleado, 
p.nombre nom_proyecto, 
pe.nombre perfil, 
ep.estado, 
ep.fecha_asignacion,
td.nombre nombred,
ep.cantidad_duracion 
FROM sys_empleado_perfil_proyectos ep, 
sys_proyectos p, 
sys_usuarios u, 
sys_empleados e, 
sys_perfiles pe,
sys_tipos_duraciones td 
where ep.id_empleado = e.id_empleado
AND ep.id_perfil = pe.id_perfil
AND u.id_usuario = e.id_usuario
AND ep.id_tipo_duracion = td.id_tipo_duracion
AND ep.id_proyecto = p.id_proyecto");
                        ?>
                        <table class="table table-striped table-bordered table-hover dataTables-example" width="100%">
                            <thead>
                            <tr width="100%">
                                <th width="5%">#</th>
                                <th width="20%">Nombre</th>
                                <th width="20%">Proyecto</th>
                                <th width="10%">Perfil</th>
                                <th width="10%">Duración</th>
								<th width="15%">Fecha Asignación</th>
                                <th width="10%">Activar</th>
                                <th width="10%">Desactivar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contador =0;
                            while($fetch_actividades = mysql_fetch_array($sql_actividades))
                                {   
                            $contador ++;   
                            ?>
                            <tr>
                                <td style="vertical-align:middle;"><?php echo $contador; ?></td>
                                <td style="vertical-align:middle;"><?php echo $fetch_actividades['nom_empleado']; ?></td>
                                <td style="vertical-align:middle;"><?php echo $fetch_actividades['nom_proyecto']; ?></td>
                                <td style="vertical-align:middle;"><?php echo $fetch_actividades['perfil']; ?></td>
								<td style="vertical-align:middle;"><?php echo $fetch_actividades['cantidad_duracion']." ".$fetch_actividades['nombred']; ?></td>
                                <td style="vertical-align:middle;"><?php echo $fetch_actividades['fecha_asignacion']; ?></td>
                                <?php if($fetch_actividades['estado'] == 'Desactivado'){?> 
                                <td align="center"><a onclick="editAsignacion(<?php echo $fetch_actividades["id_empleado_perfil_proyecto"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top"  style="text-decoration:none;color:white;" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-unlock"></i></a></td>
                                <?php } else { ?>
                                <td align="center"><a title data-placement="top"  style="text-decoration:none;color:white;" class="btn btn-default btn-circle btn-xs"><i class="fa fa-unlock"></i></a></td>
                                <?php } ?>

                                <?php if($fetch_actividades['estado'] == 'Activado'){?> 
                                <td align="center"><a onclick="deleteAsignacion(<?php echo $fetch_actividades["id_empleado_perfil_proyecto"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top"  style="text-decoration:none;color:white;" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-lock"></i></a><br></td>
                                <?php } else { ?>
                                <td align="center"><a  title data-placement="top"  style="text-decoration:none;color:white;" class="btn btn-default btn-circle btn-xs"><i class="fa fa-lock"></i></a><br></td>
                                <?php } ?>
                                
                            </tr>	
                            <?php
                            }
                            ?>
    
                            </tbody>
                        </table>
                        </div>
                    </div>
                


                <!-- Modal -->
                <div id="modal-form" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="fa fa-laptop modal-icon"></i>
                                <h4 class="modal-title">Panel de Configuración</h4>
                                <small class="font-bold">Por medio de esta ventana podrás Crear / Editar / Eliminar los maestros del Sistema.</small>
                            </div>
                            <div class="modal-content">
                                <div class="modal-body" id="modalOk">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
                
        </div>






                                </div>
                            </div>
                            
							<div id="tab-6" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Carga de Archivos</strong>

                                    <div class="container">
    
    <br>
    
    <br>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="usuario" value="<?php echo $_SESSION['user']; ?>">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
               <div class="col-lg-7">
               <span>
                    
                    <select class="form-control m-b" name="proyecto" required>
                        <option>Seleccione Proyecto</option>
                        <?php  while($fetch_proyecto2 = mysql_fetch_array($lista_proyecto2)){ ?>
                                                    
							<option value="<?php echo $fetch_proyecto2[0]; ?>"><?php echo $fetch_proyecto2[1]; ?></option>  
																		
						<?php } ?>
                    </select>
                </span>
                <br>
    
    <br>
            </div>
       
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    <br>
    
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script> 

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
                    
	<script src="../lib/js/jquery-2.1.1.js"></script>
    
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

<script src="../lib/js/bootstrap.min.js"></script>

<script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>

   <!-- Data picker -->
   <script src="../lib/js/plugins/datapicker/bootstrap-datepicker.js"></script>
					
    <!-- Custom and plugin javascript -->
    <script src="../lib/js/inspinia.js"></script>
    <script src="../lib/js/plugins/pace/pace.min.js"></script>


    <script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Clock picker -->
    <script src="../lib/js/plugins/clockpicker/clockpicker.js"></script>
     <!-- Toastr -->
    <script src="../lib/js/plugins/toastr/toastr.min.js"></script>
    <script src="../lib/js/plugins/dataTables/datatables.min.js"></script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!-- blueimp Gallery script -->
<script src="js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="js/main.js"></script>


    <script>
    /*************************Asignacion*************************/

        function revisarAsignacion()
        {
            $("#showAsignacion").load("maestros/asignacion.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showAsignacion").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editAsignacion(idAsignacion)
        {
            $("#modalOk").load("maestros/activarasignacion.php",{ act: idAsignacion }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalOk").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        function addAsignacion(idAsignacion)
        {
            $("#modalOk").load("maestros/editasignacion.php",{ act: idAsignacion }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalOk").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteAsignacion(idAsignacion)
        {
            $("#modalOk").load("maestros/deleteasignacion.php",{ del: idAsignacion }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalOk").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        $(document).ready(function() {
			
			cargarActividades(<?php echo $id_act; ?>);

            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Asignaciones'},
                    {extend: 'pdf', title: 'Asignaciones'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
            
                        /* Init DataTables */
            var oTable = $('#editable').DataTable();
            

<?php  if($creado == 1)
        {?>
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Seguimiento Creado Satisfactoriamente');

            }, 1300);
      <?php  } ?>

            $('.clockpicker').clockpicker();
            $('.clockpicker2').clockpicker();
		
			$('#data_2 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			
			
			$('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
            
		});
		
		function cargarActividades(actividad_sel)
		{
			
			var tipo = document.getElementById('tipoactividad').value;
			
			$("#selectActividad").load("seguimiento_act.php",{ param:tipo, modf:actividad_sel }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#selectActividad").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
		}
        

    </script>

</body>
</html>
