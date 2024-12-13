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

    public function __construct(array $donnees)
    {
        if (!empty($donnees)) {
            $this->hydrate($donnees);
        }
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Getters
    public function getIdEvenement()
    {
        return $this->id_evenement;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function getNbPlaces()
    {
        return $this->nb_places;
    }

    public function getDate()
    {
        return $this->date;
    }

    // Setters
    public function setIdEvenement($id_evenement)
    {
        $this->id_evenement = $id_evenement;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    public function setNbPlaces($nb_places)
    {
        $this->nb_places = filter_var($nb_places, FILTER_VALIDATE_INT);
        if ($this->nb_places === false || $this->nb_places < 0) {
            throw new \InvalidArgumentException("Le nombre de places doit être un entier positif.");
        }
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function ajouter()
    {
        try {
            $bdd = new Bdd();
            $req = $bdd->getBdd()->prepare('INSERT INTO evenement (titre, description, lieu, nb_places, date) VALUES (:titre, :description, :lieu, :nb_places, :date)');

            $success = $req->execute([
                'titre' => $this->titre,
                'description' => $this->description,
                'lieu' => $this->lieu,
                'nb_places' => $this->nb_places,
                'date' => $this->date
            ]);

            if (!$success) {
                throw new \Exception("Erreur lors de l'ajout de l'événement");
            }
            header('Location: ../../Hsp/Medilab/starter-page.php#events');
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de l'ajout de l'événement : " . $e->getMessage());
        }
    }

    public function getAllEvenements()
    {
        try {
            $bdd = new Bdd();
            $req = $bdd->getBdd()->query('SELECT * FROM evenement ORDER BY date DESC');
            return $req->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la récupération des événements : " . $e->getMessage());
        }
    }

    public function inscrire($id_utilisateur)
    {
        try {
            $bdd = new Bdd();

            $checkReq = $bdd->getBdd()->prepare('SELECT COUNT(*) FROM inscription_evenement WHERE id_evenement = :id_evenement AND id_utilisateur = :id_utilisateur');
            $checkReq->execute([
                'id_evenement' => $this->id_evenement,
                'id_utilisateur' => $id_utilisateur
            ]);

            if ($checkReq->fetchColumn() > 0) {
                throw new \Exception("Vous êtes déjà inscrit à cet événement.");
            }

            if ($this->nb_places <= 0) {
                throw new \Exception("Il n'y a plus de places disponibles pour cet événement.");
            }


            $req = $bdd->getBdd()->prepare('INSERT INTO inscription_evenement (id_evenement, id_utilisateur, date_inscription) VALUES (:id_evenement, :id_utilisateur, NOW())');
            $success = $req->execute([
                'id_evenement' => $this->id_evenement,
                'id_utilisateur' => $id_utilisateur
            ]);

            if (!$success) {
                throw new \Exception("Erreur lors de l'inscription à l'événement.");
            }

            $updateReq = $bdd->getBdd()->prepare('UPDATE evenement SET nb_places = nb_places - 1 WHERE id_evenement = :id_evenement');
            $updateReq->execute(['id_evenement' => $this->id_evenement]);

            $this->nb_places--;

            return true;
        } catch (\Exception $e) {
            error_log("Erreur lors de l'inscription à l'événement : " . $e->getMessage());
            throw $e;
        }
    }
        public function chargerDetails()
    {
        try {
            $bdd = new Bdd();
            $req = $bdd->getBdd()->prepare('SELECT * FROM evenement WHERE id_evenement = :id_evenement');
            $req->execute(['id_evenement' => $this->id_evenement]);

            $donnees = $req->fetch(\PDO::FETCH_ASSOC);
            if ($donnees) {
                $this->hydrate($donnees);
            } else {
                throw new \Exception("Événement non trouvé.");
            }
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors du chargement des détails de l'événement : " . $e->getMessage());
        }
    }


}
?>