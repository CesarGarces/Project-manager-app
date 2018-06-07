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

$sql_generos = mysql_query("SELECT * FROM sys_tipo_contrato");
?>
<table class="table table-bordered" width="100%">
    <thead>
    <tr width="100%">
        <th width="5%">#</th>
        <th width="45%">Nombre del Tipo de Contrato</th>
        <th width="15%">Horas Laborales</th>
        <th width="10%">Modificar</th>
        <th width="10%">Eliminar</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contador = 0;
	while($fetch_generos = mysql_fetch_array($sql_generos))
	{
    $contador ++;		
	?>
	<tr>
        <td style="vertical-align:middle;"><?php echo $contador; ?></td>
		<td style="vertical-align:middle;"><?php echo $fetch_generos['nombre']; ?></td>
        <td align="center" style="vertical-align:middle;"><?php echo $fetch_generos['horas']; ?></td>
        <td align="center"><a onclick="editContratos(<?php echo $fetch_generos["id_tipo_contrato"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Contrato" style="text-decoration:none;color:white;" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a></td>
        <td align="center"><a onclick="deleteContratos(<?php echo $fetch_generos["id_tipo_contrato"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Eliminar Contrato" style="text-decoration:none;color:white;" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a><br></td>
    </tr>
    <?php
	}
	?>
	
    </tbody>
</table>