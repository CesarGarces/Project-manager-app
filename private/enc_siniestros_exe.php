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

$id_izo = $_GET['id_izo'];
$siniestro = $_GET['siniestro'];

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
    <!-- iCheck -->
    <link href="../lib/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="../lib/css/plugins/iCheck/custom.css" rel="stylesheet">

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

                    <h2>Encuestas</h2>

                    <ol class="breadcrumb">

                        <li>

                            <a href="panel.php">Inicio</a>

                        </li>

                        

                        <li class="active">

                            <strong>Encuestas</strong>

                        </li>

                    </ol>

                </div>

            

    <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="ibox">  
            <?php if($siniestro=="Siniestro Inicial"){ ?>         
                    <form name="form1" method="post" action ="enc_siniestro_execute.php">
                                      <div class="col-lg-12">

                                        <div class="ibox-content text-left">
                                                <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                           
                                                        <label label-default="" class="control-label"><h2><b>Encuesta <?php echo $siniestro; ?></h2></b></label>
                                                        <input type="hidden"name="siniestro" value="<?php echo $siniestro; ?>">
                                                        <input type="hidden"name="id_izo" value="<?php echo $id_izo; ?>">
                                                        <input type="hidden"name="encuestador" value="<?php echo $_SESSION['user']; ?>">
                                                </div>
                                              </div> 

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                           
                                                        <label label-default="" class="control-label">
                                                            <p>Sr./Sra. muy buenas tardes, mi nombre es…. (Nombre de Encuestador) de SEGUROS EQUINOCCIAL. Con la finalidad de brindarle un mejor servicio.</p>
                                                            <p>Por favor califique los siguientes aspectos, en función de su experiencia con Seguros Equinoccial en el proceso inicial de su siniestro.</p>
                                                        </label>
                                                    
                                        
                                                </div>
                                              </div>  

                                            <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                        <p>En las preguntas que se encuentran a continuación, por favor indique SI o NO según haya sido su caso:</p>                                         
                                                        <label label-default="" class="control-label">El asesor le dio la bienvenida y salió a recibirlo?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc1" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc1" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc1" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">El asesor le escuchó y le brindó toda su atención?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc2" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc2" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc2" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">El asesor le informó los pasos a seguir?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc3" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc3" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc3" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">El asesor le explicó a que talleres puede llevar su vehículo? (pregunta aplica sólo a base de vehículos)</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc4" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc4" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc4" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">El asesor se despidió amablemente?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc5" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc5" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc5" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                <p>Sr. Para terminar, le voy a pedir que por favor califique del 1 al 10 los siguientes aspectos, siendo 0 que no está satisfecho y 10 que esta totalmente satisfecho</p>
                                                <p>Que tan satisfecho está usted con:</p>                                                                                         
                                                        <label label-default="" class="control-label">La agilidad de la atención recibida</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc6" value="0" required> 0
                                                          <input type="radio" name="enc6" value="1"> 1 
                                                          <input type="radio" name="enc6" value="2"> 2
                                                          <input type="radio" name="enc6" value="3"> 3
                                                          <input type="radio" name="enc6" value="4"> 4
                                                          <input type="radio" name="enc6" value="5"> 5
                                                          <input type="radio" name="enc6" value="6"> 6
                                                          <input type="radio" name="enc6" value="7"> 7
                                                          <input type="radio" name="enc6" value="8"> 8
                                                          <input type="radio" name="enc6" value="9"> 9
                                                          <input type="radio" name="enc6" value="10"> 10
                                                          <input type="radio" name="enc6" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">La amabilidad de la atención que recibió</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc7" value="0" required> 0
                                                          <input type="radio" name="enc7" value="1"> 1 
                                                          <input type="radio" name="enc7" value="2"> 2
                                                          <input type="radio" name="enc7" value="3"> 3
                                                          <input type="radio" name="enc7" value="4"> 4
                                                          <input type="radio" name="enc7" value="5"> 5
                                                          <input type="radio" name="enc7" value="6"> 6
                                                          <input type="radio" name="enc7" value="7"> 7
                                                          <input type="radio" name="enc7" value="8"> 8
                                                          <input type="radio" name="enc7" value="9"> 9
                                                          <input type="radio" name="enc7" value="10"> 10
                                                          <input type="radio" name="enc7" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">La asesoría brindada por parte del ejecutivo</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc8" value="0" required> 0
                                                          <input type="radio" name="enc8" value="1"> 1 
                                                          <input type="radio" name="enc8" value="2"> 2
                                                          <input type="radio" name="enc8" value="3"> 3
                                                          <input type="radio" name="enc8" value="4"> 4
                                                          <input type="radio" name="enc8" value="5"> 5
                                                          <input type="radio" name="enc8" value="6"> 6
                                                          <input type="radio" name="enc8" value="7"> 7
                                                          <input type="radio" name="enc8" value="8"> 8
                                                          <input type="radio" name="enc8" value="9"> 9
                                                          <input type="radio" name="enc8" value="10"> 10
                                                          <input type="radio" name="enc8" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">El cumplimiento por parte de Seguros Equinoccial</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc9" value="0" required> 0
                                                          <input type="radio" name="enc9" value="1"> 1 
                                                          <input type="radio" name="enc9" value="2"> 2
                                                          <input type="radio" name="enc9" value="3"> 3
                                                          <input type="radio" name="enc9" value="4"> 4
                                                          <input type="radio" name="enc9" value="5"> 5
                                                          <input type="radio" name="enc9" value="6"> 6
                                                          <input type="radio" name="enc9" value="7"> 7
                                                          <input type="radio" name="enc9" value="8"> 8
                                                          <input type="radio" name="enc9" value="9"> 9
                                                          <input type="radio" name="enc9" value="10"> 10
                                                          <input type="radio" name="enc9" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">La claridad de los pasos a seguir para el proceso de reclamo</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc10" value="0" required> 0
                                                          <input type="radio" name="enc10" value="1"> 1 
                                                          <input type="radio" name="enc10" value="2"> 2
                                                          <input type="radio" name="enc10" value="3"> 3
                                                          <input type="radio" name="enc10" value="4"> 4
                                                          <input type="radio" name="enc10" value="5"> 5
                                                          <input type="radio" name="enc10" value="6"> 6
                                                          <input type="radio" name="enc10" value="7"> 7
                                                          <input type="radio" name="enc10" value="8"> 8
                                                          <input type="radio" name="enc10" value="9"> 9
                                                          <input type="radio" name="enc10" value="10"> 10
                                                          <input type="radio" name="enc10" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">Confirmar si utilizó el servicio de Asistencia Equinoccial (víal / legal)</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc11" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc11" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc11" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">El servicio de asistencia en el momento del incidente con su vehículo</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc12" value="0" required> 0
                                                          <input type="radio" name="enc12" value="1"> 1 
                                                          <input type="radio" name="enc12" value="2"> 2
                                                          <input type="radio" name="enc12" value="3"> 3
                                                          <input type="radio" name="enc12" value="4"> 4
                                                          <input type="radio" name="enc12" value="5"> 5
                                                          <input type="radio" name="enc12" value="6"> 6
                                                          <input type="radio" name="enc12" value="7"> 7
                                                          <input type="radio" name="enc12" value="8"> 8
                                                          <input type="radio" name="enc12" value="9"> 9
                                                          <input type="radio" name="enc12" value="10"> 10
                                                          <input type="radio" name="enc12" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">El cumplimiento en cuanto al tiempo ofrecido del servicio de asistencia</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc13" value="0" required> 0
                                                          <input type="radio" name="enc13" value="1"> 1 
                                                          <input type="radio" name="enc13" value="2"> 2
                                                          <input type="radio" name="enc13" value="3"> 3
                                                          <input type="radio" name="enc13" value="4"> 4
                                                          <input type="radio" name="enc13" value="5"> 5
                                                          <input type="radio" name="enc13" value="6"> 6
                                                          <input type="radio" name="enc13" value="7"> 7
                                                          <input type="radio" name="enc13" value="8"> 8
                                                          <input type="radio" name="enc13" value="9"> 9
                                                          <input type="radio" name="enc13" value="10"> 10
                                                          <input type="radio" name="enc13" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">El servicio brindado en el manejo inicial de su siniestro</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc14" value="0" required> 0
                                                          <input type="radio" name="enc14" value="1"> 1 
                                                          <input type="radio" name="enc14" value="2"> 2
                                                          <input type="radio" name="enc14" value="3"> 3
                                                          <input type="radio" name="enc14" value="4"> 4
                                                          <input type="radio" name="enc14" value="5"> 5
                                                          <input type="radio" name="enc14" value="6"> 6
                                                          <input type="radio" name="enc14" value="7"> 7
                                                          <input type="radio" name="enc14" value="8"> 8
                                                          <input type="radio" name="enc14" value="9"> 9
                                                          <input type="radio" name="enc14" value="10"> 10
                                                          <input type="radio" name="enc14" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">Basado en su experiencia, en qué medida estaría dispuesto usted en recomendar a Seguros Equinoccial a amigos y familiares</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc15" value="0" required> 0
                                                          <input type="radio" name="enc15" value="1"> 1 
                                                          <input type="radio" name="enc15" value="2"> 2
                                                          <input type="radio" name="enc15" value="3"> 3
                                                          <input type="radio" name="enc15" value="4"> 4
                                                          <input type="radio" name="enc15" value="5"> 5
                                                          <input type="radio" name="enc15" value="6"> 6
                                                          <input type="radio" name="enc15" value="7"> 7
                                                          <input type="radio" name="enc15" value="8"> 8
                                                          <input type="radio" name="enc15" value="9"> 9
                                                          <input type="radio" name="enc15" value="10"> 10
                                                          <input type="radio" name="enc15" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">¿Por qué razón da esa calificación de recomendación?</label>
                                                        <input type="text" class="form-control"  name="enc15_1" value="" required>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">Muchas gracias por sus comentarios, es todo en cuanto a la encuesta. Le recordamos que para cualquier información adicional que usted requiera puede comunicarse a la línea gratuita 1800 equinoccial (1800 378466) o ingresar a la página web Triple w segurosequinoccial.com </label>
 
                                                </div>
                                              </div>
                                               
                                                
                                                <input type="submit" class="btn btn-primary btn-rounded btn-block" onclick="this.form.action = 'enc_siniestro_execute.php'" value="Enviar">


                                                </div>                              
                                        </form>


                                        <?php } ////////////////////////////////Siniestro Final//////////////////////////////////////////////////////////////////////////?>
                                        <?php if($siniestro=="Siniestro Final"){ ?>


                                        <form name="form1" method="post" action ="enc_siniestro_execute.php">
                                      <div class="col-lg-12">

                                        <div class="ibox-content text-left">
                                                <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                           
                                                        <label label-default="" class="control-label"><h2><b>Encuesta <?php echo $siniestro; ?></h2></b></label>
                                                        <input type="hidden"name="siniestro" value="<?php echo $siniestro; ?>">
                                                        <input type="hidden"name="id_izo" value="<?php echo $id_izo; ?>">
                                                        <input type="hidden"name="encuestador" value="<?php echo $_SESSION['user']; ?>">
                                                </div>
                                              </div> 

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                           
                                                        <label label-default="" class="control-label">
                                                            <p>Sr./Sra. muy buenas tardes, mi nombre es…. (Nombre de Encuestador) de SEGUROS EQUINOCCIAL. Con la finalidad de brindarle un mejor servicio.</p>
                                                            <p>Por favor califique los siguientes aspectos, en función de su experiencia con Seguros Equinoccial en el proceso inicial de su siniestro.</p>
                                                        </label>
                                                    
                                        
                                                </div>
                                              </div>  

                                            <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                        <p>En las preguntas que se encuentran a continuación, por favor indique SI o NO según haya sido su caso:</p>                                         
                                                        <label label-default="" class="control-label">El asesor le dio la bienvenida amablemente?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc1" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc1" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc1" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">Le escucharon activamente y presetandole atención?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc2" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc2" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc2" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">El asesor le informó los pasos a seguir?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc3" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc3" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc3" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">Le asesoraron correctamente?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc4" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc4" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc4" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">El asesor se despidió amablemente?</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc5" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc5" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc5" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                <p>Sr. Para terminar, le voy a pedir que por favor califique del 1 al 10 los siguientes aspectos, siendo 0 que no está satisfecho y 10 que esta totalmente satisfecho</p>
                                                <p>Que tan satisfecho está usted con:</p>                                                                                         
                                                        <label label-default="" class="control-label">La información recibida sobre el estado de su siniestro</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc6" value="0" required> 0
                                                          <input type="radio" name="enc6" value="1"> 1 
                                                          <input type="radio" name="enc6" value="2"> 2
                                                          <input type="radio" name="enc6" value="3"> 3
                                                          <input type="radio" name="enc6" value="4"> 4
                                                          <input type="radio" name="enc6" value="5"> 5
                                                          <input type="radio" name="enc6" value="6"> 6
                                                          <input type="radio" name="enc6" value="7"> 7
                                                          <input type="radio" name="enc6" value="8"> 8
                                                          <input type="radio" name="enc6" value="9"> 9
                                                          <input type="radio" name="enc6" value="10"> 10
                                                          <input type="radio" name="enc6" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">La claridad sobre los costos en los que debe incurrir</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc7" value="0" required> 0
                                                          <input type="radio" name="enc7" value="1"> 1 
                                                          <input type="radio" name="enc7" value="2"> 2
                                                          <input type="radio" name="enc7" value="3"> 3
                                                          <input type="radio" name="enc7" value="4"> 4
                                                          <input type="radio" name="enc7" value="5"> 5
                                                          <input type="radio" name="enc7" value="6"> 6
                                                          <input type="radio" name="enc7" value="7"> 7
                                                          <input type="radio" name="enc7" value="8"> 8
                                                          <input type="radio" name="enc7" value="9"> 9
                                                          <input type="radio" name="enc7" value="10"> 10
                                                          <input type="radio" name="enc7" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">La amabilidad de la atención que recibió</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc8" value="0" required> 0
                                                          <input type="radio" name="enc8" value="1"> 1 
                                                          <input type="radio" name="enc8" value="2"> 2
                                                          <input type="radio" name="enc8" value="3"> 3
                                                          <input type="radio" name="enc8" value="4"> 4
                                                          <input type="radio" name="enc8" value="5"> 5
                                                          <input type="radio" name="enc8" value="6"> 6
                                                          <input type="radio" name="enc8" value="7"> 7
                                                          <input type="radio" name="enc8" value="8"> 8
                                                          <input type="radio" name="enc8" value="9"> 9
                                                          <input type="radio" name="enc8" value="10"> 10
                                                          <input type="radio" name="enc8" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">La asesoría brindada por parte del ejecutivo</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc9" value="0" required> 0
                                                          <input type="radio" name="enc9" value="1"> 1 
                                                          <input type="radio" name="enc9" value="2"> 2
                                                          <input type="radio" name="enc9" value="3"> 3
                                                          <input type="radio" name="enc9" value="4"> 4
                                                          <input type="radio" name="enc9" value="5"> 5
                                                          <input type="radio" name="enc9" value="6"> 6
                                                          <input type="radio" name="enc9" value="7"> 7
                                                          <input type="radio" name="enc9" value="8"> 8
                                                          <input type="radio" name="enc9" value="9"> 9
                                                          <input type="radio" name="enc9" value="10"> 10
                                                          <input type="radio" name="enc9" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">El cumplimiento por parte de Seguros Equinoccial</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc10" value="0" required> 0
                                                          <input type="radio" name="enc10" value="1"> 1 
                                                          <input type="radio" name="enc10" value="2"> 2
                                                          <input type="radio" name="enc10" value="3"> 3
                                                          <input type="radio" name="enc10" value="4"> 4
                                                          <input type="radio" name="enc10" value="5"> 5
                                                          <input type="radio" name="enc10" value="6"> 6
                                                          <input type="radio" name="enc10" value="7"> 7
                                                          <input type="radio" name="enc10" value="8"> 8
                                                          <input type="radio" name="enc10" value="9"> 9
                                                          <input type="radio" name="enc10" value="10"> 10
                                                          <input type="radio" name="enc10" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">Confirmar si utilizó el servicio de algún taller</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc11" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc11" value="No"> <i></i> No </label></div>  
                                                          <div class="i-checks"><label> <input type="radio" name="enc11" value="NA"> <i></i> N/A </label></div>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">El servicio que el taller le brindó</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc12" value="0" required> 0
                                                          <input type="radio" name="enc12" value="1"> 1 
                                                          <input type="radio" name="enc12" value="2"> 2
                                                          <input type="radio" name="enc12" value="3"> 3
                                                          <input type="radio" name="enc12" value="4"> 4
                                                          <input type="radio" name="enc12" value="5"> 5
                                                          <input type="radio" name="enc12" value="6"> 6
                                                          <input type="radio" name="enc12" value="7"> 7
                                                          <input type="radio" name="enc12" value="8"> 8
                                                          <input type="radio" name="enc12" value="9"> 9
                                                          <input type="radio" name="enc12" value="10"> 10
                                                          <input type="radio" name="enc12" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">El cumplimiento en cuanto al tiempo ofrecido por parte del taller</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc13" value="0" required> 0
                                                          <input type="radio" name="enc13" value="1"> 1 
                                                          <input type="radio" name="enc13" value="2"> 2
                                                          <input type="radio" name="enc13" value="3"> 3
                                                          <input type="radio" name="enc13" value="4"> 4
                                                          <input type="radio" name="enc13" value="5"> 5
                                                          <input type="radio" name="enc13" value="6"> 6
                                                          <input type="radio" name="enc13" value="7"> 7
                                                          <input type="radio" name="enc13" value="8"> 8
                                                          <input type="radio" name="enc13" value="9"> 9
                                                          <input type="radio" name="enc13" value="10"> 10
                                                          <input type="radio" name="enc13" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">Satisfacción general con la solución de su siniestro</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc14" value="0" required> 0
                                                          <input type="radio" name="enc14" value="1"> 1 
                                                          <input type="radio" name="enc14" value="2"> 2
                                                          <input type="radio" name="enc14" value="3"> 3
                                                          <input type="radio" name="enc14" value="4"> 4
                                                          <input type="radio" name="enc14" value="5"> 5
                                                          <input type="radio" name="enc14" value="6"> 6
                                                          <input type="radio" name="enc14" value="7"> 7
                                                          <input type="radio" name="enc14" value="8"> 8
                                                          <input type="radio" name="enc14" value="9"> 9
                                                          <input type="radio" name="enc14" value="10"> 10
                                                          <input type="radio" name="enc14" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">Basado en su experiencia, en qué medida estaría dispuesto usted en recomendar a Seguros Equinoccial a amigos y familiares</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks">
                                                          <input type="radio" name="enc15" value="0" required> 0
                                                          <input type="radio" name="enc15" value="1"> 1 
                                                          <input type="radio" name="enc15" value="2"> 2
                                                          <input type="radio" name="enc15" value="3"> 3
                                                          <input type="radio" name="enc15" value="4"> 4
                                                          <input type="radio" name="enc15" value="5"> 5
                                                          <input type="radio" name="enc15" value="6"> 6
                                                          <input type="radio" name="enc15" value="7"> 7
                                                          <input type="radio" name="enc15" value="8"> 8
                                                          <input type="radio" name="enc15" value="9"> 9
                                                          <input type="radio" name="enc15" value="10"> 10
                                                          <input type="radio" name="enc15" value="NA"> N/A
                                                          </div>

                                                       </div>
                                                   
                                                </div>
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">¿Por qué razón da esa calificación de recomendación?</label>
                                                        <input type="text" class="form-control"  name="enc15_1" value="" required>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">    
                                                                                                                                       
                                                        <label label-default="" class="control-label">Muchas gracias por sus comentarios, es todo en cuanto a la encuesta. Le recordamos que para cualquier información adicional que usted requiera puede comunicarse a la línea gratuita 1800 equinoccial (1800 378466) o ingresar a la página web Triple w segurosequinoccial.com </label>
 
                                                </div>
                                              </div>
                                               
                                                
                                                <input type="submit" class="btn btn-primary btn-rounded btn-block" onclick="this.form.action = 'enc_siniestro_execute.php'" value="Enviar">


                                                </div>                              
                                        </form>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>  
                    </div>  
                </div> 

                   

    <!-- Mainly scripts -->
    <script src="../lib/js/jquery-2.1.1.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="../lib/js/inspinia.js"></script>
    <script src="../lib/js/plugins/pace/pace.min.js"></script>

    <script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../lib/js/plugins/flot/jquery.flot.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="../lib/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../lib/js/demo/peity-demo.js"></script>

   <!-- Data picker -->
   <script src="../lib/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="../lib/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="../lib/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- GITTER -->
    <script src="../lib/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="../lib/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../lib/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="../lib/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="../lib/js/plugins/toastr/toastr.min.js"></script>

    <!-- d3 and c3 charts -->
    <script src="../lib/js/plugins/d3/d3.min.js"></script>
    <script src="../lib/js/plugins/c3/c3.min.js"></script>
    <script src="../lib/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
    <script>
function tipifica(sel) {
      if (sel.value=="Si tipifica"){
           
           
           titulo_tipificacion_div.style.display = "block";

      }else{

            titulo_tipificacion_div.style.display = "none";
      }
}
function recu_espera(sel) {
      if (sel.value=="No"){
           
           
           recurso_espera_check_div.style.display = "block";

      }else{

            recurso_espera_check_div.style.display = "none";
      }
}
function pac_cordialidad(sel) {
      if (sel.value=="No"){
           
           
           paciencia_cordialidad_check_div.style.display = "block";

      }else{

            paciencia_cordialidad_check_div.style.display = "none";
      }
}
function simplici(sel) {
      if (sel.value=="No"){
           
           
           simplicidad_check_div.style.display = "block";

      }else{

            simplicidad_check_div.style.display = "none";
      }
}
function conf(sel) {
      if (sel.value=="No"){
           
           
           confianza_check_div.style.display = "block";

      }else{

            confianza_check_div.style.display = "none";
      }
}
function solucion_ap(sel) {
      if (sel.value=="No"){
           
           
           brinda_solucion_apropiada_check_div.style.display = "block";

      }else{

            brinda_solucion_apropiada_check_div.style.display = "none";
      }
}
function abandono_llam(sel) {
      if (sel.value=="No"){
           
           
           abandono_llamada_check_div.style.display = "block";

      }else{

            abandono_llamada_check_div.style.display = "none";
      }
}
function tipifica_ap(sel) {
      if (sel.value=="No"){
           
           
           tipifica_aplicativos_consulta_check_div.style.display = "block";

      }else{

            tipifica_aplicativos_consulta_check_div.style.display = "none";
      }
}
function ivr(sel) {
      if (sel.value=="No"){
           
           
           derivacion_IVR_check_div.style.display = "block";

      }else{

            derivacion_IVR_check_div.style.display = "none";
      }
}
function pol_seguridad(sel) {
      if (sel.value=="No"){
           
           
           politicas_seguridad_check_div.style.display = "block";

      }else{

            politicas_seguridad_check_div.style.display = "none";
      }
}
function Prot_atencion(sel) {
      if (sel.value=="No"){
           
           
           Protocolos_atencion_check_div.style.display = "block";

      }else{

            Protocolos_atencion_check_div.style.display = "none";
      }
}
function ident_inter(sel) {
      if (sel.value=="No"){
           
           
           identificacion_inter_check_div.style.display = "block";

      }else{

            identificacion_inter_check_div.style.display = "none";
      }
}
function brinda_solu(sel) {
      if (sel.value=="No"){
           
           
           brinda_solucion_check_div.style.display = "block";
           moti_no_fcr_div.style.display = "block";
           detalle_no_fcr_div.style.display = "block";

      }else{

            brinda_solucion_check_div.style.display = "none";
            moti_no_fcr_div.style.display = "none";
           detalle_no_fcr_div.style.display = "none";
      }
}
    </script>

</body>

</html>
