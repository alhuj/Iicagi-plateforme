<?php 
include('../../../config.php');
$titre="Liste des niveaux";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/niveau.php');
$fil = new niveau();
$fil->affiche();
include('../../includes/fin.php');
?>