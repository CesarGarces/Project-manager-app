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

	

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>

<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
	
	
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    
	
	<link rel="stylesheet" type="text/css" href="../lib/css/datetime-picker/bootstrap-datetimepicker.min.css" />
	
    <!-- Toastr style -->
    <link href="../lib/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="../lib/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!-- c3 Charts -->
    <link href="../lib/css/plugins/c3/c3.min.css" rel="stylesheet">



<!-- CSS de carga de archivos -->
<link rel="stylesheet" href="../lib/css/blueimp-gallery.min.css">

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="../lib/css/jquery.fileupload.css">
<link rel="stylesheet" href="../lib/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="../lib/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="../lib/css/jquery.fileupload-ui-noscript.css"></noscript>
	
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
	
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

                <li class="active">
                    <a href="panel.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Panel</span></a>
                </li>
                <li>
                    <a href="mediciones.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Mediciones</span></a>
                </li>
                <li>
                    <a href=""><i class="fa fa-arrow-circle-o-right"></i> <span class="nav-label">Proyectos</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                    
                        <li><a><i class="fa fa-slideshare"></i> Curso CEM<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse">
                                <li class="active"><a href="reporte_cem.php">Respuestas Modulo 1</a></li>
                                <li><a href="reporte_cem_inno.php">Respuestas Modulo 2</a></li>
                                <li><a href="reporte_cem_reco.php">Respuestas Recomendación</a></li>
                                <li><a href="reporte_evaluacion.php">Respuestas Evaluacion Certificado</a></li>
                            </ul>
                        </li>   
                    </ul>
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
				<li>
                    <a><i class="fa fa-mobile-phone"></i> <span class="nav-label">SMS Link</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
						<li><a href="sms_link_reglas.php">Reglas</a></li>
                        <li><a href="sms_link_enc.php">Encuestas</a></li>
                        <li><a href="sms_link_resp.php">Respuestas</a></li>
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
								<img align="center" src="../lib/img/izoboard_img1.png" height="30%" >
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
                            <li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-desktop"></i> Fechas</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-database"></i> Proyecto</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-3" class="tab-pane active">
                                <div class="panel-body">
                                    <strong>Ingrese el Seguimiento Diario</strong>

                                    <p>En el siguiente formulario diligencia la actividad que deseas registrar en tu seguimiento. Es simple.</p>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<h5 class="col-sm-2 control-label">Proyecto</h5>
										<div class="col-sm-10">
											<div class="row">
												<select class="form-control m-b" name="account">
													<option>Seleccione un Proyecto</option>
													<option>Banco de Bogotá</option>
													<option>Protección</option>
													<option>SURA</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<h5 class="col-sm-2 control-label">Actividad</h5>
										<div class="col-sm-5">
											<div class="row">
												<select class="form-control m-b" name="account">
													
												</select>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="row">
												<select class="form-control m-b" name="account">
													<option>Seleccione la Actividad</option>
                                                    
												</select>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										
										<h5 class="col-sm-2 control-label">Fecha y Hora</h5>
										<div class="col-sm-5">
											<div class="form-group">
												<div class='input-group date' id='datetimepicker6'>
													<input type='text' class="form-control" />
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>
											</div>
										</div>
										<div class='col-sm-5'>
											<div class="form-group">
												<div class='input-group date' id='datetimepicker7'>
													<input type='text' class="form-control" />
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>
											</div>
										</div>
									</div>
                                    <div class="container">
										<h5>Detalle de la Actividad</h5>
										<textarea class="form-control noresize" id="encCss" noresize></textarea>	
									</div>
									<br>
									<div class="hr-line-dashed"></div>
									<div class='col-sm-12'>
										<div class='col-sm-4' align="center">		
											<a data-toggle="modal" class="btn btn-success" href="#modal-form">Revisar Fecha</a>
										</div>
										<div id="modal-form" class="modal fade" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-body">
														<div class="row">
															<div class="form-group" id="data_1">
																<label class="font-noraml">Seleccione una Fecha</label>
																<div class="input-group date">
																	<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
																</div>
															</div>
															
														</div>
													</div>
												</div>
											</div>
										</div>
                    
										<div class='col-sm-4' align="center">		
											<button type="button" class="btn btn-w-m btn-primary">Guardar Actividad</button>
										</div>	
										<div class='col-sm-4' align="center">		
											<button type="button" class="btn btn-w-m btn-success">Revisar Proyecto</button>
										</div>											
									</div>
                                </div>
                            </div>
                            <div id="tab-4" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Fechas</strong>

                                    <p>Proximamente...</p>

                                </div>
                            </div>
                            <div id="tab-5" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Proyecto</strong>

                                    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
               <span>
                    
                    <select class="form-control m-b" name="proyecto">
                        <option  value="">Seleccione un Proyecto</option>
                        <option  value="1">Banco de Bogotá</option>
                        <option  value="2">Protección</option>
                        <option  value="3">SURA</option>
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Demo Notes</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>The maximum file size for uploads in this demo is <strong>999 KB</strong> (default file size is unlimited).</li>
                <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
                <li>Uploaded files will be deleted automatically after <strong>5 minutes or less</strong> (demo files are stored in memory).</li>
                <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">Browser support</a>).</li>
                <li>Please refer to the <a href="https://github.com/blueimp/jQuery-File-Upload">project website</a> and <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">documentation</a> for more information.</li>
                <li>Built with the <a href="http://getbootstrap.com/">Bootstrap</a> CSS framework and Icons from <a href="http://glyphicons.com/">Glyphicons</a>.</li>
            </ul>
        </div>
    </div>
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
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
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


 <!-- js de carga de archivos -->
<script src="../lib/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="../lib/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="../lib/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="../lib/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="../lib/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="../lib/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="../lib/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="../lib/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="../lib/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="../lib/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="../lib/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="../lib/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="../lib/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="../lib/js/main.js"></script>

    <script>
        $(document).ready(function() {
		
			$('#datetimepicker6').datetimepicker();
			$('#datetimepicker7').datetimepicker({
				useCurrent: false //Important! See issue #1075
			});
			$("#datetimepicker6").on("dp.change", function (e) {
				$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
			});
			$("#datetimepicker7").on("dp.change", function (e) {
				$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
			});
			
			
			$('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
		});

    </script>

</body>
</html>
