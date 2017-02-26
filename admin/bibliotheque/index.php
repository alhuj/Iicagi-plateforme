<?php 
include('../../config.php');
$titre="Gestion Biliotheque";
include('../includes/debut.php');
include('../includes/menu.php');
include('../../crudl/article.php');
include('aside.php');
$art= new article();
$art->liste();
?>

<?php
include('../includes/fin.php');
?>