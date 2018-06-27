<?php

require_once "./models/model.php";

class ProduitsModel extends Model {
	// attributs: correspondance à mes champs ds la bdd
	  private $id;
		private $titre;
		private $id_console;
		private $id_jeux;
		private $annee_de_sortie;
	  private $stock;
	  private $id_pegi;


		public function createOne ($titre, $id_console, $id_jeux, $annee_de_sortie,$stock,$id_pegi){

		$db=parent::connect();

		 // on recherche si ce login est déjà utilisé par un autre membre
		 $sql = 'SELECT * FROM produits WHERE titre="'.$db->quote($titre).'"';
		 $req = $db->prepare($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());// voir s il y a une erreur
		 $result=$req->execute();
		 $data =$req->fetchAll(); //recup les données


		 if (empty($data)) {// si rien ds le 1
				$sql = 'INSERT INTO produits VALUES(0, "'.$db->quote($titre).'","'.$db->quote($id_console).'","'.$db->quote($id_jeux).'","'.$db->quote($annee_de_sortie).'","'.$db->quote($stock).'","'.$db->quote($id_pegi).'")';
				$req= $db->prepare($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
				 $req->execute();

				return "le produit a bien été ajouté "; // utilisateur a été ajouté
		 }
		 else {
				$erreur = 'le produit n\'a pas été ajouté correctement';
				return $erreur;
		 }

		}

	public function getAll (){

		$db=parent::connect();

		$sql = "select * from produits";
		$query = $db -> prepare($sql);
		$query -> execute();
		$produitsList= $query -> fetchAll();

		return $produitsList;
	}

	// GETTERS //
	  public function id() { return $this->id; }
	  public function titre() { return $this->titre; }
	  public function id_console() { return $this->id_console; }
	  public function id_jeux() { return $this->id_jeux;}
	  public function annee_de_sortie() { return $this->annee_de_sortie; }
	  public function stock() { return $this->stock; }
	  public function id_pegi() { return $this->id_pegi; }




		// SETTERS // pour assigner des valeurs aux attributs
		  public function setId( $id ){
		    $id = (int) $id;

		    if($id > 0){
		      $this->id = $id;
		    }
		}

		  public function setTitre( $civilite ){
		    if(is_string($civilite)){
		      $this->civilite = $civilite;
		    }
		}

		  public function setNom( $nom ){
		    if(is_string($nom)){
		      $this->nom = $nom;
		    }
		}

		  public function setPrenom( $prenom ){
		    if(is_string($prenom)){
		      $this->prenom = $prenom;
		    }
		  }

		  public function setDate_de_naissance( $Date_de_naissance){
		      $this->Date_de_naissance = $Date_de_naissance;
		}

		  public function setGenre( $genre ){
		    if(is_int($genre)){
		      $this->genre = $genre;
		    }
		}

		  public function setAdresse_postale( $adresse_postale ){
		    if(is_string($adresse_postale)){
		      $this->adresse_postale = $adresse_postale;
		    }
		}











}


?>