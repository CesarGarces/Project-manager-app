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

$list_reporte_inicial = mysql_query("SELECT * FROM evaluacion_cem where estado = 'Encuesta Efectiva' ");
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

                <li>
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
                                <li><a href="reporte_cem_inno.php">Respuestas Modulo 2</a></li>
                                <li><a href="reporte_cem_reco.php">Respuestas Recomendación</a></li>
                                <li class="active"><a href="reporte_evaluacion.php">Respuestas Evaluacion Certificado</a></li>
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
                        <h5>Tabla de Puntos Evaluacion CEM</h5>
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
                        <th>1. Cuál es el ingrediente escencial para el recuerdo?</th>
                        <th>2. Cuál es el marco de la relación entre los clientes y las empresas?</th>
                        <th>3. De las siguientes ¿cuál NO es una dimensión del Framework?</th>
                        <th>4. El Pasillo de Cliente es una herramienta que sirve para:</th>
                        <th>5) El enfoque correcto para construir el pasillo del cliente es:</th>
                        <th>6) Los Perfiles de cliente son:</th>
                        <th>7) De los siguientes, ¿Cuál no sería considerado un indicador de Experiencia?</th>
                        <th>8) Cuál es la escala de medición oficial del NPS?</th>
                        <th>9) El NPS se obtiene a partir del siguiente cálculo:</th>
                        <th>10) Cuál es la pregunta que mide el CES?</th>
                        <th>11) Las 3 dimensiones en las que debemos gestionar la Experiencia son:</th>
                        <th>12) Están orientadas a analizar la lealtad de los clientes/consumidores hacia la marca. Esto habla del indicador:</th>
                        <th>13) La metodología AT-ONE sive para:</th>
                        <th>14) Define aquellas interacciones que son realmente IMPORTANTES Para el cliente</th>
                        <th>15) Son los atributos con los que se definen que una interacción es un momento de dolor</th>
                        <th>16) Si hablamos de indagar por el nivel de recomendación luego de vivir una interacción particular estamos hablando de:</th>
                        <th>17. Explica con tus palabras la importancia de incorporar un modelo de Economía de las Relaciones en los estudios realizados.</th>
                        <th>18) Estos son dos de los principales economics de la experiencia</th>
                        <th>19) Esto lo debe tener un programa de Voz del cliente (VOC)</th>
                        <th>20) Este factor es primordial identificar, para determinar qu economics se pueden usar:</th>
                        <th>Total Puntos</th>


                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                    while($list=mysql_fetch_array($list_reporte_inicial))
					{
                        $total = 0;
                        $resp1 = 'c';
                        $resp2 = 'a';
                        $resp3 = 'b';
                        $resp4 = 'd';
                        $resp5 = 'c';
                        $resp6 = 'c';
                        $resp7 = 'c';
                        $resp8 = 'c';
                        $resp9 = 'b';
                        $resp10 = 'a';
                        $resp11 = 'c';
                        $resp12 = 'b';
                        $resp13 = 'c';
                        $resp14 = 'a';
                        $resp15 = 'c';
                        $resp16 = 'c';

                        $resp18 = 'a';
                        $resp19 = 'e';
                        $resp20 = 'b';
?> 
                                    <tr>
                                        <td>
                                            <?php echo $list["nombre"];?>
                                        </td> 

                                        <td>
                                            <?php  $list["resp1"]; if($resp1 == $list["resp1"]){ $total1 = 1; } else { $total1 = 0; } echo $total1; ?>
                                        </td> 
                                        <td>
                                            <?php  $list["resp2"]; if($resp2 == $list["resp2"]){ $total2 = 1; } else { $total2 = 0; } echo $total2?>
                                        </td> 
                                        <td>
                                            <?php  $list["resp3"]; if($resp3 == $list["resp3"]){ $total3 = 1; } else { $total3 = 0; } echo $total3?>
                                        </td>
                                        <td>
                                            <?php  $list["resp4"]; if($resp4 == $list["resp4"]){ $total4 = 1; } else { $total4 = 0; } echo $total4?>
                                        </td>    
                                        <td>
                                            <?php  $list["resp5"]; if($resp5 == $list["resp5"]){ $total5 = 1; } else { $total5 = 0; } echo $total5?>
                                        </td> 
                                        <td>
                                            <?php  $list["resp6"]; if($resp6 == $list["resp6"]){ $total6 = 1; } else { $total6 = 0; } echo $total6?>
                                        </td>
                                        <td>
                                            <?php  $list["resp7"]; if($resp7 == $list["resp7"]){ $total7 = 1; } else { $total7 = 0; } echo $total7?>
                                        </td>
                                        <td>
                                            <?php  $list["resp8"]; if($resp8 == $list["resp8"]){ $total8 = 1; } else { $total8 = 0; } echo $total8?>
                                        </td>
                                        <td>
                                            <?php  $list["resp9"]; if($resp9 == $list["resp9"]){ $total9 = 1; } else { $total9 = 0; } echo $total9?>
                                        </td>
                                        <td>
                                            <?php  $list["resp10"]; if($resp10 == $list["resp10"]){ $total10 = 1; } else { $total10 = 0; } echo $total10?>
                                        </td>
                                        <td>
                                            <?php  $list["resp11"]; if($resp11 == $list["resp11"]){ $total11 = 1; } else { $total11 = 0; } echo $total11?>
                                        </td>
                                        <td>
                                            <?php  $list["resp12"]; if($resp12 == $list["resp12"]){ $total12 = 1; } else { $total12 = 0; } echo $total12?>
                                        </td>
                                        <td>
                                            <?php  $list["resp13"]; if($resp13 == $list["resp13"]){ $total13 = 1; } else { $total13 = 0; } echo $total13?>
                                        </td>
                                        <td>
                                            <?php  $list["resp14"]; if($resp14 == $list["resp14"]){ $total14 = 1; } else { $total14 = 0; } echo $total14?>
                                        </td>
                                        <td>
                                            <?php  $list["resp15"]; if($resp15 == $list["resp15"]){ $total15 = 1; } else { $total15 = 0; } echo $total15?>
                                        </td>
                                        <td>
                                            <?php  $list["resp16"]; if($resp16 == $list["resp16"]){ $total16 = 1; } else { $total16 = 0; } echo $total16?>
                                        </td>
                                        <td>
                                            <?php  $list["resp17"]; if($list["resp17"] != ''){ $total17 = 1; } else { $total17 = 0; } echo $total17?>
                                        </td>
                                        <td>
                                            <?php  $list["resp18"]; if($resp18 == $list["resp18"]){ $total18 = 1; } else { $total18 = 0; } echo $total18?>
                                        </td>
                                        <td>
                                            <?php  $list["resp19"]; if($resp19 == $list["resp19"]){ $total19 = 1; } else { $total19 = 0; } echo $total19?>
                                        </td>
                                        <td>
                                            <?php  $list["resp20"]; if($resp20 == $list["resp20"]){ $total20 = 1; } else { $total20 = 0; } echo $total20?>
                                        </td>
                                        <td>
                                            <?php 
                                            $total =  $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10 + $total11 + $total12 + $total13 + $total14 + $total15 + $total16 + $total17 + $total18 + $total19 + $total20; 
                                            
                                            echo $total;
                                            ?>
                                        </td>
                                                                                                                 
                                    
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
                    {extend: 'excel', title: 'evaluacion_cem'},
                    {extend: 'pdf', title: 'evaluacion_cem'},
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
