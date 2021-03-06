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
require'../users/class/clients.php';

$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();

$objUse = new clients();
$list_clients = $objUse->list_clients();
$list_canal = $objUse->list_canal();

$row_rol=mysql_fetch_array($img_roles);
$id_rol = $row_rol['id_rol'];

date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
$fecha_a=date('Y');
/*************** Parametros ***************/
$agencia = isset($_REQUEST['agencia']) ? $_REQUEST['agencia'] : null ;
$region = isset($_REQUEST['region']) ? $_REQUEST['region'] : null ;
$area = isset($_REQUEST['area']) ? $_REQUEST['area'] : null ;
$mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : null ;
$ano = isset($_REQUEST['ano']) ? $_REQUEST['ano'] : $fecha_a ;

$error = "";

/*************** Filtros ***************/
/*************** Region ***************/
$filtro_region = mysql_query("SELECT DISTINCT region FROM sys_agencias WHERE region <> ''");
/*************** Agencia ***************/
$sql_agencia = "SELECT DISTINCT agencia FROM sys_agencias WHERE agencia <> ''";
/*************** Region ***************/
$filtro_area = mysql_query("SELECT DISTINCT tipocontacto FROM sys_preguntas_encuesta WHERE tipocontacto <> '' AND motivocontacto = 'Encuesta Efectiva'");


?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Nuevo Estudio</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link href="../lib/css/sweetalert.css" rel="stylesheet">
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
                <li class="active">
                    <a><i class="fa fa-arrow-circle-o-right"></i> <span class="nav-label">Datos</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="client_list.php">Clientes</a></li>
                        <li><a href="segmento_list.php">Segmentos</a></li>
                        <li><a href="canal_list.php">Canales</a></li>
                        <li class="active"><a href="estudio_list.php">Estudios</a></li>
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

                    <h2>Nuevo Estudio</h2>

                    <ol class="breadcrumb">

                        <li>

                            <a href="panel.php">Inicio</a>

                        </li>

                        

                        <li class="active">

                            <strong>Estudios</strong>

                        </li>

                    </ol>

                </div>

            </div>


			<div class="wrapper wrapper-content  animated fadeInRight">            

                <div class="row">

					<div class="col-lg-12">

						<div class="ibox">

							<div class="ibox-content">                    

								<div class="row">

									<form client="form" action="new_estudio_exe.php" method="post" >

										<input type="hidden"  name="usuario_crea" value="<?php echo $_SESSION['user']; ?>">

											<div class="col-sm-12">

												<div class="panel panel-default">

													<div class="panel-heading"><h3 class="panel-title">Descripción del estudio</h3>

													</div>

													<table class="table table-striped table-hover" data-page-size="15" style="font-size: small;">
													<thead>
														<tr>
															<th><label label-default="" class="control-label">Fecha estudio</label></th>
															<th><label label-default="" class="control-label">Cliente</label></th>
															<th><label label-default="" class="control-label">Nombre Estudio</label></th>
															<th><label label-default="" class="control-label">Canal</label></th>
														</tr>
													</thead>
													<tbody>
														<tr><td>
														<input class="form-control required m-b" data-val="true" data-val-date="Fecha Inválida" id="fecha_estudio" name="fecha_estudio" type="date" value="1/1/0001 12:00:00 AM" required></td>
														</td>
														<td>
														<select class="form-control required m-b valid" name="id_cliente" required >
															<?php
															$numrows = mysql_num_rows($list_clients);
																if($numrows > 0){
																	while($row=mysql_fetch_array($list_clients)){
																		$id_cliente = $row["id_cliente"];?>
																<option value='<?php echo $row["id_cliente"];?>'><?php echo $row["nombre"];?></option>"; 
															<?php
																	}
															
																}
																?>
														</select></td>
														<td>
															<input type="text" class="form-control" title="nombre_estudio" required="" name="nombre_estudio" value="">
														</td>
														<td>
														<select class="form-control required m-b valid" name="id_canal" required >
															<?php
															$numrows = mysql_num_rows($list_canal);
																if($numrows > 0){
																	while($row=mysql_fetch_array($list_canal)){
																		$id_canal = $row["id_canal"];?>
																<option value='<?php echo $row["id_canal"];?>'><?php echo $row["canal"];?></option>"; 
															<?php
																	}
															
																}
																?>
														</select>
														</td>
														<td align="center">
															<a class="btn btn-white" href="estudio_list.php">Cancel</a>
															<button class="btn btn-primary" type="submit">Guardar</button>
														</td></tr>
													</tbody>
													</table>

												</div>



											</div><!--col-->
											
									</form>

								</div><!--row-->

							</div><!--panel body-->                                                                        

						</div><!--panel-->

					</div><!--div col 12-->

				</div>

			</div>













            <!-- Footer -->

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

<script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>



<!-- Custom and plugin javascript -->

<script src="../lib/js/inspinia.js"></script>

<script src="../lib/js/plugins/pace/pace.min.js"></script>

<script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>


</body>



</html>

