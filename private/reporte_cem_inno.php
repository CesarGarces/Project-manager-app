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
require'../users/class/reportes.php';
$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objLin = new Reporte();

$list_reporte_inicial = mysql_query("SELECT * FROM enc_curso_cem_inno");
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();

$row_rol=mysql_fetch_array($img_roles);
$id_rol = $row_rol['id_rol'];

date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
$fecha_a=date('Y');
$mes_a=date('m');
/*************** Parametros ***************/
$taller = isset($_REQUEST['taller']) ? $_REQUEST['taller'] : null ;
$ciudad = isset($_REQUEST['ciudad']) ? $_REQUEST['ciudad'] : null ;
$siniestro = isset($_REQUEST['siniestro']) ? $_REQUEST['siniestro'] : null ;
$mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : $mes_a ;
$ano = isset($_REQUEST['ano']) ? $_REQUEST['ano'] : $fecha_a ;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IZO | Reportes</title>
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
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
                <li class="active">
                    <a href=""><i class="fa fa-arrow-circle-o-right"></i> <span class="nav-label">Proyectos</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                    
                        <li class="active"><a><i class="fa fa-slideshare"></i> Curso CEM<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse">
                                <li><a href="reporte_cem.php">Respuestas Modulo 1</a></li>
                                <li class="active"><a href="reporte_cem_inno.php">Respuestas Modulo 2</a></li>
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
                <div class="ibox-content">
                    
                    </div>
                <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Respuestas Encuesta Curso CEM</h5>
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
                        <th>Nombre Participante</th>
                        <th>Celular</th>
                        <th>Satisfacción Módulo de Medición</th>
                        <th>Es aplicable</th>
                        <th>Satisfacción Módulo de Innovar</th>
                        <th>Ves aplicable el pasillo de cliente</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                    while($list=mysql_fetch_array($list_reporte_inicial))
					{
?> 
                                    <tr>
                                        <td>
                                            <?php echo $list["nombres"];?>
                                        </td> 
                                        <td>
                                            <?php echo $list["celular"];?>
                                        </td>
                                        <td>
                                            <?php echo $list["enc1"];?>
                                        </td> 
                                        <td>
                                            <?php echo $list["enc2"];?>
                                        </td> 
                                        <td>
                                            <?php echo $list["enc3"];?>
                                        </td>   
                                        <td>
                                            <?php echo $list["enc4"];?>
                                        </td> 
                                                                                                                 
                                    </tr>
                                    <?php
                                }
            
                ?>
                    
                    </tfoot>
                    </table>
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
    </div>
</div>
          
<!-- Mainly scripts -->
<script src="../lib/js/jquery-2.1.1.js"></script>
<script src="../lib/js/bootstrap.min.js"></script>
<script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../lib/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="../lib/js/inspinia.js"></script>
<script src="../lib/js/plugins/pace/pace.min.js"></script>
<script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'reporte_Inicial'},
                    {extend: 'pdf', title: 'reporte_Inicial'},
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
                        / Init DataTables /
            var oTable = $('#editable').DataTable();
    });
</script>
</body>
</html>
