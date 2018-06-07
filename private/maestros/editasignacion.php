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

	if(isset($_REQUEST['mod']) && $_REQUEST['mod'] != 0)
	{
		$actividad = $_REQUEST['mod'];
		$sql_actividad = mysql_query("SELECT * FROM sys_empleado_perfil_proyectos WHERE id_empleado_perfil_proyecto = ".$_REQUEST['mod']);
		$fetch_actividad = mysql_fetch_row($sql_actividad);
	}
	else
	{
		$actividad = 0;
	}
	
	$sql_tipo_acti = mysql_query("SELECT e.id_empleado, e.id_usuario, CONCAT(u.primer_nombre,' ',u.primer_apellido) nombres FROM sys_empleados e, sys_usuarios u where e.id_usuario = u.id_usuario ORDER BY u.primer_nombre ASC");
	$sql_proyectos = mysql_query("SELECT p.id_proyecto, p.nombre FROM sys_proyectos p ORDER BY p.nombre ASC");
	$sql_perfil = mysql_query("SELECT p.id_perfil, p.nombre FROM sys_perfiles p");
	$sql_duracion = mysql_query("SELECT td.id_tipo_duracion, td.nombre FROM sys_tipos_duraciones td");
	
?>
<h3>Asignaciones </h3>
<form id="formularioasignacion" action="seguimiento.php?action=new&msj=Asignación <?php echo $fetch_actividad[0]; ?> Creada Satisfactoriamente&form=asignacion" method="post">
	<table width="100%">
		<tr width="100%">
			<td width="50%">
				<div class="form-group"><label>Empleado</label> 
					<select class="form-control m-b" name="empleado" required>
						<option value="">Seleccione Empleado</option>
						<?php
						while($fetch_tipo_acti = mysql_fetch_array($sql_tipo_acti))
						{
							if($fetch_actividad[1] == $fetch_tipo_acti[0])
							{
						?>
						<option selected value="<?php echo $fetch_tipo_acti[0]; ?>"><?php echo $fetch_tipo_acti[2]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_tipo_acti[0]; ?>"><?php echo $fetch_tipo_acti[2]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
			</td>
		</tr>
		<tr>
			<td width="50%">
				<div class="form-group"><label>Perfil</label> 
					<select class="form-control m-b" name="perfil" required>
						<option value="">Seleccione Perfil</option>
						<?php
						while($fetch_perfil = mysql_fetch_array($sql_perfil))
						{
							
							?>
						<option value="<?php echo $fetch_perfil[0]; ?>"><?php echo $fetch_perfil[1]; ?></option>	
							<?php	
							}
						
						?>
					</select></div>
			</td>
		</tr>
		<tr>
			<td width="50%">
				<div class="form-group"><label>Proyecto</label> 
					<select class="form-control m-b" name="proyecto" required>
						<option value="">Seleccione Proyecto</option>
						<?php
						while($fetch_proyectos = mysql_fetch_array($sql_proyectos))
						{
							if($fetch_actividad[1] == $fetch_proyectos[1])
							{
						?>
						<option selected value="<?php echo $fetch_proyectos[0]; ?>"><?php echo $fetch_proyectos[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_proyectos[0]; ?>"><?php echo $fetch_proyectos[1]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
			</td>
		</tr>
		<tr>
			<td width="50%">
				<div class="form-group"><label>Duración</label> 
					<input type="text" class="form-control m-b" name="cant_duracion" required>
					<select class="form-control m-b" name="duracion" required>
						<option>Seleccione la Duración</option>
						<?php
						while($fetch_duracion = mysql_fetch_array($sql_duracion))
						{
							
							?>
						<option value="<?php echo $fetch_duracion[0]; ?>"><?php echo $fetch_duracion[1]; ?></option>	
							<?php	
							}
						
						?>
					</select></div>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan="2" align="center"><button type="submit" class="btn btn-outline btn-primary">Guardar</button></td>
		</tr>
	</table>
</form>