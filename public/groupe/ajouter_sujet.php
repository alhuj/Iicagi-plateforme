<?php
include('../../config.php');
$titre="Ajout Sujet";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/question.php');

echo "
<form role='form1' name='form1' action='ajouter_sujet.php?id=".$_GET['id']."' method='post'>
	<input type='hidden' name='idUti' value='".$id1."'/>
	<div class='row'>
   	<div class='col-md-8'>
    	<div class='form-group'>
        	<label for='sujet'>Sujet</label>
       		<input type='text' name='sujet' class='form-control' placeholder='Sujet ou Titre'>
    	</div>
	</div>
	</div>
    <div class='row'>	
		<div class='col-md-8'>
        	<div class='form-group'>
				<label for='detail'>Details</label>
				<textarea name='detail' class='form-control' placeholder='Details' rows='4'></textarea>
			</div>
        </div>
	</div>
	<input class='btn btn-lg btn-primary' type='submit' name='Submit' value='Poster' /> <input class='btn btn-lg btn-default' type='reset' name='Submit2' value='Reinitialiser' />
</form>
";

$qes = new question();
$qes->ajouter();

//header("refresh:1;url=main_forum.php?");


include("../includes/fin.php");

?>