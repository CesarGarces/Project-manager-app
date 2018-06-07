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
		$dependencia = $_REQUEST['mod'];
		$sql_dependencia = mysql_query("SELECT * FROM sys_perfiles WHERE id_perfil = ".$_REQUEST['mod']);
		$fetch_dependencias = mysql_fetch_row($sql_dependencia);
	}
	else
	{
		$dependencia = 0;
	}
	
	$sql_dependencias = mysql_query("SELECT * FROM sys_perfiles");
	
?>
<h3>Perfiles </h3>
<form id="formularioroles" action="<?php if($dependencia != 0){ ?>configuraciones_maestras.php?action=mod&form=rol&msj=Perfil <?php echo $fetch_dependencias[1]; ?> Modificado Satisfactoriamente&rol=<?php echo $dependencia; } else { ?>configuraciones_maestras.php?action=new&msj=Perfil <?php echo $fetch_dependencias[1]; ?> Creado Satisfactoriamente&form=rol <?php }?>" method="post">
	<table width="100%">
		<tr width="100%">

			<td width="50%">
				<div class="form-group"><label>Nombre de Perfil</label> <input required type="text" placeholder="Ingrese el Nombre de Perfil" name="nombrerol" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_dependencias[1]; }else{ echo ""; } ?>"></div>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan="2" align="center"><button type="submit" class="btn btn-outline btn-primary">Guardar</button></td>
		</tr>
	</table>
</form>