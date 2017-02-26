<?php 
include('../../../config.php');
$titre="Liste des filières";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/typearticle.php');
$fil = new typeArticle();
$fil->affiche();
include('../../includes/fin.php');
?>