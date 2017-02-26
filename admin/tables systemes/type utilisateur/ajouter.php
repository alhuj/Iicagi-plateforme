<?php
include ("../../../config.php");
$titre="Ajouter un type d'utilisateur";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/typeutilisateur.php');
?>
<div align="center" class="form-group block1" >
<h3>Ajout d'un nouveau type d'utilisateur à la plateforme</h3>
		<form class="form-inline" action="ajouter.php" method="POST">        
		<label>Libelle: </label><br /><input class="form-control" placeholder="Libelle" type="text" name="libelleType" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix" placeholder="Description" type="text" name="descType"></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="ajouter" value="Ajouter"/>
		</form>
</div>

<?php
$Type= new typeUtilisateur();
$Type->ajouter();

include("../../includes/fin.php");
?>
