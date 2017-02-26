<?php
include ("../../../config.php");
$titre="Modifier utilisateur";
include("../../includes/debut.php");
include("../../includes/menu.php");
include('../aside.php');
include('../../../crudl/utilisateur.php');
$r=mysql_query('select * from utilisateur where idUti='.$_GET['id']) or die(mysql_error());
if($affiche=mysql_fetch_array($r)){
?>
<div align="center" class="form-group block1" >
<h3>Modification de l'utilisateur: <?php echo $affiche['nom'].' '.$affiche['prenom']?></h3>
		<form class="form-inline" action='modifier.php?id=<?php echo $_GET['id']?>' method='POST'>  
        <label>Id: </label><br /><input disabled class='form-control' value='<?php echo $affiche['idUti']?>' type='text' name='idUti' /><br />
        <input value="<?php echo $affiche['idUti']?>" type="hidden" name="idUti" />  
		<label>Nom: </label><br /><input class="form-control" value="<?php echo $affiche['nom']?>" type="text" name="nom" /><br />
		<label>Prénom: </label><br /><input class="form-control" value="<?php echo $affiche['prenom']?>" type="text" name="prenom" /><br />
		<label>Date de naissance: </label><br /><input class="form-control" value="<?php echo $affiche['dateNaiss']?>" type="text" name="dateNaiss" /><br />
		<label>Lieu de naissance: </label><br /><input class="form-control" value="<?php echo $affiche['lieuNaiss']?>" type="text" name="lieuNaiss" /><br />
		<label>Adresse: </label><br /><input class="form-control" value="<?php echo $affiche['adresse']?>" type="text" name="adresse" /><br />
		<label>Téléphone: </label><br /><input class="form-control" value="<?php echo $affiche['telephone']?>" type="number" name="telephone" /><br />
		<label>Email: </label><br /><input class="form-control" value="<?php echo $affiche['telephone']?>" type="text" name="email" /><br />
		<label>Type Utilisateur: </label><br />
        <?php
		$r1=mysql_query('select * from type_utilisateur_sys');
		while($aff1=mysql_fetch_array($r1)){
		?>
        <input  <?php if($aff1['idType']==$affiche['idType']) echo 'checked="checked"'?> type="radio" name="idType" value="<?php echo $aff1['idType']?>"/> <?php echo $aff1['libelleType']?>
        <?php
		}
		?>
        <br />
		<label>Privilège: </label><br />
        <?php
		$r1=mysql_query('select * from privilege_sys');
		while($aff1=mysql_fetch_array($r1)){
		?>
        <input  <?php if($aff1['idPrivi']==$affiche['idPrivi']) echo 'checked="checked"'?> type="radio" name="idPrivi" value="<?php echo $aff1['idPrivi']?>"/> <?php echo $aff1['libellePrivi']?>
        <?php
		}
		?>
        <br />
		<label>Filière: </label><br />
        <?php
		$r1=mysql_query('select * from filiere_sys');
		while($aff1=mysql_fetch_array($r1)){
		?>
        <input  <?php if($aff1['idFil']==$affiche['idFil']) echo 'checked="checked"'?> type="radio" name="idFil" value="<?php echo $aff1['idFil']?>"/> <?php echo $aff1['libelleFil']?>
        <?php
		}
		?>
        <br />
		<label>Niveau: </label><br />
        <?php
		$r1=mysql_query('select * from niveau_sys');
		while($aff1=mysql_fetch_array($r1)){
		?>
        <input  <?php if($aff1['idNiv']==$affiche['idNiv']) echo 'checked="checked"'?> type="radio" name="idNiv" value="<?php echo $aff1['idNiv']?>"/> <?php echo $aff1['libelleNiv']?>
        <?php
		}
		?>
        <br />
		<input class="btn btn-default" type="submit" name="enregistrer" value="Enregistrer"/>
		</form>
</div>

<?php
}
$fil= new utilisateur();
$fil->modifier();

include("../../includes/fin.php");
?>
