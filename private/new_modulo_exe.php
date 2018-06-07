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
require'../users/class/modulos.php';
require'../users/class/dbactions.php';



$objCon = new Connection();
$objCon->get_connected();

$objUse = new Modulo();

$objUse->new_modulo();

header('Location: modulos_list.php');

?>