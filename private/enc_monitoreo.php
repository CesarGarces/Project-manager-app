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
$visita = isset($_GET['visita']) ? $_GET['visita'] : null ;
$macro2=0;
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
    <link href="../lib/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">

    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>


<body>
<div id="wrapper">
    <nav class="navbar-info navbar-static-side" role="navigation">
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

                    <h2>Monitoreo</h2>

                    <ol class="breadcrumb">

                        <li>

                            <a href="panel.php">Inicio</a>

                        </li>

                        

                        <li class="active">

                            <strong>Monitoreo</strong>

                        </li>

                    </ol>

                </div>


            

    <div class="wrapper wrapper-content  animated fadeInRight">

            <div class="ibox">            
                    <form role="form" method="post" >
                        </br>
                        <input type="hidden" class="form-control"  name="encuestador" value="<?php echo $_SESSION['user'];?>" >
                                    

                        <div class="col-sm-12">

                          <div class="panel panel-info">


                           <div class="panel-heading"><h3 class="panel-title">Datos</h3>

                           </div>


                             <div class="panel-body">

                                <fieldset>

                                  <div class="row">

                                   <div class="col-md-12">
                                     <div class="control-group">       
                                          <div class="controls">
                                           

                                             <div class="ibox-content text-left">
                                                <div class="text-left">
                                                                                                          
                                                        <label label-info="" class="control-label">Introduzca su código de monitor (*)</label>
                                                        <div class="controls">
                                                          <input type="text" class="form-control"  readonly  name="cod_monitor" value="<?php echo $nombre_usuario." ".$ape_usuario; ?>" required>                                                         
                                                        </div>
                                                   
                                                </div>
                                                </div>

                                                <div class="ibox-content text-left">
                                                <div class="text-left">
                                                                                                          
                                                        <label label-info="" class="control-label">Fecha de Llamada (*)</label>
                                                        <div class="controls">
                                                          <input type="text" class="form-control" id="datepicker"   name="fecha_llamada" value="" required>                                                         
                                                        </div>
                                                   
                                                </div>
                                                </div>

                                                <div class="ibox-content text-left">
                                                <div class="text-left">
                                                                                                          
                                                        <label label-info="" class="control-label">Id de la llamada. (*)</label>
                                                        <div class="controls">
                                                          <input type="text" class="form-control"    name="id_llamada" value="" required>                                                         
                                                        </div>
                                                   
                                                </div>
                                                </div>

                                                <div class="ibox-content text-left">
                                                <div class="text-left">
                                                                                                          
                                                        <label label-info="" class="control-label">Nombre Asesor que atiende la llamada</label>
                                                        <div class="controls">
                                                          <input type="text" class="form-control"    name="nom_asesor" value="">                                                         
                                                        </div>
                                                   
                                                </div>
                                                </div>

                                                <div class="ibox-content text-left">
                                                <div class="text-left">
                                                                                                          
                                                        <label label-info="" class="control-label">Segmento de la Llamada. (*)</label>
                                                        <div class="controls">
                                                          <select class="form-control" name="segmento_llamada" required>
                                                            <option value="">Selecciona</option>
                                                            <option value="Solicitudes y Reclamos">Solicitudes y Reclamos</option>
                                                            <option value="Soporte Tecnico">Soporte Tecnico</option>
                                                                                                          
                                                          </select>                                                         
                                                        </div>
                                                   
                                                </div>
                                                </div>

                                                <div class="ibox-content text-left">
                                                <div class="text-left">
                                                                                                          
                                                        <label label-info="" class="control-label">Tecnología</label>
                                                        <div class="controls">
                                                          <select class="form-control" name="tecnologia" required>
                                                            <option value="">Selecciona</option>
                                                            <option value="Cobre">Cobre</option>
                                                            <option value="Fibra">Fibra</option>
                                                            <option value="FTTC">FTTC</option>                                               
                                                          </select>                                                         
                                                        </div>
                                                   
                                                </div>
                                                </div>

                                                <div class="ibox-content text-left">
                                                <div class="text-left">
                                                                                                          
                                                        <label label-info="" class="control-label">Aliado</label>
                                                        <div class="controls">
                                                          <select class="form-control" name="aliado" required>
                                                            <option value="">Selecciona</option>
                                                            <option value="Americas">Americas</option>
                                                            <option value="Emergia">Emergia</option>
                                                                                                           
                                                          </select>                                                         
                                                        </div>
                                                   
                                                </div>
                                                </div>


                                          </div>

                                      </div>
                                    </div><!--col-->
                                      
                                  </div><!--row-->
                                  
                                 </fieldset><!--/end form-->

                              </div><!--panel-body-->

                            </div><!--panel-datos-->

                                    <div class="ibox-title">                            
                                     <div class="text-left">
                                      <div>
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="btn btn-info btn-rounded" id="PEC_UF"><i class="fa fa-question-circle"></i> PEC_UF</div>
                                                </td>
                                                <td>
                                                    <div class="btn btn-info btn-rounded" id="PEC_NEG"><i class="fa fa-question-circle"></i> PEC_NEG</div> 
                                                </td>
                                                <td>
                                                    <div class="btn btn-info btn-rounded" id="anexo"><i class="fa fa-question-circle"></i> Anexo de monitoreo</div> 
                                                </td>
                                            </tr>
                                        </table>
                                      </div>
                                     </div>
                                    </div>
                                    

                                      <div id="PEC_UFDiv" style="display: none;"> 
                                                <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Gestión inteligente de las esperas</b> </div> 
                                                           
                                                        </div>
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="uf_gestion" onChange="uf_gesti(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                               
                                                                </select> 
                                                            </div>
                                                        <div id="uf_gestion_Divchek" style="display: none;">

                                                        
                                                             <div class="i-checks ibox-content  text-left">
                                                                    <label>
                                                                        <input  type="checkbox" value="Hace solicitud de tiempos de espera innecesarios" name="uf_gestion_chek1" > Hace solicitud de tiempos de espera innecesarios.
                                                                    </label>
                                                                                                                                  
                                                            </div>                                                            
                                                        

                                                             <div class="i-checks ibox-content  text-left">
                                                                    <label>
                                                                        <input  type="checkbox" value="Pide al cliente esperar en la línea sin explicar el motivo o la razón" name="uf_gestion_chek2" > Pide al cliente esperar en la línea sin explicar el motivo o la razón.
                                                                    </label>
                                                                                                                                      
                                                            </div>                                                            
                                                        

                                                             <div class="i-checks ibox-content  text-left">
                                                                    <label>
                                                                        <input  type="checkbox" value="Impone la espera, no pregunta si el cliente está de acuerdo en esperarle en la línea." name="uf_gestion_chek3" > Impone la espera, no pregunta si el cliente está de acuerdo en esperarle en la línea.
                                                                    </label>
                                                                                                                                       
                                                            </div>                                                            
                                                    

                                                       
                                                             <div class="i-checks ibox-content  text-left">
                                                                    <label>
                                                                        <input  type="checkbox" value="Solicita espera sin informar al cliente el tiempo que demorará en retomar la llamada" name="uf_gestion_chek4" > Solicita espera sin informar al cliente el tiempo que demorará en retomar la llamada. 
                                                                    </label>
                                                                                                                                       
                                                            </div>                                                            
                                                       

                                                             <div class="i-checks ibox-content  text-left">
                                                                    <label>
                                                                        <input  type="checkbox" value="Desgasta el recurso de espera (Retomas continuas de la llamada Y/o por tiempos excesivos" name="uf_gestion_chek5" > Desgasta el recurso de espera (Retomas continuas de la llamada Y/o por tiempos excesivos.
                                                                    </label>
                                                                                                                                      
                                                            </div> 
                                                        </div>                                                           
                                                    </div>
                                                </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Solución brindada</b> </div>
                                                            
                                                            <!--<div><input  type="radio" value="Si" name="uf_brinda_sol" id="uf_brinda_sol_si"  checked="checked"> Sí <input  type="radio" value="No" name="uf_brinda_sol"  checked="checked"> No</div>-->
                                                        </div> 
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="uf_brinda_sol" onChange="brinda_solu(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                               
                                                                </select> 
                                                            </div>
                                                          <div id="uf_brinda_solDivchek" style="display: none;">
                                                             <div class="i-checks ibox-content  text-left">
                                                                     <label>
                                                                        <input  type="checkbox" value="No se identifica el verdadero motivo de consult" name="uf_brinda_sol_chek1"> No se identifica el verdadero motivo de consult 
                                                                    </label>
                                                                                                                                     
                                                            </div>

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                     <label>
                                                                        <input  type="checkbox" value="La solución brindada es incorrecta o no aplica" name="uf_brinda_sol_chek2"> La solución brindada es incorrecta o no aplica
                                                                    </label>
                                                                                                                                     
                                                            </div>

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                     <label>
                                                                        <input  type="checkbox" value="La solución brindada es incompleta o parcial" name="uf_brinda_sol_chek3"> La solución brindada es incompleta o parcial
                                                                    </label>
                                                                                                                                     
                                                            </div>

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                     <label>
                                                                        <input  type="checkbox" value="No se da la solución por omitirse algún paso a paso del procedimiento correspondien" name="uf_brinda_sol_chek4"> No se da la solución por omitirse algún paso a paso del procedimiento correspondien
                                                                    </label>
                                                                                                                                    
                                                            </div>

                                                           
                                                             <div class="i-checks ibox-content  text-left">
                                                                     <label>
                                                                        <input  type="checkbox" value="Se deriva a otro canal, teniendo el poder de solventar el requerimiento" name="uf_brinda_sol_chek5"> Se deriva a otro canal, teniendo el poder de solventar el requerimiento
                                                                    </label>
                                                                                                                                    
                                                            </div>

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                     <label>
                                                                        <input  type="checkbox" value="Se pide al cliente volver a llamar o contactarse, no siendo necesario" name="uf_brinda_sol_chek6"> Se pide al cliente volver a llamar o contactarse, no siendo necesario
                                                                    </label>
                                                                                                                                     
                                                            </div>

                                                           
                                                             <div class="i-checks ibox-content  text-left">
                                                                     <label>
                                                                        <input  type="checkbox" value="No busca soluciones alternativas ya definidas en el proceso" name="uf_brinda_sol_chek7"> No busca soluciones alternativas ya definidas en el proceso
                                                                    </label>
                                                                                                                                     
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Paciencia y cordialidad</b> </div>
                                                        </div>
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="uf_pac_cord" onChange="uf_pac_co(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                               
                                                                </select> 
                                                            </div>
                                                         <div id="uf_pac_coDivchek" style="display: none;">
                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    <label>
                                                                        <input  type="checkbox" value="Se realizan comentarios inadecuados o fuera de orden" name="uf_pac_cord_chek1"> Se realizan comentarios inadecuados o fuera de orden
                                                                    </label>
                                                                                                                                  
                                                            </div>

                                                        
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="No presta atención al cliente" name="uf_pac_cord_chek2"> No presta atención al cliente
                                                                    </label>                                                              
                                                            </div>

                                                          
                                                             <div class="i-checks ibox-content  text-left">
                                                                   
                                                                    <label>
                                                                        <input  type="checkbox" value="Interrumpe al cliente de forma inapropiada y fuera de protocolos" name="uf_pac_cord_chek3"> Interrumpe al cliente de forma inapropiada y fuera de protocolos
                                                                    </label>                                                              
                                                            </div>

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Ante la necesidad de volver explicar al cliente los factores que aclaran su inquietud, se desespera" name="uf_pac_cord_chek4"> Ante la necesidad de volver explicar al cliente los factores que aclaran su inquietud, se desespera
                                                                    </label>                                                              
                                                            </div>

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Se usan expresiones que denotan excesos de confianza" name="uf_pac_cord_chek5"> Se usan expresiones que denotan excesos de confianza
                                                                    </label>                                                              
                                                            </div>
                                                         </div>
                                                        </div>
                                                    </div>
                                                     
                                                    
                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Confianza y/o seguridad</b> </div>
                                                        </div>
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="uf_conf_segu" onChange="uf_conf_se(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                               
                                                                </select> 
                                                            </div>
                                                          <div id="uf_conf_seDivchek" style="display: none;">                                      
                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                   
                                                                    <label>
                                                                        <input  type="checkbox" value="Titubeo o duda al brindar la información" name="uf_conf_segu_chek1"> Titubeo o duda al brindar la información
                                                                    </label>                                                                  
                                                            </div> 

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Se evidencia que el asesor no conoce la información requerida y lo transmite al cliente" name="uf_conf_segu_chek2"> Se evidencia que el asesor no conoce la información requerida y lo transmite al cliente
                                                                    </label>                                                                  
                                                            </div>  

                                                          
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Brinda información incorrecta o incompleta como resultado de un análisis errado del caso" name="uf_conf_segu_chek3"> Brinda información incorrecta o incompleta como resultado de un análisis errado del caso
                                                                    </label>                                                                  
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div> 
                                                                                                                                                                                                                                                                                                 
                                                     
                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Simplicidad</b> </div>
                                                        </div>
                                                            <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="uf_simplicidad" onChange="uf_simpli(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                               
                                                                </select> 
                                                            </div>                                                  
                                                      <div id="uf_simpliDivchek" style="display: none;">
                                                                                                    
                                                           
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Se requiere información irrelevante para el desarrollo de la interacción" name="uf_simplicidad_chek1"> Se requiere información irrelevante para el desarrollo de la interacción
                                                                    </label>                                                              
                                                            </div>  

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                   
                                                                    <label>
                                                                        <input  type="checkbox" value="Se solicita información ya requerida por el cliente con anterioridad" name="uf_simplicidad_chek2"> Se solicita información ya requerida por el cliente con anterioridad
                                                                    </label>                                                              
                                                            </div>  

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                     
                                                                    <label>
                                                                        <input  type="checkbox" value="Se pide al cliente cumplir con procedimientos, innecesarios para su atención" name="uf_simplicidad_chek3"> Se pide al cliente cumplir con procedimientos, innecesarios para su atención  
                                                                    </label>                                                              
                                                            </div> 

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                     
                                                                    <label>
                                                                        <input  type="checkbox" value="Utilización de términos o lenguaje que complican la comprensión de la información al cliente" name="uf_simplicidad_chek4">  Utilización de términos o lenguaje que complican la comprensión de la información al cliente
                                                                    </label>                                                              
                                                            </div>
                                                          </div>                                                                                                                                                                                                                               
                                                        </div>
                                                    </div>
                                                  

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Abandono de llamada</b> </div>
                                                        </div>   
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="uf_aban_llam" onChange="uf_aban_lla(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                               
                                                                </select> 
                                                            </div>                                                  
                                                      <div id="uf_aban_llaDivchek" style="display: none;">                                         
                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="El asesor cota la llamada" name="uf_aban_llam_chek1"> El asesor cota la llamada
                                                                    </label>                                                            
                                                            </div>  

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="El asesor incentiva al cliente a cortar la llamada (Sentimiento de abandono por largas esperas)" name="uf_aban_llam_chek2"> El asesor incentiva al cliente a cortar la llamada (Sentimiento de abandono por largas esperas)
                                                                    </label>                                                            
                                                            </div>

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Se cae la llamada no se identifica origen" name="uf_aban_llam_chek3"> Se cae la llamada no se identifica origen
                                                                    </label>                                                            
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>  
                                                </div><!-- PEC_UFDiv -->

                                            <div id="PEC_NEGDiv" style="display: none;">
                                                <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Tiempos de espera</b> </div>
                                                        </div>
                                                            <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="neg_tiempo" onChange="neg_tiem(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                               
                                                                </select> 
                                                            </div>

                                                      <div id="neg_tiemDivchek" style="display: none;">
                                                                                                    
                                                           
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="La sumatoria del tiempo de espera solicitado en la llamada, está por fuera de rango" name="neg_tiempo_chek1"> La sumatoria del tiempo de espera solicitado en la llamada, está por fuera de rango
                                                                    </label>                                                            
                                                            </div>  

                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="El número de tiempos de espera solicitadas es excesivo" name="neg_tiempo_chek2"> El número de tiempos de espera solicitadas es excesivo
                                                                    </label>                                                            
                                                            </div>

                                                        
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Uso inapropiado o no autorizado del HOLD" name="neg_tiempo_chek3"> Uso inapropiado o no autorizado del HOLD
                                                                    </label>                                                            
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Duración de la llamada</b> </div>
                                                        </div>
                                                            <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="neg_duracion" onChange="neg_dura(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                               
                                                                </select> 
                                                            </div>                                                  
                                                      <div id="neg_duraDivchek" style="display: none;">

                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="El tiempo de duración de la llamada está por fuera de rango" name="neg_duracion_chek1"> El tiempo de duración de la llamada está por fuera de rango
                                                                    </label>                                                            
                                                            </div>  

                                                           
                                                             <div class="i-checks ibox-content  text-left">
                                                                  
                                                                    <label>
                                                                        <input  type="checkbox" value="El asesor hace ocupación de canal de forma deliberada" name="neg_duracion_chek2"> El asesor hace ocupación de canal de forma deliberada
                                                                    </label>                                                            
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Gestión comercial</b> </div>
                                                        </div> 
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="neg_gest_com" onChange="neg_gest_co(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option> 
                                                                    <option value="NA">N/A</option>                                                                                                                                                                                                                              
                                                                </select> 
                                                            </div>                                                  
                                                      <div id="neg_gest_coDivchek" style="display: none;">                                           
                                                           
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Se omite el ofrecimiento de productos o servicios que aportan a la solución o consulta del cliente" name="neg_gest_com_chek1"> Se omite el ofrecimiento de productos o servicios que aportan a la solución o consulta del cliente  
                                                                    </label> 
                                                                                                                              
                                                            </div>  

                                                             <div class="i-checks ibox-content  text-left">
                                                               
                                                                    <label>
                                                                        <input  type="checkbox" value="No hay manejo de objeciones" name="neg_gest_com_chek2"> No hay manejo de objeciones
                                                                    </label> 
                                                                                                                             
                                                            </div>
           
                                                             <div class="i-checks ibox-content  text-left">
                                                               
                                                                    <label>
                                                                        <input  type="checkbox" value="Presentación ina propiada de los beneficios y soluciones ofrecidas" name="neg_gest_com_chek3"> Presentación ina propiada de los beneficios y soluciones ofrecidas
                                                                    </label> 
                                                                                                                            
                                                            </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Transferencias No procedentes</b> </div>
                                                        </div>   
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="neg_trans_pro" onChange="neg_trans_pr(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                                                                           
                                                                </select> 
                                                            </div>                                                  
                                                      <div id="neg_trans_prDivchek" style="display: none;">                                          
                                                                <div class="i-checks ibox-content  text-left">
                                                                    <label>
                                                                        <input  type="checkbox" value="Se realiza transferencias no procedentes" name="neg_trans_pro_chek1">Se realiza transferencias no procedentes 
                                                                    </label>                                                            
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Derivación a otros canales</b> </div>
                                                        </div>  
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="meg_deriva" onChange="meg_deri(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                                                                           
                                                                </select> 
                                                            </div>                                                  
                                                      <div id="meg_deriDivchek" style="display: none;">                                           
                                                           
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Se deriva a otro canal, teniendo el poder de solventar el requerimient" name="meg_deriva_chek1"> Se deriva a otro canal, teniendo el poder de solventar el requerimient  
                                                                    </label>                                                            
                                                            </div>  
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Ocupación de canal</b> </div>
                                                        </div> 
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="meg_ocu_canal" onChange="meg_ocu_can(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                                                                           
                                                                </select> 
                                                            </div>                                                  
                                                      <div id="meg_ocu_canDivchek" style="display: none;">                                           
                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="El asesor de forma deliverada ocupa el canal" name="meg_ocu_canal_chek1"> El asesor de forma deliverada ocupa el canal 
                                                                    </label>                                                            
                                                            </div> 
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div><!-- PEC_NEGDiv -->
                                            <div id="anexoDiv" style="display: none;">
                                                <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>tipologías</b> </div>
                                                        </div> 
                                                        <div class="controls ibox-content  text-left"  id="macro">
                                                            <select id="macrosel"class="form-control" id="macrosel" name="macro" >
                                                                <option value="0">Selecciona</option>
                                                                <option value="INFORMACION">INFORMACIÓN</option>
                                                                <option value="TRAMITE">TRÁMITE</option> 
                                                                <option value="FACTURACION">FACTURACIÓN</option>
                                                                <option value="QUEJA O RECLAMO">QUEJA O RECLAMO</option>
                                                                <option value="RETENIDO">RETENIDO</option>
                                                                <option value="RETIRADO">RETIRADO</option>
                                                                <option value="LLAMADA NO EFECTIVA">LLAMADA NO EFECTIVA</option> 
                                                                <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                                            </select>
                                                        </div>
                                                        <div class="controls ibox-content  text-left"  id="macro2">
                                                            <select id="macro2sel"class="form-control" id="macro2sel" name="macro2" >
                                                                <option value="">Selecciona</option>  
                                                                                                                             
                                                            </select>
                                                        </div>
                                                        <div class="controls ibox-content  text-left"  id="macro3">
                                                            <select id="macro3sel"class="form-control" id="macro3sel" name="macro3" >
                                                                <option value="">Selecciona</option>                                                               
                                                            </select>
                                                        </div>

                                                        <input class="btn btn-info btn-rounded" onclick="borrar()" value="Borrar" />

                                                    </div>
                                                </div>


                                                <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>FCR desde la perspectiva del cliente</b> </div>
                                                        </div> 
                                                        <div class="controls ibox-content  text-left">
                                                                <select class="form-control" name="anexo_fcr" onChange="anexo_fc(this)" required>
                                                                    <option value="">Selecciona</option>
                                                                    <option value="Si">Sí</option>
                                                                    <option value="No">No</option>                                                                                                                                                                                                                                                                           
                                                                </select> 
                                                            </div>                                                  
                                                      <div id="anexo_fcDivchek" style="display: none;">                                            
                                                            
                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Asesor" name="anexo_fcr_chek1"> Asesor 
                                                                    </label>                                                            
                                                            </div> 

                                                             <div class="i-checks ibox-content  text-left">
                                                                  
                                                                    <label>
                                                                        <input  type="checkbox" value="Procesos Etb" name="anexo_fcr_chek2"> Procesos Etb
                                                                    </label>                                                            
                                                            </div>

                                                             <div class="i-checks ibox-content  text-left">
                                                                    
                                                                    <label>
                                                                        <input  type="checkbox" value="Cliente " name="anexo_fcr_chek3"> Cliente 
                                                                    </label>                                                            
                                                            </div>

                                                             <div class="i-checks ibox-content  text-left">
                                                                   
                                                                    <label>
                                                                        <input  type="checkbox" value="Incidencia aplicativos" name="anexo_fcr_chek4"> Incidencia aplicativos
                                                                    </label>                                                            
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Llamada reincidente</b> </div>
                                                        </div> 
                                                                                                   
                                                            <div class="ibox-content text-center">                                                                
                                                                Es llamada reincidente                                                                                                                 
                                                            </div>
                                                             <div class="i-checks text-center">
                                                                    <label>
                                                                        <input  type="radio" value="Si" name="anexo_enc5" required> Sí
                                                                    </label>
                                                                    <label>
                                                                        <input  type="radio" value="No" name="anexo_enc5"> No
                                                                    </label>                                                            
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Protocolos de saludo y despedida establecidos</b> </div>
                                                        </div>                                            
                                                            <div class="ibox-content text-center">                                                                
                                                                Sigue los protocolos de saludo y despedida establecido                                                                                                                 
                                                            </div>
                                                             <div class="i-checks text-center">
                                                                    <label>
                                                                        <input  type="radio" value="Si" name="anexo_enc6" required> Sí
                                                                    </label>
                                                                    <label>
                                                                        <input  type="radio" value="No" name="anexo_enc6"> No
                                                                    </label>                                                            
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>El cliente manifiesta que de sea cancelar su servicio</b> </div>
                                                        </div>                                            
                                                            <div class="ibox-content text-center">                                                                
                                                                El cliente manifiesta que de sea cancelar su servicio                                                                                                                 
                                                            </div>
                                                             <div class="i-checks text-center">
                                                                    <label>
                                                                        <input  type="radio" value="Si" name="anexo_enc7" required> Sí
                                                                    </label>
                                                                    <label>
                                                                        <input  type="radio" value="No" name="anexo_enc7"> No
                                                                    </label>                                                            
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Caso de alerta y escalamiento (reclamo)</b> </div>
                                                        </div>                                            
                                                            <div class="ibox-content text-center">                                                                
                                                                Caso de alerta y escalamiento (reclamo)                                                                                                                 
                                                            </div>
                                                             <div class="i-checks text-center">
                                                                    <label>
                                                                        <input  type="radio" value="Si" name="anexo_enc8" required> Sí
                                                                    </label>
                                                                    <label>
                                                                        <input  type="radio" value="No" name="anexo_enc8"> No
                                                                    </label>                                                            
                                                            </div> 
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>TMO</b> </div>
                                                        </div>                                            
                                                            <div class="ibox-content text-center">

                                                                <input type="text" class="form-control" id="tmo" name="anexo_enc9" required value="" >                                                                
                                                                                                                                                                                 
                                                            </div>
                                                             
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>TME</b> </div>
                                                        </div>
                                                              <div class="ibox-content text-center">                                                               
                                                                <input type="text" class="form-control" id="tme" name="anexo_enc10" required value="" >                                                               
                                                              </div>                                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Comentarios Relevantes del cliente (VOC)</b> </div>
                                                        </div>                                            
                                                            <div class="ibox-content text-center">                                                                
                                                                <textarea style="width: 100%;" name="anexo_enc11"></textarea>                                                                                                                
                                                            </div>
                                                         
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="text-left"></i><b>Comentarios del evaluador</b> </div>
                                                        </div>                                            
                                                            <div class="ibox-content text-center">                                                                
                                                                <textarea style="width: 100%;"  name="anexo_enc12"></textarea>                                                                                                                
                                                            </div>
                                                         
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    if($visita==1){?>
                                                        <input class="btn btn-info btn-rounded btn-block disabled" value="Enviar" />
                                                   <?php  } else { ?>
                                                    <input class="btn btn-info btn-rounded btn-block" type="submit" onclick = "this.form.action = 'enc_monitoreo_exe.php'" value="Enviar" />
                                                    <?php } ?>
                                                </div><!-- anexoDiv -->    

                          </div> <!--col-->                                                  
                    </form>            
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
    <script src="../lib/js/plugins/clockpicker/clockpicker.js"></script>






<script>
$(document).ready(function () {
    $('.clockpicker').clockpicker();

    $(document).on('change','#macrosel',function(){
        
        if($('#macrosel').val() == "INFORMACION"){
            html= '';
            html= '<option value="">Selecciona</option>';
            html+= '<option value="CONSULTA CANALES DE ATENCIÓN">CONSULTA CANALES DE ATENCIÓN</option>';
            html+= '<option value="CONSULTA DE COBERTURA (FIBRA/TV EXPRESS)">CONSULTA DE COBERTURA (FIBRA/TV EXPRESS)</option>';
            html+= '<option value="CONSULTA POLÍTICA TRÁMITES">CONSULTA POLÍTICA TRÁMITES</option>';
            html+= '<option value="ESTADO DEL SERVICIO">ESTADO DEL SERVICIO</option>';
            html+= '<option value="OFERTAS VIGENTES">OFERTAS VIGENTES</option>';
            html+= '<option value="ESTADO DEL TRÁMITE/RECLAMO">ESTADO DEL TRÁMITE/RECLAMO</option>';
            html+= '<option value="RECONEXION POR PAGO">RECONEXIÓN POR PAGO</option>';
            html+= '<option value="ALIANZAS">ALIANZAS</option>';

            $('#macro2sel').html(html);
          }
        if($('#macrosel').val() == "TRAMITE"){
           html= '';
            html= '<option value="">Selecciona</option>';
            html+= '<option value="CAMBIO DE EQUIPO">CAMBIO DE EQUIPO</option>';
            html+= '<option value="CAMBIO DE NUMERO">CAMBIO DE NUMERO</option>';
            html+= '<option value="CAMBIO DE PLAN">CAMBIO DE PLAN</option>';
            html+= '<option value="CAMBIO DE USO">CAMBIO DE USO</option>';
            html+= '<option value="TRASLADO">TRASLADO</option>';
            html+= '<option value="VENTA">VENTA</option>';
            html+= '<option value="CAMBIO DE DIRECCION DE REPARTO">CAMBIO DE DIRECCION DE REPARTO</option>';
            html+= '<option value="SINCRONIZACION">SINCRONIZACION</option>';
            html+= '<option value="ACTIVACION/DESACTIVACION  PAQ. CANALES PREMIUM">ACTIVACION/DESACTIVACION  PAQ. CANALES PREMIUM</option>';
            html+= '<option value="ACTIVACION/DESACTIVACION SERVICIOS  PREMIUM">ACTIVACION/DESACTIVACION SERVICIOS  PREMIUM</option>';
            html+= '<option value="ACTIVACION/DESACTIVACION DE PAQUETE SUPLEMENTARIOS/CAMBIO DE CATEGORIAS">ACTIVACION/DESACTIVACION DE PAQUETE SUPLEMENTARIOS/CAMBIO DE CATEGORIAS</option>';
            html+= '<option value="ACTIVACION/DESACTIVACION PLAN LARGA DISTANCIA">ACTIVACION/DESACTIVACION PLAN LARGA DISTANCIA</option>';
            html+= '<option value="ADECUACION CLIENTE">ADECUACION CLIENTE</option>';
            html+= '<option value="ADICION/RETIRO DE DECODIFICADOR">ADICION/RETIRO DE DECODIFICADOR</option>';
            html+= '<option value="ADICION/RETIRO IP">ADICION/RETIRO IP</option>';
            html+= '<option value="SUSPENSION/RECONEXION VOLUNTARIA">SUSPENSION/RECONEXION VOLUNTARIA</option>';
            html+= '<option value="VENTA POR TRASLADO">VENTA POR TRASLADO</option>';
            
            $('#macro2sel').html(html);
          }
        if($('#macrosel').val() == "FACTURACION"){
            html= '';
            html= '<option value="">Selecciona</option>';
            html+= '<option value="INCREMENTO DE TARIFAS">INCREMENTO DE TARIFAS</option>';
            html+= '<option value="ACLARACION VALORES FACTURADOS">ACLARACION VALORES FACTURADOS</option>';
            html+= '<option value="ENVIO FACTURA">ENVIO FACTURA</option>';
            html+= '<option value="ACUERDO DE PAGO">ACUERDO DE PAGO</option>';
            
            $('#macro2sel').html(html);
          }
        if($('#macrosel').val() == "QUEJA O RECLAMO"){
            html= '';
            html= '<option value="">Selecciona</option>';
            html+= '<option value="AJUSTE POR FALLAS EN EL SERVICIO">AJUSTE POR FALLAS EN EL SERVICIO</option>';
            html+= '<option value="FACTURANDO POR ERROR.CANALES UFC, GOLDEN,  HBO/ ADULTOS/ FOX +.">FACTURANDO POR ERROR.CANALES UFC, GOLDEN,  HBO/ ADULTOS/ FOX +.</option>';
            html+= '<option value="QUEJA CONTRA TRABAJADOR">QUEJA CONTRA TRABAJADOR</option>';
            html+= '<option value="ERROR CARGO FIJO DE ACUERDO CON PLAN SOLICITADO">ERROR CARGO FIJO DE ACUERDO CON PLAN SOLICITADO</option>';
            html+= '<option value="ERROR DE PRORRATEO EN CAMBIO DE PLAN E INSTALACION NUEVA">ERROR DE PRORRATEO EN CAMBIO DE PLAN E INSTALACION NUEVA</option>';
            html+= '<option value="INCREMENTOS POR ESTRATIFICACION ERRADA">INCREMENTOS POR ESTRATIFICACION ERRADA</option>';
            html+= '<option value="NUMERO ERRADO EN LA MIGRACION">NUMERO ERRADO EN LA MIGRACION</option>';
            html+= '<option value="PEDIDO DE RETIROS INGRESADOS Y AUN FACTURAN.">PEDIDO DE RETIROS INGRESADOS Y AUN FACTURAN.</option>';
            html+= '<option value="SERVICIOS  PREMIUM (GRABADOR/PAUSA EN VIVO/ MÁS TV),  FACTURANDO POR ERROR.">SERVICIOS  PREMIUM (GRABADOR/PAUSA EN VIVO/ MÁS TV),  FACTURANDO POR ERROR.</option>';
            html+= '<option value="RECURSO">RECURSO</option>';
            html+= '<option value="CLAUSULA DE PERMANENCIA">CLAUSULA DE PERMANENCIA</option>';
            html+= '<option value="INCREMENTO DE TARIFAS">INCREMENTO DE TARIFAS</option>';
            html+= '<option value="QUEJA AL TRABAJADOR">QUEJA AL TRABAJADOR</option>';
            html+= '<option value="OTROS RECLAMOS">OTROS RECLAMOS</option>';

            $('#macro2sel').html(html);
          }
        if($('#macrosel').val() == "RETENIDO"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="INFORMACIÓN">INFORMACIÓN</option>';
            html+= '<option value="TRÁMITES">TRÁMITES</option>';
            html+= '<option value="OFERTA">OFERTA</option>';
            html+= '<option value="BENEFICIOS">BENEFICIOS</option>';
            html+= '<option value="VIGENCIA CLÁUSULA DE PERMANENCIA">VIGENCIA CLÁUSULA DE PERMANENCIA</option>';
            html+= '<option value="RECLAMOS">RECLAMOS</option>';
            $('#macro2sel').html(html);
          }
        if($('#macrosel').val() == "RETIRADO"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="NO PASA CONSULTA EVIDENTE/TERCERO">NO PASA CONSULTA EVIDENTE/TERCERO</option>';
            html+= '<option value="INCONVENIENTES TÉCNICOS">INCONVENIENTES TÉCNICOS</option>';
            html+= '<option value="PROBLEMAS DE FACTURACIÓN">PROBLEMAS DE FACTURACIÓN</option>';
            html+= '<option value="TRÁMITES NO CUMPLIDOS">TRÁMITES NO CUMPLIDOS</option>';
            html+= '<option value="CAMBIO DE DOMICILIO/CIUDAD/VIAJE">CAMBIO DE DOMICILIO/CIUDAD/VIAJE</option>';
            html+= '<option value="MOTIVOS ECONÓMICOS">MOTIVOS ECONÓMICOS</option>';
            html+= '<option value="COMPETENCIA">COMPETENCIA</option>';
            html+= '<option value="QUEJA CONTRA TRABAJADORES">QUEJA CONTRA TRABAJADORES</option>';
            html+= '<option value="CARRUSEL">CARRUSEL</option>';
            html+= '<option value="INCREMENTO DE TARIFAS">INCREMENTO DE TARIFAS</option>';
            
            $('#macro2sel').html(html);
          }
        if($('#macrosel').val() == "LLAMADA NO EFECTIVA"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="CLIENTE MUDO">CLIENTE MUDO</option>';
            html+= '<option value="CAIDA DE LLAMADA">CAIDA DE LLAMADA</option>';
            html+= '<option value="BROMA">BROMA</option>';
            
            $('#macro2sel').html(html);
          }
        if($('#macrosel').val() == "TRANSFERENCIA"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="SOPORTE TÉCNICO">SOPORTE TÉCNICO</option>';
            html+= '<option value="SALVAVENTAS">SALVAVENTAS</option>';
            html+= '<option value="VENTAS">VENTAS</option>';
            html+= '<option value="ENCUESTA">ENCUESTA</option>';
            html+= '<option value="VIA GUBERNATIVA">VIA GUBERNATIVA</option>';
            html+= '<option value="GRANDES CLIENTES">GRANDES CLIENTES</option>';
            html+= '<option value="REGIONAL LLANOS SYR">REGIONAL LLANOS SYR</option>';
            html+= '<option value="REGIONAL LLANOS SOPORTE">REGIONAL LLANOS SOPORTE</option>';
            html+= '<option value="4G-LTE">4G-LTE</option>';
            $('#macro2sel').html(html);
          }
        

        });
$(document).on('change','#macro2sel',function(){
    if($('#macro2sel').val() == "ESTADO DEL SERVICIO"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="CLIENTE SUSPENDIDO POR PAGO">CLIENTE SUSPENDIDO POR PAGO</option>';
            html+= '<option value="CLIENTE FALLA TECNICA/ NO ESTA EN EL PREDIO ">CLIENTE FALLA TECNICA/ NO ESTA EN EL PREDIO </option>';
            
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "RECONEXION POR PAGO"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="PRIMERA SOLICITUD">PRIMERA SOLICITUD</option>';
            
            
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "SINCRONIZACION"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="SINCRONIZACION DE ACTIVOS">SINCRONIZACION DE ACTIVOS</option>';
            
            
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "ACTIVACION/DESACTIVACION  PAQ. CANALES PREMIUM"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="DESACTIVACION">DESACTIVACION</option>';
            html+= '<option value="ACTIVACION">ACTIVACION</option>';
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "ACTIVACION/DESACTIVACION SERVICIOS  PREMIUM"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="DESACTIVACION">DESACTIVACION</option>';
            html+= '<option value="ACTIVACION">ACTIVACION</option>';
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "ACTIVACION/DESACTIVACION DE PAQUETE SUPLEMENTARIOS/CAMBIO DE CATEGORIAS"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="DESACTIVACION">DESACTIVACION</option>';
            html+= '<option value="ACTIVACION">ACTIVACION</option>';
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "ACTIVACION/DESACTIVACION PLAN LARGA DISTANCIA"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="DESACTIVACION">DESACTIVACION</option>';
            html+= '<option value="ACTIVACION">ACTIVACION</option>';
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "ADICION/RETIRO DE DECODIFICADOR"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="ADICION STB">ADICION STB</option>';
            html+= '<option value="RETIRO STB">RETIRO STB</option>';
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "ADICION/RETIRO IP"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="ADICION IP">ADICION IP</option>';
            html+= '<option value="RETIRO IP">RETIRO IP</option>';
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "SUSPENSION/RECONEXION VOLUNTARIA"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="SUSPENSION A SOLICITUD DEL CLIENTE">SUSPENSION A SOLICITUD DEL CLIENTE</option>';            
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "ENVIO FACTURA"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="FACTURA NO LLEGA / DIRECCION ESTA OK">FACTURA NO LLEGA / DIRECCION ESTA OK</option>'; 
            html+= '<option value="FACTURA NO LLEGA / DIRECCION ERRADA">FACTURA NO LLEGA / DIRECCION ERRADA</option>'; 
            html+= '<option value="PAGO EXTEMPORANEO">PAGO EXTEMPORANEO</option>';
            html+= '<option value="PERDIDA DE LA FACTURA">PERDIDA DE LA FACTURA</option>';          
            $('#macro3sel').html(html);
          }
    if($('#macro2sel').val() == "ACUERDO DE PAGO"){
            html= "";
            html= '<option value="">Selecciona</option>';
            html+= '<option value="CLIENTE SOLICITA ACUERDO DE PAGO">CLIENTE SOLICITA ACUERDO DE PAGO</option>';           
            $('#macro3sel').html(html);
          }

        }); 

                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                

     $("#PEC_UF").click(function(evento){
      if ($("#PEC_UF").on("click")){
         $("#PEC_UFDiv").css("display", "block"); 
         $("#PEC_NEGDiv").css("display", "none");
         $("#anexoDiv").css("display", "none");     
      }
   });
     $("#PEC_NEG").click(function(evento){
      if ($("#PEC_NEG").on("click")){
         $("#PEC_NEGDiv").css("display", "block");   
         $("#PEC_UFDiv").css("display", "none"); 
         $("#anexoDiv").css("display", "none");   
      }
   });
     $("#anexo").click(function(evento){
      if ($("#anexo").on("click")){
         $("#anexoDiv").css("display", "block");   
         $("#PEC_UFDiv").css("display", "none"); 
         $("#PEC_NEGDiv").css("display", "none");  
      }
   });

     
});
</script>
<script>
function brinda_solu(sel) {
      if (sel.value=="No"){
           
           
           uf_brinda_solDivchek.style.display = "block";

      }else{

            uf_brinda_solDivchek.style.display = "none";
      }
}
function uf_gesti(sel) {
      if (sel.value=="No"){
           
           
           uf_gestion_Divchek.style.display = "block";

      }else{

            uf_gestion_Divchek.style.display = "none";
      }
}
function uf_pac_co(sel) {
      if (sel.value=="No"){
           
           
           uf_pac_coDivchek.style.display = "block";

      }else{

            uf_pac_coDivchek.style.display = "none";
      }
}
function uf_conf_se(sel) {
      if (sel.value=="No"){
           
           
           uf_conf_seDivchek.style.display = "block";

      }else{

            uf_conf_seDivchek.style.display = "none";
      }
}
function uf_simpli(sel) {
      if (sel.value=="No"){
           
           
           uf_simpliDivchek.style.display = "block";

      }else{

            uf_simpliDivchek.style.display = "none";
      }
}
function uf_aban_lla(sel) {
      if (sel.value=="No"){
           
           
           uf_aban_llaDivchek.style.display = "block";

      }else{

            uf_aban_llaDivchek.style.display = "none";
      }
}
function neg_tiem(sel) {
      if (sel.value=="No"){
           
           
           neg_tiemDivchek.style.display = "block";

      }else{

            neg_tiemDivchek.style.display = "none";
      }
}
function neg_dura(sel) {
      if (sel.value=="No"){
           
           
           neg_duraDivchek.style.display = "block";

      }else{

            neg_duraDivchek.style.display = "none";
      }
}
function neg_gest_co(sel) {
      if (sel.value=="No"){
           
           
           neg_gest_coDivchek.style.display = "block";

      }else{

            neg_gest_coDivchek.style.display = "none";
      }
}
function neg_trans_pr(sel) {
      if (sel.value=="No"){
           
           
           neg_trans_prDivchek.style.display = "block";

      }else{

            neg_trans_prDivchek.style.display = "none";
      }
}
function meg_ocu_can(sel) {
      if (sel.value=="No"){
           
           
           meg_ocu_canDivchek.style.display = "block";

      }else{

            meg_ocu_canDivchek.style.display = "none";
      }
}
function meg_deri(sel) {
      if (sel.value=="No"){
           
           
           meg_deriDivchek.style.display = "block";

      }else{

            meg_deriDivchek.style.display = "none";
      }
}
function anexo_fc(sel) {
      if (sel.value=="No"){
           
           
           anexo_fcDivchek.style.display = "block";

      }else{

            anexo_fcDivchek.style.display = "none";
      }
}
function borrar() {
    
    document.getElementById("macrosel").selectedIndex = 0;
    document.getElementById("macro2sel").selectedIndex = 0;
    document.getElementById("macro3sel").selectedIndex = 0;
}
      
// function tipolog(sel) {
//       if (sel.value=="INFORMACION"){
           
           
//            tipo_infoDivchek.style.display = "block";

//       }else{

//             tipo_infoDivchek.style.display = "none";
//       }
// }
// function info_tipolog(sel) {
//       if (sel.value=="ESTADO DEL SERVICIO"){
           
           
//            tipo_info_estDivchek.style.display = "block";

//       }else{

//             tipo_info_estDivchek.style.display = "none";
//       }
//        if (sel.value=="RECONEXION POR PAGO"){
           
           
//            tipo_info_reconeDivchek.style.display = "block";

//       }else{

//             tipo_info_reconeDivchek.style.display = "none";
//       }
// }


     </script>
     <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
     <script src="../lib/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
$( "#tmo" ).timepicker({ 
    hourMin: 00,
    hourMax: 23,
    showSecond: true,
    timeFormat: 'hh:mm:ss'

});
$( "#tme" ).timepicker({ 
    hourMin: 00,
    hourMax: 23,
    showSecond: true,
    timeFormat: 'hh:mm:ss'

});
</script>

</body>

</html>
