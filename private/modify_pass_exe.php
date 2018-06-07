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



$objCon = new Connection();
$objCon->get_connected();

$objUse = new Users();
$pass = sha1 ($_POST["pass"]);
$id_usuario = $_POST['id_usuario'];
$objUse->modify_pass($id_usuario,$pass);

header('Location: log_out.php');

?>