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

	if(isset($_REQUEST['act']) && $_REQUEST['act'] != 0)
	{
		$actividad = $_REQUEST['act'];
		$sql_actividad = mysql_query("SELECT ep.id_empleado_perfil_proyecto, e.id_usuario, u.primer_nombre nom_empleado, p.nombre nom_proyecto FROM sys_empleado_perfil_proyectos ep, sys_proyectos p, sys_usuarios u, sys_empleados e where e.id_usuario = u.id_usuario AND ep.id_proyecto = p.id_proyecto AND ep.id_empleado = e.id_empleado AND ep.id_empleado_perfil_proyecto = ".$_REQUEST['act']);
		$fetch_actividad = mysql_fetch_row($sql_actividad);
	}
	else
	{
		$actividad = 0;
	}
	
	$sql_tipo_acti = mysql_query("SELECT id_empleado, id_usuario FROM sys_empleados");
	$sql_proyectos = mysql_query("SELECT id_proyecto, nombre FROM sys_proyectos");
	
?>
<h3>Activar Asignacion </h3>
<p></p>
<br>
<h4>Estas seguro que deseas Activar la asignacion Empleado: <?php echo $fetch_actividad[2]; ?>  Proyecto: <?php echo $fetch_actividad[3]; ?> ? <h4>
<br>
<br>
<div align="center">
<a href="seguimiento.php?action=act&form=asignacion&asignacion=<?php echo $actividad; ?>&msj=Asignacion Empleado: <?php echo $fetch_actividad[2]; ?>  Proyecto: <?php echo $fetch_actividad[3]; ?> Activado Satisfactoriamente" type="button" class="btn btn-w-m btn-primary"><i class="fa fa-unlock"></i> Activar</a> <button type="button" class="btn btn-w-m btn-default" data-dismiss="modal"> Cerrar</button>
</div>