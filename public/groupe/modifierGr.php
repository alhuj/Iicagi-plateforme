<?php 
include('../../config.php');
$titre="Amélioration Groupe";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/groupe.php');



if(isset($_GET['id'])){
$idGrp=$_GET['id'];
$req="SELECT idGrp, libelleGrp, descGrp FROM groupe WHERE idGrp=$idGrp";
$result=mysql_query($req) or die(mysql_error());
$rows=mysql_fetch_array($result);

echo "
<form role='form1' name='form1' action='modifierGr.php' method='post'>
	<input type='hidden' name='idGrp' value='".$idGrp."'/>
	<div class='row'>
   	<div class='col-md-8'>
    	<div class='form-group'>
        	<label for='libelleGrp'>Nom du grupe</label>
       		<input type='text' name='libelleGrp' class='form-control' value='".$rows['libelleGrp']."'>
    	</div>
	</div>
	</div>
    <div class='row'>	
		<div class='col-md-8'>
        	<div class='form-group'>
				<label for='descGrp'>Description</label>
				<textarea name='descGrp' class='form-control' rows='4'>".$rows['descGrp']."</textarea>
			</div>
        </div>
	</div>
	<input class='btn btn-lg btn-primary' type='submit' name='submit' value='Ajouter' />
</form>
";
}

$grp = new groupe();
$grp->modifier();

include('../includes/fin.php');
?>