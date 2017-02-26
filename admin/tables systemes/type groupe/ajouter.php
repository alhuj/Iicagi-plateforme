<?php
include ("../../../config.php");
$titre="Ajouter type groupe";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/typegroupe.php');
?>
<div align="center" class="form-group block1" >
<h3>Ajout d'un nouveau type de groupe</h3>
		<form class="form-inline" action="ajouter.php" method="POST">        
		<label>Libelle: </label><br /><input class="form-control" placeholder="Libelle" type="text" name="libelleTypGrp" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix" placeholder="Description" type="text" name="descTypGrp"></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="ajouter" value="Ajouter"/>
		</form>
</div>

<?php
$fil= new typeGroupe();
$fil->ajouter();

include("../../includes/fin.php");
?>
