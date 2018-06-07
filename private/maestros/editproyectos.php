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
		$sql_cargo = mysql_query("SELECT * FROM sys_proyectos WHERE id_proyecto = ".$_REQUEST['mod']);
		$fetch_cargos = mysql_fetch_row($sql_cargo);
		
	}
	else
	{
		
		
		$cargo = 0;
	}
	
	$sql_clientes = mysql_query("SELECT id_cliente, nombre FROM sys_clientes ");
	$sql_proyecto = mysql_query("SELECT * FROM sys_tipo_proyectos");
	$sql_pais = mysql_query("SELECT * FROM sys_paises ");
	$sql_ciudades = mysql_query("SELECT * FROM sys_ciudades ");
	$sql_cargoE = mysql_query("SELECT * FROM sys_cargos ");
	$sql_contrato = mysql_query("SELECT * FROM sys_tipo_contrato ");
	
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<h3>Proyectos </h3>

<form id="formularioEmpleados" action="<?php if($cargo != 0){ ?>configuraciones_maestras2.php?action=mod&form=proyecto&msj=Proyecto <?php echo $fetch_cargos[3]; ?> Modificado Satisfactoriamente&proyectoid=<?php echo $cargo; } else { ?>configuraciones_maestras2.php?action=new&msj=Proyecto <?php echo $fetch_cargos[3]; ?> Creado Satisfactoriamente&form=proyecto <?php }?>" method="post">
	<table width="100%">
		<tr width="100%">
			
			
			<td width="100%">
				<div class="form-group"><label>Cliente</label> 
					<select class="form-control m-b" name="cliente">
						<option>Seleccione Cliente</option>
						<?php
						while($fetch_clientes = mysql_fetch_array($sql_clientes))
						{
							if($fetch_cargos[1] == $fetch_clientes[0])
							{
						?>
						<option selected value="<?php echo $fetch_clientes[0]; ?>"><?php echo $fetch_clientes[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_clientes[0]; ?>"><?php echo $fetch_clientes[1]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
					<div class="form-group"><label>Tipo de Proyecto</label> 
					<select class="form-control m-b" name="proyecto">
						<option>Seleccione Tipo de Proyecto</option>
						<?php
						while($fetch_proyecto = mysql_fetch_array($sql_proyecto))
						{
							if($fetch_cargos[2] == $fetch_proyecto[0])
							{
						?>
						<option selected value="<?php echo $fetch_proyecto[0]; ?>"><?php echo $fetch_proyecto[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_proyecto[0]; ?>"><?php echo $fetch_proyecto[1]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>
					<div class="form-group"><label>Nombre de Proyecto</label> <input type="text"  placeholder="Nombre de Proyecto" name="nombre" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_cargos[3]; }else{ echo ""; } ?>"></div>
				<div class="form-group"><label>Pais</label> 
					<select class="form-control m-b" name="pais">
						<option>Seleccione Pais</option>
						<?php
						while($fetch_pais = mysql_fetch_array($sql_pais))
						{
							if($fetch_cargos[4] == $fetch_pais[0])
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
					<div class="form-group"><label>Ciudad</label> <input type="text"  placeholder="Nombre de Ciudad" name="ciudad" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_cargos[5]; }else{ echo ""; } ?>"></div>
				    <div class="form-group"><label>Descripción de Proyecto</label> <input type="text"  placeholder="Descripción de Proyecto" name="descripcion" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_cargos[6]; }else{ echo ""; } ?>"></div>
				    <div class="form-group"><label>Fecha de Inicio</label> <input type="text" id="datepicker"  placeholder="AAAA-MM-DD" name="fechainicio" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_cargos[7]; }else{ echo ""; } ?>"></div>
				    <div class="form-group"><label>Duracion Estimada</label> <input type="text"   placeholder="Duracion Estimada de el Proyecto" name="duracion" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_cargos[8]; }else{ echo ""; } ?>"></div>
				    <div class="form-group"><label>Estado</label> <input type="text"   placeholder="Estado de el Proyecto" name="estado" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_cargos[9]; }else{ echo ""; } ?>"></div>
				
				
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