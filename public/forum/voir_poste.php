<?php 
include('../../config.php');
$titre="Forum Poste";
include('../includes/debut.php');
include('../includes/menuForum.php');
include('../../crudl/question.php');
include('../../crudl/poste.php');

$idQu=$_GET['idQu'];
echo"	<div class='row'>
		<div class='col-md-10 col-md-offset-1'>
		<div style='background-color:LightGray'>";

$qest = new question();
$qest->affiche();


/*
$req="SELECT * FROM question WHERE idQu=$idQu";
$result=mysql_query($req) or die(mysql_error());
$rows=mysql_fetch_array($result);

echo "
<section style='display:none'>
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
	<input class='btn btn-success' type='submit' name='enreg' value='ENREGISTRER' />
</form>
</section>
";
*/

$pos = new poste();
$pos->affiche();

$sql3="INSERT INTO vu_question(idUti, idQu) VALUES('$id1','$idQu')";
$result3=mysql_query($sql3);

$sql4="SELECT Resolu FROM question WHERE idQu='$idQu'";
$result4=mysql_query($sql4) or die(mysql_error());
$rows=mysql_fetch_assoc($result4);

if($rows['Resolu']==0){

$pos->ajoute();
}

echo"</div>
	 </div>
	 </div>";

include('../includes/fin.php');
?>