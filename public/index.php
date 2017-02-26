<?php
include'../config.php';
include'includes/debut.php';
if($id1!=0){
echo' 						 			
		<nav class=" row nav nav-bar navbar-inverse">
	<div class="col-md-2 navbar-header">
      <a class="navbar-brand" href="#">
        ACCUEIL >
      </a>
	  </div>
	  	<div class="col-md-7">

                        <ul style="background:black" class="nav navbar-nav ">
                              <li>
                                  <a href="http://localhost/plateforme/public/forum/ajouter_sujet.php">
                                      Poser une question
                                  </a>
                              </li>
                              <li>
                                  <a href="http://localhost/plateforme/public/groupe/ajouterGr.php">
                                      Créer un groupe
                                  </a>
                              </li>
                         </ul>
						 	  </div>
	  			<div class="col-md-3">
					  <form class="navbar-form navbar-right" action="chercher.php" method="POST">
      						<span class="input-group">
        						<input type="text" name="sujet" class="form-control" placeholder="Chercher Sujet">
      							<span class="input-group-btn">
      								<button type="submit" name="submit" class="glyphicon glyphicon-search btn btn-primary">
									</button>
								</span>
							</span>
    					</form>		
							  </div>

                         </nav>	
						 <article style="background:#FFF" class="container">		
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

';

}else {echo'<article style="background:#FFF" class="container">';
include('includes/connexion.php');
}
include'includes/fin.php';
?>