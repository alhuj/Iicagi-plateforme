<?php
//*****************
class poste{

	public function affiche(){
		$idQu=$_GET['idQu'];
		$sql2="SELECT pseudo, avatar, idPo, contenuPo, DATE_FORMAT(heurePo,'Le ' '%d/%m/%Y à %Hh:%i') heurePo, q.idUti idAuteur, p.idUti posteur, resolu, q.idQu
		FROM utilisateur AS u, poste AS p, question q
		WHERE u.idUti=p.idUti && q.idQu=p.idQu && p.idQu=$idQu
		ORDER BY heurePo";
$result2=mysql_query($sql2) or die(mysql_error());
while($rows=mysql_fetch_array($result2)){
	$posteur=$rows['posteur'];
	//$req=mysql_query("SELECT avatar FROM utilisateur WHERE idUti=$posteur");
	//$result=mysql_fetch_row($req);
	$avatar=$rows['avatar'];

echo "
<div class='row'>
<div class='col-md-8 col-md-offset-2'>
";

if($_SESSION['id']==$rows['posteur'] && $rows['resolu']==0){
  echo"
  	<div class='dropdown' style='float:right'>
  		<button class='btn btn-success dropdown-toggle' type='button' data-toggle='dropdown'>
  			<span class='caret'></span>
		</button>
  		<ul class='dropdown-menu'>
    		<li><a href='modifier_Po.php?idQu=".$idQu."&idPo=".$rows['idPo']."'>Modifier</a></li>
			 <li class='divider'></li>
    		<li><a href='supprimerPo.php?idQu=".$idQu."&idPo=".$rows['idPo']."'>Supprimer</a></li>
  		</ul>
	</div>";
  }
  echo'


	<div id="tb-testimonial" class="testimonial testimonial-primary-filled">
		<div class="testimonial-section">
	  	'.nl2br($rows['contenuPo']).'
	  </div>
	  <div class="testimonial-desc">
			<a href="../profile.php?idUti='.$rows['posteur'].'">
			<img src="http://localhost/plateforme/banque de donnees/utilisateur avatar/';
			avatar($avatar);
	echo'" /></a>
	  	<div class="testimonial-writer">
				<a href="../profile.php?idUti='.$rows['posteur'].'">
				<div class="testimonial-writer-name">'.$rows['pseudo'].'</div></a>
	  		<div class="testimonial-writer-designation">'.$rows['heurePo'].'</div>
	    </div>
	   </div>
	</div>

';
echo"
</div>
</div>
<BR>
<BR>
";
}


	}

public function ajoute(){
	$idQu=$_GET['idQu'];
	echo "
<div class='row'>
<div class='col-md-8 col-md-offset-2'>
<section>
<form role='form1' name='form1' action='' method='post'>
	<input type='hidden' name='idQu' value='".$idQu."'/>
    <input type='hidden' name='idUti' value='".$_SESSION['id']."'/>
    <div class='row'>
		<div class='col-md-12'>
        	<div class='form-group text-center'>
				<label for='reponse'><h3>Répondre à la Question</h3></label>
				<textarea style='resize:none' name='reponse' class='form-control' placeholder='Réponse' rows='10'></textarea>
			</div>
        </div>
	</div>
	<input class='btn btn-primary' type='submit' name='Submit' value='Repondre' />
</form><br>
</section>
</div>
</div>
	";

	if(isset($_POST['Submit'])){


if (empty($_POST['reponse']))
    {
    ?>
        <script>
            Javascript:alert('Ooouuuuppssss! Vous n avez rien dit !')
        </script>
    <?php
    }

	else{

		$rep = mysql_real_escape_string(htmlspecialchars($_POST['reponse']));
		$contenuPo = nl2br($rep);
		$idUti=$_POST['idUti'];
		$idQu=$_POST['idQu'];
		$sql2="INSERT INTO poste (contenuPo, idUti, idQu) VALUES('$contenuPo','$idUti','$idQu')";
		$result2=mysql_query($sql2) or die(mysql_error());
			if($result2){
				echo "<script>alert('Merci pour votre reponse!'); voirPoste(".$idQu.")</script>";
			}
		}


	}


}


public function modifier(){

	if(isset($_POST['enreg'])){
		$idQu = $_POST['idQu'];
		$idPo = $_POST['idPo'];
		$rep = mysql_real_escape_string(htmlspecialchars($_POST['reponse']));
		$reponse = nl2br($rep);
		$resultat = mysql_query("UPDATE poste SET contenuPo = '$reponse' WHERE idPo = ".$idPo) or die( mysql_error());
		if($resultat)
			{
				echo("<script>alert('La modification à été effectuée avec succes.');
				voirPoste(".$idQu.");</script>");
			}
			else
			{
				echo("<script>alert('La modification à échouée.')</script>") ;

			}


	}


	}


public function supprimer(){

	if(isset($_GET['idQu']) && isset($_GET['idPo'])){
		$idQu=$_GET['idQu'];
					$req = mysql_query("DELETE FROM `poste` WHERE `idPo` = ".$_GET['idPo']) or die(mysql_error());

					if($req){
						echo("<script>alert('La suppression à été effectuée avec succes.'); voirPoste(".$idQu.");</script>") ;

							}else	echo("<script>alert('La Suppression a échouee.');</script>") ;

							}


	}






}
?>
