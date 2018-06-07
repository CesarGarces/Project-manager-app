<?php

require'../users/class/sessions.php';
$objses = new Sessions();
$objses->init();

$objses->destroy();

header('Location: ../index.php');

?>