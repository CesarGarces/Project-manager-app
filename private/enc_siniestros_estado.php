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
$idEnc=1;
$idIzo = $_POST['id_izo'];
$siniestro = $_POST['siniestro'];
$estadoClient = "";
if($idIzo != NULL){
      
      if($siniestro=="Siniestro Inicial"){
        
        $query = "SELECT * FROM base_siniestro_inicial where id_izo = '".$idIzo."' ";
        $result = mysql_query($query);
        $sqlClient=mysql_fetch_row($result);

      $idIzo =  $sqlClient[6]; 
      $docClient = $sqlClient[2];
      $nomClient = $sqlClient[3]; 
      $telClient = $sqlClient[4];      
      $estadoClient = $sqlClient[7];

    }
    if($siniestro=="Siniestro Final"){
      
        $query = "SELECT * FROM base_siniestro_final where id_izo = '".$idIzo."' ";
        $result = mysql_query($query);
        $sqlClient=mysql_fetch_row($result);

      $idIzo =  $sqlClient[7]; 
      $docClient = $sqlClient[2];
      $nomClient = $sqlClient[3]; 
      $telClient = $sqlClient[4];      
      $estadoClient = $sqlClient[8];
    }
      
}else{
    $nomClient = "";
    $apeClient = "";
    $idIzo = "";
    
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
    <!-- iCheck -->
    <link href="../lib/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="../lib/css/plugins/iCheck/custom.css" rel="stylesheet">
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

            </div>

    <div class="wrapper wrapper-content  animated fadeInRight">
<?php
if($estadoClient == "Encuesta Efectiva" ){
                                            echo "


                <div class='form-group'>                  
                    <h5>La encuesta Para $nomClient con Id IZO: $idIzo fue efectiva muchas gracias</5>
                </div>
                <a class='btn btn-primary' href='enc_siniestros.php'>Salir</a>
    </div>
</body>
</html>";

                                            exit(0);
                                        }
if($estadoClient == "Cliente Abandona" ){
                                            echo "


                <div class='form-group'>                  
                    <h5>La encuesta Para $nomClient con Id IZO: $idIzo fue Abandonada muchas gracias</5>
                </div>
                <a class='btn btn-primary' href='enc_siniestros.php'>Salir</a>
    </div>
</body>
</html>";

                                            exit(0);
                                        }
if($estadoClient == "Teléfono Errado" ){
                                            echo "


                <div class='form-group'>                  
                    <h5>La encuesta Para $nomClient con Id IZO: $idIzo fue Teléfono Errado muchas gracias</5>
                </div>
                <a class='btn btn-primary' href='enc_siniestros.php'>Salir</a>
    </div>
</body>
</html>";

                                            exit(0);
                                        }
if($estadoClient == "No Colabora" ){
                                            echo "


                <div class='form-group'>                  
                    <h5>La encuesta Para $nomClient con Id IZO: $idIzo fue No Colabora muchas gracias</5>
                </div>
                <a class='btn btn-primary' href='enc_siniestros.php'>Salir</a>
    </div>
</body>
</html>";

                                            exit(0);
                                        } 
if($estadoClient == "Fuera del Pais" ){
                                            echo "


                <div class='form-group'>                  
                    <h5>La encuesta Para $nomClient con Id IZO: $idIzo se encuentra fuera del país muchas gracias</5>
                </div>
                <a class='btn btn-primary' href='enc_siniestros.php'>Salir</a>
    </div>
</body>
</html>";

                                            exit(0);
                                        }  
if($estadoClient == "guardado" || $estadoClient == "encuestando" ){
                    switch($idEnc){
          
          case 1:
            header('Location: enc_siniestros_exe.php?id_izo='.$idIzo.'&siniestro='.$siniestro.'');
            break;

          
        }
                                        }                             
                                        else{
 if($estadoClient == "Activo" || $estadoClient == "encuestando"){
?>
             
                    <div class="ibox">            
                    <form role="form" method="post" >
                      <input type="hidden" name="id_izo" value="<?php echo $idIzo; ?>">
                      <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                      <input type="hidden" name="siniestro" value="<?php echo $siniestro; ?>">
                        <div class="col-sm-12">

                          <div class="panel panel-default">

                           <div class="panel-heading"><h3 class="panel-title">Datos Cliente con Documento: (<?php echo $docClient; ?>)</h3>

                           </div>

                             <div class="panel-body">

                                <fieldset>

                                  <div class="row">

                                   <div class="col-md-6">

                                     <div class="control-group">

                                        <label label-default="" class="control-label">Nombre</label>

                                          <div class="controls">
                                           

                                             <?php echo $nomClient;?>

                                          </div>

                                      </div>
                                      
                                    </div><!--col-->

                                      
                                      <div class="col-md-6">

                                        <div class="control-group">

                                        <label label-default="" class="control-label">Teléfono</label>

                                          <div class="controls">
                                           

                                             <?php echo $telClient;?>

                                          </div>

                                      </div>

                                      </div><!--col-->
                                     
                                      
                                  </div><!--row-->
                                  <div align="center" class="col-md-12">

                                        <div class="control-group"><br>

                                        <label label-default="" class="control-label">Contacto Efectivo?</label>

                                          <div class="controls">
                                           

                                              <label>
                                                  <div class="i-checks"><input type="radio" name="contacto" checked="checked" value ="si" id="contacto_si"> Si</div>
                                              </label> 
                                              &nbsp;                                                  
                                              <label>
                                                   <div class="i-checks"><input type="radio" name="contacto" checked="checked" value ="no" id="contacto_no"> No</div>
                                              </label>
                                              <input style="display: none;" type="radio" name="contacto"  checked="checked">

                                          </div>

                                      </div>

                                      </div><!--col-->
                                  
                                 </fieldset><!--/end form-->

                              </div><!--panel-body-->

                            </div><!--panel-default-->

                          </div> <!--col--> 
                          <div  id="contactosi" style="display: none;">
                            <div class="ibox-content text-center">
                                            
                                            <div  class="text-center">
                                                <div align="left" class="m-r-md inline">                                                                                                    
                                                </div>
                            <p>
                                                SALUDO
                                            </p>
                                            <p>
                                                Buenas días/Tardes, Con el Sr/a. <?php echo $nomClient; ?>. Le saluda <?php echo $nombre_usuario; ?>, en representación de Seguros Equinoccial.
                                            </p>
                                            Sr/a. <?php echo $nomClient; ?>. Estamos comprometidos en brindarles el mejor de los servicios a todos nuestros clientes y
                                            <p>
es por eso que queremos conocer su experiencia con nosotros.

Para ello estamos realizando una ENCUESTA que sin duda servirá a Seguros Equinoccial, para mejorar el

servicio. <b>No realizaremos preguntas de índole personal o confidencial </b>¿Sería tan amable de

colaborar con nosotros contestando unas preguntas? … ¿Me permite unos minutos de su tiempo?
                                            </p>
                                            
 
                          
                                            </div>
                                        
                                        </div>
                    <?php
                    }
                    ?>   
                    <div id="contactosipr" style="display: none;" class="ibox-content text-center">
                                            
                                            <div  class="text-center">
                                                <div align="left" class="m-r-md inline">                                                                                                    
                                                </div>
                                                <table align ="center">
                                                  <tr>
                                                    <td align="left">
                                                  <div class="i-checks"><input type="radio" name="contacto_estado"  checked="checked" value ="encuestando" id="enc_efectiva"> Encuesta Efectiva</div>
                                                  <div class="i-checks"><input type="radio" name="contacto_estado"  checked="checked" value ="Rellamar" id="enc_rellamar"> Rellamar</div>
                                                  <div class="i-checks"><input type="radio" name="contacto_estado"  checked="checked" value ="Fuera del Pais" id="enc_suera"> Fuera del Pais</div>
                                                  <div class="i-checks"><input type="radio" name="contacto_estado"  checked="checked" value ="Teléfono Errado" id="enc_errado"> Teléfono Errado</div>
                                                  <div class="i-checks"><input type="radio" name="contacto_estado"  checked="checked" value ="Cliente Abandona" id="enc_abandona"> Abandona</div>
                                                  <div class="i-checks"><input type="radio" name="contacto_estado"  checked="checked" value ="No Colabora" id="enc_no"> No Colabora</div>
                                                  <input style="display: none;" type="radio" name="contacto_estado"  checked="checked">
                                                </td>
                                              </tr>       
                                            </table>
                                            </div>
                                              <div align="left"><input class="btn btn-primary" type="submit" onclick = "this.form.action = 'enc_siniestros_estado_exe.php'" value="Enviar" /></div>
                                        </div>  
      </div>
            <div  id="contactono" style="display: none;">
              <div class="ibox-content text-center">
                                            
                                            <div  class="text-center">
                                                <div align="left" class="m-r-md inline">                                                                                                    
                                                </div>
                                              <p>
                                                Motivo Contacto
                                            </p>
                                            <table align ="center">
                                                  <tr>
                                                    <td align="left">
                                                  <div><input type="radio" name="contacto_estado"  checked="checked" value ="Ocupado" id="enc_ocupado"> Ocupado</div>
                                                  <div><input type="radio" name="contacto_estado"  checked="checked" value ="No Contesta" id="enc_no_contesta"> No Contesta</div>
                                                  <div><input type="radio" name="contacto_estado"  checked="checked" value ="Numero Dañado" id="enc_danado"> Numero Dañado</div>
                                                  <div><input type="radio" name="contacto_estado"  checked="checked" value ="Contestador" id="enc_contestador"> Contestador</div>
                                                  <input style="display: none;" type="radio" name="contacto_estado"  checked="checked">
                                                </td>
                                              </tr>
                                            </table>
                                            </div>
                                        
                                        </div>
                                        <div class="ibox-content text-center">
                                              <div align="left"><input class="btn btn-primary" type="submit" onclick = "this.form.action = 'enc_siniestros_estado_exe.php'" value="Enviar" /></div>
                                        </div>
                                        
                          
            </div> 
          </form>
           
                        
                       
                        <?php
                      }
                      ?>

             
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
   
        
<script type="text/javascript">
$(document).ready(function(){
   $("#contacto_si").click(function(evento){
      if ($("#contacto_si").attr("checked")){
         $("#contactosi").css("display", "block");
         $("#contactosipr").css("display", "block");
         $("#contactono").css("display", "none");
      }else{
         $("#contactosi").css("display", "none");
      }
   });

   $("#contacto_no").click(function(evento){
      if ($("#contacto_no").attr("checked")){
         $("#contactono").css("display", "block");
         $("#contactosi").css("display", "none");
         $("#contactosipr").css("display", "none");
      }else{
         $("#contactono").css("display", "none");
      }
   });


});
</script>
</body>

</html>
