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



$userid = $_GET['id_usuario'];



$objCon = new Connection();

$objCon->get_connected();

$objUse = new Users();

$img_users = $objUse->img_users();

$users_rol = $objUse->users_rol();

$single_user = $objUse->single_user($userid);

?>

<!DOCTYPE html>

<html>



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>IZO | Modificar Usuario</title>



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

                                       $idusuario = $row['id_usuario'];

                                       

                                 ?>                

                           <span>

                            <img alt="image" width="48" height="48" class="img-circle" src="<?php echo $row['imagen']; ?>">

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

                <li class="active">

                    <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Ajustes</span> <span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level collapse">

                        <li class="active"><a href="user_list.php">Usuarios</a></li>

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

                    <a href="sms.php"><i class="fa fa-phone-square"></i> <span class="nav-label">SMS</span><span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level collapse">

                        <li><a href="sms-masivo.php">Envìo masivo SMS</a></li>

                        <li><a href="reporte-contactabilidad.php">Reporte de contactabilidad</a></li>

                        <li><a href="reporte-respuesta.php">Reporte de respuesta de clientes</a></li>

                        

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

                    <h2>Modificar usuario</h2>

                    <ol class="breadcrumb">

                        <li>

                            <a href="panel.php">Inicio</a>

                        </li>

                        <li>

                            <a href="user_list.php">Usuarios</a>

                        </li>

                        

                        <li class="active">

                            <strong>Modificar usuario</strong>

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

                      <form role="form" action="modify_user_exe.php" method="post" enctype="multipart/form-data" >

                        <?php

                          $numrows = mysql_num_rows($single_user);                

                            if($numrows > 0){

                              while($list=mysql_fetch_array($single_user)){ 

                                $img_user = $list['imagen'];

                                

                                ?>

                                <input type="hidden"  name="id_usuario" value="<?php echo $userid;?>">

                                  <div class="col-sm-4">

                                    <div style="top: 9px; position: fixed; left: 2px;">

                                      <?php 

                                            if($img_user =="../users/user/img/"){?>

                                                <img src= "../users/user/img/no_img.png" class="img-circle" width="48" height="48">

                                            <?php }else{?>

                                                 <img src= "<?php echo $img_user;?>" class="img-circle" width="48" height="48">



                                            

                                    </div>

                                    <div class="panel panel-default">

                                      <div class="panel-heading"><h3 class="panel-title">Caracterísitcas Básicas</h3></div>

                                        <div class="panel-body">

                                          <fieldset>

                                            <div class="row">

                                              <div class="col-md-6">

                                                <div class="control-group">

                                                  <label label-default="" class="control-label">Identificación *</label>

                                                    <div class="controls">

                                                      <input type="hidden"  name="id_usuario_modifica" value="<?php echo $idusuario ?>">

                                                      <input type="text" class="form-control"  title="Identificación" required  name="identificacion" value="<?php echo $list['doc_user'];?>">

                                                    </div>

                                                </div>

                                              </div><!--col-->

                                            <div class="col-md-6">

                                              <div class="control-group">

                                                <label label-default="" class="control-label">Tipo Identificación *</label>

                                                  <div class="controls">

                                                    <select class="form-control required m-b valid" name="TipoIdentificacion" required >

                                                      <option selected value="<?php echo $list['id_tipo'];?>"><?php echo $list['sigla'];?></option>

                                                      <option value="1">CC</option>

                                                      <option value="2">Pasaporte</option>

                                                      <option value="3">Contraseña</option>

                                                    </select>

                                                  </div>

                                              </div>

                                            </div><!--col-->

                                            </div><!--row-->

                                             

                    <div class="row">

                      <div class="col-md-12">

                         <div class="control-group">

                            <label label-default="" class="control-label">Empresa *</label>

                            <div class="controls">

                                <select class="form-control required m-b valid" name="Empresa" required>

                                    <option selected value="<?php echo $list['id_empresa'];?>"><?php echo $list['razon_social'];?></option>

                                    <option value="1">IZO</option>

                                    <option value="2">Tecniseguros</option>

                                </select>

                            </div>

                        </div>

                      </div><!--col-->

                      

                  </div>

                  <div class="row">

                      <div class="col-md-6">

                         <div class="control-group">

                            <label label-default="" class="control-label">Rol *</label>

                            <div class="controls">

                                              

                        

                    <select class="form-control required m-b valid" name="Rol" required>

                                    <option selected value="<?php echo $list['id_rol'];?>"><?php echo $list['nom_rol'];?></option>

                                   

                                    <?php

                                $numrows = mysql_num_rows($users_rol);

                

                if($numrows > 0){

                    

                    while($rol=mysql_fetch_array($users_rol)){ ?>

                                    <option value="<?php echo $rol['idRol'];?>"><?php echo $rol['rol'];?></option>

                                    

                                

                                <?php

                            }

                        }

                        ?>

                    </select>

                            </div>

                        </div>

                      </div><!--col-->

                    

                    

                      <div class="col-md-6">

                         <div class="control-group">

                            <label label-default="" class="control-label">Estado *</label>

                            <div class="controls">

                                <select class="form-control required m-b valid" id="Estado" name="Estado" aria-required="true" aria-invalid="false">

                                  <?php $estado_usuario = $list['estado'];

                                  if ( $estado_usuario ==1){

                                    $estado_usuario ="Activo";

                                  }else{

                                    $estado_usuario ="Inactivo";

                                  }

                                  ?>

                                    <option selected value="<?php echo $list['estado'];?>"><?php echo $estado_usuario;?></option>

                                    <option value="1">Activo</option>

                                    <option value="2">Inactivo</option>

                                </select>

                            </div>

                        </div>

                      </div><!--col-->

                      <div class="col-md-6">

                         <div class="control-group">

                            <label label-default="" class="control-label">Estado Civil</label>

                                <select class="form-control required m-b valid" id="Estado" name="EstadoCivil" aria-required="true" aria-invalid="false">                                 

                                    <option selected value="<?php echo $list['estado_civil'];?>"><?php echo $list['estado_civil'];?></option>

                                    <option value="Casado">Casado</option>

                                    <option value="Soltero">Soltero</option>

                                    <option value="Viudo">Viudo</option>

                                </select>

                               

                        </div>

                      </div><!--col-->

                     

                      <div class="col-md-6">

                         <div class="control-group">

                            <label label-default="" class="control-label">Genero *</label>

                            <div class="controls">

                                <select class="form-control required m-b valid" id="Genero" name="Genero" aria-required="true" aria-invalid="false">

                                    <option selected value="<?php echo $list['genero'];?>"><?php echo $list['genero'];?></option>

                                    <option value="Masculino">Masculino</option>

                                    <option value="Femenino">Femenino</option>      

                                </select>

                            </div>

                        </div>

                      </div><!--col-->

                      

                    </div><!--row-->



<?php

                                              }



                                         ?>



                </fieldset><!--/end payment form-->

            </div><!--panel-body-->

        </div>



     </div> <!--col-->

     

      <div class="col-sm-4">

        <div class="panel panel-default">

              <div class="panel-heading clearfix">

                <h3 class="panel-title">Cuenta</h3>

              </div>

              <div class="panel-body">



              <fieldset>

                <div class="row">

                  <div class="col-md-12">

                    <div class="control-group">

                        <label label-default="" class="control-label">Nombre de inicio de sesion *</label>

                        <div class="controls">

                            <input type="text" class="form-control"  title="login" required name="Login" value="<?php echo $list['login'];?>">

                        </div>

                    </div>

                  </div>

                  <div class="col-md-12">

                  <div class="control-group">

                      <label label-default="" class="control-label">Clave *</label>

                      <div class="controls">

                          <input type="password" class="form-control"  title="clave" required name="pass" value="<?php echo $list['password'];?>">

                      </div>

                  </div>

                </div>

                <div class="col-md-12">

                  <div class="control-group">

                      <label label-default="" class="control-label">Correo *</label>

                      <div class="controls">

                        <div class="input-group m-b">

                          <span class="input-group-addon">@</span>

                          <input type="mail" title="email" name="Email" placeholder="ejemplo@ejemplo.com" required class="form-control" value="<?php echo $list['email'];?>">

                        </div>                

                      </div>

                  </div>

                </div>

              </div>



            







          </fieldset>

        </div><!--/panel-body-->

      </div><!--/panel-default-->

  </div>



<fieldset>

      <div class="panel panel-default">

              <div class="panel-heading clearfix">

                <h3 class="panel-title">Información Personal</h3>

              </div>

              <div class="panel-body">



              <fieldset>

            <div class="row">

                <div class="col-md-6">

                  <div class="control-group">

                      <label label-default="" class="control-label">Primer Nombre *</label>

                      <div class="controls">

                          <input type="text" class="form-control" title="primer nombre" required name="PrimerNombre" value="<?php echo $list['primer_nombre'];?>">

                      </div>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="control-group">

                      <label label-default="" class="control-label">Segundo Nombre</label>

                      <div class="controls">

                          <input type="text" class="form-control"  title="segindo nombre" name="SegundoNombre" value="<?php echo $list['segundo_nombre'];?>">

                      </div>

                  </div>

                </div>

              </div><!--/row-->

              <div class="row">

                <div class="col-md-6">

                  <div class="control-group">

                      <label label-default="" class="control-label">Primer Apellido *</label>

                      <div class="controls">

                          <input type="text" class="form-control" title="Primer Apellido" required="" name="PrimerApellido" value="<?php echo $list['primer_apellido'];?>">

                      </div>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="control-group">

                      <label label-default="" class="control-label">Segundo Apellido</label>

                      <div class="controls">

                          <input type="text" class="form-control" title="fSegundo Apellido"  name="SegundoApellido" value="<?php echo $list['segundo_apellido'];?>">

                      </div>

                  </div>

                </div>

              </div><!--/row-->

              <div class="row">

                <div class="col-md-6">

                  <div class="control-group">

                      <label label-default="" class="control-label">Celular *</label>

                      <div class="controls">

                          <input type="text" class="form-control" title="Celular" required="" name="Celular" value="<?php echo $list['celular'];?>">

                      </div>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="control-group">

                      <label label-default="" class="control-label">Teléfono</label>

                      <div class="controls">

                          <input type="text" class="form-control" title="Teléfono"  name="Telefono" value="<?php echo $list['telefono'];?>">

                      </div>

                  </div>

                </div>

              </div><!--/row-->

              <div class="row">

                <div class="col-md-12">

                  <div class="control-group">

                      <label label-default="" class="control-label">Dirección</label>

                      <div class="controls">

                          <input type="text" class="form-control" title="Dirección" name="Direccion" value="<?php echo $list['direccion'];?>">

                      </div>

                  </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                  <div class="control-group">

                      <label label-default="" class="control-label">Fecha Nacimiento *</label>

                      <div class="controls">

                        <input class="form-control required m-b" data-val="true" data-val-date="The field FechaNacimiento must be a date." id="FechaNacimiento" name="FechaNacimiento" type="date" value="<?php echo $list['fecha_nacimiento'];?>" required>                       

                      </div>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="control-group">

                    

                      <label label-default="" class="control-label">Imagen</label>

                      <div class="controls">

                        <input type="hidden"  name="imagen" value="<?php echo $list['imagen'];?>">

                          <input type="file" name="cambiar_imagen" value="Cambiar Imagen" />

                      </div>

                  </div>

                </div>

              </div><!--/row-->





            <div class="row">

                 <div class="col-md-3">



                 </div>

                 <div class="col-md-9">

                     <div class="controls pull-right">

                         <button type="submit" class="btn btn-primary enviar">Guardar</button>

                         <a class="btn btn-white" href="user_list.php">Cancel</a>

                     </div>

                 </div>

            </div>

          </fieldset>

                                  </div><!--/panel-body-->

                                </div><!--/panel-heading-->

                                    <?php

                                  }

                                }

                                ?>

                      </form>

                    </div><!--/finrow-->

                  </div><!--/inbox-->

                </div><!--/content-->

              </div>

            </div>

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

