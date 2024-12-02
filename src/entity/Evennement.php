<?php
namespace entity;

require_once __DIR__ . '/../bdd/Bdd.php';
use bdd\Bdd;

class Evennement
{
    private $id_evenement;
    private $titre;
    private $description;
    private $lieu;
    private $nb_places;
    private $date;
    private $ref_medecin;

    public function __construct($id_evenement = null, $titre = null, $description = null, $lieu = null, $nb_places = null, $date = null, $ref_medecin = null)
    {
        $this->id_evenement = $id_evenement;
        $this->titre = $titre;
        $this->description = $description;
        $this->lieu = $lieu;
        $this->nb_places = $nb_places;
        $this->date = $date;
        $this->ref_medecin = $ref_medecin;
    }

    public function getIdEvenement()
    {
        return $this->id_evenement;
    }

    public function setIdEvenement($id_evenement)
    {
        $this->id_evenement = $id_evenement;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    public function getNbPlaces()
    {
        return $this->nb_places;
    }

    public function setNbPlaces($nb_places)
    {
        $this->nb_places = $nb_places;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getRefMedecin()
    {
        return $this->ref_medecin;
    }

    public function setRefMedecin($ref_medecin)
    {
        $this->ref_medecin = $ref_medecin;
    }

    public function getAllEvenements()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->query('SELECT * FROM evenement ORDER BY date DESC');
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function ajouter()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('INSERT INTO evenement (titre, description, lieu, nb_places, date, ref_medecin) VALUES (:titre, :description, :lieu, :nb_places, :date, :ref_medecin)');

        $res = $req->execute(array(
            "titre" => $this->getTitre(),
            "description" => $this->getDescription(),
            "lieu" => $this->getLieu(),
            "nb_places" => $this->getNbPlaces(),
            "date" => $this->getDate(),
            "ref_medecin" => $this->getRefMedecin(),
        ));

        if ($res) {
            header("Location: ../../vue/starter-page.php?success=event_added");
        } else {
            header("Location: ../../vue/creer_evenement.php?error=event_add_failed");
        }
    }

    public function editer()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('UPDATE evenement SET titre=:titre, description=:description, lieu=:lieu, nb_places=:nb_places, date=:date, ref_medecin=:ref_medecin WHERE id_evenement=:id_evenement');
        $res = $req->execute(array(
            "titre" => $this->getTitre(),
            "description" => $this->getDescription(),
            "lieu" => $this->getLieu(),
            "nb_places" => $this->getNbPlaces(),
            "date" => $this->getDate(),
            "ref_medecin" => $this->getRefMedecin(),
            "id_evenement" => $this->getIdEvenement(),
        ));

        if ($res) {
            header("Location: ../../vue/starter-page.php?success=event_edited");
        } else {
            header("Location: ../../vue/editer_evenement.php?id=" . $this->getIdEvenement() . "&error=event_edit_failed");
        }
    }

    public function supprimer()
    {
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('DELETE FROM evenement WHERE id_evenement=:id_evenement');
        $res = $req->execute(array(
            "id_evenement" => $this->getIdEvenement(),
        ));

        if ($res) {
            header("Location: ../../vue/starter-page.php?success=event_deleted");
        } else {
            header("Location: ../../vue/starter-page.php?error=event_delete_failed");
        }
    }
}