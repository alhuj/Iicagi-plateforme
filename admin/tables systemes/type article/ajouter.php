<?php
include ("../../../config.php");
$titre="Ajouter un type d'article";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/typearticle.php');
?>
<div align="center" class="form-group block1" >
<h3>Ajout d'un nouveau type d'article à la bibliothèque</h3>
		<form class="form-inline" action="ajouter.php" method="POST">        
		<label>Libelle: </label><br /><input class="form-control" placeholder="Libelle" type="text" name="libelleTypArt" /><br />
		<label>Extension: </label><br /><input class="form-control" placeholder="Extension" type="text" name="extensionTypArt" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix" placeholder="Description" type="text" name="descTypArt"></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="ajouter" value="Ajouter"/>
		</form>
</div>

<?php
$TypArt= new typeArticle();
$TypArt->ajouter();

include("../../includes/fin.php");
?>
