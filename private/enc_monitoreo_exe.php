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
$objEnc = new Encuesta();

$sql = "INSERT INTO enc_monitoreo VALUES (
    NULL,
    '".$_POST['encuestador']."',
    '".$_POST['cod_monitor']."',
    '".$_POST['fecha_llamada']."',
    '".$_POST['id_llamada']."',
    '".$_POST['nom_asesor']."',
    '".$_POST['segmento_llamada']."',
    '".$_POST['tecnologia']."',
    '".$_POST['aliado']."',
    '".$_POST['uf_gestion']."',
    '".$_POST['uf_gestion_chek1']."',
    '".$_POST['uf_gestion_chek2']."',
    '".$_POST['uf_gestion_chek3']."',
    '".$_POST['uf_gestion_chek4']."',
    '".$_POST['uf_gestion_chek5']."',
    '".$_POST['uf_brinda_sol']."',
    '".$_POST['uf_brinda_sol_chek1']."',
    '".$_POST['uf_brinda_sol_chek2']."',
    '".$_POST['uf_brinda_sol_chek3']."',
    '".$_POST['uf_brinda_sol_chek4']."',
    '".$_POST['uf_brinda_sol_chek5']."',
    '".$_POST['uf_brinda_sol_chek6']."',
    '".$_POST['uf_brinda_sol_chek7']."',
    '".$_POST['uf_pac_cord']."',
    '".$_POST['uf_pac_cord_chek1']."',
    '".$_POST['uf_pac_cord_chek2']."',
    '".$_POST['uf_pac_cord_chek3']."',
    '".$_POST['uf_pac_cord_chek4']."',
    '".$_POST['uf_pac_cord_chek5']."',
    '".$_POST['uf_conf_segu']."',
    '".$_POST['uf_conf_segu_chek1']."',
    '".$_POST['uf_conf_segu_chek2']."',
    '".$_POST['uf_conf_segu_chek3']."',
    '".$_POST['uf_simplicidad']."',
    '".$_POST['uf_simplicidad_chek1']."',
    '".$_POST['uf_simplicidad_chek2']."',
    '".$_POST['uf_simplicidad_chek3']."',
    '".$_POST['uf_simplicidad_chek4']."',
    '".$_POST['uf_aban_llam']."',
    '".$_POST['uf_aban_llam_chek1']."',
    '".$_POST['uf_aban_llam_chek2']."',
    '".$_POST['uf_aban_llam_chek3']."',
    '".$_POST['neg_tiempo']."',
    '".$_POST['neg_tiempo_chek1']."',
    '".$_POST['neg_tiempo_chek2']."',
    '".$_POST['neg_tiempo_chek3']."',
    '".$_POST['neg_duracion']."',
    '".$_POST['neg_duracion_chek1']."',
    '".$_POST['neg_duracion_chek2']."',
    '".$_POST['neg_gest_com']."',
    '".$_POST['neg_gest_com_chek1']."',
    '".$_POST['neg_gest_com_chek2']."',
    '".$_POST['neg_gest_com_chek3']."',
    '".$_POST['neg_trans_pro']."',
    '".$_POST['neg_trans_pro_chek1']."',
    '".$_POST['meg_deriva']."',
    '".$_POST['meg_deriva_chek1']."',
    '".$_POST['meg_ocu_canal']."',
    '".$_POST['meg_ocu_canal_chek1']."',
    '".$_POST['macro']."',
    '".$_POST['macro2']."',
    '".$_POST['macro3']."',
    '".$_POST['anexo_fcr']."',
    '".$_POST['anexo_fcr_chek1']."',
    '".$_POST['anexo_fcr_chek2']."',
    '".$_POST['anexo_fcr_chek3']."',
    '".$_POST['anexo_fcr_chek4']."',
    '".$_POST['anexo_enc5']."',
    '".$_POST['anexo_enc6']."',
    '".$_POST['anexo_enc7']."',
    '".$_POST['anexo_enc8']."',
    '".$_POST['anexo_enc9']."',
    '".$_POST['anexo_enc10']."',
    '".$_POST['anexo_enc11']."',
    '".$_POST['anexo_enc12']."',
     now()
    )";

    
  $result = mysql_query($sql);
  header('Location: enc_monitoreo.php');

?>