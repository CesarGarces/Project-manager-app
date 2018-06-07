<?php
error_reporting(0);
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

date_default_timezone_set('America/Bogota');

$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objPan = new Panel();
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();

$row_rol=mysql_fetch_array($img_roles);
$id_rol = $row_rol['id_rol'];
$id_user = $row_rol['id_usuario'];

// Empleado
$emp_query = mysql_query("SELECT id_empleado FROM sys_empleados WHERE id_usuario = ".$id_user);
$fetch_emp = mysql_fetch_row($emp_query);

$empleado = $fetch_emp[0];

//Proyecto
$proyecto_sel = mysql_query("SELECT nombre FROM sys_proyectos WHERE id_proyecto = ".$_REQUEST['proyecto']."");
$fetch_proyecto_Sel = mysql_fetch_row($proyecto_sel);

$proyecto = $fetch_proyecto_Sel[0];

//Usuario
$usr_query = mysql_query("SELECT CONCAT(primer_nombre,' ',primer_apellido) nombre FROM sys_usuarios WHERE id_usuario = $id_user");
$fetch_usr = mysql_fetch_row($usr_query);

$nombreUsuario = $fetch_usr[0];


if(isset($_REQUEST['express']))
{
	$hini = date('H:i:s', ($_REQUEST['hini']/1000));
	$hfin = date('H:i:s', ($_REQUEST['hfin']/1000));

	$sql = "INSERT INTO pjc_seguimiento_actividades VALUES (
    NULL,
    '".$empleado."',
    '".$_REQUEST['proyecto']."',
    '".$_REQUEST['actividad']."',
    '',
    now(),
    '".$hini."',
    '".$hfin."',
    now()
    )";
}
else
{
	if(!isset($_REQUEST['modf']))
	{
		// Si es Nuevo el Seguimiento
		$sql = "INSERT INTO pjc_seguimiento_actividades VALUES (
		NULL,
		'".$_REQUEST['id_empleado']."',
		'".$_REQUEST['proyecto']."',
		'".$_REQUEST['actividad']."',
		'".$_REQUEST['detalle']."',
		'".$_REQUEST['fecha']."',
		'".$_REQUEST['hini']."',
		'".$_REQUEST['hfin']."',
		now()
		)";
	}
	else
	{
	// Si vamos a actualizar uno existente
		$sql = "UPDATE pjc_seguimiento_actividades SET id_proyecto = '".$_REQUEST['proyecto']."', id_actividad = '".$_REQUEST['actividad']."', detalle = '".$_REQUEST['detalle']."', fecha_actividad = '".$_REQUEST['fecha']."', hora_ini = '".$_REQUEST['hini']."', hora_fin = '".$_REQUEST['hfin']."', fecha_diligencia = now() WHERE id_seguimiento_actividad = ".$_REQUEST['modf'];
	}
}

$result = mysql_query($sql);
//echo $_REQUEST['express'];
//Insert de la notificación para el panel	

if(isset($_REQUEST['express']))
{
$sql_notificacion_ex = mysql_query("INSERT INTO sys_notificaciones VALUES(NULL,".$empleado.",".$_REQUEST['proyecto'].",'<b>".$nombreUsuario."</b> ha ingresado un seguimiento Express del proyecto <b>".$proyecto."</b>','',now(),".$empleado.")");	
header('Location: dashboard.php?creado=1');
}
else
{
	if(!isset($_REQUEST['modf']))
	{
		$sql_notificacion = mysql_query("INSERT INTO sys_notificaciones VALUES(NULL,".$empleado.",".$_REQUEST['proyecto'].",'<b>".$nombreUsuario."</b> ha ingresado un seguimiento del proyecto <b>".$proyecto."</b>','".$_POST['detalle']."',now(),".$empleado.")");		
		header('Location: seguimiento.php?creado=1');
	}
	else
	{
		$sql_notificacion = mysql_query("INSERT INTO sys_notificaciones VALUES(NULL,".$empleado.",".$_REQUEST['proyecto'].",'<b>".$nombreUsuario."</b> ha Actualizado un seguimiento de ".$_REQUEST['fecha']." en el proyecto <b>".$proyecto."</b>','".$_POST['detalle']."',now(),".$empleado.")");		
		header('Location: seguimiento.php?creado=1');
	}
}


//proyectos -- quejas-- demo sms
?>

