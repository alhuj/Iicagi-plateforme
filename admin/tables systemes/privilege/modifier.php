<?php
include ("../../../config.php");
$titre="Modifier privilège";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/privilege.php');
$r=mysql_query('select * from privilege_sys where idPrivi='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification de la privilège: <?php echo $affiche['libellePrivi']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idPrivi']?>' type='text' name='idPrivi' /><br />
        <input value="<?php echo $affiche['idPrivi']?>" type="hidden" name="idPrivi" />      
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libellePrivi']?>" type="text" name="libellePrivi" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descPrivi"><?php echo $affiche['descPrivi']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new privilege();
$fil->modifier();

include("../../includes/fin.php");
?>
