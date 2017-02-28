<?php
//*****************
class uti_gr{

	public function liste(){
		echo'
<div class="panel panel-default">
  <div class="panel-heading c-list">
      <span class="title">Utilisateurs</span>
      <ul class="pull-right c-controls">
          <li><a href="chercheUti.php?id='.$_GET['id'].'" title="Ajouter Utilisateurs"><i class="glyphicon glyphicon-plus"></i></a></li>
      </ul>
  </div>

  <div class="row" style="display: none;">
      <div class="col-xs-12">
          <div class="input-group c-search">
              <input type="text" class="form-control" id="contact-list-search">
              <span class="input-group-btn">
                  <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search text-muted"></span></button>
              </span>
          </div>
      </div>
  </div>

  <ul class="list-group" id="contact-list">
';
$idGrp=$_GET['id'];
$idsess=$_SESSION['id'];
$req = mysql_query("SELECT pseudo, a.idUti idUti, avatar, adresse, telephone, email
          FROM utilisateur a, utilisateur_groupe b
          WHERE a.idUti=b.idUti AND idGrp=$idGrp
          Having idUti!=$idsess
          ORDER BY pseudo");
while($affich = mysql_fetch_array($req)){
    echo '
      <li class="list-group-item">
          <div class="col-xs-12 col-sm-4">
              <a href="../profile.php?idUti='.$affich['idUti'].'">
              <img src="http://localhost/plateforme/banque de donnees/utilisateur avatar/';
    							avatar($affich['avatar']);
                  echo '" class="img-responsive img-circle" />
              </a>
          </div>
          <div class="col-xs-12 col-sm-8">
              <span class="name">'.$affich['pseudo'].'</span><br/>
              <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="'.$affich['adresse'].'"></span>
              <span class="visible-xs"> <span class="text-muted">'.$affich['adresse'].'</span><br/></span>
              <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="'.$affich['telephone'].'"></span>
              <span class="visible-xs"> <span class="text-muted">'.$affich['telephone'].'</span><br/></span>
              <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="'.$affich['email'].'"></span>
              <span class="visible-xs"> <span class="text-muted">'.$affich['email'].'</span><br/></span>
          </div>
          <div class="clearfix"></div>
      </li>';
  }
    echo '
    </ul>
</div>
    ';
}

function ajoute(){
	if(isset($_POST['ajouter'])){
	$idGrp=$_GET['id'];
	$idUti=$_POST['user'];

	$sql = array();
	foreach( $idUti as $idUti ) {
    	$sql[] = '("'.mysql_real_escape_string($idGrp).'", '.$idUti.')';
	}
	$req = mysql_query('INSERT INTO utilisateur_groupe (idGrp,idUti) VALUES '.implode(',', $sql));

	if($req){

	echo "
       <script>
			Javascript:alert('Utilisateurs Ajoutés.');
			grpRedir(".$idGrp.");
       </script>
	";
	}
/*$checkBox = implode(',', $_POST['user']);

   	$query="INSERT INTO utilisateur_groupe (idGrp,idUti) VALUES ('$idGrp," . $checkBox . "')";

   	mysql_query($query) or die (mysql_error() );
*/
	}

}

}//fin classe


?>
