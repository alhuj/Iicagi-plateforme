<?php
include ("../../../config.php");
include('../../../crudl/utilisateur.php');
$fil= new utilisateur();
$fil->indPseudo();
echo'<script>indexRedir();</script>';
?>
