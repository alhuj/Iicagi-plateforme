<?php 
include('../../../config.php');
$titre='Utilisateur '.$_GET['id'];
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/utilisateur.php');
$user = new utilisateur();
$user->afficher();
include('../../includes/fin.php');
?>