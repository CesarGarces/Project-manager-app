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
$id_usr = $row_rol['id_usuario'];

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

//Validamos si hay datos por Guardar y/o Modificar
if(isset($_REQUEST['action']) && isset($_REQUEST['form']))
{
    if($_REQUEST['form'] == "empleado")
    {
        if($_REQUEST['action'] == "mod")
        {
            $query_update_cargos = mysql_query("UPDATE sys_empleados SET id_usuario = ".$_REQUEST['empleado'].", id_pais = '".$_REQUEST['pais']."', fecha_ingreso = '".$_REQUEST['fechaingreso']."', id_cargo = '".$_REQUEST['cargo']."', id_tipo_contrato = '".$_REQUEST['tipocontrato']."' WHERE id_empleado = ".$_REQUEST['empleado']);
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
            $query_insert_cargos = mysql_query("INSERT INTO sys_empleados(id_empleado, id_usuario, id_pais, fecha_ingreso, id_cargo, id_tipo_contrato) VALUES (NULL, '".$_REQUEST['empleado']."','".$_REQUEST['pais']."','".$_REQUEST['fechaingreso']."','".$_REQUEST['cargo']."', '".$_REQUEST['tipocontrato']."')");
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
        if($_REQUEST['action'] == "del")
        {
            $query_insert_cargos = mysql_query("DELETE FROM sys_empleados WHERE id_empleado = ".$_REQUEST['empleado']);
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

    //Proyectos

    if($_REQUEST['form'] == "proyecto")
    {
        if($_REQUEST['action'] == "mod")
        {
            $query_update_cargos = mysql_query("UPDATE sys_proyectos SET id_cliente = ".$_REQUEST['cliente'].", id_tipo_proyecto = '".$_REQUEST['proyecto']."', nombre = '".$_REQUEST['nombre']."', id_pais = '".$_REQUEST['pais']."', ciudad = '".$_REQUEST['ciudad']."', descripcion = '".$_REQUEST['descripcion']."', fecha_inicio =  '".$_REQUEST['fechainicio']."', duracion_estimada =  '".$_REQUEST['duracion']."',id_estado_proyecto =  '".$_REQUEST['estado']."' WHERE id_proyecto = ".$_REQUEST['proyectoid']);
           
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

            $query_insert_cargos = mysql_query("INSERT INTO sys_proyectos(id_proyecto, id_cliente, id_tipo_proyecto, nombre, id_pais, ciudad, descripcion, fecha_inicio, duracion_estimada, id_estado_proyecto) VALUES (NULL, '".$_REQUEST['cliente']."','".$_REQUEST['proyecto']."','".$_REQUEST['nombre']."', '".$_REQUEST['pais']."','".$_REQUEST['ciudad']."', '".$_REQUEST['descripcion']."', '".$_REQUEST['fechainicio']."', '".$_REQUEST['duracion']."', '".$_REQUEST['estado']."')");
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
        if($_REQUEST['action'] == "del")
        {
            $query_insert_cargos = mysql_query("DELETE FROM sys_proyectos WHERE id_proyecto = ".$_REQUEST['proyecto']);
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

    //Clientes

    if($_REQUEST['form'] == "cliente")
    {
        if($_REQUEST['action'] == "mod")
        {
            $ruta="../users/logos";
            $archivo=$_FILES['cambiar_imagen']['tmp_name'];
            $nombreArchivo=$_FILES['cambiar_imagen']['name'];
            move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
            $ruta=$ruta."/".$nombreArchivo;
            
            if ($ruta =="../users/logos/")   {
            $query_update_cargos = mysql_query("UPDATE sys_clientes SET  id_tipo_documento = '".$_REQUEST['tipodoc']."', documento = '".$_REQUEST['documento']."', apellido1 = '".$_REQUEST['apellido']."', razon_social = '".$_REQUEST['rsocial']."', nombre = '".$_REQUEST['nombre']."', id_sector =  '".$_REQUEST['sector']."', email_principal =  '".$_REQUEST['email1']."',id_pais =  '".$_REQUEST['pais']."', telefono_principal = '".$_REQUEST['tel1']."', direccion_principal = '".$_REQUEST['dir1']."', id_empleado_contacto = '".$_REQUEST['empleado']."', nombre_contacto_ppal = '".$_REQUEST['contpal']."', celular_contacto_ppal = '".$_REQUEST['cel1']."', email_contacto_principal = '".$_REQUEST['mailpal']."', nombre_contacto_sec = '".$_REQUEST['nom2']."', celular_contacto_sec =  '".$_REQUEST['cel2']."', email_contacto_sec =  '".$_REQUEST['mail3']."'  WHERE id_cliente = ".$_REQUEST['cliente']);
            }else{
            $query_update_cargos = mysql_query("UPDATE sys_clientes SET  id_tipo_documento = '".$_REQUEST['tipodoc']."', documento = '".$_REQUEST['documento']."', apellido1 = '".$_REQUEST['apellido']."', razon_social = '".$_REQUEST['rsocial']."', nombre = '".$_REQUEST['nombre']."', id_sector =  '".$_REQUEST['sector']."', email_principal =  '".$_REQUEST['email1']."',id_pais =  '".$_REQUEST['pais']."', telefono_principal = '".$_REQUEST['tel1']."', direccion_principal = '".$_REQUEST['dir1']."', id_empleado_contacto = '".$_REQUEST['empleado']."', nombre_contacto_ppal = '".$_REQUEST['contpal']."', celular_contacto_ppal = '".$_REQUEST['cel1']."', email_contacto_principal = '".$_REQUEST['mailpal']."', nombre_contacto_sec = '".$_REQUEST['nom2']."', celular_contacto_sec =  '".$_REQUEST['cel2']."', email_contacto_sec =  '".$_REQUEST['mail3']."', logo = '".$ruta."'  WHERE id_cliente = ".$_REQUEST['cliente']);
            }
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
            $ruta="../users/logos";
            $archivo=$_FILES['logo']['tmp_name'];
            $nombreArchivo=$_FILES['logo']['name'];
            move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
            $ruta=$ruta."/".$nombreArchivo;

            $query_insert_cargos = mysql_query("INSERT INTO sys_clientes(id_cliente, id_tipo_documento, documento, apellido1, razon_social, nombre, id_sector, email_principal, id_pais, telefono_principal,direccion_principal,fecha_registro,id_empleado_contacto,nombre_contacto_ppal,celular_contacto_ppal,email_contacto_principal,nombre_contacto_sec,celular_contacto_sec,email_contacto_sec,logo) VALUES (NULL, '".$_REQUEST['tipodoc']."','".$_REQUEST['documento']."','".$_REQUEST['apellido']."', '".$_REQUEST['nombre']."','".$_REQUEST['rsocial']."', '".$_REQUEST['sector']."', '".$_REQUEST['email1']."', '".$_REQUEST['pais']."', '".$_REQUEST['tel1']."', '".$_REQUEST['dir1']."',now(), '".$_REQUEST['empleado']."', '".$_REQUEST['contpal']."', '".$_REQUEST['cel1']."', '".$_REQUEST['mailpal']."', '".$_REQUEST['nom2']."', '".$_REQUEST['cel2']."', '".$_REQUEST['mail3']."', '".$ruta."')");
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
        if($_REQUEST['action'] == "del")
        {
            $query_insert_cargos = mysql_query("DELETE FROM sys_clientes WHERE id_cliente = ".$_REQUEST['cliente']);
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





//Datos del Usuario
$sql_usuario = mysql_query("SELECT id_usuario, CONCAT(primer_nombre,' ',primer_apellido,' ',segundo_apellido) as nombres FROM sys_usuarios WHERE login = '".$user."'");
$fetch_usuario = mysql_fetch_row($sql_usuario);

//Datos del Empleado
$sql_empleado = mysql_query("SELECT p.nombre, (TIMESTAMPDIFF(MONTH,e.fecha_ingreso,CURDATE())) tiempo, c.nombre cargo, d.nombre dependencia, id_empleado FROM sys_empleados e, sys_paises p, sys_cargos c, sys_dependencias d WHERE p.id_pais = e.id_pais AND e.id_cargo = c.id_cargo AND c.id_dependencia = d.id_dependencia AND e.id_usuario = $fetch_usuario[0]");
$fetch_empleado = mysql_fetch_row($sql_empleado);

//Proyectos Activos
$sql_proyectos = mysql_query("SELECT COUNT(1) FROM sys_empleado_rol_proyectos WHERE id_empleado = $fetch_empleado[4]");
$fetch_proyectos = mysql_fetch_row($sql_proyectos);

//Datos de la semana
$sql_semanal = mysql_query("SELECT COUNT(1) FROM pjc_seguimiento_actividades WHERE CURDATE() BETWEEN DATE_SUB(CURDATE(), INTERVAL DAYOFWEEK(CURDATE())-1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY) AND id_empleado = $fetch_empleado[4]");
$fetch_semanal = mysql_fetch_row($sql_semanal);

//Registros de hoy
$sql_dehoy = mysql_query("SELECT COUNT(1) FROM pjc_seguimiento_actividades WHERE fecha_diligencia = CURDATE() AND id_empleado = $fetch_empleado[4]");
$fetch_dehoy = mysql_fetch_row($sql_dehoy);
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
				<li>
                    <a href="#"><i class="fa fa-check-square-o"></i> <span class="nav-label">Reportes </span></a>
                </li>
                <?php
				if($id_rol <= 6)
				{
				?>
                <li class="active">
                    <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Configuraciones </span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
						<li><a href="configuraciones_maestras.php"><i class="fa fa-slideshare"></i> Maestros</span></a></li>   
						<li class="active"><a href="configuraciones_maestras2.php"><i class="fa fa-slideshare"></i> Proyectos</a></li>   
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
                <div class="col-lg-12" align="center">
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
                    
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Empleados </h5>
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
                            <h5>Configuración que te permite parametrizar los Empleados existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editEmpleados(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Empleado" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarEmpleados();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showEmpleados">
                        </div>
                    </div>
                </div>

				<div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Clientes </h5>
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
                            <h5>Configuración que te permite parametrizar los Clientes existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editCliente(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Cliente" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarClientes();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showClientes">
                        </div>
                    </div>
                </div>
				
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Proyectos </h5>
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
                            <h5>Configuración que te permite parametrizar los Proyectos existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editProyectos(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Proyecto" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarProyectos();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showProyectos">
                        </div>
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
                                <div class="modal-body" id="modalAction">
                                
                                </div>
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

        
        });
        


        /*************************Empleados*************************/

        function revisarEmpleados()
        {
            $("#showEmpleados").load("maestros/empleados.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showEmpleados").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editEmpleados(idEmpleado)
        {
            $("#modalAction").load("maestros/editempleados.php",{ mod: idEmpleado }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteEmpleados(idEmpleado)
        {
            $("#modalAction").load("maestros/deleteempleado.php",{ del: idEmpleado }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        /*************************Proyectos*************************/

        function revisarProyectos()
        {
            $("#showProyectos").load("maestros/proyectos.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showProyectos").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editProyectos(idProyecto)
        {
            $("#modalAction").load("maestros/editproyectos.php",{ mod: idProyecto }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteProyectos(idProyecto)
        {
            $("#modalAction").load("maestros/deleteproyectos.php",{ del: idProyecto }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
		
		/*************************Clintes*************************/

        function revisarClientes()
        {
            $("#showClientes").load("maestros/clientes.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showClientes").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editCliente(idCliente)
        {
            $("#modalAction").load("maestros/editclientes.php",{ mod: idCliente }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteCliente(idCliente)
        {
            $("#modalAction").load("maestros/deletecliente.php",{ del: idCliente }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
    </script>



</body>



</html>
