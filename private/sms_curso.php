<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Carga Archivos</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link href="../lib/css/sweetalert.css" rel="stylesheet">
    <link href="../lib/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="../lib/css/plugins/dropzone/dropzone.css" rel="stylesheet">
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
                                
                                


                 <span>
                            <img alt="image" width="48" height="48" class="img-circle" src="">
                             </span>
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"></strong>
                             </span> <span class="text-muted text-xs block"> <b class="caret"></b></span> </span> </a>
                       
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
                <li>
                    <a href=""><i class="fa fa-sticky-note-o"></i> <span class="nav-label">Encuestas</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="enc_renovacion.php">Renovacion</a></li>
                        <li><a href="enc_vent_indiv.php">Ventas Individuales</a></li>
                        <li><a href="enc_siniestro_vam.php">Siniestros VAM</a></li>
                        <li><a href="enc_siniestro_casa.php">Siniestros Casa Habitación</a></li>
                        <li><a href="enc_siniestro_robo.php">Siniestros Robo</a></li>
                        <li><a href="enc_siniestro_vehi_parcial.php">Siniestros Vehiculos Pérdidas Parciales</a></li>
                        <li><a href="enc_siniestro_vehi_total.php">Siniestros Vehiculos Pérdidas Totales</a></li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Ajustes</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="user_list.php">Usuarios</a></li>
                        <li><a href="rol_list.php">Roles</a></li>
                        <li><a href="lineas_list.php">Lineas</a></li>
                        <li><a href="permisos_list.php">Permisos</a></li>
                        <li><a href="asigpermisos_list.php">Asignar Permisos</a></li>
                        <li><a href="modulos_list.php">Modulos</a></li>
                        <li><a href="secciones_list.php">Secciones</a></li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-sticky-note-o"></i> <span class="nav-label">Reportes</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="reporte_agentes.php">Asesores</a></li>
                        <li><a href="reporte_general.php">General</a></li>
                        <li><a href="reporte_dias.php">Días</a></li>

                    </ul>
                </li>
                <li class="active">
                    <a href="sms.php"><i class="fa fa-phone-square"></i> <span class="nav-label">Cargar Archivo</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                        <li  class="active"><a href="sms_upload_file.php">Cargar Archivo</a></li>

                    </ul>
                </li>
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
                    <h2>Carga de Archivos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="panel.php">Inicio</a>
                        </li>

                        <li class="active">
                            <strong>Carga de Archivos</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="ibox col-md-12">
                <div class="ibox-title">
                            <h5>Carga de Archivos</h5>

                    </div>

                <div class="ibox-content">
                        <form name="importa" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
                            <input type="file" name="excel" />
                   
                    <input type="hidden" value="upload" name="action" />


                    </div>
                </div>
                <div class="ibox col-md-12">
                <div class="ibox-title">
                            <h5>Sección</h5>

                    </div>
                
                            
                        <input type='submit' name='enviar'  value="Enviar" class="btn btn-primary" />
                    
                </div>
</div>


</form>



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
<script src="../lib/js/plugins/dropzone/dropzone.js"></script>

<?php
date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d H:i:s');

$fecha_d=date('d');
$fecha_m=date('m');

$action ="";
extract($_POST);
if ($action == "upload"){
//cargamos el archivo al servidor con el mismo nombre
//solo le agregue el sufijo bak_

  //$crea = $_SESSION['user'];
  $archivo = $_FILES['excel']['name'];
  $tipo = $_FILES['excel']['type'];
  $destino = "bak_".$archivo;
  if (copy($_FILES['excel']['tmp_name'],$destino)) echo "";
  else echo "";
////////////////////////////////////////////////////////
if (file_exists ("bak_".$archivo)){
/** Clases necesarias */
require_once('../lib/PHPExcel.php');
require_once('../lib/PHPExcel/Reader/Excel2007.php');
require'../users/class/google.php';
// Cargando la hoja de cálculo
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("bak_".$archivo);
$objFecha = new PHPExcel_Shared_Date();

// Asignar hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////////////////
$cn = mysql_connect ("localhost","root","IZ0.r1c0pap1r1c0") or die ("ERROR EN LA CONEXION");
$db = mysql_select_db ("izoboard_izo",$cn) or die ("ERROR AL CONECTAR A LA BD");

//  $i=1;
// while($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue() !=''){
// $i++; 
$i=1;
while($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue() !=''){
$i++;
  
  $_DATOS_EXCEL[$i]['nombre'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['email']= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['celular']= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();

  

$numeros[$i] = $_DATOS_EXCEL[$i];

}
                    
                    

                    
foreach($_DATOS_EXCEL as $campo => $valor){
                    
                    $nombre_cliente = $valor["nombre"];
                    $celular =  $valor["celular"];
                    $link_url = "http://izoboard.net:88/izoboard/encuestas/enc_curso_cem_reco.php?celular=$celular";                               
                    $mensaje = "Hola $nombre_cliente, desde IZO tenemos una encuesta para ti, por favor respondela en el siguiente link: $link_url";
                    $key = 'AIzaSyBaAudeYsvxzaAr6P5dpE7Y-NRpnGNTp74';
                    $googer = new GoogleURLAPI($key);
                    $enlace = $googer->shorten($link_url);

  $sql = "INSERT INTO enc_curso_cem_reco VALUES (
    NULL,
    '".$valor['nombre']."',
    '".$valor['email']."',
    NULL,
    '".$valor['celular']."',
    'Activo',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    '".$enlace."',
    'Ecuador'
    )";

echo $sql;
if($nombre_cliente == ''){

}else{
  $result = mysql_query($sql);
}

echo "<script>      
         swal('Archivo cargado exitosamente','Correcto','succes');
    </script>";
  if (!$result){ echo "Error al insertar registro ".$campo;}

}

}
//si por algo no cargo el archivo bak_
else{echo "Necesitas primero importar el archivo";}
$errores=0;
//recorremos el arreglo multidimensional
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD



/////////////////////////////////////////////////////////////////////////

//una vez terminado el proceso borramos el
//archivo que esta en el servidor el bak_
unlink($destino);
}

?>

</body>

</html>
