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

$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$list_users = $objUse->list_users();
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();


$row_rol=mysql_fetch_array($img_roles);
$id_rol = $row_rol['id_rol'];

date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
$fecha_a=date('Y');

$id_ticket = $_REQUEST['id_ticket'];
$ticket_query = mysql_query("SELECT * FROM sys_tickets where id_ticket = '".$id_ticket."'  ");
$ticket_fet = mysql_fetch_row($ticket_query);

$ticket_resp_query = mysql_query("SELECT * FROM sys_tickets_resp where id_ticket = '".$id_ticket."'  ");
$ticket_resp_fet = mysql_fetch_row($ticket_resp_query);


              

$id_usuario = $ticket_resp_fet[2];

$usuario_resp_query = mysql_query("SELECT * FROM sys_usuarios where id_usuario = '".$id_usuario."'  ");
$usuario_resp_fet = mysql_fetch_row($usuario_resp_query);




?>

<!DOCTYPE html>

<html>



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>IZO | Ticket</title>



    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">

    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">



    <link href="../lib/css/animate.css" rel="stylesheet">

    <link href="../lib/css/style.css" rel="stylesheet">

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
                                <li><a href="modify_pass.php">Cambiar Contraseña</a></li>
                                <li><a href="log_out.php">Salir</a></li>
                            </ul>
                    </div>

                    <div class="logo-element">

                       <img src="../favicon.ico" width="25" height="25">
                    </div>
                </li>

                <li>
                    <a href="panel.php"><i class="fa fa-desktop"></i> <span class="nav-label">Panel</span></a>
                </li>
                <li>
                    <a href="dashboard.php"><i class="fa fa-clock-o"></i> <span class="nav-label">Time Management</span></a>
                </li>
                <li>
                    <a href="mediciones.php"><i class="fa fa-tachometer"></i> <span class="nav-label">Customer Experience</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Employee Experience</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Certificaciones IZO</span></a>
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

        

        <div class="wrapper wrapper-content  animated fadeInRight">           
          <div class="col-lg-8">
                <div class="ibox float-e-margins">


                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                          <div class="ibox-title">
                            <?php if($ticket_fet[8] == 'Alta'){ ?>
                              <span class="label label-danger pull-right"><?php echo $ticket_fet[8]; ?></span>
                            <?php }elseif($ticket_fet[8] == 'Media'){ ?>
                              <span class="label label-warning pull-right"><?php echo $ticket_fet[8]; ?></span>
                            <?php }elseif($ticket_fet[8] == 'Baja'){ ?>
                              <span class="label label-primary pull-right"><?php echo $ticket_fet[8]; ?></span>
                              <?php } ?>
                              <h5>Urgencia</h5>
                          </div>
                          <div class="ibox-content">
                              <h1 class="no-margins"><i class="fa fa-ticket"></i> Id Ticket <?php echo $ticket_fet[0]; ?></h1>
                              <small class="stats-label">Estado</small>
                                <h4><?php echo $ticket_fet[7]; ?></h4>
                        
                          </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                      
                        
                       <h5>De: <?php echo $ticket_fet[1]; ?></h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $ticket_fet[4]; ?></h1>
                      </br>
                        <div><a class="btn btn-success btn-rounded btn-xs" href="resp_ticket.php?id_ticket=<?php echo $ticket_fet[0]; ?>"><i class="fa fa-reply"></i> Responder</a> </div> 
                    </div>
                </div>
            </div>

            <?php 
            $ticket_resp_query2 = mysql_query("SELECT * FROM sys_tickets_resp where id_ticket = '".$id_ticket."'  ");
              while($resp = mysql_fetch_row($ticket_resp_query2)) { ?>
             
              
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                      
                        
                       <h5>Responde: <?php echo $usuario_resp_fet[7]; ?></h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $resp[3]; ?></h1>
                        
                    </div>

                </div>
            </div>
            <?php if($resp[4] == ''){

            }else { ?>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                      
                       <?php $usuario_resp_1 = mysql_query("SELECT * FROM sys_usuarios where id_usuario = '".$resp[5]."'  ");
                       $usuario_resp_fet_1 = mysql_fetch_row($usuario_resp_1); ?>
                       <h5>Responde: <?php echo $usuario_resp_fet_1[7]; ?></h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $resp[4]; ?></h1>
                        </br>
                        <div><a class="btn btn-success btn-rounded btn-xs" href="resp_ticket.php?resp=1&id_ticket=<?php echo $ticket_fet[0]; ?>"><i class="fa fa-reply"></i> Responder</a> </div> 
                    </div>

                </div>
            </div>

          <?php } } ?>

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                      
                        
                       <h5>Documento</h5>
                    </div>
                    <div class="ibox-content">
                      <?php 
                      $doc = substr($ticket_fet[5], -3); 
                      
                      if($doc == 'lsx'){  ?>
                     
                        <h1><i class="fa fa-file-excel-o"></i> <a href="http://izoboard.net:88/izoboard/archivos/<?php echo $ticket_fet[5]; ?>" target="_blank"><?php echo $ticket_fet[5]; ?></a></h1>
                      <?php }elseif($doc == 'pdf'){  ?>
                        <h1><i class="fa fa-file-pdf-o"></i> <a href="http://izoboard.net:88/izoboard/archivos/<?php echo $ticket_fet[5]; ?>" target="_blank"><?php echo $ticket_fet[5]; ?></a></h1>
                      <?php }elseif($doc == 'doc'){  ?>
                        <h1><i class="fa fa-file-word-o"></i> <a href="http://izoboard.net:88/izoboard/archivos/<?php echo $ticket_fet[5]; ?>" target="_blank"><?php echo $ticket_fet[5]; ?></a></h1>
                      <?php }else{  ?>
                      <h1><i class="fa fa-file-o"></i> <a href="http://izoboard.net:88/izoboard/archivos/<?php echo $ticket_fet[5]; ?>" target="_blank"><?php echo $ticket_fet[5]; ?></a></h1>
                      <?php }  ?>
                    </div>
                </div>
            </div>


                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox float-e-margins">

                          <div class="col-lg-12">
                         <div class="ibox float-e-margins">
                              <div class="ibox-title">
                                 <h5>Area Que se envia</h5>
                              </div>
                              <div class="ibox-content">
                                  <h1 class="no-margins"><i class="fa fa-paper-plane-o"></i> <?php echo $ticket_fet[6]; ?> </h1>                       
                              </div>
                          </div>
                      </div>

                      <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-warning pull-right">Data has changed</span>-->
                        <h5>Actividad</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Publica</small>
                                <h4><?php echo $ticket_fet[1]; ?></h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">Responde</small>
                                <h4><?php echo $usuario_resp_fet[7]; ?></h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Fecha</small>
                                <h4><?php echo $ticket_fet[9]; ?></h4>
                            </div>
                        </div>
                    </div>
                    <?php 
                   $ticket_resp_query_act = mysql_query("SELECT * FROM sys_tickets_resp where id_ticket = '".$id_ticket."'  ");

                   

                    while($act = mysql_fetch_row($ticket_resp_query_act)) { 
                      $usuario_resp_2 = mysql_query("SELECT * FROM sys_usuarios where id_usuario = '".$act[2]."'  ");
                       $usuario_resp_fet_2 = mysql_fetch_row($usuario_resp_2);
                   ?>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Publica</small>
                                <h4><?php echo $ticket_fet[1]; ?></h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">Responde</small>
                                <h4><?php echo $usuario_resp_fet_2[7]; ?></h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Fecha</small>
                                <h4><?php echo $act[6]; ?></h4>
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                </div>
            </div>



            <div class="col-lg-12">
              
                  <div class="col-lg-6"><a class="btn btn-success btn-rounded" href="cont_ticket_exe.php?sol=si&id_ticket=<?php echo $id_ticket; ?>"><i class="fa fa-thumbs-o-up"></i>  Sí fue Solucionado</a> </div> 
                  <div class="col-lg-6"><a class="btn btn-success btn-rounded" href="cont_ticket.php?sol=no&id_ticket=<?php echo $ticket_fet[0]; ?>"><i class="fa fa-thumbs-o-down"></i>  No fue Solucionado</a> </div> 

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





</body>



</html>

