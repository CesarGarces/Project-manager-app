<?php
$link = mysql_connect('localhost', 'root', 'IZ0.r1c0pap1r1c0')
or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('izoboard_izo') or die('No se pudo seleccionar la base de datos');

$sol = isset($_REQUEST['sol']) ? $_REQUEST['sol'] : '0' ;
$estado = '';

if($sol == '0'){
	$estado = $_REQUEST['estado'];
}else{
	$estado = 'Concluido';
}

$query = "UPDATE  sys_tickets SET estado = '".$estado."' WHERE id_ticket = '".$_REQUEST['id_ticket']."'  ";
$result = mysql_query($query);
$query2 = "UPDATE  sys_tickets_resp SET contesta = '".$_REQUEST['respuesta']."', id_contesta = '".$_REQUEST['id_usuario_responde']."', fecha_contesta = now() WHERE id_ticket = '".$_REQUEST['id_ticket']."'  ";
$result = mysql_query($query2);


 
header('Location: ticket_list.php');

?>