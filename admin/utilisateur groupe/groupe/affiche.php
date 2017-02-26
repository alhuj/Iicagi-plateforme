<?php 
include('../../../config.php');
$titre="Liste des groupes";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/groupeAdmin.php');
$fil = new groupe();
$fil->affiche();
include('../../includes/fin.php');
?>