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
                    <h2>Carga de Archivo Cliente Interno</h2>
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


<?php
 require_once('../lib/phpmailer/PHPMailerAutoload.php');


 $cn = mysql_connect ("localhost","root","IZ0.r1c0pap1r1c0") or die ("ERROR EN LA CONEXION");
 $db = mysql_select_db ("izometrics_izo_co",$cn) or die ("ERROR AL CONECTAR A LA BD");
$encuesta_area = "";
$encuesta_servicio = "";
$encuesta_linea = "";
$link = "";
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
//  $i=1;
// while($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue() !=''){
// $i++; 
$i=1;
while($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue() !=''){
$i++;
  
  $_DATOS_EXCEL[$i]['id_izo']= $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();



$numeros[$i] = $_DATOS_EXCEL[$i];

}
foreach($_DATOS_EXCEL as $campo => $valor){ 
    $id_izo = $valor['id_izo'];



    //$link = "http://izoboard.net:88/izo/encuestas/evaluacion_cem.php?id_izo=".$id_izo." ";


$clientesql = mysql_query("SELECT nombre, email, url FROM envio_certificado WHERE id_izo =  '".$id_izo."' ");




while($datCliente =mysql_fetch_array($clientesql)){

     $nombres = $datCliente['nombre'];
	 $email = $datCliente['email'];
     $link = $datCliente['url'];



	
$mail = new PHPMailer;
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 465
$mail->IsHTML(true);
$mail->Username = "izoboard.mail@gmail.com";
$mail->Password = "izoboard123*";
$mail->SetFrom('izoboard.mail@gmail.com', 'IZO - Certificación CEM');
$mail->CharSet = 'UTF-8';
$mail->AddReplyTo('izoboard.mail@gmail.com', 'IZO - Certificación CEM');
$mail->Subject = "Programa de Certificación IZO en Customer Experience Management";

$mail->AddAddress($email);

$mail->Body = ('
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="css/custom.css" rel="stylesheet">
    <link href="http://izoboard.net:88/izo/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <title>Certificación CEM Bogotá 2017</title>
    
	<style>
  .myClass{ font-family: Carta; }
</style>

</head>

<body>

<table style="background-color: #f6f6f6; width: 100%;">
    <tr>
        <td></td>
        <td style="display: block !important; max-width: 600px !important; margin: 0 auto !important; /* makes it centered */ clear: both !important;" width="600">
            <div style="max-width: 600px; margin: 0 auto; display: block; padding: 20px;">
                <table style="background: #fff; border: 1px solid #e9e9e9; border-radius: 3px;" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding: 20px;">
                            <table align="center" cellpadding="0" cellspacing="0">
                             <tr>
                               <table width="100%" align="center">
                                <tr align="center">
                                    <td align="left">
                                        <img  src="http://izoboard.net:88/izo/lib/img/portada.png"/> 
                                                                            
                                    </td>

                                </tr>
                                </table>
                                   
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 20px;">
									<br>
										<font style="font-family: Sans-Serif;">
                                        <h3><b>
                                        Estimado/a '.$nombres.', 
                                        </b></h3>
                                        <p>
                                        Para nosotros es un gusto saludarle, y estamos seguros de que esta informaci&oacute;n es de su inter&eacute;s. </p>
                                        <p style="font-size:1.5em">
                                        <b>
                                        Programa de Certificación IZO en Customer Experience Management
                                        </b>
                                        <br>
                                        </p>
                                        <p style="font-size:1.3em">
                                        Para dirigir y gestionar la Experiencia de Cliente
                                        </p>
                                        
                                        <p>
                                        <img src="http://izoboard.net:88/izo/lib/img/like.png"> Consiga diferenciación y añada valor en cada interacci&oacute;n de sus clientes con la compañ&iacute;a.
                                        <br>
                                        <img src="http://izoboard.net:88/izo/lib/img/like.png"> Innove en la Experiencia de Cliente para generar momentos &uacute;nicos y memorables que impacten en la vinculaci&oacute;n, fidelizaci&oacute;n y recomendaci&oacute;n de sus clientes.
                                        <br>
                                        <img src="http://izoboard.net:88/izo/lib/img/like.png"> Conozca los Economics de la Experiencia de Cliente y c&oacute;mo impactan en los resultados de negocio
                                        <br>
										<img src="http://izoboard.net:88/izo/lib/img/like.png"> Herramientas para gestionar la experiencia: Customer Journey, Blue Print, Metricas, etc
                                        </p>
                                        
                                        <p style="font-size:1.4em">
                                        <b>
                                        Fechas:
                                        <br/>
                                        Bogot&aacute;. Febrero 8, 9 y 10 de 2017. 
                                        </b>
                                        </p>
                                        <p>
                                        Inversi&oacute;n: 
                                        <br>
                                        <img src="http://izoboard.net:88/izo/lib/img/check.png"> Precio Certificación CEM (oficial): 2.900 USD
                                        <br>
                                        <img src="http://izoboard.net:88/izo/lib/img/check.png"> No incluye IVA. 
                                        <br>
                                        <img src="http://izoboard.net:88/izo/lib/img/check.png"> Para participantes fuera de la ciudad de Bogot&aacute; no incluye gastos de viaje ni alojamiento.

                                        </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    
                                        <font style="font-family: Sans-Serif;">
                                        <h3>Recuerda:   </h3>
                                        <p>
                                        <b>1.</b> Los cupos son limitados. No te quedes por fuera.
                                        <br>
                                        <b>2.</b> Adjuntamos el programa de la certificaci&oacute;n en este correo.
                                        </p>
                                        </font>
                                        <br>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="padding: 0 0 20px; align:"center"; background-color:"1A5276";">
                                        <a href="'.$link.'" style="text-decoration: none; color: #FFF; background-color: #1A5276; border: solid #1A5276; border-width: 5px 10px; line-height: 2; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize;">Descargar Programa</a>
                                        <font style="font-family: carta;">
                                            <p> Gracias por elegirnos.</p>
                                            <br>
                                            <img src="http://izoboard.net:88/izo/lib/img/logo-izo.png"/>
                                            <p style="font-size:0.9em;">Cualquier inquietud adicional e Inscripciones por favor comunicarse con
                                            <p style="font-size:0.9em;">Juan Carlos Mej&iacute;a - <font color="blue">juan.mejia@izo.com.co</font> - Juli&aacute;n Cabarcas - <font color="blue">julian.cabarcas@izo.com.co</font> - Juan David Carrillo <font color="blue">juan.carrillo@izo.es</font> </p>
                                        </font>
                                    </td>
                                </tr>
                              </table>
                        </td>
                    </tr>
                </table>
                <div style="width: 100%; clear: both; color: #999; padding: 20px;">
                    <table width="100%">
                        <tr align="center">
                            
                        </tr>
                    </table>
                </div></div>
        </td>
        <td></td>
    </tr>
</table>

</body>
</html>
 ');

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
}
}
}
 sleep(2);
}
 
 
 ?>