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
		$sql_dependencia = mysql_query("SELECT * FROM sys_tipo_documentos WHERE id_tipo_documento = ".$_REQUEST['mod']);
		$fetch_dependencias = mysql_fetch_row($sql_dependencia);
	}
	else
	{
		$dependencia = 0;
	}
	
	$sql_dependencias = mysql_query("SELECT * FROM id_tipo_documento");
	
?>
<h3>Tipos de Documentos </h3>
<form id="formulariodocumentos" action="<?php if($dependencia != 0){ ?>configuraciones_maestras.php?action=mod&form=documento&msj=Documento <?php echo $fetch_dependencias[1]; ?> Modificado Satisfactoriamente&documento=<?php echo $dependencia; } else { ?>configuraciones_maestras.php?action=new&msj=Documento <?php echo $fetch_dependencias[1]; ?> Creado Satisfactoriamente&form=documento <?php }?>" method="post">
	<table width="100%">
		<tr width="100%">

			<td width="50%">
				<div class="form-group"><label>Nombre Documento</label> <input required type="text" placeholder="Ingrese el Nombre de Documento" name="nombredocumento" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_dependencias[1]; }else{ echo ""; } ?>"></div>
				<div class="form-group"><label>Sigla Documento</label> <input required type="text" placeholder="Ingrese Sigla" name="sigladocumento" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_dependencias[2]; }else{ echo ""; } ?>"></div>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan="2" align="center"><button type="submit" class="btn btn-outline btn-primary">Guardar</button></td>
		</tr>
	</table>
</form>