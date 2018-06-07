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

require'../users/class/permisos.php';



$objCon = new Connection();

$objCon->get_connected();

$objUse = new Users();

$objLin = new Permiso();

$list_permiso = $objLin->list_permiso();

$img_users = $objUse->img_users();

?>



<!DOCTYPE html>

<html>



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>IZO | Permisos</title>



    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">

    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">



    <link href="../lib/css/animate.css" rel="stylesheet">

    <link href="../lib/css/style.css" rel="stylesheet">

    <link href="../lib/css/sweetalert.css" rel="stylesheet">

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

                    

                    while($row=mysql_fetch_array($img_users)){?>

                    

                 

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

                <li class="active">

                    <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Ajustes</span> <span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level collapse">

                        <li><a href="user_list.php">Usuarios</a></li>

                        <li><a href="rol_list.php">Roles</a></li>

                        <li><a href="lineas_list.php">Lineas</a></li>

                        <li  class="active"><a href="permisos_list.php">Permisos</a></li>

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

                    <h2>Administración de Permisos de Operación</h2>

                    <ol class="breadcrumb">

                        <li>

                            <a href="panel.php">Inicio</a>

                        </li>

                        

                        <li class="active">

                            <strong>Permisos de operación</strong>

                        </li>

                    </ol>

                </div>

            </div>

        <div class="wrapper wrapper-content  animated fadeInRight">

            <div class="ibox">

                <div class="ibox-title">

                            <h5>Listado de Permisos</h5>

                            <div class="ibox-tools">

                                <a href="new_permiso.php" class="btn btn-primary btn-xs">Nuevo permiso de operación</a>

                            </div>

                    </div>

                <div class="ibox-content">                  

                        <div class="tab-content">

                            <div id="tab-1" class="tab-pane active">

                                <div class="full-height-scroll">

                                    <div class="table-responsive">                                          

                                        <table class="table table-striped table-hover" data-page-size="15" style="font-size: small;">

                        <thead>

                            <tr>

                                <th>Nombre</th>  

                                <th>Usuario Crea</th>

                                <th>Usuario Modifica</th>                             

                                <th>Acciones</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

            

                $numrows = mysql_num_rows($list_permiso);

                

                if($numrows > 0){

                    

                    while($row=mysql_fetch_array($list_permiso)){

                        $id_permiso = $row["id_permiso"];

                       



                        ?>

                                    <tr>

                                        <td>

                                            <?php echo $row["nombre"];?>

                                        </td> 

                                        <td>

                                            <?php echo $row["usuario_crea"];?>

                                        </td>

                                        <td>

                                            <?php echo $row["usuario_modifica"];?>

                                        </td>                                 

                                        

                                        <td class="project-actions">

                                                <a href="modify_permiso.php?id_permiso=<?php echo $id_permiso;?>" class="btn btn-xs btn-warning glyphicon glyphicon-pencil" title="Editar"></a>

                                                <a href="#" id="<?php echo $id_permiso;?>" class="btn btn-xs btn-danger glyphicon glyphicon-trash btn-sm demo4" title="Eliminar"></a>  

                                        </td>

                                    </tr>

                                    <?php

                    }

                    

                }

            

                ?>

                        </tbody>

                        <tfoot>

                            <tr>

                                <td colspan="9">

                                    <ul class="pagination pull-right"></ul>

                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>

    </div>

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

<script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>





    $(document).ready(function () {



        $('.demo4').click(function () {

            var numero = $(this).attr("id");

            swal({

                        title: "Esta seguro?",

                        text: "El dato sera eliminado!",

                        type: "warning",

                        showCancelButton: true,

                        confirmButtonColor: "#DD6B55",

                        confirmButtonText: "Si, Borrar!",

                        cancelButtonText: "No, cancelar!",

                        closeOnConfirm: false,

                        closeOnCancel: false },

                    function (isConfirm) {

                        if (isConfirm) {



                            swal("Eliminado!", "El dato fue eliminado.", "success");

                            setTimeout(function() {

                                 window.location = 'delete_permiso.php?id_permiso='+numero;



                            }, 1300);

                                                              

                        } else {

                            swal("Cancelado", "El dato esta a salvo :)", "error");

                        }

                    });



        });

       

    });







</script>

</body>



</html>

