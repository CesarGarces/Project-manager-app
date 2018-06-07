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
		$cliente = $_REQUEST['mod'];
		$sql_cliente = mysql_query("SELECT * from sys_clientes WHERE id_cliente = ".$_REQUEST['mod']);
		$fetch_clientes = mysql_fetch_row($sql_cliente);
	}
	else
	{
		$cliente = 0;
	}
	
	$sql_documento = mysql_query("SELECT * FROM sys_tipo_documentos");
	$sql_pais = mysql_query("SELECT * FROM sys_paises");
	$sql_empleado = mysql_query("SELECT * FROM izoboard_izo.sys_empleados inner join sys_usuarios on sys_empleados.id_usuario = sys_usuarios.id_usuario");
	$sql_sector = mysql_query("SELECT * FROM segmentos");
	
?>
<h3>Clientes </h3>
<form id="formularioClientes" action="<?php if($cliente != 0){ ?>configuraciones_maestras2.php?action=mod&form=cliente&msj=Cliente <?php echo $fetch_clientes[5]; ?> Modificado Satisfactoriamente&cliente=<?php echo $cliente; } else { ?>configuraciones_maestras2.php?action=new&msj=Cliente <?php echo $fetch_clientes[5]; ?> Creado Satisfactoriamente&form=cliente <?php }?>" method="post" enctype="multipart/form-data">
	<table width="100%">
		<tr width="100%">
			<td width="50%">
				<div class="form-group"><label>Tipo documento</label> 
					<select class="form-control m-b" name="tipodoc" required>
						<option>Seleccione Tipo documento</option>
						<?php
						while($fetch_documento = mysql_fetch_array($sql_documento))
						{
							if($fetch_clientes[1] == $fetch_documento[0])
							{
						?>
						<option selected value="<?php echo $fetch_documento[0]; ?>"><?php echo $fetch_documento[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_documento[0]; ?>"><?php echo $fetch_documento[1]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>


			</td>
			<td width="50%">
				<div class="form-group"><label>N Documento</label> <input type="text" required placeholder="Ingrese el N Documento" name="documento" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[2]; }else{ echo ""; } ?>"></div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group"><label>Apellido</label> <input type="text" required placeholder="Ingrese el Apellido" name="apellido" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[3]; }else{ echo ""; } ?>"></div>
			</td>	
			<td>
				<div class="form-group"><label>Nombre</label> <input type="text" required placeholder="Ingrese el Nombre" name="nombre" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[5]; }else{ echo ""; } ?>"></div>	
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group"><label>Razon Social</label> <input type="text" required placeholder="Ingrese Razon Social" name="rsocial" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[4]; }else{ echo ""; } ?>"></div>
			</td>
			<td>
				<div class="form-group"><label>Sector</label> 
				<select class="form-control m-b" name="sector" required>
						<option>Seleccione Sector</option>
						<?php
						while($fetch_sector = mysql_fetch_array($sql_sector))
						{
							if($fetch_clientes[6] == $fetch_sector[0])
							{
						?>
						<option selected value="<?php echo $fetch_sector[0]; ?>"><?php echo $fetch_sector[1]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_sector[0]; ?>"><?php echo $fetch_sector[1]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>	
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group"><label>Email Principal</label> <input type="text" required placeholder="Ingrese el Email" name="email1" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[7]; }else{ echo ""; } ?>"></div>
			</td>
			<td>
				<div class="form-group"><label>Pais</label> 
				<select class="form-control m-b" name="pais" required>
						<option>Seleccione Pais</option>
						<?php
						while($fetch_pais = mysql_fetch_array($sql_pais))
						{
							if($fetch_clientes[8] == $fetch_pais[0])
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
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group"><label>Tel Ppal</label> <input type="text" required placeholder="Ingrese Telefono Principal" name="tel1" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[9]; }else{ echo ""; } ?>"></div>
			</td>
			<td>
				<div class="form-group"><label>Dir Ppal</label> <input type="text" required placeholder="Ingrese Dirección Principal" name="dir1" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[10]; }else{ echo ""; } ?>"></div>	
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group"><label>Empleado Contacto</label> 
				<select class="form-control m-b" name="empleado" required>
						<option>Seleccione Empleado</option>
						<?php
						while($fetch_empleado = mysql_fetch_array($sql_empleado))
						{
							if($fetch_clientes[12] == $fetch_empleado[0])
							{
						?>
						<option selected value="<?php echo $fetch_empleado[0]; ?>"><?php echo $fetch_empleado[15]; ?></option>
						<?php
							}
							else
							{
							?>
						<option value="<?php echo $fetch_empleado[0]; ?>"><?php echo $fetch_empleado[15]; ?></option>	
							<?php	
							}
						}
						?>
					</select></div>	
			</td>
			<td>
				<div class="form-group"><label>Nombre contacto Ppal</label> <input type="text" required placeholder="Ingrese Nombre contacto Principal" name="contpal" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[13]; }else{ echo ""; } ?>"></div>	
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group"><label>Cel Contacto Ppal</label> <input type="text" required placeholder="Ingrese Cel Contacto Ppal" name="cel1" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[14]; }else{ echo ""; } ?>"></div>
			</td>
			<td>
				<div class="form-group"><label>Mail Contacto Ppal</label> <input type="text" required placeholder="Ingrese Dirección Principal" name="mailpal" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[15]; }else{ echo ""; } ?>"></div>	
			</td>
		</tr>

		<tr>
			<td>
				<div class="form-group"><label>Nombre Contacto Sec</label> <input type="text" required placeholder="Ingrese Nombre Contacto Secundario" name="nom2" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[16]; }else{ echo ""; } ?>"></div>
			</td>
			<td>
				<div class="form-group"><label>Cel Contacto Sec</label> <input type="text" required placeholder="Cel Contacto Secundario" name="cel2" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[17]; }else{ echo ""; } ?>"></div>	
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group"><label>Mail Contacto Sec</label> <input type="text" required placeholder="Ingrese Mail Contacto Secundario" name="mail3" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_clientes[18]; }else{ echo ""; } ?>"></div>
			</td>
		</tr>
		
		<tr>
			<td>
				<?php if($cliente ==0){ ?>
				<div class="form-group"><label>Logo</label> <input type="file" name="logo" /></div>
				<?php }else{ ?>
				<div class="form-group"><label>Logo</label> <input type="file"  name="cambiar_imagen" value="Cambiar Imagen" />	</div>
				<?php } ?>
			</td>
			<td align="center">
				<?php if($fetch_clientes[19] == '../users/logos/' || $cliente==0){ ?>
				<div><img alt="image" width="100" height="100" class="img-circle" style="position: relative; top: -30px;" src="http://izoboard.net:88/izoboard/users/logos/no_img.png"></div>
				<?php } else { ?>
				<div><img alt="image" width="100" height="100" class="img-circle" style="position: relative; top: -30px;" src="<?php echo $fetch_clientes[19]; ?>"></div>	
				<?php }  ?>
			</td>
		</tr>


		<tr>
			<td colspan="2" align="center"><button type="submit" class="btn btn-outline btn-primary">Guardar</button></td>
		</tr>
	</table>
</form>