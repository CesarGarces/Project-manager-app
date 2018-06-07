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

$sql_generos2 = mysql_query("SELECT p.id_proyecto ,c.nombre cliente, tp.nombre tipo_proyecto, p.nombre nombre, pa.nombre pais, p.ciudad ciudad,p.descripcion descripcion,p.fecha_inicio fecha_inicio,p.duracion_estimada duracion_estimada, p.id_estado_proyecto id_estado_proyecto from sys_proyectos p, sys_paises pa, sys_clientes c, sys_tipo_proyectos tp where p.id_pais = pa.id_pais AND p.id_cliente = c.id_cliente AND p.id_tipo_proyecto = tp.id_tipo_proyecto ORDER BY c.nombre, p.nombre");
?>
<table class="table table-bordered" width="100%">
    <thead>
    <tr width="100%">
        <th width="3%">#</th>
        <th width="15%">Cliente</th>
        <th width="10%">Tipo de Proyecto</th>
        <th width="20%">Nombre</th>
        <th width="15%">Pais</th>
        <th width="15%">Ciudad</th>
        <th width="45%">Descripción</th>
        <th width="10%">Fecha Inicio</th>
        <th width="10%">Duración estimada</th>
        <th width="10%">Estado</th>
        <th width="10%">Modificar</th>
        <th width="10%">Eliminar</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contador = 0;
	while($fetch_generos = mysql_fetch_array($sql_generos2))
	{
    $contador ++;		
	?>
	<tr>
        <td style="vertical-align:middle;"><?php echo $contador; ?></td>
		<td style="vertical-align:middle;"><?php echo $fetch_generos['cliente']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_generos['tipo_proyecto']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_generos['nombre']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_generos['pais']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_generos['ciudad']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_generos['descripcion']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_generos['fecha_inicio']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_generos['duracion_estimada']; ?></td>
        <td style="vertical-align:middle;"><?php echo $fetch_generos['id_estado_proyecto']; ?></td>
        <td align="center"><a onclick="editProyectos(<?php echo $fetch_generos["id_proyecto"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Proyecto" style="text-decoration:none;color:white;" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a></td>
        <td align="center"><a onclick="deleteProyectos(<?php echo $fetch_generos["id_proyecto"]; ?>);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Eliminar Proyecto" style="text-decoration:none;color:white;" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a><br></td>
    </tr>
    <?php
	}
	?>
	
    </tbody>
</table>