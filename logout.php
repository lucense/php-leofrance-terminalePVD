<?php

include './common.php';
$_SESSION['utente']="";
$_SESSION['pwd']="";
session_destroy();
header("location: index.php");
?>