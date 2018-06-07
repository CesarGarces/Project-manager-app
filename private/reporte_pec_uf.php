<?php
error_reporting(0);
require'../users/class/sessions.php';
$objses = new Sessions();
$objses->init();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
   header('Location: ../index.php?error=2');
}

require'../users/class/config.php';
require'../users/class/users.php';
require'../users/class/dbactions.php';
require'../users/class/panel.php';

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
$fifin=date('Y-m-31');
$fecha=date('Y-m-d');

/*************** Parametros ***************/
$asesor = isset($_REQUEST['agencia']) ? $_REQUEST['agencia'] : null ;
$segmento = isset($_REQUEST['region']) ? $_REQUEST['region'] : null ;
$aliado = isset($_REQUEST['area']) ? $_REQUEST['area'] : null ;
$tecnologia = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : null ;

$error = "";

/*************** Filtros ***************/
$filtro_asesor = mysql_query("SELECT nom_asesor FROM enc_monitoreo");
$filtro_segmento = mysql_query("SELECT segmento_llamada FROM enc_monitoreo");
$filtro_aliado = mysql_query("SELECT aliado FROM enc_monitoreo");
$filtro_tecnologia = mysql_query("SELECT tecnologia FROM enc_monitoreo");
                                


$total_monitoreo = $objPan->total_monitoreo($fini,$fifin);
$monitoreos = mysql_fetch_array($total_monitoreo);
$tot_monitoreo = $monitoreos['tot_monitoreo'];

$reporte_pec_uf = mysql_query("SELECT * FROM enc_monitoreo");



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Reportes</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link href="../lib/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../lib/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="../lib/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!-- c3 Charts -->
    <link href="../lib/css/plugins/c3/c3.min.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>


<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <?php
                                $numrows = mysql_num_rows($img_users);
                                if($numrows > 0){
                                    while($row=mysql_fetch_array($img_users)){
                                        $id_usuario = $row['id_usuario'];
										
                                ?>

               <span>
                    <img alt="image" width="48" height="48" class="img-circle" src="<?php echo $row['imagen'];?>">
                </span>
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['user'];?></strong>

                </span> <span class="text-muted text-xs block"><?php echo $row['nombre'];?> <b class="caret"></b></span> </span> </a>

                <?php
                    }

                }
                ?>

                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="modify_pass.php">Cambiar Contraseña</a></li>
                                <li><a href="log_out.php">Salir</a></li>
                            </ul>
                    </div>

                    <div class="logo-element">

                       <img src="../favicon.ico" width="25" height="25">
                    </div>
                </li>

                <li class="active">
                    <a href="panel.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>"><i class="fa fa-dashboard"></i> <span class="nav-label">Panel</span></a>
                </li>
                <li>
                    <a href="mediciones.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Mediciones</span></a>
                </li>
                <li>
                    <a href=""><i class="fa fa-arrow-circle-o-right"></i> <span class="nav-label">Proyectos</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a><i class="fa fa-bar-chart-o"></i> Calidad Emitida<span class="fa arrow"></span></a>
							<ul class="nav nav-third-level collapse">
								<li><a href="reporte_pec_uf.php?asesor=<?php echo $asesor; ?>&segmento=<?php echo $segmento; ?>&aliado=<?php echo $aliado; ?>&tecnologia=<?php echo $tecnologia; ?>&fini=<?php echo $fini; ?>&fifin=<?php echo $fifin; ?>">Reporte PEC_UF</a></li>
								<li><a href="reporte_pec_neg.php?asesor=<?php echo $asesor; ?>&segmento=<?php echo $segmento; ?>&aliado=<?php echo $aliado; ?>&tecnologia=<?php echo $tecnologia; ?>&fini=<?php echo $fini; ?>&fifin=<?php echo $fifin; ?>">Reporte PEC_NEG</a></li>
								<li><a href="reporte_anexo.php?asesor=<?php echo $asesor; ?>&segmento=<?php echo $segmento; ?>&aliado=<?php echo $aliado; ?>&tecnologia=<?php echo $tecnologia; ?>&fini=<?php echo $fini; ?>&fifin=<?php echo $fifin; ?>">Reporte Auxiliares</a></li>

								
							</ul>
						</li>
                        <!--
						<li><a href="enc_vent_indiv.php">MA</a></li>
                        <li><a href="enc_siniestro_vam.php">CI</a></li>
						-->
                    </ul>
                </li>
				<?php
				if($id_rol <= 6)
				{
				?>
                <li>
                    <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Ajustes</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="user_list.php">Usuarios</a></li>
                        <li><a href="rol_list.php">Roles</a></li>
                        <li><a href="lineas_list.php">Lineas</a></li>
                        <li><a href="permisos_list.php">Permisos</a></li>
                        <li><a href="asigpermisos_list.php">Asignar Permisos</a></li>
                        <li><a href="modulos_list.php">Modulos</a></li>
                        <li><a href="secciones_list.php">Secciones</a></li>
                    </ul>
                </li>
                <?php
				}				
				?>
            </ul>
        </div>
    </nav>
      <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="log_out.php">
                            <i class="fa fa-sign-out"></i> Salir
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Reporte PEC_UF</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="panel.php">Panel</a>
                        </li>
                        
                        <li class="active">
                            <strong>Reporte PEC_UF</strong>
                        </li>
                    </ol>
                </div>
            </div>

        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="row">
                <div class="col-sm-9">
					
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        
                        <th>encuestador</th>
						<th>uf_gestion</th>
                        <th>uf_gestion_chek1</th>
                        <th>uf_gestion_chek2</th>
                        <th>uf_gestion_chek3</th>
						<th>uf_gestion_chek4</th>
						<th>uf_gestion_chek5</th>
						<th>uf_brinda_sol</th>
						<th>uf_brinda_sol_chek1</th>
						<th>uf_brinda_sol_chek2</th>
						<th>uf_brinda_sol_chek3</th>
						<th>uf_brinda_sol_chek4</th>
						<th>uf_brinda_sol_chek5</th>
						<th>uf_brinda_sol_chek6</th>
						<th>uf_brinda_sol_chek7</th>
						<th>uf_pac_cord</th>
						<th>uf_pac_cord_chek1</th>
						<th>uf_pac_cord_chek2</th>
						<th>uf_pac_cord_chek3</th>
						<th>uf_pac_cord_chek4</th>
						<th>uf_pac_cord_chek5</th>
						<th>uf_conf_segu</th>
						<th>uf_conf_segu_chek1</th>
						<th>uf_conf_segu_chek2</th>
						<th>uf_conf_segu_chek3</th>
						<th>uf_simplicidad</th>
						<th>uf_simplicidad_chek1</th>
						<th>uf_simplicidad_chek2</th>
						<th>uf_simplicidad_chek3</th>
						<th>uf_simplicidad_chek4</th>
						<th>uf_aban_llam</th>
						<th>uf_aban_llam_chek1</th>
						<th>uf_aban_llam_chek2</th>
						<th>uf_aban_llam_chek3</th>
						
                        
                    </tr>
                    </thead>
                        <tbody>
                        	<?php while($pec_uf=mysql_fetch_array($reporte_pec_uf)){
                                        
										
                                ?>
						<tr>
                            <td>
								<?php echo $pec_uf['encuestador'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_gestion'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_gestion_chek1'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_gestion_chek2'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_gestion_chek3'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_gestion_chek4'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_gestion_chek5'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_brinda_sol'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_brinda_sol_chek1'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_brinda_sol_chek2'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_brinda_sol_chek3'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_brinda_sol_chek4'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_brinda_sol_chek5'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_brinda_sol_chek6'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_brinda_sol_chek7'] ?>
							</td>							
							<td>
								<?php echo $pec_uf['uf_pac_cord'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_pac_cord_chek1'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_pac_cord_chek2'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_pac_cord_chek3'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_pac_cord_chek4'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_pac_cord_chek5'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_conf_segu'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_conf_segu_chek1'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_conf_segu_chek2'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_conf_segu_chek3'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_simplicidad'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_simplicidad_chek1'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_simplicidad_chek2'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_simplicidad_chek3'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_simplicidad_chek4'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_aban_llam'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_aban_llam_chek1'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_aban_llam_chek2'] ?>
							</td>
							<td>
								<?php echo $pec_uf['uf_aban_llam_chek3'] ?>
							</td>
							

                            
                        </tr>
                        <?php } ?>
                        
                        </tbody>
                    </table>
                        </div>

                    </div>
                </div>

				
            </div>
			<div class="col-sm-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Filtros - ETB
                            </div>
                            <form method="post">
                                <div class="panel-body">
                                    <div class="form-group" id="fecha_ini">
                                        <label class="font-noraml">Fecha Inicial:</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="ini" class="form-control" value="<?php echo $fini;?>">
                                        </div>
                                    </div>
                                    <div class="form-group" id="fecha_fin">
                                        <label class="font-noraml">Fecha Final:</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="fin" class="form-control" value="<?php echo $fifin;?>">
                                        </div>
                                    </div>
                                    <div class="form-group" id="region">
                                        <label class="font-noraml">Asesor:</label>
                                        <div class="input-group date">
                                        </div>
                                        <select class="form-control required m-b valid" name="asesor" >

                                        <?php


                                        $numrows = mysql_num_rows($filtro_asesor);

                                            if($numrows > 0){
                                                $cont =0;
                                                while($ag=mysql_fetch_array($filtro_asesor))

                                                {
                                                    if($cont==0){


                                        ?>

                                            <option selected value="0">Seleccione Asesor</option>
                                            <?php
                                        }
                                        if($asesor==$ag['nom_asesor']){?>

                                            <option selected value="<?php echo $ag['asesor'];?>"><?php echo $ag['nom_asesor'];?></option>
                                            <?php
                                        }else{
                                        ?>
                                            <option value="<?php echo $ag['nom_asesor'];?>"><?php echo $ag['nom_asesor'];?></option>
                                            <?php
                                        }
                                            $cont++;
                                        }
                                    }
                                    ?>

                                </select>
                                    </div>
									<div class="form-group" id="agencia">
                                        <label class="font-noraml">Segmento Llamada:</label>
                                        <div class="input-group date">
                                        </div>
                                        <select class="form-control required m-b valid" name="segmento" >

                                        <?php


                                        $numrows = mysql_num_rows($filtro_segmento);

                                            if($numrows > 0){
                                                $cont =0;
                                                while($ag=mysql_fetch_array($filtro_segmento))

                                                {
                                                    if($cont==0){


                                        ?>

                                            <option selected value="0">Seleccione segmento</option>
                                            <?php
                                        }
                                        if($segmento==$ag['segmento_llamada']){?>

                                            <option selected value="<?php echo $ag['segmento_llamada'];?>"><?php echo $ag['segmento_llamada'];?></option>
                                            <?php
                                        }else{
                                        ?>
                                            <option value="<?php echo $ag['segmento_llamada'];?>"><?php echo $ag['segmento_llamada'];?></option>
                                            <?php
                                        }
                                            $cont++;
                                        }
                                    }
                                    ?>

                                </select>
                                    </div>
                                    <div class="form-group" id="area">
                                        <label class="font-noraml">Aliado:</label>
                                        <div class="input-group date">
                                        </div>
                                        <select class="form-control required m-b valid" name="aliado" >

                                        <?php


                                        $numrows = mysql_num_rows($filtro_aliado);

                                            if($numrows > 0){
                                                $cont =0;
                                                while($ag=mysql_fetch_array($filtro_aliado))

                                                {
                                                    if($cont==0){


                                        ?>

                                            <option selected value="0">Seleccione Aliado</option>
                                            <?php
                                        }
                                        if($aliado==$ag['aliado']){?>

                                            <option selected value="<?php echo $ag['aliado'];?>"><?php echo $ag['aliado'];?></option>
                                            <?php
                                        }else{
                                        ?>
                                            <option value="<?php echo $ag['aliado'];?>"><?php echo $ag['aliado'];?></option>
                                            <?php
                                        }
                                            $cont++;
                                        }
                                    }
                                    ?>

                                </select>
                                    </div>
                                    <div class="form-group" id="area">
                                        <label class="font-noraml">Tecnología:</label>
                                        <div class="input-group date">
                                        </div>
                                        <select class="form-control required m-b valid" name="tecnologia" >

                                        <?php


                                        $numrows = mysql_num_rows($filtro_tecnologia);

                                            if($numrows > 0){
                                                $cont =0;
                                                while($ag=mysql_fetch_array($filtro_tecnologia))

                                                {
                                                    if($cont==0){


                                        ?>

                                            <option selected value="0">Seleccione Tecnología</option>
                                            <?php
                                        }
                                        if($tecnologia==$ag['tecnologia']){?>

                                            <option selected value="<?php echo $ag['tecnologia'];?>"><?php echo $ag['tecnologia'];?></option>
                                            <?php
                                        }else{
                                        ?>
                                            <option value="<?php echo $ag['tecnologia'];?>"><?php echo $ag['tecnologia'];?></option>
                                            <?php
                                        }
                                            $cont++;
                                        }
                                    }
                                    ?>

                                </select>
                                    </div>
                                    <br />

                                <p>Una vez seleccionados los filtros, debe dar click sobre el Boton "Aplicar Filtros" y el reporte se adecuará a los valores seleccionados.</p>

                    <div class="m-t" align="center">
                        <input type="hidden" id="error0" onchange="alerta();" value="<?php $error;?>"/>
                        <input type="submit" onclick = "this.form.action = 'reporte_areas.php'" value="Aplicar Filtros" class="btn btn-info"/>
                    </div>
                </form>
                </div>
            </div>
			<div class="text-center">
				<a href="panel.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>">
                <button type="button" class="btn btn-info">
                    Regresar al Panel
                </button>
				</a>
            </div>
            </div>
            </div>      
            </div>

        <div class="footer">
            <div class="pull-right">
                IZO Corp.
            </div>
            <div>
                <strong>Copyright</strong> IZO Corp &copy; 2015-2016
            </div>
        </div>

        </div>
        </div>

<!-- Mainly scripts -->
<script src="../lib/js/jquery-2.1.1.js"></script>
<script src="../lib/js/bootstrap.min.js"></script>
<script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../lib/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="../lib/js/inspinia.js"></script>
<script src="../lib/js/plugins/pace/pace.min.js"></script>
<script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>

   <!-- Data picker -->
   <script src="../lib/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="../lib/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="../lib/js/plugins/daterangepicker/daterangepicker.js"></script>

	<!-- ChartJS-->
    <script src="../lib/js/plugins/chartJs/Chart.min.js"></script>
	
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'Reporte_Areas'},
                {extend: 'pdf', title: 'Reporte_Areas'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });
        
        /* Init DataTables */
        var oTable = $('#editable').DataTable();

		var barData = {
        labels: ["Cajas", "Negocios", "Servicios"],
        datasets: [
            {
                label: "NPS",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
				data: [
				<?php echo number_format($nps_cajas,2,".",".").",".number_format($nps_negocios,2,".",".").",".number_format($nps_servicios,2,".","."); ?>
				]
            },
            {
                label: "INS",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.8)",
                highlightFill: "rgba(26,179,148,0.75)",
                highlightStroke: "rgba(26,179,148,1)",
                data: [
				<?php echo number_format($ins_cajas,2,".",".").",".number_format($ins_negocios,2,".",".").",".number_format($ins_servicios,2,".","."); ?>
				]
            },
			{
                label: "CES",
                fillColor: "rgba(112,17,248,0.5)",
                strokeColor: "rgba(112,17,248,0.8)",
                highlightFill: "rgba(112,17,248,0.75)",
                highlightStroke: "rgba(112,17,248,1)",
                data: [
				<?php echo number_format($ces_cajas,2,".",".").",".number_format($ces_negocios,2,".",".").",".number_format($ces_servicios,2,".","."); ?>
				]
            }
        ]
    };

    var barOptions = {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        barShowStroke: true,
        barStrokeWidth: 2,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        responsive: true
    }


    var ctx = document.getElementById("barChart-lealtad").getContext("2d");
    //var myNewChart = new Chart(ctx).Bar(barData, barOptions);
	window.myBar = new Chart(ctx).Bar(barData, {
		responsive : true,
		animation: true,
		barValueSpacing : 5,
		barDatasetSpacing : 1,
		tooltipFillColor: "rgba(0,0,0,0.8)",                
		multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>%"
	});
	
	// Grafico Oficinas
	
	var barData = {
        labels: ["Cajas", "Negocios", "Servicios"],
        datasets: [
            {
                label: "Asesoría",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
				data: [
				<?php echo number_format($asesoria_cajas,2,".",".").",".number_format($asesoria_negocios,2,".",".").",".number_format($asesoria_servicios,2,".","."); ?>
				]
            },
            {
                label: "Agilidad",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.8)",
                highlightFill: "rgba(26,179,148,0.75)",
                highlightStroke: "rgba(26,179,148,1)",
                data: [
				<?php echo number_format($agilidad_cajas,2,".",".").",".number_format($agilidad_negocios,2,".",".").",".number_format($agilidad_servicios,2,".","."); ?>
				]
            },
			{
                label: "Actitud",
                fillColor: "rgba(112,17,248,0.5)",
                strokeColor: "rgba(112,17,248,0.8)",
                highlightFill: "rgba(112,17,248,0.75)",
                highlightStroke: "rgba(112,17,248,1)",
                data: [
				<?php echo number_format($actitud_cajas,2,".",".").",".number_format($actitud_negocios,2,".",".").",".number_format($actitud_servicios,2,".","."); ?>
				]
            },
			{
                label: "Solución",
                fillColor: "rgba(12,107,28,0.5)",
                strokeColor: "rgba(12,107,28,0.8)",
                highlightFill: "rgba(12,107,28,0.75)",
                highlightStroke: "rgba(12,107,28,1)",
                data: [
				<?php echo number_format($solucion_cajas,2,".",".").",".number_format($solucion_negocios,2,".",".").",".number_format($solucion_servicios,2,".","."); ?>
				]
            }
        ]
    };

    var barOptions = {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        barShowStroke: true,
        barStrokeWidth: 2,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        responsive: true
    }


    var ctx = document.getElementById("barChart-oficinas").getContext("2d");
//    var myNewChart = new Chart(ctx).Bar(barData, barOptions);

	window.myBar = new Chart(ctx).Bar(barData, {
		responsive : true,
		animation: true,
		barValueSpacing : 5,
		barDatasetSpacing : 1,
		tooltipFillColor: "rgba(0,0,0,0.8)",                
		multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>%"
	});
	
    });
</script>

</body>

</html>
