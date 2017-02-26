<?php 
include('../../config.php');
$titre="Groupe Poste";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/question.php');
include('../../crudl/poste.php');

$idQu=$_GET['idQu'];

echo"	<div class='row'>
		<div class='col-md-10 col-md-offset-1'>
		<div style='background-color:LightGray'>";

$qest = new question();
$qest->affiche();


$pos = new poste();
$pos->affiche();

$sql3="INSERT INTO vu_question(idUti, idQu) VALUES('$id1','$idQu')";
$result3=mysql_query($sql3);

$sql4="SELECT Resolu FROM question WHERE idQu='$idQu'";
$result4=mysql_query($sql4) or die(mysql_error());
$rows=mysql_fetch_assoc($result4);

if($rows['Resolu']==0){

$pos->ajoute();
}

echo"</div>
	 </div>
	 </div>";

include('../includes/fin.php');
?>