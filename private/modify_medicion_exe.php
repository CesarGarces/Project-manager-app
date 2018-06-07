<?php

require'../users/class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;


if($user == ''){
    echo "vacio";
   // header('Location: ../index.php?error=2');
}

?>
<?php


require'../users/class/config.php';
require'../users/class/mediciones.php';
require'../users/class/dbactions.php';



$objCon = new Connection();
$objCon->get_connected();

$objUse = new Medicion();

$id_medicion = $_POST['id_medicion'];
$objUse->modify_medicion($id_medicion);

header('Location: mediciones.php');

?>