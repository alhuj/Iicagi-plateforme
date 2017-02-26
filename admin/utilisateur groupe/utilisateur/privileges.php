<?php
$titre = "Liste des utilisateurs";
include("../includes/config.php");
include("../includes/debut.php");
include("../includes/menu.php");
if(isset($_GET['id'])){
echo"
<form action='privileges.php?id=".$_GET['id']."' method='GET'>
    <table border='0'>
    	<input type='hidden' name='idUti' value='".$_GET['id'] ."'/>
		<tr>
            <td>Privileges</td>
          <td>
            	<input type='radio' name='typeUti' value='Moderateur'/>Moderateur<br />
                <input type='radio' name='typeUti' value='Simple' checked='checked'/>Simple<br />

            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='enregistrer' value='Enregistrer' /> 
            </td>
        </tr>
    </table>
";
}
include("../includes/utilisateur.php");
$user= new utilisateur();
$user->privilege();

include("../includes/fin.php");
?>