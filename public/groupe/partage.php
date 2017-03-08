<?php 
include('../../config.php');
$titre="Partage de document";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/groupe.php');



if(isset($_GET['id'])){
$idGrp=$_GET['id'];

echo "
<form role='form1' name='form1' action='modifierGr.php' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='idGrp' value='".$idGrp."'/>
	<div class='row'>
   	<div class='col-md-8'>
    	<div class='form-group'>
        	<label for='libelleGrp'>Nom du document</label>
       		<input type='text' name='libelleArt' class='form-control' placeholder='Titre du document'>
    	</div>
	</div>
	</div>
    <div class='row'>	
		<div class='col-md-8'>
        	<div class='form-group'>
				<label for='avatar'>Document</label>
       			<input type='file' name='article'>
			</div>
        </div>
	</div>
    <div class='row'>	
		<div class='col-md-8'>
        	<div class='form-group'>
				<label for='descGrp'>Description</label>
				<textarea name='descGrp' class='form-control' placeholder='Description du document' rows='4'></textarea>
			</div>
        </div>
	</div>
	<input class='btn btn-lg btn-primary' type='submit' name='submit' value='Partager' />
</form>
";
}

$grp = new groupe();
$grp->partager();
include('../includes/fin.php');
?>