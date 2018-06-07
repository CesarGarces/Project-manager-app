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
$id_usr = $row_rol['id_usuario'];

date_default_timezone_set('America/Bogota');
$fini=date('Y-m-01');
$fifin=date('Y-m-s');
$fecha=date('Y-m-d');

/*************** Parametros ***************/
$asesor = isset($_REQUEST['agencia']) ? $_REQUEST['agencia'] : null ;
$segmento = isset($_REQUEST['region']) ? $_REQUEST['region'] : null ;
$aliado = isset($_REQUEST['area']) ? $_REQUEST['area'] : null ;
$tecnologia = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : null ;

$error = "";

//Validamos si hay datos por Guardar y/o Modificar
if(isset($_REQUEST['action']) && isset($_REQUEST['form']))
{
    if($_REQUEST['form'] == "cargos")
    {
        if($_REQUEST['action'] == "mod")
        {
            $query_update_cargos = mysql_query("UPDATE sys_cargos SET id_dependencia = ".$_REQUEST['dependencia'].", nombre = '".$_REQUEST['nombrecargo']."' WHERE id_cargo = ".$_REQUEST['cargo']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            $query_insert_cargos = mysql_query("INSERT INTO sys_cargos(id_dependencia, nombre) VALUES (".$_REQUEST['dependencia'].",'".$_REQUEST['nombrecargo']."')");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_cargos = mysql_query("DELETE FROM sys_cargos WHERE id_cargo = ".$_REQUEST['cargo']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }

/**************Dependencias********************/
if($_REQUEST['form'] == "dependencias")
    {
        if($_REQUEST['action'] == "mod")
        {
        
            $query_update_dependencias = mysql_query("UPDATE sys_dependencias SET  nombre = '".$_REQUEST['nombredependencia']."', id_usuario_modifica = '".$id_usr."',  fecha_modifica = now() WHERE id_dependencia = '".$_REQUEST['dependencia']."' ");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            $query_insert_dependencias = mysql_query("INSERT INTO sys_dependencias(id_dependencia, nombre, id_usuario_crea, id_usuario_modifica, fecha_crea, fecha_modifica) VALUES (NULL ,'".$_REQUEST['nombredependencia']."', '".$id_usr."' , NULL, now(), NULL)");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_dependencias = mysql_query("DELETE FROM sys_dependencias WHERE id_dependencia = ".$_REQUEST['dependencia']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }

/**************Actividades********************/
if($_REQUEST['form'] == "actividades")
    {
        if($_REQUEST['action'] == "mod")
        {
        
            $query_update_actividades = mysql_query("UPDATE sys_actividades SET  nombre = '".$_REQUEST['nombreactividad']."', id_tipo_actividad = '".$_REQUEST['tipoactividad']."' WHERE id_sys_actividades = '".$_REQUEST['actividad']."' ");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            $query_insert_actividades = mysql_query("INSERT INTO sys_actividades(id_sys_actividades,id_tipo_actividad, nombre) VALUES (NULL ,'".$_REQUEST['tipoactividad']."', '".$_REQUEST['nombreactividad']."')");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_actividades = mysql_query("DELETE FROM sys_actividades WHERE id_sys_actividades = ".$_REQUEST['actividad']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }

/**************tipo de actividades********************/
if($_REQUEST['form'] == "tipoactividad")
    {
        if($_REQUEST['action'] == "mod")
        {
        
            $query_update_tipoacti = mysql_query("UPDATE sys_tipo_actividades SET  nombre = '".$_REQUEST['nombretipoactividad']."', id_usuario_modifica = '".$id_usr."',  fecha_modifica = now() WHERE id_tipo_actividad = '".$_REQUEST['tipoactividad']."' ");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            $query_insert_tipoacti = mysql_query("INSERT INTO sys_tipo_actividades(id_tipo_actividad, nombre, id_usuario_crea, id_usuario_modifica, fecha_crea, fecha_modifica) VALUES (NULL ,'".$_REQUEST['nombretipoactividad']."', '".$id_usr."' , NULL, now(), NULL)");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_tipoacti = mysql_query("DELETE FROM sys_tipo_actividades WHERE id_tipo_actividad = ".$_REQUEST['tipoactividad']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }


    /**************Generos********************/
if($_REQUEST['form'] == "genero")
    {
        if($_REQUEST['action'] == "mod")
        {
       
            $query_update_tipoacti = mysql_query("UPDATE sys_generos SET  nombre = '".$_REQUEST['nombregenero']."' WHERE id_genero = '".$_REQUEST['genero']."' ");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            $query_insert_genero = mysql_query("INSERT INTO sys_generos(id_genero, nombre) VALUES (NULL ,'".$_REQUEST['nombregenero']."')");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_tipoacti = mysql_query("DELETE FROM sys_generos WHERE id_genero = ".$_REQUEST['genero']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }

    /**************proyecto********************/
if($_REQUEST['form'] == "proyecto")
    {
        if($_REQUEST['action'] == "mod")
        {
        
            $query_update_tipoacti = mysql_query("UPDATE sys_tipo_proyectos SET  nombre = '".$_REQUEST['nombreproyecto']."' WHERE id_tipo_proyecto = '".$_REQUEST['proyecto']."' ");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
           
            $query_insert_genero = mysql_query("INSERT INTO sys_tipo_proyectos(id_tipo_proyecto, nombre) VALUES (NULL ,'".$_REQUEST['nombreproyecto']."')");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_tipoacti = mysql_query("DELETE FROM sys_tipo_proyectos WHERE id_tipo_proyecto = ".$_REQUEST['proyecto']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }

      /**************rol********************/
if($_REQUEST['form'] == "rol")
    {
        if($_REQUEST['action'] == "mod")
        {
        
            $query_update_tipoacti = mysql_query("UPDATE sys_perfiles SET  nombre = '".$_REQUEST['nombrerol']."' WHERE id_perfil = '".$_REQUEST['rol']."' ");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            
            $query_insert_genero = mysql_query("INSERT INTO sys_perfiles(id_perfil, nombre, id_usuario_crea, id_usuario_modifica, fecha_crea, fecha_modifica) VALUES (NULL ,'".$_REQUEST['nombrerol']."', '".$id_usr."' , NULL, now(), NULL)");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_tipoacti = mysql_query("DELETE FROM sys_perfiles WHERE id_perfil = ".$_REQUEST['rol']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }

    /**************documentos********************/
if($_REQUEST['form'] == "documento")
    {
        if($_REQUEST['action'] == "mod")
        {
        
            $query_update_tipoacti = mysql_query("UPDATE sys_tipo_documentos SET nombre = '".$_REQUEST['nombredocumento']."', sigla = '".$_REQUEST['sigladocumento']."' WHERE id_tipo_documento = '".$_REQUEST['documento']."' ");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            
            $query_insert_genero = mysql_query("INSERT INTO sys_tipo_documentos(id_tipo_documento, nombre, sigla, id_usuario_crea, fecha_crea, id_usuario_modifica, fecha_modifica) VALUES (NULL ,'".$_REQUEST['nombredocumento']."','".$_REQUEST['sigladocumento']."', '".$id_usr."' , now(), NULL, NULL)");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_tipoacti = mysql_query("DELETE FROM sys_tipo_documentos WHERE id_tipo_documento = ".$_REQUEST['documento']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }


/**************Contratos********************/
if($_REQUEST['form'] == "contrato")
    {
        if($_REQUEST['action'] == "mod")
        {
        
            $query_update_tipoacti = mysql_query("UPDATE sys_tipo_contrato SET nombre = '".$_REQUEST['nombrecontrato']."', horas = '".$_REQUEST['horas']."' WHERE id_tipo_contrato = '".$_REQUEST['contrato']."' ");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "new")
        {
            
            $query_insert_genero = mysql_query("INSERT INTO sys_tipo_contrato(id_tipo_contrato, nombre, horas) VALUES (NULL ,'".$_REQUEST['nombrecontrato']."', '".$_REQUEST['horas']."')");
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
        if($_REQUEST['action'] == "del")
        {
            $query_insert_tipoacti = mysql_query("DELETE FROM sys_tipo_contrato WHERE id_tipo_contrato = ".$_REQUEST['contrato']);
            $msj = $_REQUEST['msj'];
            echo "<script>";
            echo "setTimeout(function() { ";
            echo "toastr.options = { ";
            echo "'closeButton': true, ";
            echo "'debug': false, ";
            echo "'progressBar': true, ";
            echo "'preventDuplicates': false, ";
            echo "'positionClass': 'toast-top-right', ";
            echo "'onclick': null, ";
            echo "'showDuration': '400', ";
            echo "'hideDuration': '1000', ";
            echo "'timeOut': '3000', ";
            echo "'extendedTimeOut': '1000', ";
            echo "'showEasing': 'swing', ";
            echo "'hideEasing': 'linear', ";
            echo "'showMethod': 'fadeIn', ";
            echo "'hideMethod': 'fadeOut' ";
            echo "}; ";
            echo "toastr.success('".$msj."', 'IZOBoard'); ";
            echo "}, 1000); ";
            echo "</script>";
        }
    }

}

//Datos del Usuario
$sql_usuario = mysql_query("SELECT id_usuario, CONCAT(primer_nombre,' ',primer_apellido,' ',segundo_apellido) as nombres FROM sys_usuarios WHERE login = '".$user."'");
$fetch_usuario = mysql_fetch_row($sql_usuario);

//Datos del Empleado
$sql_empleado = mysql_query("SELECT p.nombre, (TIMESTAMPDIFF(MONTH,e.fecha_ingreso,CURDATE())) tiempo, c.nombre cargo, d.nombre dependencia, id_empleado FROM sys_empleados e, sys_paises p, sys_cargos c, sys_dependencias d WHERE p.id_pais = e.id_pais AND e.id_cargo = c.id_cargo AND c.id_dependencia = d.id_dependencia AND e.id_usuario = $fetch_usuario[0]");
$fetch_empleado = mysql_fetch_row($sql_empleado);

//Proyectos Activos
$sql_proyectos = mysql_query("SELECT COUNT(1) FROM sys_empleado_rol_proyectos WHERE id_empleado = $fetch_empleado[4]");
$fetch_proyectos = mysql_fetch_row($sql_proyectos);

//Datos de la semana
$sql_semanal = mysql_query("SELECT COUNT(1) FROM pjc_seguimiento_actividades WHERE CURDATE() BETWEEN DATE_SUB(CURDATE(), INTERVAL DAYOFWEEK(CURDATE())-1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY) AND id_empleado = $fetch_empleado[4]");
$fetch_semanal = mysql_fetch_row($sql_semanal);

//Registros de hoy
$sql_dehoy = mysql_query("SELECT COUNT(1) FROM pjc_seguimiento_actividades WHERE fecha_diligencia = CURDATE() AND id_empleado = $fetch_empleado[4]");
$fetch_dehoy = mysql_fetch_row($sql_dehoy);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IZO | Panel</title>

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
								<li><a href="dashboard.php">Perfil</a></li>
                                <li><a href="modify_pass.php">Cambiar Contraseña</a></li>
                                <li><a href="log_out.php">Salir</a></li>
                            </ul>
                    </div>

                    <div class="logo-element">

                       <img src="../favicon.ico" width="25" height="25">
                    </div>
                </li>

                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard </span></a>
                </li>
                <li>
                    <a href="seguimiento.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Seguimiento </span></a>
                </li>
				<li>
                    <a href="#"><i class="fa fa-check-square-o"></i> <span class="nav-label">Reportes </span></a>
                </li>
                <?php
				if($id_rol <= 6)
				{
				?>
                <li class="active">
                    <a href=""><i class="fa fa-cog"></i> <span class="nav-label">Configuraciones </span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
						<li class="active"><a href="configuraciones_maestras.php"><i class="fa fa-slideshare"></i> Maestros</span></a></li>   
						<li><a href="configuraciones_maestras2.php"><i class="fa fa-slideshare"></i> Proyectos</a></li>   
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
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Bienvenid@ .</span>
                </li>
                <!--<li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>-->
                <!--<li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>-->


                <li>
                    <a href="log_out.php">
                        <i class="fa fa-sign-out"></i> Salir
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12" align="center">
                    <table>
                        <tr align="center" width="100%">
                            <td align="center" width="100%">
								<br>
                                <img align="center" src="../lib/img/ccx_logo.png" height="20%" >
                            </td>
                        </tr>
                    </table>    
                </div>
            </div>      
                    
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Cargos </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar los Cargos existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editCargo(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Cargo" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarCargos();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showCargos">
                        </div>
                    </div>
                </div>





                <!--Dependencias-->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Dependencias </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar las Dependencias existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editDependencia(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Dependencia" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarDependencias();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showDependencias">
                        </div>
                    </div>
                </div>

                <!--Actividades-->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Actividades </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar las Actividades existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editActividad(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Actividad" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarActividades();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showActividades">
                        </div>
                    </div>
                </div>

                <!--tipo Actividades-->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Tipo de Actividades </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar los Tipos de Actividades existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="edittipoActividad(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar tipo Actividad" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisartipoActividades();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showtipoActividades">
                        </div>
                    </div>
                </div>


                <!--tipo Actividades-->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Géneros </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar los Géneros existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editGeneros(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Género" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarGeneros();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showGeneros">
                        </div>
                    </div>
                </div>


                <!--tipo Proyectos-->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Tipos de Proyectos </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar los Tipos de Proyectos existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editProyectos(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Proyecto" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarProyectos();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showProyectos">
                        </div>
                    </div>
                </div>

                <!--tipo documentos-->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de tipos de Documentos </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar los Documentos existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editDocumentos(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Documento" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarDocumentos();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showDocumentos">
                        </div>
                    </div>
                </div>

                <!--Roles-->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Perfiles </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar los Perfiles existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editRoles(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Proyecto" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarRoles();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showRoles">
                        </div>
                    </div>
                </div>

                <!--Contratos-->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Configuración de Tipos de Contratos </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table width="100%">
                            <tr>
                            <td width="75%">
                            <h5>Configuración que te permite parametrizar los Tipos de Contratos existentes en el Sistema.</h5>
                            </td>
                            <td width="25%" align="center">
                            <a onclick="editContratos(0);" data-toggle="modal" data-target="#modal-form" rel="tooltip" title data-placement="top" data-original-title="Modificar Contrato" style="text-decoration:none;color:white;" class="btn btn-w-m btn-primary"><i class="fa fa-plus"></i> Adicionar</a> <button type="button" onclick="revisarContratos();" class="btn btn-w-m btn-success"><i class="fa fa-search"></i> Revisar</button>
                            </td>
                            </tr>
                        </table>
                        <div id="showContratos">
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div id="modal-form" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="fa fa-laptop modal-icon"></i>
                                <h4 class="modal-title">Panel de Configuración</h4>
                                <small class="font-bold">Por medio de esta ventana podrás Crear / Editar / Eliminar los maestros del Sistema.</small>
                            </div>
                            <div class="modal-content">
                                <div class="modal-body" id="modalAction">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
                
        </div>
        <div class="footer">
            <div class="pull-right">
                <strong>Powered By</strong> Synergy Contact.
            </div>
            <div>
                <strong>Copyright</strong> IZO &copy; 2015-2017
            </div>
        </div>
    
    
</div>
</div>
                    

    <!-- Mainly scripts -->
    <script src="../lib/js/jquery-2.1.1.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="../lib/js/inspinia.js"></script>
    <script src="../lib/js/plugins/pace/pace.min.js"></script>


    <script src="../lib/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../lib/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../lib/js/plugins/flot/jquery.flot.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../lib/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="../lib/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../lib/js/demo/peity-demo.js"></script>

   <!-- JSKnob -->
   <script src="../lib/js/plugins/jsKnob/jquery.knob.js"></script>
    
   <!-- Data picker -->
   <script src="../lib/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="../lib/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="../lib/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- GITTER -->
    <script src="../lib/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="../lib/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../lib/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="../lib/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="../lib/js/plugins/toastr/toastr.min.js"></script>

    <!-- d3 and c3 charts -->
    <script src="../lib/js/plugins/d3/d3.min.js"></script>
    <script src="../lib/js/plugins/c3/c3.min.js"></script>

    <script>
        $(document).ready(function() {

        
        });
        
        function revisarCargos()
        {
            $("#showCargos").load("maestros/cargos.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showCargos").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editCargo(idCargo)
        {
            $("#modalAction").load("maestros/editCargos.php",{ mod: idCargo }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteCargo(idCargo)
        {
            $("#modalAction").load("maestros/deleteCargos.php",{ del: idCargo }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
/*************************Dependencias*************************/

        function revisarDependencias()
        {
            $("#showDependencias").load("maestros/dependencias.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showDependencias").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editDependencia(idDependencia)
        {
            $("#modalAction").load("maestros/editDependencias.php",{ mod: idDependencia }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteDependencia(idDependencia)
        {
            $("#modalAction").load("maestros/deleteDependencias.php",{ del: idDependencia }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
/*************************Actividades*************************/

        function revisarActividades()
        {
            $("#showActividades").load("maestros/actividades.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showActividades").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editActividad(idActividad)
        {
            $("#modalAction").load("maestros/editActividades.php",{ mod: idActividad }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteActividad(idActividad)
        {
            $("#modalAction").load("maestros/deleteActividades.php",{ del: idActividad }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        /*************************Tipo actividades*************************/

        function revisartipoActividades()
        {
            $("#showtipoActividades").load("maestros/tipoactividades.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showtipoActividades").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function edittipoActividad(idtipoActividad)
        {
            $("#modalAction").load("maestros/edittipoActividades.php",{ mod: idtipoActividad }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deletetipoActividad(idtipoActividad)
        {
            $("#modalAction").load("maestros/deletetipoActividades.php",{ del: idtipoActividad }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
/*************************Generos*************************/

        function revisarGeneros()
        {
            $("#showGeneros").load("maestros/generos.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showGeneros").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editGeneros(idGenero)
        {
            $("#modalAction").load("maestros/editgeneros.php",{ mod: idGenero }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteGeneros(idGenero)
        {
            $("#modalAction").load("maestros/deletegeneros.php",{ del: idGenero }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }

/*************************Proyectos*************************/

        function revisarProyectos()
        {
            $("#showProyectos").load("maestros/tipoproyectos.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showProyectos").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editProyectos(idProyecto)
        {
            $("#modalAction").load("maestros/edittipoproyectos.php",{ mod: idProyecto }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteProyectos(idProyecto)
        {
            $("#modalAction").load("maestros/deletetipoproyectos.php",{ del: idProyecto }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }

        /*************************Roles*************************/

        function revisarRoles()
        {
            $("#showRoles").load("maestros/roles.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showRoles").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editRoles(idRol)
        {
            $("#modalAction").load("maestros/editroles.php",{ mod: idRol }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteRoles(idRol)
        {
            $("#modalAction").load("maestros/deleteroles.php",{ del: idRol }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }

        /*************************Documentos*************************/

        function revisarDocumentos()
        {
            $("#showDocumentos").load("maestros/documentos.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showDocumentos").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editDocumentos(idDocumento)
        {
            $("#modalAction").load("maestros/editdocumentos.php",{ mod: idDocumento }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteDocumentos(idDocumento)
        {
            $("#modalAction").load("maestros/deletedocumentos.php",{ del: idDocumento }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }

        /*************************Contratos*************************/

        function revisarContratos()
        {
            $("#showContratos").load("maestros/contratos.php",{ }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#showContratos").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function editContratos(idContrato)
        {
            $("#modalAction").load("maestros/editcontratos.php",{ mod: idContrato }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }
        
        function deleteContratos(idContrato)
        {
            $("#modalAction").load("maestros/deletecontratos.php",{ del: idContrato }, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error!, algo ha sucedido: ";
                    $("#modalAction").html(msg + xhr.status + " " + xhr.statusText);
                }
            });
        }

    </script>



</body>



</html>
