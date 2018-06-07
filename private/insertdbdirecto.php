    <?php

    require'../users/class/sessions.php';
    $objses = new Sessions();
    $objses->init();

    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;


    if($user == ''){

       header('Location: ../index.php?error=2');
    }

    ?>
    <?php

    require'../users/class/config.php';
    require'../users/class/users.php';
    require'../users/class/dbactions.php';
    require'../users/class/mediciones.php';


    $objCon = new Connection();
    $objCon->get_connected();
    $objUse = new Users();
    $objMed = new Medicion();
    $list_role = $objUse->list_role();
    $list_medicion = $objMed->list_medicion();
    


    $img_users = $objUse->img_users();




    ?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>IZO | SMS</title>

        <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
        <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="../lib/css/animate.css" rel="stylesheet">
        <link href="../lib/css/style.css" rel="stylesheet">
        <link href="../lib/css/sweetalert.css" rel="stylesheet">
        <link href="../lib/css/plugins/dropzone/basic.css" rel="stylesheet">
        <link href="../lib/css/plugins/dropzone/dropzone.css" rel="stylesheet">
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

                        while($row=mysql_fetch_array($img_users)){?>


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
                                    <li><a href="log_out.php">Salir</a></li>
                                </ul>
                        </div>
                        <div class="logo-element">
                            <img src="../favicon.ico" width="25" height="25">
                        </div>
                    </li>
                    <li class="active">
                        <a href="panel.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Panel</span></a>
                    </li>
                    <li>
                        <a href="mediciones.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Mediciones</span></a>
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
                        <a href=""><i class="fa fa-sticky-note-o"></i> <span class="nav-label">Reportes</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="reporte_agentes.php">Asesores</a></li>
                            <li><a href="reporte_general.php">General</a></li>
                            <li><a href="reporte_dias.php">Días</a></li>

                        </ul>
                    </li>
                    <li class="active">
                        <a href=""><i class="fa fa-phone-square"></i> <span class="nav-label">SMS</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                            <li class="active"><a href="sms_upload_file.php">Cargar Archivo SMS</a></li>

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
                        <h2>Administracion Y Envio de Mensajes SMS</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="panel.php">Inicio</a>
                            </li>

                            <li class="active">
                                <strong>SMS Admin</strong>
                            </li>
                        </ol>
                    </div>
                </div>
            <div class="wrapper wrapper-content  animated fadeInRight">
                <div class="ibox col-md-6">
                    <div class="ibox-title">
                                <h5>Carga de Archivos - SMS Envio Masivo</h5>

                        </div>
                    <div class="ibox-content">
                            <form name="importa" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
                                <input type="file" name="excel" />
                        <input type="hidden" name="nombre_crea" value="<?php echo $_SESSION['user'];?>">
                        <input type="hidden" value="upload" name="action" />


                            <input type='submit' name='enviar'  value="Enviar" class="btn btn-primary" />
                        </div>
                    </div>
                    <div class="ibox col-md-6">

                    </div>
    </div>


    </form>



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

    <!-- Custom and plugin javascript -->
    <script src="../lib/js/inspinia.js"></script>
    <script src="../lib/js/plugins/pace/pace.min.js"></script>
    <script src="../lib/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../lib/js/plugins/dropzone/dropzone.js"></script>
    <script>


        $(document).ready(function () {

            $("#dropzone").dropzone({
                url: "<?php echo $PHP_SELF; ?>",
            });

    </script>
    <?php

                        
                       
                         



    date_default_timezone_set('America/Bogota');
    $fecha=date('Y-m-d H:i:s');
    $action ="";
    extract($_POST);
    if ($action == "upload"){
    //cargamos el archivo al servidor con el mismo nombre
    //solo le agregue el sufijo bak_

      //$crea = $_SESSION['user'];
      $archivo = $_FILES['excel']['name'];
      $tipo = $_FILES['excel']['type'];
      $destino = "bak_".$archivo;
      if (copy($_FILES['excel']['tmp_name'],$destino)) echo "";
      else echo "";
    ////////////////////////////////////////////////////////
    if (file_exists ("bak_".$archivo)){
    /** Clases necesarias */
    require_once('../lib/PHPExcel.php');
    require_once('../lib/PHPExcel/Reader/Excel2007.php');

    // Cargando la hoja de cálculo
    $objReader = new PHPExcel_Reader_Excel2007();
    $objPHPExcel = $objReader->load("bak_".$archivo);
    $objFecha = new PHPExcel_Shared_Date();

    // Asignar hoja de excel activa
    $objPHPExcel->setActiveSheetIndex(0);

    //conectamos con la base de datos


            // Llenamos el arreglo con los datos  del archivo xlsx
    $numrow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
    for ($i=1;$i<=$numrow;$i++){

      $_DATOS_EXCEL[$i]['id_tipo_identificacion'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['id_empresa']= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['id_rol']= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['id_estado'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['estado_civil'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['genero']= $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['login']= $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['password']= $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['primer_nombre']= $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['segundo_nombre']= $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['primer_apellido']= $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['segundo_apellido']= $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['email']= $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['celular']= $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['telefono']= $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['direccion']= $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['fecha_nacimiento']= $objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['fecha_nacimiento'] = ($_DATOS_EXCEL[$i]['fecha_nacimiento'] - 25568) * 86400;
      $_DATOS_EXCEL[$i]['fecha_nacimiento'] = date( 'Y-m-d', $_DATOS_EXCEL[$i]['fecha_nacimiento'] );
      $_DATOS_EXCEL[$i]['identificacion']= $objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['imagen']= $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['firma']= $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['id_usuario_crea']= $objPHPExcel->getActiveSheet()->getCell('U'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['id_usuario_modifica']= $objPHPExcel->getActiveSheet()->getCell('V'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['fecha_crea']= $objPHPExcel->getActiveSheet()->getCell('W'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['fecha_crea'] = ($_DATOS_EXCEL[$i]['fecha_crea'] - 25568) * 86400;
      $_DATOS_EXCEL[$i]['fecha_crea'] = date( 'Y-m-d', $_DATOS_EXCEL[$i]['fecha_crea'] );
      $_DATOS_EXCEL[$i]['fecha_modifica']= $objPHPExcel->getActiveSheet()->getCell('X'.$i)->getCalculatedValue();
      $_DATOS_EXCEL[$i]['fecha_modifica'] = ($_DATOS_EXCEL[$i]['fecha_modifica'] - 25568) * 86400;
      $_DATOS_EXCEL[$i]['fecha_modifica'] = date( 'Y-m-d', $_DATOS_EXCEL[$i]['fecha_modifica'] );
      
  
}   
}
//si por algo no cargo el archivo bak_ 
else{echo "Necesitas primero importar el archivo";}
$errores=0;
//recorremos el arreglo multidimensional 
//para ir recuperando los datos obtenidos
//del excel e ir insertandolos en la BD
foreach($_DATOS_EXCEL as $campo => $valor){
  $sql = "INSERT INTO sys_usuarios VALUES (NULL, '";
  foreach ($valor as $campo2 => $valor2){
    $campo2 == "fecha_modifica" ? $sql.= $valor2."');" : $sql.= $valor2."','";
  }
  $result = mysql_query($sql);
  if (!$result){ echo "Error al insertar registro ".$campo;$errores+=1;}
} 
/////////////////////////////////////////////////////////////////////////

echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
//una vez terminado el proceso borramos el 
//archivo que esta en el servidor el bak_
unlink($destino);
}

?>
</body>
</html>