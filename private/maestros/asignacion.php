<?php
error_reporting(0);
require'../../users/class/sessions.php';
$objses = new Sessions();
$objses->init();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
   header('Location: ../../index.php?error=2');
}

require'../../users/class/config.php';
require'../../users/class/users.php';
require'../../users/class/dbactions.php';
require'../../users/class/panel.php';

$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objPan = new Panel();
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();

$row_rol=mysql_fetch_array($img_roles);
$id_rol = $row_rol['id_rol'];

date_default_timezone_set('America/Bogota');
$fini=date('Y-m-01');
$fifin=date('Y-m-s');
$fecha=date('Y-m-d');

$sql_actividades = mysql_query("SELECT ep.id_empleado_perfil_proyecto, e.id_usuario, u.primer_nombre nom_empleado, p.nombre nom_proyecto FROM sys_empleado_perfil_proyectos ep, sys_proyectos p, sys_usuarios u, sys_empleados e where e.id_usuario = u.id_usuario AND ep.id_perfil_proyecto = p.id_proyecto AND e.id_usuario = ep.id_empleado");
?>
<table class="table table-bordered" width="100%">
    <thead>
    <tr width="100%">
        <th width="5%">#</th>
		<th width="30%">Nombre</th>
        <th width="45%">Proyecto</th>
        <th width="10%">Modificar</th>
        <th width="10%">Eliminar</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contador =0;
	while($fetch_actividades = mysql_fetch_array($sql_actividades))
	{	
    $contador ++;	
	?>
	<tr>
        <td style="vertical-align:middle;"><?php echo $contador; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_actividades['nom_empleado']; ?></td>
		<td style="vertical-align:middle;"><?php echo $fetch_actividades['nom_proyecto']; ?></td>
        <td align="center"><a onclick="editAsignacion(<?php echo $fetch_actividades["id_empleado_perfil_proyecto"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Actividad" style="text-decoration:none;color:white;" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a></td>
        <td align="center"><a onclick="deleteAsignacion(<?php echo $fetch_actividades["id_empleado_perfil_proyecto"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Eliminar Actividad" style="text-decoration:none;color:white;" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a><br></td>
    </tr>
    <?php
	}
	?>
	
    </tbody>
</table>