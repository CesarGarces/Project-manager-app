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

echo "holaaaaaaa";
$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objPan = new Panel();
$img_users = $objUse->img_users();
$img_roles = $objUse->img_users();

$row_rol=mysql_fetch_array($img_roles);
$id_rol = $row_rol['id_rol'];

date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
$fecha_a=date('Y');
/*************** Parametros ***************/
$taller = isset($_REQUEST['taller']) ? $_REQUEST['taller'] : null ;
$ciudad = isset($_REQUEST['ciudad']) ? $_REQUEST['ciudad'] : null ;
$siniestro = isset($_REQUEST['siniestro']) ? $_REQUEST['siniestro'] : null ;
$mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : $mes_a ;
$ano = isset($_REQUEST['ano']) ? $_REQUEST['ano'] : $fecha_a ;

$pregunta_revisar = $_REQUEST['pregunta_revisar'];
$error = "";

$sql_list_inicial = mysql_query("SELECT * FROM base_siniestro_inicial inner join enc_siniestros on base_siniestro_inicial.id_izo = enc_siniestros.id_izo where siniestro = '$siniestro' ");
$query_list_inicial = mysql_query($sql_list_inicial);
$fetch_list_inicial = mysql_fetch_row($query_list_inicial);
echo $fetch_list_inicial;
/*************** Filtros ***************/
/*************** Ciudad ***************/
$filtro_ciudad = mysql_query("SELECT DISTINCT a.ciudad FROM base_siniestro_inicial a, base_siniestro_final b WHERE a.ciudad = b.ciudad");
/*************** Taller ***************/
$filtro_taller = mysql_query("SELECT DISTINCT taller FROM base_siniestro_final");


/*************** Construcción de Querys ***************/
$sql_ins_inicial = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc14 in (8,9,10) THEN 1 ELSE 0 END) top3, SUM(CASE WHEN a.enc14 in (0,1,2,3) THEN 1 ELSE 0 END) bottom4 FROM enc_siniestros a, base_siniestro_inicial b WHERE a.id_izo = b.id_izo AND a.siniestro = 'Siniestro Inicial' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";

$sql_ins_final = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc14 in (8,9,10) THEN 1 ELSE 0 END) top3, SUM(CASE WHEN a.enc14 in (0,1,2,3) THEN 1 ELSE 0 END) bottom4 FROM enc_siniestros a, base_siniestro_final b WHERE a.id_izo = b.id_izo AND a.siniestro = 'Siniestro Final' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";

$sql_nps = "SELECT COUNT(1) n, SUM(CASE WHEN enc15 in (9,10) THEN 1 ELSE 0 END) top2, SUM(CASE WHEN enc15 in (0,1,2,3,4,5,6) THEN 1 ELSE 0 END) bottom7 FROM enc_siniestros a WHERE a.id_izo in (SELECT b.id_izo FROM (SELECT DISTINCT id_izo FROM base_siniestro_inicial WHERE date_format(fecha_arch,'%m') = $mes AND date_format(fecha_arch,'%Y') = $ano UNION SELECT DISTINCT id_izo FROM base_siniestro_final WHERE date_format(fecha_arch,'%m') = $mes AND date_format(fecha_arch,'%Y') = $ano) b)";

$sql_claridad_inicial = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc10 in (9,10) THEN 1 ELSE 0 END) top2 FROM enc_siniestros a, base_siniestro_inicial b WHERE a.id_izo = b.id_izo AND a.siniestro='Siniestro Inicial' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";
$sql_claridad_final = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc7 in (9,10) THEN 1 ELSE 0 END) top2 FROM enc_siniestros a, base_siniestro_final b WHERE siniestro='Siniestro Final' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";

$sql_amabilidad_inicial = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc7 in (9,10) THEN 1 ELSE 0 END) top2 FROM enc_siniestros a, base_siniestro_inicial b WHERE a.id_izo = b.id_izo AND a.siniestro='Siniestro Inicial' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";
$sql_amabilidad_final = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc8 in (9,10) THEN 1 ELSE 0 END) top2 FROM enc_siniestros a, base_siniestro_final b WHERE a.id_izo = b.id_izo AND a.siniestro='Siniestro Final' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";

$sql_asesoria_inicial = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc8 in (9,10) THEN 1 ELSE 0 END) top2 FROM enc_siniestros a, base_siniestro_inicial b WHERE a.id_izo = b.id_izo AND a.siniestro='Siniestro Inicial' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";
$sql_asesoria_final = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc9 in (9,10) THEN 1 ELSE 0 END) top2 FROM enc_siniestros a, base_siniestro_final b WHERE a.id_izo = b.id_izo AND a.siniestro='Siniestro Final' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";

$sql_cumplimiento_inicial = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc9 in (9,10) THEN 1 ELSE 0 END) top2 FROM enc_siniestros a, base_siniestro_inicial b WHERE a.id_izo = b.id_izo AND a.siniestro='Siniestro Inicial' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";
$sql_cumplimiento_final = "SELECT COUNT(1) n, SUM(CASE WHEN a.enc10 in (9,10) THEN 1 ELSE 0 END) top2 FROM enc_siniestros a, base_siniestro_final b WHERE a.id_izo = b.id_izo AND a.siniestro='Siniestro Final' AND date_format(b.fecha_arch,'%m') = $mes AND date_format(b.fecha_arch,'%Y') = $ano";

if(isset($_REQUEST['taller']) && $_REQUEST['taller'] <> '0')
{
	//Taller
}

$query_ins_inicial = mysql_query($sql_ins_inicial);
$query_ins_final = mysql_query($sql_ins_final);
$query_nps = mysql_query($sql_nps);

$query_claridad_inicial = mysql_query($sql_claridad_inicial);
$query_claridad_final = mysql_query($sql_claridad_final);
$query_amabilidad_inicial = mysql_query($sql_amabilidad_inicial);
$query_amabilidad_final = mysql_query($sql_amabilidad_final);
$query_asesoria_inicial = mysql_query($sql_asesoria_inicial);
$query_asesoria_final = mysql_query($sql_asesoria_final);
$query_cumplimiento_inicial = mysql_query($sql_cumplimiento_inicial);
$query_cumplimiento_final = mysql_query($sql_cumplimiento_final);

$fetch_ins_inicial = mysql_fetch_row($query_ins_inicial);
$fetch_ins_final = mysql_fetch_row($query_ins_final);
$fetch_nps = mysql_fetch_row($query_nps);

$fetch_claridad_inicial = mysql_fetch_row($query_claridad_inicial);
$fetch_claridad_final = mysql_fetch_row($query_claridad_final);
$fetch_amabilidad_inicial = mysql_fetch_row($query_amabilidad_inicial);
$fetch_amabilidad_final = mysql_fetch_row($query_amabilidad_final);
$fetch_asesoria_inicial = mysql_fetch_row($query_asesoria_inicial);
$fetch_asesoria_final = mysql_fetch_row($query_asesoria_final);
$fetch_cumplimiento_inicial = mysql_fetch_row($query_cumplimiento_inicial);
$fetch_cumplimiento_final = mysql_fetch_row($query_cumplimiento_final);

// INS + NPS
$count_ins_inicial = $fetch_ins_inicial[0];
$count_ins_final = $fetch_ins_final[0];
$count_nps = $fetch_nps[0];

$promotores = $fetch_nps[1];
$detractores = $fetch_nps[2];

$ins_inicial = (($fetch_ins_inicial[1]-$fetch_ins_inicial[2])/$fetch_ins_inicial[0])*100;
$ins_final = (($fetch_ins_final[1]-$fetch_ins_final[2])/$fetch_ins_final[0])*100;
$nps = (($fetch_nps[1]-$fetch_nps[2])/$fetch_nps[0])*100;

// INDICADORES
$claridad = ((($fetch_claridad_inicial[1]/$fetch_claridad_inicial[0])+($fetch_claridad_final[1]/$fetch_claridad_final[0]))/2)*100;
$amabilidad = ((($fetch_amabilidad_inicial[1]/$fetch_amabilidad_inicial[0])+($fetch_amabilidad_final[1]/$fetch_amabilidad_final[0]))/2)*100;
$asesoria = ((($fetch_asesoria_inicial[1]/$fetch_asesoria_inicial[0])+($fetch_asesoria_final[1]/$fetch_asesoria_final[0]))/2)*100;
$cumplimiento = ((($fetch_cumplimiento_inicial[1]/$fetch_cumplimiento_inicial[0])+($fetch_cumplimiento_final[1]/$fetch_cumplimiento_final[0]))/2)*100;

$ind_siniestros = ($claridad+$amabilidad+$asesoria+$cumplimiento)/4;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Reporte Data</title>

    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="../lib/css/animate.css" rel="stylesheet">
    <link href="../lib/css/style.css" rel="stylesheet">
    <link href="../lib/css/sweetalert.css" rel="stylesheet">
    <link href="../lib/css/plugins/datapicker/datepicker3.css" rel="stylesheet">       
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
                                <li><a href="modify_pass.php?id_usuario=<?php echo $id_usuario;?>">Cambiar Contraseña</a></li>
                                <li><a href="log_out.php">Salir</a></li>
                            </ul>
                    </div>

                    <div class="logo-element">

                       <img src="../favicon.ico" width="25" height="25">
                    </div>
                </li>

                <li>
                    <a href="panel.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>"><i class="fa fa-dashboard"></i> <span class="nav-label">Panel</span></a>
                </li>
                <li>
                    <a href="mediciones.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Mediciones</span></a>
                </li>
                <li class="active">
                    <a href=""><i class="fa fa-arrow-circle-o-right"></i> <span class="nav-label">Proyectos</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="active"><a><i class="fa fa-bar-chart-o"></i> Calidad Percibida<span class="fa arrow"></span></a>
							<ul class="nav nav-third-level collapse">
								<li><a href="reporte_areas.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>">Reporte por Areas</a></li>
								<li><a href="reporte_historico.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>">Reporte Histórico</a></li>
								<li><a href="reporte_interacciones_i.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>">Reporte por Interacciones</a></li>
								<li><a href="reporte_interacciones.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>">Reporte de Agencias</a></li>
								<li><a href="reporte_motivos.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>">Reporte de Motivos</a></li>
								<li><a href="reporte_preguntas.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>">Reporte por Preguntas</a></li>
								<li class="active"><a href="reporte_data.php?region=<?php echo $region; ?>&area=<?php echo $area; ?>&agencia=<?php echo $agencia; ?>&mes=<?php echo $mes; ?>&ano=<?php echo $ano; ?>">Data</a></li>
								
							</ul>
						</li>
                        <!--
						<li><a href="enc_vent_indiv.php">MA</a></li>
                        <li><a href="enc_siniestro_vam.php">CI</a></li>
						-->
                    </ul>
                </li>

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
                
                <li>
                    <a href="sms.php"><i class="fa fa-phone-square"></i> <span class="nav-label">Cargar Archivo</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                        <li><a href="sms_upload_file.php">Cargar Archivo</a></li>

                    </ul>
                </li>
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
                    <h2>Reporte Data</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="panel.php">Dashboard</a>
                        </li>
                        
                        <li class="active">
                            <strong>Reporte Data</strong>
                        </li>
                    </ol>
                </div>
            </div>

        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="row">
                <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Reporte Calidad Percibida - Data</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        
                        <th width="10%">Fecha Interacción</th>
						<th>Nombre del Cliente</th>
                        <th width="10%" hidden>Cédula</th>
                        <th width="10%">Agencia</th>
                        <th width="10%">Tipo Contacto</th>
						<th width="10%">Trámite</th>
						<?php
							if($pregunta_revisar == 1 && $siniestro == "Siniestro Inicial")
							{
						?>
						<th width="10%">El asesor le dio la bienvenida y salió a recibirlo?</th>
                        <?php
							}
							if($pregunta_revisar == 2 || $pregunta_revisar == 250)
							{
						?>
						<th width="10%">Claridad con la que comunicó información brindada por usted?</th>
                        <?php
							}
							if($pregunta_revisar == 3 || $pregunta_revisar == 130)
							{
						?>
						<th width="10%">Actitud demostrada para entender su necesidad y resolver su requerimiento?</th>
                        <?php
							}
							if($pregunta_revisar == 4 || $pregunta_revisar == 410)
							{
						?>
						<th width="10%">Iniciativa para buscar una solución a su requerimiento?</th>
                        <?php
							}
							if($pregunta_revisar == 5 || $pregunta_revisar == 250)
							{
						?>
						<th width="10%">Nivel de conocimiento que demostró al brindar la información solicitada?</th>
						<?php
							}
							if($pregunta_revisar == 6)
							{
						?>
						<th width="10%">Agilidad con la que atendió su requerimiento?</th>
						<?php
							}
							if($pregunta_revisar == 7)
							{
						?>
						<th width="10%">Asesor le brindó información adicional sobre nuestros servicios?</th>
						<?php
							}
							if($pregunta_revisar == 8)
							{
						?>
						<th>Comodidad de oficina en la que fué atendido?</th>
						<th>Porqué?</th>
						<?php
							}
							if($pregunta_revisar == 9)
							{
						?>
						<th>Tiempo de espera en fila antes de ser atendido?</th>
						<th>Porqué?</th>
						<?php
							}
							if($pregunta_revisar == 10 || $pregunta_revisar == 410)
							{
						?>
						<th>Su requerimiento o consulta fué solucionado?</th>
						<th>Porqué?</th>
						<?php
							}
							if($pregunta_revisar == 11)
							{
						?>
						<th width="10%">Antes de su visita intentó gestionar su requerimiento en otro canal?</th>
						<?php
							}
							if($pregunta_revisar == 12)
							{
						?>
						<th width="10%">Cuál canal?</th>
						<?php
							}
							if($pregunta_revisar == 13)
							{
						?>
						<th>Qué tan satisfecho se encuetra con el servicio recibido en BGR?</th>
						<th>Porqué?</th>
						<?php
							}
							if($pregunta_revisar == 14)
							{
						?>
						<th>Deacuerdo a su experiencia en qué nivel está dispuesto a recomendar BGR?</th>
						<th>Porqué?</th>
						<?php
							}
							if($pregunta_revisar == 15)
							{
						?>
						<th>Qué tanto esfuerzo personal le generó a usted el trámite?</th>
						<th>Porqué?</th>
						<?php
							}
						?>
                    </tr>
                    </thead>
                        <tbody>
						<?php
							$sql_preguntas = "SELECT pe.fecha_interaccion, c.nombre, pe.cedula, pe.sucursal, pe.tipocontacto, pe.tramites, pe.amabilidadconlaquefueatendido p1, claridadconlaquecomunicoinformacionbrindadaporusted p2, actituddemostradaparaentendersunecesidadyresolversurequerimiento p3, iniciativaparabuscarunasolucionasurequerimiento p4, niveldeconocimientoquedemostroalbrindarlainformacionsolicitada p5, agilidadconlaqueatendiosurequerimiento p6, asesorlebrindoinformacionadicionalsobrenuestrosservicios p7, comodidaddeoficinaenlaquefueatendido p8, porquemotivobrindaestacalificacionOCHO p8p, tiempodeesperaenfilaantesdeseratendido p9, porquemotivobrindaestacalificacionNUEVE p9p, surequerimientoconsultafuesolucionado p10, porquemotivobrindaestacalificacionDIEZ p10p, antesdesuvisitaintentogestionarsurequerimientoenotrocanal p11, cualcanal p12, quetansatisfechoseencuetraconelserviciorecibidoenbgr p13, porquemotivobrindaestacalificacionTRECE p13p, deacuerdoasuexperienciaenquenivelestadispuestoarecomendarbgr p14, porquemotivobrindaestacalificacionCATORCE p14p, comocalificafacilidad p15, porquemotivobrindaestacalificacionQUINCE p15p FROM sys_preguntas_encuesta pe, sys_clientes c WHERE c.id_cliente = pe.id_cliente AND motivocontacto = 'Encuesta Efectiva'";
							if($id_rol == 8)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Machala'";
							}
							if($id_rol == 9)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Cuenca'";
							}
							if($id_rol == 10)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Taura'";
							}
							if($id_rol == 11)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Sucursal Mayor'";
							}
							if($id_rol == 12)
							{
								$sql_preguntas .= " AND pe.sucursal IN ('Sucursal Mayor', 'Taura')";
							}
							if($id_rol == 13)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Huancavilca'";
							}
							if($id_rol == 14)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Fae'";
							}
							if($id_rol == 15)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Salinas'";
							}
							if($id_rol == 16)
							{
								$sql_preguntas .= " AND pe.sucursal IN ('Fae', 'Huancavilca', 'Salinas')";
							}
							if($id_rol == 17)
							{
								$sql_preguntas .= " AND pe.sucursal = 'I Zona Naval'";
							}
							if($id_rol == 18)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Base Naval Sur'";
							}
							if($id_rol == 19)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Manta'";
							}
							if($id_rol == 20)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Latacunga'";
							}
							if($id_rol == 21)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Loja'";
							}
							if($id_rol == 22)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Riobamba'";
							}
							if($id_rol == 23)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Sur'";
							}
							if($id_rol == 24)
							{
								$sql_preguntas .= " AND pe.sucursal = 'Atahualpa'";
							}
							if($id_rol == 25)
							{
								$sql_preguntas .= " AND pe.sucursal IN ('Atahualpa', 'Sur')";
							}
							if($id_rol == 26)
							{
								$sql_preguntas .= " AND pe.sucursal  = 'Hospital Militar'";
							}
							if($id_rol == 27)
							{
								$sql_preguntas .= " AND pe.sucursal  = 'Matriz'";
							}
							if($id_rol == 28)
							{
								$sql_preguntas .= " AND pe.sucursal  = 'Carolina'";
							}
							if($id_rol == 29)
							{
								$sql_preguntas .= " AND pe.sucursal  = 'Esmeraldas'";
							}
							if($id_rol == 30)
							{
								$sql_preguntas .= " AND pe.sucursal  IN ('Matriz', 'Esmeraldas', 'Carolina')";
							}
							if($id_rol == 31)
							{
								$sql_preguntas .= " AND pe.sucursal  = 'Recoleta'";
							}
							if($id_rol == 32)
							{
								$sql_preguntas .= " AND pe.sucursal  = 'Espe'";
							}
							if($id_rol == 33)
							{
								$sql_preguntas .= " AND pe.sucursal  IN ('Recoleta', 'Espe')";
							}
							if($id_rol == 34)
							{
								$sql_preguntas .= " AND pe.sucursal  = 'Prensa'";
							}
							if($id_rol == 35)
							{
								$sql_preguntas .= " AND pe.sucursal  = 'Condado'";
							}
							if($id_rol == 36)
							{
								$sql_preguntas .= " AND pe.sucursal  IN ('Prensa', 'Condado')";
							}
							if($pregunta_revisar == 2)
							{
								$sql_preguntas .= " AND  claridadconlaquecomunicoinformacionbrindadaporusted is not null";
							}
							if($pregunta_revisar == 4)
							{
								$sql_preguntas .= " AND iniciativaparabuscarunasolucionasurequerimiento is not null";
							}
							if($pregunta_revisar == 5)
							{
								$sql_preguntas .= " AND niveldeconocimientoquedemostroalbrindarlainformacionsolicitada is not null";
							}
							if($pregunta_revisar == 7)
							{
								$sql_preguntas .= " AND asesorlebrindoinformacionadicionalsobrenuestrosservicios is not null";
							}
							if($agencia == null && $region == null && $area == null && $mes == null && $ano == $fecha_a)
							{
								$sql_preguntas .= " AND year(fecha_interaccion) = '".$ano."' AND month(fecha_interaccion) = '".date('m')."'";
							}
							if(isset($_REQUEST['interaccion']) && $_REQUEST['interaccion'] <> '0')
							{
								$sql_preguntas .= " AND pe.tramites = '".$interaccion."'";
							}
							if(isset($_REQUEST['region']) && $_REQUEST['region'] <> '0')
							{
								$sql_preguntas .= " AND pe.region = '".$region."'";
							}
							if(isset($_REQUEST['agencia']) && $_REQUEST['agencia'] <> '0')
							{
								$sql_preguntas .= " AND pe.sucursal = '".$agencia."'";
							}
							if(isset($_REQUEST['area']) && $_REQUEST['area'] <> '0')
							{
								$sql_preguntas .= " AND pe.tipocontacto = '".$area."'";
							}							
							if(isset($_REQUEST['mes']) && $_REQUEST['mes'] <> '0')
							{
								$sql_preguntas .= " AND month(pe.fecha_interaccion) = '".$mes."'";
							}
							if(isset($_REQUEST['ano']) && $_REQUEST['ano'] <> '0')
							{
								$sql_preguntas .= " AND year(pe.fecha_interaccion) = '".$ano."'";
							}

							$query_preguntas = mysql_query($sql_preguntas);
							while($fetch_preguntas = mysql_fetch_array($query_preguntas))
							{
						?>
						<tr class="gradeX">
                            <td>
								<?php echo $fetch_preguntas['fecha_interaccion']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['nombre']; ?>
							</td>
							<td hidden>
								<?php echo $fetch_preguntas['cedula']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['sucursal']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['tipocontacto']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['tramites']; ?>
							</td>
							<?php
								if($pregunta_revisar == 1 || $pregunta_revisar == 130)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p1']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 2 || $pregunta_revisar == 250)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p2']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 3 || $pregunta_revisar == 130)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p3']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 4 || $pregunta_revisar == 410)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p4']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 5 || $pregunta_revisar == 250)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p5']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 6)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p6']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 7)
								{
							?>
							<td>
								<?php echo strtoupper($fetch_preguntas['p7']); ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 8)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p8']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['p8p']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 9)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p9']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['p9p']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 10 || $pregunta_revisar == 410)
								{
							?>
							<td>
								<?php echo strtoupper($fetch_preguntas['p10']); ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['p10p']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 11)
								{
							?>
							<td>
								<?php echo strtoupper($fetch_preguntas['p11']); ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 12)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p12']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 13)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p13']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['p13p']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 14)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p14']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['p14p']; ?>
							</td>
							<?php
								}
								if($pregunta_revisar == 15)
								{
							?>
							<td>
								<?php echo $fetch_preguntas['p15']; ?>
							</td>
							<td>
								<?php echo $fetch_preguntas['p15p']; ?>
							</td>
							<?php
								}
							?>
                        </tr>
						<?php
							}
						?>
                        </tbody>
                    </table>
                        </div>

                    </div>
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

			
    });
</script>

</body>

</html>
