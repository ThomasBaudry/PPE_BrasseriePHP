<?php

class vue{

	private function entete(){
		echo '<html>
			    <head>
			    	<title>Brasserie Clemence</title>
			        <meta charset="utf-8" />

			    	<!-- BootStrap Css -->
			    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
			    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
			    	
			    </head>
			    <body style="background-color: #F6F6F6;">
			        <nav class="navbar navbar-expand-lg navbar navbar-dark" style="background-color: #0764D5;">
			            <a class="navbar-brand" href="index.php"><img src="./logo.png" href="#" height="50px" width="50px" />Menu général</a>
			            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			                <span class="navbar-toggler-icon"></span>
			            </button>
			            <div class="collapse navbar-collapse" id="navbarNavDropdown">
			                <ul class="navbar-nav">
			                    <li class="nav-item active">
			                        <a class="nav-link" href="index.php?action=ajoutBiere"> Nouvelle Biere </a>
			                    </li>
			                    <li class="nav-item">
			                        <a class="nav-link" href="index.php?action=ajoutBrassin"> Nouveau Brassin</a>
			                    </li>
			                    <li class="nav-item">
			                        <a class="nav-link" href="index.php?action=ajoutMouvement">Nouveau Mouvement</a>
			                    </li>
			                </ul>
			            </div>
			        </nav>';
	}
	private function fin(){
		echo '	</body>
			</html>';
	}
    public function connection($base, $erreur){
        echo '
            <html>
                <head>
                    <title>Connexion</title>

                    <!-- BootStrap Css -->
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
                    
                </head>
                <body>
                    <div class="container">
                        <div class="row">
                            <div class="col align-self-center">

                                <!-- Entete Connexion -->
                                <center>
                                    <br/><h2> Connexion : </h2><br/>
                                    <form name="form1" action="" method="POST">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Identifiant</span>
                                            </div>
                                            <input type="text" name="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Mot de passe</span>
                                            </div>
                                            <input type="password" name="mdp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <input type="submit" name="ok" class="btn btn-primary btn-lg"/>
                                    </form>
                                </center>

                            </div>
                        </div>
                    </div>';
        if($erreur){
            echo '<center><h4 style="color: red;"> Identifiant incorrect !</h4></center>';
        }
        $this->fin();
    }
	public function menu($base){
		$this->entete();
		echo '<div class="container-fluid" style="background-color: white;">
            <br/>
            <div class="row">
                <div class="col-4"><h1>Brasserie Clémence</h1></div>
                <div class="col-4">
                    <form action="" method="POST" name=intervalle>
                        <input type="date" name="date1" />
                        <input type="date" name="date2" />
                        <center><input type="submit" name="KK" value="Rechercher" /></center>
                    </form>
                </div>
            </div>
            <br />
            
            <div class="row">
                <div class="col-8"><h3>Liste des brassins</h3></div>
            </div>
            
      		<table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Brassin</th>
                    <th scope="col">Date brassage</th>
                    <th scope="col">Nom commercial</th>
                    <th scope="col">% alcool</th>
                    <th scope="col">Volume</th>
                    <th scope="col">Date de mise en bouteille</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>';
                        //Si on recherche les brassins entre 2 dates choisies, on affiche ceux disponibles.
                        if(isset($_POST["KK"]))
                        {
                            if(isset($_POST['date1']) && isset($_POST['date2']))
                            {
                                $tabbrassmois = $base->getBrassinMois($_POST['date1'], $_POST['date2']);
                                $mouvementbrass = array();

                                foreach($tabbrassmois as $row)
                                {
                                    echo "<tr><th scope='col'>".$row->getCode()."</th><td scope='col'>".$row->getDateBrass()."</td><td scope='col'>".$row->getNomCom()."</td><td scope='col'>".$row->getPourAlcool()."</td><td scope='col'>".$row->getVolume()."</td><td scope='col'>".$row->getDateMiseBout()."</td><td scope='col'><a href='index.php?action=modifBrassin&code=".$row->getCode()."'><button>Modifier</button></a></td><td scope='col'><a href='index.php?action=supprimer&code=".$row->getCode()."'><button>Supprimer</button></a></td></tr>";

                                    //On cherche tout les brassins disponibles par le biais du code du brassin de la ligne actuelle, et on le range dans un tableau.
                                    $mouvementbrass[] = $base->getMouvementBrassin($row->getCode());
                                }
                            }
                            else
                            {
                                echo "Veuillez indiquer 2 dates valides";
                            }
                        }
                        //Sinon, on les affiche tous.
                        else
                        {
                            $tabbrass = $base->getBrassin();
                            foreach($tabbrass as $ligne)
                            {
                                echo "<tr><th scope='col'>".$ligne->getCode()."</th><td scope='col'>".$ligne->getDateBrass()."</td><td scope='col'>".$ligne->getNomCom()."</td><td scope='col'>".$ligne->getPourAlcool()."</td><td scope='col'>".$ligne->getVolume()."</td><td scope='col'>".$ligne->getDateMiseBout()."</td><td scope='col'><a href='index.php?action=modifBrassin&code=".$ligne->getCode()."'><button>Modifier</button></a></td><td scope='col'><a href='index.php?action=supprimer&code=".$ligne->getCode()."'><button>Supprimer</button></a></td></tr>";
                            }
                        }
            echo '
	                </tbody>
	            </table>
	            <br/>
	            <div class="row">
	                <div class="col-8"><h3>Liste des Mouvements</h3></div>
	            </div>
	            
	      		<table class="table table-striped">
	                <thead>
	                    <tr>
	                    <th scope="col">Code</th>
	                    <th scope="col">Date</th>
	                    <th scope="col">Nom</th>
	                    <th scope="col">% Alcool</th>
	                    <th scope="col">Contenance</th>
	                    <th scope="col">Stock début mois</th>
	                    <th scope="col">Stock réalisé</th>
	                    <th scope="col">Sorties vendues</th>
	                    <th scope="col">Sorties dégustations</th>
	                    <th scope="col">Stock fin de mois</th>
	                    <th scope="col">Volume des sorties</th>
	                    <th scope="col">Coût douanes</th>
	                    <th scope="col">Modifier</th>
	                    <th scope="col">Supprimer</th>
	                    </tr>
	                </thead>
	                <tbody>';
	                    //Si on recherche les mouvements entre 2 dates choisies, on affiche ceux disponibles.
	                    if(isset($_POST['KK']))
	                    {
	                      if(isset($_POST['date1']) && isset($_POST['date2']))
	                      {
	                        foreach($mouvementbrass as $case)
	                        {
	                          foreach($case as $row)
	                          {
	                           echo "<tr><th scope='col'>".$row->getCode()."</th><td scope='col'>".$row->getDate()."</td><td scope='col'>".$row->getNomCommercial()."</td><td scope='col'>".$row->getPourcentageAlcool()."</td><td scope='col'>".$row->getContenance()."</td><td scope='col'>".$row->getStockDebMois()."</td><td scope='col'>".$row->getStockRealise()."</td><td scope='col'>".$row->getSortiesVendues()."</td><td scope='col'>".$row->getSortiesDeg()."</td><td scope='col'>".$row->getStockFinMois()."</td><td scope='col'>".$row->getVolSorties()."</td><td scope='col'>".$row->getCoutDouanes()."</td><td scope='col'><a href='index.php?action=modifMouvement&code=".$row->getId()."'><button>Modifier</button></a></td><td scope='col'><a href='index.php?action=supprimer&code=".$row->getId()."'><button>Supprimer</button></a></td></tr>";
	                          }
	                        }
	                      }
	                    }
	                    //Sinon, on les affiche tous.
	                    else
	                    {
	    					
	                      $tabmouv = $base->getMouvement();
	                      foreach($tabmouv as $row)
	                      {
	                        echo "<tr><th scope='col'>".$row->getCode()."</th><td scope='col'>".$row->getDate()."</td><td scope='col'>".$row->getNomCommercial()."</td><td scope='col'>".$row->getPourcentageAlcool()."</td><td scope='col'>".$row->getContenance()."</td><td scope='col'>".$row->getStockDebMois()."</td><td scope='col'>".$row->getStockRealise()."</td><td scope='col'>".$row->getSortiesVendues()."</td><td scope='col'>".$row->getSortiesDeg()."</td><td scope='col'>".$row->getStockFinMois()."</td><td scope='col'>".$row->getVolSorties()."</td><td scope='col'>".$row->getCoutDouanes()."</td><td scope='col'><a href='index.php?action=modifMouvement&code=".$row->getId()."'><button>Modifier</button></a></td><td scope='col'><a href='index.php?action=supprimer&code=".$row->getId()."'><button>Supprimer</button></a></td></tr>";
	                      }
	                    }
	    echo '
	                </tbody>
	            </table>
	            <br/>
	      	</div>';
	    $this->fin();
	}


	public function ajoutBiere($base){
		$this->entete();
		echo '
			<div class="container col-12">    
            <div class="d-flex justify-content-between">
                <div class="col-4">
                    <h2> Nouveau type de bière </h2>
                    <!--Zone d\'ajout pour les bières-->
                    <form method="POST" action="" name="nvNom">
                    <div class="form-group">
                        <label for="nomB"> Nom : </label>
                        <input type="text" name="nomB" />
                    </div>
                    <input type="submit" class="btn btn-primary" name="OKNom" value="Confirmer" />
                    </form>';
                      
        $this->fin();
	}
	public function ajoutBrassin($base){
		$this->entete();
		
        echo '
                </div>
                <div class="col-4">
                    <h2> Nouveau brassin  </h2>
                    <!--Zone d\'ajout pour les brassins-->
                    <form name="nvBrassin" method="POST" action="">
                        <div class="form-group">
                            <label for="dateBrassage">Date de Brassage : </label>
                            <input type="date" class="form-control" min="2020-01-01" name="dateBrassage" />
                        </div>
                        <div class="form-group">
                            <label for="nomCommercial"> Nom commercial : </label>
                            <select name=nomCommercial class="form-control">';
                                    $tab=$base->getBiere();

                                    //On sélectionne toutes les bières existantes et on range leur id en affichant leur nom.
                                    foreach($tab as $ligne)
                                    {
                                        echo "<option value='".$ligne->getId()."'>".$ligne->getNom()."</option>";
                                    }
        echo '
                            </select>     
                        </div>
                        <div class="form-group">
                            <label for="prcAlcool">Pourcentage d\'alcool : </label>
                            <input type="text" class="form-control" name="prcAlcool" />
                        </div>
                        <div class="form-group">
                            <label for="volumeAlcool">Volume : </label>
                            <input type="text" class="form-control" name="volumeAlcool" />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Date de mise en bouteille :  </label>
                            <input type="date" class="form-control"min="2020-01-01" name="dateMiseBouteille" />
                        </div>
                        <input type="submit" class="btn btn-primary" name="OKBrass" value="Confirmer"/>
                    </form>
                </div>';
                   
                    $this->fin();
                }
        public function ajoutMouvement($base){
        	$this->entete();
        
        echo '        
                <div class="col-4">
                    <h2> Nouveau mouvement </h2>
                    <!--Zone d\'ajout pour les mouvements-->
                    <form method="POST" action="" name="nvNom">
                        <div class="form-group">
                            <label for="dateMouv"> Date du mouvement : </label>
                            <input type="date" class="form-control"min="2020-01-01" name="dateMouv" />
                        </div>
                        <div class="form-group">
                            <label for="contenanceMouv"> Contenance : </label>
                            <input type="text" class="form-control" name="contenanceMouv"/>
                        </div>
                        <div class="form-group">
                            <label for="nbBouteilles"> Nombres de Bouteilles :</label>
                            <input type="text" class="form-control" name="nbBouteilles"/> 
                        </div>
                        <div class="form-group">
                            <label for="codeBrassin"> Brassin : </label>
                            <select name="code" class="form-control">';
                                    $tab=$base->getBrassin();

                                    //On sélectionne tout les brassins existantes et on range leur id en affichant leur nom.
                                    foreach($tab as $ligne)
                                    {
                                        echo "<option value='".$ligne->getCode()."'>".$ligne->getCode()."</option>";
                                    }
        echo '
                            </select>     
                        </div>
                        <div class="form-group">
                            <label for="stockDebMois"> Stock début mois : </label>
                            <input type="text" class="form-control" name="stockDebMois"/> 
                        </div>
                        <div class="form-group">
                            <label for="stockRealise"> Stock realisé : </label>
                            <input type="text" class="form-control" name="stockRealise"/> 
                        </div>
                        <div class="form-group">
                            <label for="sortieVendues"> Sortie vendues : </label>
                            <input type="text" class="form-control" name="sortiesVendues"/> 
                        </div>
                        <div class="form-group">
                            <label for="sortiesDeg"> Sortie dégustation : </label>
                            <input type="text" class="form-control" name="sortiesDeg"/> 
                        </div>
                        <div class="form-group">
                            <label for="volumeSorties"> Volumes des sorties : </label>
                            <input type="text" class="form-control" name="volumeSorties"/> 
                        </div>
                        <div class="form-group">
                            <label for="coutDouanes"> Côut douanes : </label>
                            <input type="text" class="form-control" name="coutDouanes"/> 
                        </div>
                        <input type="submit" class="btn btn-primary" name="OKMouv" value="Confirmer" />
                    </form>
                </div>
            </div>
        </div>
		';
		$this->fin();
	}
    public function modifBrassin($base, $lebrass){
    	$this->entete();
        echo '
            <div class="container col-12">    
            <div class="d-flex justify-content-between">   
                <div class="col align-self-start">
                    <center><h2>Modifier un brassin</h2></center>
                    <!--Zone de modification des brassins-->
                    <form name="nvBrassin" method="POST" action="">
                        <div class="form-group">
                            <label for="dateBrassage">Date de Brassage : </label>
                            <input type="date" class="form-control" min="2020-01-01" name="dateBrassage" value="'.$lebrass->getDateBrass().'"/>
                        </div>
                        <div class="form-group">
                            <label for="nomCommercial"> Nom commercial : </label>
                            <select name=nomCommercial class="form-control">';
                                    $tab=$base->getBiere();

                                    //On sélectionne toutes les bières existantes et on range leur id en affichant leur nom, et on affiche celle que le brassin représente.
                                    foreach($tab as $ligne)
                                    {
                                        $selec = "";
                                        if($ligne->getNom() == $lebrass->getNomCom())
                                        {
                                            $selec = "selected=''";
                                        }
                                        
                                        echo "<option ".$selec." value='".$ligne->getId()."'>".$ligne->getNom()."</option>";
                                    }
        echo '
                            </select>     
                        </div>
                        <div class="form-group">
                            <label for="prcAlcool">Pourcentage d\'alcool : </label>
                            <input type="text" class="form-control" name="prcAlcool" value="'.$lebrass->getPourAlcool().'"/>
                        </div>
                        <div class="form-group">
                            <label for="volumeAlcool">Volume : </label>
                            <input type="text" class="form-control" name="volumeAlcool" value="'.$lebrass->getVolume().'"/>
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Date de mise en bouteille :  </label>
                            <input type="date" class="form-control"min="2020-01-01" name="dateMiseBouteille" value="'.$lebrass->getDateMiseBout().'" />
                        </div>
                        <input type="submit" class="btn btn-primary" name="OKBrass" value="Confirmer" />
                    </form>';
        echo'
                  </div>
                </div>
            </div>
            ';
        $this->fin();
    }



    public function modifMouvement($base, $lemouv){
        $this->entete();
        echo'<div class="container col-12">    
                <div class="d-flex justify-content-between">   
                  <div class="col align-self-start">
                      <center><h2>Modifier un mouvement</h2></center>
                      <!--Zone de modification des mouvements-->
                      <form name="nvBrassin" method="POST" action="">
                         <div class="form-group">
                            <label for="dateBrassage">Date : </label>
                            <input type="date" class="form-control" min="2020-01-01" name="dateMouv" value="'.$lemouv->getDate().'"/>
                          </div>
                          <div class="form-group">
                                    <label for="volumeAlcool">Nombre de bouteilles : </label>
                                    <input type="text" class="form-control" name="nbBout" value="'.$lemouv->getNbBouteilles().'"/>
                                </div>
                                <div class="form-group">
                                    <label for="volumeAlcool">Contenance : </label>
                                    <input type="text" class="form-control" name="contenance" value="'.$lemouv->getContenance().'"/>
                                </div>
                                <div class="form-group">
                                    <label for="dateMiseBouteille">Stock début de mois :  </label>
                                    <input type="text" class="form-control" name="stockDeb" value="'.$lemouv->getStockDebMois().'"/>
                                </div>
                                <div class="form-group">
                                    <label for="dateMiseBouteille">Stock réalisé :  </label>
                                    <input type="text" class="form-control" name="stockReal" value="'.$lemouv->getStockRealise().'"/>
                                </div>
                                <div class="form-group">
                                    <label for="dateMiseBouteille">Sorties vendues :  </label>
                                    <input type="text" class="form-control" name="sortiesVend" value="'.$lemouv->getSortiesVendues().'"/>
                                </div>
                                <div class="form-group">
                                    <label for="dateMiseBouteille">Sorties dégustation :  </label>
                                    <input type="text" class="form-control" name="sortiesDeg" value="'.$lemouv->getSortiesDeg().'"/>
                                </div>
                                <div class="form-group">
                                    <label for="dateMiseBouteille">Stock fin de mois :  </label>
                                    <input type="text" class="form-control" name="stockFin" value="'.$lemouv->getStockFinMois().'"/>
                                </div>
                                <div class="form-group">
                                    <label for="dateMiseBouteille">Volume des sorties :  </label>
                                    <input type="text" class="form-control" name="volumeSorties" value="'.$lemouv->getVolSorties().'"/>
                                </div>
                                <div class="form-group">
                                    <label for="dateMiseBouteille">Coût des douanes :  </label>
                                    <input type="text" class="form-control" name="coutDouanes" value="'.$lemouv->getCoutDouanes().'"/>
                                </div>
                                <input type="submit" class="btn btn-primary" name="OKMouv" value="Confirmer" />
                            </form>';

                             
    }
}
?>