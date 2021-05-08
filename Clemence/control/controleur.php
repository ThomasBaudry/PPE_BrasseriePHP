<?php
	class controleur{
		public function connection(){
			$base = (new BDD);
			if(isset($_SESSION["connect"])){
				(new controleur)->menu($base);
			}
			else{
				if(isset($_POST["ok"]))
		      	{
		            $res = $base->connexion($_POST["id"], $_POST["mdp"]);
		            if($res >= 1)
		            {
		                $_SESSION["connect"] = "OK";
		                $_SESSION["login"] = $_POST["id"];
		                (new controleur)->menu($base);
		            }
		            else
		            {
		                (new vue)->connection($base, true);
		            }
		        }
		        else
		        {
		        	(new vue)->connection($base, false);
		        }
				
			}
		}
		public function menu(){
			$base = (new BDD);
			(new vue)->menu($base);
		}

		public function ajoutBiere()
		{ 
			$base = (new BDD);
			if(isset($_POST["OKNom"]))
            {
                $b = new Biere();
                $b->setNom($_POST["nomB"]);

                $base->insertBiere($b);
                (new vue)->menu($base);
            }
            else{
				(new vue)->ajoutBiere($base);
            }
		}
		public function ajoutBrassin(){
			$base = (new BDD);
			if(isset($_POST["OKBrass"]))
            {
                $br = new Brassin();
                $ID = $base->creaIDBrassin($_POST["dateBrassage"]);
                $br->setCode($ID);
                $br->setDateBrass($_POST["dateBrassage"]);
                $br->setDateMiseBout($_POST["dateMiseBouteille"]);
                $br->setVolume($_POST["volumeAlcool"]);
                $br->setPourAlcool($_POST["prcAlcool"]);
                //On récupère le nouvel objet brassin + l'ID de la bière qui lui correspond via le select.
                $base->insertBrassin($br,$_POST["nomCommercial"]);
            	(new vue)->menu($base);
            }
            else{
				(new vue)->ajoutBrassin($base);
            }
		}
		public function ajoutMouvement(){
			$base = (new BDD);
			if(isset($_POST["OKMouv"])){
				
			$mv = new Mouvement();

			$mv ->setDate($_POST["dateMouv"]);
			$mv ->setContenance($_POST["contenanceMouv"]);
			$mv ->setNbBouteilles($_POST["nbBouteilles"]);
			$mv ->setCode($_POST["code"]);
			$mv ->setStockDebMois($_POST["stockDebMois"]);
			$mv ->setStockRealise($_POST["stockRealise"]);
			$mv ->setSortiesVendues($_POST["sortiesVendues"]);
			$mv ->setSortiesDeg($_POST["sortiesDeg"]);
			$stock = $_POST["stockDebMois"] + $_POST["stockRealise"] - $_POST["sortiesVendues"] - $_POST["sortiesDeg"];
			$mv ->setStockFinMois($stock);
			$mv ->setVolSorties($_POST["volumeSorties"]);
			$mv ->setCoutDouanes($_POST["coutDouanes"]);
			//On récupère le nouvel objet mouvement.
			$base->insertMouvement($mv);
				(new vue)->menu($base);
            }
            else{
				(new vue)->ajoutMouvement($base);
            }

		}

		public function supprimer(){
			$base = (new BDD);
			if(isset($_GET["code"]))
			{
				$base->deleteBrassin($_GET["code"]);
			}
			else
			{
				if(isset($_GET["id"]))
				{
					$base->deleteMouvement($_GET["id"]);
				}
			}
			$base = (new BDD);
			(new vue)->menu($base);
		}
		public function modifBrassin(){
			$base = (new BDD);
			if(isset($_GET["code"]))
		    {
		        $lebrass = $base->recupBrassin($_GET["code"]);
		    }
		    else
		    {
		        (new vue)->menu($base);
		        exit();
		    }

		    if(isset($_POST["OKBrass"]))
            {
                //On modifie l'objet envoyé en mettant toutes les valeurs des inputs, modifiés ou non.
                $lebrass->setDateBrass($_POST["dateBrassage"]);
                $lebrass->setPourAlcool($_POST["prcAlcool"]);
                $lebrass->setVolume($_POST["volumeAlcool"]);
                $lebrass->setDateMiseBout($_POST["dateMiseBouteille"]);
                $IDB = $_POST["nomCommercial"];

                $base->updateBrassin($lebrass, $IDB);

                (new vue)->menu($base);
            }
            else{

            	(new vue)->modifBrassin($base, $lebrass);
            }
		    
		}

		public function modifMouvement(){
			$base =(new BDD);
			if(isset($_GET["code"]))
			{
				$lemouv = $base->recupMouvement($_GET["code"]);
			}
			else
			{
				(new vue)->menu($base);
				exit();
			}
			if(isset($_POST["OKMouv"]))
            {
                //On modifie l'objet envoyé en mettant toutes les valeurs des inputs, modifiés ou non.
                $lemouv->setDate($_POST["dateMouv"]);
                $lemouv->setNbBouteilles($_POST["nbBout"]);
                $lemouv->setContenance($_POST["contenance"]);
                $lemouv->setStockDebMois($_POST["stockDeb"]);
                $lemouv->setStockRealise($_POST["stockReal"]);
                $lemouv->setSortiesVendues($_POST["sortiesVend"]);
                $lemouv->setSortiesDeg($_POST["sortiesDeg"]);
                $lemouv->setStockFinMois($_POST["stockFin"]);
                $lemouv->setVolSorties($_POST["volumeSorties"]);
                $lemouv->setCoutDouanes($_POST["coutDouanes"]);

                $base->updateMouvement($lemouv);

                (new vue)->menu($base);

            }
            else{
            	(new vue)->modifMouvement($base, $lemouv);
            }
			
		}
	}


	
		
	
	

