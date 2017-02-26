<?php
include ("../../../config.php");
$titre="Modifier type groupe";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/typegroupe.php');
$r=mysql_query('select * from type_groupe_sys where idTypGrp='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification du type de groupe: <?php echo $affiche['libelleTypGrp']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idTypGrp']?>' type='text' name='idTypGrp' /><br />
        <input value="<?php echo $affiche['idTypGrp']?>" type="hidden" name="idTypGrp" />      
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleTypGrp']?>" type="text" name="libelleTypGrp" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descTypGrp"><?php echo $affiche['descTypGrp']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new typeGrpion();
$fil->modifier();

include("../../includes/fin.php");
?>
