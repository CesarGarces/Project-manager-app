<?php
$link = mysql_connect('localhost', 'root', 'IZ0.r1c0pap1r1c0')
or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('izoboard_izo') or die('No se pudo seleccionar la base de datos');

$celular = $_POST['celular'];

$query = "UPDATE enc_curso_cem_reco set 
estado = 'Encuesta Efectiva', 
fecha_enc = now(),  
enc1 = '".$_POST['enc1']."',
enc2 = '".$_POST['enc2']."',
enc3 = '".$_POST['enc3']."',
enc4 = '".$_POST['enc4']."',
enc5 = '".$_POST['enc5']."',
enc6 = '".$_POST['enc6']."',
enc7 = '".$_POST['enc7']."',
enc8 = '".$_POST['enc8']."'
where celular = '".$celular."' ";

$result = mysql_query($query);

header('Location: http://izo.es');

?>