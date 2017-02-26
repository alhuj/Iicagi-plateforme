<?php 
include('../../../config.php');
$titre="Liste des types d'utilisateurs";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/typeutilisateur.php');
$fil = new typeUtilisateur();
$fil->liste();
include('../../includes/fin.php');
?>