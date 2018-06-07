<?php

require'../users/class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	//header('Location: ../index.php?error=2');
}

?>
<?php

//Llamado de los archivos clase
require'../users/class/config.php';
require'../users/class/secciones.php';
require'../users/class/dbactions.php';
require'../users/class/profiles.php';


$objCon = new Connection();
$objCon->get_connected();

$objUse = new Seccion();
$objUse->delete_seccion();

header('Location: secciones_list.php');

?>