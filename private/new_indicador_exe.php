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
require'../users/class/users.php';
require'../users/class/dbactions.php';
require'../users/class/clients.php';



$objCon = new Connection();
$objCon->get_connected();

$objUse = new clients();

$objUse->new_indicador();

header('Location: indicador_list.php');

?>