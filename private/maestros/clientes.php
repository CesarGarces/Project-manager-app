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

$sql_actividades = mysql_query("SELECT a.*, b.segmento, c.nombre pais_nom from sys_clientes a, segmentos b, sys_paises c WHERE a.id_sector = b.id_segmento AND a.id_pais = c.id_pais ORDER BY a.nombre ASC");
?>
<table class="table table-bordered" width="100%">
    <thead>
    <tr width="100%">
        <th width="5%">#</th>
        <th width="10%">Logo</th>
		<th width="20%">Sector</th>
		<th width="35%">Nombre</th>
        <th width="15%">Pais</th>
        <th width="10%">Modificar</th>
        <th width="10%">Eliminar</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contador =0;
	while($fetch_actividades = mysql_fetch_array($sql_actividades))
	{	
    $contador ++;	
	?>
	<tr>
        <td style="vertical-align:middle;"><?php echo $contador; ?></td>
        <?php if($fetch_actividades['logo']=='../users/logos/'){ ?>
        <td align="center" style="vertical-align:middle;"><img alt="image" width="48" height="48" class="img-circle" src="http://izoboard.net:88/izoboard/users/logos/no_img.png"></td>
        <?php } else { ?>
        <td align="center" style="vertical-align:middle;"><img alt="image" width="48" height="48" class="img-circle" src="<?php echo $fetch_actividades['logo'];?>"></td>
        <?php } ?>
        <td style="vertical-align:middle;"><?php echo $fetch_actividades['segmento']; ?></td>
		<td style="vertical-align:middle;"><?php echo $fetch_actividades['nombre']; ?></td>
		<td style="vertical-align:middle;"><?php echo $fetch_actividades['pais_nom']; ?></td>
        <td align="center"><a onclick="editCliente(<?php echo $fetch_actividades["id_cliente"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Actividad" style="text-decoration:none;color:white;" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a></td>
        <td align="center"><a onclick="deleteCliente(<?php echo $fetch_actividades["id_cliente"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Eliminar Actividad" style="text-decoration:none;color:white;" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a><br></td>
    </tr>
    <?php
	}
	?>
	
    </tbody>
</table>