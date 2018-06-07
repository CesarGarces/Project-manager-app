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

	if(isset($_REQUEST['del']) && $_REQUEST['del'] != 0)
	{
		$actividad = $_REQUEST['del'];
		$sql_actividad = mysql_query("SELECT nombre, id_tipo_contrato FROM sys_tipo_contrato WHERE id_tipo_contrato = ".$_REQUEST['del']);
		$fetch_actividad = mysql_fetch_row($sql_actividad);
	}
	else
	{
		$actividad = 0;
	}
	
	$sql_tipo_acti = mysql_query("SELECT id_tipo_contrato, nombre FROM sys_tipo_contrato");
	
?>
<h3>Eliminar Tipo de Contrato </h3>
<p></p>
<br>
<h4>Estas seguro que deseas eliminar Tipo de Contrato <?php echo $fetch_actividad[0]; ?> ? <h4>
<h5>Esta acción no podrá reversarse en el futuro.</h5>
<br>
<br>
<div align="center">
<a href="configuraciones_maestras.php?action=del&form=contrato&contrato=<?php echo $actividad; ?>&msj=Tipo de Contrato <?php echo $fetch_actividad[0]; ?> Eliminado Satisfactoriamente" type="button" class="btn btn-w-m btn-danger"><i class="fa fa-trash"></i> Eliminar</a> <button type="button" class="btn btn-w-m btn-default" data-dismiss="modal"> Cerrar</button>
</div>