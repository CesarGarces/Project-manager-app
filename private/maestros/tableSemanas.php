<table class="table table-striped table-bordered table-hover dataTables-example" >
	<thead>
	<tr>
		<th>Fecha Desde</th>
		<th>Fecha Hasta</th>
		<th>Mes</th>
		<th>Semana</th>
		<th width="10%">Acciones</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	while($sem=mysql_fetch_array($list_semana))
	{ ?>
		<tr>
			<td>
				<?php echo $sem["fecha_desde"];?>
			</td>
			<td>
				<?php echo $sem["fecha_hasta"];?>
			</td>
			<td>
				<?php echo $sem["mes"];?>
			</td>
			<td>
				<?php echo $sem["semana"];?>
			</td>
			<td align="center">
				<a href="new_semana.php?del=<?php echo $sem["id_semana"];?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
			</td>                                                               
		</tr>
		<?php 
	}
	?>
	</tfoot>
</table>