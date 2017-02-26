<?php 
$titre='Article '.$_GET['id'];
include ("../../config.php");
include("../includes/debut.php");
include("../includes/menu.php");
include('aside.php');
include('../../crudl/article.php');
$art= new article();
$art->affiche();

include("../includes/fin.php");
?>