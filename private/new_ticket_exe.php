<?php
$link = mysql_connect('localhost', 'root', 'IZ0.r1c0pap1r1c0')
or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('izoboard_izo') or die('No se pudo seleccionar la base de datos');

$ruta="../archivos";
$archivo=$_FILES['doc']['tmp_name'];
$nombreArchivo=$_FILES['doc']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;

$id_usuario_crea = $_POST['id_usuario_crea'];
$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$detalle = $_POST['detalle'];
$urgencia = $_POST['urgencia'];
$area = $_POST['area'];
$query = "INSERT INTO sys_tickets (`id_ticket`,`nombre_genera`,`id_usu_genera`, `empresa_genera`, `detalles`, `documento`, `area`, `estado`, `urgencia`, `fecha_creacion`) VALUES (NULL, '".$_POST['nombre']."','".$_POST['id_usuario_crea']."', '".$_POST['empresa']."', '".$_POST['detalle']."','".$ruta."', '".$_POST['area']."', 'Activo', '".$_POST['urgencia']."', now());
";

$result = mysql_query($query);

$ultimo_ticket = mysql_query("SELECT id_ticket FROM sys_tickets order by id_ticket DESC ");
$ultimo_ticket_fet = mysql_fetch_row($ultimo_ticket);


$link = 'http://izoboard.net:88/izoboard/private/resp_ticket.php?id_ticket='.$ultimo_ticket_fet[0].' ';

 require_once('../lib/phpmailer/PHPMailerAutoload.php');



	
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
$mail->SetFrom('izoboard.mail@gmail.com', 'IZO - Tickets');
$mail->CharSet = 'UTF-8';
$mail->AddReplyTo('izoboard.mail@gmail.com', 'IZO - Tickets');
$mail->Subject = "Nuevo ticket de ".$nombre." Con Urgencia ".$urgencia;

$mail->AddAddress("cesar.garces@izo.com.co");

$mail->Body = ('
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="css/custom.css" rel="stylesheet">
    <link href="http://izoboard.net:88/izo/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <title></title>
    
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
                                        Estimado/a, 
                                        </b></h3>
                                        <p>
                                        '.$nombre.' ha creado un tiquet de la empresa '.$empresa.' con lo siguiente. </p>
                                        <p style="font-size:1.5em">
                                        <b>
                                        '.$detalle.'
                                        </b>
                                        <br>
                                        </p>

                                        <p style="font-size:1.3em">
                                        <img src="http://izoboard.net:88/izo/lib/img/like.png"> Recuerde responder antes de 24 Horas si la urgencia es alta.
                                        <img src="http://izoboard.net:88/izo/lib/img/like.png"> Recuerde responder antes de 48 Horas si la urgencia es media.
                                        <img src="http://izoboard.net:88/izo/lib/img/like.png"> Recuerde responder antes de 72 Horas si la urgencia es baja.
                                        </p>
                                      
                                        
                                        </p>
                                        
                                </tr>
                                <tr align="center">
                                    <td style="padding: 0 0 20px; align:"center"; background-color:"1A5276";">
                                        <a href="'.$link.'" style="text-decoration: none; color: #FFF; background-color: #1A5276; border: solid #1A5276; border-width: 5px 10px; line-height: 2; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize;">Responder</a>
                                        <font style="font-family: carta;">
                                            <p> Gracias por elegirnos.</p>
                                            <br>
                                            <img src="http://izoboard.net:88/izo/lib/img/logo-izo.png"/>
                                            <p style="font-size:0.9em;">Cualquier inquietud adicional por favor comunicarse con
                                            <p style="font-size:0.9em;">Cesar Garces - <font color="blue">cesar.garces@izo.com.co</font> - Alejandro Fernandez - <font color="blue">alejandro.fernandez@izo.com.co</font></p>
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

/***************email consultoria**************/

$mail2 = new PHPMailer;
$mail2->IsSMTP(); // enable SMTP
$mail2->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail2->SMTPAuth = true; // authentication enabled
$mail2->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail2->Host = "smtp.gmail.com";
$mail2->Port = 587; // or 465
$mail2->IsHTML(true);
$mail2->Username = "izoboard.mail@gmail.com";
$mail2->Password = "izoboard123*";
$mail2->SetFrom('izoboard.mail@gmail.com', 'IZO - Tickets');
$mail2->CharSet = 'UTF-8';
$mail2->AddReplyTo('izoboard.mail@gmail.com', 'IZO - Tickets');
$mail2->Subject = "Nuevo ticket de ".$nombre." Con Urgencia ".$urgencia;

$mail2->AddAddress("alejandro.fernandez@izo.com.co");

$mail2->Body = ('
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="css/custom.css" rel="stylesheet">
    <link href="http://izoboard.net:88/izo/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <title></title>
    
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
                                        Estimado/a, 
                                        </b></h3>
                                        <p>
                                        '.$nombre.' ha creado un tiquet de la empresa '.$empresa.' con lo siguiente. </p>
                                        <p style="font-size:1.5em">
                                        <b>
                                        '.$detalle.'
                                        </b>
                                        <br>
                                        </p>

                                        <p style="font-size:1.3em">
                                        <img src="http://izoboard.net:88/izo/lib/img/like.png"> Recuerde responder antes de 24 Horas.
                                        </p>
                                      
                                        
                                        </p>
                                        
                                </tr>
                                <tr align="center">
                                    <td style="padding: 0 0 20px; align:"center"; background-color:"1A5276";">
                                        <a href="'.$link.'" style="text-decoration: none; color: #FFF; background-color: #1A5276; border: solid #1A5276; border-width: 5px 10px; line-height: 2; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize;">Responder</a>
                                        <font style="font-family: carta;">
                                            <p> Gracias por elegirnos.</p>
                                            <br>
                                            <img src="http://izoboard.net:88/izo/lib/img/logo-izo.png"/>
                                            <p style="font-size:0.9em;">Cualquier inquietud adicional por favor comunicarse con
                                            <p style="font-size:0.9em;">Cesar Garces - <font color="blue">cesar.garces@izo.com.co</font> - Alejandro Fernandez - <font color="blue">alejandro.fernandez@izo.com.co</font></p>
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

 if(!$mail2->Send()) {
    echo "Mailer Error: " . $mail2->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
 
 
header('Location: ticket_list.php');

?>