<?php
include ("../../../config.php");
$titre="Modifier type réaction";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/typereaction.php');
$r=mysql_query('select * from type_reaction_sys where idTypReact='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification de la filière: <?php echo $affiche['libelleTypReact']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idTypReact']?>' type='text' name='idTypReact' /><br />
        <input value="<?php echo $affiche['idTypReact']?>" type="hidden" name="idTypReact" />      
		<label>Libelle: </label><br /><input class="form-control" value="<?php echo $affiche['libelleTypReact']?>" type="text" name="libelleTypReact" /><br />
		<label>Description: </label><br /><textarea class="form-control textareaFix"  name="descTypReact"><?php echo $affiche['descTypReact']?></textarea><br /><br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new typeReaction();
$fil->modifier();

include("../../includes/fin.php");
?>
