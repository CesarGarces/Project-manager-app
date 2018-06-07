<?php
error_reporting(0);
$link = mysql_connect('localhost', 'root', 'IZ0.r1c0pap1r1c0')
    or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('izoboard_izo') or die('No se pudo seleccionar la base de datos');
?>
<option value="">Seleccione la Actividad</option>
<?php  
	$lista_actividad = mysql_query("SELECT id_sys_actividades, nombre FROM sys_actividades WHERE id_tipo_actividad = ".$_REQUEST["param"]);
	while($fetch_actividad = mysql_fetch_array($lista_actividad)){ 
		if($fetch_actividad[0] == $_REQUEST['modf'] && $_REQUEST['modf'] != 0)
		{
	?>
	<option selected value="<?php echo $fetch_actividad[0]; ?>"><?php echo $fetch_actividad[1]; ?></option>  
		<?php } else { ?>
    <option value="<?php echo $fetch_actividad[0]; ?>"><?php echo $fetch_actividad[1]; ?></option>  
                                                 
	<?php } }?>