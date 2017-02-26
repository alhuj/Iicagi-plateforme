<?php 
include('../../config.php');
$titre="Modifier Poste";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/poste.php');

if(isset($_GET['idPo'])){
$idQu=$_GET['idQu'];
$idPo=$_GET['idPo'];
$req="SELECT idPo, contenuPo FROM poste WHERE idPo=$idPo";
$result=mysql_query($req) or die(mysql_error());
$rows=mysql_fetch_array($result);

echo "
<form role='form1' name='form1' action='modifier_Po.php' method='post'>
	<input type='hidden' name='idQu' value='".$idQu."'/>
	<input type='hidden' name='idPo' value='".$idPo."'/>
	<div class='row'>	
		<div class='col-md-5'>
        	<div class='form-group'>
				<label for='detail'Modifier votre Reponse</label>
				<textarea name='reponse' class='form-control' rows='10' cols='40'>".$rows['contenuPo']."</textarea>
			</div>
        </div>
	</div>
	<input class='btn' type='submit' name='enreg' value='ENREGISTRER' />
</form>
";
}

$pos = new poste();
$pos->modifier();
include('../includes/fin.php');
?>