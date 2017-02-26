<?php 
include'../../../config.php';
include'../../../crudl/utilisateur.php';
$uti=new utilisateur(); 
$uti->bloquer();
?>