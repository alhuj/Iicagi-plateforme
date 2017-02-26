<?php 
include('../../../config.php');
$titre='Liste des utilisateurs bloqués';
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/utilisateur.php');
$uti=new utilisateur(); 
$uti->utiBloq();
include('../../includes/fin.php');
?>