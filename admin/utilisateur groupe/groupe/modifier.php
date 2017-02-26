<?php
include ("../../../config.php");
$titre="Modifier groupe";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/groupe.php');
$r=mysql_query('select * from groupe where idGrp='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification de la groupe: <?php echo $affiche['libelleGrp']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idGrp']?>' type='text' name='idGrp' /><br />
        <input value="<?php echo $affiche['idGrp']?>" type="hidden" name="idGrp" />      
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleGrp']?>" type="text" name="libelleGrp" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descGrp"><?php echo $affiche['descGrp']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new groupe();
$fil->modifier();

include("../../includes/fin.php");
?>
