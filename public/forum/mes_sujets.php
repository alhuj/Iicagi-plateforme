<?php
include('../../config.php');
$titre="Forum - Mes Sujet";
include('../includes/debut.php');
include('../includes/menuForum.php');
include('../../crudl/question.php');

$resutat = mysql_query("SELECT * FROM question WHERE idUti=$id1") or die(mysql_error());
$nbrQu = mysql_num_rows($resutat);
if ($nbrQu==0) {
  echo "<div class='alert alert-danger text-center' role='alert'>Vous n\'avez pas encore pose(e) de questions. Veuillez cliquer sur Poser Question... Merci</div>";
}
else {

  echo "<div class='alert alert-info text-center' role='alert'>Vous avez pose(e) <strong>".$nbrQu."</strong> questions</div>";

  $qes = new question();
  $qes->mes_sujets();
}


include('../includes/fin.php');
?>
