<?php
$link = mysql_connect('localhost', 'root', 'IZ0.r1c0pap1r1c0')
or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('izometrics_izo_co') or die('No se pudo seleccionar la base de datos');


$id_izo = $_POST['id_izo'];
$id_encuesta = $_POST['id_enc'];

$query = "UPDATE evaluacion_cem set 
estado = 'Encuesta Efectiva', 
fecha_evaluacion = now(),  
resp1 = '".$_POST['resp1']."',
resp2 = '".$_POST['resp2']."',
resp3 = '".$_POST['resp3']."',
resp4 = '".$_POST['resp4']."',
resp5 = '".$_POST['resp5']."',
resp6 = '".$_POST['resp6']."',
resp7 = '".$_POST['resp7']."',
resp8 = '".$_POST['resp8']."',
resp9 = '".$_POST['resp9']."',
resp10 = '".$_POST['resp10']."',
resp11 = '".$_POST['resp11']."',
resp12 = '".$_POST['resp12']."',
resp13 = '".$_POST['resp13']."',
resp14 = '".$_POST['resp14']."',
resp15 = '".$_POST['resp15']."',
resp16 = '".$_POST['resp16']."',
resp17 = '".$_POST['resp17']."',
resp18 = '".$_POST['resp18']."',
resp19 = '".$_POST['resp19']."',
resp20 = '".$_POST['resp20']."'
where id_izo = '".$id_izo."' and id_encuesta = '".$id_encuesta."'";


$result = mysql_query($query);

header('Location: evaluacion_cem.php?id_izo='.$id_izo.' ');

?>