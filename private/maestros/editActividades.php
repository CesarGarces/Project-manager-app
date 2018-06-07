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
		$sql_actividad = mysql_query("SELECT nombre, id_tipo_actividad FROM sys_actividades WHERE id_sys_actividades = ".$_REQUEST['mod']);
		$fetch_actividad = mysql_fetch_row($sql_actividad);
	}
	else
	{
		$actividad = 0;
	}
	
	$sql_tipo_acti = mysql_query("SELECT id_tipo_actividad, nombre FROM sys_tipo_actividades");
	
?>
<h3>Actividades </h3>
<form id="formularioActividades" action="<?php if($actividad != 0){ ?>configuraciones_maestras.php?action=mod&form=actividades&msj=Actividad <?php echo $fetch_actividad[0]; ?> Modificado Satisfactoriamente&actividad=<?php echo $actividad; } else { ?>configuraciones_maestras.php?action=new&msj=Actividad <?php echo $fetch_actividad[0]; ?> Creada Satisfactoriamente&form=actividades <?php }?>" method="post">
	<table width="100%">
		<tr width="100%">
			<td width="50%">
				<div class="form-group"><label>Tipo de Actividad</label> 
					<select class="form-control m-b" name="tipoactividad">
						<option>Seleccione tipo de Actividad</option>
						<?php
						while($fetch_tipo_acti = mysql_fetch_array($sql_tipo_acti))
						{
							if($fetch_actividad[1] == $fetch_tipo_acti[0])
							{
						?>
						<option selected value="<?php echo $fetch_tipo_acti[0]; ?>"><?php echo $fetch_tipo_acti[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_tipo_acti[0]; ?>"><?php echo $fetch_tipo_acti[1]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
			</td>
			<td width="50%">
				<div class="form-group"><label>Nombre Actividad</label> <input required type="text" placeholder="Ingrese el Nombre de Actividad" name="nombreactividad" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_actividad[0]; }else{ echo ""; } ?>"></div>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan="2" align="center"><button type="submit" class="btn btn-outline btn-primary">Guardar</button></td>
		</tr>
	</table>
</form>