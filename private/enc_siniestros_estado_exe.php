<?php
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
require'../users/class/encuestas.php';

$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$objEnc = new Encuesta();
$img_users = $objUse->img_users();
$idIzo = $_POST['id_izo'];
$idUser = $_POST['id_usuario'];
$siniestro = $_POST['siniestro'];
$contacto_estado = $_POST['contacto_estado'];

if($siniestro== "Siniestro Inicial"){
$query = "UPDATE base_siniestro_inicial set estado = '".$contacto_estado."'  where id_izo = '".$idIzo."' ";
$result = mysql_query($query);
}
if($siniestro== "Siniestro Final"){
$query = "UPDATE base_siniestro_final set estado = '".$contacto_estado."'  where id_izo = '".$idIzo."' ";
$result = mysql_query($query);
}
    

if($contacto_estado == "encuestando"){
	switch($siniestro){
					
					case "Siniestro Inicial":

					$query = "UPDATE base_siniestro_inicial set estado = '".$contacto_estado."'  where id_izo = '".$idIzo."' ";
					$result = mysql_query($query);

						header('Location: enc_siniestros_exe.php?id_izo='.$idIzo.'&siniestro=Siniestro Inicial');
						break;
				
					case "Siniestro Final":

					$query = "UPDATE base_siniestro_final set estado = '".$contacto_estado."'  where id_izo = '".$idIzo."' ";
					$result = mysql_query($query);

						header('Location: enc_siniestros_exe.php?id_izo='.$idIzo.'&siniestro=Siniestro Final');
						break;
				}
}else{
	header('Location: enc_siniestros.php');
}
?>