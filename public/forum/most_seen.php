<?php
include('../../config.php');
$titre="Forum - Sujets Populairs";
include('../includes/debut.php');
include('../includes/menuForum.php');
include('../../crudl/question.php');


echo "<div class='alert alert-info text-center' role='alert'>Les sujets les plus populairs</div>";

  $qes = new question();
  $qes->sujet_pop();


include('../includes/fin.php');
?>
