﻿<?php
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
$sol = $_REQUEST['sol'];
$ticket_query = mysql_query("SELECT * FROM sys_tickets where id_ticket = '".$id_ticket."'  ");
$ticket_fet = mysql_fetch_row($ticket_query);

$ticket_resp_query = mysql_query("SELECT * FROM sys_tickets_resp where id_ticket = '".$id_ticket."' ");
$ticket_resp_fet = mysql_fetch_row($ticket_resp_query);



?>

<!DOCTYPE html>

<html>



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>IZO | Responder Ticket</title>



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

        <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2>Responder Ticket</h2>

                    <ol class="breadcrumb">

                        <li>

                            <a href="panel.php">Inicio</a>

                        </li>

                        <li>

                            <a href="ticket_list.php">Tickets</a>

                        </li>

                        

                        <li class="active">

                            <strong>Responder Ticket</strong>

                        </li>

                    </ol>

                </div>

        </div>

        <div class="wrapper wrapper-content  animated fadeInRight">           

            <div class="row">

              <div class="col-lg-12">

                <div class="ibox">

                  <div class="ibox-content"> <!--inbox-->                 

                    <div class="row"><!--inrow-->

                      <form role="form" action="cont_ticket_exe.php" method="post">
                        <input type="hidden"  name="id_usuario_responde" value="<?php echo $id_usuario ?>">
                        <input type="hidden"  name="id_ticket" value="<?php echo $ticket_fet[0]; ?>">
                        <input type="hidden"  name="id_ticket_resp" value="<?php echo $ticket_resp_fet[0]; ?>">


                        <div class="col-sm-12">

                          <div class="panel panel-default">

                           <div class="panel-heading"><h3 class="panel-title">Caracterísitcas Básicas</h3>

                           </div>

                             <div class="panel-body">

                                <fieldset>

                                  <div class="row">

                                   <div class="col-md-6">

                                     

                                    </div><!--col-->

                                      

                                  </div><!--row-->

                                    <div class="row">

                                      <div class="col-md-12">

                                        <div class="control-group">

                                          <label label-default="" class="control-label">Detalle</label>

                                            <div class="controls">

                                              <textarea name="detalle" style="margin: 0px; width: 100%; height: 100%" readonly><?php echo $ticket_resp_fet[3]; ?></textarea>
                                            </div>

                                        </div>

                                      </div><!--col-->

                                  </div><!--row-->

                                  <div class="row">

                                      <div class="col-md-12">

                                        <div class="control-group">

                                          <label label-default="" class="control-label">Respuesta *</label>

                                            <div class="controls">

                                              <textarea name="respuesta" style="margin: 0px; width: 100%; height: 100%" required></textarea>
                                            </div>

                                        </div>

                                      </div><!--col-->

                                  </div><!--row-->

                                  <div class="row">

                                      <div class="col-md-12">

                                        <div class="control-group">

                                          <label label-default="" class="control-label">Estado *</label>

                                            <div class="controls">

                                             <select class="form-control required m-b valid" name="estado" required >

                                                <option selected value="<?php echo $ticket_fet[6]; ?>"><?php echo $ticket_fet[6]; ?></option>

                                                <option value="Activo">Activo</option>

                                                <option value="Concluido">Concluido</option>

                                                <option value="Revición">Revición</option>

                                              </select>
                                            </div>

                                        </div>

                                      </div><!--col-->

                                  </div><!--row-->

                                    <div class="row">

                                                                        

                                        

                                                         

                                                           

                                    </div><!--row-->
                                    <div class="row">

                                              <div class="col-md-3">

                                              </div>

                                                <div class="col-md-9">

                                                  <div class="controls pull-right">

                                                    <button type="submit" class="btn btn-primary enviar">Enviar</button>

                                                        <a class="btn btn-white" href="ticket_list.php">Cancel</a>

                                                  </div>

                                                </div>

                                            </div>

                                 </fieldset><!--/end form-->

                              </div><!--panel-body-->

                            </div><!--panel-default-->

                          </div> <!--col-->

                            


                                  </div><!--/panel-body-->

                                </div><!--/panel-heading-->



                      </form>

                    </div><!--/finrow-->

                  </div><!--/inbox-->

                </div><!--/content-->

              </div>

                <div class="footer">

                  <div class="pull-right">

                    IZO Corp.

                  </div>

                    <div>

                      <strong>Copyright</strong> IZO Corp &copy; 2015-2016

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

