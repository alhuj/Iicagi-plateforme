<?php
include('../../config.php');
$titre="Forum - Top 10";
include('../includes/debut.php');
include('../includes/menuForum.php');
include('../../crudl/question.php');


echo "<div class='alert alert-info text-center' role='alert'>Top 10 des questions</div>";

  $qes = new question();
  $qes->top10();


include('../includes/fin.php');
?>
