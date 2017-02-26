<?php
include ("../../../config.php");
$titre="Ajouter niveau";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/niveau.php');
?>
<div align="center" class="form-group block1" >
<h3>Ajout d'un niveau supplèmentaire</h3>
		<form class="form-inline" action="ajouter.php" method="POST">        
		<label>Libelle: </label><br /><input class="form-control" placeholder="Libelle" type="text" name="libelleNiv" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix" placeholder="Description" type="text" name="descNiv"></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="ajouter" value="Ajouter"/>
		</form>
</div>

<?php
$fil= new niveau();
$fil->ajouter();

include("../../includes/fin.php");
?>
