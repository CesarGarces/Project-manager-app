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
$list_role = $objUse->list_role();
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();

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



    <title>IZO | Nuevo Rol</title>



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
                <li class="active">
                    <a><i class="fa fa-cog"></i> <span class="nav-label">Ajustes</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="user_list.php">Usuarios</a></li>
                        <li class="active"><a href="rol_list.php">Roles</a></li>
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

                    <h2>Nuevo Rol</h2>

                    <ol class="breadcrumb">

                        <li>

                            <a href="panel.php">Inicio</a>

                        </li>

                        <li>

                            <a href="rol_list.php">Roles</a>

                        </li>

                        

                        <li class="active">

                            <strong>Nuevo Rol</strong>

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

                                            <form role="form" action="new_rol_exe.php" method="post" >

                                                <input type="hidden"  name="usuario_crea" value="<?php echo $_SESSION['user']; ?>">

                                                    <div class="col-sm-12">

                                                        <div class="panel panel-default">

                                                            <div class="panel-heading"><h3 class="panel-title">Descripcion del rol</h3>

                                                            </div>

                                                                <div class="panel-body">

                                                                <fieldset>

                                                                    <div class="row">

                                                                        <div class="col-md-12">

                                                                            <div class="control-group">

                                                                                <label label-default="" class="control-label">Nombre</label>

                                                                                    <div class="controls">

                                                                                        <input type="text" class="form-control"  title="Rol" required  name="Rol" value="">

                                                                                            <span class="help-block m-b-none">Nombre que describe el rol.</span>

                                                                                    </div>

                                                                            </div>

                                                                                <a class="btn btn-white" href="rol_list.php">Cancel</a>&nbsp;

                                                                                <button class="btn btn-primary" type="submit">Guardar</button>

                                                                        </div><!--col-->

                                                                    </div><!--row-->

                                                                </fieldset>

                                                                </div><!--panel body-->                                                                        

                                                        </div><!--panel-->

                                                    </div><!--div col 12-->

                                            </form>

                                        </div>

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

