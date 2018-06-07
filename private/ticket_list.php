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
require'../users/class/reportes.php';
$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objLin = new Reporte();

$list_reporte_inicial = mysql_query("SELECT * FROM sys_tickets");
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();

$row_rol=mysql_fetch_array($img_roles);
$id_rol = $row_rol['id_rol'];

date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
$fecha_a=date('Y');
$mes_a=date('m');
/*************** Parametros ***************/
$taller = isset($_REQUEST['taller']) ? $_REQUEST['taller'] : null ;
$ciudad = isset($_REQUEST['ciudad']) ? $_REQUEST['ciudad'] : null ;
$siniestro = isset($_REQUEST['siniestro']) ? $_REQUEST['siniestro'] : null ;
$mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : $mes_a ;
$ano = isset($_REQUEST['ano']) ? $_REQUEST['ano'] : $fecha_a ;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IZO | Lista de Tickets</title>
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
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
                    
                                    while($row=mysql_fetch_array($img_users)){
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
                
                <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">

                        <h5>Lista de Tickets</h5>
                         <div class="ibox-tools">

                                <a href="new_ticket.php" class="btn btn-primary btn-xs">Nuevo Ticket</a>

                            </div>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Detalles</th>
                        <th>Area Responsable</th>
                        <th>Estado</th>
                        <th>Urgencia</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                    while($list=mysql_fetch_array($list_reporte_inicial))
					{
?> 
                                    <tr>
                                        <td>
                                            <?php echo $list["nombre_genera"];?>
                                        </td> 
                                        <td>
                                            <?php echo $list["empresa_genera"];?>
                                        </td>
                                        <td>
                                            <?php echo $list["detalles"];?>
                                        </td> 
                                        <td>
                                            <?php echo $list["area"];?>
                                        </td> 
                                        <td>
                                            <?php echo $list["estado"];?>
                                        </td> 
                                        <td>
                                            <?php echo $list["urgencia"];?>
                                        </td>   
                                        <td>
                                            <?php echo $list["fecha_creacion"];?>
                                        </td> 
                                        <td>
                                            <a href="ticket.php?id_ticket=<?php echo $list["id_ticket"];?>" class="btn btn-primary btn-xs">revisar</a>
                                        </td> 
                                                                                                                 
                                    </tr>
                                    <?php
                                }
            
                ?>
                    
                    </tfoot>
                    </table>
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
<script src="../lib/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="../lib/js/inspinia.js"></script>
<script src="../lib/js/plugins/pace/pace.min.js"></script>
<script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'reporte_Inicial'},
                    {extend: 'pdf', title: 'reporte_Inicial'},
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]
            });
                        / Init DataTables /
            var oTable = $('#editable').DataTable();
    });
</script>
</body>
</html>
