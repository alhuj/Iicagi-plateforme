<?php 
include('../../../config.php');
$titre="Liste des filières";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/typeutilisateur.php');
$fil = new typeUtilisateur();
$fil->affiche();
include('../../includes/fin.php');
?>