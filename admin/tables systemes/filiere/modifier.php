<?php
include ("../../../config.php");
$titre="Modifier filiere";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/filiere.php');
$r=mysql_query('select * from filiere_sys where idFil='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification de la filière: <?php echo $affiche['libelleFil']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idFil']?>' type='text' name='idFil' /><br />
        <input value="<?php echo $affiche['idFil']?>" type="hidden" name="idFil" />      
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleFil']?>" type="text" name="libelleFil" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descFil"><?php echo $affiche['descFil']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new filiere();
$fil->modifier();

include("../../includes/fin.php");
?>
