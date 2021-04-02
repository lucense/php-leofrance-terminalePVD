<?php

include './common.php';

$_SESSION['utente']=$_POST['utente'];
$_SESSION['pwd']=$_POST['pwd'];
header("location: index.php");
?>