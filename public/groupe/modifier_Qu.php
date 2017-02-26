<?php 
include('../../config.php');
$titre="Modifier Sujet";
include('../includes/debut.php');
include('../../crudl/question.php');
include('../includes/menuGroupe.php');
if(isset($_GET['idQu'])){
$idQu=$_GET['idQu'];
$req="SELECT * FROM question WHERE idQu=$idQu";
$result=mysql_query($req) or die(mysql_error());
$rows=mysql_fetch_array($result);

echo "
<form role='form1' name='form1' action='modifier_Qu.php' method='post'>
	<input type='hidden' name='idQu' value='".$idQu."'/>
	<div class='row'>
   	<div class='col-md-5'>
    	<div class='form-group'>
        	<label for='sujet'>Sujet</label>
       		<input type='text' name='sujet' class='form-control' value='".$rows['sujet']."'>
    	</div>
	</div>
	</div>
    <div class='row'>	
		<div class='col-md-5'>
        	<div class='form-group'>
				<label for='detail'>Details</label>
				<textarea name='detail' class='form-control' rows='4'>".$rows['detailQu']."</textarea>
			</div>
        </div>
	</div>
	<input class='btn' type='submit' name='enreg' value='ENREGISTRER' />
</form>
";
}

$qes = new question();
$qes->modifier();

include('../includes/fin.php');
?>