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
require'../users/class/panel.php';
require'../users/class/encuestas.php';

$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objEnc = new Encuesta();
$img_users = $objUse->img_users();
$idIzo = isset($_GET['id_izo']) ? $_GET['id_izo'] : null ;
$idEnc = "01";
$estadoClient = "";
if($idIzo != NULL){
    
      $buscar_cliente = $objEnc->buscar_cliente($idIzo);
      $sqlClient = mysql_fetch_row($buscar_cliente);
      $idCliente=  $sqlClient[0];
      $idIzo =  $sqlClient[21]; 
      $docClient = $sqlClient[1];
      $nomClient = $sqlClient[2]; 
      $telClient = $sqlClient[3]; 
      $celClient = $sqlClient[4];
      $sucClient = $sqlClient[6];
      $estadoClient = $sqlClient[28];
      $seccionClient = $sqlClient[9];
      //no pregunta por cajas la 2,4,5

}else{
    $nomClient = "";
    $apeClient = "";
    $idIzo = "";
    $sucClient = "";
    $seccionClient = "";
    
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Encuestas</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link href="../lib/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="../lib/css/sweetalert.css" rel="stylesheet">
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
                                        $nombre_usuario = $row['primer_nombre'];
                                        $ape_usuario = $row['primer_apellido'];
                                        $id_rol = $row['id_rol'];
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
                    <?php 
                    if($id_rol == 3){
                    ?>
                </li>

                <li>
                    <a href="panel.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Panel</span></a>
                </li>
                <li>
                    <a href="mediciones.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Mediciones</span></a>
                </li>
                <li class="active">
                    <a href=""><i class="fa fa-sticky-note-o"></i> <span class="nav-label">Encuestas</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="active"><a href="enc_renovacion.php">Renovacion</a></li>
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
                <li>
                    <a href="sms.php"><i class="fa fa-phone-square"></i> <span class="nav-label">Cargar Archivo</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                        <li><a href="sms_upload_file.php">Cargar Archivo</a></li>

                    </ul>
                </li>
                <?php
            }else{

            }?>
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
                    <h2>Administracion Y Envio de Mensajes SMS</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="panel.php">Inicio</a>
                        </li>

                        <li class="active">
                            <strong>SMS Admin</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="ibox col-md-6">
                <div class="ibox-title">
                            <h5>Carga de Archivos - SMS Envio Masivo</h5>

                    </div>
                <div class="ibox-content">
                        <form name="importa" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
                            <input type="file" name="excel" />
                    <input type="hidden" name="nombre_crea" value="<?php echo $_SESSION['user'];?>">
                    <input type="hidden" value="upload" name="action" />


                        <input type='submit' name='enviar'  value="Enviar" class="btn btn-primary" />
                    </div>
                </div>
                <div class="ibox col-md-6">

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
<script>


    $(document).ready(function () {

        $("#dropzone").dropzone({
            url: "<?php echo $PHP_SELF; ?>",
        });

</script>
<?php





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

//conectamos con la base de datos
$cn = mysql_connect ("localhost","root","IZ0.r1c0pap1r1c0") or die ("ERROR EN LA CONEXION");//clave qazQ18Ag
$db = mysql_select_db ("izo_metrics_bcp_pe",$cn) or die ("ERROR AL CONECTAR A LA BD");

        // Llenamos el arreglo con los datos  del archivo xlsx
$numrow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
for ($i=1;$i<=$numrow;$i++){

  $_DATOS_EXCEL[$i]['cedula'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['tipo_persona']= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['apellido1']= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['apellido2']= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['nombre']= $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['sexo']= $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['estcivil']= $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['segmento_cliente']= $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['cod_sub_segmento_cliente']= $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['sub_segmento_cliente']= $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['celular'] = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['cod_agencia'] = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
  $_DATOS_EXCEL[$i]['agencia'] = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();

  // echo "<pre>";
  //
  // //FROM_UNIXTIME(your_bigint_value)
  // var_dump($_DATOS_EXCEL[$i]['fecha_encuesta']);
  // echo "</pre>";

$numeros[$i] = $_DATOS_EXCEL[$i];


}
foreach($_DATOS_EXCEL as $campo => $valor){
  

                 
                  $sql = "UPDATE sys_clientes SET 
                  tipo_persona = '".$valor["tipo_persona"]."',
                  apellido1 =  '".$valor["apellido1"]."',
                  apellido2 =  '".$valor["apellido2"]."',
                  sexo =  '".$valor["sexo"]."',
                  estcivil =  '".$valor["estcivil"]."',
                  segmento_cliente =  '".$valor["segmento_cliente"]."',
                  cod_sub_segmento_cliente =  '".$valor["cod_sub_segmento_cliente"]."',
                  sub_segmento_cliente =  '".$valor["sub_segmento_cliente"]."',
                  cod_agencia =  '".$valor["cod_agencia"]."',
                  agencia =  '".$valor["agencia"]."',
                  fecha_envia = '2016-05-02'
                  WHERE celular = '".$valor["celular"]."' ";

  
  $result = mysql_query($sql);
  if (!$result){ echo "Error al insertar registro ".$campo;$errores+=1;}









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
