<?php
include'../config.php';
$titre='Mon compte';
include'includes/debut.php';
include'includes/menuCompte.php';
$req=mysql_query('select * from utilisateur where idUti='.$id1);
$aff=mysql_fetch_array($req);
$req1=mysql_query('select * from filiere_sys where idFil='.$aff['idFil']);
$aff1=mysql_fetch_array($req1);
$req2=mysql_query('select * from niveau_sys where idNiv='.$aff['idNiv']);
$aff2=mysql_fetch_array($req2);
$req3=mysql_query('select * from privilege_sys where idPrivi='.$aff['idPrivi']) or die(mysql_error());
$aff3=mysql_fetch_array($req3);
$req4=mysql_query('select * from type_utilisateur_sys where idType='.$aff['idType']) or die(mysql_error());
$aff4=mysql_fetch_array($req4);
?>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#profile">Mes informations</a></li>
  <li><a data-toggle="tab" href="#avatar">Changer d'avatar</a></li>
  <li><a data-toggle="tab" href="#pseudo">Changer de pseudo</a></li>
  <li><a data-toggle="tab" href="#password">Sécurité</a></li>
  <li><a data-toggle="tab" href="#groupes">Mes groupes</a></li>
  <li><a data-toggle="tab" href="#forum">Mes discussions</a></li>
  <li><a data-toggle="tab" href="#article">Mes articles</a></li>
</ul>

<div class="tab-content">
  <div id="profile" class="tab-pane fade in active row">
    <h3>Mon profile</h3>
    <DIV class="col-md-6">
        <table class="table">
      <tr>
        <td>
          Pseudo
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff['pseudo'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Prénom et Nom
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff['prenom'].' '.$aff['nom'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Date de naissance
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff['dateNaiss'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Lieu de naissance
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff['lieuNaiss'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Adresse
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff['adresse'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Telephone
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>00221 '.$aff['telephone'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Email
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff['email'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Lieu de naissance
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff['lieuNaiss'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Niveau
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff2['libelleNiv'].'</b>'; ?>
        </td>
      </tr>
      <tr>
        <td>
          Filiere
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff1['libelleFil'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Privilège
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff3['libellePrivi'].'</b>';?>
        </td>
      </tr>
      <tr>
        <td>
          Type d'utilisateur
        </td>
        <td>
          :
        </td>
        <td>
          <?php echo '<b>'.$aff4['libelleType'].'</b>'; ?>
        </td>
      </tr>
    </table>
  </DIV>
    <DIV class="col-md-6">
      <h5>Dernier connection le <?php echo $aff['dateDerConn'] ?></h5>
            <div>
                <div >

                </div>
                    <br />


            </div>
    </DIV>
  </div>

  <div id="avatar" class="tab-pane fade row">
    <h3>Changer de photo de profile:</h3>
    <div class="">
      <div class="col-md-6">
        <img src="../banque de donnees/utilisateur avatar/<?php echo $aff['avatar'] ?>" style="display:block; height:500px; width:420px" class="img-responsive img-thumbnail" />
      </div>
          <div class="col-md-6 form-group ">
              <form action="compte.php" method="post"  enctype="multipart/form-data">
                Changer d'avatar: <input class="form-control" type="file" name="avatar"/> <br>
                <input class="btn btn-lg btn-inverse" type="submit" name="uplAvt" value="Valider"/>

                <input class="btn btn-lg btn-info" type="submit" name="uplAvtDef" value="Par défaut"/>
              </form>
          </div>
        </div>
  </div>
  <div id="pseudo" class="tab-pane fade">
    <h3>Changer de pseudonyme:</h3><br>
    <div>
      <h4>
          Pseudo actuel: <?php echo $aff['pseudo'] ?>
      </h4><br>
      <div class="form-group col-md-3">
      <form action="compte.php" method="post"  enctype="multipart/form-data">
          <input placeholder="Nouveau pseudo" class="form-control" type="text" name="pseudo" value="" /><br>
          <input class="btn btn-lg btn-inverse" type="submit" name="changePseudo" value="Valider"/>
         </form>
      </div>
    </div>
  </div>
  <div id="password" class="tab-pane fade">
    <h3>Changer de mot de passe</h3>
    <p>
         <div class="form-group col-md-4">
          <form action="compte.php" method="post"  enctype="multipart/form-data">
                <span>
                    <input placeholder='Ancien mot de passe' class="form-control" type="password" name="nvpass"/>
                </span><br />
                <span>
                    <input placeholder='Nouveau mot de passe' class="form-control" type="password" name="nvpass"/>
                </span><br />
                <span>
                    <input placeholder='Répétez le nouveau mot de passe' class="form-control" type="password" name="renvpass"/>
                </span><br /><input class="btn btn-lg btn-inverse" type="submit" name="chgmp" value="Valider"/>
          </form>
      </div>
    </p>
  </div>
  <div id="groupes" class="tab-pane fade">
    <h3>Mes groupes</h3>
    <p>
          <?php
              $reqGrp1=mysql_query('select idGrp from utilisateur_groupe where idUti='.$id1);
            $rows=mysql_num_rows($reqGrp1);
            if($rows){
              while($affGrp1=mysql_fetch_array($reqGrp1)){
              $reqGrp=mysql_query('select libelleGrp from groupe where idGrp='.$affGrp1['idGrp']) or die(mysql_error());
              $affGrp=mysql_fetch_array($reqGrp);
              echo $affGrp['libelleGrp'];
              }
            }else echo 'Aucun groupe';
          ?>
    </p>
  </div>
  <div id="forum" class="tab-pane fade">
    <h3>Mes sujets</h3>
    <p>
        <?php
              $reqQu=mysql_query('select * from question where idUti='.$id1) or die(mysql_error());
            $rows=mysql_num_rows($reqQu);
            if($rows){
              while($affQu=mysql_fetch_array($reqQu)){
              echo $affQu['sujet'].' / ';
              }
            } else echo 'Vous avez posté aucun sujet de discussion.';
          ?>
    </p>
  </div>
</div>
<?php
include'includes/fin.php';
//Upload avatar***************************************
  if(isset($_POST['uplAvt'])){
    $dossier = '../banque de donnees/utilisateur avatar/';
    $fichier = basename($_FILES['avatar']['name']);
    $taille_maxi = 1000000;
    $taille = filesize($_FILES['avatar']['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['avatar']['name'], '.');
    //Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
       $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
    }
    if($taille>$taille_maxi)
    {
       $erreur = 'Le fichier est trop gros...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
       if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier.$pseudo.$extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
       {
          $avatar=$pseudo.$extension;
          $req=mysql_query('update utilisateur set avatar="'.$avatar.'" where idUti='.$id1) or die(mysql_error());
          if($req){
            echo 'Upload effectué avec succès !';
            $_SESSION['avatar']=$avatar;
          }
       }
       else //Sinon (la fonction renvoie FALSE).
       {
          echo 'Echec de l\'upload !';
       }
    }
    else
    {
       echo $erreur;
    }
  }elseif(isset($_POST['uplAvtDef'])){
    $req=mysql_query('update utilisateur set avatar="defaultUser.jpg" where idUti='.$id1) or die(mysql_error());
    if($req){
      echo 'Upload effectué avec succès !';
      $_SESSION['avatar']=$avatar;
    }

  }
//changer de mot de passe***************************************
  if(isset($_POST['chgmp'])){
        if($_POST['renvpass']== $_POST['nvpass']){
          $nvpass=$_POST['nvpass'];
          $req=mysql_query('update utilisateur set pass="'.$nvpass.'" where idUti='.$id1) or die(mysql_error());
          if($req){
            echo 'Mot de passe changé avec succès !';
          }
        }else echo'Vous n\'avez pas resaisi le meme mot de passe...';

  }
//changer de pseudo***************************************
  if(isset($_POST['changePseudo'])){
        if(isset($_POST['pseudo'])){
          $pseudo=$_POST['pseudo'];
          $req=mysql_query('update utilisateur set pseudo="'.$pseudo.'" where idUti='.$id1) or die(mysql_error());
          if($req){
            echo 'Pseudo changé avec succès !';
            $_SESSION['pseudo']=$pseudo;
          }
        }

  }
?>
