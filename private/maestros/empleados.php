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

$sql_actividades = mysql_query("SELECT e.id_empleado, CONCAT(u.primer_nombre,' ', u.primer_apellido) nombres, p.nombre pais, e.fecha_ingreso fecha, c.nombre contrato, tc.nombre tipo FROM sys_empleados e, sys_usuarios u, sys_paises p, sys_cargos c, sys_tipo_contrato tc WHERE e.id_usuario = u.id_usuario AND e.id_pais = p.id_pais AND e.id_cargo = c.id_cargo AND e.id_tipo_contrato = tc.id_tipo_contrato");

//SELECT * FROM sys_empleados inner join sys_usuarios on sys_empleados.id_empleado = sys_usuarios.id_usuario inner join sys_paises on sys_empleados.id_pais = sys_paises.id_pais inner join sys_cargos on sys_empleados.id_cargo = sys_cargos.id_cargo inner join sys_tipo_contrato on sys_empleados.id_tipo_contrato = sys_tipo_contrato.id_tipo_contrato
?>

<table class="table table-bordered" width="100%">
    <thead>
    <tr width="100%">
        <th width="5%">#</th>
		<th width="20%">Nombre Empleado</th>
        <th width="10%">Pais</th>
        <th width="10%">Fecha ingreso</th>
        <th width="25%">Cargo</th>
        <th width="10%">Tipo contrato</th>
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
        <td style="vertical-align:middle;"><?php echo $fetch_actividades['nombres']; ?></td>
		<td style="vertical-align:middle;"><?php echo $fetch_actividades['pais']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_actividades['fecha']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_actividades['contrato']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_actividades['tipo']; ?></td>
        <td align="center"><a onclick="editEmpleados(<?php echo $fetch_actividades["id_empleado"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Empleado" style="text-decoration:none;color:white;" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a></td>
        <td align="center"><a onclick="deleteEmpleados(<?php echo $fetch_actividades["id_empleado"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Eliminar Empleado" style="text-decoration:none;color:white;" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a><br></td>
    </tr>
    <?php
	}
	?>
	
    </tbody>
</table>