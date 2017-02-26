<?php
include ("../../../config.php");
$titre="Ajouter type reaction";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/typereaction.php');
?>
<div align="center" class="form-group block1" >
<h3>Ajout d'un nouveau type de réaction</h3>
		<form class="form-inline" action="ajouter.php" method="POST">        
		<label>Libelle: </label><br /><input class="form-control" placeholder="Libelle" type="text" name="libelleTypReact" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix" placeholder="Description" type="text" name="descTypReact"></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="ajouter" value="Ajouter"/>
		</form>
</div>

<?php
$fil= new typeReaction();
$fil->ajouter();

include("../../includes/fin.php");
?>
