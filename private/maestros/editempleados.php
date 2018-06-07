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
		$sql_cargo = mysql_query("SELECT * FROM sys_empleados WHERE id_empleado = ".$_REQUEST['mod']);
		$fetch_cargos = mysql_fetch_row($sql_cargo);
		
		$sql_nom_usu = mysql_query("SELECT CONCAT(u.primer_nombre,' ', u.primer_apellido) nombres FROM sys_usuarios u WHERE u.id_usuario = ".$fetch_cargos[1]);
		$fetch_usu_name = mysql_fetch_row($sql_nom_usu);
		$sql_dependencias = mysql_query("SELECT * FROM sys_usuarios");
	}
	else
	{
		$sql_dependencias = mysql_query("SELECT * FROM sys_usuarios WHERE id_usuario NOT IN (SELECT id_usuario FROM sys_empleados)");
		
		$cargo = 0;
	}
	
	
	$sql_pais = mysql_query("SELECT * FROM sys_paises ");
	$sql_cargoE = mysql_query("SELECT * FROM sys_cargos ");
	$sql_contrato = mysql_query("SELECT * FROM sys_tipo_contrato ");
	
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<h3>Empleados </h3>

<form id="formularioEmpleados" action="<?php if($cargo != 0){ ?>configuraciones_maestras2.php?action=mod&form=empleado&msj=Empleado <?php echo $fetch_usu_name[0]; ?> Modificado Satisfactoriamente&empleado=<?php echo $cargo; } else { ?>configuraciones_maestras2.php?action=new&msj=Empleado <?php echo $fetch_cargos[0]; ?> Creado Satisfactoriamente&form=empleado <?php }?>" method="post">
	<table width="100%">
		<tr width="100%">
			
			
			<td width="100%">
				<div class="form-group"><label>Empleado</label> 
					<select class="form-control m-b" name="empleado">
						<option>Seleccione Empleado</option>
						<?php
						while($fetch_dependencias = mysql_fetch_array($sql_dependencias))
						{
							if($fetch_cargos[1] == $fetch_dependencias[0])
							{
						?>
						<option selected value="<?php echo $fetch_dependencias[0]; ?>"><?php echo $fetch_dependencias[9].' '.$fetch_dependencias[11]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_dependencias[0]; ?>"><?php echo $fetch_dependencias[9].' '.$fetch_dependencias[11]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
				<div class="form-group"><label>Pais</label> 
					<select class="form-control m-b" name="pais">
						<option>Seleccione Pais</option>
						<?php
						while($fetch_pais = mysql_fetch_array($sql_pais))
						{
							if($fetch_cargos[2] == $fetch_pais[0])
							{
						?>
						<option selected value="<?php echo $fetch_pais[0]; ?>"><?php echo $fetch_pais[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_pais[0]; ?>"><?php echo $fetch_pais[1]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
				<div class="form-group"><label>Fecha de Ingreso</label> <input type="text" id="datepicker"  placeholder="AAAA-MM-DD" name="fechaingreso" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_cargos[3]; }else{ echo ""; } ?>"></div>
				<div class="form-group"><label>Cargo</label> 
					<select class="form-control m-b" name="cargo">
						<option>Seleccione Cargo</option>
						<?php
						while($fetch_cargoE = mysql_fetch_array($sql_cargoE))
						{
							if($fetch_cargos[4] == $fetch_cargoE[0])
							{
						?>
						<option selected value="<?php echo $fetch_cargoE[0]; ?>"><?php echo $fetch_cargoE[2]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_cargoE[0]; ?>"><?php echo $fetch_cargoE[2]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
				<select class="form-control m-b" name="tipocontrato">
						<option>Seleccione Tipo de contrato</option>
						<?php
						while($fetch_contrato = mysql_fetch_array($sql_contrato))
						{
							if($fetch_cargos[5] == $fetch_contrato[0])
							{
						?>
						<option selected value="<?php echo $fetch_contrato[0]; ?>"><?php echo $fetch_contrato[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_contrato[0]; ?>"><?php echo $fetch_contrato[1]; ?></option>	
							<?php	
							}
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
<script src="https://code.jquery.com/jquery.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>
$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
</script>
    </body>
</html>