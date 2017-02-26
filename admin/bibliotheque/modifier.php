<?php
include ("../../config.php");
$titre="Modifier article";
include("../includes/debut.php");
include("../includes/menu.php");
include('aside.php');
include('../../crudl/article.php');
$r=mysql_query('select * from article where idArt='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
	if($affiche['idTypArt']!=6){

?>
<div align="center" class="form-group block1" >
<h3>Modification de l'article: <?php echo $affiche['libelleArt']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST' enctype="multipart/form-data">  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idArt']?>' type='text' name='idArt' /><br />
        <input value="<?php echo $affiche['idArt']?>" type="hidden" name="idArt" />      
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleArt']?>" type="text" name="libelleArt" /><br />
        <input value="<?php echo $affiche['idTypArt']?>" type="hidden" name="idTypArt" />
        <input value="<?php echo $affiche['lienArt']?>" type="hidden" name="lienArt" />
        <label>Importer l'article: </label><br /><input type="file" name="article"/>  <br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descArt"><?php echo $affiche['descArt']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
$fil= new article();
$fil->modifierUpl();
}else{
?>
<div align="center" class="form-group block1" >
<h3>Modification de l'article: <?php echo $affiche['libelleArt']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST' enctype="multipart/form-data">  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idArt']?>' type='text' name='idArt' /><br />
        <input value="<?php echo $affiche['idArt']?>" type="hidden" name="idArt" />  
        <input value="<?php echo $affiche['idTypArt']?>" type="hidden" name="idTypArt" />    
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleArt']?>" type="text" name="libelleArt" /><br />
		<label>URL Youtube </label><br /><input class="form-control" value="<?php echo $affiche['lienArt']?>" type="text" name="lienArt" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descArt"><?php echo $affiche['descArt']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
$fil= new article();
$fil->modifierYoutube();

}
}

include("../includes/fin.php");
?>
