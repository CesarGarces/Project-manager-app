<?php
$link = mysql_connect('localhost', 'root', 'IZ0.r1c0pap1r1c0')
or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('izometrics_izo_co') or die('No se pudo seleccionar la base de datos');
$id_izo = $_REQUEST['id_izo'];
$id_enc = 1;
$query = "SELECT * FROM evaluacion_cem where id_izo = '".$id_izo."' ";
        $result = mysql_query($query);
        $sqlClient=mysql_fetch_row($result);
$usnombre = $sqlClient[5];
$usestado = $sqlClient[4];


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Evaluación</title>

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
                    <h2>Evaluación de Conocimientos</h2>
                </div>

            

    
            
                  <?php if($usestado == "Encuesta Efectiva"){ ?>
                  
                    
                      <table style="background-color: #f6f6f6; width: 100%;">
    <tr>
        <td></td>
        <td>
            <div>
                <table style="background: #fff; border: 1px solid #e9e9e9; border-radius: 3px;" width="100%" cellpadding="" cellspacing="0">
                    <tr>
                        <td style="padding: 20px;">
                            <table align="center" cellpadding="0" cellspacing="0">
                             <tr>
                               <table width="100%" align="center">
                                <tr align="center">
                                    <td align="left">
                                        
                                                                            
                                    </td>

                                </tr>
                                </table>
                                   
                                </tr>
                                <tr>
                  <td style="padding: 0  20px;">
                  <br>
                    <font style="font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;">
                                        <b>
                    ESTIMADO/A <?php echo $usnombre; ?>, 
                    </b>
                    <p>
                    Gracias por participar en la Certificación CEM Lima Noviembre 2016. </p>
                    
                    </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <font style="font-family: Calibri, Candara, Segoe,Segoe UI, Optima, Arial, sans-serif;">
                                           <h3 align="center">Calificación Obtenida: </h3>
                                          <p>
                                          <?php
                    $list_reporte_inicial = mysql_query("SELECT * FROM evaluacion_cem where estado = 'Encuesta Efectiva' and id_izo = '".$id_izo."' ");
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
                                    

                                      
                                            <?php  $list["resp1"]; if($resp1 == $list["resp1"]){ $total1 = 1; } else { $total1 = 0; } ?>
                                      
                                   
                                            <?php  $list["resp2"]; if($resp2 == $list["resp2"]){ $total2 = 1; } else { $total2 = 0; } ?>
                                    
                                            <?php  $list["resp3"]; if($resp3 == $list["resp3"]){ $total3 = 1; } else { $total3 = 0; } ?>
                                  
                                            <?php  $list["resp4"]; if($resp4 == $list["resp4"]){ $total4 = 1; } else { $total4 = 0; } ?>
                                     
                                            <?php  $list["resp5"]; if($resp5 == $list["resp5"]){ $total5 = 1; } else { $total5 = 0; } ?>
                                    
                                            <?php  $list["resp6"]; if($resp6 == $list["resp6"]){ $total6 = 1; } else { $total6 = 0; } ?>
                                    
                                            <?php  $list["resp7"]; if($resp7 == $list["resp7"]){ $total7 = 1; } else { $total7 = 0; } ?>
                                     
                                            <?php  $list["resp8"]; if($resp8 == $list["resp8"]){ $total8 = 1; } else { $total8 = 0; } ?>
                                     
                                            <?php  $list["resp9"]; if($resp9 == $list["resp9"]){ $total9 = 1; } else { $total9 = 0; } ?>
                                     
                                            <?php  $list["resp10"]; if($resp10 == $list["resp10"]){ $total10 = 1; } else { $total10 = 0; } ?>
                                     
                                            <?php  $list["resp11"]; if($resp11 == $list["resp11"]){ $total11 = 1; } else { $total11 = 0; } ?>
                                     
                                            <?php  $list["resp12"]; if($resp12 == $list["resp12"]){ $total12 = 1; } else { $total12 = 0; } ?>
                                      
                                            <?php  $list["resp13"]; if($resp13 == $list["resp13"]){ $total13 = 1; } else { $total13 = 0; } ?>
                                       
                                            <?php  $list["resp14"]; if($resp14 == $list["resp14"]){ $total14 = 1; } else { $total14 = 0; } ?>
                                      
                                            <?php  $list["resp15"]; if($resp15 == $list["resp15"]){ $total15 = 1; } else { $total15 = 0; } ?>
                                      
                                            <?php  $list["resp16"]; if($resp16 == $list["resp16"]){ $total16 = 1; } else { $total16 = 0; } ?>
                                      
                                            <?php  $list["resp17"]; if($list["resp17"] != ''){ $total17 = 1; } else { $total17 = 0; } ?>
                                       
                                            <?php  $list["resp18"]; if($resp18 == $list["resp18"]){ $total18 = 1; } else { $total18 = 0; } ?>
                                       
                                            <?php  $list["resp19"]; if($resp19 == $list["resp19"]){ $total19 = 1; } else { $total19 = 0; } ?>
                                      
                                            <?php  $list["resp20"]; if($resp20 == $list["resp20"]){ $total20 = 1; } else { $total20 = 0; } ?>
                                      
                                            <?php 
                                            $total =  $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10 + $total11 + $total12 + $total13 + $total14 + $total15 + $total16 + $total17 + $total18 + $total19 + $total20; 
                                            
                                            
                                            ?>
                                       <h1 align="center"><?php echo $total.'/'.'20'; ?></h1>
                                                                                                                 
                                    
                                    <?php
                                }
            
                ?>
                    
                                          </p>
                                          </font>
                                        <br>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="padding: 0 0 20px; align:"center"; background-color:"#1A5276";">
                                        
                                      <font style="font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;">
                                            <p> Gracias por elegirnos.</p>
                                            <br>
                                            <img src="http://izoboard.net:88/izo/lib/img/logo-izo.png"/>
                                            <p style="font-size:0.8em;">Cualquier inquietud adicional por favor comunicarse con
                                            <p style="font-size:0.8em;">Mauro Avila <font color="blue">mauro.avila@izo.es</font>  ó Pablo Rodriguez <font color="blue">pablo.rodriguez@izo.com.co</font>  </p>
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
                            <td style="padding: 0 0 20px; align:"center"">Encuesta auditada por IZO</a> en IZOBoard.</td>
                        </tr>
                    </table>
                </div></div>
        </td>
        <td></td>
    </tr>
</table>
                  </div>
                                </div>
                            </div>
                     
            </body>
          </html>


                  <?php exit(0); }else{ ?>
                    <form name="form1" method="post" action ="enc_siniestro_execute.php">
                                      <div class="col-lg-12">

                                        <div class="ibox-content text-left">                                                       
                                                        
                                                        <input type="hidden"name="id_izo" value="<?php echo $id_izo; ?>">
                                                        <input type="hidden"name="id_enc" value="<?php echo $id_enc; ?>">
                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                           
                                                    <label label-default="" class="control-label">
                                                            <p>Hola <?php echo $usnombre; ?> Responde el siguiente cuestionario.</p>
                                                            
                                                        </label>    
                                                    
                                        
                                                </div>
                                              </div>  

                                            <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">1. Cuál es el ingrediente escencial para el recuerdo?</label>
                                                        <div class="controls">

                                                               <div class="i-checks"><label><input type="radio" name="resp1" value="a" required> a) Las vivencias</label></div>
                                                               <div class="i-checks"><label><input type="radio" name="resp1" value="b" > b) Las experiencias</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp1" value="c" > c) Las emociones</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp1" value="d" > d) Los insatisfactores</label></div> 
                                                              
                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">2. Cuál es el marco de la relación entre los clientes y las empresas?</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp2" value="a" required> a) Promesa de Marca - Interacción - Experiencia - Opinión - Reputación</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp2" value="b" > b) Expectativa - Satisfacción - Experiencia - Recomendación -Recompra</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp2" value="c" > c) Marca - Producto - Interacción </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp2" value="d" > d) Todas las anteriores </label></div> 
                                                              
                                                             
                                                             
                                                                
                                                                
                                                               
                                                               
           
                                                             
                                                           

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">3. De las siguientes ¿cuál NO es una dimensión del Framework?</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp3" value="a" required> a) Cultura y personas</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp3" value="b" > b) Certificación de procesos</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp3" value="c" > c) Medición </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp3" value="d" > d) Cliente </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp3" value="e" > e) Gobierno</label></div> 
                                                             
                                                             
                                                                
                                                                
                                                               
                                                               
                                                                
                                                             
                                                           

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">4. El Pasillo de Cliente es una herramienta que sirve para:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp4" value="a" required> a) Diseñar nuevas experiencias</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp4" value="b" > b) Diagnosticar la experiencia que tiene el cliente en cada interacción con la compañía</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp4" value="c" > c) Mapear los procesos, políticas y  herramientas presentes en cada interacción</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp4" value="d" > d) Identificar únicamente momentos de verdad </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp4" value="e" > e) Todas las anteriores </label></div> 
                                                             
                                                             
                                                                
                                                                
                                                                
                                                               
                                                               
           
                                                             
                                                           

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">5) El enfoque correcto para construir el pasillo del cliente es:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp5" value="a" required> a) Desde la pespectiva de los procesos compañía</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp5" value="b" > b) Desde la perspectiva de los objetivos de negocio de la compañía</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp5" value="c" > c) Desde la perspectiva del cliente</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp5" value="d" > d) Desde la perspectiva del mercado </label></div> 
                                                              
                                                              

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">6) Los Perfiles de cliente son:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp6" value="a" required> a) La segmentación de los diferentes clientes en función de sus ingresos</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp6" value="b" > b) Una herramienta que permite al gestor CEM eliminar procesos innecesarios</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp6" value="c" > c) La generación de arquetipos de clientes a partir de sus necesidades, expectativas y preferencias de contacto</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp6" value="d" > d) a y c son correctas</label></div> 
                                                              
                                                             
                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">7) De los siguientes, ¿Cuál no sería considerado un indicador de Experiencia?</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp7" value="a" required> a) Net Promoter Score  (NPS)</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp7" value="b" > b) Customer Effort Score (CES) </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp7" value="c" > c) Satisfacción de cliente (SC)</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp7" value="d" > d) Best Customer Experience (BCX)</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp7" value="e" > e) Todas las anteriores) </label></div> 

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">8) Cuál es la escala de medición oficial del NPS?</label>
                                                        <div class="controls">

                                                                                                                      
                                                               <div class="i-checks"><label><input type="radio" name="resp8" value="a" required> a) 1 a 10</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp8" value="b" > b) 1 a 5</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp8" value="c" > c) 0 a 10</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp8" value="d" > d) Si - No</label></div> 
                                                              
                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">9) El NPS se obtiene a partir del siguiente cálculo:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp9" value="a" required> a) Top2-Bottom 2 </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp9" value="b" > b) Top2-Bottom 7 </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp9" value="c" > c) % Detractores-%Promotores </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp9" value="d" > d) %Clientes Satisfechos-%Insatisfechos</label></div> 

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">10) Cuál es la pregunta que mide el CES?</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp10" value="a" required> a) ¿Cuánto esfuerzo personal le requirió…?</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp10" value="b" > b) ¿Qué ta facil fue…?</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp10" value="c" > c) ¿Es fácil y sencillo…?</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp10" value="d" > d) ¿Puedo interactuar con… de forma fácil? </label></div> 
                                                              
                                                             
                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">11) Las 3 dimensiones en las que debemos gestionar la Experiencia son:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp11" value="a" required> a) Marca-Producto-Satisfacción</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp11" value="b" > b) Marca-Producto-Relación </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp11" value="c" > c) Marca-Producto-Interacción</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp11" value="d" > d) Expectativa-promesa-reputación</label></div> 
                                                              
                                                             
                                                             
                                                                
                                                               
                                                                
                                                                
           
                                                             
                                                           

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">12) Están orientadas a analizar la lealtad de los clientes/consumidores hacia la marca. Esto habla del indicador:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp12" value="a" required> a) Customer Effort </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp12" value="b" > b) NPS Relacional</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp12" value="c" > c) NPS 2.0 Transaccional</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp12" value="d" > d) Fidelidad </label></div> 
                                                              

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">13) La metodología AT-ONE sive para:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp13" value="a" required> a) Para mapear la experiencia</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp13" value="b" > b) Para identificar mejoras en los procesos invisibles para el cliente</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp13" value="c" > c) Para generar un pasillo de cliente objetivo </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp13" value="d" > d) Para pilotear las iniciativas desarrolladas</label></div> 


                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">14) Define aquellas interacciones que son realmente IMPORTANTES Para el cliente</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp14" value="a" required> a) MOT (Momento Of true)</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp14" value="b" > b) Interacciones críticas</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp14" value="c" > c) MOP (Moment Of pain)</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp14" value="d" > d) Interacciones con alto esfuerzo </label></div> 
                                                              
                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">15) Son los atributos con los que se definen que una interacción es un momento de dolor</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp15" value="a" required> a) Alta Importancia y Baja satisfacción </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp15" value="b" > b) Baja Satisfacción y Alta recomendación </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp15" value="c" > c) Experiencia Lo odio o negativa y Esfuerzo Alto </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp15" value="d" > d)Esfuerzo alto e importancia Alta</label></div> 
 

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">16) Si hablamos de indagar por el nivel de recomendación luego de vivir una interacción particular estamos hablando de:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp16" value="a" required> a) BCX </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp16" value="b" > b) NPS Relacional </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp16" value="c" > c) NPS Transaccional (NPS 2.0)</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp16" value="d" > d) CES 2.0 </label></div> 


                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">17. Explica con tus palabras la importancia de incorporar un modelo de Economía de las Relaciones en los estudios realizados.</label>
                                                        <div class="controls">

                                                          <textarea style="margin: 0px; width: 100%;" name="resp17"></textarea>

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">18) Estos son dos de los principales economics de la experiencia</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp18" value="a" required> a) Permanencia y Precio Premiun </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp18" value="b" > b) Share of wallet y Experiencia </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp18" value="c" > c) Recomendación y Fidelidad </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp18" value="d" > d) CES y Preferencia </label></div> 
                                                              
                                                             
                                                             
                                                              
                                                               
                                                               
                                                              
           
                                                             
                                                           

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">19) Esto lo debe tener un programa de Voz del cliente (VOC)</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp19" value="a" required> a) Captura todas las interacciones</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp19" value="b" > b) Dar feedback debe ser fácil y rápido</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp19" value="c" > c) Construye la  conversación</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp19" value="d" > d) Acciona el feedback en la organización</label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp19" value="e" > e) Todas las anteriores</label></div> 
                                                             
                                                             
                                                                
                                                               
                                                                
                                                               
                                                               
           
                                                             
                                                           

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                              <div class="ibox-content text-left">                                               
                                                <div class="text-left">
                                                                                                 
                                                        <label label-default="" class="control-label">20) Este factor es primordial identificar, para determinar qu economics se pueden usar:</label>
                                                        <div class="controls">

                                                           
                                                             
                                                               <div class="i-checks"><label><input type="radio" name="resp20" value="a" required> a) Indicadores de operación </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp20" value="b" > b) kpis claves del negocio </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp20" value="c" > c) indicadores de experiencia </label></div> 
                                                               <div class="i-checks"><label><input type="radio" name="resp20" value="d" > d) indicadores de mercado </label></div> 
                                                              
 

                                                       </div>
                                                   
                                                </div>
                                              </div>

                                                
                                                <input type="submit" class="btn btn-primary btn-rounded btn-block" onclick="this.form.action = 'evaluacion_cem_exe.php'" value="Enviar">


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
