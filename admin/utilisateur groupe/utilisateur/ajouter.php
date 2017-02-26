<?php
$titre = "Ajout d'un utilisateur";
include("../../../config.php");
include("../../includes/debut.php");
include("../../includes/menu.php");
include("../aside.php");
?>
<div align="center" class="form-group block1" >
<h3>Ajout d'un nouveau utilisateur</h3>
		<form class="form-inline" action='ajouter.php' method='post'>
            <table class="table-condensed">
                <tr>
                    <td align="right">Nom:  </td>
                    <td ><input class="form-control"  type='text' name='nom' /></td>
                </tr>
                <tr>
                    <td align="right">Prénom:  </td>
                    <td><input class="form-control"  type='text' name='prenom' /></td>
                </tr>
                <tr>
                    <td align="right">Date de naissance:  </td>
                    <td><input class="form-control" type="date" name='dateNaiss' placeholder="aaaa-mm-jj" /></td>
                </tr>
                <tr>
                    <td align="right">Lieu de naissance:  </td>
                    <td><input class="form-control"  type='text' name='lieuNaiss' /></td>
                </tr>
                <tr>
                    <td align="right">Adresse:  </td>
                    <td><input class="form-control"  type='text' name='adresse' /></td>
                </tr>
                <tr>
                    <td align="right">Telephone: (+221)</td>
                    <td><input maxlength="9" class="form-control"  type='number' name='telephone' /></td>
                </tr>
                <tr>
                    <td align="right">Email:  </td>
                    <td><input class="form-control"  type='text' name='email' /></td>
                </tr>
                <tr>
                    <td align="right">Filière:  </td>
                    <td>
                    	<select class="form-control" name='idFil'>
                        	<?php
								$req=mysql_query('select * from filiere_sys') or die(mysql_error());
								while($recup=mysql_fetch_array($req)){
												echo'
												<option value="'.$recup['idFil'].'">'.$recup['libelleFil'].'</option>
												';
												}
								?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">Niveau:  </td>
                    <td>
                    	<select class="form-control" name='idNiv'>
                        	<?php
								$req=mysql_query('select * from niveau_sys') or die(mysql_error());
								while($recup=mysql_fetch_array($req)){
												echo'
												<option value="'.$recup['idNiv'].'">'.$recup['libelleNiv'].'</option>
												';
												}
								?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>
                    	Type utilisateur:
                    </td>
                    <td>
                    	<?php
								$req=mysql_query('select * from type_utilisateur_sys') or die(mysql_error());
								while($recup=mysql_fetch_array($req)){
												echo'
												<input type="radio" name="idType" value="'.$recup['idType'].'"/>'.$recup['libelleType'].'';
												}						?>
                    </td>
                </tr>
                <tr>
                	<td>
                    	Privilege:
                    </td>
                    <td>
                    	<?php
								$req=mysql_query('select * from privilege_sys') or die(mysql_error());
								while($recup=mysql_fetch_array($req)){
									echo'
									 <input type="radio" name="idPrivi" value="'.$recup["idPrivi"].'"/>'.$recup['libellePrivi'].'';
									}						?>
                    </td>
                </tr>
            </table>
            <input class="btn btn-default" type="submit" name="ajouter" value="Ajouter"/>
</div>

<?php

include("../../../crudl/utilisateur.php");
$user= new utilisateur();
$user->ajouter();
include("../../includes/fin.php");
?>
