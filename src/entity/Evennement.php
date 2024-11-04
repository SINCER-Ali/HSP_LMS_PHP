<?php

namespace entity;

use bdd\Bdd;

class Evennement
{
private $id_evenement;
private $titre;
private $description;
private $lieu;
private $nb_places;

    /**
     * @param $id_evenement
     * @param $titre
     * @param $description
     * @param $lieu
     * @param $nb_places
     */
    public function __construct($id_evenement, $titre, $description, $lieu, $nb_places)
    {
        $this->id_evenement = $id_evenement;
        $this->titre = $titre;
        $this->description = $description;
        $this->lieu = $lieu;
        $this->nb_places = $nb_places;
    }

    /**
     * @return mixed
     */
    public function getIdEvenement()
    {
        return $this->id_evenement;
    }

    /**
     * @param mixed $id_evenement
     */
    public function setIdEvenement($id_evenement)
    {
        $this->id_evenement = $id_evenement;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return mixed
     */
    public function getNbPlaces()
    {
        return $this->nb_places;
    }

    /**
     * @param mixed $nb_places
     */
    public function setNbPlaces($nb_places)
    {
        $this->nb_places = $nb_places;
    }
    public function ajouter(){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('INSERT INTO evenement (titre, description, lieu, nb_places) VALUES (:titre, :description, :lieu, :nb_places)');

        $res = $req->execute(array(
            "titre" => $this->getTitre(),
            "description" => $this->getDescription(),
            "lieu" => $this->getLieu(),
            "nb_places" => $this->getNbPlaces(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/ajout.php?erreur");
        }
    }
    public function editer(){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('UPDATE evenement SET titre=:titre,description=:description,lieu=:lieu,nb_places=:nb_places WHERE id_evenement=:id_evenement');
        $res = $req->execute(array(
            "titre" => $this->getTitre(),
            "description" => $this->getDescription(),
            "lieu" => $this->getLieu(),
            "nb_places" => $this->getNbPlaces(),
            "id_evenement" => $this->getIdEvenement(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/edition.php?id_user=" . $this->getIdUtilisateur() . "&erreur");
        }
    }

    public function supprimer(){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('DELETE FROM entreprise WHERE id_entreprise=:id_entreprise');
        $res = $req->execute(array(
            "id_entreprise" => $this->getIdEntreprise(),
        ));

        if ($res) {
            header("Location: ../../vue/accueil.php?success");
        } else {
            header("Location: ../../vue/connexion.php?erreur");
        }
    }

}