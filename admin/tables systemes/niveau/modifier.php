<?php
include ("../../../config.php");
$titre="Modifier niveau";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/niveau.php');
$r=mysql_query('select * from niveau_sys where idNiv='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification du niveau: <?php echo $affiche['libelleNiv']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idNiv']?>' type='text' name='idNiv' /><br />
        <input value="<?php echo $affiche['idNiv']?>" type="hidden" name="idNiv" />      
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleNiv']?>" type="text" name="libelleNiv" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descNiv"><?php echo $affiche['descNiv']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new niveau();
$fil->modifier();

include("../../includes/fin.php");
?>
