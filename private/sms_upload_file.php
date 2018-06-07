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
require'../users/class/encuestas.php';


$objEnc = new Encuesta();
$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$img_users = $objUse->img_users();

$id_encuesta  = isset($_POST['id_encuesta']) ? $_POST['id_encuesta'] : null ;


?>
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
                            <h5>Bases</h5>

                    </div>
                <div class="ibox-content">
                  <table>
                    <tr>
                      <td style="width: 40%;" align="center">
                        <b>Base</b>
                      </td>
                      <td style="width: 40%;" align="center">
                        <b>Mes</b>
                      </td>
                      <td style="width: 45;" align="center">
                        <b>Semana</b>
                      </td>
                    </tr>
                    <tr>
                      <td>

                            <select class="form-control required m-d valid" name="id_encuesta" >
                                <option value="">Seleccione Base</option>
                                <option value="1">Siniestro Inicial</option>
                                <option value="2">Siniestro Final</option>
                               
                                
                            </select>
                      </td>
                      <td>

                            <select class="form-control required m-d valid" name="mes" >
                                <option value="">Seleccione Mes</option>
                                <option value="ENE">Enero</option>
                                <option value="FEB">Febrero</option>
                                <option value="MAR">Marzo</option>
                                <option value="ABR">Abril</option>
                                <option value="MAY">Mayo</option>
                                <option value="JUN">Junio</option>
                                <option value="JUL">Julio</option>
                                <option value="AGO">Agosto</option>
                                <option value="SEP">Septiembre</option>
                                <option value="OCT">Octubre</option>
                                <option value="NOV">Nomviembre</option>
                                <option value="DIC">Diciembre</option>
                               
                                
                            </select>
                      </td>
                      <td>

                            <select class="form-control required m-d valid" name="semana" >
                                <option value="">Seleccione Semana</option>
                                <option value="S1">Semana 1</option>
                                <option value="S2">Semana 2</option>
                                <option value="S3">Semana 3</option>
                                <option value="S4">Semana 4</option>
                               
                                
                            </select>
                      </td>
                    </tr>
                  </table>
                        <input type='submit' name='enviar'  value="Enviar" class="btn btn-primary" />
                    </div>
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



$mes  = isset($_POST['mes']) ? $_POST['mes'] : null ;
$semana  = isset($_POST['semana']) ? $_POST['semana'] : null ;
date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d H:i:s');
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

// Cargando la hoja de cálculo
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("bak_".$archivo);
$objFecha = new PHPExcel_Shared_Date();

// Asignar hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////////////////
if($id_encuesta=="1"){
//  $i=1;
// while($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue() !=''){
// $i++; 
$i=1;
while($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue() !=''){
$i++;
  
  $_DATOS_EXCEL[$i]['ciudad']= $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['identificacion']= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['nombre']= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['contacto']= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['fecha_arch']= $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['fecha_arch'] = ($_DATOS_EXCEL[$i]['fecha_arch'] - 25569) * 86400;
  $_DATOS_EXCEL[$i]['fecha_arch'] = date( 'Y-m-d', $_DATOS_EXCEL[$i]['fecha_arch'] );
  $_DATOS_EXCEL[$i]['id_izo'] = 'SESA_Inicial_'.$mes.$semana.'_'.$i;

$numeros[$i] = $_DATOS_EXCEL[$i];

}
foreach($_DATOS_EXCEL as $campo => $valor){
    
    if($valor['ciudad']!=''){
  
  $sql = "INSERT INTO base_siniestro_inicial VALUES (
    NULL,
    '".$valor['ciudad']."',
    '".$valor['identificacion']."',
    '".$valor['nombre']."',
    '".$valor['contacto']."',
    '".$valor['fecha_arch']."',
    '".$valor['id_izo']."',
    'Activo'
    )";
      
    

$result = mysql_query($sql);


echo "<script>      
         swal('Archivo cargado exitosamente','Correcto','succes');
    </script>";
  if (!$result){ echo "Error al insertar registro ".$campo;}
}
}
}//if 1

  ////////////////////////////////////////////////////////////////////////////////
elseif($id_encuesta=="2"){
$i=1;
while($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue() !=''){
$i++;
  
  $_DATOS_EXCEL[$i]['ciudad']= $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['identificacion']= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['nombre']= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['contacto']= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['fecha_arch']= $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['fecha_arch'] = ($_DATOS_EXCEL[$i]['fecha_arch'] - 25569) * 86400;
  $_DATOS_EXCEL[$i]['fecha_arch'] = date( 'Y-m-d', $_DATOS_EXCEL[$i]['fecha_arch'] );
  $_DATOS_EXCEL[$i]['taller']= $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['id_izo'] = 'SESA_Final_'.$mes.$semana.'_'.$i;

$numeros[$i] = $_DATOS_EXCEL[$i];

}
foreach($_DATOS_EXCEL as $campo => $valor){
  
  if($valor['ciudad']!=''){
  $sql = "INSERT INTO base_siniestro_final VALUES (
    NULL,
    '".$valor['ciudad']."',
    '".$valor['identificacion']."',
    '".$valor['nombre']."',
    '".$valor['contacto']."',
    '".$valor['fecha_arch']."',
    '".$valor['taller']."',
    '".$valor['id_izo']."',
    'Activo'
    )";
      

$result = mysql_query($sql);


echo "<script>      
         swal('Archivo cargado exitosamente','Correcto','succes');
    </script>";
  if (!$result){ echo "Error al insertar registro ".$campo;}
}

}
}//if 2

else{
  echo "<script>      
         swal('Por favor seleccione una encuesta','No se encontro encuesta','error');
    </script>";
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
