<?php
include('../../config.php');
$titre="Recherche Utilisateurs";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/utilisateur_groupe.php');

echo"
<h3>Rechercher des utilisateurs</h3>
<p>Entrez le pseudo, le nom ou le prenom des utilisateurs à rechercher:</p>
<div class='row'>
<div class='col-md-6'>
<form  method='post' action='chercheUti.php?id=".$_GET['id']."'' id='searchform'>
<div class='input-group c-search'>
		<input type='text' class='form-control' name='motcle' id='contact-list-search'>
		<span class='input-group-btn'>
				<button class='btn btn-default' name='submit' type='submit'><span class='glyphicon glyphicon-search text-muted'></span></button>
		</span>
</div>
</form>
</div>
</div>
";

if(isset($_POST['submit'])){

	  if(preg_match("/^[  a-zA-Z]+/", $_POST['motcle'])){
	  $motcle=$_POST['motcle'];
		$idGrp=$_GET['id'];

	  //-query  the database table
	  $sql="SELECT * FROM utilisateur WHERE pseudo LIKE '%".$motcle."%' || nom LIKE '%".$motcle."%' || prenom LIKE '%".$motcle."%'
					&& idUti NOT IN (SELECT idUti FROM utilisateur_groupe WHERE idGrp='$idGrp')";
	  //-run  the query against the mysql query function
	  $result=mysql_query($sql) or die(mysql_error());
	  //-create  while loop and loop through result set

	  echo"
	  <form method='POST' action='ajouterUti.php?id=".$_GET['id']."'>
	  ";

	  while($row=mysql_fetch_array($result)){
	          $idUti=$row['idUti'];
	          $pseudo=$row['pseudo'];
	          $nomUti=$row['nom'];
	          $prenomUti=$row['prenom'];
	  //-display the result of the array

	  echo
	  	"<input type='checkbox' name='user[]' id='user' value='".$idUti."'>" . $pseudo . " " . $nomUti . " " . $prenomUti . "<br>";

	  }
	  echo"
	  <input type='submit' class='' name='ajouter' value='Ajouter'>
	  </form>
	  ";
	  }
	  else{
	  		echo("<script>alert('Veuillez Saisir un mot clé s'il vous plait.');</script>") ;

	  }
	  }

/*if(isset($_POST['ajouter'])){
$uti = new utilisateur_groupe();
$uti->ajoute();
}
*/

include('../includes/fin.php');
?>
