<?php
include ("../../config.php");
$titre="Ajouter d'un article";
include("../includes/debut.php");
include("../includes/menu.php");
include('aside.php');
include('../../crudl/article.php');
?>
<div align="center" class="form-group block1" >
<h3>Ajout d'un nouveau article à la bibliothèque</h3>
		<form class="form-inline" action="ajouterYoutube.php" method="POST" enctype="multipart/form-data">        
		<label>Titre: </label><br /><input class="form-control" placeholder="Titre" type="text" name="libelleArt" /><br />
		<label>URL Youtube </label><br /><input class="form-control" placeholder="http://www.youtube.com/xxxxxxxx" type="text" name="lienArt" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix" placeholder="Description" type="text" name="descArt"></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="ajouter" value="Ajouter"/>
		</form>
</div>

<?php
$art= new article();
$art->ajouterYoutube();

include("../includes/fin.php");
?>
