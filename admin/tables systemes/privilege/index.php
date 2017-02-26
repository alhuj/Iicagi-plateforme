<?php 
include('../../../config.php');
$titre="Liste des privilèges";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/privilege.php');
$fil = new privilege();
$fil->liste();
include('../../includes/fin.php');
?>