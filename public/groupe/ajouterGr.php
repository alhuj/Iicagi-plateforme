<?php
include('../../config.php');
$titre="Ajout Groupe";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/groupe.php');

echo "
<form role='form1' name='form1' action='ajouterGr.php'  enctype='multipart/form-data' method='post'>
	<div class='row'>
   	<div class='col-md-8'>
    	<div class='form-group'>
        	<label for='libelleGrp'>Nom du groupe</label>
       		<input type='text' name='libelleGrp' class='form-control' placeholder='Nom groupe'>
    	</div>
			</div>
			</div>
	<div class='row'>
		<div class='col-md-8'>
			<div class='form-group'>
					<label for='libelleGrp'>Ajouter un avatar</label>
					<input  type='file' name='avatar'/>
			</div>
	</div>
	</div>
    <div class='row'>
		<div class='col-md-8'>
        	<div class='form-group'>
				<label for='descGrp'>Description</label>
				<textarea name='descGrp' class='form-control' placeholder='Description' rows='4'></textarea>
			</div>
        </div>
	</div>
	<input class='btn btn-lg btn-primary' type='submit' name='Submit' value='Ajouter' />
</form>
";

$grp = new groupe();
$grp->ajouter();

include('../includes/fin.php');
?>
