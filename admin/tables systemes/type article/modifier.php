<?php
include ("../../../config.php");
$titre="Modifier type article";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/typearticle.php');
$r=mysql_query('select * from type_article_sys where idTypArt='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification du type d'articles: <?php echo $affiche['libelleTypArt']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idTypArt']?>' type='text' name='idTypArt' /><br />
        <input value="<?php echo $affiche['idTypArt']?>" type="hidden" name="idTypArt" /> 
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleTypArt']?>" type="text" name="libelleTypArt" /><br />
		<label>Extension: </label><br /><input class="form-control" value="<?php echo $affiche['extensionTypArt']?>" type="text" name="extensionTypArt" /><br />

		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descTypArt"><?php echo $affiche['descTypArt']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new typeArticle();
$fil->modifier();

include("../../includes/fin.php");
?>
