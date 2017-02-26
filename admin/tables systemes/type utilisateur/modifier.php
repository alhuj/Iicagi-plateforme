<?php
include ("../../../config.php");
$titre="Modifier type utilisateur";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/typeutilisateur.php');
$r=mysql_query('select * from type_utilisateur_sys where idType='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification du type d'utilisateurs: <?php echo $affiche['libelleType']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idType']?>' type='text' name='idType' /><br />
        <input value="<?php echo $affiche['idType']?>" type="hidden" name="idType" />      
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleType']?>" type="text" name="libelleType" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descType"><?php echo $affiche['descType']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new typeUtilisateur();
$fil->modifier();

include("../../includes/fin.php");
?>
