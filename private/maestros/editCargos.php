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
		$cargo = $_REQUEST['mod'];
		$sql_cargo = mysql_query("SELECT nombre,  id_dependencia FROM sys_cargos WHERE id_cargo = ".$_REQUEST['mod']);
		$fetch_cargos = mysql_fetch_row($sql_cargo);
	}
	else
	{
		$cargo = 0;
	}
	
	$sql_dependencias = mysql_query("SELECT id_dependencia, nombre FROM sys_dependencias");
	
?>
<h3>Cargos </h3>
<form id="formularioCargos" action="<?php if($cargo != 0){ ?>configuraciones_maestras.php?action=mod&form=cargos&msj=Cargo <?php echo $fetch_cargos[0]; ?> Modificado Satisfactoriamente&cargo=<?php echo $cargo; } else { ?>configuraciones_maestras.php?action=new&msj=Cargo <?php echo $fetch_cargos[0]; ?> Creado Satisfactoriamente&form=cargos <?php }?>" method="post">
	<table width="100%">
		<tr width="100%">
			<td width="50%">
				<div class="form-group"><label>Dependencia</label> 
					<select class="form-control m-b" name="dependencia" required>
						<option>Seleccione la Dependencia</option>
						<?php
						while($fetch_dependencias = mysql_fetch_array($sql_dependencias))
						{
							if($fetch_cargos[1] == $fetch_dependencias[0])
							{
						?>
						<option selected value="<?php echo $fetch_dependencias[0]; ?>"><?php echo $fetch_dependencias[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_dependencias[0]; ?>"><?php echo $fetch_dependencias[1]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
			</td>
			<td width="50%">
				<div class="form-group"><label>Nombre Cargo</label> <input type="text" required placeholder="Ingrese el Nombre del Cargo" name="nombrecargo" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_cargos[0]; }else{ echo ""; } ?>"></div>
				
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan="2" align="center"><button type="submit" class="btn btn-outline btn-primary">Guardar</button></td>
		</tr>
	</table>
</form>