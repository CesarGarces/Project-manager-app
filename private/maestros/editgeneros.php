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
		$genero = $_REQUEST['mod'];
		$sql_genero = mysql_query("SELECT * FROM sys_generos WHERE id_genero = ".$_REQUEST['mod']);
		$fetch_generos = mysql_fetch_row($sql_genero);
	}
	else
	{
		$genero = 0;
	}
	
	$sql_generos = mysql_query("SELECT * FROM sys_generos");
	
?>
<h3>Géneros </h3>
<form id="formularioGenero" action="<?php if($genero != 0){ ?>configuraciones_maestras.php?action=mod&form=genero&msj=Género <?php echo $fetch_generos[1]; ?> Modificado Satisfactoriamente&genero=<?php echo $genero; } else { ?>configuraciones_maestras.php?action=new&msj=Género <?php echo $fetch_generos[1]; ?> Creado Satisfactoriamente&form=genero <?php }?>" method="post">
	<table width="100%">
		<tr width="100%">

			<td width="50%">
				<div class="form-group"><label>Género</label> <input required type="text" placeholder="Ingrese el Género" name="nombregenero" class="form-control" value="<?php if(isset($_REQUEST["mod"])){ echo $fetch_generos[1]; }else{ echo ""; } ?>"></div>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan="2" align="center"><button type="submit" class="btn btn-outline btn-primary">Guardar</button></td>
		</tr>
	</table>
</form>