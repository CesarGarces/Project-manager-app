<?php
$link = mysql_connect('localhost', 'root', 'IZ0.r1c0pap1r1c0')
or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('izoboard_izo') or die('No se pudo seleccionar la base de datos');
$celular = $_REQUEST['celular'];
$query = "SELECT * FROM enc_curso_cem_inno where celular = '".$celular."' ";
        $result = mysql_query($query);
        $sqlClient=mysql_fetch_row($result);
$usnombre = $sqlClient[1];
$usestado = $sqlClient[5];


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
            </ul>
        </div>
    </nav>
<div class="gray-bg">
        
 <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">
                    <div class="animated slideInDown"><img src="../lib/img/izo.png" style="width: 120%;position: relative;right: 5%;"></div>
                    <div class="animated fadeInUp" style="position: absolute;top: 50%;left: 49%;"><img src="../lib/img/logo.png" style="width: 30%"></div>
                    <h2>Encuesta Curso CEM</h2>
                </div>

            

    <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="ibox">  
                  <?php if($usestado == "Encuesta Efectiva"){ ?>
                  <div align="left">
                    <br>
                    <br>
                      <p>Se ha ingresado la respuesta</p>
                      <h2>Gracias por tu asistencia</h2>
                  </div>
                                </div>
                            </div>
                        </div>  
                    </div>  
                </div> 
            </body>
          </html>


                  <?php exit(0); }else{ ?>
                    <form name="form1" method="post" action ="enc_siniestro_execute.php">
                                      <div class="col-lg-12">

                                        <div class="ibox-content text-left">                                                       
                                                        <input type="hidden"name="celular" value="<?php echo $celular; ?>">
                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                           
                                                        <label label-default="" class="control-label">
                                                            <p>Hola <?php echo $usnombre; ?> Tenemos una encuesta para tí.</p>
                                                            
                                                        </label>
                                                    
                                        
                                                </div>
                                              </div>  

                                            <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">Cómo calificas tu satisfacción con el módulo de medición visto hoy? (1 a 5) donde 1 es bajo y 5 es alto.</label>
                                                        <div class="controls">

                                                          <table align="center">
                                                            <tr>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc1" value="1" required></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc1" value="2" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc1" value="3" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc1" value="4" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc1" value="5" ></div></td>
                                                            </tr>
                                                            <tr>
                                                              <td  style="width: 30px;" align="center">1</td>
                                                              <td  style="width: 30px;" align="center">2</td>
                                                              <td  style="width: 30px;" align="center">3</td>
                                                              <td  style="width: 30px;" align="center">4</td>
                                                              <td  style="width: 30px;" align="center">5</td>
                                                            </tr>
                                                          </table>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label"> Lo ves aplicable en tu día a día? (si, no)</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc2" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc2" value="No"> <i></i> No </label></div>  
                                                           

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label"> Y tu satisfacción con el módulo de Innovar? (1 a 5) donde 1 es bajo y 5 es alto.</label>
                                                        <div class="controls">
                                                          
                                                          <table align="center">
                                                            <tr>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc3" value="1" required></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc3" value="2" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc3" value="3" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc3" value="4" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc3" value="5" ></div></td>
                                                            </tr>
                                                            <tr>
                                                              <td  style="width: 30px;" align="center">1</td>
                                                              <td  style="width: 30px;" align="center">2</td>
                                                              <td  style="width: 30px;" align="center">3</td>
                                                              <td  style="width: 30px;" align="center">4</td>
                                                              <td  style="width: 30px;" align="center">5</td>
                                                            </tr>
                                                          </table>  

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label">Ves aplicable la herramienta del pasillo de cliente? (si, no)</label>
                                                        <div class="controls">
                                                          
                                                          <div class="i-checks"><label> <input type="radio" name="enc4" value="Si" required> <i></i> Sí </label></div>
                                                          <div class="i-checks"><label> <input type="radio" name="enc4" value="No"> <i></i> No </label></div>  
                                                          
                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">                                                                                             
                                                        <label label-default="" class="control-label"> Que tan interesante ves el modelo LEGO Serious Play? (1 a 5) donde 1 es bajo y 5 es alto.</label>
                                                        <div class="controls">
                                                          
                                                          <table align="center">
                                                            <tr>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc5" value="1" required></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc5" value="2" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc5" value="3" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc5" value="4" ></div></td>
                                                              <td style="width: 30px;" align="center"><div class="i-checks"><input type="radio" name="enc5" value="5" ></div></td>
                                                            </tr>
                                                            <tr>
                                                              <td  style="width: 30px;" align="center">1</td>
                                                              <td  style="width: 30px;" align="center">2</td>
                                                              <td  style="width: 30px;" align="center">3</td>
                                                              <td  style="width: 30px;" align="center">4</td>
                                                              <td  style="width: 30px;" align="center">5</td>
                                                            </tr>
                                                          </table>  

                                                       </div>
                                                   
                                                </div>
                                              </div>
      
                                                
                                                <input type="submit" class="btn btn-primary btn-rounded btn-block" onclick="this.form.action = 'enc_curso_cem_inno_exe.php'" value="Enviar">


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
</body>

</html>
