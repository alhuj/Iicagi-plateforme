<?php
//include'../../crudl/fonction.php';
//$activeMenu = new activeMenu();
if($id!=0){
echo'
					 <nav class="navbar ">
                         <ul class="nav navbar-nav col-md-7 navbar-header">

                              <li >
                                  <a href="http://localhost/plateforme/admin/utilisateur groupe/index.php">
                                      Utilisateurs/Groupes
                                  </a>
                              </li>
                              <li >
                                  <a href="http://localhost/plateforme/admin/postes/index.php">
                                      Postes
                                  </a>
                              </li>
                              <li>
                                  <a href="http://localhost/plateforme/admin/tables systemes/index.php">
                                      Tables Systèmes
                                  </a>
                              </li>
                              <li>
                                  <a href="http://localhost/plateforme/admin/bibliotheque/index.php">
                                      Bibliothèque
                                  </a>
                              </li>
                         </ul>
<div>
    <ul class="nav navbar-nav navbar-right">
      <div class="dropdown">
  		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
        	<span class="glyphicon glyphicon-user"></span> '.$pseudo .'
			  			<span class="caret"></span>
        </button>
  	  <ul class="dropdown-menu">
    		<li><a href="http://localhost/plateforme/admin/compte.php">Compte</a></li>
        	<li><a href="http://localhost/plateforme/admin/includes/deconnection.php">Deconnexion</a></li>
  	  </ul>
	  </div>
    </ul>
</div>		      </nav>

		</div>
			</header>

    ';
}else echo'
			 </nav>
        </header>
		 <aside class="col-md-3">
 		</aside>
        <article class="col-md-8 container-fluid">

';
?>
